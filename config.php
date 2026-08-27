<?php
/**
 * ASENA Corporate & Editions Master Configuration
 * 
 * Instructions for cPanel / Production Hosting:
 * 1. Create a MySQL Database in your cPanel (MySQL Database Wizard).
 * 2. Create a MySQL User and assign ALL PRIVILEGES to the database.
 * 3. Enter your database details below.
 * 4. Import the `asena_database.sql` file via phpMyAdmin.
 */

// Database Host (usually 'localhost' or '127.0.0.1' on cPanel)
define('DB_HOST', 'localhost');

// Database Name (e.g., 'yourcpaneluser_asena')
define('DB_NAME', 'asena_premium');

// Database Username (e.g., 'yourcpaneluser_dbuser')
define('DB_USER', 'root');

// Database Password
define('DB_PASS', '');

// Optional site root URL if needed (leave empty for auto-detection)
define('SITE_URL', '');
?>
