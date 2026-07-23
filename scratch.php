<?php
require_once 'includes/db.php';
$stmt = $pdo->exec("DELETE FROM doctors WHERE id IN (1, 2, 3)");
echo "Deleted sample doctors.";
