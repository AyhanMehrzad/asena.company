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
</nav>
<div class="pt-6 border-t border-outline-variant flex flex-col gap-1">
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="usr_profile_settings.php">
<span class="material-symbols-outlined">settings</span>
<span class="text-sm">تنظیمات</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="usr_rewards.php">
<span class="material-symbols-outlined">card_giftcard</span>
<span class="text-sm">امتیاز وفاداری و جوایز</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container-low rounded-xl transition-all" href="#">
<span class="material-symbols-outlined">help</span>
<span class="text-sm">پشتیبانی</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-all" href="#">
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
<p class="text-2xl font-bold text-secondary persian-number">۲,۴۵۰</p>
</div>
<div class="flex flex-col items-center bg-primary-container text-white px-6 py-4 rounded-2xl shadow-md min-w-[180px]">
<p class="text-[10px] uppercase tracking-wider opacity-80 font-bold mb-1">نوبت بعدی</p>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-sm">calendar_month</span>
<p class="text-base font-bold persian-number">۱۵ آبان - ۱۰:۳۰</p>
</div>
</div>
</div>
<button class="bg-primary-container text-white px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-primary transition-all active:scale-95 shadow-lg shadow-primary-container/20">
                رزرو نوبت جدید
            </button>
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
<!-- Appointment Card 1 -->
<div class="group border border-outline-variant p-5 rounded-2xl flex flex-col gap-4 hover:border-primary-container hover:shadow-xl transition-all duration-300">
<div class="flex gap-4">
<div class="relative">
<img alt="Dr Sarah" class="w-16 h-16 rounded-xl object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5_Jx1aoOWuXTAJ2zSWrBLb1gUGiQ0-0cjAGS1EXtBhzrc76bij05wKJddSvUcvgccLIPVP7fzOUftCncUPUO_W-CmOJFT_d5qn9C4zpUmllx0lTtfZqaxHyKCbzjRTv4zR-OXJ_oTRjUTrExoefpLE_WD0fCcIqqD0qe4u74fdV7FtvJqef0LILtnmLWh14UUPFg8XK5kInA4eRPh-zRicuxikVzTN5hzf4U62Dl36sEQE-SA6r-I"/>
<span class="absolute -bottom-1 -right-1 w-5 h-5 bg-status-active border-2 border-white rounded-full"></span>
</div>
<div class="flex-1">
<div class="flex justify-between items-start">
<h4 class="text-base font-bold text-primary">دکتر سارا احمدی</h4>
<div class="flex items-center gap-0.5 text-status-warning">
<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="text-xs font-bold text-on-surface">۴.۹</span>
</div>
</div>
<p class="text-xs text-on-surface-variant font-medium">متخصص جراحی و داخلی</p>
<div class="mt-2 flex gap-1">
<span class="text-[10px] bg-primary-container/10 text-primary-container px-2 py-0.5 rounded-full font-bold">حضوری</span>
<span class="text-[10px] bg-status-active/10 text-status-active px-2 py-0.5 rounded-full font-bold">تایید شده</span>
</div>
</div>
</div>
<div class="bg-surface-container-low p-3 rounded-xl flex justify-between items-center persian-number text-xs font-bold">
<div class="flex items-center gap-1.5 text-on-surface-variant">
<span class="material-symbols-outlined text-base">calendar_today</span>
<span>۱۵ آبان ۱۴۰۲</span>
</div>
<div class="flex items-center gap-1.5 text-on-surface-variant">
<span class="material-symbols-outlined text-base">schedule</span>
<span>ساعت ۱۰:۳۰</span>
</div>
</div>
<button class="w-full bg-primary-container text-white py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 hover:brightness-110 transition-all">
<span class="material-symbols-outlined text-lg">videocam</span>
                                ورود به اتاق مشاوره
                            </button>
</div>
<!-- Appointment Card 2 -->
<div class="group border border-outline-variant p-5 rounded-2xl flex flex-col gap-4 hover:border-primary-container hover:shadow-xl transition-all duration-300 opacity-90">
<div class="flex gap-4">
<img alt="Dr Rad" class="w-16 h-16 rounded-xl object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqYWVSdfo2U2dE8Hvmud_WOkssfQe2p1CLdLjOpWdiqSwl_rTu1X9dt3MOydwIvsqSaZEwBuREaQ2_h-t8qF8Vw2qbVObZyOHpnSm1BGETPzSk4xj18y43sPki9Ca1EbUzSWtLVdERmge2U5P3MrH2HoOyqUOcMnUwFckMGWesRdv_GxS0rX5c88qcguaNXRp_eo3p0f8jSFa-bbYbvZkS-ZkVDumkNjcZTIuL4FdOxIJYhN4GlqUM"/>
<div class="flex-1">
<h4 class="text-base font-bold text-primary">دکتر مهران راد</h4>
<p class="text-xs text-on-surface-variant font-medium">جراح متخصص داخلی</p>
<div class="mt-2 flex gap-1">
<span class="text-[10px] bg-secondary/10 text-secondary px-2 py-0.5 rounded-full font-bold">ویزیت در محل</span>
</div>
</div>
</div>
<div class="bg-surface-container-low p-3 rounded-xl flex justify-between items-center persian-number text-xs font-bold">
<div class="flex items-center gap-1.5 text-on-surface-variant">
<span class="material-symbols-outlined text-base">calendar_today</span>
<span>۲۲ آبان ۱۴۰۲</span>
</div>
<div class="flex items-center gap-1.5 text-on-surface-variant">
<span class="material-symbols-outlined text-base">schedule</span>
<span>ساعت ۱۷:۱۵</span>
</div>
</div>
<button class="w-full border-2 border-primary-container text-primary-container py-2 rounded-xl text-sm font-bold flex items-center justify-center gap-2 hover:bg-primary-container hover:text-white transition-all">
<span class="material-symbols-outlined text-lg">map</span>
                                مشاهده آدرس کلینیک
                            </button>
