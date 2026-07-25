<?php
require_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $user_id = $_SESSION['user_id'];
    $msg = trim($_POST['message']);
    $target = $_POST['target'] === 'ai' ? 'ai' : 'admin';
    
    if (!empty($msg)) {
        // We will prefix AI messages with [AI] so we can easily filter them if we don't want to change the schema too much.
        // Or we can just insert as normal and rely on context. But the UI filters based on [AI] prefix for simplicity in this demo.
        $db_msg = $target === 'ai' ? "[AI] " . $msg : $msg;
        
        $stmt = $pdo->prepare("INSERT INTO chat_messages (user_id, sender_type, message, is_read) VALUES (?, 'user', ?, FALSE)");
        $stmt->execute([$user_id, $db_msg]);
        
        // Mock AI Response
        if ($target === 'ai') {
            $ai_reply = "این یک پیام خودکار از دستیار هوشمند پت‌کر است. شما پرسیدید: '$msg'. در حال حاضر من در فاز آزمایشی هستم.";
            $stmt = $pdo->prepare("INSERT INTO chat_messages (user_id, sender_type, message, is_read) VALUES (?, 'ai', ?, TRUE)");
            $stmt->execute([$user_id, $ai_reply]);
        }
    }
    header("Location: ../chat.php?mode=$target");
    exit;
}
header('Location: ../chat.php');
?>
