<?php
$currentPage = 'orders';
require_once 'includes/admin_header.php';

// Fetch orders
$stmt = $pdo->query("SELECT o.*, u.name as user_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC LIMIT 50");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-8 max-w-[1400px] mx-auto">
    <!-- Header Section -->
    <header class="flex justify-between items-center mb-8">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-primary">مدیریت سفارشات</h2>
            <p class="text-on-surface-variant font-body-md mt-1">پیگیری سفارشات، پرداخت‌ها و ارسال‌ها</p>
        </div>
        <div class="flex gap-4">
            <a href="export_orders.php" class="flex items-center gap-2 bg-secondary-container text-on-secondary-container px-6 py-2 rounded-lg font-label-lg font-bold shadow-sm hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined">download</span>
                خروجی CSV (سفارشات امروز)
            </a>
        </div>
    </header>

    <!-- Orders Table -->
    <section class="bg-white rounded-2xl shadow-sm overflow-hidden border border-outline-variant/30">
        <div class="p-6 border-b border-outline-variant bg-white">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="font-title-lg text-title-lg text-primary">لیست تمامی سفارشات</h3>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-right">
                <thead class="bg-surface-container-lowest border-b border-outline-variant">
                    <tr>
                        <th class="px-6 py-4 font-label-lg text-on-surface-variant">شناسه سفارش</th>
                        <th class="px-6 py-4 font-label-lg text-on-surface-variant">مشتری</th>
                        <th class="px-6 py-4 font-label-lg text-on-surface-variant">مبلغ کل (تومان)</th>
                        <th class="px-6 py-4 font-label-lg text-on-surface-variant">وضعیت</th>
                        <th class="px-6 py-4 font-label-lg text-on-surface-variant">تاریخ ثبت</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30">
                    <?php if(empty($orders)): ?>
                        <tr><td colspan="5" class="px-6 py-4 text-center text-on-surface-variant">هیچ سفارشی یافت نشد.</td></tr>
                    <?php else: ?>
                        <?php foreach($orders as $order): ?>
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-6 py-4 font-bold text-primary" dir="ltr">#PC-<?= $order['id'] ?></td>
                            <td class="px-6 py-4 text-on-surface-variant"><?= htmlspecialchars($order['user_name']) ?></td>
                            <td class="px-6 py-4 font-bold"><?= number_format($order['total_amount']) ?></td>
                            <td class="px-6 py-4">
                                <?php 
                                $status_class = '';
                                $status_text = '';
                                switch($order['status']) {
                                    case 'pending_payment': $status_class = 'bg-status-warning/20 text-status-warning'; $status_text = 'در انتظار پرداخت'; break;
                                    case 'processing': $status_class = 'bg-primary-fixed text-on-primary-fixed-variant'; $status_text = 'در حال پردازش'; break;
                                    case 'shipped': $status_class = 'bg-secondary-fixed text-on-secondary-fixed'; $status_text = 'ارسال شده'; break;
                                    case 'delivered': $status_class = 'bg-status-active/20 text-status-active'; $status_text = 'تحویل شده'; break;
                                    case 'cancelled': $status_class = 'bg-error-container text-error'; $status_text = 'لغو شده'; break;
                                    default: $status_class = 'bg-surface-variant text-on-surface-variant'; $status_text = htmlspecialchars($order['status']); break;
                                }
                                ?>
                                <span class="<?= $status_class ?> px-3 py-1 rounded-full text-[11px] font-bold"><?= $status_text ?></span>
                            </td>
                            <td class="px-6 py-4 text-on-surface-variant text-sm font-body-md" dir="ltr">
                                <?= $order['created_at'] ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
