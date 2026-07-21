<?php
require_once '../includes/db.php';

// Route Guard
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Handle Delete
if (isset($_POST['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
    header("Location: index.php");
    exit;
}

// Fetch products
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <title>پنل مدیریت پت‌کر</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&amp;display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Geist', sans-serif; background-color: #f3f3f4; }
    </style>
</head>
<body class="text-gray-800">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col">
        <div class="p-6">
            <h2 class="text-2xl font-bold">پنل مدیریت</h2>
        </div>
        <nav class="flex-1 px-4 space-y-2">
            <a href="index.php" class="block px-4 py-3 bg-blue-600 rounded-lg flex items-center gap-3">
                <span class="material-symbols-outlined">inventory_2</span>محصولات
            </a>
            <a href="#" class="block px-4 py-3 hover:bg-slate-800 rounded-lg flex items-center gap-3 transition-colors opacity-50">
                <span class="material-symbols-outlined">group</span>کاربران
            </a>
            <a href="#" class="block px-4 py-3 hover:bg-slate-800 rounded-lg flex items-center gap-3 transition-colors opacity-50">
                <span class="material-symbols-outlined">shopping_bag</span>سفارشات
            </a>
        </nav>
        <div class="p-4">
            <a href="../index.php" class="block text-center px-4 py-2 bg-slate-700 hover:bg-slate-600 rounded-lg transition-colors">
                بازگشت به سایت
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">مدیریت محصولات</h1>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition-colors">افزودن محصول جدید</button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-200">
            <table class="w-full text-right">
                <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 text-sm">
                    <tr>
                        <th class="p-4 font-normal">تصویر</th>
                        <th class="p-4 font-normal">نام محصول</th>
                        <th class="p-4 font-normal">دسته‌بندی</th>
                        <th class="p-4 font-normal">قیمت (تومان)</th>
                        <th class="p-4 font-normal">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach($products as $prod): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            <img src="<?php echo htmlspecialchars($prod['image_url']); ?>" class="w-12 h-12 rounded-lg object-cover bg-gray-100">
                        </td>
                        <td class="p-4 font-medium text-gray-900 max-w-xs truncate">
                            <?php echo htmlspecialchars($prod['name']); ?>
                        </td>
                        <td class="p-4 text-gray-500">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs"><?php echo htmlspecialchars($prod['category']); ?></span>
                        </td>
                        <td class="p-4 text-gray-900 font-medium">
                            <?php echo number_format($prod['price']); ?>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2">
                                <button class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors"><span class="material-symbols-outlined text-sm">edit</span></button>
                                <form method="POST" onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟');">
                                    <input type="hidden" name="delete_id" value="<?php echo $prod['id']; ?>">
                                    <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors"><span class="material-symbols-outlined text-sm">delete</span></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>
