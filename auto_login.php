<?php
session_start();

$model = $_GET['model'] ?? 'premium';
$role  = $_GET['role'] ?? 'user';

// Validate model to prevent path traversal
$allowed_models = ['basic', 'standard', 'premium', 'pharmacy'];
if (!in_array($model, $allowed_models, true)) {
    die("Invalid model selected.");
}

// Include database
require_once __DIR__ . '/premium/includes/db.php';

// Find a user matching the role
$stmt = $pdo->prepare("SELECT id, role, name FROM users WHERE role = ? ORDER BY id ASC LIMIT 1");
$stmt->execute([$role]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Regenerate session id for security
    session_regenerate_id(true);
    
    // Set session variables
    $_SESSION['user_id']      = $user['id'];
    $_SESSION['user_role']    = $user['role'];
    $_SESSION['role']         = $user['role'];
    $_SESSION['name']         = $user['name'] ?? '';
    $_SESSION['active_model'] = $model;

    // Determine subpath based on role
    $subpath = 'index.php';
    if ($role === 'admin') {
        $subpath = 'admin/index.php';
    } elseif ($role === 'doctor') {
        $subpath = 'doctor/index.php';
    }

    // Determine target based on model
    switch ($model) {
        case 'pharmacy':
            $target = '/asena/asena-pharmacy-golzari/' . $subpath;
            break;
        case 'basic':
            $target = '/asena/asena-basic/' . $subpath;
            break;
        case 'standard':
            $target = '/asena/asena-standard/' . $subpath;
            break;
        case 'premium':
        default:
            $target = '/asena/asena-premium/' . $subpath;
            break;
    }
    
    header("Location: " . $target);
    exit;
} else {
    die("No user found for role: " . htmlspecialchars($role));
}
