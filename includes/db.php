<?php
$host = '127.0.0.1';
$dbname = 'petshop_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbname`");
} catch(PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}

// Ensure session is started globally
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
