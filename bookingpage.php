<?php
require_once 'includes/db.php';
require_once 'includes/header.php';

// Fetch doctors
try {
    $stmt = $pdo->query("SELECT * FROM doctors ORDER BY rating DESC");
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $doctors = [];
}

// Fetch user's pet data if logged in
$user_pets = [];
if (isset($_SESSION['user_id'])) {
    try {
        $stmt = $pdo->prepare("SELECT id, name, type, race FROM user_pets WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$_SESSION['user_id']]);
        $user_pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // ignore
    }
}
?>

<!-- Include page-specific styles -->
<link rel="stylesheet" href="assets/css/booking.css">
<style>
    /* Add specific styles for selected states */
    .doctor-card.selected {
        border-color: #fd8100 !important;
        background-color: #f9f9f9 !important;
    }
    .date-card.selected {
        border-color: #fd8100 !important;
        background-color: #eeeeee !important;
    }
    .time-btn.selected {
        background-color: #002d72 !important;
        color: white !important;
        border-color: #002d72 !important;
    }
</style>

<main class="max-w-container-max mx-auto overflow-hidden py-8 px-margin-desktop min-h-[70vh]">
    <!-- Breadcrumb -->
    <div class="text-label-sm text-on-surface-variant mb-6">
        <a href="index.php" class="hover:underline">خانه</a> > 
        <a href="bookingpage.php" class="text-on-surface">رزرو نوبت</a>
    </div>

    <?php if(isset($_SESSION['booking_error'])): ?>
        <div class="bg-error/10 text-error p-4 rounded-xl mb-6 text-body-md font-bold text-center border border-error/20">
            <?php 
                echo htmlspecialchars($_SESSION['booking_error']); 
                unset($_SESSION['booking_error']);
            ?>
        </div>
    <?php endif; ?>

    <!-- Progressive Stepper -->
    <div class="flex items-center justify-center mb-12">
        <div class="flex items-center w-full max-w-3xl">
            <div class="flex flex-col items-center flex-1 relative">
                <div class="w-10 h-10 rounded-full bg-primary-container text-white flex items-center justify-center font-bold z-10">۱</div>
                <span class="mt-2 text-label-lg font-label-lg text-primary">انتخاب پزشک</span>
            </div>
            <div class="flex-auto border-t-2 border-primary-container mx-2 -mt-7"></div>
            <div class="flex flex-col items-center flex-1 relative">
                <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold z-10" id="step-2-indicator">۲</div>
                <span class="mt-2 text-label-lg font-label-lg text-on-surface-variant" id="step-2-text">انتخاب زمان</span>
            </div>
            <div class="flex-auto border-t-2 border-surface-variant mx-2 -mt-7"></div>
            <div class="flex flex-col items-center flex-1 relative">
                <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold z-10" id="step-3-indicator">۳</div>
                <span class="mt-2 text-label-lg font-label-lg text-on-surface-variant" id="step-3-text">تأیید نهایی</span>
            </div>
        </div>
    </div>

    <!-- Booking Form -->
    <form action="booking_action.php" method="POST" id="booking-form" class="flex flex-col lg:flex-row-reverse gap-8">
        
        <!-- Hidden Inputs to store selections -->
        <input type="hidden" name="doctor_id" id="input_doctor_id" value="">
        <input type="hidden" name="appointment_date" id="input_date" value="">
        <input type="hidden" name="appointment_time" id="input_time" value="">

        <!-- Left Side: Main Selection -->
        <div class="flex-grow space-y-10">
            <!-- Doctor Selection Section -->
            <section>
                <div class="flex justify-between items-end mb-6">
                    <h1 class="text-headline-md font-headline-md text-primary">رزرو نوبت دکتر</h1>
                    <a class="text-primary text-label-lg font-label-lg hover:underline" href="#">مشاهده همه پزشکان</a>
                </div>
                <div class="flex overflow-x-auto gap-4 pb-4 custom-scrollbar snap-x" id="doctors-list">
                    
                    <?php foreach($doctors as $index => $doctor): ?>
                    <div class="doctor-card min-w-[280px] bg-white border border-outline-variant rounded-xl p-4 snap-start hover:shadow-md transition-all group cursor-pointer hover:-translate-y-1 duration-300"
                         data-id="<?php echo $doctor['id']; ?>"
                         data-name="<?php echo htmlspecialchars($doctor['name']); ?>"
                         data-image="<?php echo htmlspecialchars($doctor['image_url']); ?>"
                         data-price="<?php echo $doctor['price']; ?>"
                         onclick="selectDoctor(this)">
                        
                        <div class="relative mb-4">
                            <img class="w-full h-48 object-cover rounded-lg" src="<?php echo htmlspecialchars($doctor['image_url']); ?>" alt="<?php echo htmlspecialchars($doctor['name']); ?>"/>
                            <?php if($index === 0): ?>
                            <div class="absolute top-2 left-2 bg-status-active text-white text-[10px] px-2 py-1 rounded-full flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                آماده ویزیت
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-title-lg font-title-lg text-primary"><?php echo htmlspecialchars($doctor['name']); ?></h3>
                            <p class="text-body-md font-body-md text-on-surface-variant"><?php echo htmlspecialchars($doctor['specialty']); ?></p>
                            <div class="flex items-center gap-1 text-status-warning">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-label-lg font-label-lg text-on-surface"><?php echo $doctor['rating']; ?></span>
                                <span class="text-label-sm font-label-sm text-on-surface-variant">(<?php echo $doctor['review_count']; ?> نظر)</span>
                            </div>
                        </div>
                        <button type="button" class="w-full mt-4 border border-primary text-primary py-2 rounded-lg text-label-lg font-label-lg hover:bg-primary-container hover:text-white transition-colors select-btn">انتخاب پزشک</button>
                    </div>
                    <?php endforeach; ?>

                </div>
            </section>
            
            <!-- Scheduling Interface -->
            <section class="space-y-6">
                <h2 class="text-title-lg font-title-lg text-primary">انتخاب تاریخ و زمان</h2>
                
                <!-- Date Picker -->
                <div class="flex gap-3 overflow-x-auto pb-2 custom-scrollbar" id="dates-list">
                    <?php 
                        // Generate some upcoming dates dynamically for realism
                        $days = ['یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه', 'شنبه'];
                        $months = ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'];
                        
                        for ($i = 0; $i < 7; $i++): 
                            $timestamp = strtotime("+$i days");
                            $day_name = $i == 0 ? 'امروز' : $days[date('w', $timestamp)];
                            $day_num = date('d', $timestamp);
                            // Fake jalali conversion for UI display
                            $display_date = "۲۰۲۴-" . date('m-d', $timestamp); 
                    ?>
                    <div class="date-card flex-shrink-0 w-20 h-24 glass-card rounded-lg flex flex-col items-center justify-center cursor-pointer border-2 border-transparent hover:bg-surface-container transition-colors"
                         data-date="<?php echo $display_date; ?>"
                         data-display="<?php echo "{$day_name}، $day_num"; ?>"
                         onclick="selectDate(this)">
                        <span class="text-label-sm font-label-sm text-on-surface-variant"><?php echo $day_name; ?></span>
                        <span class="text-headline-md font-headline-md text-on-surface"><?php echo $day_num; ?></span>
                    </div>
                    <?php endfor; ?>
                </div>
                
                <!-- Time Slots Grid -->
                <div class="space-y-4" id="times-list">
                    <div class="flex items-center gap-2 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">light_mode</span>
                        <span class="text-label-lg font-label-lg">صبح (۰۹:۰۰ - ۱۲:۰۰)</span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        <?php foreach(['۰۹:۰۰', '۰۹:۳۰', '۱۰:۰۰', '۱۰:۳۰', '۱۱:۳۰'] as $time): ?>
                        <button type="button" class="time-btn py-3 px-4 rounded-lg bg-white border border-outline-variant text-body-md font-body-md hover:border-primary transition-colors text-center"
                                onclick="selectTime(this, '<?php echo $time; ?> صبح')"><?php echo $time; ?></button>
                        <?php endforeach; ?>
                        <button type="button" class="py-3 px-4 rounded-lg bg-surface-container-low text-on-surface-variant/40 border border-transparent line-through text-body-md font-body-md cursor-not-allowed text-center" disabled>۱۱:۰۰</button>
                    </div>
                    
                    <div class="flex items-center gap-2 text-on-surface-variant pt-4">
                        <span class="material-symbols-outlined text-[20px]">wb_sunny</span>
                        <span class="text-label-lg font-label-lg">بعد از ظهر (۱۴:۰۰ - ۱۸:۰۰)</span>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        <?php foreach(['۱۴:۰۰', '۱۴:۳۰', '۱۵:۰۰', '۱۵:۳۰', '۱۶:۰۰', '۱۶:۳۰', '۱۷:۰۰'] as $time): ?>
                        <button type="button" class="time-btn py-3 px-4 rounded-lg bg-white border border-outline-variant text-body-md font-body-md hover:border-primary transition-colors text-center"
                                onclick="selectTime(this, '<?php echo $time; ?> عصر')"><?php echo $time; ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- Pet Information Section -->
            <section class="space-y-6 bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/50">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-title-lg font-title-lg text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined">pets</span>
                        اطلاعات بیمار (حیوان خانگی)
                    </h2>
                </div>
                <p class="text-body-md text-on-surface-variant mb-4">لطفاً مشخص کنید این نوبت برای چه حیوانی رزرو می‌شود.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if(count($user_pets) > 0): ?>
                    <div class="col-span-1 md:col-span-2 space-y-2 mb-2">
                        <label class="text-label-md font-bold text-on-surface-variant">انتخاب از حیوانات ثبت شده شما</label>
                        <select class="w-full h-12 px-4 appearance-none rounded-lg border border-outline-variant focus:border-primary-container bg-white text-sm" onchange="if(this.value){ const p = JSON.parse(this.value); document.getElementById('pet_type').value = p.type; document.getElementById('pet_race').value = p.race; checkFormCompleteness(); }">
                            <option value="">-- انتخاب کنید یا اطلاعات را به صورت دستی وارد کنید --</option>
                            <?php foreach($user_pets as $pet): ?>
                                <option value='<?php echo json_encode(["type" => $pet["type"], "race" => $pet["race"]]); ?>'><?php echo htmlspecialchars($pet['name'] . ' (' . $pet['type'] . ')'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>
                    
                    <div class="space-y-2">
                        <label class="text-label-md font-bold text-on-surface-variant">نوع حیوان</label>
                        <div class="relative">
                            <select name="pet_type" id="pet_type" required class="w-full h-12 px-4 appearance-none rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container bg-white text-sm text-on-surface transition-colors pr-4 pl-10" onchange="checkFormCompleteness()">
                                <option value="">انتخاب کنید...</option>
                                <option value="سگ">سگ</option>
                                <option value="گربه">گربه</option>
                                <option value="پرنده">پرنده</option>
                                <option value="جونده">جونده (خرگوش، همستر و...)</option>
                                <option value="خزنده">خزنده</option>
                                <option value="سایر">سایر</option>
                            </select>
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant pointer-events-none">expand_more</span>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-label-md font-bold text-on-surface-variant">نژاد (اختیاری)</label>
                        <input type="text" name="pet_race" id="pet_race" value="" placeholder="مثال: پرشین، ژرمن و..."
                               class="w-full h-12 px-4 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container bg-white text-sm text-on-surface transition-colors" />
                    </div>
                </div>
            </section>
        </div>
        
        <!-- Right Side: Sticky Summary Sidebar -->
        <aside class="w-full lg:w-[380px] shrink-0">
            <div class="sticky top-28 bg-white rounded-2xl border border-outline-variant/30 shadow-lg space-y-8 p-8">
                <h2 class="text-title-lg font-title-lg text-primary mb-6">خلاصه رزرو</h2>
                <div class="space-y-6">
                    <!-- Selected Doctor Summary -->
                    <div id="summary-doctor" class="flex items-center gap-4 p-3 bg-surface-container-lowest border border-outline-variant/30 rounded-xl opacity-50 transition-opacity">
                        <img id="summary-doctor-img" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-sm" src="https://via.placeholder.com/150?text=?"/>
                        <div>
                            <p class="text-label-sm font-label-sm text-on-surface-variant">پزشک انتخابی</p>
                            <h4 id="summary-doctor-name" class="text-body-lg font-body-lg font-bold text-primary">پزشک را انتخاب کنید</h4>
                        </div>
                    </div>
                    
                    <!-- Details List -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-body-md font-body-md">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                تاریخ
                            </div>
                            <span id="summary-date" class="text-on-surface font-semibold text-on-surface-variant">انتخاب نشده</span>
                        </div>
                        <div class="flex justify-between items-center text-body-md font-body-md">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[18px]">schedule</span>
                                ساعت
                            </div>
                            <span id="summary-time" class="text-on-surface font-semibold text-on-surface-variant">انتخاب نشده</span>
                        </div>
                        <div class="flex justify-between items-center text-body-md font-body-md">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                                کلینیک
                            </div>
                            <span class="text-on-surface font-semibold">شعبه مرکزی ونک</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-outline-variant/30 pt-6">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-title-lg font-title-lg text-on-surface">هزینه ویزیت</span>
                            <div class="text-right flex items-baseline gap-1">
                                <span id="summary-price" class="text-headline-md font-headline-md text-primary tracking-tight">---</span>
                                <span class="text-label-sm font-label-sm text-on-surface-variant">تومان</span>
                            </div>
                        </div>
                        
                        <button type="submit" id="submit-btn" disabled class="w-full bg-surface-container-high text-on-surface-variant py-4 rounded-xl text-title-lg font-title-lg font-bold transition-all flex justify-center items-center gap-2 cursor-not-allowed">
                            لطفا فرم را تکمیل کنید
                        </button>
                        
                        <p class="mt-4 text-center text-label-sm font-label-sm text-on-surface-variant">
                            امکان لغو رایگان تا ۲۴ ساعت قبل از نوبت
                        </p>
                    </div>
                </div>
            </div>
        </aside>
    </form>
</main>

<script>
    // Booking interactive logic
    let selectedDoctorId = null;
    let selectedDate = null;
    let selectedTime = null;

    function selectDoctor(card) {
        // Reset all
        document.querySelectorAll('.doctor-card').forEach(c => {
            c.classList.remove('selected', 'border-secondary-container');
            c.querySelector('.select-btn').className = "w-full mt-4 border border-primary text-primary py-2 rounded-lg text-label-lg font-label-lg hover:bg-primary-container hover:text-white transition-colors select-btn";
            c.querySelector('.select-btn').textContent = "انتخاب پزشک";
        });
        
        // Select this
        card.classList.add('selected', 'border-secondary-container');
        card.querySelector('.select-btn').className = "w-full mt-4 bg-primary text-white py-2 rounded-lg text-label-lg font-label-lg select-btn";
        card.querySelector('.select-btn').textContent = "انتخاب شد";
        
        selectedDoctorId = card.dataset.id;
        document.getElementById('input_doctor_id').value = selectedDoctorId;
        
        // Update summary
        document.getElementById('summary-doctor').classList.remove('opacity-50');
        document.getElementById('summary-doctor-name').textContent = card.dataset.name;
        document.getElementById('summary-doctor-img').src = card.dataset.image;
        
        // Format price (e.g. 450000 -> ۴۵۰,۰۰۰)
        let priceStr = new Intl.NumberFormat('fa-IR').format(card.dataset.price);
        document.getElementById('summary-price').textContent = priceStr;
        
        updateStepper();
        checkFormCompleteness();
    }

    function selectDate(card) {
        document.querySelectorAll('.date-card').forEach(c => c.classList.remove('selected', 'border-b-4'));
        card.classList.add('selected', 'border-b-4');
        
        selectedDate = card.dataset.date;
        document.getElementById('input_date').value = selectedDate;
        
        document.getElementById('summary-date').textContent = card.dataset.display;
        document.getElementById('summary-date').classList.remove('text-on-surface-variant');
        
        updateStepper();
        checkFormCompleteness();
    }

    function selectTime(btn, displayTime) {
        document.querySelectorAll('.time-btn').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        
        selectedTime = displayTime;
        document.getElementById('input_time').value = selectedTime;
        
        document.getElementById('summary-time').textContent = displayTime;
        document.getElementById('summary-time').classList.remove('text-on-surface-variant');
        
        updateStepper();
        checkFormCompleteness();
    }

    function updateStepper() {
        if (selectedDoctorId) {
            document.getElementById('step-2-indicator').classList.replace('bg-surface-container-high', 'bg-primary-container');
            document.getElementById('step-2-indicator').classList.replace('text-on-surface-variant', 'text-white');
            document.getElementById('step-2-text').classList.replace('text-on-surface-variant', 'text-primary');
        }
        if (selectedDoctorId && selectedDate && selectedTime) {
            document.getElementById('step-3-indicator').classList.replace('bg-surface-container-high', 'bg-primary-container');
            document.getElementById('step-3-indicator').classList.replace('text-on-surface-variant', 'text-white');
            document.getElementById('step-3-text').classList.replace('text-on-surface-variant', 'text-primary');
        }
    }

    function checkFormCompleteness() {
        const submitBtn = document.getElementById('submit-btn');
        const petType = document.getElementById('pet_type').value;
        
        if (selectedDoctorId && selectedDate && selectedTime && petType) {
            submitBtn.disabled = false;
            submitBtn.className = "w-full bg-[#f97316] text-white py-4 rounded-xl text-title-lg font-title-lg font-bold hover:bg-[#ea580c] transition-colors shadow-lg shadow-secondary-container/20 flex justify-center items-center gap-2";
            submitBtn.textContent = "تأیید و ادامه پرداخت";
        } else {
            submitBtn.disabled = true;
            submitBtn.className = "w-full bg-surface-container-high text-on-surface-variant py-4 rounded-xl text-title-lg font-title-lg font-bold transition-all flex justify-center items-center gap-2 cursor-not-allowed";
            submitBtn.textContent = "لطفا فرم را تکمیل کنید";
        }
    }
</script>

<script src="assets/js/booking.js"></script>

<?php include 'includes/footer.php'; ?>