<?php
// ASENA Presentation Portal - Multi-Tier Enterprise & Pharmacy Showcase
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASENA | پلتفرم سازمانی مدیریت کلینیک، پت‌شاپ و داروخانه دامپزشکی</title>
    
    <!-- Vazirmatn Font for Beautiful Persian Typography -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.0.0/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <style>
        :root {
            /* Warm Blue, Teal & Orange Theme */
            --bg-color: #f4f6f9;
            --text-main: #001a48;
            --text-muted: #444651;
            
            --primary: #002d72; /* Premium Primary */
            --primary-light: #3d5ca2;
            --primary-glow: rgba(0, 45, 114, 0.25);
            
            --secondary: #fd8100; /* Orange CTA */
            --secondary-glow: rgba(253, 129, 0, 0.25);

            --teal-pharma: #0f766e; /* Pharmacy Teal */
            --teal-light: #14b8a6;
            --teal-glow: rgba(15, 118, 110, 0.25);
            
            --glass-bg: rgba(255, 255, 255, 0.75);
            --glass-border: rgba(255, 255, 255, 0.6);
            --glass-shadow: 0 10px 36px 0 rgba(0, 45, 114, 0.07);
            
            --card-radius: 28px;
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

        /* Organic Background Glows */
        .shape-1 {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(0, 45, 114, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -300px;
            z-index: -1;
            filter: blur(40px);
            animation: float 12s infinite ease-in-out alternate;
        }
        
        .shape-2 {
            position: absolute;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(253, 129, 0, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            bottom: 10%;
            left: -200px;
            z-index: -1;
            filter: blur(50px);
            animation: float 15s infinite ease-in-out alternate-reverse;
        }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-40px) scale(1.08); }
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(244, 246, 249, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.6);
            direction: ltr;
        }

        .nav-logo {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Outfit', sans-serif;
            direction: ltr;
        }

        .nav-links {
            display: flex;
            gap: 28px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 600;
            font-size: 15px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--secondary);
        }

        section {
            padding: 100px 20px 60px;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-title {
            font-size: 38px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 12px;
        }
        
        .section-subtitle {
            font-size: 17px;
            color: var(--text-muted);
            max-width: 680px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Hero */
        .hero {
            text-align: center;
            padding-top: 150px;
            padding-bottom: 60px;
        }

        .hero h1 {
            font-size: 52px;
            font-weight: 900;
            line-height: 1.35;
            margin-bottom: 20px;
            color: var(--text-main);
        }
        
        .hero h1 span {
            color: var(--primary);
        }

        /* Category Switcher Tabs */
        .category-tabs {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            border: 1px solid rgba(0, 45, 114, 0.15);
            background: white;
            color: var(--text-muted);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .tab-btn:hover {
            transform: translateY(-2px);
            border-color: var(--primary-light);
            color: var(--primary);
        }

        .tab-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 8px 24px var(--primary-glow);
        }

        .tab-btn.active.pharma-tab {
            background: var(--teal-pharma);
            border-color: var(--teal-pharma);
            box-shadow: 0 8px 24px var(--teal-glow);
        }

        /* Pricing & Model Cards Container */
        .pricing-container {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 28px;
            flex-wrap: wrap;
        }

        .pricing-card {
            flex: 1;
            min-width: 320px;
            max-width: 380px;
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: var(--card-radius);
            padding: 36px 30px;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(0, 45, 114, 0.12);
            background: rgba(255, 255, 255, 0.95);
        }

        /* Best Value / Standard Highlight */
        .pricing-card.best-deal {
            border: 2px solid var(--secondary);
            background: rgba(255, 255, 255, 0.95);
            transform: scale(1.03);
            box-shadow: 0 16px 40px var(--secondary-glow);
        }

        .pricing-card.best-deal:hover {
            transform: scale(1.03) translateY(-8px);
            box-shadow: 0 24px 50px rgba(253, 129, 0, 0.3);
        }

        .pricing-card.best-deal-pharma {
            border: 2px solid var(--teal-light);
            background: rgba(255, 255, 255, 0.95);
            transform: scale(1.03);
            box-shadow: 0 16px 40px var(--teal-glow);
        }

        .pricing-card.best-deal-pharma:hover {
            transform: scale(1.03) translateY(-8px);
            box-shadow: 0 24px 50px rgba(20, 184, 166, 0.3);
        }

        .best-deal-badge {
            position: absolute;
            top: 20px;
            left: -38px;
            background: linear-gradient(135deg, #ea580c, #fd8100);
            color: white;
            font-size: 11px;
            font-weight: 900;
            padding: 6px 44px;
            transform: rotate(-45deg);
            letter-spacing: 1px;
            box-shadow: 0 4px 12px var(--secondary-glow);
        }

        .best-deal-pharma-badge {
            position: absolute;
            top: 20px;
            left: -38px;
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
            font-size: 11px;
            font-weight: 900;
            padding: 6px 44px;
            transform: rotate(-45deg);
            letter-spacing: 1px;
            box-shadow: 0 4px 12px var(--teal-glow);
        }

        .enterprise-badge {
            position: absolute;
            top: 20px;
            left: -38px;
            background: var(--primary);
            color: white;
            font-size: 11px;
            font-weight: 900;
            padding: 6px 44px;
            transform: rotate(-45deg);
            letter-spacing: 1px;
        }

        .tier-name {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        .tier-tagline {
            font-size: 12px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
            display: block;
        }

        .tier-tagline.pharma {
            color: var(--teal-pharma);
        }

        .tier-desc {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.7;
            min-height: 48px;
        }

        .feature-list {
            list-style: none;
            margin-bottom: 32px;
            flex-grow: 1;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 13px;
            font-size: 14px;
            color: var(--text-main);
            font-weight: 500;
        }

        .feature-list li.disabled {
            color: #94a3b8;
            opacity: 0.6;
        }

        .feature-list li .material-icons-round {
            font-size: 20px;
            color: var(--secondary);
            flex-shrink: 0;
        }

        .feature-list li.pharma-icon .material-icons-round {
            color: var(--teal-pharma);
        }

        .feature-list li.disabled .material-icons-round {
            color: #cbd5e1;
        }

        .login-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: auto;
        }

        .login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(0, 45, 114, 0.18);
            background: rgba(0, 45, 114, 0.03);
            color: var(--primary);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .login-btn:hover {
            background: rgba(0, 45, 114, 0.08);
            border-color: rgba(0, 45, 114, 0.3);
            transform: translateY(-1px);
        }

        .login-btn.primary {
            background: var(--primary);
            color: white;
            border: none;
            box-shadow: 0 6px 18px rgba(0, 45, 114, 0.2);
        }

        .login-btn.primary:hover {
            background: var(--primary-light);
            box-shadow: 0 10px 22px rgba(0, 45, 114, 0.3);
            transform: translateY(-2px);
        }

        .login-btn.cta-orange {
            background: linear-gradient(135deg, #ea580c, #fd8100);
            color: white;
            border: none;
            box-shadow: 0 6px 18px var(--secondary-glow);
        }

        .login-btn.cta-orange:hover {
            background: linear-gradient(135deg, #c2410c, #ea580c);
            box-shadow: 0 10px 22px rgba(253, 129, 0, 0.35);
            transform: translateY(-2px);
        }

        .login-btn.cta-teal {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
            border: none;
            box-shadow: 0 6px 18px var(--teal-glow);
        }

        .login-btn.cta-teal:hover {
            background: linear-gradient(135deg, #115e59, #0f766e);
            box-shadow: 0 10px 22px rgba(15, 118, 110, 0.35);
            transform: translateY(-2px);
        }

        /* About & Contact Sections */
        .glass-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: var(--card-radius);
            padding: 50px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .about-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: center;
        }
        
        .about-text p {
            font-size: 17px;
            line-height: 1.9;
            color: var(--text-muted);
            margin-bottom: 20px;
            text-align: justify;
        }
        
        .about-image {
            width: 100%;
            height: 320px;
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(0, 45, 114, 0.08), rgba(253, 129, 0, 0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid var(--glass-border);
        }
        
        .about-image .material-icons-round {
            font-size: 90px;
            color: var(--secondary);
            opacity: 0.9;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        
        .contact-card {
            background: rgba(255,255,255,0.7);
            padding: 26px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid var(--glass-border);
            transition: transform 0.3s;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            background: white;
            box-shadow: 0 10px 24px rgba(0, 45, 114, 0.06);
        }
        
        .contact-card .material-icons-round {
            font-size: 38px;
            color: var(--secondary);
            margin-bottom: 12px;
        }
        
        .contact-card h4 {
            font-size: 18px;
            margin-bottom: 6px;
            font-weight: 700;
        }
        
        .contact-card p {
            color: var(--text-muted);
            font-weight: 500;
            font-family: 'Outfit', 'Vazirmatn', sans-serif;
        }

        footer {
            text-align: center;
            padding: 36px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 40px;
            border-top: 1px solid rgba(0, 45, 114, 0.08);
            direction: ltr;
        }

        @media (max-width: 960px) {
            .about-grid { grid-template-columns: 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
            .hero h1 { font-size: 36px; }
            nav { padding: 18px 20px; }
            .nav-links { display: none; }
            .pricing-card.best-deal, .pricing-card.best-deal-pharma { transform: none; }
            .pricing-card.best-deal:hover, .pricing-card.best-deal-pharma:hover { transform: translateY(-8px); }
        }
    </style>
</head>
<body>
    <div class="shape-1"></div>
    <div class="shape-2"></div>

    <nav>
        <a href="#" class="nav-logo">
            <span class="material-icons-round">pets</span>
            ASENA
        </a>
        <div class="nav-links">
            <a href="#models">مدل‌های نرم‌افزار</a>
            <a href="#about">درباره ما</a>
            <a href="#contact">تماس با ما</a>
        </div>
    </nav>

    <section class="hero">
        <h1>پلتفرم جامع مدیریت<br><span>کلینیک، پت‌شاپ و داروخانه دامپزشکی</span></h1>
        <p class="section-subtitle">
            تجربه‌ای مدرن، هوشمند و یکپارچه؛ متناسب با نیاز کلینیک‌ها، پت‌شاپ‌ها و داروخانه‌های تخصصی دامپزشکی در سراسر کشور.
        </p>
    </section>

    <section id="models">
        <div class="section-header">
            <h2 class="section-title">مدل‌ها و نسخه‌های نرم‌افزار</h2>
            <p class="section-subtitle">حوزه فعالیت خود را انتخاب نمایید و نسخه‌های دمو را با یک کلیک به عنوان کاربر، پزشک یا مدیر بررسی کنید.</p>
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
        <div id="petshopSuites" class="pricing-container">
            
            <!-- Basic Tier -->
            <div class="pricing-card">
                <h3 class="tier-name">مدل پایه</h3>
                <span class="tier-tagline">امکانات ضروری فروشگاه و کلینیک</span>
                <p class="tier-desc">مناسب برای کلینیک‌های تازه‌تاسیس و پت‌شاپ‌های کوچک جهت مدیریت آسان نوبت‌ها و فروش اقلام.</p>
                
                <ul class="feature-list">
                    <li><span class="material-icons-round">check_circle</span> پرونده پزشکی و نوبت‌دهی آنلاین</li>
                    <li><span class="material-icons-round">check_circle</span> فروشگاه الکترونیک اقلام و غذای حیوانات</li>
                    <li><span class="material-icons-round">check_circle</span> پنل پزشک و مدیریت ویزیت‌ها</li>
                    <li><span class="material-icons-round">check_circle</span> درگاه پرداخت آنلاین و مدیریت سفارشات</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> سامانه تیکتینگ و پشتیبانی</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> تحویل دوره‌ای خودکار (Autoship)</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند (هوش مصنوعی لئو)</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=basic&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> دمو پنل کاربر
                    </a>
                    <a href="auto_login.php?model=basic&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> دمو پنل پزشک
                    </a>
                    <a href="auto_login.php?model=basic&role=admin" class="login-btn primary">
                        <span class="material-icons-round">admin_panel_settings</span> دمو پنل مدیریت
                    </a>
                </div>
            </div>

            <!-- Standard Tier (BEST DEAL - HIGH CONVERTING) -->
            <div class="pricing-card best-deal">
                <div class="best-deal-badge">🔥 پرفروش‌ترین پلن</div>
                <h3 class="tier-name">مدل حرفه‌ای (استاندارد)</h3>
                <span class="tier-tagline">⭐ بهترین و کامل‌ترین انتخاب برای ۹۰٪ مراکز</span>
                <p class="tier-desc">بهترین تعادل میان امکانات پیشرفته، تحویل دوره‌ای درآمدزا (Autoship) و رضایت حداکثری مراجعین.</p>
                
                <ul class="feature-list">
                    <li><span class="material-icons-round">check_circle</span> پرونده پزشکی کامل و نوبت‌دهی هوشمند</li>
                    <li><span class="material-icons-round">check_circle</span> فروشگاه اختصاصی پت‌شاپ با دسته‌بندی گونه‌ها</li>
                    <li><span class="material-icons-round">check_circle</span> <strong>تحویل دوره‌ای خودکار (Autoship) غذا و ملزومات</strong></li>
                    <li><span class="material-icons-round">check_circle</span> سامانه تیکت و مشاوره آنلاین پزشک با کاربر</li>
                    <li><span class="material-icons-round">check_circle</span> پنل نوبت‌دهی تقویمی ۷ روزه و مدیریت مالی</li>
                    <li><span class="material-icons-round">check_circle</span> سیستم پیامک OTP و احراز هویت دومرحله‌ای</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند هوش مصنوعی (لئو)</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=standard&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> دمو پنل کاربر
                    </a>
                    <a href="auto_login.php?model=standard&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> دمو پنل پزشک
                    </a>
                    <a href="auto_login.php?model=standard&role=admin" class="login-btn cta-orange">
                        <span class="material-icons-round">admin_panel_settings</span> دمو پنل مدیریت (پیشنهاد ویژه)
                    </a>
                </div>
            </div>

            <!-- Enterprise / Premium Tier -->
            <div class="pricing-card">
                <div class="enterprise-badge">ENTERPRISE</div>
                <h3 class="tier-name">مدل سازمانی (پریمیوم)</h3>
                <span class="tier-tagline">سامانه همه‌جانبه همراه با هوش مصنوعی</span>
                <p class="tier-desc">پکیج فول‌آپشن آسنا مجهز به دستیار هوش مصنوعی لئو و باشگاه وفاداری برای بیمارستان‌ها و مراکز بزرگ.</p>
                
                <ul class="feature-list">
                    <li><span class="material-icons-round">check_circle</span> تمامی امکانات نسخه حرفه‌ای</li>
                    <li><span class="material-icons-round">check_circle</span> <strong>دستیار هوشمند هوش مصنوعی (لئو) با حافظه گفتگو</strong></li>
                    <li><span class="material-icons-round">check_circle</span> سیستم پیشرفته بسته‌های اشتراکی سفارشی (Custom Box)</li>
                    <li><span class="material-icons-round">check_circle</span> سیستم امتیازدهی و رتبه‌بندی بیزی پیشرفته کالاها</li>
                    <li><span class="material-icons-round">check_circle</span> داشبورد آماری و تحلیل رفتار مشتریان</li>
                    <li><span class="material-icons-round">check_circle</span> پشتیبانی اولویت‌دار ۲۴ ساعته و سرور اختصاصی</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=premium&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> دمو پنل کاربر
                    </a>
                    <a href="auto_login.php?model=premium&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> دمو پنل پزشک
                    </a>
                    <a href="auto_login.php?model=premium&role=admin" class="login-btn primary">
                        <span class="material-icons-round">admin_panel_settings</span> دمو پنل مدیریت
                    </a>
                </div>
            </div>

        </div>

        <!-- 2. Pharmacy Suites Section -->
        <div id="pharmaSuites" class="pricing-container" style="display: none;">
            
            <!-- Pharmacy Basic -->
            <div class="pricing-card">
                <h3 class="tier-name">داروخانه پایه</h3>
                <span class="tier-tagline pharma">فروش آنلاین و تایید دیجیتال نسخه</span>
                <p class="tier-desc">ویژه داروخانه‌های دامپزشکی مستقل برای فروش اینترنتی مکمل‌ها و ثبت و تایید نسخ دارویی (بدون نوبت‌دهی کلینیک).</p>
                
                <ul class="feature-list">
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> داروخانه آنلاین داروهای دام، طیور و پت</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> آپلود نسخه الکترونیک و تایید داروساز</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> سیستم توزیع امن با زنجیره سرد</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> کنترل موجودی و تگ‌های دارویی</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> بخش نوبت‌دهی و ویزیت کلینیک</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> ارسال دوره‌ای خودکار دارو (Autoship)</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> هوش مصنوعی پاسخگویی دارویی</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=pharmacy&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> دمو پنل خریدار دارو
                    </a>
                    <a href="auto_login.php?model=pharmacy&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> دمو پنل داروساز
                    </a>
                    <a href="auto_login.php?model=pharmacy&role=admin" class="login-btn primary" style="background: var(--teal-pharma);">
                        <span class="material-icons-round">local_pharmacy</span> دمو مدیریت داروخانه
                    </a>
                </div>
            </div>

            <!-- Pharmacy Standard (BEST DEAL FOR PHARMACIES) -->
            <div class="pricing-card best-deal-pharma">
                <div class="best-deal-pharma-badge">⭐ پیشنهاد طلایی داروخانه</div>
                <h3 class="tier-name">داروخانه حرفه‌ای (استاندارد)</h3>
                <span class="tier-tagline pharma">🔥 پرفروش‌ترین و سودآورترین پلن داروخانه‌ای</span>
                <p class="tier-desc">ترکیب قدرتمند داروخانه آنلاین، تایید نسخه، کلینیک و مشاوره، و ارسال دوره‌ای خودکار داروهای مزمن (Autoship).</p>
                
                <ul class="feature-list">
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> داروخانه کامل با فیلتر انواع گونه‌های دامی و خانگی</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> تایید اصالت نسخه و پروتکل‌های دوز مصرفی</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> <strong>ارسال خودکار و دوره‌ای داروهای مزمن (Autoship) با تخفیف</strong></li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> مشاوره تخصصی داروساز با بیمار از طریق تیکت آنلاین</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> بخش کلینیک، پرونده واکسیناسیون و نوبت‌دهی</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> رهگیری بسته‌های دارویی زنجیره سرد و دیسپچ سریع</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند هوش مصنوعی (لئو)</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=pharmacy&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> دمو پنل خریدار دارو
                    </a>
                    <a href="auto_login.php?model=pharmacy&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> دمو پنل داروساز
                    </a>
                    <a href="auto_login.php?model=pharmacy&role=admin" class="login-btn cta-teal">
                        <span class="material-icons-round">local_pharmacy</span> دمو مدیریت داروخانه (پیشنهاد ویژه)
                    </a>
                </div>
            </div>

            <!-- Pharmacy Enterprise -->
            <div class="pricing-card">
                <div class="enterprise-badge" style="background: var(--teal-pharma);">PHARMACY ENTERPRISE</div>
                <h3 class="tier-name">داروخانه سازمانی</h3>
                <span class="tier-tagline pharma">سامانه جامع مراکز پخش و داروخانه‌های مرجع</span>
                <p class="tier-desc">مجهز به هوش مصنوعی تحلیل نسخه، پشتیبانی ۲۴ ساعته داروساز، توزیع عمده و باشگاه وفاداری مشتریان.</p>
                
                <ul class="feature-list">
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> تمامی امکانات داروخانه حرفه‌ای</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> <strong>دستیار هوش مصنوعی لئو برای راهنمایی دارویی و عوارض</strong></li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> باشگاه وفاداری و امتیاز خرید دارو و مکمل‌ها</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> تخصیص اتوماتیک سهمیه انبار به مشترکین دائمی</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> یکپارچه‌سازی با نرم‌افزارهای حسابداری و انبارداری</li>
                    <li class="pharma-icon"><span class="material-icons-round">check_circle</span> سامانه ثبت پرونده فارم‌ها و گله‌های پرورشی</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=pharmacy&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> دمو پنل خریدار دارو
                    </a>
                    <a href="auto_login.php?model=pharmacy&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> دمو پنل داروساز
                    </a>
                    <a href="auto_login.php?model=pharmacy&role=admin" class="login-btn primary" style="background: var(--teal-pharma);">
                        <span class="material-icons-round">local_pharmacy</span> دمو مدیریت داروخانه
                    </a>
                </div>
            </div>

        </div>

    </section>

    <section id="about">
        <div class="glass-panel">
            <div class="section-header" style="margin-bottom: 24px;">
                <h2 class="section-title">درباره آسنا</h2>
            </div>
            
            <div class="about-grid">
                <div class="about-text">
                    <p>در آسنا، ما باور داریم که خدمات درمانی و دارویی حیوانات باید یکپارچه، دلسوزانه و فوق‌العاده کارآمد باشد. پلتفرم ما پلی دیجیتال میان صاحبان حیوانات، دامپزشکان دلسوز و داروخانه‌های تخصصی سراسر کشور است.</p>
                    <p>ما پلتفرم آسنا را از پایه و اساس طراحی کردیم تا محیطی دیجیتال، امن و صمیمی فراهم کنیم و از فضای پیچیده نرم‌افزارهای سنتی فاصله بگیریم. هدف ما قدرت بخشیدن به کلینیک‌ها و داروخانه‌ها با ابزارهای نوین نظیر تحویل خودکار دوره‌ای (Autoship)، پرونده الکترونیک سلامت و توزیع با زنجیره سرد است.</p>
                </div>
                <div class="about-image">
                    <span class="material-icons-round">favorite</span>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="section-header">
            <h2 class="section-title">ارتباط با ما</h2>
            <p class="section-subtitle">سوالی در مورد پلن‌های مختلف یا استقرار اختصاصی روی دامنه و سرور خود دارید؟ با ما در تماس باشید.</p>
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
            pharmaDiv.style.display = 'flex';
            tabPetshopBtn.classList.remove('active');
            tabPharmaBtn.classList.add('active');
        } else {
            petshopDiv.style.display = 'flex';
            pharmaDiv.style.display = 'none';
            tabPetshopBtn.classList.add('active');
            tabPharmaBtn.classList.remove('active');
        }
    }
    </script>
</body>
</html>
