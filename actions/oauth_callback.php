<?php
require_once '../includes/db.php';

// This is a stub for OAuth callback (Google/Apple)
$provider = isset($_GET['provider']) ? $_GET['provider'] : '';
$mock_id = isset($_GET['mock_id']) ? $_GET['mock_id'] : 'mock_123456';
$mock_name = isset($_GET['mock_name']) ? $_GET['mock_name'] : 'کاربر تستی OAuth';

if (!in_array($provider, ['google', 'apple'])) {
    die('Invalid provider');
}

$id_column = $provider === 'google' ? 'google_id' : 'apple_id';

try {
    // Check if user exists
    $stmt = $pdo->prepare("SELECT id, role FROM users WHERE $id_column = ?");
    $stmt->execute([$mock_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Login existing user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
    } else {
        // Register new user
        // Generate a random mock phone since it's required and UNIQUE
        $mock_phone = '09' . rand(100000000, 999999999);
        $insert = $pdo->prepare("INSERT INTO users (phone, name, $id_column, loyalty_points) VALUES (?, ?, ?, 50)");
        $insert->execute([$mock_phone, $mock_name, $mock_id]);
        
        $new_user_id = $pdo->lastInsertId();
        $_SESSION['user_id'] = $new_user_id;
        $_SESSION['user_role'] = 'user';
        
        // Seed a dummy pet so the user can test the booking pet selection UI
        try {
            $pet_insert = $pdo->prepare("INSERT INTO user_pets (user_id, name, type, race, gender, age) VALUES (?, ?, ?, ?, ?, ?)");
            $pet_insert->execute([$new_user_id, 'تدی', 'سگ', 'پامرانین', 'نر', '2']);
        } catch(PDOException $e) {}
    }

    header('Location: ../index.php');
    exit;
} catch(PDOException $e) {
    die("OAuth Error: " . $e->getMessage());
}
?>
