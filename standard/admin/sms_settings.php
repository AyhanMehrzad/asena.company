<?php
$currentPage = 'sms_settings';
require_once 'includes/admin_header.php';
require_once '../includes/functions.php';
require_once '../includes/SmsService.php';

$success = '';
$error = '';
$testResult = null;
$gatewayCheck = null;

// Handle POST submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    csrf_verify();
    $action = $_POST['action'];

    if ($action === 'save_settings') {
        // Admin notification settings
        $adminPhones = trim($_POST['admin_notification_phones'] ?? '');
        $smsOnOrder  = isset($_POST['admin_sms_on_order']) ? '1' : '0';
        $smsOnBooking = isset($_POST['admin_sms_on_booking']) ? '1' : '0';
        $doctorSmsOnBooking = isset($_POST['doctor_sms_on_booking']) ? '1' : '0';

        // Gateway credentials
        $apiKey   = trim($_POST['melipayamak_api_key'] ?? '');
        $username = trim($_POST['melipayamak_username'] ?? '');
        $password = trim($_POST['melipayamak_password'] ?? '');
        $from     = trim($_POST['melipayamak_from'] ?? '');

        // Pattern Body IDs
        $bodyIds = [
            'melipayamak_body_id_otp'            => trim($_POST['melipayamak_body_id_otp'] ?? '518597'),
            'melipayamak_body_id_booking'        => trim($_POST['melipayamak_body_id_booking'] ?? '528861'),
            'melipayamak_body_id_reschedule'     => trim($_POST['melipayamak_body_id_reschedule'] ?? '528862'),
            'melipayamak_body_id_shipping'       => trim($_POST['melipayamak_body_id_shipping'] ?? '528863'),
            'melipayamak_body_id_subscription'   => trim($_POST['melipayamak_body_id_subscription'] ?? '528864'),
            'melipayamak_body_id_charity'        => trim($_POST['melipayamak_body_id_charity'] ?? '528865'),
            'melipayamak_body_id_admin_order'    => trim($_POST['melipayamak_body_id_admin_order'] ?? '528866'),
            'melipayamak_body_id_doctor_booking' => trim($_POST['melipayamak_body_id_doctor_booking'] ?? '528867'),
        ];

        // Clean and normalize phones
        $phoneArray = preg_split('/[,\s;]+/', $adminPhones);
        $cleanPhones = [];
        foreach ($phoneArray as $p) {
            $p = SmsService::normalizePhone($p);
            if (!empty($p) && strlen($p) >= 10) {
                $cleanPhones[] = $p;
            }
        }
        $savedPhonesStr = implode(', ', array_unique($cleanPhones));

        set_setting($pdo, 'admin_notification_phones', $savedPhonesStr);
        set_setting($pdo, 'admin_sms_on_order', $smsOnOrder);
        set_setting($pdo, 'admin_sms_on_booking', $smsOnBooking);
        set_setting($pdo, 'doctor_sms_on_booking', $doctorSmsOnBooking);

        set_setting($pdo, 'melipayamak_api_key', $apiKey);
        set_setting($pdo, 'melipayamak_username', $username);
        set_setting($pdo, 'melipayamak_password', $password);
        set_setting($pdo, 'melipayamak_from', $from);

        foreach ($bodyIds as $k => $v) {
            set_setting($pdo, $k, $v);
        }

        $success = "تنظیمات وب‌سرویس ملی‌پیامک، الگوها و اعلان‌ها با موفقیت در دیتابیس ذخیره شد.";
    } elseif ($action === 'check_gateway') {
        $sms = new SmsService($pdo);
        $gatewayCheck = $sms->checkCredit();
    } elseif ($action === 'test_sms') {
        $testPhone = trim($_POST['test_phone'] ?? '');
        $testType  = $_POST['test_type'] ?? 'otp';
        $testPhone = SmsService::normalizePhone($testPhone);

        if (empty($testPhone) || strlen($testPhone) < 10) {
            $error = "لطفاً یک شماره موبایل معتبر جهت تست وارد نمایید.";
        } else {
            $sms = new SmsService($pdo);
            $res = false;
            $typeName = '';
            $desc = '';

            if ($testType === 'otp') {
                $typeName = 'کد تایید اعتبارسنجی (OTP)';
                $code = rand(100000, 999999);
                $res = $sms->sendOtp($testPhone, $code);
                $desc = $res ? "کد تایید آزمایشی ($code) با موفقیت به شماره $testPhone ارسال شد." : ("خطا در ارسال OTP: " . SmsService::getLastError());
            } elseif ($testType === 'admin_order') {
                $typeName = 'هشدار سفارش جدید به مدیر';
                $fakeOrderId = rand(1050, 1999);
                $fakeAmount = 485000;
                $res = $sms->sendAdminNewOrderAlert($testPhone, $fakeOrderId, $fakeAmount);
                $desc = $res ? "پیامک هشدار سفارش (#PC-$fakeOrderId) با موفقیت ارسال شد." : ("خطا در ارسال: " . SmsService::getLastError());
            } elseif ($testType === 'doctor_booking') {
                $typeName = 'هشدار رزرو نوبت به پزشک';
                $res = $sms->sendDoctorNewAppointmentAlert($testPhone, 'دکتر نامی', 'میلو', '1404/06/20', '17:30');
                $desc = $res ? "پیامک نوبت فرضی با موفقیت ارسال شد." : ("خطا در ارسال: " . SmsService::getLastError());
            } else {
                $typeName = 'پیامک مستقیم ساده';
                $text = "تست موفقیت‌آمیز ارتباط درگاه پیامک با سامانه آسنا.\nasena.company\nزمان: " . date('H:i:s');
                $res = $sms->sendDirectSms($testPhone, $text);
                $desc = $res ? "پیامک مستقیم با موفقیت به شماره $testPhone ارسال شد." : ("خطا در ارسال مستقیم: " . SmsService::getLastError());
            }

            $testResult = [
                'ok' => (bool)$res,
                'type' => $typeName,
                'message' => $desc,
                'last_response' => SmsService::getLastResponse(),
                'last_error' => SmsService::getLastError()
            ];

            if ($testResult['ok']) {
                $success = $testResult['message'];
            } else {
                $error = $testResult['message'];
            }
        }
    }
}

