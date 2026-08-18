<?php
session_start();

$model = $_GET['model'] ?? 'premium';
$role = $_GET['role'] ?? 'user';

// Validate model to prevent path traversal
$allowed_models = ['basic', 'standard', 'premium'];
if (!in_array($model, $allowed_models)) {
    die("Invalid model selected.");
}

// Include the database of the premium model since they share the same DB
require_once __DIR__ . '/premium/includes/db.php';

// Find a user matching the role
$stmt = $pdo->prepare("SELECT id, role FROM users WHERE role = ? ORDER BY id ASC LIMIT 1");
$stmt->execute([$role]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Regenerate session id for security
    session_regenerate_id(true);
    
    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['active_model'] = $model;
    
    // Redirect to the unified premium dashboard
    header("Location: premium/index.php");
    exit;
} else {
    die("No user found for role: " . htmlspecialchars($role));
}
