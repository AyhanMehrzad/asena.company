<?php
/**
 * update_settings.php — Self-executing setup to align cPanel site_settings with active Melipayamak credentials
 */
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: text/plain; charset=utf-8');

try {
    set_setting($pdo, 'melipayamak_api_key', 'efaec6c8-2daf-4473-9080-df7ac67eea89');
    set_setting($pdo, 'melipayamak_username', '9146676978');
    set_setting($pdo, 'melipayamak_password', 'NZ456QM9L');
    set_setting($pdo, 'melipayamak_from', '2170002198');
    set_setting($pdo, 'melipayamak_sandbox', '0');

    $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'melipayamak%'");
    echo "SUCCESS: site_settings updated successfully in " . $pdo->query('SELECT DATABASE()')->fetchColumn() . ":\n";
    print_r($stmt->fetchAll(PDO::FETCH_KEY_PAIR));
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage();
}
