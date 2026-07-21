<?php
require_once 'includes/db.php';
try {
    $pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(255) NULL");
    echo "Password column added successfully.";
} catch(PDOException $e) {
    echo "Error or already exists: " . $e->getMessage();
}
?>
