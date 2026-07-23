<?php
$currentPage = 'dashboard';
require_once 'includes/admin_header.php';

// Fetch dynamic data for dashboard

// 1. Today's appointments
$stmt = $pdo->query("SELECT COUNT(*) as total, SUM(status='approved') as approved, SUM(status='pending') as pending FROM appointments WHERE appointment_date = CURDATE()");
$appt_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Active subscriptions
$stmt = $pdo->query("SELECT COUNT(*) as total, SUM(created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)) as recent FROM subscriptions WHERE status = 'active'");
$sub_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Loyalty points (mocking gifts)
$stmt = $pdo->query("SELECT SUM(loyalty_points) as total_points, COUNT(*) as users_count FROM users WHERE loyalty_points > 0");
$loyalty_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// 4. Inventory alerts
$stmt = $pdo->query("SELECT COUNT(*) as low_stock FROM products WHERE stock <= 5");
$inv_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// 5. Live clinic status
$stmt = $pdo->query("
    SELECT a.*, d.name as doctor_name, u.name as owner_name 
    FROM appointments a 
    JOIN doctors d ON a.doctor_id = d.id 
    JOIN users u ON a.user_id = u.id 
    WHERE a.appointment_date = CURDATE() 
    ORDER BY a.appointment_time ASC LIMIT 5
");
$live_appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 6. Top selling product
$stmt = $pdo->query("SELECT * FROM products ORDER BY stock ASC LIMIT 1");
$top_product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!-- Dashboard Content Container -->
<div class="p-8 space-y-8">
    <!-- Section 1: Overview Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card: Appointments -->
        <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30 group hover:border-primary-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-[32px]">calendar_today</span>
                </div>
                <span class="text-status-active font-label-sm flex items-center gap-1">
                    امروز
                </span>
            </div>
            <h3 class="font-label-lg text-label-lg text-on-surface-variant">نوبت‌های امروز</h3>
            <p class="font-display-lg text-display-lg text-primary mt-1"><?= (int)$appt_stats['total'] ?></p>
            <p class="text-label-sm text-on-surface-variant mt-2"><?= (int)$appt_stats['approved'] ?> نوبت تایید شده، <?= (int)$appt_stats['pending'] ?> در انتظار</p>
        </div>

        <!-- Card: Subscriptions -->
        <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30 group hover:border-secondary-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-secondary-fixed/30 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-[32px]">autorenew</span>
                </div>
                <span class="text-status-active font-label-sm flex items-center gap-1">
                    ۵٪+ <span class="material-symbols-outlined text-sm">trending_up</span>
                </span>
            </div>
            <h3 class="font-label-lg text-label-lg text-on-surface-variant">اشتراک‌های فعال (شارژ خودکار)</h3>
            <p class="font-display-lg text-display-lg text-primary mt-1"><?= number_format((int)$sub_stats['total']) ?></p>
            <p class="text-label-sm text-on-surface-variant mt-2"><?= (int)$sub_stats['recent'] ?> اشتراک جدید در این هفته</p>
        </div>

        <!-- Card: Donations -->
        <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30 group hover:border-primary-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-tertiary-fixed/30 flex items-center justify-center text-tertiary">
                    <span class="material-symbols-outlined text-[32px]">volunteer_activism</span>
                </div>
                <span class="text-status-active font-label-sm flex items-center gap-1">
                    فعال
                </span>
            </div>
            <h3 class="font-label-lg text-label-lg text-on-surface-variant">مجموع امتیاز وفاداری کاربران</h3>
            <div class="flex items-baseline gap-2 mt-1">
                <p class="font-display-lg text-display-lg text-primary"><?= number_format((int)$loyalty_stats['total_points']) ?></p>
                <span class="text-label-lg text-on-surface-variant">امتیاز</span>
            </div>
            <p class="text-label-sm text-on-surface-variant mt-2">از سمت <?= (int)$loyalty_stats['users_count'] ?> کاربر وفادار</p>
        </div>

        <!-- Card: Inventory -->
        <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30 group hover:border-error transition-colors">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-lg bg-error-container/50 flex items-center justify-center text-error">
                    <span class="material-symbols-outlined text-[32px]">warning</span>
                </div>
                <?php if($inv_stats['low_stock'] > 0): ?>
                    <span class="text-error font-bold font-label-sm">بحرانی</span>
                <?php else: ?>
                    <span class="text-status-active font-bold font-label-sm">ایمن</span>
                <?php endif; ?>
            </div>
            <h3 class="font-label-lg text-label-lg text-on-surface-variant">هشدار موجودی انبار</h3>
            <p class="font-display-lg text-display-lg text-primary mt-1"><?= (int)$inv_stats['low_stock'] ?></p>
            <p class="text-label-sm text-on-surface-variant mt-2">کالاهای زیر حد نصاب ایمنی</p>
        </div>
    </div>

    <!-- Main Layout Grid: Clinic Status & Charity Impact -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Clinic Status (2/3 Column) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl stat-card-shadow border border-outline-variant/30 overflow-hidden">
                <div class="px-6 py-5 border-b border-outline-variant/20 flex justify-between items-center">
                    <h2 class="font-title-lg text-title-lg text-primary">وضعیت زنده کلینیک</h2>
                    <a href="clinic_managment.php" class="text-primary-container font-label-lg hover:underline">مشاهده تقویم کامل</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead class="bg-surface-container-low text-on-surface-variant font-label-sm">
                            <tr>
                                <th class="px-6 py-3">صاحب حیوان</th>
                                <th class="px-6 py-3">نوع حیوان</th>
                                <th class="px-6 py-3">دامپزشک</th>
                                <th class="px-6 py-3">زمان نوبت</th>
                                <th class="px-6 py-3">وضعیت</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            <?php if (empty($live_appointments)): ?>
                                <tr><td colspan="5" class="px-6 py-4 text-center text-on-surface-variant">هیچ نوبتی برای امروز ثبت نشده است.</td></tr>
                            <?php else: ?>
                                <?php foreach ($live_appointments as $apt): ?>
                                    <tr class="hover:bg-surface-container-lowest transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-primary/5 flex items-center justify-center">
                                                    <span class="material-symbols-outlined text-primary scale-75">person</span>
                                                </div>
                                                <div>
                                                    <p class="font-label-lg text-primary"><?= htmlspecialchars($apt['owner_name']) ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-body-md"><?= htmlspecialchars($apt['pet_type']) ?></td>
                                        <td class="px-6 py-4 font-body-md text-on-surface-variant"><?= htmlspecialchars($apt['doctor_name']) ?></td>
                                        <td class="px-6 py-4 font-body-md text-primary font-bold" dir="ltr"><?= substr($apt['appointment_time'], 0, 5) ?></td>
                                        <td class="px-6 py-4">
                                            <?php 
                                            $bg = 'bg-surface-variant text-on-surface-variant';
                                            $dot = 'bg-outline';
                                            $label = 'نامشخص';
                                            if ($apt['status'] == 'pending') {
                                                $bg = 'bg-status-warning/20 text-status-warning';
                                                $dot = 'bg-status-warning';
                                                $label = 'در انتظار';
                                            } elseif ($apt['status'] == 'approved') {
                                                $bg = 'bg-primary-fixed text-on-primary-fixed';
                                                $dot = 'bg-primary';
                                                $label = 'تایید شده';
                                            } elseif ($apt['status'] == 'completed') {
                                                $bg = 'bg-status-active/20 text-status-active';
                                                $dot = 'bg-status-active';
                                                $label = 'تکمیل شده';
                                            }
                                            ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full <?= $bg ?> text-label-sm font-bold">
                                                <span class="w-1.5 h-1.5 rounded-full <?= $dot ?>"></span> <?= $label ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Inventory Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl stat-card-shadow border border-outline-variant/30">
                    <h2 class="font-title-lg text-title-lg text-primary mb-6">آیتم نیازمند توجه در انبار</h2>
                    <div class="space-y-4">
                        <?php if($top_product): ?>
                            <div class="flex items-center gap-4 group">
                                <div class="w-12 h-12 rounded bg-surface-container overflow-hidden">
                                    <img class="w-full h-full object-cover" src="../<?= htmlspecialchars($top_product['image_url']) ?>"/>
                                </div>
                                <div class="flex-1">
                                    <p class="font-label-lg text-primary"><?= htmlspecialchars($top_product['name']) ?></p>
                                    <p class="text-label-sm text-on-surface-variant"><?= number_format($top_product['price']) ?> تومان</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-label-lg <?= $top_product['stock'] <= 5 ? 'text-error' : 'text-status-active' ?>">موجود: <?= $top_product['stock'] ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-on-surface-variant">محصولی یافت نشد.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-primary-container p-6 rounded-xl stat-card-shadow flex flex-col justify-between text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="font-title-lg text-title-lg mb-2">مدیریت سریع موجودی</h3>
                        <p class="font-body-md opacity-80 mb-6">به‌روزرسانی لحظه‌ای انبار و ثبت ورود کالاهای جدید</p>
                        <a href="inventory.php" class="w-full py-3 bg-secondary-container text-white font-bold rounded-lg hover:bg-secondary transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">edit_square</span>
                            به‌روزرسانی انبار
                        </a>
                    </div>
                    <!-- Subtle abstract decoration -->
                    <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -top-8 -right-8 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
                </div>
            </div>
        </div>

        <!-- Charity Impact (1/3 Column) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-surface-container-high/50 p-6 rounded-xl border border-outline-variant/20">
                <div class="flex items-center gap-3 mb-4 text-primary">
                    <span class="material-symbols-outlined">event_note</span>
                    <h3 class="font-title-lg text-title-lg">رویدادهای امروز</h3>
                </div>
                <ul class="space-y-4">
                    <li class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-2 h-2 rounded-full bg-primary ring-4 ring-primary/10"></div>
                            <div class="w-0.5 h-full bg-outline-variant/30 mt-1"></div>
                        </div>
                        <div>
                            <p class="font-label-lg text-primary">شروع شیفت کلینیک</p>
                            <p class="text-label-sm text-on-surface-variant">ساعت ۰۸:۰۰</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-2 h-2 rounded-full bg-secondary ring-4 ring-secondary/10"></div>
                            <div class="w-0.5 h-full bg-outline-variant/30 mt-1"></div>
                        </div>
                        <div>
                            <p class="font-label-lg text-primary">بررسی سفارشات</p>
                            <p class="text-label-sm text-on-surface-variant">ساعت ۱۲:۰۰</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.stat-card-shadow').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
            card.style.transition = 'transform 0.3s ease';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
</script>

<?php require_once 'includes/admin_footer.php'; ?>
