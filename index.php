<?php
include 'includes/header.php';
?>

    <main class="max-w-container-max mx-auto overflow-hidden">
        <!-- Hero Section -->
        <section class="mt-8 px-margin-desktop h-auto md:h-[650px]">
            <div class="split-hero-container flex flex-col md:flex-row w-full h-full rounded-3xl overflow-hidden shadow-2xl bg-surface-container">
                <!-- Right Side: Clinical Care -->
                <div class="hero-panel relative border-l border-white/10 overflow-hidden group/panel h-[400px] md:h-auto flex-1">
                    <img class="absolute inset-0 w-full h-full object-cover grayscale-[0.1] group-hover/panel:grayscale-0 transition-all duration-700" data-alt="Professional veterinary care" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o">
                    <div class="absolute inset-0 overlay-shade"></div>
                    <div class="absolute inset-0 bg-gradient-to-l from-primary/95 via-primary/30 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-12 text-on-primary z-10 whitespace-nowrap overflow-hidden">
                        <span class="bg-secondary-container text-on-secondary-container text-label-sm px-4 py-1.5 rounded-full mb-4 w-fit">خدمات بالینی تخصصی</span>
                        <h2 class="text-display-lg mb-2">کلینیک ۲۴ ساعته</h2>
                        <div class="max-h-0 opacity-0 group-hover/panel:max-h-56 group-hover/panel:opacity-100 transition-all duration-700 delay-100 overflow-hidden">
                            <p class="text-body-lg mb-8 opacity-90 max-w-xl whitespace-normal">دسترسی مستقیم به برترین متخصصین کشور در هر ساعت از شبانه‌روز. مشاوره تصویری و رزرو نوبت آنی.</p>
                            <a href="booking.php" class="bg-white text-primary px-10 py-4 rounded-xl font-bold text-label-lg btn-premium flex items-center gap-3 w-fit">
                                <span class="">رزرو نوبت فوری</span>
                                <span class="material-symbols-outlined" data-icon="calendar_today">calendar_today</span>
                            </a>
                        </div>
                        <div class="group-hover/panel:hidden flex items-center gap-2 text-label-lg font-bold">
                            <span class="">مشاهده خدمات کلینیک</span>
                            <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                        </div>
                    </div>
                </div>
                <!-- Left Side: Autoship Subscription -->
                <div class="hero-panel relative overflow-hidden group/panel h-[400px] md:h-auto flex-1">
                    <img class="absolute inset-0 w-full h-full object-cover grayscale-[0.1] group-hover/panel:grayscale-0 transition-all duration-700" data-alt="Pet food and supplies" src="https://lh3.googleusercontent.com/aida-public/AB6AXuApaJ4lVz9bsWX5J6hDMccC0eicSwvULt0Q5aolXJ_ztxKQLMqvOMqyD_ToN4pU17OAM_g1S8dHxl69Da5myA6BkHedbbropYElaGEfRllJZCtIapl1EwMj22_HWiE1pjeExSnCKBIc6uyDZktIDYyRZXeXrOU8TX_jyhk4E27h-8tFUyiAtfstxmeq5SIhEI_YFfXVMr1cudwSFdERvf68w_0ZyTJ69B3JfQsFAtu-edSWuCc5h_nb">
                    <div class="absolute inset-0 overlay-shade"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-secondary/95 via-secondary/30 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-12 text-on-primary z-10 whitespace-nowrap overflow-hidden">
                        <span class="bg-status-warning text-on-surface text-label-sm px-4 py-1.5 rounded-full mb-4 w-fit">۲۰٪ تخفیف دائمی</span>
                        <h2 class="text-display-lg mb-2">اشتراک هوشمند</h2>
                        <div class="max-h-0 opacity-0 group-hover/panel:max-h-56 group-hover/panel:opacity-100 transition-all duration-700 delay-100 overflow-hidden">
                            <p class="text-body-lg mb-8 opacity-90 max-w-xl whitespace-normal">زمان‌بندی ارسال خودکار غذا و ملزومات برای پت شما. دیگر نگران تمام شدن آذوقه نباشید.</p>
                            <button class="bg-primary text-white px-10 py-4 rounded-xl font-bold text-label-lg btn-premium flex items-center gap-3">
                                <span class="">شروع اشتراک هوشمند</span>
                                <span class="material-symbols-outlined" data-icon="autorenew">autorenew</span>
                            </button>
                        </div>
                        <div class="group-hover/panel:hidden flex items-center gap-2 text-label-lg font-bold">
                            <span class="">مزایای اشتراک خودکار</span>
                            <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 1: How It Works -->
        <section class="py-32 px-margin-desktop">
            <div class="text-center mb-24">
                <h2 class="text-display-lg text-primary mb-6">چرخه کامل مراقبت هوشمند</h2>
                <p class="text-body-lg text-on-surface-variant">از لحظه ورود تا آرامش ابدی پت شما، در کنارتان هستیم</p>
            </div>
            <div class="grid lg:grid-cols-4 gap-12 relative">
                <div class="flex flex-col items-center text-center group step-line relative">
                    <div class="w-20 h-20 bg-primary/5 rounded-3xl flex items-center justify-center text-primary mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[40px]" data-icon="app_registration">app_registration</span>
                    </div>
                    <h3 class="text-title-lg font-bold mb-4">۱. ثبت پروفایل پت</h3>
                    <p class="text-body-md text-on-surface-variant">اطلاعات نژادی و سلامت پت خود را وارد کنید.</p>
                </div>
                <div class="flex flex-col items-center text-center group step-line relative">
                    <div class="w-20 h-20 bg-primary/5 rounded-3xl flex items-center justify-center text-primary mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[40px]" data-icon="psychology">psychology</span>
                    </div>
                    <h3 class="text-title-lg font-bold mb-4">۲. مشاوره هوشمند</h3>
                    <p class="text-body-md text-on-surface-variant">هوش مصنوعی علائم را تحلیل و راهکار ارائه می‌دهد.</p>
                </div>
                <div class="flex flex-col items-center text-center group step-line relative">
                    <div class="w-20 h-20 bg-primary/5 rounded-3xl flex items-center justify-center text-primary mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[40px]" data-icon="medical_information">medical_information</span>
                    </div>
                    <h3 class="text-title-lg font-bold mb-4">۳. ویزیت یا خرید</h3>
                    <p class="text-body-md text-on-surface-variant">رزرو نوبت کلینیک یا خرید مستقیم از فروشگاه.</p>
                </div>
                <div class="flex flex-col items-center text-center group relative">
                    <div class="w-20 h-20 bg-primary/5 rounded-3xl flex items-center justify-center text-primary mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <span class="material-symbols-outlined text-[40px]" data-icon="all_inclusive">all_inclusive</span>
                    </div>
                    <h3 class="text-title-lg font-bold mb-4">۴. اشتراک خودکار</h3>
                    <p class="text-body-md text-on-surface-variant">تنظیم ارسال دوره‌ای محصولات با تخفیف دائمی.</p>
                </div>
            </div>
        </section>

        <!-- Section 2: Featured Categories (Dense Grid) -->
        <section class="py-20 px-margin-desktop">
            <div class="flex justify-between items-end mb-12">
                <h2 class="text-headline-lg">دنیای محصولات پت‌کر</h2>
                <a href="#" class="text-primary font-bold hover:underline flex items-center gap-2">مشاهده همه <span class="material-symbols-outlined">chevron_left</span></a>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pharmacy -->
                <div class="group relative aspect-[4/5] rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o" alt="داروخانه">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-8 right-8 text-white">
                        <h4 class="text-headline-md font-bold">داروخانه</h4>
                        <p class="text-label-sm opacity-80">مکمل‌ها و داروهای نایاب</p>
                    </div>
                </div>
                <!-- Apparel -->
                <div class="group relative aspect-[4/5] rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKtf4eimUY5E8Ts0ArAFpKGX0kSgRYgemNuYLV-0kjBKpzfhS6-kKgvCuKiQnancWtDDWmCEN5RC3MIJfRgG95ZbKtfr2KWlINH4pjcCZYLsis-Fh3vU1f3ZbjJuFIPd-HNjdvWp5TSVrA7qjOtxYWAcPCdDkxZZmjPq0-LdT8TFPis7trtHp1_QTeIXl3o5aGIXE0qRa473pZ6SnNwHpz80pdcljlNsNP8n13ppl_7ZZW4Z46c1bj" alt="پوشاک">
                    <div class="absolute inset-0 bg-gradient-to-t from-secondary via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-8 right-8 text-white">
                        <h4 class="text-headline-md font-bold">پوشاک</h4>
                        <p class="text-label-sm opacity-80">استایل و راحتی چهار فصل</p>
                    </div>
                </div>
                <!-- Toys -->
                <div class="group relative aspect-[4/5] rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsm_sg4VlKSHpcOfcLE3gOwdTo1GG1jQRBPPFrcDxaZ_Ns_46U7AAxqMN5-gRD8xhBefgAjzfkwncuFZOp2K-JXSR50lxWxmSDuf8Ed74RsAW1fVV2QL1qn4LJczSR4I0jzHfOPB_a8fqBit2odwrEv6KCyt32eWKnqVyyCmhUBtC1IcA-2hK-l61vUN3TSwd1YQ0FxeZ9WCvajbHU1fGvEeVU6Ym1pTNYos5Kn-gQ8J9PMfE8QyaR" alt="اسباب بازی">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-8 right-8 text-white">
                        <h4 class="text-headline-md font-bold">سرگرمی</h4>
                        <p class="text-label-sm opacity-80">تخلیه انرژی و هوش</p>
                    </div>
                </div>
                <!-- Food -->
                <div class="group relative aspect-[4/5] rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQsPH2nC6QsVlQckvVzjRg1NfOR9A33iDk5dGkHxYPCwfOzHQVvfOUri1XiL-PiTdC_LcmvtQDPQZ_ZCRc9jFp7tIKRUjrKuBvyFNB5GPsRtmrt2P_LXzvwDO-Jx1iYXPnsw7GD-19aI9c5mIKUs8X2fWw5y41cnQAaJbQJZOQvw2wTIIreB1s0kuu6Wz9IjNLk1RjnmqDnEedi-C-7DV1UaxFXCFJG8VK6VOBmFqsr5B_MpUuQw-0" alt="خوراک">
                    <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-8 right-8 text-white">
                        <h4 class="text-headline-md font-bold">خوراک</h4>
                        <p class="text-label-sm opacity-80">برندهای جهانی و اورگانیک</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: Clinical Services Detail -->
        <section class="py-32 px-margin-desktop bg-surface-container-low rounded-[4rem] mb-32">
            <div class="flex flex-col lg:flex-row gap-20 items-center">
                <div class="lg:w-1/2">
                    <h2 class="text-display-lg text-primary mb-8">مرکز درمانی فوق‌تخصصی</h2>
                    <p class="text-body-lg text-on-surface-variant mb-12 leading-relaxed">ما با بهره‌گیری از تجهیزات مدرن و تیم متخصص، بالاترین استانداردهای مراقبتی را برای پت شما فراهم کرده‌ایم. سلامت آن‌ها، مأموریت ماست.</p>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined" data-icon="vaccines">vaccines</span>
                            </div>
                            <span class="text-title-lg font-bold">واکسیناسیون</span>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined" data-icon="medical_services">medical_services</span>
                            </div>
                            <span class="text-title-lg font-bold">جراحی عمومی</span>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined" data-icon="dentistry">dentistry</span>
                            </div>
                            <span class="text-title-lg font-bold">دندانپزشکی</span>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined" data-icon="videocam">videocam</span>
                            </div>
                            <span class="text-title-lg font-bold">ویزیت آنلاین</span>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="aspect-square bg-white p-8 rounded-[3rem] shadow-2xl overflow-hidden">
                        <img class="w-full h-full object-cover rounded-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUJoM_Cb8R1bvWWSCz2yxdiA9nIKNsl1SEJ9R40MzslKtcd2CpKfpmIAZcO67KF-CzRp08fneiShCpaSD-lFf5yI0cBJgW8EBMMLu9Bb_kdV_XyZcTTLQ7Ll-bxo2aej9wGv4I-Bp2N1YVe7srdsKFyH9MWnVbZwG3Gk6iRCa-pbdIX3EujAQPnUqaL5L1ZxQC-kqtxZSWDfnZYGQhSc9YdnlaczRv_iTpZWScGJ9SopSETZfLui4o" alt="Modern Vet Clinic">
                    </div>
                    <div class="absolute -bottom-8 -right-8 bg-secondary-container text-on-secondary-container w-40 h-40 rounded-full shadow-xl animate-bounce flex flex-col items-center justify-center text-center p-4">
    <p class="text-label-sm font-bold opacity-80 mb-1">آماده پذیرش</p>
    <p class="text-title-lg font-black leading-tight">بخش اورژانس شبانه‌روزی</p>
