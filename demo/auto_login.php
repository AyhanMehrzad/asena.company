<?php
session_start();

$model = $_GET['model'] ?? 'premium';
$role  = $_GET['role'] ?? 'public';

// Validate model to prevent path traversal
$allowed_models = ['basic', 'standard', 'premium', 'pharmacy', 'pharmacy-basic', 'pharmacy-standard', 'pharmacy-premium'];
if (!in_array($model, $allowed_models, true)) {
    die("Invalid model selected.");
}

if ($model === 'pharmacy') {
    $model = 'pharmacy-standard';
}

$page = $_GET['page'] ?? $_GET['redirect'] ?? 'index.php';
$allowed_pages = ['index.php', 'shop.php', 'pharmacy.php', 'booking.php', 'subscriptions.php', 'charity.php', 'cart.php'];
if (!in_array($page, $allowed_pages, true)) {
    $page = 'index.php';
}

// 1. If public/visitor view is requested (Viewing the normal storefront & design as a customer)
if ($role === 'public' || $role === 'visitor' || $role === 'guest') {
    // Unset any logged-in user session so they see the pure public visitor storefront
    unset($_SESSION['user_id'], $_SESSION['user_role'], $_SESSION['role'], $_SESSION['name']);
    $_SESSION['active_model'] = $model;

    $target = "{$model}/{$page}";
    header("Location: " . $target);
    exit;
}

// 2. Include database for panel role logins
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
        if ($model === 'pharmacy-basic') {
            $subpath = 'index.php';
        } else {
            $subpath = 'doctor/index.php';
        }
    }

    $target = "{$model}/{$subpath}";
    header("Location: " . $target);
    exit;
} else {
    die("No user found for role: " . htmlspecialchars($role));
}
