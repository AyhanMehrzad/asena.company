<?php
// Ensure session is started globally before any potential output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = '127.0.0.1';
$dbname = 'asena_premium';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if db exists
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
    $dbExists = (bool)$stmt->fetch();

    if (!$dbExists) {
        $pdo->exec("CREATE DATABASE `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$dbname`");
        
        // Auto-import sql file
        $sqlFile = __DIR__ . '/../petshop_db.sql';
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            if ($sql !== false && !empty(trim($sql))) {
                $pdo->exec($sql);
            }
        }
    } else {
        $pdo->exec("USE `$dbname`");
    }
} catch(PDOException $e) {
    die("Database Connection failed: " . $e->getMessage());
}

require_once __DIR__ . '/functions.php';
?>
