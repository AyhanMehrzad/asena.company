<?php
/**
 * ASENA Corporate & Editions Master Configuration
 * Auto-detects Localhost (XAMPP) vs cPanel Production.
 */

// Detect environment: Localhost vs Production (cPanel)
$is_local = false;
if (isset($_SERVER['HTTP_HOST'])) {
    $host = $_SERVER['HTTP_HOST'];
    if (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false) {
        $is_local = true;
    }
} elseif (php_sapi_name() === 'cli') {
    if (file_exists('/opt/lampp')) {
        $is_local = true;
    }
}

if ($is_local) {
    // Local Development (XAMPP)
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'asena_premium');
    define('DB_USER', 'root');
    define('DB_PASS', '');
} else {
    // Production Hosting (cPanel)
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'asencomp_asena_db');
    define('DB_USER', 'asencomp_admin');
    define('DB_PASS', 'X3~YN,HY9M;j%]x(');
}

// Optional site root URL (empty for auto-detection)
define('SITE_URL', '');
?>
