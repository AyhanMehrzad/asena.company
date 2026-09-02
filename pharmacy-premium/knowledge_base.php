<?php
/**
 * ASENA Platform — Official Knowledge Base & Veterinary Medical Authority Hub
 * Features: High-SEO Medical Articles, Platform User Guides, Deep Blue Glassmorphism UI,
 * Schema.org MedicalWebPage & Article JSON-LD, E-E-A-T Doctor Attributions, and AI Citations.
 */

require_once __DIR__ . '/includes/db.php';

// Define the 8 Master Articles with Full Text, Meta, FAQs, and Author Credentials
$articles = [
    'vaccination-schedule-dogs-cats' => [
        'title' => 'جدول کامل واکسیناسیون سگ و گربه در ایران + سنین تزریق و مراقبت‌ها',
        'short_desc' => 'راهنمای جامع واکسن‌های چندگانه (پلی‌والان)، هاری، لوسمی و لوکوسیت در ایران به همراه جدول سنین تزریق در تولگی و دوزهای یادآور سالانه.',
        'category' => 'medical',
        'category_name' => 'پزشکی و سلامت',
        'read_time' => '۸ دقیقه مطالعه',
        'author' => 'دکتر فرهاد کریمی',
        'author_role' => 'متخصص داخلی دامپزشکی (نظام دامپزشکی: ۲۴۸۹۱)',
        'updated_at' => '۲۰۲۶-۰۹-۰۱',
        'icon' => 'vaccines',
        'accent_color' => 'from-blue-600 to-indigo-700',
        'content' => <<<HTML
<h3>مقدمه و اهمیت حیاتی واکسیناسیون به موقع</h3>
<p>واکسیناسیون یکی از موثرترین و ارزان‌ترین روش‌های پیشگیری از بیماری‌های کشنده و مسری ویروسی در سگ‌ها و گربه‌ها است. در شرایط اپیدمیولوژیک ایران، به دلیل وجود سویه‌های بومی ویروس پاروو (Parvovirus)، دیستمپر (Distemper) و هاری (Rabies)، ایمن‌سازی دقیق طبق جدول استاندارد جهانی WSAVA و دستورالعمل سازمان دامپزشکی کشور امری ضروری است.</p>

<div class="my-6 p-5 rounded-2xl bg-blue-500/10 border border-blue-500/20 backdrop-blur-md">
    <h4 class="font-bold text-base text-primary flex items-center gap-2 mb-2">
        <span class="material-symbols-outlined text-primary">info</span>
        نکته کلیدی پیش از شروع واکسیناسیون
    </h4>
    <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300">
        حداقل ۴۸ ساعت قبل از تزریق واکسن، حیوان خانگی باید توسط دامپزشک معاینه بالینی شده، تب‌سنجی شود و فاقد هرگونه علائم بیماری مانند بی‌حالی، اسهال یا آبریزش بینی باشد. همچنین انگل‌زدایی با قرص یا قطره ضدانگل حداقل یک هفته قبل از واکسن، اثربخشی ایمنی را دوچندان می‌کند.
    </p>
</div>

<h3>جدول پروتکل واکسیناسیون سگ در ایران</h3>
<div class="overflow-x-auto my-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
    <table class="w-full text-sm text-right border-collapse">
        <thead class="bg-slate-100 dark:bg-slate-800/80 text-primary font-bold">
            <tr>
                <th class="p-4">سن حیوان</th>
                <th class="p-4">نوع واکسن</th>
                <th class="p-4">بیماری‌های هدف</th>
                <th class="p-4">توضیحات ضروری</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
            <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors">
                <td class="p-4 font-bold">۶ تا ۸ هفتگی</td>
                <td class="p-4">تک‌گانه یا دوگانه (Puppy DP)</td>
                <td class="p-4">پاروو ویروس و دیستمپر</td>
                <td class="p-4">به ویژه در محیط‌های پرخطر یا پناهگاه‌ها</td>
            </tr>
            <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors">
                <td class="p-4 font-bold">۹ تا ۱۰ هفتگی</td>
                <td class="p-4">پنج‌گانه یا هفت‌گانه (DHPPi/L)</td>
                <td class="p-4">دیستمپر، هپاتیت، پاروو، پاراآنفلوانزا، لپتوسپیروز</td>
                <td class="p-4">شروع واکسن چندگانه اصلی (دوز اول)</td>
            </tr>
            <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors">
                <td class="p-4 font-bold">۱۲ تا ۱۴ هفتگی</td>
                <td class="p-4">یادآور هفت‌گانه یا هشت‌گانه</td>
                <td class="p-4">ویروس‌های تنفسی، گوارشی و کروناویروس سگ‌سانان</td>
                <td class="p-4">تکمیل دوز دوم واکسن پلی‌والان</td>
            </tr>
            <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors">
                <td class="p-4 font-bold">۱۶ هفتگی (۴ ماهگی)</td>
                <td class="p-4">واکسن هاری (Rabies) + دوز سوم پلی‌والان</td>
                <td class="p-4">ویروس کشنده هاری (مشترک با انسان)</td>
                <td class="p-4">الزامی بر اساس قوانین سازمان دامپزشکی + صدور هولوگرام شناسنامه</td>
            </tr>
            <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-colors">
                <td class="p-4 font-bold">سالانه (Booster)</td>
                <td class="p-4">پلی‌والان کامل + هاری</td>
                <td class="p-4">حفظ سطح آنتی‌بادی ایمنی بدن</td>
                <td class="p-4">هر سال یک‌بار تا پایان عمر حیوان</td>
            </tr>
        </tbody>
    </table>
</div>

<h3>جدول پروتکل واکسیناسیون گربه در ایران</h3>
<p>گربه‌ها نیازمند واکسن سه‌گانه اصلی (FVRCP) هستند که از عفونت‌های حاد مجاری تنفسی و روده محافظت می‌کند:</p>
<ul class="list-disc pr-6 my-4 space-y-2 text-slate-700 dark:text-slate-300">
    <li><strong>۸ هفتگی (۲ ماهگی):</strong> دوز اول واکسن سه‌گانه گربه (شامل پن‌لوکوپنی، هرپس ویروس و کالیچی ویروس).</li>
    <li><strong>۱۲ هفتگی (۳ ماهگی):</strong> دوز دوم (یادآور) واکسن سه‌گانه گربه.</li>
    <li><strong>۱۶ هفتگی (۴ ماهگی):</strong> دوز اول واکسن هاری و در صورت تماس با گربه‌های دیگر واکسن لوسمی (FeLV).</li>
    <li><strong>سالانه:</strong> تزریق واکسن سه‌گانه و هاری به صورت منظم سالیانه.</li>
</ul>

<h3>مراقبت‌های حیاتی پس از تزریق واکسن</h3>
<ol class="list-decimal pr-6 my-4 space-y-3 text-slate-700 dark:text-slate-300">
    <li><strong>استراحت کامل ۲۴ تا ۴۸ ساعته:</strong> مقداری تب خفیف، بی‌حالی یا خواب‌آلودگی طبیعی است.</li>
    <li><strong>ممنوعیت حمام کردن:</strong> تا ۷ روز پس از تزریق واکسن، نباید حیوان را حمام کرد تا سیستم ایمنی ضعیف نشود.</li>
    <li><strong>ممنوعیت پیاده‌روی بیرون از خانه:</strong> توله‌ها تا ۲ هفته پس از اتمام آخرین دوز واکسیناسیون (۴ ماهگی) نباید روی زمین بیرون از منزل راه بروند.</li>
    <li><strong>واکنش‌های آلرژیک شدید:</strong> در صورت بروز تورم شدید دور چشم، کهیر یا تنگی نفس، فوراً با بخش اورژانس کلینیک تماس بگیرید.</li>
</ol>
HTML
        ,
        'faqs' => [
            ['q' => 'آیا واکسن هاری برای گربه‌هایی که همیشه در آپارتمان هستند نیز الزامی است؟', 'a' => 'بله، ویروس هاری یک بیماری صددرصد کشنده و مشترک با انسان است. طبق دستورالعمل‌های بهداشتی و حقوقی در ایران، تزریق سالانه هاری برای تمامی گربه‌ها و سگ‌ها صرف‌نظر از محل نگهداری الزامی است.'],
            ['q' => 'اگر واکسن سالانه چند ماه به تاخیر بیفتد چه باید کرد؟', 'a' => 'اگر تاخیر کمتر از ۲ ماه باشد، تزریق یک دوز کفایت می‌کند. اما در تاخیرهای طولانی، دامپزشک ممکن است دو دوز با فاصله ۳ هفته برای بازآموزی سیستم ایمنی تجویز نماید.'],
            ['q' => 'چگونه می‌توان نوبت واکسیناسیون در آسنا رزرو کرد؟', 'a' => 'از طریق منوی رزرو آنلاین کلینیک، پزشک و زمان مورد نظر را انتخاب کرده و با مراجعه به کلینیک واکسن با زنجیره سرد استاندارد تزریق و در شناسنامه هولوگرام‌دار ثبت می‌شود.']
        ]
    ],

    'pet-poisoning-emergency-guide' => [
        'title' => 'علائم مسمومیت در حیوانات خانگی و اقدامات اورژانسی حیاتی دامپزشکی',
        'short_desc' => 'شناخت سموم خانگی رایج (شکلات، زایلیتول، لیلیوم، جونده‌کش‌ها)، علائم مسمومیت و کارهایی که باید و نباید در دقایق اولیه انجام دهید.',
        'category' => 'medical',
        'category_name' => 'پزشکی و سلامت',
        'read_time' => '۷ دقیقه مطالعه',
        'author' => 'دکتر سارا مهدوی',
        'author_role' => 'متخصص سم‌شناسی و مراقبت‌های ویژه دامپزشکی',
        'updated_at' => '۲۰۲۶-۰۹-۰۱',
        'icon' => 'warning',
        'accent_color' => 'from-rose-600 to-red-700',
        'content' => <<<HTML
<h3>مسمومیت در حیوانات: دقایق طلایی نجات</h3>
<p>حیوانات خانگی به دلیل حس کنجکاوی و حس چشایی قوی، همواره در معرض خطر بلعیدن مواد سمی هستند. متابولیسم کبد و کلیه سگ‌ها و گربه‌ها تفاوت‌های ریشه‌ای با انسان دارد؛ بنابراین موادی که برای ما بی‌ضررند، می‌توانند برای پت مرگ‌آور باشند.</p>

<h3>۵ ماده سمی خانگی بسیار خطرناک</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6">
    <div class="p-4 rounded-xl border border-red-200 dark:border-red-900/30 bg-red-50/50 dark:bg-red-950/10">
        <h4 class="font-bold text-red-700 dark:text-red-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">emergency</span>
            ۱. شکلات و کاکائو (تئوبرومین)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-400">سگ‌ها قادر به هضم آلکالوئید تئوبرومین نیستند. شکلات تلخ و پودر کاکائو باعث تپش قلب شدید، لرزش عضلانی، تشنج و ایست قلبی می‌شود.</p>
    </div>
    <div class="p-4 rounded-xl border border-red-200 dark:border-red-900/30 bg-red-50/50 dark:bg-red-950/10">
        <h4 class="font-bold text-red-700 dark:text-red-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">emergency</span>
            ۲. شیرین‌کننده زایلیتول (Xylitol)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-400">در آدامس‌های بدون قند، کره بادام‌زمینی رژیمی و خمیردندان وجود دارد. در سگ‌ها موجب افت قند خون ناگهانی و نارسایی حاد کبد در کمتر از ۳۰ دقیقه می‌شود.</p>
    </div>
    <div class="p-4 rounded-xl border border-red-200 dark:border-red-900/30 bg-red-50/50 dark:bg-red-950/10">
        <h4 class="font-bold text-red-700 dark:text-red-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">emergency</span>
            ۳. گل‌ها و گیاهان آپارتمانی (به‌ویژه لیلیوم)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-400">حتی لیسیدن گرده گل لیلیوم (سوسن) توسط گربه می‌تواند ظرف ۷۲ ساعت نارسایی کلیوی غیرقابل‌برگشت ایجاد کند.</p>
    </div>
    <div class="p-4 rounded-xl border border-red-200 dark:border-red-900/30 bg-red-50/50 dark:bg-red-950/10">
        <h4 class="font-bold text-red-700 dark:text-red-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">emergency</span>
            ۴. داروهای انسانی (استامینوفن و مسکن‌ها)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-400">یک قرص استامینوفن برای گربه کشنده قطعی است و گلبول‌های قرمز را نابود می‌کند. ایبوپروفن نیز در سگ خونریزی شدید معده می‌دهد.</p>
    </div>
</div>

<h3>علائم بارز مسمومیت که باید بشناسید</h3>
<ul class="list-disc pr-6 my-4 space-y-2 text-slate-700 dark:text-slate-300">
    <li>ترشح بیش از حد بزاق و کف کردن دهان</li>
    <li>استفراغ مکرر و اسهال خونی یا تیره</li>
    <li>بی‌تعادلی در راه رفتن، تلوتلو خوردن و گیجی</li>
    <li>لرزش دست و پا، انقباضات عضلانی یا تشنج</li>
    <li>رنگ‌پریدگی یا زرد شدن لثه‌ها و سفیدی چشم</li>
    <li>تنگی نفس و تنفس سطحی و سریع</li>
</ul>

<h3>اقدامات ضروری در خانه (چه بکنیم و چه نکنیم؟)</h3>
<div class="my-6 p-5 rounded-2xl bg-amber-50 dark:bg-amber-950/20 border border-amber-300 dark:border-amber-800">
    <h4 class="font-bold text-amber-900 dark:text-amber-300 mb-2">⛔ کارهای ممنوعه که جان حیوان را به خطر می‌اندازد:</h4>
    <p class="text-sm leading-relaxed text-slate-700 dark:text-slate-300">
        <strong>هرگز حیوان را به زور وادار به استفراغ نکنید</strong> مگر اینکه مستقیماً با دستور دامپزشک باشد! در موادی مانند شوینده‌های اسیدی/قلیایی یا باتری، برگشت ماده از مری باعث سوختگی شیمیایی شدید و سوراخ شدن لوله‌های تنفسی می‌شود. همچنین از خوراندن نمک، سرکه یا شیر بدون دستور پزشک خودداری نمایید.
    </p>
</div>
<p><strong>تنها اقدامات صحیح:</strong> ماده سمی، بسته‌بندی یا گیاه مشکوک را بردارید تا دامپزشک سریعاً پادزهر (Antidote) مناسب را تزریق کند و بلافاصله حیوان را به نزدیک‌ترین مرکز مجهز دامپزشکی برسانید.</p>
HTML
        ,
        'faqs' => [
            ['q' => 'آیا خوراندن شیر به حیوانی که مسموم شده کمک می‌کند؟', 'a' => 'خیر، این یک باور غلط است. شیر در بسیاری از سموم باعث افزایش سرعت جذب سم در روده می‌شود و در گربه‌ها به علت عدم تحمل لاکتوز، اسهال شدید ایجاد می‌کند.'],
            ['q' => 'در چه شرایطی می‌توان از زغال فعال (Activated Charcoal) استفاده کرد؟', 'a' => 'قرص زغال فعال تنها برای سموم خوراکی خاص و با تجویز مستقیم دامپزشک موثر است تا از جذب سم در روده جلوگیری نماید.']
        ]
    ],

    'human-vs-veterinary-medications' => [
        'title' => 'تفاوت داروهای دامپزشکی با انسانی و خطرات مرگبار مصرف خودسرانه',
        'short_desc' => 'چرا داروهای انسانی برای حیوانات خطرناک هستند؟ تحلیل آنزیم‌های کبدی، تفاوت فرمولاسیون‌ها و نحوه تایید نسخه در داروخانه آنلاین آسنا.',
        'category' => 'pharmacy',
        'category_name' => 'داروخانه دامپزشکی',
        'read_time' => '۶ دقیقه مطالعه',
        'author' => 'دکتر آرمان ناصری',
        'author_role' => 'دکتر داروساز و ناظر فنی داروخانه دامپزشکی آسنا',
        'updated_at' => '۲۰۲۶-۰۹-۰۱',
        'icon' => 'medication',
        'accent_color' => 'from-teal-600 to-emerald-700',
        'content' => <<<HTML
<h3>چرا نباید داروی انسانی به پت داده شود؟</h3>
<p>یکی از شایع‌ترین عوامل مراجعه اورژانسی به بیمارستان‌های دامپزشکی، اقدام سرپرستان دلسوز اما ناآگاه به تجویز داروهای مسکن یا آنتی‌بیوتیک‌های انسانی برای حیوانات خانگی است. فیزیولوژی، وزن بدن، مسیرهای دفع کلیوی و آنزیم‌های سیتوکروم P450 کبد حیوانات کوچک تفاوت‌های بنیادینی با بدن انسان دارد.</p>

<h3>۳ اشتباه دارویی رایج و فاجعه‌بار</h3>
<div class="space-y-4 my-6">
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-teal-700 dark:text-teal-400 mb-1">۱. استامینوفن (تیلنول / پاراستامول)</h4>
        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">گربه‌ها فاقد آنزیم «گلوکورونیل ترانسفراز» هستند. مصرف حتی مقدار اندکی استامینوفن باعث تولید متابولیت بسیار سمی و تغییر هموگلوبین خون به «مت‌هموگلوبین» می‌شود که خون توانایی حمل اکسیژن را از دست داده و خفگی بافتی رخ می‌دهد.</p>
    </div>
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-teal-700 dark:text-teal-400 mb-1">۲. داروهای ضدالتهاب غیراستروئیدی (ژلوفن، بروفن، آسپرین)</h4>
        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">این داروها در سگ‌ها سد دفاعی مخاط معده را به سرعت تخریب کرده و به زخم معده حاد، خونریزی داخلی و در نهایت نارسایی برگشت‌ناپذیر کلیه ظرف ۴۸ ساعت منجر می‌شوند.</p>
    </div>
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-teal-700 dark:text-teal-400 mb-1">۳. قطره‌های چشمی کورتون‌دار انسانی</h4>
        <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">استفاده از قطره‌های بتامتازون یا دگزامتازون برای چشم قرمز پت بدون بررسی زخم قرنیه توسط دامپزشک می‌تواند باعث سوراخ شدن کره چشم و نابینایی همیشگی شود.</p>
    </div>
</div>

<h3>داروهای تخصصی دامپزشکی در سامانه آسنا</h3>
<p>داروهای دامپزشکی بر اساس وزن دقیق بر حسب کیلوگرم (mg/kg)، طعم‌دار شده برای پذیرش راحت توسط حیوان (طعم گوشت یا مرغ) و با کمترین عوارض جانبی فرموله می‌شوند. در داروخانه آنلاین آسنا:</p>
<ul class="list-disc pr-6 my-4 space-y-2 text-slate-700 dark:text-slate-300">
    <li>تمامی داروها دارای تاییدیه سازمان دامپزشکی کشور و بارکد رهگیری اصالت هستند.</li>
    <li>داروهای نیازمند نسخه، پس از بررسی تصویر نسخه توسط دکتر داروساز تایید می‌گردند.</li>
    <li>واکسن‌ها و آنتی‌سرم‌ها در محفظه‌های عایق با یخ خشک (زنجیره سرد تضمینی) به دست شما می‌رسند.</li>
</ul>
HTML
        ,
        'faqs' => [
            ['q' => 'اگر حیوانم درد دارد چه داروی مسکنی می‌توانم در خانه بدهم؟', 'a' => 'هیچ داروی انسانی به عنوان مسکن ایمن نیست. فقط مسکن‌های اختصاصی حیوانات مانند «ملوکسیکام دامپزشکی» یا «کارپروفن» با دوز دقیق محاسبه‌شده توسط دامپزشک مجاز هستند.'],
            ['q' => 'آیا پمادهای پوستی انسانی را می‌توان برای زخم سگ یا گربه زد؟', 'a' => 'پت‌ها لیسیدن زخم را به عنوان غریزه انجام می‌دهند؛ ورود ترکیبات پمادهای انسانی به دستگاه گوارش خطرساز است و باید از پمادها و اسپری‌های غیرسمی دامی استفاده شود.']
        ]
    ],

    'best-dry-food-selection-guide' => [
        'title' => 'راهنمای انتخاب بهترین غذای خشک بر اساس نژاد و سن سگ و گربه',
        'short_desc' => 'بررسی درصد پروتئین خام، تفکیک غذای پاپی/کیتن و عقیم‌شده، شناخت آلرژی‌های غذایی و انتخاب هوشمندانه از پت‌شاپ آنلاین آسنا.',
        'category' => 'shop',
        'category_name' => 'پت‌شاپ و تغذیه',
        'read_time' => '۷ دقیقه مطالعه',
        'author' => 'دکتر کیان پورعلی',
        'author_role' => 'متخصص تغذیه حیوانات خانگی',
        'updated_at' => '۲۰۲۶-۰۹-۰۱',
        'icon' => 'pets',
        'accent_color' => 'from-amber-600 to-orange-700',
        'content' => <<<HTML
<h3>نقش بنیادین تغذیه باکیفیت در طول عمر پت</h3>
<p>بیش از ۷۰ درصد مشکلات پوستی، ریزش غیرعادی مو، مشکلات کلیوی و بوی بد دهان در سگ‌ها و گربه‌ها ریشه در تغذیه نامتعادل یا استفاده از غذاهای بی‌کیفیت دارد. غذای خشک استاندارد باید حاوی تمامی درشت‌مغذی‌ها (پروتئین حیوانی، چربی‌های مفید) و ریزمغذی‌ها (ویتامین‌ها، کلسیم، تورین برای گربه) باشد.</p>

<h3>فاکتورهای طلایی در خواندن جدول ارزش غذایی</h3>
<div class="space-y-4 my-6">
    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/80">
        <h4 class="font-bold text-primary dark:text-blue-400 mb-1">۱. منبع اول پروتئین (First Ingredient)</h4>
        <p class="text-sm text-slate-600 dark:text-slate-300">اولین ماده در لیست تشکیل‌دهنده باید گوشت واقعی یا پودر گوشت خشک‌شده (Dehydrated Meat) مشخص باشد (مانند گوشت مرغ، بره یا سالمون)، نه غلات ارزان‌قیمت مثل ذرت یا ضایعات گوشتی مبهم.</p>
    </div>
    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/80">
        <h4 class="font-bold text-primary dark:text-blue-400 mb-1">۲. تفکیک سنی (توله، بالغ، مسن)</h4>
        <p class="text-sm text-slate-600 dark:text-slate-300">توله‌سگ‌ها و بچه‌گربه‌ها (Puppy / Kitten) به پروتئین بالاتر (حداقل ۳۰-۳۴٪) و کلسیم/فسفر دقیق برای رشد استخوان‌ها نیاز دارند. غذای پت‌های عقیم‌شده (Sterilised) باید چربی کنترل‌شده و فیبر بالا داشته باشد تا از چاقی و سنگ مجاری ادراری پیشگیری شود.</p>
    </div>
    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/80">
        <h4 class="font-bold text-primary dark:text-blue-400 mb-1">۳. نژاد و سایز فک و دندان</h4>
        <p class="text-sm text-slate-600 dark:text-slate-300">اندازه کیبل (دانه‌های غذا) برای نژادهای کوچک (Mini/Small) کوچک‌تر طراحی شده تا خطر خفگی نداشته باشد، و در نژادهای بزرگ حاوی گلوکوزامین و کندروئیتین برای محافظت از مفاصل سنگین وزن است.</p>
    </div>
</div>

<h3>مزیت خرید از پت‌شاپ آنلاین آسنا با ارسال دوره‌ای</h3>
<p>در پت‌شاپ تخصصی آسنا، تمامی غذاها بر اساس فیلتر نوع حیوان (سگ، گربه، نژاد) دسته‌بندی شده‌اند و می‌توانید با فعال‌سازی <strong>تحویل خودکار دوره‌ای (Autoship)</strong>، غذای مورد علاقه پت خود را همیشه با تخفیف دائمی و بدون نگرانی از تمام شدن دریافت کنید.</p>
HTML
        ,
        'faqs' => [
            ['q' => 'آیا ترکیب غذای خشک با کنسرو و پوچ کار درستی است؟', 'a' => 'بله، تغذیه ترکیبی (Mixed Feeding) به تامین رطوبت بدن به خصوص در گربه‌ها که کمتر آب می‌نوشند کمک شایانی کرده و از نارسایی کلیوی پیشگیری می‌کند.'],
            ['q' => 'چگونه غذای جدید را بدون اسهال جایگزین غذای قبلی کنیم؟', 'a' => 'تغییر غذا باید به تدریج ظرف ۷ تا ۱۰ روز انجام شود: روز ۱ و ۲ (۲۵٪ جدید + ۷۵٪ قدیم)، روز ۳ و ۴ (۵۰٪-۵۰٪)، روز ۵ و ۶ (۷۵٪ جدید + ۲۵٪ قدیم) و از روز هفتم به بعد ۱۰۰٪ غذای جدید.']
        ]
    ],

    'how-autoship-works-guide' => [
        'title' => 'سیستم تحویل خودکار دوره‌ای (Autoship) چیست و چگونه کار می‌کند؟',
        'short_desc' => 'آموزش گام‌به‌گام فعال‌سازی ارسال منظم غذای خشک، خاک و ملزومات پت با تخفیف دائمی و بدون نیاز به ثبت سفارش تکراری.',
        'category' => 'platform',
        'category_name' => 'راهنمای سامانه آسنا',
        'read_time' => '۵ دقیقه مطالعه',
        'author' => 'تیم محصول آسنا',
        'author_role' => 'پشتیبانی و توسعه سامانه ASENA',
        'updated_at' => '۲۰۲۶-۰۹-۰۱',
        'icon' => 'autorenew',
        'accent_color' => 'from-emerald-600 to-teal-700',
        'content' => <<<HTML
<h3>مفهوم تحویل خودکار دوره‌ای (Autoship)</h3>
<p>یکی از بزرگ‌ترین چالش‌های سرپرستان پت، تمام شدن ناگهانی کیسه غذای خشک یا خاک بستر گربه در روزهای تعطیل یا دیروقت شب است. سیستم <strong>Autoship</strong> پلتفرم آسنا به عنوان اولین نمونه در کشور، امکان برنامه‌ریزی هوشمند خریدهای دوره‌ای را برای شما فراهم کرده است.</p>

<h3>مزایای اختصاصی سیستم تحویل خودکار:</h3>
<ul class="list-disc pr-6 my-4 space-y-2 text-slate-700 dark:text-slate-300">
    <li><strong>تخفیف دائمی مشترکین:</strong> تمامی اقلامی که روی سفارش دوره‌ای فعال شوند، بین ۵ تا ۱۵ درصد تخفیف همیشگی دریافت می‌کنند.</li>
    <li><strong>تضمین رزرو کالا:</strong> حتی در شرایط کمبود بازار، کالای مشترکین دوره‌ای پیش از اتمام در انبار اختصاصی رزرو می‌شود.</li>
    <li><strong>انعطاف‌پذیری ۱۰۰٪:</strong> در هر لحظه می‌توانید دوره را به تاخیر بیندازید، محصول را تغییر دهید یا بدون هیچ جریمه‌ای اشتراک را لغو کنید.</li>
    <li><strong>اطلاع‌رسانی پیامکی قبل از ارسال:</strong> ۲۴ ساعت پیش از اعزام سفیر، پیامک تایید همراه با جزییات سفارش برای شما ارسال می‌گردد.</li>
</ul>

<h3>مراحل فعال‌سازی آسان در ۳ مرحله:</h3>
<ol class="list-decimal pr-6 my-4 space-y-3 text-slate-700 dark:text-slate-300">
    <li>در صفحه هر محصول در فروشگاه، گزینه <strong>«خرید با اشتراک دوره‌ای (Autoship)»</strong> را انتخاب کنید.</li>
    <li>بازه زمانی تکرار را تعیین کنید (مثلاً: هر ۲ هفته یک‌بار، ماهانه، هر ۴۵ روز یا هر دو ماه).</li>
    <li>آدرس و شیوه پرداخت را ثبت کنید. از این پس سفارشات شما به صورت خودکار سر موقع درب منزل تحویل داده خواهند شد.</li>
</ol>
HTML
        ,
        'faqs' => [
            ['q' => 'آیا برای لغو اشتراک تحویل دوره‌ای هزینه‌ای کسر می‌شود؟', 'a' => 'خیر، لغو اشتراک در هر زمان از طریق پنل کاربری بخش «اشتراک‌ها» با یک کلیک و کاملاً رایگان است.'],
            ['q' => 'اگر در سفر باشم چطور می‌توانم ارسال را به تعویق بیندازم؟', 'a' => 'در پنل کاربری گزینه «تعویق سفارش» وجود دارد که می‌توانید تاریخ تحویل را به بعد از بازگشت از سفر موکول نمایید.']
        ]
    ],

    'how-to-book-vet-appointment' => [
        'title' => 'راهنمای جامع نوبت‌دهی آنلاین کلینیک دامپزشکی آسنا',
        'short_desc' => 'آموزش ثبت نوبت ویزیت تخصصی پزشک، مشاهده شیفت‌های آزاد، تشکیل پرونده پزشکی دیجیتال پت و دریافت کد رهگیری پیامکی.',
        'category' => 'platform',
        'category_name' => 'راهنمای سامانه آسنا',
        'read_time' => '۴ دقیقه مطالعه',
        'author' => 'مدیریت کلینیک آسنا',
        'author_role' => 'واحد پذیرش و درمانگاه آسنا',
        'updated_at' => '۲۰۲۶-۰۹-۰۱',
        'icon' => 'calendar_month',
        'accent_color' => 'from-blue-600 to-cyan-700',
        'content' => <<<HTML
<h3>نوبت‌دهی سریع و مدرن بدون انتظار در مطب</h3>
<p>سیستم نوبت‌دهی آنلاین آسنا طراحی شده تا استرس ماندن حیوانات در اتاق انتظار کلینیک به حداقل برسد و شما بتوانید بر اساس تخصص دکتر و ساعت فراغت خود، بهترین زمان را رزرو نمایید.</p>

<h3>مراحل رزرو نوبت در سامانه:</h3>
<ol class="list-decimal pr-6 my-4 space-y-3 text-slate-700 dark:text-slate-300">
    <li>به صفحه <strong>نوبت‌دهی کلینیک</strong> مراجعه کنید.</li>
    <li>پزشک مورد نظر را با بررسی تخصص (داخلی، جراحی، پرندگان، پوست) و امتیاز مراجعین انتخاب فرمایید.</li>
    <li>اطلاعات پت (نام، گونه سگ/گربه، سن) و علت مراجعه را وارد کنید.</li>
    <li>روز و ساعت آزاد مورد نظر را از تقویم تعاملی انتخاب کرده و نوبت را تایید نمایید.</li>
    <li>کد پیگیری و جزییات نوبت بلافاصله از طریق پیامک برای شما ارسال می‌شود.</li>
</ol>
HTML
        ,
        'faqs' => [
            ['q' => 'آیا امکان لغو یا تغییر ساعت نوبت وجود دارد؟', 'a' => 'بله، تا ۴ ساعت قبل از زمان ویزیت می‌توانید از طریق پنل کاربری یا تماس با پشتیبانی نوبت خود را جابجا کنید.']
        ]
    ],

    'pharmacy-prescription-verification-guide' => [
        'title' => 'نحوه سفارش دارو و تایید نسخه در داروخانه آنلاین دامپزشکی آسنا',
        'short_desc' => 'راهنمای ارسال تصویر نسخه، استعلام داروهای کمیاب دامی، رعایت زنجیره سرد و نحوه ارسال سفارشات دارویی.',
        'category' => 'pharmacy',
        'category_name' => 'داروخانه دامپزشکی',
        'read_time' => '۵ دقیقه مطالعه',
        'author' => 'دکتر آرمان ناصری',
        'author_role' => 'دکتر داروساز داروخانه تخصصی آسنا',
        'updated_at' => '۲۰۲6-۰۹-۰۱',
        'icon' => 'receipt_long',
        'accent_color' => 'from-teal-600 to-emerald-700',
        'content' => <<<HTML
<h3>تامین قانونی و استاندارد داروهای دامی</h3>
<p>داروخانه دامپزشکی آسنا به عنوان مرجع رسمی، امکان تهیه اقلام دارویی مجاز بدون نسخه (OTC) و داروهای تخصصی تحت نسخه را با تایید دکتر داروساز فراهم کرده است.</p>

<h3>فرآیند ثبت و تایید نسخه دارویی:</h3>
<ul class="list-disc pr-6 my-4 space-y-2 text-slate-700 dark:text-slate-300">
    <li><strong>بارگذاری تصویر نسخه:</strong> در هنگام ثبت سفارش، عکس واضح از نسخه مهر شده پزشک را بارگذاری نمایید.</li>
    <li><strong>بررسی تداخلات دارویی:</strong> دکتر داروساز دوز دارو را بر اساس وزن و گونه پت بازبینی و تایید می‌کند.</li>
    <li><strong>بسته‌بندی ایمن:</strong> داروها در بسته‌بندی‌های استاندارد عایق و در صورت نیاز همراه با ژل یخ اعزام می‌گردند.</li>
</ul>
HTML
        ,
        'faqs' => [
            ['q' => 'داروهای نیازمند یخچال چگونه ارسال می‌شوند؟', 'a' => 'در محفظه‌های ویژه عایق با پک‌های خنک‌کننده زیستی ارسال شده و دما در تمام طول مسیر کنترل می‌شود.']
        ]
    ],

    'charity-stray-pet-healthcare-guide' => [
        'title' => 'پویش‌های خیریه آسنا و نحوه نجات و درمان حیوانات بی‌سرپرست',
        'short_desc' => 'شفافیت مالی، پرونده‌های درمانی حیوانات آسیب‌دیده، نقاهتگاه حمایتی و نحوه مشارکت در نجات جان حیوانات.',
        'category' => 'platform',
        'category_name' => 'خیریه و مسئولیت اجتماعی',
        'read_time' => '۴ دقیقه مطالعه',
        'author' => 'بخش خیریه و امداد آسنا',
        'author_role' => 'کمیته امداد و حمایت از حیوانات',
        'updated_at' => '۲۰۲۶-۰۹-۰۱',
        'icon' => 'volunteer_activism',
        'accent_color' => 'from-purple-600 to-pink-700',
        'content' => <<<HTML
<h3>مسئولیت اجتماعی پلتفرم آسنا</h3>
<p>بخش خیریه آسنا با هدف حمایت ساختاریافته و شفاف از حیوانات آسیب‌دیده، سگ‌ها و گربه‌های بی‌سرپرست خیابانی و پناهگاه‌ها راه‌اندازی شده است. هر پرونده درمانی با فاکتورهای واقعی بیمارستان و تصویر روند بهبودی مستند می‌شود.</p>

<h3>نحوه مشارکت شما در پویش‌ها:</h3>
<ul class="list-disc pr-6 my-4 space-y-2 text-slate-700 dark:text-slate-300">
    <li>مشاهده پرونده‌های فعال در صفحه <strong>خیریه آسنا</strong></li>
    <li>کمک مالی مستقیم آنلاین با هر مبلغ دلخواه (حتی مبالغ خرد)</li>
    <li>پیگیری گزارش‌های پیشرفت درمان و ترخیص حیوان در نقاهتگاه</li>
</ul>
HTML
        ,
        'faqs' => [
            ['q' => 'چگونه از مصرف درست کمک‌های مالی اطمینان حاصل کنم؟', 'a' => 'تمامی صورت‌حساب‌های کلینیک و ویدیوهای ترخیص در صفحه پرونده منتشر شده و توسط ناظر مالی تایید می‌شود.']
        ]
    ],

    'admin-panel-guide' => [
        'title' => 'راهنمای جامع کاربری پنل مدیریت آسنا (ASENA Admin Guide)',
        'short_desc' => 'مستندات کامل مدیریت سفارشات، انبارداری، تقویم شیفت پزشکان، ورکر خودکار ارسال دوره‌ای Autoship و تنظیمات پیامک ملی‌پیامک.',
        'category' => 'platform',
        'category_name' => 'راهنمای سامانه آسنا',
        'read_time' => '۶ دقیقه مطالعه',
        'author' => 'تیم فنی و توسعه آسنا',
        'author_role' => 'واحد امنیت و مدیریت زیرساخت ASENA',
        'updated_at' => '۲۰۲۶-۰۹-۰۲',
        'icon' => 'admin_panel_settings',
        'accent_color' => 'from-slate-800 to-blue-900',
        'content' => <<<HTML
<h3>معرفی کنسول مدیریت یکپارچه آسنا</h3>
<p>پنل مدیریت آسنا قلب تپنده عملیات پلتفرم است که کلیه بخش‌های تجارت الکترونیک، پرونده‌های پزشکی کلینیک، اشتراک‌های دوره‌ای و درگاه‌های ارتباطی را در یک محیط متمرکز قرار داده است.</p>

<h3>بخش‌های کلیدی پنل ادمین و نحوه کار با آنها:</h3>
<div class="space-y-4 my-6">
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-blue-700 dark:text-blue-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
            ۱. مدیریت و ارسال سفارشات (orders.php)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">سفارشات جدید در این بخش با جزییات کامل خریدار، اقلام و آدرس پستی نمایش داده می‌شوند. با تغییر وضعیت به «ارسال شده»، پیامک رهگیری به طور خودکار به خریدار ارسال می‌شود.</p>
    </div>
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-blue-700 dark:text-blue-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">inventory_2</span>
            ۲. انبارداری و کنترل موجودی (inventory.php)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">ثبت محصولات جدید، تعیین قیمت و تخفیف و هشدار کمبود موجودی زیر ۵ عدد به صورت هوشمند برای پیشگیری از اتمام کالا در انبار.</p>
    </div>
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-blue-700 dark:text-blue-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">medical_services</span>
            ۳. مدیریت کلینیک و شیفت پزشکان (clinic_management.php)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">تعریف پزشکان معالج، تخصص‌ها، قیمت ویزیت و امکان مسدودسازی فوری ساعت‌های مرخصی اضطراری پزشک.</p>
    </div>
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-blue-700 dark:text-blue-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">autorenew</span>
            ۴. چرخه خودکار اشتراک‌های دوره‌ای (subscriptions.php)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">پیگیری وضعیت مشترکین ماهانه و ارسال خودکار سفارشات دوره‌ای ملزومات پت بدون نیاز به اقدام دستی مشتری.</p>
    </div>
    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700">
        <h4 class="font-bold text-blue-700 dark:text-blue-400 mb-1 flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">sms</span>
            ۵. تنظیمات وب‌سرویس ملی‌پیامک (sms_settings.php)
        </h4>
        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">بررسی اعتبار پنل پیامک، لاگ‌های ارسال کد تایید OTP و تایید هماهنگی IP خروجی سرور در لیست سفید ملی‌پیامک.</p>
    </div>
</div>
HTML
        ,
        'faqs' => [
            ['q' => 'چگونه می‌توان به پنل مدیریت وارد شد؟', 'a' => 'از طریق ورود با شماره همراه کاربر ادمین، سیستم به صورت خودکار نقش کاربر را شناسایی و دسترسی به پنل مدیریت را فعال می‌نماید.']
        ]
    ],

    'doctor-panel-guide' => [
        'title' => 'راهنمای جامع کاربری پنل پزشکان آسنا (ASENA Doctor Guide)',
        'short_desc' => 'راهنمای ثبت و تایید نوبت‌های ویزیت، بستن ساعت‌های مرخصی، مشاهده سوابق سلامت پت و دریافت پیامک‌های لحظه‌ای ویزیت.',
        'category' => 'platform',
        'category_name' => 'راهنمای سامانه آسنا',
        'read_time' => '۵ دقیقه مطالعه',
        'author' => 'مدیریت کلینیک دامپزشکی آسنا',
        'author_role' => 'شورای عالی پزشکی آسنا',
        'updated_at' => '۲۰۲۶-۰۹-۰۲',
        'icon' => 'stethoscope',
        'accent_color' => 'from-cyan-700 to-blue-800',
        'content' => <<<HTML
<h3>میز کار بالینی پزشکان کلینیک آسنا</h3>
<p>پنل اختصاصی پزشکان برای مدیریت ساده و سریع نوبت‌های حضوری و آنلاین، بررسی مشخصات و سوابق بیمار و تنظیم ساعت‌های حضور طراحی شده است.</p>

<h3>امکانات اصلی پنل پزشک:</h3>
<ul class="list-disc pr-6 my-4 space-y-3 text-slate-700 dark:text-slate-300">
    <li><strong>تقویم روزانه نوبت‌ها:</strong> مشاهده لیست کامل بیمارانی که برای امروز وقت رزرو کرده‌اند به همراه نژاد پت، سن و علت مراجعه.</li>
    <li><strong>بستن اسلات‌ها و ثبت نوبت تلفنی:</strong> در صورتی که در ساعتی خاص امکان ویزیت ندارید، با یک کلیک آن ساعت را از دسترس رزرو اینترنتی خارج کنید.</li>
    <li><strong>برنامه کاری هفتگی:</strong> امکان فعال‌سازی یا تغییر ساعات شیفت صبح و عصر در روزهای مختلف هفته.</li>
    <li><strong>پیامک اطلاع‌رسانی آنی:</strong> با ثبت شماره همراه پزشک در تب پروفایل، هر رزرو جدید بلافاصله از طریق پیامک به اطلاع پزشک می‌رسد.</li>
</ul>
HTML
        ,
        'faqs' => [
            ['q' => 'آیا پزشک می‌تواند نوبت بیماری را لغو یا جابجا کند؟', 'a' => 'بله، از طریق تقویم نوبت‌ها می‌توانید وضعیت نوبت را به لغو شده یا تغییر زمان ویرایش نمایید که بلافاصله از طریق پیامک به بیمار اطلاع داده می‌شود.']
        ]
    ]
];

