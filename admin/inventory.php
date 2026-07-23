<?php
$currentPage = 'inventory';
require_once 'includes/admin_header.php';

// Handle Add/Edit Product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $stmt = $pdo->prepare("INSERT INTO products (name, category, price, discount_price, image_url, description, stock, brand) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'], $_POST['category'], $_POST['price'], 
            $_POST['discount_price'] ?: null, $_POST['image_url'], 
            $_POST['description'], $_POST['stock'] ?: 10, $_POST['brand']
        ]);
    } elseif ($_POST['action'] === 'edit') {
        $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, price=?, discount_price=?, image_url=?, description=?, stock=?, brand=? WHERE id=?");
        $stmt->execute([
            $_POST['name'], $_POST['category'], $_POST['price'], 
            $_POST['discount_price'] ?: null, $_POST['image_url'], 
            $_POST['description'], $_POST['stock'] ?: 10, $_POST['brand'], $_POST['product_id']
        ]);
    } elseif ($_POST['action'] === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$_POST['product_id']]);
    }
    header("Location: inventory.php");
    exit;
}

// Fetch Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();

// Statistics
$totalProducts = count($products);
$outOfStock = count(array_filter($products, fn($p) => $p['stock'] <= 0));
$lowStock = count(array_filter($products, fn($p) => $p['stock'] > 0 && $p['stock'] < 5));
?>

<!-- Main Dashboard Canvas -->
<div class="p-8 max-w-[1400px] mx-auto">
    <!-- Page Header & Quick Action -->
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-1">مدیریت انبار و فروشگاه</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">وضعیت لحظه‌ای فروشگاه و موجودی کالاها</p>
        </div>
        <button onclick="openModal('add')" class="flex items-center gap-2 bg-secondary-container text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl active:scale-95 transition-all">
            <span class="material-symbols-outlined">add</span>
            <span>افزودن محصول جدید</span>
        </button>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30 flex items-center justify-between">
            <div>
                <p class="text-label-sm text-on-surface-variant mb-1">کل محصولات</p>
                <p class="text-display-lg font-bold text-primary"><?= $totalProducts ?></p>
            </div>
            <div class="w-12 h-12 bg-primary-container/10 rounded-lg flex items-center justify-center text-primary-container">
                <span class="material-symbols-outlined text-[32px]">inventory_2</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30 flex items-center justify-between group hover:border-error transition-colors">
            <div>
                <p class="text-label-sm text-error font-bold mb-1">ناموجود</p>
                <p class="text-display-lg font-bold text-error"><?= $outOfStock ?></p>
            </div>
            <div class="w-12 h-12 bg-error/10 rounded-lg flex items-center justify-center text-error">
                <span class="material-symbols-outlined text-[32px]">block</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30 flex items-center justify-between group hover:border-status-warning transition-colors">
            <div>
                <p class="text-label-sm text-status-warning font-bold mb-1">رو به اتمام (کمتر از ۵)</p>
                <p class="text-display-lg font-bold text-status-warning"><?= $lowStock ?></p>
            </div>
            <div class="w-12 h-12 bg-status-warning/10 rounded-lg flex items-center justify-center text-status-warning">
                <span class="material-symbols-outlined text-[32px]">warning</span>
            </div>
        </div>
    </div>

    <!-- Inventory List (Detailed High-Density Card Layout) -->
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead class="bg-surface-container-low border-b border-outline-variant/50">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold text-primary">جزئیات محصول</th>
                        <th class="px-6 py-4 text-sm font-bold text-primary">دسته‌بندی</th>
                        <th class="px-6 py-4 text-sm font-bold text-primary">قیمت (تومان)</th>
                        <th class="px-6 py-4 text-sm font-bold text-primary">وضعیت موجودی</th>
                        <th class="px-6 py-4 text-sm font-bold text-primary">تاریخ ثبت</th>
                        <th class="px-6 py-4 text-sm font-bold text-primary">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    <?php foreach ($products as $product): ?>
                    <tr class="hover:bg-surface-container-lowest transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg border border-outline-variant/20 overflow-hidden flex-shrink-0">
                                    <img class="w-full h-full object-cover" src="<?= htmlspecialchars($product['image_url'] ?: 'https://placehold.co/100?text=No+Image') ?>" alt="Product">
                                </div>
                                <div>
                                    <p class="font-label-lg text-label-lg text-primary"><?= htmlspecialchars($product['name']) ?></p>
                                    <p class="text-[11px] text-on-surface-variant font-mono"><?= htmlspecialchars($product['brand'] ?: 'بدون برند') ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full bg-primary-fixed-dim/30 text-primary text-[11px] font-bold"><?= htmlspecialchars($product['category']) ?></span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col items-start">
                                <p class="font-bold text-sm"><?= number_format($product['price']) ?></p>
                                <?php if($product['discount_price']): ?>
                                    <p class="text-[10px] text-error line-through"><?= number_format($product['discount_price']) ?></p>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <?php if ($product['stock'] <= 0): ?>
                                    <span class="w-2 h-2 rounded-full bg-error"></span>
                                    <p class="text-sm font-bold text-error">ناموجود</p>
                                <?php elseif ($product['stock'] < 5): ?>
                                    <span class="w-2 h-2 rounded-full bg-status-warning"></span>
                                    <p class="text-sm font-bold text-status-warning"><?= $product['stock'] ?> عدد (رو به اتمام)</p>
                                <?php else: ?>
                                    <span class="w-2 h-2 rounded-full bg-status-active"></span>
                                    <p class="text-sm font-bold text-status-active"><?= $product['stock'] ?> عدد</p>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant"><?= substr($product['created_at'], 0, 10) ?></td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button onclick='openModal("edit", <?= json_encode($product) ?>)' class="p-2 text-on-surface-variant hover:text-primary transition-colors" title="ویرایش">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </button>
                                <form method="POST" onsubmit="return confirm('آیا از حذف این محصول اطمینان دارید؟');" class="inline">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors" title="حذف">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Product Modal -->
