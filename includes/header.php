<?php
require_once __DIR__ . '/db.php';

// Calculate cart items count
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $cart_count += $qty;
    }
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa" style="">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PetCare Iran</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&amp;display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="assets/js/tailwind-config.js"></script>
</head>
<body class="bg-background text-on-background overflow-x-hidden">
    <!-- Header Section -->
    <header class="bg-primary shadow-md sticky top-0 z-50 transition-all">
        <div class="flex justify-between items-center w-full px-margin-desktop py-4 max-w-container-max mx-auto flex-row">
            <div class="flex items-center gap-8">
                <div class="hidden md:flex gap-8 flex-row">
                    <a class="text-on-primary text-label-lg hover:text-secondary-fixed transition-colors duration-200 border-b-2 border-white pb-1 opacity-100" href="index.php">خانه</a>
                    <a class="text-on-primary opacity-90 text-label-lg hover:text-secondary-fixed transition-colors duration-200" href="shop.php">فروشگاه</a>
                    <a class="text-on-primary opacity-90 text-label-lg hover:text-secondary-fixed transition-colors duration-200" href="subscriptions.php">اشتراک خودکار</a>
                </div>
            </div>
            <div class="hidden lg:flex items-center bg-white/10 rounded-full px-4 py-2 text-on-primary gap-2 flex-1 max-w-md mx-4">
                <form action="shop.php" method="GET" class="flex items-center w-full">
                    <button type="submit" class="material-symbols-outlined text-body-md bg-transparent border-none outline-none text-on-primary cursor-pointer flex items-center justify-center p-0" data-icon="search">search</button>
                    <input name="q" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>" class="bg-transparent border-none focus:ring-0 text-body-md w-full placeholder-white/60 text-white" placeholder="جستجو در محصولات و خدمات..." type="text">
                </form>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                            <a href="admin/index.php" class="bg-secondary-container text-on-secondary-container px-6 py-2 rounded-lg font-label-lg btn-premium">پنل مدیریت</a>
                        <?php endif; ?>
                        <a href="logout.php" class="bg-error/10 text-error px-6 py-2 rounded-lg font-label-lg btn-premium">خروج</a>
                    <?php else: ?>
                        <a href="loginpage.php" class="bg-secondary-container text-on-secondary-container px-6 py-2 rounded-lg font-label-lg btn-premium">ورود / ثبت‌نام</a>
                    <?php endif; ?>
                    <a href="loginpage.php" class="material-symbols-outlined text-on-primary p-2 hover:bg-white/10 rounded-full transition-colors" data-icon="person">person</a>
                    <a href="cart.php" class="relative material-symbols-outlined text-on-primary p-2 hover:bg-white/10 rounded-full transition-colors" data-icon="shopping_cart">
                        shopping_cart
                        <?php if($cart_count > 0): ?>
                            <span class="absolute top-0 right-0 bg-secondary text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center"><?php echo $cart_count; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
                <h1 class="text-headline-lg font-bold text-on-primary tracking-tight">PetCare Iran</h1>
            </div>
        </div>
    </header>
