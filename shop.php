<?php
require_once 'includes/header.php';

// Pagination variables
$limit = 12;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filter variables
$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$selected_brands = isset($_GET['brands']) && is_array($_GET['brands']) ? $_GET['brands'] : [];
$price_ranges = isset($_GET['price_ranges']) && is_array($_GET['price_ranges']) ? $_GET['price_ranges'] : [];
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'relevant';

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

// Brand filtering
if (!empty($selected_brands)) {
    $placeholders = implode(',', array_fill(0, count($selected_brands), '?'));
    $where[] = "brand IN ($placeholders)";
    foreach ($selected_brands as $b) {
        $params[] = $b;
    }
}

// Price filtering
if (!empty($price_ranges)) {
    $price_conditions = [];
    foreach ($price_ranges as $pr) {
        if ($pr === 'under_500k') {
            $price_conditions[] = "price < 500000";
        } elseif ($pr === '500k_to_1500k') {
            $price_conditions[] = "(price >= 500000 AND price <= 1500000)";
        } elseif ($pr === 'over_1500k') {
            $price_conditions[] = "price > 1500000";
        }
    }
    if (!empty($price_conditions)) {
        $where[] = "(" . implode(" OR ", $price_conditions) . ")";
    }
}

$whereClause = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

// Sorting
$orderBy = "ORDER BY created_at DESC"; // default (newest)
if ($sort === 'price_asc') {
    $orderBy = "ORDER BY price ASC";
} elseif ($sort === 'price_desc') {
    $orderBy = "ORDER BY price DESC";
}

// Get total for pagination
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM products $whereClause");
$countStmt->execute($params);
$total = $countStmt->fetchColumn();
$totalPages = ceil($total / $limit);

// Get products
$stmt = $pdo->prepare("SELECT * FROM products $whereClause $orderBy LIMIT $limit OFFSET $offset");
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all available unique brands for the sidebar
$brandsStmt = $pdo->query("SELECT DISTINCT brand FROM products WHERE brand IS NOT NULL AND brand != '' ORDER BY brand ASC");
$all_brands = $brandsStmt->fetchAll(PDO::FETCH_COLUMN);

