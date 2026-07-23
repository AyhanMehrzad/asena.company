<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_REQUEST['action'] ?? '';
    $product_id = (int)($_REQUEST['product_id'] ?? 0);
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($product_id > 0) {
        if ($action === 'add') {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]++;
            } else {
                $_SESSION['cart'][$product_id] = 1;
            }
        } elseif ($action === 'remove') {
            unset($_SESSION['cart'][$product_id]);
        } elseif ($action === 'increase') {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]++;
            }
        } elseif ($action === 'decrease') {
            if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id] > 1) {
                $_SESSION['cart'][$product_id]--;
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }
}

// Redirect back to referring page or cart
$referer = $_SERVER['HTTP_REFERER'] ?? 'cart.php';
header("Location: " . $referer);
exit;
?>
