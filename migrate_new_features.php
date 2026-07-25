<?php
require 'includes/db.php';

try {
    // 1. Update Users Table for OAuth
    $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS google_id VARCHAR(255) NULL UNIQUE");
    $pdo->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS apple_id VARCHAR(255) NULL UNIQUE");
    
    // 2. Wishlist Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS wishlist (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        product_id INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY user_product (user_id, product_id),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )");

    // 3. Reviews Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        target_type ENUM('product', 'doctor') NOT NULL,
        target_id INT NOT NULL,
        rating INT NOT NULL CHECK(rating >= 1 AND rating <= 5),
        comment TEXT,
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )");

    // 4. Autoship Plans
    $pdo->exec("CREATE TABLE IF NOT EXISTS autoship_plans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        interval_months INT NOT NULL,
        discount_percent INT NOT NULL DEFAULT 5,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Insert placeholder plans
    $stmt = $pdo->query("SELECT COUNT(*) FROM autoship_plans");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO autoship_plans (name, interval_months, discount_percent) VALUES 
            ('اشتراک ۳ ماهه', 3, 5),
            ('اشتراک ۶ ماهه', 6, 10),
            ('اشتراک ۱۲ ماهه', 12, 20)");
    }

    // 5. Autoship Subscriptions (User's active plans)
    $pdo->exec("CREATE TABLE IF NOT EXISTS autoship_subscriptions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        plan_id INT NOT NULL,
        product_id INT NOT NULL,
        next_delivery_date DATE NOT NULL,
        status ENUM('active', 'paused', 'cancelled') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (plan_id) REFERENCES autoship_plans(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )");

    // 6. Chat Messages
    $pdo->exec("CREATE TABLE IF NOT EXISTS chat_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        sender_type ENUM('user', 'admin', 'ai') NOT NULL,
        message TEXT NOT NULL,
        is_read BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )");

    echo "Migration completed successfully!";
} catch(PDOException $e) {
    die("Migration failed: " . $e->getMessage());
}
?>