// Router logic: Check if a specific article is requested
$current_slug = isset($_GET['article']) ? trim($_GET['article']) : '';
$article = null;
if (!empty($current_slug) && isset($articles[$current_slug])) {
    $article = $articles[$current_slug];
    $article['slug'] = $current_slug;
}

// SEO Metadata Setup
$proto = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'asena.company';
$base_url = "$proto://$host";

if ($article) {
    $page_title = $article['title'] . ' | پایگاه دانش آسنا';
    $page_description = $article['short_desc'];
    $canonical_url = "$base_url/standard/knowledge_base.php?article=" . $article['slug'];
    $og_image = "$base_url/assets/images/og-asena.png";

    // Build FAQ array for Schema.org if available
    $faq_entities = [];
    if (!empty($article['faqs'])) {
        foreach ($article['faqs'] as $faq) {
            $faq_entities[] = [
                "@type" => "Question",
                "name" => $faq['q'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $faq['a']
                ]
            ];
        }
    }

    // Build MedicalWebPage / Article Schema.org JSON-LD for Search Engines & AI Crawlers
    $schema_graph = [
        "@context" => "https://schema.org",
        "@type" => $article['category'] === 'medical' ? "MedicalWebPage" : "Article",
        "headline" => $article['title'],
        "description" => $article['short_desc'],
        "image" => [$og_image],
        "datePublished" => $article['updated_at'] . "T08:00:00+03:30",
        "dateModified" => $article['updated_at'] . "T12:00:00+03:30",
        "author" => [
            "@type" => "Person",
            "name" => $article['author'],
            "jobTitle" => $article['author_role']
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => "ASENA",
            "logo" => [
                "@type" => "ImageObject",
                "url" => "$base_url/assets/images/logo.png"
            ]
        ],
        "mainEntityOfPage" => [
            "@type" => "WebPage",
            "@id" => $canonical_url
        ]
    ];

    $page_schema = json_encode([
        "@context" => "https://schema.org",
        "@graph" => !empty($faq_entities) ? [
            $schema_graph,
            [
                "@type" => "FAQPage",
                "mainEntity" => $faq_entities
            ]
        ] : [$schema_graph]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} else {
    $page_title = 'پایگاه دانش، مقالات تخصصی دامپزشکی و راهنمای سامانه | آسنا';
    $page_description = 'مرجع معتبر مقالات پزشکی دامپزشکی، واکسیناسیون، تغذیه سگ و گربه، و راهنمای جامع خدمات نوبت‌دهی آنلاین، پت‌شاپ و داروخانه دامی آسنا.';
    $canonical_url = "$base_url/standard/knowledge_base.php";
    $og_image = "$base_url/assets/images/og-asena.png";
}

require_once __DIR__ . '/includes/header.php';
?>

<!-- Deep Blue Glassmorphic Ambient Background -->
<div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
    <div class="absolute -top-40 right-10 w-[550px] h-[550px] bg-gradient-to-br from-blue-600/15 via-[#002d72]/20 to-teal-500/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-5 w-[500px] h-[500px] bg-gradient-to-tr from-indigo-700/15 via-[#0f766e]/15 to-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-1/3 w-[600px] h-[600px] bg-gradient-to-bl from-teal-600/10 via-[#001a44]/15 to-transparent rounded-full blur-3xl"></div>
</div>

<main class="min-h-screen py-8 md:py-14 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

<?php if ($article): ?>
    <!-- ================= SINGLE ARTICLE VIEW ================= -->
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" aria-label="Breadcrumb">
            <a href="index.php" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">home</span>
                خانه
            </a>
            <span class="material-symbols-outlined text-xs">chevron_left</span>
            <a href="knowledge_base.php" class="hover:text-primary transition-colors">پایگاه دانش</a>
            <span class="material-symbols-outlined text-xs">chevron_left</span>
            <span class="text-slate-700 dark:text-slate-200 font-bold truncate"><?= htmlspecialchars($article['title']) ?></span>
        </nav>

        <!-- Article Glass Header Card -->
        <header class="relative rounded-3xl p-6 md:p-10 mb-8 border border-white/40 dark:border-slate-800/80 bg-white/70 dark:bg-slate-900/80 backdrop-blur-xl shadow-xl shadow-blue-950/5 overflow-hidden">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="px-3 py-1 rounded-full text-xs font-black bg-primary/10 text-primary border border-primary/20 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[15px]"><?= $article['icon'] ?></span>
                    <?= $article['category_name'] ?>
                </span>
                <span class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px]">schedule</span>
                    <?= $article['read_time'] ?>
                </span>
                <span class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px]">event</span>
                    آخرین به‌روزرسانی: <?= $article['updated_at'] ?>
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white leading-snug md:leading-tight mb-4">
                <?= htmlspecialchars($article['title']) ?>
            </h1>
            <p class="text-base md:text-lg text-slate-600 dark:text-slate-300 leading-relaxed font-normal mb-6">
                <?= htmlspecialchars($article['short_desc']) ?>
            </p>

            <!-- Author & E-E-A-T Credential Badge -->
            <div class="flex items-center gap-4 pt-6 border-t border-slate-200/60 dark:border-slate-800">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-primary to-blue-600 flex items-center justify-center text-white shadow-md">
                    <span class="material-symbols-outlined text-2xl">verified_user</span>
                </div>
                <div>
                    <div class="flex items-center gap-1.5 font-bold text-slate-900 dark:text-white text-sm">
                        <span><?= $article['author'] ?></span>
                        <span class="material-symbols-outlined text-blue-500 text-sm" title="تایید شده توسط نظام دامپزشکی">check_circle</span>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400"><?= $article['author_role'] ?></p>
                </div>
            </div>
        </header>

        <!-- Main Article Content Body (Glass Card) -->
        <article class="rounded-3xl p-6 md:p-10 border border-white/40 dark:border-slate-800/80 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-lg leading-loose text-slate-800 dark:text-slate-200 prose prose-blue dark:prose-invert max-w-none mb-10">
            <?= $article['content'] ?>
        </article>

        <!-- Interactive FAQ Accordion -->
        <?php if (!empty($article['faqs'])): ?>
        <section class="rounded-3xl p-6 md:p-8 border border-white/40 dark:border-slate-800/80 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl shadow-md mb-10">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">help</span>
                پرسش‌های پرتکرار سرپرستان پت
            </h3>
            <div class="space-y-4">
                <?php foreach ($article['faqs'] as $idx => $faq): ?>
                <details class="group rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/40 p-4 transition-all open:bg-blue-50/40 dark:open:bg-blue-950/20">
                    <summary class="font-bold text-sm text-slate-900 dark:text-white cursor-pointer list-none flex items-center justify-between">
                        <span><?= htmlspecialchars($faq['q']) ?></span>
                        <span class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="mt-3 text-xs md:text-sm text-slate-600 dark:text-slate-300 leading-relaxed pt-2 border-t border-slate-200/50 dark:border-slate-800">
                        <?= htmlspecialchars($faq['a']) ?>
                    </p>
                </details>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Service Call to Action Card -->
        <div class="rounded-3xl p-8 bg-gradient-to-r from-[#001a44] via-[#002d72] to-[#0f766e] text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
            <div class="relative z-10">
                <h4 class="text-2xl font-black mb-2">سلامت حیوان خانگی شما اولویت ماست</h4>
                <p class="text-sm opacity-90 leading-relaxed max-w-xl">
                    برای رزرو وقت ویزیت متخصصان، خرید داروهای تاییدشده با زنجیره سرد، یا ملزومات باکیفیت پت‌شاپ، همین حالا اقدام فرمایید.
                </p>
            </div>
            <div class="flex items-center gap-3 relative z-10 shrink-0">
                <a href="booking.php" class="px-5 py-3 rounded-xl bg-white text-primary font-bold text-sm hover:bg-slate-100 transition-all shadow-md flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                    رزرو نوبت کلینیک
                </a>
                <a href="shop.php" class="px-5 py-3 rounded-xl bg-white/20 hover:bg-white/30 text-white font-bold text-sm backdrop-blur-md transition-all border border-white/30 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">storefront</span>
                    مشاهده پت‌شاپ
                </a>
            </div>
        </div>
    </div>

