<?php
/**
 * CRON JOB SCRIPT FOR AUTOSHIP SUBSCRIPTIONS
 * 
 * This script should be run daily at midnight via a cron job.
 * Command example: `0 0 * * * /usr/bin/php /opt/lampp/htdocs/petshop/cron_autoship.php`
 */

require_once __DIR__ . '/includes/db.php';

// --- TELEGRAM BOT CONFIGURATION ---
// IMPORTANT: Replace with your actual Bot Token and your Admin Chat ID
define('TELEGRAM_BOT_TOKEN', 'YOUR_BOT_TOKEN_HERE');
define('TELEGRAM_ADMIN_CHAT_ID', 'YOUR_CHAT_ID_HERE');

function sendTelegramMessage($message) {
    if (TELEGRAM_BOT_TOKEN === 'YOUR_BOT_TOKEN_HERE') {
        error_log("Telegram notification skipped: Bot token not configured.");
        return false;
    }
    
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
    $data = [
        'chat_id' => TELEGRAM_ADMIN_CHAT_ID,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

try {
    $pdo->beginTransaction();

    // Find all subscriptions that are due today or earlier and are active
    $stmt = $pdo->prepare("
        SELECT s.id as subscription_id, s.user_id, s.product_id, s.frequency_days, s.next_delivery_date, 
               p.name as product_name, p.price as product_price,
               u.phone, u.name as user_name
        FROM subscriptions s
        JOIN products p ON s.product_id = p.id
        JOIN users u ON s.user_id = u.id
        WHERE s.next_delivery_date <= CURDATE() AND s.status = 'active'
    ");
    $stmt->execute();
    $due_subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $processed_count = 0;
    $report_lines = [];

    foreach ($due_subscriptions as $sub) {
        // 1. Create a new pending order
        $orderStmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'pending_payment')");
        $orderStmt->execute([$sub['user_id'], $sub['product_price']]);
        $order_id = $pdo->lastInsertId();

        // 2. Add the item to the order
        $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, 1, ?)");
        $itemStmt->execute([$order_id, $sub['product_id'], $sub['product_price']]);

        // 3. Update the subscription's next delivery date
        $updateStmt = $pdo->prepare("UPDATE subscriptions SET next_delivery_date = DATE_ADD(next_delivery_date, INTERVAL frequency_days DAY) WHERE id = ?");
        $updateStmt->execute([$sub['subscription_id']]);

        $processed_count++;
        
        $report_lines[] = "📦 <b>Order #{$order_id}</b>\nUser: {$sub['user_name']} ({$sub['phone']})\nProduct: {$sub['product_name']}";
    }

    $pdo->commit();

    // 4. Send Telegram Notification if any orders were processed
    if ($processed_count > 0) {
        $message = "🚨 <b>PetShop Autoship Report</b> 🚨\n";
        $message .= "Date: " . date('Y-m-d') . "\n";
        $message .= "Total Processed: {$processed_count} subscriptions\n\n";
        $message .= implode("\n\n", $report_lines);
        
        sendTelegramMessage($message);
        echo "Successfully processed $processed_count subscriptions and notified admin.\n";
    } else {
        echo "No subscriptions due today.\n";
    }

} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Autoship Cron Error: " . $e->getMessage());
    echo "Error processing autoship: " . $e->getMessage() . "\n";
}
?>
