    <!-- Footer -->
    <footer class="bg-surface-container-low border border-outline-variant/30 rounded-[2rem] md:rounded-[3rem] mt-16 md:mt-24 w-[96%] max-w-[1600px] mx-auto overflow-hidden">
        <div class="flex flex-col lg:flex-row-reverse justify-between px-6 lg:px-10 py-10 lg:py-16 gap-10 lg:gap-16">
            <div class="flex flex-col gap-6 lg:w-1/3 text-center lg:text-right items-center lg:items-start">
                <h3 class="text-3xl font-bold text-primary">PetCare Iran</h3>
                <p class="text-sm text-on-surface-variant leading-relaxed">اولین اکوسیستم هوشمند مراقبت از حیوانات خانگی در ایران. تلفیقی از تخصص پزشکی، تکنولوژی روز و عشق به حیوانات.</p>
                <div class="flex gap-4">
                    <a class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-primary hover:bg-primary-container hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                    <a class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-primary hover:bg-primary-container hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined">mail</span>
                    </a>
                    <a class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-primary hover:bg-primary-container hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined">call</span>
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12 flex-1 text-center sm:text-right">
                <div class="flex flex-col gap-4 lg:gap-5">
                    <h4 class="font-bold text-lg text-primary">فروشگاه</h4>
                    <nav class="flex flex-col gap-3">
                        <a class="text-sm text-on-surface-variant hover:text-secondary-container transition-colors" href="shop.php">غذای سگ و گربه</a>
                        <a class="text-sm text-on-surface-variant hover:text-secondary-container transition-colors" href="shop.php">لوازم بهداشتی</a>
                        <a class="text-sm text-on-surface-variant hover:text-secondary-container transition-colors" href="shop.php">اسباب‌بازی</a>
                    </nav>
                </div>
                <div class="flex flex-col gap-5">
                    <h4 class="font-bold text-lg text-primary">خدمات درمانی</h4>
                    <nav class="flex flex-col gap-3">
                        <a class="text-sm text-on-surface-variant hover:text-secondary-container transition-colors" href="#">رزرو ویزیت</a>
                        <a class="text-sm text-on-surface-variant hover:text-secondary-container transition-colors" href="#">مشاوره هوشمند</a>
                        <a class="text-sm text-on-surface-variant hover:text-secondary-container transition-colors" href="#">واکسیناسیون</a>
                    </nav>
                </div>
                <div class="flex flex-col gap-5">
                    <h4 class="font-bold text-lg text-primary">راهنما</h4>
                    <nav class="flex flex-col gap-3">
                        <a class="text-sm text-on-surface-variant hover:text-secondary-container transition-colors" href="#">سوالات متداول</a>
                    </nav>
                </div>
            </div>
        </div>
    </footer>

    <!-- Autoship Web Worker Trigger (Poor Man's Cron) -->
    <script>
        // Trigger the autoship worker asynchronously. 
        // It checks its own lock file so it only actually runs once a day.
        fetch('actions/autoship_worker.php', { method: 'POST' }).catch(() => {});
    </script>
</body>
</html>