<?php else: ?>
    <!-- ================= KNOWLEDGE BASE PORTAL / HUB VIEW ================= -->
    <!-- Hero Banner -->
    <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-primary dark:text-blue-400 text-xs font-black mb-4 backdrop-blur-md">
            <span class="material-symbols-outlined text-sm">auto_stories</span>
            مرجع علمی و راهنمای رسمی سامانه ASENA
        </div>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
            پایگاه دانش، مقالات تخصصی و راهنمای آسنا
        </h1>
        <p class="text-slate-600 dark:text-slate-300 text-base md:text-lg leading-relaxed">
            مجموعه کامل دستورالعمل‌های پزشکی، واکسیناسیون، تغذیه اصولی و آموزش گام‌به‌گام کار با پلتفرم نوبت‌دهی و پت‌شاپ.
        </p>

        <!-- Live Instant Search Bar -->
        <div class="mt-8 relative max-w-xl mx-auto">
            <span class="material-symbols-outlined absolute right-4 top-3.5 text-slate-400">search</span>
            <input type="text" id="kb-search-input" placeholder="جستجو میان مقالات و راهنماها (مثلاً: واکسن، مسمومیت، اشتراک، نوبت)..."
                   class="w-full h-13 pr-12 pl-4 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl focus:ring-2 focus:ring-primary focus:border-transparent text-sm shadow-sm transition-all" />
        </div>
    </div>

    <!-- Category Tabs Filter -->
    <div class="flex items-center justify-center flex-wrap gap-2 md:gap-3 mb-10" id="kb-filter-tabs">
        <button type="button" data-filter="all" class="kb-tab-btn active px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition-all bg-primary text-white shadow-md">
            همه مطالب (<?= count($articles) ?>)
        </button>
        <button type="button" data-filter="medical" class="kb-tab-btn px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition-all bg-white/70 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 hover:bg-white border border-slate-200/60 dark:border-slate-700">
            پزشکی و سلامت (۲)
        </button>
        <button type="button" data-filter="pharmacy" class="kb-tab-btn px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition-all bg-white/70 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 hover:bg-white border border-slate-200/60 dark:border-slate-700">
            دارو و نسخه (۲)
        </button>
        <button type="button" data-filter="shop" class="kb-tab-btn px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition-all bg-white/70 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 hover:bg-white border border-slate-200/60 dark:border-slate-700">
            پت‌شاپ و تغذیه (۱)
        </button>
        <button type="button" data-filter="platform" class="kb-tab-btn px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition-all bg-white/70 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 hover:bg-white border border-slate-200/60 dark:border-slate-700">
            راهنمای سامانه (۳)
        </button>
    </div>

    <!-- Article Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="kb-articles-grid">
        <?php foreach ($articles as $slug => $art): ?>
        <a href="knowledge_base.php?article=<?= $slug ?>"
           data-category="<?= $art['category'] ?>"
           data-title="<?= htmlspecialchars($art['title'] . ' ' . $art['short_desc']) ?>"
           class="kb-article-card group flex flex-col justify-between rounded-3xl p-6 border border-white/50 dark:border-slate-800/80 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden">
            
            <!-- Top Gradient Accent Bar -->
            <div class="absolute top-0 right-0 left-0 h-1.5 bg-gradient-to-r <?= $art['accent_color'] ?>"></div>

            <div>
                <div class="flex items-center justify-between gap-2 mb-4">
                    <span class="w-10 h-10 rounded-xl bg-gradient-to-tr <?= $art['accent_color'] ?> text-white flex items-center justify-center shadow-md">
                        <span class="material-symbols-outlined text-[20px]"><?= $art['icon'] ?></span>
                    </span>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">schedule</span>
                        <?= $art['read_time'] ?>
                    </span>
                </div>

                <div class="mb-2">
                    <span class="text-[11px] font-black text-primary dark:text-blue-400 uppercase tracking-wider"><?= $art['category_name'] ?></span>
                </div>

                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white leading-snug group-hover:text-primary dark:group-hover:text-blue-400 transition-colors mb-3">
                    <?= htmlspecialchars($art['title']) ?>
                </h3>

                <p class="text-xs md:text-sm text-slate-600 dark:text-slate-400 line-clamp-3 leading-relaxed mb-6">
                    <?= htmlspecialchars($art['short_desc']) ?>
                </p>
            </div>

            <!-- Footer of card -->
            <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800/80 text-xs">
                <span class="text-slate-500 dark:text-slate-400 font-medium truncate max-w-[65%]"><?= $art['author'] ?></span>
                <span class="text-primary dark:text-blue-400 font-bold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                    <span>مطالعه کامل</span>
                    <span class="material-symbols-outlined text-sm">arrow_left</span>
                </span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Quick Staff Portal Access Box -->
    <div class="mt-16 p-8 rounded-3xl border border-slate-200 dark:border-slate-800 bg-gradient-to-br from-slate-50 to-blue-50/50 dark:from-slate-900 dark:to-blue-950/20 backdrop-blur-xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">admin_panel_settings</span>
                    راهنماهای اختصاصی پرسنل و همکاران
                </h4>
                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                    مدیران سیستم و پزشکان گرامی می‌توانند مستندات تخصصی کار با پنل‌های اختصاصی خود را در بخش‌های زیر مطالعه فرمایند.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="knowledge_base.php?article=admin-panel-guide" class="px-4 py-2.5 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 font-bold text-xs hover:opacity-90 transition-all flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-base">dashboard_customize</span>
                    راهنمای پنل مدیریت (Admin)
                </a>
                <a href="knowledge_base.php?article=doctor-panel-guide" class="px-4 py-2.5 rounded-xl bg-primary text-white font-bold text-xs hover:bg-blue-800 transition-all flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-base">stethoscope</span>
                    راهنمای پنل پزشک (Doctor)
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

</main>

<script>
// Filter Tabs and Live Search Functionality
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('kb-search-input');
    const filterTabs = document.querySelectorAll('.kb-tab-btn');
    const cards = document.querySelectorAll('.kb-article-card');

    let activeFilter = 'all';

    function updateVisibility() {
        const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        cards.forEach(card => {
            const cat = card.getAttribute('data-category');
            const title = card.getAttribute('data-title').toLowerCase();
            const matchesCat = activeFilter === 'all' || cat === activeFilter;
            const matchesQuery = query === '' || title.includes(query);

            if (matchesCat && matchesQuery) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            filterTabs.forEach(t => {
                t.classList.remove('bg-primary', 'text-white', 'shadow-md');
                t.classList.add('bg-white/70', 'text-slate-700', 'border');
            });
            tab.classList.remove('bg-white/70', 'text-slate-700', 'border');
            tab.classList.add('bg-primary', 'text-white', 'shadow-md');
            activeFilter = tab.getAttribute('data-filter');
            updateVisibility();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', updateVisibility);
    }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
