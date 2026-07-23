<?php
require_once 'includes/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: loginpage.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = $_SESSION['profile_success'] ?? '';
$error = $_SESSION['profile_error'] ?? '';
unset($_SESSION['profile_success'], $_SESSION['profile_error']);

// Fetch user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch user pets
$stmt = $pdo->prepare("SELECT * FROM user_pets WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch pet documents
$stmt = $pdo->prepare("SELECT d.*, p.name as pet_name FROM pet_documents d JOIN user_pets p ON d.pet_id = p.id WHERE d.user_id = ? ORDER BY d.uploaded_at DESC");
$stmt->execute([$user_id]);
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch upcoming appointments
$stmt = $pdo->prepare("
    SELECT a.*, d.name as doctor_name, d.specialty as doctor_specialty, d.image_url as doctor_image 
    FROM appointments a 
    JOIN doctors d ON a.doctor_id = d.id 
    WHERE a.user_id = ? AND a.appointment_date >= CURDATE()
    ORDER BY a.appointment_date ASC, a.appointment_time ASC
    LIMIT 4
");
$stmt->execute([$user_id]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch recent orders
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch active subscriptions
$stmt = $pdo->prepare("
    SELECT s.*, p.name as product_name, p.image_url as product_image 
    FROM subscriptions s 
    JOIN products p ON s.product_id = p.id 
    WHERE s.user_id = ? AND s.status = 'active'
    ORDER BY s.next_delivery_date ASC
");
$stmt->execute([$user_id]);
$subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php require_once 'includes/header.php'; ?>
<style>
    .persian-number {
        font-feature-settings: "ss01", "ss02", "ss03", "ss04";
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>
<!-- SideNavBar -->
<aside class="fixed right-0 top-16 bottom-0 w-64 p-6 flex flex-col bg-surface-container-lowest border-l border-outline-variant hidden md:flex">
<div class="mb-10">
<h2 class="text-lg font-bold text-primary">پنل کاربری</h2>
<p class="text-xs text-on-surface-variant">خدمات حرفه‌ای حیوانات خانگی</p>
</div>
<nav class="flex-1 flex flex-col gap-1">
<a class="flex items-center gap-3 px-4 py-3 bg-primary-container text-white rounded-xl font-bold transition-all" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="text-sm">پیشخوان</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">calendar_today</span>
<span class="text-sm">نوبت‌های من</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">event_repeat</span>
<span class="text-sm">اشتراک‌های فعال</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">history</span>
<span class="text-sm">تاریخچه سفارشات</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">medical_services</span>
<span class="text-sm">سوابق پزشکی</span>
</a>
<?php if(isset($user['role']) && $user['role'] === 'admin'): ?>
<a class="flex items-center gap-3 px-4 py-3 text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all font-bold" href="admin/index.php">
<span class="material-symbols-outlined">admin_panel_settings</span>
<span class="text-sm">پنل مدیریت سایت</span>
</a>
<?php endif; ?>
</nav>
<div class="pt-6 border-t border-outline-variant flex flex-col gap-1">
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="usr_profile_settings.php">
<span class="material-symbols-outlined">settings</span>
<span class="text-sm">تنظیمات</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">help</span>
<span class="text-sm">پشتیبانی</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-all" href="logout.php">
<span class="material-symbols-outlined">logout</span>
<span class="text-sm">خروج</span>
</a>
</div>
</aside>
<!-- Main Content -->
<main class="mr-64 mt-16 p-8 min-h-screen">
<div class="max-w-[1200px] mx-auto space-y-8">
<?php if ($success): ?>
    <div class="bg-status-active/10 text-status-active p-4 rounded-xl flex items-center gap-3 border border-status-active/20">
        <span class="material-symbols-outlined">check_circle</span>
        <span class="font-bold text-sm"><?php echo htmlspecialchars($success); ?></span>
    </div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="bg-error/10 text-error p-4 rounded-xl flex items-center gap-3 border border-error/20">
        <span class="material-symbols-outlined">error</span>
        <span class="font-bold text-sm"><?php echo htmlspecialchars($error); ?></span>
    </div>
<?php endif; ?>
<!-- Profile Overview Card (Intelligent Dashboard style) -->
<section class="glass-card rounded-2xl p-8 border border-outline-variant shadow-lg flex flex-col lg:flex-row justify-between items-center gap-8 relative overflow-hidden">
<div class="absolute top-0 right-0 w-32 h-32 bg-primary-container/5 rounded-full -mr-16 -mt-16"></div>
<div class="flex items-center gap-6 relative z-10">
<div class="w-20 h-20 rounded-2xl bg-primary-container flex items-center justify-center text-white font-bold text-3xl shadow-inner">
                    <?php echo mb_substr(htmlspecialchars($user['name'] ?? 'ک'), 0, 1, 'UTF-8'); ?>
                </div>
<div>
<h2 class="text-2xl font-bold text-on-surface"><?php echo htmlspecialchars($user['name'] ?? 'کاربر مهمان'); ?> عزیز، خوش آمدید</h2>
<p class="text-sm text-on-surface-variant">
    <?php if(count($pets) > 0): ?>
        والدِ <span class="font-bold text-primary"><?php echo htmlspecialchars(implode(' و ', array_column($pets, 'name'))); ?></span> • 
    <?php endif; ?>
    عضو سطح طلایی
</p>
</div>
</div>
<div class="flex gap-4 items-center relative z-10">
<div class="flex flex-col items-center bg-white px-6 py-4 rounded-2xl border border-outline-variant shadow-sm min-w-[140px]">
<p class="text-[10px] uppercase tracking-wider text-on-surface-variant font-bold mb-1">امتیاز وفاداری</p>
<p class="text-2xl font-bold text-secondary persian-number"><?php echo number_format($user['loyalty_points'] ?? 0); ?></p>
</div>
<div class="flex flex-col items-center bg-primary-container text-white px-6 py-4 rounded-2xl shadow-md min-w-[180px]">
<p class="text-[10px] uppercase tracking-wider opacity-80 font-bold mb-1">نوبت بعدی</p>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-sm">calendar_month</span>
<?php if (!empty($appointments)): ?>
    <p class="text-base font-bold persian-number"><?php 
        $next_date = new DateTime($appointments[0]['appointment_date']);
        echo IntlDateFormatter::formatObject($next_date, 'd MMMM', 'fa') . ' - ' . substr($appointments[0]['appointment_time'], 0, 5); 
    ?></p>
<?php else: ?>
    <p class="text-base font-bold">ندارید</p>
<?php endif; ?>
</div>
</div>
</div>
<a href="bookingpage.php" class="bg-primary-container text-white px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-primary transition-all active:scale-95 shadow-lg shadow-primary-container/20 flex items-center gap-2">
                رزرو نوبت جدید
            </a>
</section>
<!-- Grid Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- Right Column: Appointments & History -->
<div class="lg:col-span-8 space-y-8">
<!-- Upcoming Appointments (High Fidelity) -->
<div class="bg-surface-container-lowest rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
<div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center">
<h3 class="text-lg font-bold text-primary flex items-center gap-2">
<span class="material-symbols-outlined">medical_information</span>
                            نوبت‌های پیش رو
                        </h3>
<button class="text-sm font-bold text-primary-container hover:underline">مشاهده همه</button>
</div>
<div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
<?php if (empty($appointments)): ?>
    <div class="col-span-full text-center py-8 text-on-surface-variant">
        <span class="material-symbols-outlined text-4xl mb-2 opacity-50">calendar_month</span>
        <p class="font-bold">شما هیچ نوبت رزرو شده‌ای ندارید.</p>
        <a href="bookingpage.php" class="text-primary-container hover:underline text-sm mt-2 inline-block">برای رزرو نوبت کلیک کنید</a>
    </div>
<?php else: ?>
    <?php foreach ($appointments as $apt): ?>
        <div class="group border border-outline-variant p-5 rounded-2xl flex flex-col gap-4 hover:border-primary-container hover:shadow-xl transition-all duration-300">
        <div class="flex gap-4">
        <div class="relative">
        <img alt="<?php echo htmlspecialchars($apt['doctor_name']); ?>" class="w-16 h-16 rounded-xl object-cover" src="<?php echo htmlspecialchars($apt['doctor_image'] ?? 'https://via.placeholder.com/150'); ?>"/>
        <span class="absolute -bottom-1 -right-1 w-5 h-5 bg-status-active border-2 border-white rounded-full"></span>
        </div>
        <div class="flex-1">
        <div class="flex justify-between items-start">
        <h4 class="text-base font-bold text-primary"><?php echo htmlspecialchars($apt['doctor_name']); ?></h4>
        <div class="flex items-center gap-0.5 text-status-warning">
        <span class="text-[10px] bg-primary-container/10 text-primary-container px-2 py-0.5 rounded-full font-bold"><?php echo htmlspecialchars($apt['status'] == 'pending' ? 'در انتظار' : 'تایید شده'); ?></span>
        </div>
        </div>
        <p class="text-xs text-on-surface-variant font-medium"><?php echo htmlspecialchars($apt['doctor_specialty']); ?></p>
        <?php if (!empty($apt['pet_type'])): ?>
            <div class="mt-2 flex gap-1">
            <span class="text-[10px] bg-secondary/10 text-secondary px-2 py-0.5 rounded-full font-bold">حیوان: <?php echo htmlspecialchars($apt['pet_type']); ?></span>
            </div>
        <?php endif; ?>
        </div>
        </div>
        <div class="bg-surface-container-low p-3 rounded-xl flex justify-between items-center persian-number text-xs font-bold">
        <div class="flex items-center gap-1.5 text-on-surface-variant">
        <span class="material-symbols-outlined text-base">calendar_today</span>
        <span><?php 
            $apt_date = new DateTime($apt['appointment_date']);
            echo IntlDateFormatter::formatObject($apt_date, 'd MMMM YYYY', 'fa'); 
        ?></span>
        </div>
        <div class="flex items-center gap-1.5 text-on-surface-variant">
        <span class="material-symbols-outlined text-base">schedule</span>
        <span>ساعت <?php echo substr($apt['appointment_time'], 0, 5); ?></span>
        </div>
        </div>
        <?php if ($apt['status'] == 'approved'): ?>
            <button class="w-full bg-primary-container text-white py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 hover:brightness-110 transition-all">
            <span class="material-symbols-outlined text-lg">videocam</span>
                                            ورود به اتاق مشاوره
                                        </button>
        <?php else: ?>
            <button class="w-full border-2 border-primary-container text-primary-container py-2 rounded-xl text-sm font-bold flex items-center justify-center gap-2 hover:bg-primary-container hover:text-white transition-all">
            <span class="material-symbols-outlined text-lg">map</span>
                                            مشاهده آدرس کلینیک
                                        </button>
        <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>
</div>
<!-- Order History (Clean Table) -->
<div class="bg-surface-container-lowest rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
<div class="px-6 py-4 border-b border-outline-variant flex justify-between items-center">
<h3 class="text-lg font-bold text-primary flex items-center gap-2">
<span class="material-symbols-outlined">shopping_bag</span>
                            آخرین سفارشات
                        </h3>
<button class="text-sm font-bold text-primary-container hover:underline">تاریخچه کامل</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-right text-sm">
<thead>
<tr class="bg-surface-container-low text-on-surface-variant font-bold border-b border-outline-variant">
<th class="px-6 py-4">شناسه سفارش</th>
<th class="px-6 py-4">تاریخ</th>
<th class="px-6 py-4">وضعیت</th>
<th class="px-6 py-4">مبلغ کل</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant persian-number font-medium">
<?php if(empty($orders)): ?>
<tr>
    <td colspan="4" class="px-6 py-8 text-center text-on-surface-variant font-bold">هیچ سفارشی یافت نشد.</td>
</tr>
<?php else: ?>
    <?php foreach($orders as $order): ?>
    <tr class="hover:bg-primary-container/5 transition-colors">
    <td class="px-6 py-5 font-bold text-primary">#PC-<?php echo $order['id']; ?></td>
    <td class="px-6 py-5 text-on-surface-variant">
        <?php 
        $order_date = new DateTime($order['created_at']);
        echo IntlDateFormatter::formatObject($order_date, 'Y/MM/dd', 'fa'); 
        ?>
    </td>
    <td class="px-6 py-5">
        <?php 
        $status_bg = 'bg-surface-container-high';
        $status_text = 'text-on-surface';
        $status_label = $order['status'];
        
        switch($order['status']) {
            case 'pending_payment': $status_bg = 'bg-orange-100'; $status_text = 'text-orange-800'; $status_label = 'در انتظار پرداخت'; break;
            case 'processing': $status_bg = 'bg-blue-100'; $status_text = 'text-blue-800'; $status_label = 'در حال پردازش'; break;
            case 'shipped': $status_bg = 'bg-indigo-100'; $status_text = 'text-indigo-800'; $status_label = 'ارسال شده'; break;
            case 'delivered': $status_bg = 'bg-status-active/10'; $status_text = 'text-status-active'; $status_label = 'تحویل شده'; break;
            case 'cancelled': $status_bg = 'bg-error/10'; $status_text = 'text-error'; $status_label = 'لغو شده'; break;
        }
        ?>
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full <?php echo $status_bg; ?> <?php echo $status_text; ?> text-xs font-bold">
            <?php echo $status_label; ?>
        </span>
    </td>
    <td class="px-6 py-5 font-bold text-on-surface"><?php echo number_format($order['total_amount']); ?> تومان</td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Left Column: Subscriptions & Records -->
<div class="lg:col-span-4 space-y-8">
<!-- Subscriptions (Visual Autoship) -->
<div class="bg-surface-container-lowest rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
<div class="px-6 py-4 border-b border-outline-variant flex items-center justify-between">
<h3 class="text-lg font-bold text-primary flex items-center gap-2">
<span class="material-symbols-outlined">cached</span>
                            اشتراک‌های فعال
                        </h3>
</div>
<div class="p-6 space-y-4">
<?php if(empty($subscriptions)): ?>
    <p class="text-sm text-on-surface-variant text-center py-4">شما هیچ اشتراک فعالی ندارید.</p>
<?php else: ?>
    <?php foreach($subscriptions as $sub): ?>
    <div class="p-4 border border-outline-variant rounded-2xl flex items-center gap-4 hover:border-primary-container transition-all group relative overflow-hidden bg-white shadow-sm">
    <div class="absolute top-0 right-0 bg-secondary text-white px-3 py-0.5 text-[9px] font-bold rounded-bl-xl">ارسال خودکار</div>
    <img alt="Product" class="w-16 h-16 object-contain rounded-lg p-1 border border-outline-variant" src="<?php echo htmlspecialchars($sub['product_image']); ?>"/>
    <div class="flex-1">
    <h4 class="text-sm font-bold text-on-surface"><?php echo htmlspecialchars($sub['product_name']); ?></h4>
    <p class="text-[11px] text-on-surface-variant persian-number mt-0.5">تکرار: هر <?php echo $sub['frequency_days']; ?> روز یک‌بار</p>
    <div class="mt-2 flex items-center gap-1.5 text-status-active font-bold text-xs persian-number">
    <span class="material-symbols-outlined text-[16px]">local_shipping</span>
                                        ارسال بعدی: <?php 
        $next_del = new DateTime($sub['next_delivery_date']);
        echo IntlDateFormatter::formatObject($next_del, 'd MMMM YYYY', 'fa'); 
        ?>
                                    </div>
    </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
<button class="w-full border-2 border-dashed border-outline-variant text-on-surface-variant py-4 rounded-2xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-white hover:border-primary-container hover:text-primary transition-all group">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">add_circle</span>
                            افزودن اشتراک جدید
                        </button>
</div>
</div>
<!-- Medical Records (Workstation style) -->
<div class="bg-surface-container-lowest rounded-2xl border border-outline-variant shadow-sm overflow-hidden mb-8">
<div class="px-6 py-4 border-b border-outline-variant bg-white flex items-center justify-between">
<h3 class="text-lg font-bold text-primary flex items-center gap-2">
<span class="material-symbols-outlined">pets</span>
            حیوانات خانگی من
        </h3>
</div>
<div class="p-6 space-y-4">
<?php if(empty($pets)): ?>
    <p class="text-sm text-on-surface-variant">هنوز حیوان خانگی ثبت نکرده‌اید.</p>
<?php else: ?>
    <?php foreach($pets as $pet): ?>
    <div class="flex items-center gap-4 p-3 border border-outline-variant rounded-xl hover:border-primary-container transition-all">
        <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center text-primary-container">
            <span class="material-symbols-outlined"><?php echo $pet['type'] == 'گربه' ? 'cat' : 'dog'; ?></span>
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-bold text-on-surface"><?php echo htmlspecialchars($pet['name']); ?></h4>
            <p class="text-[11px] text-on-surface-variant">
                <?php echo htmlspecialchars($pet['type']); ?> 
                <?php if(!empty($pet['race'])) echo ' • ' . htmlspecialchars($pet['race']); ?>
                <?php if(!empty($pet['gender'])) echo ' • ' . htmlspecialchars($pet['gender']); ?>
                <?php if(!empty($pet['age'])) echo ' • سن: ' . htmlspecialchars($pet['age']); ?>
            </p>
        </div>
        <div class="flex gap-2">
            <span onclick="openEditPetModal(<?php echo $pet['id']; ?>, '<?php echo addslashes(htmlspecialchars($pet['name'])); ?>', '<?php echo addslashes(htmlspecialchars($pet['type'])); ?>', '<?php echo addslashes(htmlspecialchars($pet['race'])); ?>', '<?php echo addslashes(htmlspecialchars($pet['gender'] ?? '')); ?>', '<?php echo addslashes(htmlspecialchars($pet['age'] ?? '')); ?>')" class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-primary">edit</span>
            <form action="profile_action.php" method="POST" onsubmit="return confirm('آیا از حذف این حیوان خانگی اطمینان دارید؟');" class="inline">
                <input type="hidden" name="action" value="delete_pet">
                <input type="hidden" name="pet_id" value="<?php echo $pet['id']; ?>">
                <button type="submit" class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-error bg-transparent border-0 p-0 m-0 flex items-center">delete</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
<!-- Add New Pet Button/Form Area -->
<div class="pt-2">
<button onclick="document.getElementById('addPetModal').classList.remove('hidden')" class="w-full border-2 border-dashed border-outline-variant text-on-surface-variant py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2 hover:bg-white hover:border-primary-container hover:text-primary transition-all group">
<span class="material-symbols-outlined group-hover:scale-110 transition-transform">add_circle</span>
                افزودن حیوان جدید
            </button>
</div>
</div>
</div><div class="bg-surface-container-lowest rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
<div class="px-6 py-4 border-b border-outline-variant bg-white flex justify-between items-center">
<h3 class="text-lg font-bold text-primary flex items-center gap-2">
<span class="material-symbols-outlined">description</span>
                            سوابق پزشکی <?php echo count($pets) > 0 ? htmlspecialchars(implode(' و ', array_column($pets, 'name'))) : ''; ?>
                        </h3>
<button onclick="document.getElementById('addDocModal').classList.remove('hidden')" class="text-sm font-bold text-primary flex items-center gap-1 hover:underline">
    <span class="material-symbols-outlined text-sm">add</span> آپلود
</button>
</div>
<div class="p-6 space-y-4">
<?php if(empty($documents)): ?>
    <p class="text-sm text-on-surface-variant">هیچ سندی آپلود نشده است.</p>
<?php else: ?>
    <?php foreach($documents as $doc): ?>
    <a href="<?php echo htmlspecialchars($doc['file_path']); ?>" download class="group p-4 bg-surface-container-low rounded-2xl flex items-center justify-between cursor-pointer hover:bg-white hover:shadow-md border border-transparent hover:border-primary-container transition-all">
    <div class="flex items-center gap-4">
    <div class="p-3 bg-status-active/10 text-status-active rounded-xl group-hover:scale-105 transition-transform">
    <span class="material-symbols-outlined">description</span>
    </div>
    <div>
    <h4 class="text-sm font-bold text-on-surface"><?php echo htmlspecialchars($doc['title']); ?> - <?php echo htmlspecialchars($doc['pet_name']); ?></h4>
    <p class="text-[11px] text-on-surface-variant font-medium persian-number mt-0.5">آپلود شده در: <?php echo date('Y/m/d', strtotime($doc['uploaded_at'])); ?></p>
    </div>
    </div>
    <span class="material-symbols-outlined text-on-surface-variant group-hover:-translate-x-1 transition-transform">download</span>
    </a>
    <?php endforeach; ?>
<?php endif; ?>
<a href="download_all.php" class="w-full bg-primary-container text-white py-4 rounded-2xl font-bold text-sm flex items-center justify-center gap-3 hover:shadow-xl transition-all shadow-lg shadow-primary-container/20">
<span class="material-symbols-outlined">download</span>
                            دریافت پرونده کامل سلامت (ZIP)
                        </a>
</div>
</div>
</div>
</div>
</div>
</main>

<!-- Add Pet Modal -->
<div id="addPetModal" class="hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl relative">
        <button onclick="document.getElementById('addPetModal').classList.add('hidden')" class="absolute top-4 left-4 text-on-surface-variant hover:text-error"><span class="material-symbols-outlined">close</span></button>
        <h2 class="text-xl font-bold text-primary mb-6">ثبت حیوان جدید</h2>
        <form action="profile_action.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="add_pet">
            <div>
                <label class="block text-sm font-bold mb-1">نام حیوان</label>
                <input type="text" name="pet_name" required class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">نوع حیوان</label>
                <select name="pet_type" required class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
                    <option value="">انتخاب کنید...</option>
                    <option value="سگ">سگ</option>
                    <option value="گربه">گربه</option>
                    <option value="پرنده">پرنده</option>
                    <option value="جونده">جونده</option>
                    <option value="سایر">سایر</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">نژاد (اختیاری)</label>
                <input type="text" name="pet_race" class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-1">جنسیت</label>
                    <select name="pet_gender" class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
                        <option value="">نامشخص</option>
                        <option value="نر">نر</option>
                        <option value="ماده">ماده</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">سن</label>
                    <input type="text" name="pet_age" placeholder="مثال: ۲ سال" class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
                </div>
            </div>
            <button type="submit" class="w-full bg-primary-container text-white py-3 rounded-xl font-bold mt-4 hover:bg-primary transition-colors">ثبت مشخصات</button>
        </form>
    </div>
</div>

<!-- Edit Pet Modal -->
<div id="editPetModal" class="hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl relative">
        <button onclick="document.getElementById('editPetModal').classList.add('hidden')" class="absolute top-4 left-4 text-on-surface-variant hover:text-error"><span class="material-symbols-outlined">close</span></button>
        <h2 class="text-xl font-bold text-primary mb-6">ویرایش حیوان خانگی</h2>
        <form action="profile_action.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="edit_pet">
            <input type="hidden" name="pet_id" id="edit_pet_id" value="">
            <div>
                <label class="block text-sm font-bold mb-1">نام حیوان</label>
                <input type="text" name="pet_name" id="edit_pet_name" required class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">نوع حیوان</label>
                <select name="pet_type" id="edit_pet_type" required class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
                    <option value="">انتخاب کنید...</option>
                    <option value="سگ">سگ</option>
                    <option value="گربه">گربه</option>
                    <option value="پرنده">پرنده</option>
                    <option value="جونده">جونده</option>
                    <option value="سایر">سایر</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">نژاد (اختیاری)</label>
                <input type="text" name="pet_race" id="edit_pet_race" class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-1">جنسیت</label>
                    <select name="pet_gender" id="edit_pet_gender" class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
                        <option value="">نامشخص</option>
                        <option value="نر">نر</option>
                        <option value="ماده">ماده</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-1">سن</label>
                    <input type="text" name="pet_age" id="edit_pet_age" class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
                </div>
            </div>
            <button type="submit" class="w-full bg-primary-container text-white py-3 rounded-xl font-bold mt-4 hover:bg-primary transition-colors">ذخیره تغییرات</button>
        </form>
    </div>
</div>

<!-- Add Document Modal -->
<div id="addDocModal" class="hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl relative">
        <button onclick="document.getElementById('addDocModal').classList.add('hidden')" class="absolute top-4 left-4 text-on-surface-variant hover:text-error"><span class="material-symbols-outlined">close</span></button>
        <h2 class="text-xl font-bold text-primary mb-6">آپلود سند جدید</h2>
        <form action="profile_action.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="action" value="upload_document">
            <div>
                <label class="block text-sm font-bold mb-1">حیوان مربوطه</label>
                <select name="pet_id" required class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
                    <option value="">انتخاب کنید...</option>
                    <?php foreach($pets as $pet): ?>
                        <option value="<?php echo $pet['id']; ?>"><?php echo htmlspecialchars($pet['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">عنوان سند (مانند: واکسن هاری)</label>
                <input type="text" name="doc_title" required class="w-full border border-outline-variant rounded-lg p-2 focus:ring-2 focus:ring-primary-container outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">انتخاب فایل (PDF, JPG, PNG)</label>
                <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png" required class="w-full border border-outline-variant rounded-lg p-2 text-sm">
            </div>
            <button type="submit" class="w-full bg-primary-container text-white py-3 rounded-xl font-bold mt-4 hover:bg-primary transition-colors">آپلود فایل</button>
        </form>
    </div>
</div>
<!-- Floating Chat Button -->
<button class="fixed bottom-8 left-8 w-14 h-14 bg-primary-container text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50 group">
<span class="material-symbols-outlined text-[28px]">chat_bubble</span>
<span class="absolute right-16 bg-white text-primary-container px-4 py-2 rounded-xl shadow-xl border border-outline-variant font-bold text-sm opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
        پشتیبانی آنلاین پت‌کر
    </span>
</button>
<script>
    function openEditPetModal(id, name, type, race, gender, age) {
        document.getElementById('edit_pet_id').value = id;
        document.getElementById('edit_pet_name').value = name;
        document.getElementById('edit_pet_type').value = type;
        document.getElementById('edit_pet_race').value = race;
        document.getElementById('edit_pet_gender').value = gender;
        document.getElementById('edit_pet_age').value = age;
        document.getElementById('editPetModal').classList.remove('hidden');
    }

    // Micro-interactions and initialization
    window.addEventListener('load', () => {
        document.querySelectorAll('.glass-card, .rounded-2xl').forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = 'all 0.6s cubic-bezier(0.22, 1, 0.36, 1)';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
</body></html>