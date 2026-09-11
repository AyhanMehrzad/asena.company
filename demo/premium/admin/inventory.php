<?php
$currentPage = 'inventory';
require_once 'includes/admin_header.php';

// Check columns
$has_animal_col = false;
$has_autoship_col = false;
try {
    $col_check = $pdo->query("SHOW COLUMNS FROM products");
    $columns = $col_check->fetchAll(PDO::FETCH_COLUMN);
    $has_animal_col = in_array('target_animal', $columns);
    $has_autoship_col = in_array('is_autoship', $columns);
} catch (Exception $e) {}

// Handle Add/Edit Product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    require_once '../includes/functions.php';
    csrf_verify();
    
    $action = $_POST['action'];
    $target_animal = $_POST['target_animal'] ?? 'all';
    $is_autoship = isset($_POST['is_autoship']) ? 1 : 0;
    $autoship_discount = (int)($_POST['autoship_discount'] ?? 10);

    if ($action === 'add') {
        $baseline_rating = !empty($_POST['baseline_rating']) ? (float)$_POST['baseline_rating'] : 4.8;
        if ($has_animal_col && $has_autoship_col) {
            $stmt = $pdo->prepare("INSERT INTO products (name, category, price, discount_price, image_url, description, stock, brand, target_animal, is_autoship, autoship_discount, baseline_rating, rating_cache) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                trim($_POST['name']), trim($_POST['category']), (int)$_POST['price'], 
                empty($_POST['discount_price']) ? null : (int)$_POST['discount_price'], trim($_POST['image_url']), 
                trim($_POST['description']), (int)($_POST['stock'] ?: 10), trim($_POST['brand']),
                $target_animal, $is_autoship, $autoship_discount, $baseline_rating, $baseline_rating
            ]);
            $new_pid = $pdo->lastInsertId();
            recalculate_bayesian_rating($pdo, 'product', $new_pid);
        } else {
            $stmt = $pdo->prepare("INSERT INTO products (name, category, price, discount_price, image_url, description, stock, brand, baseline_rating, rating_cache) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                trim($_POST['name']), trim($_POST['category']), (int)$_POST['price'], 
                empty($_POST['discount_price']) ? null : (int)$_POST['discount_price'], trim($_POST['image_url']), 
                trim($_POST['description']), (int)($_POST['stock'] ?: 10), trim($_POST['brand']), $baseline_rating, $baseline_rating
            ]);
        }
        header("Location: inventory.php");
        exit;
    } elseif ($action === 'edit') {
        $pid = (int)$_POST['product_id'];
        $baseline_rating = !empty($_POST['baseline_rating']) ? (float)$_POST['baseline_rating'] : 4.8;
        if ($has_animal_col && $has_autoship_col) {
            $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, price=?, discount_price=?, image_url=?, description=?, stock=?, brand=?, target_animal=?, is_autoship=?, autoship_discount=?, baseline_rating=? WHERE id=?");
            $stmt->execute([
                trim($_POST['name']), trim($_POST['category']), (int)$_POST['price'], 
                empty($_POST['discount_price']) ? null : (int)$_POST['discount_price'], trim($_POST['image_url']), 
                trim($_POST['description']), (int)($_POST['stock'] ?: 10), trim($_POST['brand']),
                $target_animal, $is_autoship, $autoship_discount, $baseline_rating, $pid
            ]);
            recalculate_bayesian_rating($pdo, 'product', $pid);
        } else {
            $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, price=?, discount_price=?, image_url=?, description=?, stock=?, brand=?, baseline_rating=? WHERE id=?");
            $stmt->execute([
                trim($_POST['name']), trim($_POST['category']), (int)$_POST['price'], 
                empty($_POST['discount_price']) ? null : (int)$_POST['discount_price'], trim($_POST['image_url']), 
                trim($_POST['description']), (int)($_POST['stock'] ?: 10), trim($_POST['brand']), $baseline_rating, $pid
            ]);
        }
        header("Location: inventory.php");
        exit;
    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([(int)$_POST['product_id']]);
    }
    header("Location: inventory.php");
    exit;
}

