<?php
// ASENA Presentation Portal - Multi-Tier Enterprise, Pharmacy & Live UI Showcase
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASENA | پلتفرم یکپارچه مدیریت کلینیک، پت‌شاپ و داروخانه دامپزشکی</title>
    
    <!-- Vazirmatn Font for Beautiful Persian Typography -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.0.0/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #475569;
            
            --primary: #002d72;
            --primary-light: #1d4ed8;
            --primary-glow: rgba(0, 45, 114, 0.18);
            
            --secondary: #ea580c;
            --secondary-light: #f97316;
            --secondary-glow: rgba(234, 88, 12, 0.22);

            --teal-pharma: #0f766e;
            --teal-light: #0d9488;
            --teal-glow: rgba(15, 118, 110, 0.22);
            
            --card-radius: 24px;
            --card-border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Vazirmatn', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient Glow Backgrounds */
        .bg-glow-1 {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 45, 114, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            top: -100px;
            right: -150px;
            z-index: -1;
            filter: blur(40px);
        }
        
        .bg-glow-2 {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(234, 88, 12, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            top: 400px;
            left: -150px;
            z-index: -1;
            filter: blur(50px);
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 16px 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--card-border);
            direction: ltr;
        }

        .nav-logo {
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 1px;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Outfit', sans-serif;
            direction: ltr;
        }

        .nav-links {
            display: flex;
            gap: 28px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 600;
            font-size: 14px;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--secondary);
        }

        .nav-cta-btn {
            background: var(--primary);
            color: white !important;
            padding: 8px 18px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 4px 12px var(--primary-glow);
            transition: all 0.2s;
        }

        .nav-cta-btn:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
        }

        section {
            padding: 70px 20px 40px;
            max-width: 1240px;
            margin: 0 auto;
            width: 100%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 34px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 10px;
        }
        
        .section-subtitle {
            font-size: 16px;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Hero */
        .hero {
            text-align: center;
            padding-top: 130px;
            padding-bottom: 40px;
        }

        .hero-badge-top {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            border: 1px solid #bfdbfe;
            margin-bottom: 18px;
        }

        .hero h1 {
            font-size: 46px;
            font-weight: 900;
            line-height: 1.35;
            margin-bottom: 16px;
            color: var(--text-main);
        }
        
        .hero h1 span {
            color: var(--primary);
        }

        .hero-action-buttons {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        }

        .hero-btn.primary-btn {
            background: var(--primary);
            color: white;
            box-shadow: 0 6px 18px var(--primary-glow);
        }

        .hero-btn.primary-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 24px var(--primary-glow);
        }

        .hero-btn.pharma-btn {
            background: var(--teal-pharma);
            color: white;
            box-shadow: 0 6px 18px var(--teal-glow);
        }

        .hero-btn.pharma-btn:hover {
            background: var(--teal-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 24px var(--teal-glow);
        }

        /* Category Switcher Tabs */
        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 36px;
            flex-wrap: wrap;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: 1px solid var(--card-border);
            background: white;
            color: var(--text-muted);
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .tab-btn:hover {
            border-color: var(--primary-light);
            color: var(--primary);
        }

        .tab-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 6px 16px var(--primary-glow);
        }

        .tab-btn.active.pharma-tab {
            background: var(--teal-pharma);
            border-color: var(--teal-pharma);
            box-shadow: 0 6px 16px var(--teal-glow);
        }

        /* 3-Column Symmetrical CSS Grid */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            align-items: stretch;
        }

        .pricing-card {
            background: white;
            border: 1px solid var(--card-border);
            border-radius: var(--card-radius);
            padding: 30px 26px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }

        /* Best Value (Standard) Highlight */
        .pricing-card.best-deal {
            border: 2px solid var(--secondary);
            box-shadow: 0 8px 28px var(--secondary-glow);
            background: #ffffff;
        }

        .pricing-card.best-deal-pharma {
            border: 2px solid var(--teal-light);
            box-shadow: 0 8px 28px var(--teal-glow);
            background: #ffffff;
        }

        /* Top Pill Badges */
        .card-pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 999px;
            margin-bottom: 12px;
            align-self: flex-start;
        }

        .card-pill-badge.normal {
            background: #f1f5f9;
            color: #475569;
        }

        .card-pill-badge.best {
            background: #ffedd5;
            color: #c2410c;
            border: 1px solid #fed7aa;
        }

        .card-pill-badge.best-pharma {
            background: #ccfbf1;
            color: #0f766e;
            border: 1px solid #99f6e4;
        }

        .card-pill-badge.enterprise {
            background: #e0e7ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
        }

        .tier-header {
            margin-bottom: 20px;
        }

        .tier-name {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .tier-tagline {
            font-size: 12px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 8px;
            display: block;
        }

        .tier-tagline.pharma {
            color: var(--teal-pharma);
        }

        .tier-desc {
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.7;
            min-height: 44px;
        }

        .feature-list {
            list-style: none;
            margin-bottom: 28px;
            flex-grow: 1;
            border-top: 1px solid #f1f5f9;
            padding-top: 18px;
        }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 11px;
            font-size: 13px;
            color: var(--text-main);
            font-weight: 500;
            line-height: 1.5;
        }

        .feature-list li.disabled {
            color: #94a3b8;
            opacity: 0.6;
        }

        .feature-list li .material-icons-round {
            font-size: 18px;
            color: var(--secondary);
            flex-shrink: 0;
            margin-top: 1px;
        }

        .feature-list li.pharma-icon .material-icons-round {
            color: var(--teal-pharma);
        }

        .feature-list li.disabled .material-icons-round {
            color: #cbd5e1;
        }

        /* Action & Login Box */
        .card-action-box {
            background: #f8fafc;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Prominent Live Storefront Button */
        .storefront-main-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 11px 14px;
            border-radius: 12px;
            background: var(--primary);
            color: white;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 4px 12px var(--primary-glow);
            transition: all 0.2s;
        }

        .storefront-main-btn:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px var(--primary-glow);
        }

        .storefront-main-btn.orange-btn {
            background: linear-gradient(135deg, #ea580c, #f97316);
            box-shadow: 0 4px 12px var(--secondary-glow);
        }

        .storefront-main-btn.orange-btn:hover {
            background: linear-gradient(135deg, #c2410c, #ea580c);
            box-shadow: 0 6px 16px var(--secondary-glow);
        }

        .storefront-main-btn.teal-btn {
            background: linear-gradient(135deg, #0f766e, #0d9488);
            box-shadow: 0 4px 12px var(--teal-glow);
        }

        .storefront-main-btn.teal-btn:hover {
            background: linear-gradient(135deg, #115e59, #0f766e);
            box-shadow: 0 6px 16px var(--teal-glow);
        }

        .panels-subgrid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
        }

        .panel-sub-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 8px 4px;
            border-radius: 10px;
            background: white;
            border: 1px solid #e2e8f0;
            color: var(--text-main);
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            text-align: center;
        }

        .panel-sub-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #f1f5f9;
        }

        .panel-sub-btn .material-icons-round {
            font-size: 14px;
        }

        /* Design Showcase Grid */
        .showcase-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }

        .showcase-item {
            background: white;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.25s;
        }

        .showcase-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.06);
            border-color: #cbd5e1;
        }

        .showcase-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .showcase-icon .material-icons-round {
            font-size: 26px;
        }

        .showcase-item h3 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        .showcase-item p {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 16px;
        }

        .showcase-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            transition: gap 0.2s;
        }

        .showcase-btn:hover {
            gap: 8px;
            color: var(--secondary);
        }

        /* About & Contact */
        .about-box {
            background: white;
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 40px;
            display: grid;
            grid-template-columns: 1.4fr 0.6fr;
            gap: 30px;
            align-items: center;
        }

        .about-box p {
            font-size: 15px;
            line-height: 1.9;
            color: var(--text-muted);
            margin-bottom: 16px;
            text-align: justify;
        }

        .about-badge-icon {
            width: 100%;
            height: 200px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
        }

        .about-badge-icon .material-icons-round {
            font-size: 80px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .contact-card {
            background: white;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 24px;
            text-align: center;
            transition: transform 0.2s;
        }

        .contact-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        }

        .contact-card .material-icons-round {
            font-size: 32px;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .contact-card h4 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .contact-card p {
            font-size: 13px;
            color: var(--text-muted);
            font-family: 'Outfit', 'Vazirmatn', sans-serif;
        }

        footer {
            text-align: center;
            padding: 30px;
            color: var(--text-muted);
            font-size: 13px;
            margin-top: 40px;
            border-top: 1px solid var(--card-border);
            direction: ltr;
        }

        @media (max-width: 1024px) {
            .pricing-grid { grid-template-columns: 1fr; }
            .showcase-grid { grid-template-columns: repeat(2, 1fr); }
            .about-box { grid-template-columns: 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
            .hero h1 { font-size: 32px; }
            nav { padding: 14px 20px; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>
    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <nav>
        <a href="#" class="nav-logo">
            <span class="material-icons-round">pets</span>
            ASENA
        </a>
        <div class="nav-links">
            <a href="#showcase">پیش‌نمایش قالب</a>
            <a href="#models">مدل‌ها و پنل‌ها</a>
            <a href="#about">درباره ما</a>
            <a href="#contact">تماس با ما</a>
            <a href="auto_login.php?model=standard&role=public" target="_blank" class="nav-cta-btn">
                مشاهده دمو زنده سایت
            </a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-badge-top">
            <span class="material-icons-round" style="font-size: 16px;">verified</span>
            <span>نسل جدید سامانه‌های تخصصی کلینیک و داروخانه دامپزشکی</span>
        </div>
        <h1>پلتفرم جامع و یکپارچه<br><span>کلینیک، پت‌شاپ و داروخانه تخصصی</span></h1>
        <p class="section-subtitle">
            قالب‌های مدرن، متقاعدکننده و باکیفیت برای جذب حداکثری مشتریان و مدیریت آسان امور درمانی، انبارداری و تحویل خودکار دوره‌ای.
        </p>

        <div class="hero-action-buttons">
            <a href="auto_login.php?model=standard&role=public" target="_blank" class="hero-btn primary-btn">
                <span class="material-symbols-outlined">visibility</span>
                <span>مشاهده دمو زنده سایت و فروشگاه (دیدگاه خریدار)</span>
            </a>
            <a href="auto_login.php?model=pharmacy&role=public" target="_blank" class="hero-btn pharma-btn">
                <span class="material-symbols-outlined">local_pharmacy</span>
                <span>مشاهده دمو زنده داروخانه تخصصی آنلاین</span>
            </a>
        </div>
    </section>

    <!-- LIVE UI SHOWCASE -->
    <section id="showcase">
        <div class="section-header">
            <h2 class="section-title">طراحی مدرن، روان و کاربرپسند</h2>
            <p class="section-subtitle">رابط کاربری چشم‌نوازی که مشتریان شما را در نگاه اول جذب و وفادار می‌سازد.</p>
        </div>

        <div class="showcase-grid">
            <div class="showcase-item">
                <div>
                    <div class="showcase-icon" style="background: #eff6ff; color: var(--primary);">
                        <span class="material-icons-round">storefront</span>
                    </div>
                    <h3>ویترین فروشگاه و بنرها</h3>
                    <p>اسلایدر شیک، دسته‌بندی کالاها و بنرهای تبلیغاتی هوشمند.</p>
                </div>
                <a href="auto_login.php?model=standard&role=public" target="_blank" class="showcase-btn">
                    <span>پیش‌نمایش آنلاین</span>
                    <span class="material-icons-round" style="font-size: 14px;">arrow_back</span>
                </a>
            </div>

            <div class="showcase-item">
                <div>
                    <div class="showcase-icon" style="background: #f0fdfa; color: var(--teal-pharma);">
                        <span class="material-icons-round">medication</span>
                    </div>
                    <h3>داروخانه و تایید نسخه</h3>
                    <p>ثبت و تایید دیجیتال نسخه داروساز با زنجیره سرد.</p>
                </div>
                <a href="auto_login.php?model=pharmacy&role=public" target="_blank" class="showcase-btn" style="color: var(--teal-pharma);">
                    <span>پیش‌نمایش آنلاین</span>
                    <span class="material-icons-round" style="font-size: 14px;">arrow_back</span>
                </a>
            </div>

            <div class="showcase-item">
                <div>
                    <div class="showcase-icon" style="background: #fff7ed; color: var(--secondary);">
                        <span class="material-icons-round">calendar_month</span>
                    </div>
                    <h3>نوبت‌دهی آنلاین کلینیک</h3>
                    <p>تقویم تعاملی انتخاب پزشک و ثبت آسان نوبت ویزیت.</p>
                </div>
                <a href="auto_login.php?model=standard&role=public" target="_blank" class="showcase-btn" style="color: var(--secondary);">
                    <span>پیش‌نمایش آنلاین</span>
                    <span class="material-icons-round" style="font-size: 14px;">arrow_back</span>
                </a>
            </div>

            <div class="showcase-item">
                <div>
                    <div class="showcase-icon" style="background: #eef2ff; color: var(--primary-light);">
                        <span class="material-icons-round">autorenew</span>
                    </div>
                    <h3>تحویل خودکار (Autoship)</h3>
                    <p>ارسال دوره‌ای منظم با تخفیف دائمی برای مشتریان وفادار.</p>
                </div>
                <a href="auto_login.php?model=standard&role=public" target="_blank" class="showcase-btn">
                    <span>پیش‌نمایش آنلاین</span>
                    <span class="material-icons-round" style="font-size: 14px;">arrow_back</span>
                </a>
            </div>
        </div>
    </section>

    <!-- PRICING & EDITIONS -->
    <section id="models">
        <div class="section-header">
            <h2 class="section-title">مدل‌ها و نسخه‌های نرم‌افزار</h2>
            <p class="section-subtitle">حوزه فعالیت خود را انتخاب نمایید و قالب سایت یا پنل‌های دمو را با یک کلیک تست کنید.</p>
        </div>

        <!-- Suite Category Switcher -->
        <div class="category-tabs">
            <button id="tabPetshopBtn" onclick="switchSuite('petshop')" class="tab-btn active">
                <span class="material-icons-round">pets</span>
                پکیج‌های کلینیک و پت‌شاپ (Pet Care)
            </button>
            <button id="tabPharmaBtn" onclick="switchSuite('pharmacy')" class="tab-btn pharma-tab">
                <span class="material-icons-round">local_pharmacy</span>
                پکیج‌های تخصصی داروخانه دامپزشکی (Pharmacy)
            </button>
        </div>

        <!-- 1. Petshop / Clinic Suites Section -->
        <div id="petshopSuites" class="pricing-grid">
            
            <!-- Basic Tier -->
            <div class="pricing-card">
                <div>
                    <span class="card-pill-badge normal">پایه و کاربردی</span>
                    <div class="tier-header">
                        <h3 class="tier-name">مدل پایه</h3>
                        <span class="tier-tagline">امکانات ضروری کلینیک و پت‌شاپ</span>
                        <p class="tier-desc">مناسب برای کلینیک‌های تازه‌تاسیس و پت‌شاپ‌های نوپا جهت نوبت‌دهی و فروش آنلاین.</p>
                    </div>

                    <ul class="feature-list">
                        <li><span class="material-icons-round">check_circle</span> نوبت‌دهی آنلاین و پرونده سلامت</li>
                        <li><span class="material-icons-round">check_circle</span> فروشگاه الکترونیک اقلام و غذای حیوانات</li>
                        <li><span class="material-icons-round">check_circle</span> پنل پزشک و مدیریت ویزیت‌ها</li>
                        <li><span class="material-icons-round">check_circle</span> درگاه پرداخت آنلاین و مدیریت سفارشات</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> سامانه تیکتینگ و مشاوره</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> تحویل دوره‌ای خودکار (Autoship)</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند (هوش مصنوعی لئو)</li>
                    </ul>
                </div>

                <div class="card-action-box">
                    <a href="auto_login.php?model=basic&role=public" target="_blank" class="storefront-main-btn">
                        <span class="material-icons-round" style="font-size: 16px;">visibility</span>
                        <span>مشاهده ظاهر سایت (دیدگاه خریدار)</span>
                    </a>
                    <div class="panels-subgrid">
                        <a href="auto_login.php?model=basic&role=user" class="panel-sub-btn" title="پنل کاربر">
                            <span class="material-icons-round">person</span>
                            <span>کاربر</span>
                        </a>
                        <a href="auto_login.php?model=basic&role=doctor" class="panel-sub-btn" title="پنل پزشک">
                            <span class="material-icons-round">medical_services</span>
                            <span>پزشک</span>
                        </a>
                        <a href="auto_login.php?model=basic&role=admin" class="panel-sub-btn" title="پنل مدیریت">
                            <span class="material-icons-round">admin_panel_settings</span>
                            <span>مدیر</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Standard Tier (BEST VALUE) -->
            <div class="pricing-card best-deal">
                <div>
                    <span class="card-pill-badge best">🔥 پرفروش‌ترین پلن (پیشنهاد ویژه)</span>
                    <div class="tier-header">
                        <h3 class="tier-name">مدل حرفه‌ای (استاندارد)</h3>
                        <span class="tier-tagline">⭐ بهترین و کامل‌ترین انتخاب برای ۹۰٪ مراکز</span>
                        <p class="tier-desc">بهترین تعادل میان امکانات پیشرفته، تحویل دوره‌ای درآمدزا (Autoship) و رضایت مشتریان.</p>
                    </div>

                    <ul class="feature-list">
                        <li><span class="material-icons-round">check_circle</span> نوبت‌دهی تقویمی ۷ روزه و پرونده کامل</li>
                        <li><span class="material-icons-round">check_circle</span> پت‌شاپ کامل با فیلتر انواع گونه‌ها</li>
                        <li><span class="material-icons-round">check_circle</span> <strong>تحویل دوره‌ای خودکار (Autoship) با تخفیف</strong></li>
                        <li><span class="material-icons-round">check_circle</span> سامانه تیکت و مشاوره مستقیم پزشک با خریدار</li>
                        <li><span class="material-icons-round">check_circle</span> مدیریت مالی، تراکنش‌ها و انبارداری کامل</li>
                        <li><span class="material-icons-round">check_circle</span> پیامک خودکار اطلاع‌رسانی و یادآوری</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند هوش مصنوعی (لئو)</li>
                    </ul>
                </div>

                <div class="card-action-box">
                    <a href="auto_login.php?model=standard&role=public" target="_blank" class="storefront-main-btn orange-btn">
                        <span class="material-icons-round" style="font-size: 16px;">visibility</span>
                        <span>مشاهده ظاهر سایت (دیدگاه خریدار)</span>
                    </a>
                    <div class="panels-subgrid">
                        <a href="auto_login.php?model=standard&role=user" class="panel-sub-btn" title="پنل کاربر">
                            <span class="material-icons-round">person</span>
                            <span>کاربر</span>
                        </a>
                        <a href="auto_login.php?model=standard&role=doctor" class="panel-sub-btn" title="پنل پزشک">
                            <span class="material-icons-round">medical_services</span>
                            <span>پزشک</span>
                        </a>
                        <a href="auto_login.php?model=standard&role=admin" class="panel-sub-btn" style="color: var(--secondary); font-weight: 800;" title="پنل مدیریت">
                            <span class="material-icons-round">admin_panel_settings</span>
                            <span>مدیر</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Enterprise / Premium Tier -->
            <div class="pricing-card">
                <div>
                    <span class="card-pill-badge enterprise">💎 سازمانی و بیمارستانی</span>
                    <div class="tier-header">
                        <h3 class="tier-name">مدل سازمانی (پریمیوم)</h3>
                        <span class="tier-tagline">سامانه همه‌جانبه همراه با هوش مصنوعی</span>
                        <p class="tier-desc">مجهز به دستیار هوشمند لئو و تحلیل پیشرفته برای بیمارستان‌ها و مراکز بزرگ.</p>
                    </div>

                    <ul class="feature-list">
                        <li><span class="material-icons-round">check_circle</span> تمامی امکانات نسخه حرفه‌ای</li>
                        <li><span class="material-icons-round">check_circle</span> <strong>دستیار هوشمند هوش مصنوعی (لئو) با حافظه</strong></li>
                        <li><span class="material-icons-round">check_circle</span> بسته‌های اشتراکی سفارشی (Custom Box)</li>
                        <li><span class="material-icons-round">check_circle</span> رتبه‌بندی بیزی پیشرفته کالاها و دیدگاه‌ها</li>
                        <li><span class="material-icons-round">check_circle</span> داشبورد آماری و تحلیل رفتار مشتریان</li>
                        <li><span class="material-icons-round">check_circle</span> پشتیبانی اولویت‌دار ۲۴ ساعته و سرور اختصاصی</li>
                    </ul>
                </div>

                <div class="card-action-box">
                    <a href="auto_login.php?model=premium&role=public" target="_blank" class="storefront-main-btn">
                        <span class="material-icons-round" style="font-size: 16px;">visibility</span>
                        <span>مشاهده ظاهر سایت (دیدگاه خریدار)</span>
                    </a>
                    <div class="panels-subgrid">
                        <a href="auto_login.php?model=premium&role=user" class="panel-sub-btn" title="پنل کاربر">
                            <span class="material-icons-round">person</span>
                            <span>کاربر</span>
                        </a>
                        <a href="auto_login.php?model=premium&role=doctor" class="panel-sub-btn" title="پنل پزشک">
                            <span class="material-icons-round">medical_services</span>
                            <span>پزشک</span>
                        </a>
                        <a href="auto_login.php?model=premium&role=admin" class="panel-sub-btn" title="پنل مدیریت">
                            <span class="material-icons-round">admin_panel_settings</span>
                            <span>مدیر</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- 2. Pharmacy Suites Section -->
        <div id="pharmaSuites" class="pricing-grid" style="display: none;">
            
            <!-- Pharmacy Basic -->
            <div class="pricing-card">
                <div>
                    <span class="card-pill-badge normal">داروخانه آنلاین</span>
                    <div class="tier-header">
                        <h3 class="tier-name">داروخانه پایه</h3>
                        <span class="tier-tagline pharma">فروش آنلاین و تایید دیجیتال نسخه</span>
                        <p class="tier-desc">ویژه داروخانه‌های مستقل برای فروش دارو و تایید نسخ (بدون نوبت‌دهی کلینیک).</p>
                    </div>

                    <ul class="feature-list">
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> داروخانه آنلاین داروهای دام، طیور و پت</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> آپلود نسخه الکترونیک و تایید داروساز</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> توزیع امن با بسته‌بندی زنجیره سرد</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> کنترل انبار و تگ‌های دارویی</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> بخش نوبت‌دهی و ویزیت کلینیک</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> تحویل دوره‌ای خودکار (Autoship)</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> هوش مصنوعی پاسخگویی دارویی</li>
                    </ul>
                </div>

                <div class="card-action-box">
                    <a href="auto_login.php?model=pharmacy&role=public" target="_blank" class="storefront-main-btn teal-btn">
                        <span class="material-icons-round" style="font-size: 16px;">visibility</span>
                        <span>مشاهده ظاهر داروخانه (دیدگاه خریدار)</span>
                    </a>
                    <div class="panels-subgrid">
                        <a href="auto_login.php?model=pharmacy&role=user" class="panel-sub-btn" title="پنل خریدار">
                            <span class="material-icons-round">person</span>
                            <span>خریدار</span>
                        </a>
                        <a href="auto_login.php?model=pharmacy&role=doctor" class="panel-sub-btn" title="پنل داروساز">
                            <span class="material-icons-round">medical_services</span>
                            <span>داروساز</span>
                        </a>
                        <a href="auto_login.php?model=pharmacy&role=admin" class="panel-sub-btn" title="پنل مدیریت">
                            <span class="material-icons-round">admin_panel_settings</span>
                            <span>مدیر</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pharmacy Standard (BEST VALUE) -->
            <div class="pricing-card best-deal-pharma">
                <div>
                    <span class="card-pill-badge best-pharma">⭐ پیشنهاد طلایی داروخانه</span>
                    <div class="tier-header">
                        <h3 class="tier-name">داروخانه حرفه‌ای (استاندارد)</h3>
                        <span class="tier-tagline pharma">🔥 پرفروش‌ترین و سودآورترین پلن داروخانه‌ای</span>
                        <p class="tier-desc">داروخانه آنلاین، تایید نسخه، کلینیک و مشاوره، و ارسال دوره‌ای خودکار دارو (Autoship).</p>
                    </div>

                    <ul class="feature-list">
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> داروخانه کامل با فیلتر انواع گونه‌های دامی و خانگی</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> تایید اصالت نسخه و پروتکل‌های دوز مصرفی</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> <strong>ارسال خودکار و دوره‌ای داروهای مزمن (Autoship)</strong></li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> مشاوره تخصصی داروساز با بیمار از طریق تیکت آنلاین</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> بخش کلینیک، پرونده واکسیناسیون و نوبت‌دهی</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> رهگیری بسته‌های دارویی زنجیره سرد و دیسپچ سریع</li>
                        <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند هوش مصنوعی (لئو)</li>
                    </ul>
                </div>

                <div class="card-action-box">
                    <a href="auto_login.php?model=pharmacy&role=public" target="_blank" class="storefront-main-btn teal-btn">
                        <span class="material-icons-round" style="font-size: 16px;">visibility</span>
                        <span>مشاهده ظاهر داروخانه (دیدگاه خریدار)</span>
                    </a>
                    <div class="panels-subgrid">
                        <a href="auto_login.php?model=pharmacy&role=user" class="panel-sub-btn" title="پنل خریدار">
                            <span class="material-icons-round">person</span>
                            <span>خریدار</span>
                        </a>
                        <a href="auto_login.php?model=pharmacy&role=doctor" class="panel-sub-btn" title="پنل داروساز">
                            <span class="material-icons-round">medical_services</span>
                            <span>داروساز</span>
                        </a>
                        <a href="auto_login.php?model=pharmacy&role=admin" class="panel-sub-btn" style="color: var(--teal-pharma); font-weight: 800;" title="پنل مدیریت">
                            <span class="material-icons-round">admin_panel_settings</span>
                            <span>مدیر</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pharmacy Enterprise -->
            <div class="pricing-card">
                <div>
                    <span class="card-pill-badge enterprise">💎 مراکز پخش و مرجع</span>
                    <div class="tier-header">
                        <h3 class="tier-name">داروخانه سازمانی</h3>
                        <span class="tier-tagline pharma">سامانه مراکز پخش و بیمارستان‌های دامپزشکی</span>
                        <p class="tier-desc">مجهز به هوش مصنوعی تحلیل نسخه، سهمیه‌بندی انبار و باشگاه وفاداری.</p>
                    </div>

                    <ul class="feature-list">
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> تمامی امکانات داروخانه حرفه‌ای</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> <strong>دستیار هوش مصنوعی لئو برای راهنمایی دارویی و عوارض</strong></li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> باشگاه مشتریان و وفاداری در خرید مکمل‌ها</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> تخصیص اتوماتیک سهمیه انبار به مشترکین دائمی</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> یکپارچه‌سازی با نرم‌افزارهای حسابداری و انبارداری</li>
                        <li class="pharma-icon"><span class="material-icons-round">check_circle</span> سامانه ثبت پرونده فارم‌ها و گله‌های پرورشی</li>
                    </ul>
                </div>

                <div class="card-action-box">
                    <a href="auto_login.php?model=pharmacy&role=public" target="_blank" class="storefront-main-btn teal-btn">
                        <span class="material-icons-round" style="font-size: 16px;">visibility</span>
                        <span>مشاهده ظاهر داروخانه (دیدگاه خریدار)</span>
                    </a>
                    <div class="panels-subgrid">
                        <a href="auto_login.php?model=pharmacy&role=user" class="panel-sub-btn" title="پنل خریدار">
                            <span class="material-icons-round">person</span>
                            <span>خریدار</span>
                        </a>
                        <a href="auto_login.php?model=pharmacy&role=doctor" class="panel-sub-btn" title="پنل داروساز">
                            <span class="material-icons-round">medical_services</span>
                            <span>داروساز</span>
                        </a>
                        <a href="auto_login.php?model=pharmacy&role=admin" class="panel-sub-btn" title="پنل مدیریت">
                            <span class="material-icons-round">admin_panel_settings</span>
                            <span>مدیر</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- ABOUT -->
    <section id="about">
        <div class="about-box">
            <div>
                <h2 class="section-title" style="text-align: right; margin-bottom: 16px;">درباره آسنا</h2>
                <p>در آسنا، ما باور داریم که ارائه خدمات درمانی و دارویی حیوانات باید یکپارچه، دلسوزانه و فوق‌العاده کارآمد باشد. پلتفرم ما پلی دیجیتال میان صاحبان حیوانات، دامپزشکان دلسوز و داروخانه‌های تخصصی سراسر کشور است.</p>
                <p>هدف ما تجهیز کلینیک‌ها و داروخانه‌ها به مدرن‌ترین ابزارهای روز دنیا شامل تحویل خودکار دوره‌ای (Autoship)، پرونده الکترونیک سلامت، و توزیع با زنجیره سرد است تا فرآیندها ساده و رضایت مراجعین چندبرابر گردد.</p>
            </div>
            <div class="about-badge-icon">
                <span class="material-icons-round">favorite</span>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact">
        <div class="section-header">
            <h2 class="section-title">ارتباط با ما</h2>
            <p class="section-subtitle">سوالی در مورد پلن‌های مختلف یا استقرار اختصاصی روی دامنه و سرور خود دارید؟ همواره پاسخگوی شما هستیم.</p>
        </div>
        
        <div class="contact-grid">
            <div class="contact-card">
                <span class="material-icons-round">location_on</span>
                <h4>دفتر مرکزی</h4>
                <p>تبریز، ایران</p>
            </div>
            <div class="contact-card">
                <span class="material-icons-round">email</span>
                <h4>پست الکترونیک</h4>
                <p>hello@asena.company</p>
            </div>
            <div class="contact-card">
                <span class="material-icons-round">phone</span>
                <h4>تلفن تماس</h4>
                <p dir="ltr">+98 (0) 914 667 6978</p>
            </div>
        </div>
    </section>

    <footer>
        &copy; <?php echo date('Y'); ?> ASENA Company. All rights reserved. Designed with care.
    </footer>

    <script>
    function switchSuite(suite) {
        const petshopDiv = document.getElementById('petshopSuites');
        const pharmaDiv = document.getElementById('pharmaSuites');
        const tabPetshopBtn = document.getElementById('tabPetshopBtn');
        const tabPharmaBtn = document.getElementById('tabPharmaBtn');

        if (suite === 'pharmacy') {
            petshopDiv.style.display = 'none';
            pharmaDiv.style.display = 'grid';
            tabPetshopBtn.classList.remove('active');
            tabPharmaBtn.classList.add('active');
        } else {
            petshopDiv.style.display = 'grid';
            pharmaDiv.style.display = 'none';
            tabPetshopBtn.classList.add('active');
            tabPharmaBtn.classList.remove('active');
        }
    }
    </script>
</body>
</html>
