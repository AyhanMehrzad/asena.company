<?php
require_once 'includes/header.php';

// Pagination variables
$limit = 8;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filter variables
$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

// Build query
$where = [];
$params = [];

if ($category) {
    $where[] = "category = ?";
    $params[] = $category;
}

if ($search) {
    $where[] = "name LIKE ?";
    $params[] = "%$search%";
}

$whereClause = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

// Get total for pagination
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM products $whereClause");
$countStmt->execute($params);
$total = $countStmt->fetchColumn();
$totalPages = ceil($total / $limit);

// Get products
$stmt = $pdo->prepare("SELECT * FROM products $whereClause LIMIT $limit OFFSET $offset");
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Helper function to keep URL params intact when changing page/category
function buildUrl($updates) {
    $query = $_GET;
    foreach($updates as $key => $val) {
        if ($val === null || $val === '') unset($query[$key]);
        else $query[$key] = $val;
    }
    return '?' . http_build_query($query);
}
?>

<main class="max-w-container-max mx-auto overflow-hidden py-16 px-margin-desktop min-h-[70vh]">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b border-outline-variant/30 pb-6">
        <div>
            <h1 class="text-display-lg text-primary mb-4">فروشگاه پت‌کر</h1>
            <p class="text-body-lg text-on-surface-variant">
                <?php if($search): ?>نتایج جستجو برای: "<?php echo htmlspecialchars($search); ?>"
                <?php else: ?>بهترین محصولات اورجینال برای دوست کوچک شما<?php endif; ?>
            </p>
        </div>
        <div class="mt-6 md:mt-0 flex gap-4">
            <a href="shop.php" class="bg-surface-container-high px-6 py-3 rounded-xl flex items-center gap-2 hover:bg-surface-variant transition-colors text-on-surface">
                <span class="material-symbols-outlined">filter_list_off</span>
                <span>حذف فیلترها</span>
            </a>
        </div>
    </div>

    <!-- Categories -->
    <div class="flex gap-4 mb-16 overflow-x-auto pb-4 hide-scrollbar">
        <a href="<?php echo buildUrl(['category' => null, 'page' => 1]); ?>" class="<?php echo $category == '' ? 'bg-primary text-white' : 'bg-surface-container-high hover:bg-surface-variant text-on-surface'; ?> px-8 py-3 rounded-full whitespace-nowrap font-bold transition-colors">همه محصولات</a>
        <a href="<?php echo buildUrl(['category' => 'غذای سگ', 'page' => 1]); ?>" class="<?php echo $category == 'غذای سگ' ? 'bg-primary text-white' : 'bg-surface-container-high hover:bg-surface-variant text-on-surface'; ?> px-8 py-3 rounded-full whitespace-nowrap font-bold transition-colors">غذای سگ</a>
        <a href="<?php echo buildUrl(['category' => 'غذای گربه', 'page' => 1]); ?>" class="<?php echo $category == 'غذای گربه' ? 'bg-primary text-white' : 'bg-surface-container-high hover:bg-surface-variant text-on-surface'; ?> px-8 py-3 rounded-full whitespace-nowrap font-bold transition-colors">غذای گربه</a>
        <a href="<?php echo buildUrl(['category' => 'اسباب‌بازی', 'page' => 1]); ?>" class="<?php echo $category == 'اسباب‌بازی' ? 'bg-primary text-white' : 'bg-surface-container-high hover:bg-surface-variant text-on-surface'; ?> px-8 py-3 rounded-full whitespace-nowrap font-bold transition-colors">اسباب‌بازی</a>
        <a href="<?php echo buildUrl(['category' => 'لوازم بهداشتی', 'page' => 1]); ?>" class="<?php echo $category == 'لوازم بهداشتی' ? 'bg-primary text-white' : 'bg-surface-container-high hover:bg-surface-variant text-on-surface'; ?> px-8 py-3 rounded-full whitespace-nowrap font-bold transition-colors">لوازم بهداشتی</a>
        <a href="<?php echo buildUrl(['category' => 'مکمل دارویی', 'page' => 1]); ?>" class="<?php echo $category == 'مکمل دارویی' ? 'bg-primary text-white' : 'bg-surface-container-high hover:bg-surface-variant text-on-surface'; ?> px-8 py-3 rounded-full whitespace-nowrap font-bold transition-colors">مکمل دارویی</a>
    </div>

    <!-- Product Grid -->
    <?php if(count($products) > 0): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php foreach($products as $product): ?>
        <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col relative border border-outline-variant/10">
            <!-- Badge -->
            <?php if($product['discount_price']): ?>
            <div class="absolute top-6 left-6 bg-secondary-container text-on-secondary-container text-label-sm px-3 py-1 rounded-full z-10 font-bold">تخفیف ویژه</div>
            <?php endif; ?>

            <div class="aspect-square bg-surface-container-lowest rounded-2xl mb-6 overflow-hidden relative">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Product Image">
                
                <!-- Quick add to cart overlay -->
                <form action="cart_action.php" method="POST" class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-gradient-to-t from-black/60 to-transparent flex justify-center">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="bg-primary text-white w-full py-3 rounded-xl font-bold flex justify-center items-center gap-2 hover:bg-primary-container">
                        <span class="material-symbols-outlined">add_shopping_cart</span>
                        افزودن به سبد
                    </button>
                </form>
            </div>
            <div class="flex-1 flex flex-col">
                <p class="text-label-sm text-on-surface-variant mb-1"><?php echo htmlspecialchars($product['category']); ?></p>
                <h3 class="text-title-lg font-bold text-on-surface mb-4 line-clamp-2"><?php echo htmlspecialchars($product['name']); ?></h3>
                <div class="mt-auto flex justify-between items-center">
                    <div class="flex flex-col">
                        <?php if($product['discount_price']): ?>
                        <span class="text-label-sm text-on-surface-variant line-through mb-1"><?php echo number_format($product['price']); ?> تومان</span>
                        <span class="text-title-lg font-bold text-primary"><?php echo number_format($product['discount_price']); ?> تومان</span>
                        <?php else: ?>
                        <span class="text-title-lg font-bold text-primary"><?php echo number_format($product['price']); ?> تومان</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <div class="text-center py-20 text-on-surface-variant">
            <span class="material-symbols-outlined text-6xl mb-4 opacity-50">search_off</span>
            <p class="text-title-lg font-bold">محصولی یافت نشد!</p>
        </div>
    <?php endif; ?>

    <!-- Pagination -->
    <?php if($totalPages > 1): ?>
    <div class="flex justify-center items-center gap-2 mt-20" dir="ltr">
        <?php if($page > 1): ?>
            <a href="<?php echo buildUrl(['page' => $page - 1]); ?>" class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center hover:bg-primary hover:text-white transition-colors"><span class="material-symbols-outlined">chevron_left</span></a>
        <?php endif; ?>

        <?php for($i=1; $i<=$totalPages; $i++): ?>
            <?php if($i == $page): ?>
                <span class="w-12 h-12 rounded-xl bg-primary text-white font-bold flex items-center justify-center"><?php echo $i; ?></span>
            <?php else: ?>
                <a href="<?php echo buildUrl(['page' => $i]); ?>" class="w-12 h-12 rounded-xl bg-surface-container hover:bg-primary hover:text-white transition-colors font-bold flex items-center justify-center"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if($page < $totalPages): ?>
            <a href="<?php echo buildUrl(['page' => $page + 1]); ?>" class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center hover:bg-primary hover:text-white transition-colors"><span class="material-symbols-outlined">chevron_right</span></a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
