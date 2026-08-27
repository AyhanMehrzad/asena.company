<?php
include 'includes/header.php';

// Fetch top 12 latest products for the high-density grid
$stmt = $pdo->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 12");
$stmt->execute();
$premium_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch user wishlist if logged in
$user_wishlist = [];
if (isset($_SESSION['user_id'])) {
    $wishlist_stmt = $pdo->prepare("SELECT product_id FROM wishlist WHERE user_id = ?");
    $wishlist_stmt->execute([$_SESSION['user_id']]);
    $user_wishlist = $wishlist_stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Fetch active campaigns
$campaign_stmt = $pdo->query("SELECT * FROM campaigns WHERE status = 'active' ORDER BY created_at DESC");
$active_campaigns = $campaign_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch top 5 donors
$donor_stmt = $pdo->query("
    SELECT donor_name, SUM(amount) as total_donated 
    FROM donations 
    WHERE status = 'successful' AND donor_name != 'ناشناس'
    GROUP BY donor_name 
    ORDER BY total_donated DESC 
    LIMIT 5
");
$top_donors = $donor_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="w-full max-w-container-max mx-auto space-y-24">
        <!-- Hero Software-Style Interface -->
        <section class="relative min-h-[650px] lg:h-[800px] h-auto py-16 lg:py-0 rounded-[2.5rem] overflow-hidden workstation-module border-none">
            <div class="absolute inset-0 bg-[#f8fafc]">
                <div class="blurred-orb w-[800px] h-[800px] bg-primary-container -top-64 -right-64"></div>
                <div class="blurred-orb w-[600px] h-[600px] bg-secondary-container -bottom-32 -left-32 opacity-10">
                </div>
            </div>
            <div class="relative h-full flex items-center px-6 lg:px-20">
                <div class="w-full lg:w-1/2 space-y-8 z-10" id="hero-content">
                    <div id="hero-badge"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-outline-variant/30 rounded-full text-xs font-bold text-primary shadow-sm">
                        <span id="hero-badge-icon" class="material-symbols-outlined text-sm text-secondary-container">autorenew</span>
                        <span id="hero-badge-text">سیستم تحویل خودکار (Autoship)</span>
                    </div>
                    <h1 id="hero-title" class="text-4xl md:text-6xl lg:text-8xl font-bold text-primary leading-[1.2] lg:leading-[1] tracking-tight">
                        اشتراک هوشمند؛<br />همیشه در دسترس
                    </h1>
                    <p id="hero-desc" class="text-lg lg:text-xl text-on-surface-variant font-light max-w-lg leading-relaxed">
                        برنامه غذایی و دارویی پت شما هرگز متوقف نمی‌شود. با فعال‌سازی اشتراک، از تخفیف دائمی و اولویت در
                        خدمات بهره‌مند شوید.
                    </p>
                    <div class="flex items-center gap-4 pt-4">
                        <a id="hero-link" href="subscriptions.php"
                            class="inline-block text-center bg-primary-container text-white px-10 py-5 rounded-2xl font-bold shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                            شروع تجربه اشتراک
                        </a>
                        <div class="flex -space-x-3 space-x-reverse items-center pr-6">
                            <div class="w-12 h-12 rounded-full border-4 border-white bg-slate-200"></div>
                            <div class="w-12 h-12 rounded-full border-4 border-white bg-slate-300"></div>
                            <div
                                class="w-12 h-12 rounded-full border-4 border-white bg-primary-container flex items-center justify-center text-white text-[10px] font-bold">
                                ۵۰۰+</div>
                        </div>
                    </div>
                </div>
                <div id="hero-bg" class="absolute inset-0 md:left-0 md:top-0 h-full w-full md:w-1/2 opacity-20 md:opacity-100 bg-cover bg-center mask-fade-l md:mr-auto transition-all duration-700"
                    style='background-image: url("assets/images/cat-hero.jpg");'>
                </div>
            </div>
            <!-- Redesigned Slider Controls -->
            <!-- Arrow Buttons -->
            <div class="absolute inset-y-0 left-4 right-4 lg:left-8 lg:right-8 flex items-center justify-between pointer-events-none z-30">
                <button onclick="nextSlide()"
                    class="pointer-events-auto w-16 h-16 rounded-full backdrop-blur-md bg-white/20 border border-white/30 shadow-2xl flex items-center justify-center text-primary hover:bg-white hover:scale-110 transition-all">
                    <span class="material-symbols-outlined text-4xl font-bold">chevron_right</span>
                </button>
                <button onclick="prevSlide()"
                    class="pointer-events-auto w-16 h-16 rounded-full backdrop-blur-md bg-white/20 border border-white/30 shadow-2xl flex items-center justify-center text-primary hover:bg-white hover:scale-110 transition-all">
                    <span class="material-symbols-outlined text-4xl font-bold">chevron_left</span>
                </button>
            </div>
            <!-- Pagination Pills -->
            <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-30 flex items-center gap-3" id="hero-pills">
                <button onclick="goToSlide(0)" class="w-8 h-2 rounded-full bg-primary-container scale-125 transition-all cursor-pointer"></button>
                <button onclick="goToSlide(1)" class="w-3 h-2 rounded-full bg-primary-container/20 hover:bg-primary-container/40 transition-all cursor-pointer"></button>
                <button onclick="goToSlide(2)" class="w-3 h-2 rounded-full bg-primary-container/20 hover:bg-primary-container/40 transition-all cursor-pointer"></button>
                <button onclick="goToSlide(3)" class="w-3 h-2 rounded-full bg-primary-container/20 hover:bg-primary-container/40 transition-all cursor-pointer"></button>
            </div>
        </section>
        
        <!-- Cycle Section - Rail Density (Functional & Clickable) -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            <div class="lg:col-span-3 flex flex-col justify-center p-10 bg-surface-container-low rounded-[2rem] space-y-4">
                <h2 class="text-3xl font-bold text-primary">چرخه مراقبت هوشمند</h2>
                <p class="text-sm text-on-surface-variant leading-relaxed">خدمات یکپارچه برای سلامت همیشگی پت شما که به صورت ۲۴ ساعته مانیتور می‌شود.</p>
                <div class="flex gap-2 pt-4">
                    <div class="w-3 h-3 rounded-full bg-primary-container"></div>
                    <div class="w-3 h-3 rounded-full bg-outline-variant/30"></div>
                    <div class="w-3 h-3 rounded-full bg-outline-variant/30"></div>
                </div>
            </div>
            <div class="lg:col-span-9 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 1. Checkup -->
                <a href="booking.php" class="group workstation-module rounded-[2rem] p-8 cursor-pointer hover:-translate-y-1.5 transition-all block">
                    <div class="w-16 h-16 bg-surface-container-low rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-container group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-3xl">stethoscope</span>
                    </div>
                    <h3 class="font-bold text-primary text-lg mb-2 group-hover:text-primary-container flex items-center justify-between">
                        <span>چک‌آپ دوره‌ای</span>
                        <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">یادآوری هوشمند معاینات بر اساس سن و نژاد دقیق پت شما.</p>
                </a>

                <!-- 2. Nutrition -->
                <a href="subscriptions.php" class="group workstation-module rounded-[2rem] p-8 cursor-pointer hover:-translate-y-1.5 transition-all block">
                    <div class="w-16 h-16 bg-surface-container-low rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-container group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-3xl">nutrition</span>
                    </div>
                    <h3 class="font-bold text-primary text-lg mb-2 group-hover:text-primary-container flex items-center justify-between">
                        <span>تغذیه اختصاصی</span>
                        <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">آنالیز تخصصی رژیم غذایی بر اساس فعالیت‌های روزانه.</p>
                </a>

                <!-- 3. Vaccination & Care -->
                <a href="booking.php" class="group workstation-module rounded-[2rem] p-8 cursor-pointer hover:-translate-y-1.5 transition-all block">
                    <div class="w-16 h-16 bg-surface-container-low rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-container group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-3xl">vaccines</span>
                    </div>
                    <h3 class="font-bold text-primary text-lg mb-2 group-hover:text-primary-container flex items-center justify-between">
                        <span>واکسیناسیون و چک‌آپ</span>
                        <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">مدیریت خودکار پرونده سلامت دیجیتال و هشدارهای واکسن.</p>
                </a>

                <!-- 4. Online Pet Shop -->
                <a href="shop.php" class="group workstation-module rounded-[2rem] p-8 cursor-pointer hover:-translate-y-1.5 transition-all block border-2 border-secondary-container/30 bg-gradient-to-b from-white to-orange-50/30">
                    <div class="w-16 h-16 bg-secondary-container/10 text-secondary-container rounded-2xl flex items-center justify-center mb-6 group-hover:bg-secondary-container group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-3xl">storefront</span>
                    </div>
                    <h3 class="font-bold text-primary text-lg mb-2 group-hover:text-secondary-container flex items-center justify-between">
                        <span>فروشگاه و ملزومات</span>
                        <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">تامین غذا، مکمل، وسایل بازی و ملزومات نگهداری پت با ارسال اکسپرس.</p>
                </a>
            </div>
        </section>

        <!-- Pet Shop Featured Spotlight Section -->
        <section class="bg-gradient-to-r from-primary via-primary-container to-[#001a48] text-white rounded-[2.5rem] p-8 lg:p-12 shadow-2xl relative overflow-hidden">
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-secondary-container/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 border-b border-white/10 pb-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 bg-secondary-container text-white rounded-full text-xs font-bold mb-3 shadow-md">
                            <span class="material-symbols-outlined text-sm">storefront</span>
                            فروشگاه جامع حیوانات خانگی و ملزومات
                        </div>
                        <h2 class="text-2xl lg:text-4xl font-bold tracking-tight">پت‌شاپ تخصصی آسنا؛ بهترین‌ها برای پت شما</h2>
                        <p class="text-sm text-white/75 mt-1 max-w-xl">تامین مستقیم غذاهای باکیفیت، تشویقی، مکمل‌های غذایی و لوازم بهداشتی و نگهداری برای سگ، گربه، پرندگان و سایر حیوانات.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="shop.php" class="bg-secondary-container text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-[#ea580c] transition-all shadow-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">shopping_bag</span>
                            مشاهده تمام محصولات پت‌شاپ
                        </a>
                    </div>
                </div>

                <!-- Species Quick Navigation Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 text-center">
                    <a href="shop.php?species=dog" class="bg-white/10 hover:bg-white/20 border border-white/15 p-4 rounded-2xl transition-all group flex flex-col items-center gap-2">
                        <span class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">🐕</span>
                        <span class="text-xs font-bold">ملزومات سگ</span>
                    </a>
                    <a href="shop.php?species=cat" class="bg-white/10 hover:bg-white/20 border border-white/15 p-4 rounded-2xl transition-all group flex flex-col items-center gap-2">
                        <span class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">🐈</span>
                        <span class="text-xs font-bold">ملزومات گربه</span>
                    </a>
                    <a href="shop.php?species=horse" class="bg-white/10 hover:bg-white/20 border border-white/15 p-4 rounded-2xl transition-all group flex flex-col items-center gap-2">
                        <span class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">🐎</span>
                        <span class="text-xs font-bold">ملزومات اسب</span>
                    </a>
                    <a href="shop.php?species=cow" class="bg-white/10 hover:bg-white/20 border border-white/15 p-4 rounded-2xl transition-all group flex flex-col items-center gap-2">
                        <span class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">🐄</span>
                        <span class="text-xs font-bold">خوراک و مکمل دام</span>
                    </a>
                    <a href="shop.php?species=chick" class="bg-white/10 hover:bg-white/20 border border-white/15 p-4 rounded-2xl transition-all group flex flex-col items-center gap-2">
                        <span class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">🐥</span>
                    <a href="shop.php" class="bg-white/10 hover:bg-white/20 border border-white/15 p-4 rounded-2xl transition-all group flex flex-col items-center gap-2">
                        <span class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">🐾</span>
                        <span class="text-xs font-bold">سایر پت‌ها</span>
                    </a>
                </div>
            </div>
        </section>
        <!-- Charity Section -->
        <section class="bg-primary-container rounded-[2rem] md:rounded-[3.5rem] overflow-hidden relative text-white shadow-2xl p-6 md:p-12 lg:p-24">
            <div class="paw-pattern absolute inset-0"></div>
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20 items-center text-center lg:text-right">
                <div class="space-y-6 md:space-y-10 flex flex-col items-center lg:items-start">
                    <div class="flex items-center gap-3 text-secondary-container font-bold bg-white/10 w-fit px-6 py-2 rounded-full border border-white/10 backdrop-blur-md">
                        <span class="material-symbols-outlined" style='font-variation-settings: "FILL" 1;'>volunteer_activism</span>
                        مسئولیت اجتماعی آسنا
                    </div>
                    <h2 class="text-4xl lg:text-6xl font-bold leading-tight">
                        حمایت از گربه‌های خیابان؛<br />با هر خرید شما
                    </h2>
                    <p class="text-xl text-white/70 font-light leading-relaxed">
                        ما بخشی از سود هر تراکنش را مستقیماً صرف تامین غذا و درمان سارقان قلب خیابان‌ها می‌کنیم.
                    </p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-8 md:gap-12 pt-4">
                        <div class="space-y-1">
                            <div class="text-3xl font-bold text-secondary-container">۱۲.۵ تن</div>
                            <div class="text-xs text-white/50 uppercase font-bold tracking-widest">غذای توزیع شده</div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-3xl font-bold text-secondary-container">۳,۸۰۰+</div>
                            <div class="text-xs text-white/50 uppercase font-bold tracking-widest">فرشته درمان شده</div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4 w-full sm:w-auto">
                        <a href="charity.php" class="inline-block bg-secondary-container text-white px-10 py-5 rounded-2xl font-bold shadow-xl hover:scale-105 transition-transform text-center">مشاهده کمپین‌ها و حمایت</a>
                    </div>
                </div>
                
                <div class="glass-card !bg-white/10 !border-white/10 rounded-[2.5rem] p-1.5 shadow-2xl relative">
                    <?php if(empty($active_campaigns)): ?>
                    <div class="bg-white rounded-[2.4rem] overflow-hidden p-10 text-center">
                        <h3 class="text-2xl font-bold text-primary">کمپین فعالی وجود ندارد</h3>
                        <p class="text-on-surface-variant mt-4">منتظر کمپین‌های جدید باشید.</p>
                    </div>
                    <?php else: ?>
                    
                    <div class="swiper-container charity-index-slider relative rounded-[2.4rem] overflow-hidden bg-white">
                        <div class="swiper-wrapper">
                            <?php foreach($active_campaigns as $camp): 
                                $percent = $camp['goal_amount'] > 0 ? min(100, round(($camp['current_amount'] / $camp['goal_amount']) * 100)) : 0;
                            ?>
                            <div class="swiper-slide">
                                <div class="h-64 md:h-80 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($camp['image_url'] ?: 'https://placehold.co/800x600?text=Campaign'); ?>');"></div>
                                <div class="p-10 space-y-8 bg-white text-right">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-2xl font-bold text-primary line-clamp-1"><?php echo htmlspecialchars($camp['title']); ?></h3>
                                        <span class="bg-emerald-500 text-white text-[10px] px-3 py-1 rounded-full font-bold animate-pulse">فعال</span>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden flex items-stretch p-0.5">
                                            <div class="bg-gradient-to-l from-secondary-container to-orange-400 rounded-full transition-all duration-1000" style="width: <?php echo $percent; ?>%;"></div>
                                        </div>
                                        <div class="flex justify-between text-xs font-bold text-on-surface-variant">
                                            <span class="">هدف: <?php echo number_format($camp['goal_amount']); ?> تومان</span>
                                            <span class="text-primary"><?php echo number_format($camp['current_amount']); ?> جمع شده</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination !bottom-4"></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Top Donors Removed (Moved to Community Heroes) -->
        <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6 pb-24">
            <div
                class="relative workstation-module rounded-[2rem] p-10 flex flex-col items-center gap-6 group cursor-pointer border-none bg-surface-container/50">
                <div
                    class="w-20 h-20 rounded-2xl bg-white flex items-center justify-center group-hover:bg-primary-container group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl">restaurant</span>
                </div>
                <a href="shop.php?q=غذای خشک" class="text-sm font-bold text-primary before:absolute before:inset-0">غذای خشک</a>
            </div>
            <div
                class="relative workstation-module rounded-[2rem] p-10 flex flex-col items-center gap-6 group cursor-pointer border-none bg-surface-container/50">
                <div
                    class="w-20 h-20 rounded-2xl bg-white flex items-center justify-center group-hover:bg-primary-container group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl">medication_liquid</span>
                </div>
                <a href="shop.php?category=مکمل دارویی" class="text-sm font-bold text-primary before:absolute before:inset-0">مکمل و دارو</a>
            </div>
            <div
                class="relative workstation-module rounded-[2rem] p-10 flex flex-col items-center gap-6 group cursor-pointer border-none bg-surface-container/50">
                <div
                    class="w-20 h-20 rounded-2xl bg-white flex items-center justify-center group-hover:bg-primary-container group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl">toys</span>
                </div>
                <a href="shop.php?category=اسباب‌بازی" class="text-sm font-bold text-primary before:absolute before:inset-0">اسباب‌بازی</a>
            </div>
            <div
                class="relative workstation-module rounded-[2rem] p-10 flex flex-col items-center gap-6 group cursor-pointer border-none bg-surface-container/50">
                <div
                    class="w-20 h-20 rounded-2xl bg-white flex items-center justify-center group-hover:bg-primary-container group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl">cleaning_services</span>
                </div>
                <a href="shop.php?category=لوازم بهداشتی" class="text-sm font-bold text-primary before:absolute before:inset-0">بهداشتی</a>
            </div>
            <div
                class="relative workstation-module rounded-[2rem] p-10 flex flex-col items-center gap-6 group cursor-pointer border-none bg-surface-container/50">
                <div
                    class="w-20 h-20 rounded-2xl bg-white flex items-center justify-center group-hover:bg-primary-container group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl">house</span>
                </div>
                <a href="shop.php?q=جای خواب" class="text-sm font-bold text-primary before:absolute before:inset-0">جای خواب</a>
            </div>
            <div
                class="relative workstation-module rounded-[2rem] p-10 flex flex-col items-center gap-6 group cursor-pointer border-none bg-primary-container text-white">
                <div
                    class="w-20 h-20 rounded-2xl bg-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-primary-container transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl">more_horiz</span>
                </div>
                <a href="shop.php" class="text-sm font-bold text-white before:absolute before:inset-0">مشاهده همه</a>
            </div>
        </section>
        <!-- Premium Products Section (Dynamic High Density) -->
        <section class="space-y-12 pb-12">
            <div class="flex items-end justify-between">
                <div class="space-y-4">
                    <h2 class="text-4xl font-bold text-primary tracking-tight">محصولات ویژه</h2>
                    <p class="text-on-surface-variant font-light text-lg">پیشنهادات استثنایی و پرفروش‌ترین‌ها</p>
                </div>
                <a href="shop.php" class="bg-primary/5 text-primary px-6 py-3 rounded-full font-bold flex items-center gap-2 hover:bg-primary hover:text-white transition-all shadow-sm">
                    مشاهده کل فروشگاه
                    <span class="material-symbols-outlined">arrow_left_alt</span>
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <?php foreach($premium_products as $product): ?>
                <div class="bg-white rounded-3xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col relative border border-outline-variant/10">
                    <!-- Badge -->
                    <?php if($product['discount_price']): ?>
                    <div class="absolute top-4 left-4 bg-secondary-container text-on-secondary-container text-[10px] px-2 py-1 rounded-full z-10 font-bold">تخفیف ویژه</div>
                    <?php endif; ?>
                    
                    <!-- Wishlist Button -->
                    <?php $in_wishlist = in_array($product['id'], $user_wishlist); ?>
                    <button type="button" onclick="toggleWishlist(this, <?php echo $product['id']; ?>)" class="absolute top-4 right-4 z-10 w-8 h-8 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center text-on-surface hover:text-error transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' <?php echo $in_wishlist ? '1' : '0'; ?>; color: <?php echo $in_wishlist ? '#dc2626' : 'inherit'; ?>;">favorite</span>
                    </button>

                    <div class="aspect-square bg-surface-container-lowest rounded-2xl mb-4 overflow-hidden relative">
                        <img loading="lazy" src="<?php echo htmlspecialchars($product['image_url']); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        
                        <!-- Quick add to cart overlay -->
                        <div class="absolute inset-x-0 bottom-0 p-2 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-gradient-to-t from-black/60 to-transparent flex justify-center z-20">
                            <button type="button" onclick="addToCart(this, <?php echo $product['id']; ?>, 'standard')" class="bg-primary text-white w-full py-2 rounded-xl text-xs font-bold flex justify-center items-center gap-1 hover:bg-primary-container">
                                <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                افزودن به سبد
                            </button>
                        </div>
                        
                        <!-- Mobile Quick Add to Cart -->
                        <button type="button" onclick="addToCart(this, <?php echo $product['id']; ?>, 'standard')" class="lg:hidden absolute bottom-3 left-3 z-30 w-9 h-9 bg-primary/90 backdrop-blur-md text-white rounded-full flex items-center justify-center shadow-lg active:scale-95 transition-transform border border-white/20">
                            <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
                        </button>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <p class="text-[10px] text-on-surface-variant mb-1 line-clamp-1">
                            <?php echo htmlspecialchars($product['category']); ?>
                            <?php if(!empty($product['brand'])) echo ' • <span class="text-primary font-bold">' . htmlspecialchars($product['brand']) . '</span>'; ?>
                        </p>
                        <a href="product_details.php?id=<?php echo $product['id']; ?>"><h3 class="text-sm font-bold text-on-surface mb-2 line-clamp-2 hover:text-primary transition-colors cursor-pointer leading-tight"><?php echo htmlspecialchars($product['name']); ?></h3></a>
                        <div class="mt-auto flex justify-between items-center">
                            <div class="flex flex-col">
                                <?php if($product['discount_price']): ?>
                                <span class="text-[10px] text-on-surface-variant line-through mb-0.5"><?php echo number_format($product['price']); ?> تومان</span>
                                <span class="text-sm font-bold text-primary"><?php echo number_format($product['discount_price']); ?> تومان</span>
                                <?php else: ?>
                                <span class="text-sm font-bold text-primary"><?php echo number_format($product['price']); ?> تومان</span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Community Heroes -->
        <section class="bg-white py-24 rounded-[4rem] border border-outline-variant/10 text-center space-y-12">
            <div class="space-y-4">
                <h2 class="text-4xl font-bold text-primary">قهرمانان جامعه آسنا</h2>
                <p class="text-on-surface-variant">ما به داشتن چنین همراهانی افتخار می‌کنیم</p>
            </div>
            <div class="flex flex-wrap justify-center gap-16">
                <?php if(!empty($top_donors)): ?>
                    <?php foreach($top_donors as $index => $donor): 
                        $medal_icon = 'stars';
                        $medal_color = 'bg-primary-container';
                        $border_color = 'border-primary-container';
                        if ($index === 0) {
                            $medal_icon = 'workspace_premium';
                            $medal_color = 'bg-amber-400';
                            $border_color = 'border-amber-400';
                        } elseif ($index === 1) {
                            $medal_icon = 'military_tech';
                            $medal_color = 'bg-slate-300';
                            $border_color = 'border-slate-300';
                        } elseif ($index === 2) {
                            $medal_icon = 'military_tech';
                            $medal_color = 'bg-amber-600';
                            $border_color = 'border-amber-600';
                        }
                    ?>
                    <div class="flex flex-col items-center gap-4 group cursor-pointer">
                        <div class="relative w-28 h-28">
                            <div class="absolute inset-0 rounded-full border-4 <?php echo $border_color; ?> p-1 group-hover:scale-110 transition-transform">
                                <div class="w-full h-full rounded-full bg-cover bg-center"
                                    style='background-image: url("https://ui-avatars.com/api/?name=<?php echo urlencode($donor['donor_name']); ?>&background=random&color=fff&size=150");'>
                                </div>
                            </div>
                            <div class="absolute -bottom-1 -right-1 <?php echo $medal_color; ?> text-white w-10 h-10 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                <?php if($index < 3): ?>
                                    <span class="material-symbols-outlined text-lg"><?php echo $medal_icon; ?></span>
                                <?php else: ?>
                                    <span class="text-sm font-bold">#<?php echo $index + 1; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold text-primary text-lg"><?php echo htmlspecialchars($donor['donor_name']); ?></div>
                            <div class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest"><?php echo number_format($donor['total_donated']); ?> تومان</div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="flex flex-col items-center justify-center gap-4 group cursor-pointer" onclick="window.location.href='charity.php'">
                    <div
                        class="w-28 h-28 rounded-full border-2 border-dashed border-outline-variant flex items-center justify-center group-hover:border-primary-container transition-all">
                        <span
                            class="material-symbols-outlined text-4xl text-outline-variant group-hover:text-primary-container">add</span>
                    </div>
                    <div class="font-bold text-on-surface-variant group-hover:text-primary-container">شما هم بپیوندید
                    </div>
                </div>
            </div>
        </section>
    </main>

<!-- Interaction Layer -->
    <div class="fixed bottom-6 left-6 md:bottom-12 md:left-12 flex flex-col gap-3 md:gap-4 z-50">
        <a href="https://maps.google.com/?q=Tehran" target="_blank"
            class="w-12 h-12 md:w-16 md:h-16 bg-secondary-container text-white rounded-2xl shadow-2xl flex items-center justify-center hover:scale-110 transition-all group relative">
            <span class="material-symbols-outlined text-xl md:text-3xl">location_on</span>
            <span
                class="absolute left-14 md:left-20 bg-white text-primary border border-outline-variant px-4 py-2 rounded-xl text-xs font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-xl">مسیریابی کلینیک</span>
        </a>
    </div>

<script>

// Cart Logic
function addToCart(btn, productId, type = 'standard') {
    if(window.event) window.event.preventDefault();
    
    const originalText = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-sm">sync</span>';
    
    fetch('actions/cart_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=add&ajax=1&csrf_token=<?php echo csrf_token(); ?>&product_id=' + productId + '&type=' + type
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            btn.innerHTML = '<span class="material-symbols-outlined text-sm">check_circle</span>';
            btn.classList.add('bg-green-500', 'text-white');
            btn.classList.remove('bg-primary');
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.remove('bg-green-500');
                btn.classList.add('bg-primary');
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

function toggleWishlist(btn, productId) {
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
                icon.style.color = '#dc2626'; 
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
    .catch(error => console.error('Error:', error));
}

// --- Slider Logic ---
<?php
$curated_banners = function_exists('get_curated_recommendations') ? get_curated_recommendations($pdo, 'banner', 5) : [];
$slides_data = [];

foreach ($curated_banners as $banner) {
    $slides_data[] = [
        'title' => !empty($banner['custom_title']) ? nl2br(htmlspecialchars($banner['custom_title'])) : htmlspecialchars($banner['product_name']),
        'desc' => !empty($banner['custom_subtitle']) ? htmlspecialchars($banner['custom_subtitle']) : ('تامین مستقیم با تخفیف ویژه ' . number_format($banner['product_discount_price'] ?: $banner['product_price']) . ' تومان همراه با تحویل اکسپرس.'),
        'badgeIcon' => 'auto_awesome',
        'badgeText' => !empty($banner['custom_badge']) ? htmlspecialchars($banner['custom_badge']) : '🔥 پیشنهاد برگزیده',
        'link' => 'product_details.php?id=' . (int)$banner['product_id'],
        'linkText' => 'مشاهده و خرید محصول',
        'img' => !empty($banner['product_image_url']) ? $banner['product_image_url'] : 'assets/images/cat-hero.jpg'
    ];
}

$default_slides = [
    [
        'title' => "اشتراک هوشمند؛<br />همیشه در دسترس",
        'desc' => "برنامه غذایی و ملزومات پت شما هرگز متوقف نمی‌شود. با فعال‌سازی اشتراک، از تخفیف دائمی و اولویت در خدمات بهره‌مند شوید.",
        'badgeIcon' => "autorenew",
        'badgeText' => "سیستم تحویل خودکار (Autoship)",
        'link' => "subscriptions.php",
        'linkText' => "شروع تجربه اشتراک",
        'img' => "assets/images/cat-hero.jpg"
    ],
    [
        'title' => "برترین محصولات<br />برای سلامت پت",
        'desc' => "فروشگاه ما با مجموعه‌ای بی‌نظیر از بهترین برندهای جهانی، تضمین‌کننده سلامت و نشاط حیوان خانگی شماست.",
        'badgeIcon' => "local_shipping",
        'badgeText' => "ارسال رایگان سفارشات بالای ۵۰۰ هزار تومان",
        'link' => "shop.php",
        'linkText' => "مشاهده فروشگاه",
        'img' => "assets/images/toy-mouse.jpg"
    ],
    [
        'title' => "کلینیک تخصصی<br />در دستان شما",
        'desc' => "با استفاده از سیستم یکپارچه رزرواسیون آنلاین، بدون معطلی و در سریع‌ترین زمان ممکن برای پت خود نوبت بگیرید.",
        'badgeIcon' => "medical_services",
        'badgeText' => "پشتیبانی درمانی حرفه‌ای",
        'link' => "booking.php",
        'linkText' => "رزرو نوبت کلینیک",
        'img' => "assets/images/presentation-dog.jpg"
    ],
    [
        'title' => "ارسال دوره‌ای و خودکار؛<br />همیشه به موقع",
        'desc' => "تامین خودکار و ماهانه غذا، مکمل‌های تقویتی و وسایل بهداشتی حیوانات شما بدون دغدغه اتمام موجودی با تخفیف ویژه.",
        'badgeIcon' => "autorenew",
        'badgeText' => "سرویس تحویل خودکار (Autoship)",
        'link' => "subscriptions.php",
        'linkText' => "مشاهده اشتراک‌ها",
        'img' => "assets/images/dog-hero.jpg"
    ]
];

$all_slides = !empty($slides_data) ? array_merge($slides_data, array_slice($default_slides, 0, max(0, 4 - count($slides_data)))) : $default_slides;
?>
const slides = <?= json_encode($all_slides, JSON_UNESCAPED_UNICODE) ?>;

let currentSlide = 0;
let slideInterval = setInterval(nextSlide, 6000);

function updateSlide() {
    const slide = slides[currentSlide];
    
    // Animate content out
    const content = document.getElementById('hero-content');
    content.style.opacity = 0;
    
    setTimeout(() => {
        document.getElementById('hero-title').innerHTML = slide.title;
        document.getElementById('hero-desc').innerText = slide.desc;
        document.getElementById('hero-badge-icon').innerText = slide.badgeIcon;
        document.getElementById('hero-badge-text').innerText = slide.badgeText;
        document.getElementById('hero-link').href = slide.link;
        document.getElementById('hero-link').innerText = slide.linkText;
        document.getElementById('hero-bg').style.backgroundImage = `url("${slide.img}")`;
        
        // Animate content in
        content.style.opacity = 1;
        content.style.transition = 'opacity 0.5s ease';
    }, 300);

    // Update Pills
    const pills = document.getElementById('hero-pills').children;
    for(let i=0; i<pills.length; i++) {
        if(i === currentSlide) {
            pills[i].className = "w-8 h-2 rounded-full bg-primary-container scale-125 transition-all cursor-pointer";
        } else {
            pills[i].className = "w-3 h-2 rounded-full bg-primary-container/20 hover:bg-primary-container/40 transition-all cursor-pointer";
        }
    }
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    updateSlide();
    resetInterval();
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    updateSlide();
    resetInterval();
}

function goToSlide(index) {
    currentSlide = index;
    updateSlide();
    resetInterval();
}

function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, 6000);
}
</script>
<script src="assets/js/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
<script>
    if (document.querySelector('.charity-index-slider')) {
        new Swiper('.charity-index-slider', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
    }
</script>

<!-- Schema.org JSON-LD Structured Data for Pharmacy & Pet Care Organization -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Pharmacy",
  "name": "داروخانه آنلاین و پت‌شاپ تخصصی آسنا",
  "alternateName": "ASENA Pet Care & Veterinary Pharmacy",
  "url": "http://localhost/asena/asena-pharmacy-golzari/",
  "logo": "http://localhost/asena/asena-pharmacy-golzari/assets/images/logo.png",
  "description": "مرجع تخصصی خرید آنلاین داروهای دامپزشکی، مکمل‌ها، واکسن‌ها و ملزومات حیوانات خانگی با تاییدیه دکتر داروساز و ارسال زنجیره سرد",
  "telephone": "+98-21-88888888",
  "priceRange": "$$",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "خیابان ولیعصر، بالاتر از پارک ساعی",
    "addressLocality": "تهران",
    "addressRegion": "تهران",
    "addressCountry": "IR"
  },
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      "opens": "00:00",
      "closes": "23:59"
    }
  ],
  "medicalSpecialty": "VeterinaryCare"
}
</script>

<?php include 'includes/footer.php'; ?>
