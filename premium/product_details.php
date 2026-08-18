<?php
require_once 'includes/header.php';

$product_id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$product_id) {
    header('Location: shop.php');
    exit;
}

// Get product details
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: shop.php');
    exit;
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_review') {
    if (!isset($_SESSION['user_id'])) {
        $error = "برای ثبت نظر باید وارد حساب کاربری شوید.";
    } else {
        $rating = (int)$_POST['rating'];
        $comment = trim($_POST['comment']);
        
        if ($rating >= 1 && $rating <= 5) {
            $stmt = $pdo->prepare("INSERT INTO reviews (user_id, target_type, target_id, rating, comment, status) VALUES (?, 'product', ?, ?, ?, 'approved')");
            $stmt->execute([$_SESSION['user_id'], $product_id, $rating, $comment]);
            $success = "نظر شما با موفقیت ثبت شد.";
        }
    }
}

// Get reviews
$stmt = $pdo->prepare("
    SELECT r.*, u.name as user_name 
    FROM reviews r 
    JOIN users u ON r.user_id = u.id 
    WHERE r.target_type = 'product' AND r.target_id = ? AND r.status = 'approved'
    ORDER BY r.created_at DESC
");
$stmt->execute([$product_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate average rating
$avg_rating = 0;
if (count($reviews) > 0) {
    $sum = 0;
    foreach ($reviews as $rev) $sum += $rev['rating'];
    $avg_rating = round($sum / count($reviews), 1);
}
?>

<main class="max-w-container-max mx-auto overflow-hidden py-12 px-margin-desktop min-h-[70vh]">
    <div class="text-label-sm text-on-surface-variant mb-8">
        <a href="index.php" class="hover:underline">خانه</a> > 
        <a href="shop.php" class="hover:underline">فروشگاه</a> > 
        <span class="text-on-surface"><?php echo htmlspecialchars($product['name']); ?></span>
    </div>

    <!-- Product Header -->
    <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-xl border border-outline-variant/20 flex flex-col md:flex-row gap-12 mb-12">
        <div class="md:w-1/3 aspect-square bg-surface-container-lowest rounded-3xl overflow-hidden relative border border-outline-variant/30">
            <?php if($product['discount_price']): ?>
                <div class="absolute top-6 left-6 bg-secondary-container text-on-secondary-container text-label-sm px-3 py-1 rounded-full z-10 font-bold">تخفیف ویژه</div>
            <?php endif; ?>
            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="w-full h-full object-cover" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="md:w-2/3 flex flex-col">
            <span class="text-label-md text-primary bg-primary-container/10 px-3 py-1 rounded-full w-fit mb-4"><?php echo htmlspecialchars($product['category']); ?></span>
            <h1 class="text-headline-lg font-bold text-on-surface mb-6"><?php echo htmlspecialchars($product['name']); ?></h1>
            
            <div class="flex items-center gap-4 mb-8 pb-8 border-b border-outline-variant/30">
                <div class="flex items-center text-status-warning">
                    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="font-bold persian-number mr-1 mt-0.5"><?php echo $avg_rating; ?></span>
                </div>
                <span class="text-on-surface-variant text-label-sm persian-number">(<?php echo count($reviews); ?> دیدگاه)</span>
            </div>

            <div class="mb-8 text-body-lg text-on-surface-variant leading-relaxed">
                <?php echo nl2br(htmlspecialchars($product['description'] ?? 'توضیحاتی برای این محصول ثبت نشده است.')); ?>
            </div>

            <div class="mt-auto flex flex-col sm:flex-row items-center gap-6">
                <div class="flex flex-col flex-1">
                    <?php if($product['discount_price']): ?>
                        <span class="text-title-md text-on-surface-variant line-through mb-1 persian-number"><?php echo number_format($product['price']); ?> تومان</span>
                        <span class="text-display-sm font-bold text-primary persian-number"><?php echo number_format($product['discount_price']); ?> تومان</span>
                    <?php else: ?>
                        <span class="text-display-sm font-bold text-primary persian-number"><?php echo number_format($product['price']); ?> تومان</span>
                    <?php endif; ?>
                </div>
                
                <button type="button" onclick="addToCart(this, <?php echo $product['id']; ?>)" class="w-full sm:w-auto bg-primary text-white px-10 py-4 rounded-2xl font-bold flex items-center justify-center gap-3 hover:bg-primary-container transition-all shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    افزودن به سبد خرید
                </button>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <section class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-title-lg font-bold text-on-surface">نظرات کاربران</h2>
        </div>

        <?php if(isset($success)): ?>
            <div class="bg-status-active/10 text-status-active p-4 rounded-xl mb-6 font-bold text-sm border border-status-active/20"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if(isset($error)): ?>
            <div class="bg-error/10 text-error p-4 rounded-xl mb-6 font-bold text-sm border border-error/20"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Add Review Form -->
        <div class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 mb-8 shadow-sm">
            <?php if(isset($_SESSION['user_id'])): ?>
            <h3 class="font-bold text-on-surface mb-4">ثبت نظر جدید</h3>
            <form action="product_details.php?id=<?php echo $product_id; ?>" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="submit_review">
                
                <div>
                    <label class="block text-sm font-bold mb-2">امتیاز شما</label>
                    <div class="flex flex-row-reverse justify-end gap-1 rating-stars">
                        <input type="radio" name="rating" value="5" id="star5" class="hidden" required><label for="star5" class="material-symbols-outlined cursor-pointer text-outline-variant hover:text-status-warning text-3xl transition-colors">star</label>
                        <input type="radio" name="rating" value="4" id="star4" class="hidden"><label for="star4" class="material-symbols-outlined cursor-pointer text-outline-variant hover:text-status-warning text-3xl transition-colors">star</label>
                        <input type="radio" name="rating" value="3" id="star3" class="hidden"><label for="star3" class="material-symbols-outlined cursor-pointer text-outline-variant hover:text-status-warning text-3xl transition-colors">star</label>
                        <input type="radio" name="rating" value="2" id="star2" class="hidden"><label for="star2" class="material-symbols-outlined cursor-pointer text-outline-variant hover:text-status-warning text-3xl transition-colors">star</label>
                        <input type="radio" name="rating" value="1" id="star1" class="hidden"><label for="star1" class="material-symbols-outlined cursor-pointer text-outline-variant hover:text-status-warning text-3xl transition-colors">star</label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold mb-2">متن نظر</label>
                    <textarea name="comment" rows="4" required class="w-full border border-outline-variant rounded-xl p-4 focus:ring-2 focus:ring-primary-container outline-none text-sm resize-none" placeholder="نظرتان را درباره این محصول بنویسید..."></textarea>
                </div>
                
                <button type="submit" class="bg-primary-container text-white px-8 py-3 rounded-xl font-bold hover:bg-primary transition-all">ثبت نظر</button>
            </form>
            <style>
                .rating-stars label:hover,
                .rating-stars label:hover ~ label,
                .rating-stars input:checked ~ label {
                    color: #eab308; /* text-status-warning / yellow-500 */
                    font-variation-settings: 'FILL' 1;
                }
            </style>
            <?php else: ?>
                <div class="text-center py-6">
                    <p class="text-on-surface-variant font-bold mb-4">برای ثبت نظر ابتدا وارد حساب کاربری خود شوید.</p>
                    <a href="login.php" class="inline-block bg-primary text-white px-8 py-3 rounded-xl font-bold">ورود به سایت</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Reviews List -->
        <div class="space-y-4">
            <?php if(empty($reviews)): ?>
                <p class="text-center text-on-surface-variant py-8 border border-outline-variant/30 rounded-3xl border-dashed">اولین نفری باشید که نظر می‌دهد!</p>
            <?php else: ?>
                <?php foreach($reviews as $rev): ?>
                    <div class="bg-white p-6 rounded-3xl border border-outline-variant/30 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center font-bold text-on-surface-variant">
                                    <?php echo mb_substr($rev['user_name'] ?? 'ک', 0, 1, 'UTF-8'); ?>
                                </div>
                                <div>
                                    <h4 class="font-bold text-on-surface text-sm"><?php echo htmlspecialchars($rev['user_name'] ?? 'کاربر'); ?></h4>
                                    <p class="text-[11px] text-on-surface-variant persian-number"><?php echo date('Y/m/d', strtotime($rev['created_at'])); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center text-status-warning">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' <?php echo $i <= $rev['rating'] ? '1' : '0'; ?>;">star</span>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <p class="text-body-sm text-on-surface-variant leading-relaxed">
                            <?php echo nl2br(htmlspecialchars($rev['comment'])); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
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