// Retrieve current settings
$adminNotificationPhones = get_setting($pdo, 'admin_notification_phones', '09146676978');
$adminSmsOnOrder         = get_setting($pdo, 'admin_sms_on_order', '1');
$adminSmsOnBooking       = get_setting($pdo, 'admin_sms_on_booking', '1');
$doctorSmsOnBooking      = get_setting($pdo, 'doctor_sms_on_booking', '1');

$apiKeyVal   = get_setting($pdo, 'melipayamak_api_key', getenv('MELIPAYAMAK_API_KEY') ?: 'd3cbc1e6-79e8-4a25-910e-35e86370cad0');
$usernameVal = get_setting($pdo, 'melipayamak_username', getenv('MELIPAYAMAK_USERNAME') ?: '09146676978');
$passwordVal = get_setting($pdo, 'melipayamak_password', getenv('MELIPAYAMAK_PASSWORD') ?: 'd3cbc1e6-79e8-4a25-910e-35e86370cad0');
$fromVal     = get_setting($pdo, 'melipayamak_from', getenv('MELIPAYAMAK_FROM') ?: '50004001914667');

$phoneList = array_filter(array_map('trim', explode(',', $adminNotificationPhones)));

// Patterns list for display & configuration
$patterns = [
    [
        'id' => 'otp',
        'key' => 'melipayamak_body_id_otp',
        'name' => 'کد تایید OTP (ورود / ثبت‌نام / بازیابی)',
        'vars' => '{0} = کد تایید',
        'body_id' => SmsService::getBodyId('otp', $pdo),
        'sample' => "کاربرگرامی کد تایید شما : {0} می باشد. با تشکر. ASENA",
        'target' => 'کاربر / مشتری'
    ],
    [
        'id' => 'booking',
        'key' => 'melipayamak_body_id_booking',
        'name' => 'تایید رزرو نوبت ویزیت',
        'vars' => '{0} = تاریخ, {1} = ساعت',
        'body_id' => SmsService::getBodyId('booking', $pdo),
        'sample' => "کاربر گرامی، نوبت ویزیت شما در آسنا برای تاریخ {0} ساعت {1} با موفقیت تایید شد.\nasena.company",
        'target' => 'کاربر / بیمار'
    ],
    [
        'id' => 'reschedule',
        'key' => 'melipayamak_body_id_reschedule',
        'name' => 'تغییر زمان نوبت ویزیت',
        'vars' => '{0} = نام پزشک, {1} = نام پت, {2} = تاریخ جدید, {3} = ساعت جدید',
        'body_id' => SmsService::getBodyId('reschedule', $pdo),
        'sample' => "کاربر گرامی آسنا، زمان نوبت ویزیت پت شما ({1}) با دکتر {0} به تاریخ {2} ساعت {3} تغییر یافت.\nasena.company",
        'target' => 'کاربر / بیمار'
    ],
    [
        'id' => 'shipping',
        'key' => 'melipayamak_body_id_shipping',
        'name' => 'ارسال سفارش فروشگاه / داروخانه',
        'vars' => '{0} = شماره سفارش',
        'body_id' => SmsService::getBodyId('shipping', $pdo),
        'sample' => "سفارش شما به شماره {0} در آسنا پردازش و تحویل واحد ارسال شد.\nasena.company",
        'target' => 'خریدار'
    ],
    [
        'id' => 'subscription',
        'key' => 'melipayamak_body_id_subscription',
        'name' => 'فعال‌سازی بسته اشتراک',
        'vars' => '{0} = نام اشتراک (ماهانه/طلایی)',
        'body_id' => SmsService::getBodyId('subscription', $pdo),
        'sample' => "اشتراک {0} شما در سامانه آسنا با موفقیت فعال گردید.\nasena.company",
        'target' => 'مشترک'
    ],
    [
        'id' => 'charity',
        'key' => 'melipayamak_body_id_charity',
        'name' => 'تشکر واریز خیریه حیوانات',
        'vars' => '{0} = مبلغ واریزی به تومان',
        'body_id' => SmsService::getBodyId('charity', $pdo),
        'sample' => "کاربر گرامی، از حمایت ارزشمند شما به مبلغ {0} تومان به پویش خیریه حیوانات آسنا سپاسگزاریم.\nasena.company",
        'target' => 'نیکوکار'
    ],
    [
        'id' => 'admin_order',
        'key' => 'melipayamak_body_id_admin_order',
        'name' => 'اطلاع‌رسانی سفارش جدید به مدیر',
        'vars' => '{0} = شماره سفارش, {1} = مبلغ کل به تومان',
        'body_id' => SmsService::getBodyId('admin_order', $pdo),
        'sample' => "مدیر گرامی، سفارش جدید به شماره {0} با مبلغ {1} تومان در سامانه آسنا ثبت شد.\nasena.company",
        'target' => 'مدیران سیستم'
    ],
    [
        'id' => 'doctor_booking',
        'key' => 'melipayamak_body_id_doctor_booking',
        'name' => 'اطلاع‌رسانی نوبت جدید به پزشک',
        'vars' => '{0} = نام پزشک, {1} = نام پت, {2} = تاریخ, {3} = ساعت',
        'body_id' => SmsService::getBodyId('doctor_booking', $pdo),
        'sample' => "دکتر {0} گرامی، نوبت جدید برای پت ({1}) در تاریخ {2} ساعت {3} در آسنا ثبت شد.\nasena.company",
        'target' => 'پزشک معالج'
    ],
];
?>