<div id="productModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-outline-variant/30 flex justify-between items-center">
            <h3 id="modalTitle" class="font-title-lg text-title-lg text-primary">افزودن محصول جدید</h3>
            <button onclick="closeModal()" class="text-on-surface-variant hover:text-error transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form id="productForm" method="POST" class="space-y-4">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="product_id" id="productId" value="">
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-on-surface-variant">نام محصول</label>
                        <input type="text" name="name" id="productName" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-on-surface-variant">دسته‌بندی</label>
                        <select name="category" id="productCategory" required class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                            <option value="Food">غذا</option>
                            <option value="Accessories">لوازم جانبی</option>
                            <option value="Pharmacy">داروخانه</option>
                            <option value="Toys">اسباب‌بازی</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-on-surface-variant">برند</label>
                        <input type="text" name="brand" id="productBrand" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-on-surface-variant">موجودی انبار</label>
                        <input type="number" name="stock" id="productStock" required min="0" value="10" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-on-surface-variant">قیمت اصلی (تومان)</label>
                        <input type="number" name="price" id="productPrice" required min="0" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-bold text-on-surface-variant">قیمت با تخفیف (اختیاری)</label>
                        <input type="number" name="discount_price" id="productDiscountPrice" min="0" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary">
                    </div>
                </div>
                
                <div class="space-y-1">
                    <label class="text-sm font-bold text-on-surface-variant">آدرس تصویر (URL)</label>
                    <input type="url" name="image_url" id="productImageUrl" class="w-full rounded-lg border-outline-variant text-left focus:ring-primary focus:border-primary" dir="ltr">
                </div>
                
                <div class="space-y-1">
                    <label class="text-sm font-bold text-on-surface-variant">توضیحات</label>
                    <textarea name="description" id="productDescription" rows="3" class="w-full rounded-lg border-outline-variant focus:ring-primary focus:border-primary"></textarea>
                </div>
                
                <div class="pt-4 flex justify-end gap-3 border-t border-outline-variant/30">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container transition-colors">انصراف</button>
                    <button type="submit" class="px-6 py-2 rounded-lg font-bold bg-primary text-white hover:bg-primary-container transition-colors">ذخیره محصول</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openModal(mode, product = null) {
    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');
    const title = document.getElementById('modalTitle');
    
    if (mode === 'edit' && product) {
        title.innerText = 'ویرایش محصول';
        document.getElementById('formAction').value = 'edit';
        document.getElementById('productId').value = product.id;
        document.getElementById('productName').value = product.name;
        document.getElementById('productCategory').value = product.category;
        document.getElementById('productBrand').value = product.brand || '';
        document.getElementById('productStock').value = product.stock;
        document.getElementById('productPrice').value = product.price;
        document.getElementById('productDiscountPrice').value = product.discount_price || '';
        document.getElementById('productImageUrl').value = product.image_url || '';
        document.getElementById('productDescription').value = product.description || '';
    } else {
        title.innerText = 'افزودن محصول جدید';
        form.reset();
        document.getElementById('formAction').value = 'add';
        document.getElementById('productId').value = '';
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