</div>
                </div>
            </div>
        </section>

        <!-- CHARITY DONATION SLIDER -->
        <section class="py-32 px-margin-desktop bg-primary text-on-primary rounded-[5rem] animate-fadeInUp mb-32">
            <div class="max-w-4xl mx-auto text-center mb-20">
                <h2 class="text-display-lg mb-6">خیریه پت‌کر ایران</h2>
                <p class="text-body-lg opacity-80">هر خرید شما، لبخندی برای یک حیوان بی‌پناه است. با هم دنیای بهتری می‌سازیم.</p>
            </div>
            <div class="relative overflow-hidden group px-4">
                <div class="flex transition-transform duration-500 ease-out" id="charity-slider">
                    <div class="min-w-full">
                        <div class="grid lg:grid-cols-2 gap-0 items-center bg-white rounded-[4rem] overflow-hidden shadow-2xl border border-outline-variant/20">
                            <div class="aspect-[4/3] lg:aspect-square overflow-hidden">
                                <img alt="Food for Strays" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA-Uy3zW-NiuSguB1l8eyrc3cLjf-CSAknFp2MviOMM8FTBk4ZENXi12n1fUt5ijXn33DSL31RnSirFYqVjbWTbFwMYgUKTvlDbt8yoC0qGJFZLpXoTBcpQaHj72rr2u4TxUFQDTCaayqE76jLPCEGTULp_GNJ2o_zH9b3EHRsgmVBft-pdd1wHNsi7HgMiZPrYr4zZmu_3WWcma1oVU1-5MjfzCJwwOt4sZ1Bg6-BiAWSWKOOaz1RF">
                            </div>
                            <div class="p-12 lg:p-20 bg-surface h-full flex flex-col justify-center">
                                <h3 class="text-headline-lg text-primary mb-6">غذارسانی به فرشتگان خیابان</h3>
                                <p class="text-body-lg text-on-surface-variant leading-relaxed mb-10">با اهدای مبلغ اندک، بسته‌های غذایی استاندارد برای حیوانات شهری تهیه و توسط تیم‌های داوطلب توزیع می‌شود.</p>
                                <button class="bg-secondary-container text-on-secondary-container px-12 py-5 rounded-2xl font-bold text-label-lg btn-premium w-fit flex items-center gap-3">
                                    <span class="">کمک به تغذیه حیوانات</span>
                                    <span class="material-symbols-outlined" data-icon="volunteer_activism">volunteer_activism</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DONOR HALL OF FAME -->
        <section class="py-32 px-margin-desktop animate-fadeInUp">
            <div class="text-center mb-24">
                <h2 class="text-display-lg text-primary mb-6">قهرمانان جامعه ما</h2>
                <p class="text-body-lg text-on-surface-variant">حامیانی که با قلب بزرگشان، مسیر زندگی صدها پت را تغییر دادند.</p>
            </div>
            <div class="relative h-[650px] flex items-center justify-center">
                <div class="relative w-full max-w-5xl h-full">
                    <div class="donor-bubble absolute z-30 transition-all duration-500 cursor-pointer" style="top: 15%; right: 40%;">
                        <div class="w-40 h-40 rounded-full medal-gold p-1 hover:scale-110 transition-transform">
                            <img class="w-full h-full rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAl_y7YXnA8SIEMDCF_xMbo6hp-SKe3vOCj1I_4tZIjCA1asy9l7bfNWIc2RIub6-mtRvibQkNNod20IsmKvoio65V_ixpIjim8_l0xAfCASw77K33osqHWZEIrbvbSAoM0LTvDI7CImH_-1O8h4lcjnRocvO9sasSKz3XN-u--8Gydw0MqHxJ2IWB3V-DPSrhz1crHZABKYtVU-9yJj1z7s3jZvuO7iFEV7VGr3VLGN5Vh2DCTxzcz">
                        </div>
                        <div class="tooltip absolute -top-20 left-1/2 -translate-x-1/2 bg-white px-6 py-3 rounded-2xl shadow-2xl opacity-0 transition-all pointer-events-none border border-outline-variant/30 w-max">
                            <p class="font-bold text-primary text-title-lg mb-1">سینا</p>
                            <p class="text-label-sm text-on-surface-variant">تامین ۵۰۰ وعده غذایی</p>
                        </div>
                    </div>
                    <div class="donor-bubble absolute z-20 transition-all duration-500 cursor-pointer" style="top: 40%; right: 15%;">
                        <div class="w-32 h-32 rounded-full medal-silver p-1 hover:scale-110 transition-transform">
                            <img class="w-full h-full rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDIn0GcJWNsHOjasKst1odj4NaGXfyaCs2O3qk8-0SvRbpFoPeo_XD2DyFGazwLSZR_amEMdLAoO4--QlckwjFqTwN_DPNxwmY0fv_ku08HKUbVG0BOnGW23Z6epjD99JiaVUErRcdAzCm02GrzlNX-OUq9lAIxK73gE9G1sh-qnSuVHgxpFNioDoZbgGYVM1bawbDXb6b_ijnu3NffNwcCpSq5mivSoV8oQXWC-NuI5BjsFPIeJgXO">
                        </div>
                        <div class="tooltip absolute -top-20 left-1/2 -translate-x-1/2 bg-white px-6 py-3 rounded-2xl shadow-2xl opacity-0 transition-all pointer-events-none border border-outline-variant/30 w-max">
                            <p class="font-bold text-primary text-title-lg mb-1">نگار</p>
                            <p class="text-label-sm text-on-surface-variant">۳ عمل جراحی اورژانسی</p>
                        </div>
                    </div>
                    <div class="donor-bubble absolute z-20 transition-all duration-500 cursor-pointer" style="top: 50%; left: 15%;">
                        <div class="w-28 h-28 rounded-full medal-bronze p-1 hover:scale-110 transition-transform">
                            <img class="w-full h-full rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDdIeUGCPRJcZbbsfdseNTIGbGdtrAJX9Mx_tdWN3CCAJOv2I0pUAqqJUNFWiHsjxPJ7oC4G0a7vL5fCp3vvNbJ-Do3-UKugoN_ahO_Y9QH444BaMILQzJ9ugp_hkj6fIqmoRZR9Ro4fizwCdxYSRpWL6Afsd4UlOh1I8mXkevd9bPlfu_9GCJzMU56y_9u8msJe2XOp7E7Hl_SkSKHHnHaaBtT8y3o0CJWSZs-wZcEu4NHVupkpfnx">
                        </div>
                        <div class="tooltip absolute -top-20 left-1/2 -translate-x-1/2 bg-white px-6 py-3 rounded-2xl shadow-2xl opacity-0 transition-all pointer-events-none border border-outline-variant/30 w-max">
                            <p class="font-bold text-primary text-title-lg mb-1">علی</p>
                            <p class="text-label-sm text-on-surface-variant">سرپرستی ۱۰ مورد درمان</p>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-primary/[0.03] rounded-full blur-[150px] -z-10 scale-150"></div>
                </div>
            </div>
        </section>

        <!-- Section 4: App Promo -->
        <section class="py-32 px-margin-desktop">
            <div class="bg-secondary-container rounded-[4rem] p-12 lg:p-24 flex flex-col lg:flex-row items-center gap-20 overflow-hidden relative">
                <div class="lg:w-1/2 text-on-secondary-container relative z-10">
                    <h2 class="text-display-lg mb-8 leading-tight">پت‌کر در جیب شما؛<br>همیشه و همه‌جا</h2>
                    <p class="text-body-lg mb-12 opacity-90">با اپلیکیشن اختصاصی پت‌کر ایران، تاریخچه درمانی، یادآور داروها و دستیار هوشمند را همیشه همراه داشته باشید.</p>
                    <div class="flex flex-wrap gap-4">
                        <button class="bg-primary text-white px-8 py-4 rounded-2xl font-bold flex items-center gap-3 btn-premium">
                            <span class="material-symbols-outlined">download</span>
                            <span class="">دانلود از کافه بازار</span>
                        </button>
                        <button class="bg-white text-primary px-8 py-4 rounded-2xl font-bold flex items-center gap-3 btn-premium">
                            <span class="material-symbols-outlined" data-original-icon="apple">circle</span>
                            <span class="">دانلود نسخه iOS</span>
                        </button>
                    </div>
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="relative z-10 scale-110 lg:translate-y-20">
                        <img class="max-w-xs mx-auto" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAK09JKJoAW8IDlEV62F6EhK_ZclTl0BOOrqKrLEW2LdmMUUKCgKaCvd8029q_FyH4ymM-2SVcFZw8N6Tqlj4EciX67Lnru9OKtRYzJWuMG1JfxHDb1KG63NJhXaCCSPJy3-B8E6WONsDmYn3gcGkjf_DWLfzgdMEfrKTfzso9ieBYc79JWN-ecwZOylLr38UcA5MDun5xS5Oyqn8Fcl5bFUF1ulD53gmeDWIy9gB_-vJmbWN35nXzR" alt="App Mockup">
                    </div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/20 rounded-full blur-3xl"></div>
                </div>
                <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
            </div>
        </section>

        <!-- Section 5: Trust Metrics & Newsletter -->
        <section class="py-32 px-margin-desktop bg-surface-container-low mb-16 rounded-[4rem]">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 mb-32">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-white rounded-2xl mx-auto flex items-center justify-center text-primary shadow-lg mb-6 group-hover:-translate-y-2 transition-transform">
                        <span class="material-symbols-outlined text-4xl">pets</span>
                    </div>
                    <p class="text-headline-md font-black">+۵۰,۰۰۰</p>
                    <p class="text-label-lg opacity-70">حیوان خوشحال</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-white rounded-2xl mx-auto flex items-center justify-center text-primary shadow-lg mb-6 group-hover:-translate-y-2 transition-transform">
                        <span class="material-symbols-outlined text-4xl">stethoscope</span>
                    </div>
                    <p class="text-headline-md font-black">+۱۲۰</p>
                    <p class="text-label-lg opacity-70">دامپزشک همکار</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-white rounded-2xl mx-auto flex items-center justify-center text-primary shadow-lg mb-6 group-hover:-translate-y-2 transition-transform">
                        <span class="material-symbols-outlined text-4xl">support_agent</span>
                    </div>
                    <p class="text-headline-md font-black">۲۴/۷</p>
                    <p class="text-label-lg opacity-70">پشتیبانی تخصصی</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-white rounded-2xl mx-auto flex items-center justify-center text-primary shadow-lg mb-6 group-hover:-translate-y-2 transition-transform">
                        <span class="material-symbols-outlined text-4xl">verified</span>
                    </div>
                    <p class="text-headline-md font-black">۱۰۰٪</p>
                    <p class="text-label-lg opacity-70">تضمین اصالت</p>
                </div>
            </div>

            <div class="max-w-3xl mx-auto bg-white/60 backdrop-blur-xl p-12 rounded-[3rem] border border-white text-center">
                <h3 class="text-headline-lg text-primary mb-4">عضویت در خبرنامه سلامتی</h3>
                <p class="text-body-md text-on-surface-variant mb-8">آخرین مقالات علمی و تخفیف‌های اختصاصی را در ایمیل خود دریافت کنید.</p>
                <div class="flex gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="آدرس ایمیل شما" class="flex-1 bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary/20">
                    <button class="bg-primary text-white px-8 py-4 rounded-2xl font-bold btn-premium">اشتراک</button>
                </div>
            </div>
        </section>
    </main>

<?php
include 'includes/footer.php';
?>