<div class="p-6 lg:p-8 max-w-[1400px] mx-auto rtl">
    <!-- Page Title & Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-secondary-container/10 text-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-[30px]" style="font-variation-settings: 'FILL' 1;">sms</span>
                </div>
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary font-bold">تنظیمات درگاه پیامک ملی‌پیامک (Melipayamak Gateway)</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">مدیریت اعتبارسنجی OTP، الگوهای خدماتی، خطوط فرستنده و اعلان‌های خودکار</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="https://console.melipayamak.com" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-surface-container-lowest border border-outline-variant hover:border-secondary-container px-4 py-2.5 rounded-xl font-bold text-sm text-primary shadow-sm hover:shadow transition-all">
                <span class="material-symbols-outlined text-[20px] text-secondary-container">token</span>
                <span>کنسول ملی‌پیامک</span>
            </a>
            <a href="https://login.melipayamak.com/?module=ShareService" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-surface-container-lowest border border-outline-variant hover:border-secondary-container px-4 py-2.5 rounded-xl font-bold text-sm text-primary shadow-sm hover:shadow transition-all">
                <span class="material-symbols-outlined text-[20px] text-secondary-container">open_in_new</span>
                <span>پنل الگوهای خدماتی</span>
            </a>
        </div>
    </div>

    <!-- Alerts -->
    <?php if ($success): ?>
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl flex items-center gap-3 font-bold text-sm shadow-sm animate-fade-in">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <span><?= htmlspecialchars($success) ?></span>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl flex items-center gap-3 font-bold text-sm shadow-sm animate-fade-in">
            <span class="material-symbols-outlined text-rose-600">error</span>
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <!-- Gateway Health Check Result (If triggered) -->
    <?php if ($gatewayCheck !== null): ?>
        <div class="mb-6 p-5 rounded-2xl border <?= $gatewayCheck['ok'] ? 'bg-emerald-50/80 border-emerald-300 text-emerald-900' : 'bg-amber-50/80 border-amber-300 text-amber-900' ?> shadow-sm">
            <div class="flex items-center gap-3 mb-2 font-bold text-base">
                <span class="material-symbols-outlined <?= $gatewayCheck['ok'] ? 'text-emerald-600' : 'text-amber-600' ?>">
                    <?= $gatewayCheck['ok'] ? 'verified' : 'warning' ?>
                </span>
                <span>نتیجه بررسی سلامت و اتصال درگاه ملی‌پیامک:</span>
            </div>
            <?php if ($gatewayCheck['ok']): ?>
                <p class="text-sm font-bold text-emerald-800">
                    اتصال موفقیت‌آمیز است! موجودی فعلی حساب شما: <strong class="text-emerald-950 font-black text-lg"><?= number_format($gatewayCheck['credit']) ?></strong> ریال / پیامک (از طریق <?= $gatewayCheck['source'] ?>).
                </p>
            <?php else: ?>
                <p class="text-sm font-bold text-amber-900 mb-1">
                    <?= htmlspecialchars($gatewayCheck['error'] ?? 'خطا در برقراری ارتباط') ?>
                </p>
                <?php if (!empty($gatewayCheck['code'])): ?>
                    <p class="text-xs text-amber-800 font-mono" dir="ltr">Melipayamak Error Code: <?= (int)$gatewayCheck['code'] ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/40 stat-card-shadow flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-on-surface-variant mb-1">شماره‌های مدیران متصل</p>
                <p class="text-2xl font-black text-primary"><?= count($phoneList) ?> <span class="text-xs font-normal text-on-surface-variant">شماره</span></p>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[28px]">contact_phone</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/40 stat-card-shadow flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-on-surface-variant mb-1">پیامک اعتبارسنجی OTP</p>
                <p class="text-lg font-black text-secondary-container">فعال (پترن خدماتی)</p>
            </div>
            <div class="w-12 h-12 bg-secondary-container/10 text-secondary-container rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-[28px]">password</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/40 stat-card-shadow flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-on-surface-variant mb-1">پیامک سفارشات جدید</p>
                <p class="text-lg font-black <?= $adminSmsOnOrder === '1' ? 'text-emerald-600' : 'text-slate-400' ?>">
                    <?= $adminSmsOnOrder === '1' ? 'فعال (ارسال آنی)' : 'غیرفعال' ?>
                </p>
            </div>
            <div class="w-12 h-12 <?= $adminSmsOnOrder === '1' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-400' ?> rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-[28px]">shopping_cart_checkout</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/40 stat-card-shadow flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-on-surface-variant mb-1">مکانیزم ارسال</p>
                <p class="text-lg font-black text-emerald-600">چند لایه‌ای هوشمند</p>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                <span class="material-symbols-outlined text-[28px]">hub</span>
            </div>
        </div>
    </div>

    <!-- Main 2-Column Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
        <!-- Configuration Form (Col 7) -->
        <div class="lg:col-span-7 bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-6 lg:p-8 stat-card-shadow">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-outline-variant/30">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary-container text-[26px]">tune</span>
                    <div>
                        <h3 class="font-bold text-primary text-lg">تنظیمات اطلاعات اتصال به ملی‌پیامک</h3>
                        <p class="text-xs text-on-surface-variant">اطلاعات احراز هویت، کلیدها و شماره فرستنده را در این بخش تنظیم نمایید</p>
                    </div>
                </div>
                <form method="POST" action="sms_settings.php" class="inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="check_gateway">
                    <button type="submit" class="text-xs font-bold text-secondary-container hover:text-secondary-container/80 flex items-center gap-1 bg-secondary-container/10 px-3 py-1.5 rounded-lg transition-all">
                        <span class="material-symbols-outlined text-[16px]">sync</span>
                        <span>بررسی وضعیت درگاه</span>
                    </button>
                </form>
            </div>

            <form method="POST" action="sms_settings.php" class="space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="save_settings">

                <!-- Gateway Auth Credentials Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl bg-surface-container-low border border-outline-variant/30">
                    <div>
                        <label class="block text-xs font-bold text-primary mb-1.5">
                            توکن کنسول ملی‌پیامک (Console API Key):
                        </label>
                        <input type="text" name="melipayamak_api_key" value="<?= htmlspecialchars($apiKeyVal) ?>" class="w-full p-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg text-xs font-mono text-left outline-none focus:ring-2 focus:ring-secondary-container" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" dir="ltr">
                        <p class="text-[11px] text-on-surface-variant mt-1">از بخش کنسول REST سامانه console.melipayamak.com</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary mb-1.5">
                            نام کاربری پنل (Username):
                        </label>
                        <input type="text" name="melipayamak_username" value="<?= htmlspecialchars($usernameVal) ?>" class="w-full p-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg text-xs font-mono text-left outline-none focus:ring-2 focus:ring-secondary-container" placeholder="09146676978" dir="ltr">
                        <p class="text-[11px] text-on-surface-variant mt-1">نام کاربری یا شماره همراه ورود به پنل ملی پیامک</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary mb-1.5">
                            رمز عبور یا کلید وب‌سرویس (Password / ApiKey):
                        </label>
                        <input type="text" name="melipayamak_password" value="<?= htmlspecialchars($passwordVal) ?>" class="w-full p-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg text-xs font-mono text-left outline-none focus:ring-2 focus:ring-secondary-container" placeholder="رمز عبور یا کلید اختصاصی" dir="ltr">
                        <p class="text-[11px] text-on-surface-variant mt-1">رمز پنل یا ApiKey منوی تنظیمات -> دسترسی وب‌سرویس</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary mb-1.5">
                            شماره اختصاصی فرستنده (From Number):
                        </label>
                        <input type="text" name="melipayamak_from" value="<?= htmlspecialchars($fromVal) ?>" class="w-full p-2.5 bg-surface-container-lowest border border-outline-variant rounded-lg text-xs font-mono text-left outline-none focus:ring-2 focus:ring-secondary-container" placeholder="2170007653" dir="ltr">
                        <p class="text-[11px] text-on-surface-variant mt-1">خط اختصاصی شما جهت ارسال پیامک‌های مستقیم</p>
                    </div>
                </div>

                <!-- Admin Notification Phones -->
                <div>
                    <label class="block text-sm font-bold text-primary mb-2">
                        شماره‌های موبایل مدیران جهت دریافت پیامک:
                    </label>
                    <textarea name="admin_notification_phones" rows="2" class="w-full p-3.5 bg-surface-container-low border border-outline-variant rounded-xl text-sm font-mono text-left focus:ring-2 focus:ring-secondary-container outline-none transition-all" placeholder="09146676978, 09123456789" dir="ltr"><?= htmlspecialchars($adminNotificationPhones) ?></textarea>
                    <p class="text-xs text-on-surface-variant mt-1.5 leading-relaxed">
                        می‌توانید چند شماره موبایل را با کاما (,) یا فاصله جدا کنید. هنگام ثبت سفارش یا نوبت جدید، به همه این شماره‌ها پیامک ارسال خواهد شد.
                    </p>

                    <!-- Active Phone Chips -->
                    <?php if (!empty($phoneList)): ?>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <?php foreach ($phoneList as $p): ?>
                            <span class="inline-flex items-center gap-1.5 bg-primary/5 text-primary text-xs font-bold px-3 py-1.5 rounded-lg border border-primary/10" dir="ltr">
                                <span class="material-symbols-outlined text-[14px]">phone_iphone</span>
                                <span><?= htmlspecialchars($p) ?></span>
                            </span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Event Toggles -->
                <div class="pt-4 border-t border-outline-variant/30 space-y-4">
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">رویدادهای ارسال پیامک خودکار</p>

                    <!-- Toggle 1: Order Alert to Admin -->
                    <label class="flex items-center justify-between p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 hover:border-secondary-container/50 cursor-pointer transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-primary">ارسال پیامک به مدیر هنگام سفارش جدید</p>
                                <p class="text-xs text-on-surface-variant">اطلاع‌رسانی شماره سفارش و مبلغ به شماره‌های ثبت شده بالا</p>
                            </div>
                        </div>
                        <input type="checkbox" name="admin_sms_on_order" value="1" <?= $adminSmsOnOrder === '1' ? 'checked' : '' ?> class="w-5 h-5 text-secondary-container rounded focus:ring-secondary-container">
                    </label>

                    <!-- Toggle 2: Booking Alert to Admin -->
                    <label class="flex items-center justify-between p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 hover:border-secondary-container/50 cursor-pointer transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-primary">ارسال پیامک به مدیر هنگام ثبت نوبت ویزیت</p>
                                <p class="text-xs text-on-surface-variant">اطلاع‌رسانی فوری رزرو وقت کلینیک به مدیریت</p>
                            </div>
                        </div>
                        <input type="checkbox" name="admin_sms_on_booking" value="1" <?= $adminSmsOnBooking === '1' ? 'checked' : '' ?> class="w-5 h-5 text-secondary-container rounded focus:ring-secondary-container">
                    </label>

                    <!-- Toggle 3: Doctor Alert on Booking -->
                    <label class="flex items-center justify-between p-4 rounded-xl bg-surface-container-low border border-outline-variant/30 hover:border-secondary-container/50 cursor-pointer transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px]">stethoscope</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-primary">ارسال پیامک مستقیم به پزشک هنگام رزرو وقت</p>
                                <p class="text-xs text-on-surface-variant">ارسال جزئیات نوبت بیمار به شماره همراه پزشک معالج</p>
                            </div>
                        </div>
                        <input type="checkbox" name="doctor_sms_on_booking" value="1" <?= $doctorSmsOnBooking === '1' ? 'checked' : '' ?> class="w-5 h-5 text-secondary-container rounded focus:ring-secondary-container">
                    </label>
                </div>

                <!-- Pattern IDs Mapping Section -->
                <div class="pt-4 border-t border-outline-variant/30">
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-3">شناسه‌های کد متن الگوها در پنل (Pattern Body IDs)</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <?php foreach ($patterns as $pat): ?>
                            <div>
                                <label class="block text-[11px] font-bold text-primary mb-1">
                                    <?= htmlspecialchars($pat['name']) ?>:
                                </label>
                                <input type="text" name="<?= htmlspecialchars($pat['key']) ?>" value="<?= htmlspecialchars($pat['body_id']) ?>" class="w-full p-2 bg-surface-container-low border border-outline-variant rounded-lg text-xs font-mono text-left outline-none focus:ring-2 focus:ring-secondary-container" dir="ltr">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="pt-4 border-t border-outline-variant/30 flex justify-end">
                    <button type="submit" class="flex items-center gap-2 bg-secondary-container hover:bg-secondary-container/90 text-on-secondary-container font-bold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        <span>ذخیره تمامی تنظیمات در دیتابیس</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Testing & Diagnostic Tool (Col 5) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-6 stat-card-shadow">
                <div class="flex items-center gap-3 mb-5 pb-3 border-b border-outline-variant/30">
                    <span class="material-symbols-outlined text-secondary-container text-[24px]">send_and_archive</span>
                    <div>
                        <h3 class="font-bold text-primary text-base">ابزار تست زنده ارسال پیامک</h3>
                        <p class="text-xs text-on-surface-variant">تست ارسال کد تایید OTP و اعلان‌ها به شماره همراه دلخواه</p>
                    </div>
                </div>

                <form method="POST" action="sms_settings.php" class="space-y-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="test_sms">

                    <div>
                        <label class="block text-xs font-bold text-primary mb-1.5">شماره موبایل جهت تست:</label>
                        <input type="text" name="test_phone" value="09146676978" class="w-full p-3 bg-surface-container-low border border-outline-variant rounded-xl text-sm font-mono text-left outline-none focus:ring-2 focus:ring-secondary-container" placeholder="09146676978" dir="ltr" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-primary mb-1.5">نوع پیامک ارسالی جهت تست:</label>
                        <select name="test_type" class="w-full p-3 bg-surface-container-low border border-outline-variant rounded-xl text-xs font-bold text-primary outline-none focus:ring-2 focus:ring-secondary-container">
                            <option value="otp">کد اعتبارسنجی ورود / OTP (توصیه شده)</option>
                            <option value="admin_order">هشدار ثبت سفارش جدید به مدیر</option>
                            <option value="doctor_booking">هشدار ثبت نوبت جدید به پزشک</option>
                            <option value="direct">پیامک مستقیم متنی ساده</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary/95 text-white font-bold py-3 px-4 rounded-xl shadow transition-all">
                        <span class="material-symbols-outlined text-[20px]">send</span>
                        <span>ارسال پیامک آزمایشی</span>
                    </button>
                </form>

                <!-- Detailed Test Result -->
                <?php if ($testResult): ?>
                    <div class="mt-4 p-4 rounded-xl text-xs <?= $testResult['ok'] ? 'bg-emerald-50 text-emerald-900 border border-emerald-200' : 'bg-rose-50 text-rose-900 border border-rose-200' ?>">
                        <div class="flex items-center gap-2 font-bold mb-1.5">
                            <span class="material-symbols-outlined text-[18px]"><?= $testResult['ok'] ? 'check_circle' : 'error' ?></span>
                            <span><?= htmlspecialchars($testResult['type']) ?>: <?= $testResult['ok'] ? 'ارسال موفق' : 'خطا در ارسال' ?></span>
                        </div>
                        <p class="mb-2"><?= htmlspecialchars($testResult['message']) ?></p>
                        <?php if (!empty($testResult['last_response'])): ?>
                            <details class="mt-2 font-mono text-[10px] bg-white/70 p-2 rounded border" dir="ltr">
                                <summary class="cursor-pointer font-bold text-slate-700">View Raw API Response</summary>
                                <pre class="mt-1 whitespace-pre-wrap"><?= htmlspecialchars(print_r($testResult['last_response'], true)) ?></pre>
                            </details>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Important Panel Setup Instructions Card -->
            <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-6 stat-card-shadow">
                <div class="flex items-center gap-2 mb-3 text-secondary-container font-bold text-sm">
                    <span class="material-symbols-outlined text-[20px]">help_center</span>
                    <span>راهنمای رفع خطاهای متداول ملی‌پیامک</span>
                </div>
                <div class="space-y-2.5 text-xs text-on-surface-variant leading-relaxed">
                    <div class="p-2.5 rounded-lg bg-surface-container-low border border-outline-variant/30">
                        <strong class="text-primary font-bold block mb-0.5">خطای 35 / بلک‌لیست مخابرات:</strong>
                        <span>مخاطبانی که پیامک تبلیغاتی را بسته‌اند پیام معمولی دریافت نمی‌کنند؛ آسنا به طور خودکار از پترن خدماتی استفاده می‌کند تا پیامک به ۱۰۰٪ افراد برسد.</span>
                    </div>
                    <div class="p-2.5 rounded-lg bg-surface-container-low border border-outline-variant/30">
                        <strong class="text-primary font-bold block mb-0.5">خطای 109- / 108- (محدودیت IP):</strong>
                        <span>در پنل ملی‌پیامک > منوی تنظیمات > دسترسی وب‌سرویس، آی‌پی سرور را در لیست مجاز ثبت کنید یا در صورت مسدودی موقت دقایقی صبر نمایید.</span>
                    </div>
                    <div class="p-2.5 rounded-lg bg-surface-container-low border border-outline-variant/30">
                        <strong class="text-primary font-bold block mb-0.5">خطای 110- (الزام ApiKey):</strong>
                        <span>در متدهای وب‌سرویس به جای رمز عبور پنل، از کلید ApiKey اختصاصی ساخته شده در پنل استفاده فرمایید.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patterns Catalog Section -->
    <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-6 lg:p-8 stat-card-shadow">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 pb-4 border-b border-outline-variant/30">
            <div>
                <h3 class="font-bold text-primary text-lg">کاتالوگ الگوها و پترن‌های سامانه (Melipayamak Patterns)</h3>
                <p class="text-xs text-on-surface-variant">متن‌های تایید شده در بخش «وب‌سرویس خدماتی اشتراکی» ملی‌پیامک جهت عبور از بلک‌لیست مخابرات</p>
            </div>
            <a href="https://login.melipayamak.com/?module=ShareService" target="_blank" class="text-xs font-bold text-secondary-container hover:underline flex items-center gap-1">
                <span>ثبت الگوی جدید در ملی‌پیامک</span>
                <span class="material-symbols-outlined text-[16px]">launch</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($patterns as $pat): ?>
                <div class="bg-surface-container-low border border-outline-variant/40 rounded-2xl p-5 flex flex-col justify-between hover:border-secondary-container/50 transition-all">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="inline-block bg-primary/10 text-primary font-black text-xs px-2.5 py-1 rounded-lg">
                                شناسه کد متن: <span class="font-mono text-sm"><?= htmlspecialchars($pat['body_id']) ?></span>
                            </span>
                            <span class="text-[11px] font-bold text-on-surface-variant bg-surface-container-lowest px-2 py-0.5 rounded border border-outline-variant/40">
                                <?= htmlspecialchars($pat['target']) ?>
                            </span>
                        </div>
                        <h4 class="font-bold text-sm text-primary mb-2"><?= htmlspecialchars($pat['name']) ?></h4>
                        <div class="bg-surface-container-lowest p-3 rounded-xl border border-outline-variant/30 text-xs text-on-surface leading-relaxed font-sans mb-3 whitespace-pre-line" dir="rtl">
                            <?= htmlspecialchars($pat['sample']) ?>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-outline-variant/20 flex justify-between items-center text-[11px] text-on-surface-variant font-mono">
                        <span>متغیرها: <?= htmlspecialchars($pat['vars']) ?></span>
                        <span class="text-emerald-600 font-bold font-sans flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>تایید شده</span>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
