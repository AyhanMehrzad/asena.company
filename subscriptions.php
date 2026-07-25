<?php 
require_once 'includes/header.php'; 

$stmt = $pdo->query("SELECT * FROM autoship_plans ORDER BY interval_months ASC");
$plans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="max-w-container-max mx-auto overflow-hidden py-16 px-margin-desktop">
    <!-- Hero Subscription -->
    <div class="bg-gradient-to-br from-primary to-primary-container rounded-[3rem] p-12 lg:p-20 text-white flex flex-col items-center text-center relative overflow-hidden mb-24">
        <div class="absolute inset-0 bg-white/5 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-30 mix-blend-overlay"></div>
        
        <span class="bg-status-warning text-on-surface px-4 py-2 rounded-full font-bold text-label-sm mb-6 relative z-10 animate-bounce">۲۰٪ تخفیف روی تمام سفارشات</span>
        <h1 class="text-display-lg font-black mb-6 relative z-10">اشتراک هوشمند پت‌کر</h1>
        <p class="text-body-lg opacity-90 max-w-2xl relative z-10 mb-10">ارسال خودکار غذا و ملزومات پت شما در بازه‌های زمانی دلخواه. بدون نگرانی از تمام شدن آذوقه، با ارسال رایگان و تخفیف دائمی.</p>
        
        <div class="flex flex-col sm:flex-row gap-4 relative z-10">
            <button class="bg-white text-primary px-8 py-4 rounded-xl font-bold btn-premium">ساخت پلن شخصی</button>
            <button class="bg-primary-fixed/20 border border-white/30 text-white px-8 py-4 rounded-xl font-bold hover:bg-white/10 transition-colors">مشاهده ویدیو معرفی</button>
        </div>
    </div>

    <!-- Features -->
    <div class="text-center mb-16">
        <h2 class="text-headline-lg text-primary mb-4">چرا اشتراک هوشمند؟</h2>
        <p class="text-body-lg text-on-surface-variant">مزایایی که زندگی شما و پت عزیزتان را راحت‌تر می‌کند</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8 mb-32">
        <div class="bg-surface-container-lowest border border-outline-variant/30 p-8 rounded-[2rem] text-center hover:shadow-xl transition-all group">
            <div class="w-20 h-20 bg-primary/10 rounded-2xl mx-auto flex items-center justify-center text-primary mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all">
                <span class="material-symbols-outlined text-4xl">savings</span>
            </div>
            <h3 class="text-title-lg font-bold mb-4">تخفیف دائمی</h3>
            <p class="text-body-md text-on-surface-variant">با فعال‌سازی اشتراک خودکار، همیشه و روی تمامی محصولات ۲۰٪ تخفیف می‌گیرید.</p>
        </div>
        <div class="bg-surface-container-lowest border border-outline-variant/30 p-8 rounded-[2rem] text-center hover:shadow-xl transition-all group">
            <div class="w-20 h-20 bg-primary/10 rounded-2xl mx-auto flex items-center justify-center text-primary mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all">
                <span class="material-symbols-outlined text-4xl">local_shipping</span>
            </div>
            <h3 class="text-title-lg font-bold mb-4">ارسال رایگان</h3>
            <p class="text-body-md text-on-surface-variant">تمام سفارشات اشتراکی، بدون در نظر گرفتن مبلغ، به صورت کاملاً رایگان ارسال می‌شوند.</p>
        </div>
        <div class="bg-surface-container-lowest border border-outline-variant/30 p-8 rounded-[2rem] text-center hover:shadow-xl transition-all group">
            <div class="w-20 h-20 bg-primary/10 rounded-2xl mx-auto flex items-center justify-center text-primary mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all">
                <span class="material-symbols-outlined text-4xl">edit_calendar</span>
            </div>
            <h3 class="text-title-lg font-bold mb-4">لغو و تغییر آسان</h3>
            <p class="text-body-md text-on-surface-variant">هر زمان که خواستید بازه زمانی را تغییر دهید یا بدون هیچ هزینه‌ای اشتراک را لغو کنید.</p>
        </div>
    </div>

    <!-- How it works -->
    <div class="bg-surface-container-low rounded-[4rem] p-12 lg:p-24 flex flex-col lg:flex-row items-center gap-16 mb-16">
        <div class="lg:w-1/2">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj" class="w-full rounded-[3rem] shadow-2xl" alt="Pet Delivery">
        </div>
        <div class="lg:w-1/2">
            <h2 class="text-display-lg text-primary mb-12">چگونه کار می‌کند؟</h2>
            <div class="space-y-8 relative before:content-[''] before:absolute before:right-[23px] before:top-4 before:bottom-4 before:w-[2px] before:bg-primary/20">
                <div class="flex gap-6 relative">
                    <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center shrink-0 z-10 shadow-lg font-bold">۱</div>
                    <div>
                        <h4 class="text-title-lg font-bold mb-2">انتخاب محصولات</h4>
                        <p class="text-body-md text-on-surface-variant">غذا، مکمل یا هر محصولی که پت شما به صورت دوره‌ای نیاز دارد را انتخاب کنید.</p>
                    </div>
                </div>
                <div class="flex gap-6 relative">
                    <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center shrink-0 z-10 shadow-lg font-bold">۲</div>
                    <div>
                        <h4 class="text-title-lg font-bold mb-2">تنظیم بازه زمانی</h4>
                        <p class="text-body-md text-on-surface-variant">مشخص کنید هر چند روز (مثلا هر ۳۰ یا ۴۵ روز) نیاز به ارسال مجدد دارید.</p>
                    </div>
                </div>
                <div class="flex gap-6 relative">
                    <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center shrink-0 z-10 shadow-lg font-bold">۳</div>
                    <div>
                        <h4 class="text-title-lg font-bold mb-2">ارسال و پرداخت خودکار</h4>
                        <p class="text-body-md text-on-surface-variant">ما قبل از ارسال به شما اطلاع می‌دهیم و با کسر از کیف پول، سفارش ارسال می‌شود.</p>
                    </div>
                </div>
            </div>
            
            <button class="mt-12 bg-secondary-container text-on-secondary-container px-8 py-4 rounded-xl font-bold btn-premium w-full sm:w-auto">شروع اشتراک هوشمند</button>
        </div>
    </div>

    <!-- Available Plans -->
    <div class="mb-16">
        <h2 class="text-headline-lg text-primary text-center mb-12">پلن‌های اشتراکی موجود</h2>
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <?php foreach($plans as $plan): ?>
            <div class="bg-white border border-outline-variant rounded-[2rem] p-8 text-center flex flex-col hover:shadow-2xl hover:-translate-y-2 transition-all">
                <h3 class="text-title-lg font-bold text-on-surface mb-2"><?php echo htmlspecialchars($plan['name']); ?></h3>
                <p class="text-body-md text-on-surface-variant mb-6">ارسال هر <?php echo $plan['interval_months']; ?> ماه یک‌بار</p>
                <div class="text-display-sm font-black text-primary mb-2 persian-number"><?php echo $plan['discount_percent']; ?>٪</div>
                <p class="text-label-sm text-on-surface-variant mb-8">تخفیف روی تمامی محصولات</p>
                
                <button onclick="window.location.href='shop.php?autoship=1&plan=<?php echo $plan['id']; ?>'" class="mt-auto bg-primary-container text-white py-4 rounded-xl font-bold hover:bg-primary transition-colors">انتخاب و شروع خرید</button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