// Fetch user wishlist if logged in
$user_wishlist = [];
if (isset($_SESSION['user_id'])) {
    $wishlist_stmt = $pdo->prepare("SELECT product_id FROM wishlist WHERE user_id = ?");
    $wishlist_stmt->execute([$_SESSION['user_id']]);
    $user_wishlist = $wishlist_stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Helper function to keep URL params intact when changing page/category/removing filters
function buildUrl($updates) {
    $query = $_GET;
    foreach($updates as $key => $val) {
        if ($val === null || $val === '') unset($query[$key]);
        else $query[$key] = $val;
    }
    return '?' . http_build_query($query);
}

// Helper to remove an array item from URL query (for the active filter banner)
function buildUrlRemoveArrayItem($arrayName, $valueToRemove) {
    $query = $_GET;
    if (isset($query[$arrayName]) && is_array($query[$arrayName])) {
        $query[$arrayName] = array_filter($query[$arrayName], function($v) use ($valueToRemove) {
            return $v !== $valueToRemove;
        });
        if (empty($query[$arrayName])) {
            unset($query[$arrayName]);
        }
    }
    // reset page to 1 when filters change
    unset($query['page']);
    return '?' . http_build_query($query);
}
?>

<!-- Secondary Nav Bar (Chewy Style) -->
<div class="bg-primary text-white border-t border-white/20 hidden md:block">
   <div class="max-w-container-max mx-auto px-margin-desktop flex gap-8 text-label-lg font-bold">
       <a href="#" class="py-3 hover:underline">فروش ویژه</a>
       <a href="#" class="py-3 hover:underline">برندها</a>
       <a href="#" class="py-3 hover:underline">داروخانه دامپزشکی</a>
       <a href="#" class="py-3 hover:underline text-secondary-fixed">خرید اشتراکی (Autoship)</a>
       <a href="#" class="py-3 hover:underline">خدمات مشتریان</a>
   </div>
</div>

<main class="max-w-container-max mx-auto overflow-hidden py-8 px-margin-desktop min-h-[70vh]">
    
    <!-- Breadcrumb -->
    <div class="text-label-sm text-on-surface-variant mb-6">
        <a href="index.php" class="hover:underline">خانه</a> > 
        <a href="shop.php" class="hover:underline">فروشگاه</a> 
        <?php if($category): ?> > <span class="text-on-surface"><?php echo htmlspecialchars($category); ?></span><?php endif; ?>
    </div>

    <!-- The entire shop area is wrapped in a GET form to auto-submit filters -->
    <form id="shop-filter-form" action="shop.php" method="GET" class="flex flex-col md:flex-row gap-8">
        
        <!-- Hidden inputs to preserve non-form states like search query -->
        <?php if($search): ?>
            <input type="hidden" name="q" value="<?php echo htmlspecialchars($search); ?>">
        <?php endif; ?>
        <?php if($category): ?>
            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
        <?php endif; ?>

        <!-- Sidebar Facets -->
        <aside class="w-full md:w-1/4 lg:w-1/5 flex-shrink-0">
           <h2 class="text-title-lg font-bold mb-4">فیلترها</h2>
           
           <!-- Categories Filter -->
           <div class="border-t border-outline-variant/30 py-4">
               <h3 class="font-bold text-on-surface mb-3 flex justify-between items-center cursor-pointer">دسته‌بندی‌ها <span class="material-symbols-outlined">expand_more</span></h3>
               <ul class="space-y-3 text-body-md text-on-surface-variant pr-2">
                   <li>
                        <a href="<?php echo buildUrl(['category' => null, 'page' => 1]); ?>" class="flex items-center gap-2 <?php echo $category == '' ? 'font-bold text-primary' : 'hover:text-primary'; ?>">
                            همه محصولات
                        </a>
                   </li>
                   <li>
                        <a href="<?php echo buildUrl(['category' => 'غذای سگ', 'page' => 1]); ?>" class="flex items-center gap-2 <?php echo $category == 'غذای سگ' ? 'font-bold text-primary' : 'hover:text-primary'; ?>">
                            غذای سگ
                        </a>
                   </li>
                   <li>
                        <a href="<?php echo buildUrl(['category' => 'غذای گربه', 'page' => 1]); ?>" class="flex items-center gap-2 <?php echo $category == 'غذای گربه' ? 'font-bold text-primary' : 'hover:text-primary'; ?>">
                            غذای گربه
                        </a>
                   </li>
                   <li>
                        <a href="<?php echo buildUrl(['category' => 'اسباب‌بازی', 'page' => 1]); ?>" class="flex items-center gap-2 <?php echo $category == 'اسباب‌بازی' ? 'font-bold text-primary' : 'hover:text-primary'; ?>">
                            اسباب‌بازی
                        </a>
                   </li>
                   <li>
                        <a href="<?php echo buildUrl(['category' => 'لوازم بهداشتی', 'page' => 1]); ?>" class="flex items-center gap-2 <?php echo $category == 'لوازم بهداشتی' ? 'font-bold text-primary' : 'hover:text-primary'; ?>">
                            لوازم بهداشتی
                        </a>
                   </li>
                   <li>
                        <a href="<?php echo buildUrl(['category' => 'مکمل دارویی', 'page' => 1]); ?>" class="flex items-center gap-2 <?php echo $category == 'مکمل دارویی' ? 'font-bold text-primary' : 'hover:text-primary'; ?>">
                            مکمل دارویی
                        </a>
                   </li>
               </ul>
           </div>

           <!-- Dynamic Brand Filter -->
           <div class="border-t border-outline-variant/30 py-4">
               <h3 class="font-bold text-on-surface mb-3 flex justify-between items-center cursor-pointer">برندها <span class="material-symbols-outlined">expand_more</span></h3>
               <div class="space-y-3 text-body-md text-on-surface-variant pr-2 max-h-60 overflow-y-auto hide-scrollbar">
                   <?php foreach($all_brands as $b): ?>
                       <label class="flex items-center gap-3 cursor-pointer hover:text-primary">
                           <input type="checkbox" name="brands[]" value="<?php echo htmlspecialchars($b); ?>" <?php echo in_array($b, $selected_brands) ? 'checked' : ''; ?> onchange="this.form.submit()" class="rounded border-outline-variant text-primary focus:ring-primary w-4 h-4">
                           <?php echo htmlspecialchars($b); ?>
                       </label>
                   <?php endforeach; ?>
               </div>
           </div>

           <!-- Price Filter -->
           <div class="border-t border-outline-variant/30 py-4">
               <h3 class="font-bold text-on-surface mb-3 flex justify-between items-center cursor-pointer">محدوده قیمت <span class="material-symbols-outlined">expand_more</span></h3>
               <div class="space-y-3 text-body-md text-on-surface-variant pr-2">
                   <label class="flex items-center gap-3 cursor-pointer hover:text-primary">
                       <input type="checkbox" name="price_ranges[]" value="under_500k" <?php echo in_array('under_500k', $price_ranges) ? 'checked' : ''; ?> onchange="this.form.submit()" class="rounded border-outline-variant text-primary focus:ring-primary w-4 h-4">
                       زیر ۵۰۰,۰۰۰ تومان
                   </label>
                   <label class="flex items-center gap-3 cursor-pointer hover:text-primary">
                       <input type="checkbox" name="price_ranges[]" value="500k_to_1500k" <?php echo in_array('500k_to_1500k', $price_ranges) ? 'checked' : ''; ?> onchange="this.form.submit()" class="rounded border-outline-variant text-primary focus:ring-primary w-4 h-4">
                       ۵۰۰,۰۰۰ تا ۱,۵۰۰,۰۰۰ تومان
                   </label>
                   <label class="flex items-center gap-3 cursor-pointer hover:text-primary">
                       <input type="checkbox" name="price_ranges[]" value="over_1500k" <?php echo in_array('over_1500k', $price_ranges) ? 'checked' : ''; ?> onchange="this.form.submit()" class="rounded border-outline-variant text-primary focus:ring-primary w-4 h-4">
                       بالای ۱,۵۰۰,۰۰۰ تومان
                   </label>
               </div>
           </div>
        </aside>

        <!-- Product Grid Area -->
        <section class="w-full md:w-3/4 lg:w-4/5">
            <!-- Header/Sorting -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-4">
               <h1 class="text-headline-md text-on-surface">
                   <?php if($search): ?>
                       نتایج برای "<?php echo htmlspecialchars($search); ?>"
                   <?php else: ?>
                       <?php echo $category ? htmlspecialchars($category) : 'تمام محصولات'; ?>
                   <?php endif; ?>
                   <span class="text-body-md text-on-surface-variant font-normal mr-2">(<?php echo $total; ?> نتیجه)</span>
               </h1>
               
               <div class="mt-4 sm:mt-0 flex items-center gap-2 text-body-md">
                   <span class="text-on-surface-variant">مرتب‌سازی:</span>
                   <select name="sort" onchange="this.form.submit()" class="border border-outline-variant rounded-md py-1.5 px-3 bg-surface-container-lowest text-on-surface focus:border-primary focus:ring-1 focus:ring-primary outline-none cursor-pointer">
                       <option value="relevant" <?php echo $sort == 'relevant' ? 'selected' : ''; ?>>مرتبط‌ترین / جدیدترین‌ها</option>
                       <option value="price_asc" <?php echo $sort == 'price_asc' ? 'selected' : ''; ?>>قیمت: ارزان به گران</option>
                       <option value="price_desc" <?php echo $sort == 'price_desc' ? 'selected' : ''; ?>>قیمت: گران به ارزان</option>
                   </select>
               </div>
            </div>

            <!-- Active Filters Banner -->
            <?php if($category || $search || !empty($selected_brands) || !empty($price_ranges)): ?>
            <div class="flex flex-wrap items-center gap-2 mb-6">
                <?php if($category): ?>
                <span class="bg-surface-container border border-outline-variant/50 px-3 py-1 rounded-full text-label-sm flex items-center gap-1">
                    <?php echo htmlspecialchars($category); ?>
                    <a href="<?php echo buildUrl(['category' => null, 'page' => 1]); ?>" class="material-symbols-outlined text-[16px] hover:text-error cursor-pointer">close</a>
                </span>
                <?php endif; ?>
                
                <?php if($search): ?>
                <span class="bg-surface-container border border-outline-variant/50 px-3 py-1 rounded-full text-label-sm flex items-center gap-1">
                    "<?php echo htmlspecialchars($search); ?>"
                    <a href="<?php echo buildUrl(['q' => null, 'page' => 1]); ?>" class="material-symbols-outlined text-[16px] hover:text-error cursor-pointer">close</a>
                </span>
                <?php endif; ?>

                <?php foreach($selected_brands as $b): ?>
                <span class="bg-surface-container border border-outline-variant/50 px-3 py-1 rounded-full text-label-sm flex items-center gap-1">
                    <?php echo htmlspecialchars($b); ?>
                    <a href="<?php echo buildUrlRemoveArrayItem('brands', $b); ?>" class="material-symbols-outlined text-[16px] hover:text-error cursor-pointer">close</a>
                </span>
                <?php endforeach; ?>

                <?php foreach($price_ranges as $pr): ?>
                <span class="bg-surface-container border border-outline-variant/50 px-3 py-1 rounded-full text-label-sm flex items-center gap-1">
                    <?php 
                        if ($pr === 'under_500k') echo 'زیر ۵۰۰,۰۰۰ تومان';
                        elseif ($pr === '500k_to_1500k') echo '۵۰۰,۰۰۰ تا ۱,۵۰۰,۰۰۰ تومان';
                        elseif ($pr === 'over_1500k') echo 'بالای ۱,۵۰۰,۰۰۰ تومان';
                    ?>
                    <a href="<?php echo buildUrlRemoveArrayItem('price_ranges', $pr); ?>" class="material-symbols-outlined text-[16px] hover:text-error cursor-pointer">close</a>
                </span>
                <?php endforeach; ?>

                <a href="shop.php" class="text-primary text-label-sm hover:underline mr-2 font-bold">پاک کردن همه</a>
            </div>
            <?php endif; ?>

            <!-- Grid -->
            <?php if(count($products) > 0): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($products as $product): ?>
                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col relative border border-outline-variant/10">
                    <!-- Badge -->
                    <?php if($product['discount_price']): ?>
                    <div class="absolute top-6 left-6 bg-secondary-container text-on-secondary-container text-label-sm px-3 py-1 rounded-full z-10 font-bold">تخفیف ویژه</div>
                    <?php endif; ?>
                    
                    <!-- Wishlist Button -->
                    <?php $in_wishlist = in_array($product['id'], $user_wishlist); ?>
                    <button type="button" onclick="toggleWishlist(this, <?php echo $product['id']; ?>)" class="absolute top-6 right-6 z-10 w-10 h-10 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center text-on-surface hover:text-error transition-colors shadow-sm">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' <?php echo $in_wishlist ? '1' : '0'; ?>; color: <?php echo $in_wishlist ? '#dc2626' : 'inherit'; ?>;">favorite</span>
                    </button>

                    <div class="aspect-square bg-surface-container-lowest rounded-2xl mb-6 overflow-hidden relative">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        
                        <!-- Quick add to cart overlay -->
                        <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-gradient-to-t from-black/60 to-transparent flex justify-center z-20">
                            <!-- Using a form here isn't great because it's inside another form (our main filter form).
                                 We will use JavaScript to submit to actions/cart_action.php via POST or redirect. -->
                            <button type="button" onclick="addToCart(this, <?php echo $product['id']; ?>)" class="bg-primary text-white w-full py-3 rounded-xl font-bold flex justify-center items-center gap-2 hover:bg-primary-container">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                                افزودن به سبد
                            </button>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <p class="text-label-sm text-on-surface-variant mb-1">
                            <?php echo htmlspecialchars($product['category']); ?>
                            <?php if(!empty($product['brand'])) echo ' • <span class="text-primary font-bold">' . htmlspecialchars($product['brand']) . '</span>'; ?>
                        </p>
                        <a href="product_details.php?id=<?php echo $product['id']; ?>"><h3 class="text-title-lg font-bold text-on-surface mb-4 line-clamp-2 hover:text-primary transition-colors cursor-pointer"><?php echo htmlspecialchars($product['name']); ?></h3></a>
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
                        <!-- Autoship -->
                        <div class="flex items-center gap-1 text-[11px] text-[#0066cc] font-bold mt-2">
                             <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">autorenew</span>
                             <?php echo number_format(($product['discount_price'] ?: $product['price']) * 0.95); ?> تومان با خرید اشتراکی
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
                <div class="text-center py-20 text-on-surface-variant bg-surface-container-lowest border border-outline-variant/30 rounded-xl">
                    <span class="material-symbols-outlined text-6xl mb-4 opacity-50">search_off</span>
                    <p class="text-title-lg font-bold">محصولی یافت نشد!</p>
                    <a href="shop.php" class="text-primary hover:underline mt-2 inline-block">پاک کردن فیلترها و نمایش همه</a>
                </div>
            <?php endif; ?>

            <!-- Pagination -->
            <?php if($totalPages > 1): ?>
            <div class="flex justify-center items-center gap-2 mt-12 mb-8" dir="ltr">
                <?php if($page > 1): ?>
                    <a href="<?php echo buildUrl(['page' => $page - 1]); ?>" class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:border-primary hover:text-primary transition-colors"><span class="material-symbols-outlined">chevron_left</span></a>
                <?php endif; ?>

                <?php for($i=1; $i<=$totalPages; $i++): ?>
                    <?php if($i == $page): ?>
                        <span class="w-10 h-10 rounded-full bg-primary text-white font-bold flex items-center justify-center"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="<?php echo buildUrl(['page' => $i]); ?>" class="w-10 h-10 rounded-full text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors font-bold flex items-center justify-center"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if($page < $totalPages): ?>
                    <a href="<?php echo buildUrl(['page' => $page + 1]); ?>" class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:border-primary hover:text-primary transition-colors"><span class="material-symbols-outlined">chevron_right</span></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </section>
    </form>
</main>

<script>
function toggleWishlist(btn, productId) {
    // Prevent form submission if it's inside the filter form
    if(event) event.preventDefault();
    
    fetch('actions/wishlist_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const icon = btn.querySelector('.material-symbols-outlined');
            if (data.action === 'added') {
                icon.style.fontVariationSettings = "'FILL' 1";
                icon.style.color = '#dc2626'; // tailwind red-600
            } else {
                icon.style.fontVariationSettings = "'FILL' 0";
                icon.style.color = 'inherit';
            }
        } else {
            alert(data.message || 'خطایی رخ داد.');
            if (data.message === 'ابتدا وارد حساب کاربری شوید.') {
                window.location.href = 'login.php';
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function addToCart(btn, productId) {
    if(event) event.preventDefault();
    
    // show loading state on button
    const originalText = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> در حال افزودن...';
    
    fetch('actions/cart_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=add&ajax=1&csrf_token=<?php echo csrf_token(); ?>&product_id=' + productId
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            btn.innerHTML = '<span class="material-symbols-outlined">check_circle</span> اضافه شد';
            btn.classList.add('bg-status-active');
            
            // Revert after 2 seconds
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.remove('bg-status-active');
            }, 2000);
        } else {
            alert('خطا در افزودن به سبد خرید');
            btn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        btn.innerHTML = originalText;
    });
}
</script>

<?php include 'includes/footer.php'; ?>