</div>
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
<tr class="hover:bg-primary-container/5 transition-colors">
<td class="px-6 py-5 font-bold text-primary">#PC-98231</td>
<td class="px-6 py-5 text-on-surface-variant">۱۴۰۲/۰۸/۰۵</td>
<td class="px-6 py-5">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-status-active/10 text-status-active text-xs font-bold">
                                            تحویل شده
                                        </span>
</td>
<td class="px-6 py-5 font-bold text-on-surface">۱,۲۸۰,۰۰۰ تومان</td>
</tr>
<tr class="bg-surface-container-low/30 hover:bg-primary-container/5 transition-colors">
<td class="px-6 py-5 font-bold text-primary">#PC-98105</td>
<td class="px-6 py-5 text-on-surface-variant">۱۴۰۲/۰۷/۲۸</td>
<td class="px-6 py-5">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 text-primary-container text-xs font-bold">
                                            در حال ارسال
                                        </span>
</td>
<td class="px-6 py-5 font-bold text-on-surface">۴۵۰,۰۰۰ تومان</td>
</tr>
<tr class="hover:bg-primary-container/5 transition-colors">
<td class="px-6 py-5 font-bold text-primary">#PC-97822</td>
<td class="px-6 py-5 text-on-surface-variant">۱۴۰۲/۰۷/۱۵</td>
<td class="px-6 py-5">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-status-active/10 text-status-active text-xs font-bold">
                                            تحویل شده
                                        </span>
</td>
<td class="px-6 py-5 font-bold text-on-surface">۳,۹۰۰,۰۰۰ تومان</td>
</tr>
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
<!-- Subscription Item 1 -->
<div class="p-4 border border-outline-variant rounded-2xl flex items-center gap-4 hover:border-primary-container transition-all group relative overflow-hidden bg-white shadow-sm">
<div class="absolute top-0 right-0 bg-secondary text-white px-3 py-0.5 text-[9px] font-bold rounded-bl-xl">۱۰٪ تخفیف طلایی</div>
<img alt="Product" class="w-16 h-16 object-contain rounded-lg p-1 border border-outline-variant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNNyDNeUmq7h033nVNrDsrCEN7KN6jmFtZTbvk15qfbAv2MEtT28FWh0_EijA820-DX2r4VHdnQkFdbShwIQWjI6N-6BW3dDs62E-fySgZgcuoMYsvNAHjOV-vxKoGs3uai1jZRuo0O25w_YNXKAxmC0dLoHcdD-cxZWOtrEzYWQyz0Z4VQtpzgv58apciYzJqkvtKi2K-en-HPRS0xYbCrlqU_wLjGrYzzDVEJdMNrPpweTVa71YW"/>
<div class="flex-1">
<h4 class="text-sm font-bold text-on-surface">رویال کنین - هپاتیک</h4>
<p class="text-[11px] text-on-surface-variant persian-number mt-0.5">تکرار: هر ۴ هفته یک‌بار</p>
<div class="mt-2 flex items-center gap-1.5 text-status-active font-bold text-xs persian-number">
<span class="material-symbols-outlined text-[16px]">local_shipping</span>
                                    ارسال بعدی: ۲۰ آبان
                                </div>
</div>
</div>
<!-- Subscription Item 2 -->
<div class="p-4 border border-outline-variant rounded-2xl flex items-center gap-4 hover:border-primary-container transition-all bg-white shadow-sm">
<img alt="Medicine" class="w-16 h-16 object-contain rounded-lg p-1 border border-outline-variant" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlCsXP6_QGnPSvWp08DueERbbkd3LPYhZWMiqKi7jIcmZJKnq6i19582o2gnbAozw6H7-jV1miz5ygfqrsIGRnVWEZAmaxVDNOISY2N_-qrvkrZHucQrjGTKb2Gsskiglyqn_zBWlbh2jXYo4ChOuvQYI_g7yIFcDREuBZc2ELNF83cLLmaDZQtpB4mqIpTOt-AKk_wCCyNMKSoPqlbWCCLw7NG58pCpT8gH7xliqgxJ4-nAMP7HtT"/>
<div class="flex-1">
<h4 class="text-sm font-bold text-on-surface">قرص براوکتو</h4>
<p class="text-[11px] text-on-surface-variant persian-number mt-0.5">تکرار: هر ۳ ماه یک‌بار</p>
<div class="mt-2 flex items-center gap-1.5 text-on-surface-variant font-bold text-xs persian-number">
<span class="material-symbols-outlined text-[16px]">history</span>
                                    ارسال بعدی: ۵ آذر
                                </div>
</div>
</div>
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
            <p class="text-[11px] text-on-surface-variant"><?php echo htmlspecialchars($pet['type']); ?> • <?php echo htmlspecialchars($pet['race']); ?></p>
        </div>
        <span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-primary">edit</span>
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
            <button type="submit" class="w-full bg-primary-container text-white py-3 rounded-xl font-bold mt-4 hover:bg-primary transition-colors">ثبت مشخصات</button>
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