<?php include 'includes/header.php'; ?>

<main class="max-w-container-max mx-auto overflow-hidden py-16 px-margin-desktop">
    <div class="mb-12">
        <h1 class="text-display-lg text-primary mb-4">پرداخت امن</h1>
        <p class="text-body-lg text-on-surface-variant">اطلاعات پرداخت خود را وارد کنید.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-12">
        <!-- Payment Details -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-lg border border-outline-variant/30">
                <form action="#" method="POST" class="space-y-8">
                    <div>
                        <h3 class="text-title-lg font-bold text-primary mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined">person</span>
                            اطلاعات گیرنده
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-label-sm font-bold text-on-surface-variant mb-2">نام و نام خانوادگی</label>
                                <input type="text" class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors" placeholder="مثال: علی رضایی">
                            </div>
                            <div>
                                <label class="block text-label-sm font-bold text-on-surface-variant mb-2">شماره تماس</label>
                                <input type="tel" class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors text-left" dir="ltr" placeholder="0912 345 6789">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-label-sm font-bold text-on-surface-variant mb-2">آدرس دقیق ارسال</label>
                                <textarea rows="3" class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors" placeholder="استان، شهر، خیابان، پلاک..."></textarea>
                            </div>
                        </div>
                    </div>

                    <hr class="border-outline-variant/30">

                    <div>
                        <h3 class="text-title-lg font-bold text-primary mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined">credit_card</span>
                            درگاه پرداخت
                        </h3>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="payment_gateway" class="peer sr-only" checked>
                                <div class="p-6 rounded-2xl border-2 border-outline-variant/30 peer-checked:border-primary peer-checked:bg-primary/5 hover:border-primary/50 transition-all text-center flex flex-col items-center gap-3">
                                    <span class="material-symbols-outlined text-4xl text-primary">account_balance</span>
                                    <span class="font-bold text-on-surface">درگاه زرین‌پال</span>
                                </div>
                            </label>
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="payment_gateway" class="peer sr-only">
                                <div class="p-6 rounded-2xl border-2 border-outline-variant/30 peer-checked:border-primary peer-checked:bg-primary/5 hover:border-primary/50 transition-all text-center flex flex-col items-center gap-3">
                                    <span class="material-symbols-outlined text-4xl text-primary">payments</span>
                                    <span class="font-bold text-on-surface">پرداخت در محل</span>
                                    <span class="text-label-sm text-status-warning bg-status-warning/10 px-2 py-1 rounded-md">فقط تهران</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:w-1/3">
            <div class="bg-surface-container-low rounded-[2rem] p-8 sticky top-32">
                <h3 class="text-headline-md text-primary mb-8 border-b border-outline-variant/20 pb-4">مبلغ پرداختی</h3>
                
                <div class="flex flex-col gap-4 mb-8">
                    <div class="flex justify-between items-center text-body-lg">
                        <span class="text-on-surface-variant">مبلغ کل</span>
                        <span class="font-bold">۵,۹۴۰,۰۰۰ تومان</span>
                    </div>
                    <div class="flex justify-between items-center text-body-lg text-secondary">
                        <span>تخفیف</span>
                        <span class="font-bold">۴۵۰,۰۰۰ تومان</span>
                    </div>
                </div>
                
                <div class="border-t border-outline-variant/20 pt-6 mb-8 flex justify-between items-center">
                    <span class="text-title-lg font-bold">قابل پرداخت</span>
                    <span class="text-headline-md font-bold text-primary">۵,۴۹۰,۰۰۰ تومان</span>
                </div>
                
                <button class="w-full bg-primary text-white py-5 rounded-2xl font-bold flex justify-center items-center gap-3 btn-premium hover:bg-primary-container hover:shadow-xl text-label-lg transition-all mb-4">
                    انتقال به درگاه پرداخت
                    <span class="material-symbols-outlined">security</span>
                </button>
                
                <div class="flex items-center justify-center gap-2 text-label-sm text-on-surface-variant">
                    <span class="material-symbols-outlined text-[16px]">lock</span>
                    پرداخت شما رمزنگاری شده و امن است
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