// Filter Tab
$tab = $_GET['tab'] ?? 'all';
$query_where = "";
if ($tab === 'autoship') {
    $query_where = "WHERE is_autoship = 1";
}

// Fetch Products
$stmt = $pdo->query("SELECT * FROM products $query_where ORDER BY created_at DESC");
$products = $stmt->fetchAll();

// Statistics
$allCountStmt = $pdo->query("SELECT COUNT(*) FROM products");
$totalProducts = $allCountStmt->fetchColumn();

$outOfStock = count(array_filter($products, fn($p) => $p['stock'] <= 0));
$lowStock = count(array_filter($products, fn($p) => $p['stock'] > 0 && $p['stock'] < 5));

$animal_names = [
    'dog' => 'سگ 🐕',
    'cat' => 'گربه 🐈',
    'bird' => 'پرندگان 🦜',
    'smallpet' => 'جوندگان 🐹',
    'all' => 'همه پت‌ها 🐾'
];
?>

<!-- Main Dashboard Canvas -->
<div class="p-6 md:p-8 max-w-7xl mx-auto space-y-8">
    
    <!-- Top Action Banner -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 shadow-sm">
        <div>
            <h1 class="text-headline-md font-bold text-primary mb-1">مدیریت موجودی انبار پت‌شاپ</h1>
            <p class="text-body-sm text-on-surface-variant">کنترل موجودی کالاها، قیمت‌گذاری و سهمیه‌بندی اشتراک خودکار (Autoship)</p>
        </div>
        <button onclick="openModal('add')" class="w-full sm:w-auto px-6 py-3 bg-primary text-white rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-primary-container transition-all shadow-md">
            <span class="material-symbols-outlined">add_box</span>
            <span>افزودن محصول جدید</span>
        </button>
    </div>

    <!-- Inventory KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-label-sm text-on-surface-variant font-bold mb-1">کل محصولات فعال</p>
                <p class="text-display-lg font-bold text-primary"><?= $totalProducts ?></p>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[32px]">inventory_2</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-label-sm text-status-danger font-bold mb-1">کالاهای ناموجود</p>
                <p class="text-display-lg font-bold text-status-danger"><?= $outOfStock ?></p>
            </div>
            <div class="w-12 h-12 bg-status-danger/10 rounded-lg flex items-center justify-center text-status-danger">
                <span class="material-symbols-outlined text-[32px]">production_quantity_limits</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-label-sm text-status-warning font-bold mb-1">رو به اتمام (کمتر از ۵)</p>
                <p class="text-display-lg font-bold text-status-warning"><?= $lowStock ?></p>
            </div>
            <div class="w-12 h-12 bg-status-warning/10 rounded-lg flex items-center justify-center text-status-warning">
                <span class="material-symbols-outlined text-[32px]">warning</span>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex items-center gap-3 mb-6 overflow-x-auto pb-2">
        <a href="inventory.php" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all <?= $tab === 'all' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-container border border-outline-variant/30' ?>">
            همه کالاها (<?= $totalProducts ?>)
        </a>
        <a href="inventory.php?tab=autoship" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all flex items-center gap-1.5 <?= $tab === 'autoship' ? 'bg-status-active text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-container border border-outline-variant/30' ?>">
            <span class="material-symbols-outlined text-[18px]">autorenew</span>
            کالاهای دارای تحویل خودکار (Autoship)
        </a>
    </div>

    <!-- Explanation Banner for Autoship Tab -->
    <?php if ($tab === 'autoship'): ?>
    <div class="bg-gradient-to-r from-primary/10 via-secondary-container/10 to-primary/5 p-6 rounded-3xl border border-primary/20 mb-8 shadow-sm">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-secondary-container text-white flex items-center justify-center flex-shrink-0 shadow-md">
                    <span class="material-symbols-outlined text-2xl">all_inclusive</span>
                </div>
                <div>
                    <h4 class="font-bold text-primary text-base mb-1">انبار اختصاصی و سهمیه‌بندی اشتراک‌ها (Subscription Inventory Allocation)</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed max-w-3xl">
                        برای جلوگیری از ناموجود شدن اقلام مشتریان دارای <strong>اشتراک و تحویل دوره‌ای (Autoship)</strong>، موجودی کل این کالاها به دو بخش <strong>«سهمیه رزرو شده اشتراک‌ها»</strong> و <strong>«موجودی آزاد فروشگاه عادی»</strong> تفکیک شده است.
                    </p>
                </div>
            </div>
            <a href="subscriptions.php" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-container text-white text-xs font-bold transition-all shadow-sm shrink-0 flex items-center gap-1.5">
                <span class="material-symbols-outlined text-base">calendar_month</span>
                مشاهده نوبت‌های ارسال
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Inventory List -->
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead class="bg-surface-container-low border-b border-outline-variant/50 text-xs text-primary">
                    <?php if ($tab === 'autoship'): ?>
                    <tr>
                        <th class="px-6 py-4 font-bold">جزئیات کالا</th>
                        <th class="px-6 py-4 font-bold">دسته‌بندی و گونه</th>
                        <th class="px-6 py-4 font-bold">موجودی کل انبار</th>
                        <th class="px-6 py-4 font-bold">تخفیف اشتراک</th>
                        <th class="px-6 py-4 font-bold">سهمیه رزرو اشتراک‌ها</th>
                        <th class="px-6 py-4 font-bold">موجودی آزاد فروش عادی</th>
                        <th class="px-6 py-4 font-bold">وضعیت تامین سهمیه</th>
                        <th class="px-6 py-4 font-bold">عملیات</th>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <th class="px-6 py-4 font-bold">جزئیات کالا</th>
                        <th class="px-6 py-4 font-bold">دسته‌بندی</th>
                        <th class="px-6 py-4 font-bold">گونه هدف</th>
                        <th class="px-6 py-4 font-bold">قیمت (تومان)</th>
                        <th class="px-6 py-4 font-bold">Autoship</th>
                        <th class="px-6 py-4 font-bold">موجودی</th>
                        <th class="px-6 py-4 font-bold">عملیات</th>
                    </tr>
                    <?php endif; ?>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    <?php if(empty($products)): ?>
                        <tr><td colspan="<?= $tab === 'autoship' ? '8' : '7' ?>" class="px-6 py-8 text-center text-on-surface-variant">هیچ کالایی در این دسته‌بندی یافت نشد.</td></tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                        <?php 
                            $total_stock = (int)$product['stock'];
                            $reserved_stock = max(1, min($total_stock, (int)ceil($total_stock * 0.25))); // 25% allocated for active subscribers
                            $free_stock = max(0, $total_stock - $reserved_stock);
                        ?>
                        <tr class="hover:bg-surface-container-lowest transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl border border-outline-variant/20 overflow-hidden flex-shrink-0 bg-surface-container-low">
                                        <img class="w-full h-full object-cover" src="<?= htmlspecialchars($product['image_url'] ?: 'assets/images/toy-mouse.jpg') ?>" alt="Product">
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-primary"><?= htmlspecialchars($product['name']) ?></p>
                                        <p class="text-[11px] text-on-surface-variant font-mono"><?= htmlspecialchars($product['brand'] ?: 'بدون برند') ?></p>
                                    </div>
                                </div>
                            </td>

                            <?php if ($tab === 'autoship'): ?>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <span class="text-xs font-bold text-primary"><?= htmlspecialchars($product['category']) ?></span>
                                    <span class="text-[11px] text-on-surface-variant"><?= $animal_names[$product['target_animal'] ?? 'all'] ?? 'همه پت‌ها' ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-sm text-primary"><?= $total_stock ?> عدد</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded-full bg-status-active/15 text-status-active text-xs font-black"><?= (int)($product['autoship_discount'] ?? 10) ?>% تخفیف</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-secondary-container"></span>
                                    <span class="font-bold text-sm text-secondary-container"><?= $reserved_stock ?> عدد</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-sm <?= $free_stock > 0 ? 'text-on-surface' : 'text-status-danger' ?>"><?= $free_stock ?> عدد</span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($total_stock <= 0): ?>
                                    <span class="px-2.5 py-1 rounded-full bg-status-danger/10 text-status-danger text-xs font-bold">بحرانی / ناموجود</span>
                                <?php elseif($free_stock <= 0): ?>
                                    <span class="px-2.5 py-1 rounded-full bg-status-warning/15 text-status-warning text-xs font-bold">فقط سهمیه مشترکین</span>
                                <?php else: ?>
                                    <span class="px-2.5 py-1 rounded-full bg-status-active/10 text-status-active text-xs font-bold">وضعیت پایدار</span>
                                <?php endif; ?>
                            </td>
                            <?php else: ?>
                            <td class="px-6 py-4">
                                <span class="text-xs text-on-surface-variant font-bold"><?= htmlspecialchars($product['category']) ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-lg bg-surface-container text-xs font-medium text-primary">
                                    <?= $animal_names[$product['target_animal'] ?? 'all'] ?? 'همه پت‌ها' ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs">
                                <?php if(!empty($product['discount_price'])): ?>
                                    <span class="font-bold text-status-danger text-sm block"><?= number_format($product['discount_price']) ?></span>
                                    <span class="line-through text-on-surface-variant text-[11px]"><?= number_format($product['price']) ?></span>
                                <?php else: ?>
                                    <span class="font-bold text-primary text-sm"><?= number_format($product['price']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if(!empty($product['is_autoship'])): ?>
                                    <span class="px-2.5 py-1 rounded-full bg-status-active/15 text-status-active text-xs font-bold flex items-center gap-1 w-fit">
                                        <span class="material-symbols-outlined text-[14px]">autorenew</span>
                                        <?= (int)($product['autoship_discount'] ?? 10) ?>%
                                    </span>
                                <?php else: ?>
                                    <span class="text-on-surface-variant text-xs">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold <?= $product['stock'] > 5 ? 'bg-status-active/10 text-status-active' : ($product['stock'] > 0 ? 'bg-status-warning/10 text-status-warning' : 'bg-status-danger/10 text-status-danger') ?>">
                                    <?= $product['stock'] ?> عدد
                                </span>
                            </td>
                            <?php endif; ?>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <button data-product='<?= json_encode($product, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?>' onclick="editProduct(this)" class="p-2 hover:bg-surface-container rounded-lg text-primary transition-colors" title="ویرایش">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <form method="POST" onsubmit="return confirm('آیا از حذف این محصول اطمینان دارید؟');" class="inline">
                                        <?php csrf_field(); ?>
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <button type="submit" class="p-2 hover:bg-status-danger/10 rounded-lg text-status-danger transition-colors" title="حذف">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create / Edit Product -->
<div id="productModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto space-y-6">
        <div class="flex items-center justify-between border-b border-outline-variant/30 pb-4">
            <h3 id="modalTitle" class="text-title-lg font-bold text-primary">افزودن محصول جدید</h3>
            <button onclick="closeModal()" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-full">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="productForm" method="POST" class="space-y-4">
            <?php csrf_field(); ?>
            <input type="hidden" name="action" id="form_action" value="add">
            <input type="hidden" name="product_id" id="form_product_id" value="">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">نام محصول *</label>
                    <input type="text" name="name" id="productName" required class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">دسته‌بندی اصلی *</label>
                    <select name="category" id="productCategory" required class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                        <option value="غذای سگ">غذای سگ</option>
                        <option value="غذای گربه">غذای گربه</option>
                        <option value="لوازم بهداشتی">لوازم بهداشتی و نظافت</option>
                        <option value="اسباب‌بازی">اسباب‌بازی و لوازم سرگرمی</option>
                        <option value="مکمل دارویی">مکمل‌های تقویتی و تشویقی</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">گونه هدف حیوان</label>
                    <select name="target_animal" id="productAnimal" class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                        <option value="all">همه پت‌ها (عمومی)</option>
                        <option value="dog">سگ 🐕</option>
                        <option value="cat">گربه 🐈</option>
                        <option value="bird">پرندگان 🦜</option>
                        <option value="smallpet">جوندگان 🐹</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">برند / شرکت سازنده</label>
                    <input type="text" name="brand" id="productBrand" class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">موجودی انبار *</label>
                    <input type="number" name="stock" id="productStock" required min="0" value="10" class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">قیمت اصلی (تومان) *</label>
                    <input type="number" name="price" id="productPrice" required min="0" class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">قیمت ویژه تخفیف‌دار (تومان)</label>
                    <input type="number" name="discount_price" id="productDiscountPrice" min="0" class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-on-surface-variant">امتیاز اولیه کارشناسی (Baseline Quality)</label>
                    <input type="number" step="0.1" min="1" max="5" name="baseline_rating" id="productBaselineRating" value="4.8" class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
                </div>
            </div>

            <!-- Autoship Options -->
            <div class="bg-surface-container-low p-4 rounded-2xl border border-outline-variant/30 flex items-center justify-between">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_autoship" id="productIsAutoship" value="1" class="w-5 h-5 rounded text-primary focus:ring-primary">
                    <div>
                        <span class="text-sm font-bold text-primary block">فعالسازی ارسال خودکار دوره‌ای (Autoship)</span>
                        <span class="text-xs text-on-surface-variant">مشتری می‌تواند سفارش تکرارشونده را ثبت کند.</span>
                    </div>
                </label>
                <div class="flex items-center gap-2">
                    <label class="text-xs font-bold text-on-surface-variant">درصد تخفیف اشتراک:</label>
                    <input type="number" name="autoship_discount" id="productAutoshipDiscount" min="0" max="90" value="10" class="w-16 rounded-xl border border-outline-variant p-1.5 text-center text-sm font-bold">
                    <span class="text-xs text-on-surface-variant">%</span>
                </div>
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-on-surface-variant">لینک تصویر محصول</label>
                <input type="url" name="image_url" id="productImageUrl" placeholder="https://..." class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary">
            </div>

            <div class="space-y-1">
                <label class="text-xs font-bold text-on-surface-variant">توضیحات محصول</label>
                <textarea name="description" id="productDescription" rows="3" class="w-full rounded-xl border border-outline-variant p-2.5 text-sm outline-none focus:border-primary"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-outline-variant/30">
                <button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl border border-outline-variant text-on-surface-variant text-sm font-bold hover:bg-surface-container">انصراف</button>
                <button type="submit" class="px-6 py-2.5 bg-primary hover:bg-primary-container text-white rounded-xl text-sm font-bold shadow-md">ذخیره تغییرات</button>
            </div>
        </form>
    </div>
</div>

<script>
function editProduct(btn) {
    try {
        const raw = btn.getAttribute('data-product');
        const product = JSON.parse(raw);
        openModal('edit', product);
    } catch(e) {
        console.error('Error parsing product data:', e);
    }
}

function openModal(mode, product = null) {
    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');
    const title = document.getElementById('modalTitle');
    
    if (mode === 'edit' && product) {
        title.innerText = 'ویرایش محصول';
        document.getElementById('form_action').value = 'edit';
        document.getElementById('form_product_id').value = product.id;
        document.getElementById('productName').value = product.name || '';
        document.getElementById('productCategory').value = product.category || 'غذای سگ';
        document.getElementById('productAnimal').value = product.target_animal || 'all';
        document.getElementById('productBrand').value = product.brand || '';
        document.getElementById('productStock').value = product.stock ?? 10;
        document.getElementById('productPrice').value = product.price || 0;
        document.getElementById('productDiscountPrice').value = product.discount_price || '';
        document.getElementById('productBaselineRating').value = product.baseline_rating || 4.8;
        document.getElementById('productImageUrl').value = product.image_url || '';
        document.getElementById('productDescription').value = product.description || '';
        document.getElementById('productIsAutoship').checked = (product.is_autoship == 1);
        document.getElementById('productAutoshipDiscount').value = product.autoship_discount || 10;
    } else {
        title.innerText = 'افزودن محصول جدید';
        form.reset();
        document.getElementById('form_action').value = 'add';
        document.getElementById('form_product_id').value = '';
        document.getElementById('productBaselineRating').value = '4.8';
        document.getElementById('productAnimal').value = 'all';
        document.getElementById('productIsAutoship').checked = false;
        document.getElementById('productAutoshipDiscount').value = 10;
    }
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('productModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

<?php require_once 'includes/admin_footer.php'; ?>
