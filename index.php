<?php
// ASENA Presentation Portal
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASENA | پلتفرم سازمانی نسل آینده</title>
    
    <!-- Vazirmatn Font for Beautiful Persian Typography -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.0.0/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <style>
        :root {
            /* Warm Blue & Orange Theme (From Premium Design) */
            --bg-color: #f4f6f9;
            --text-main: #001a48;
            --text-muted: #444651;
            
            --primary: #002d72; /* Premium Primary Container */
            --primary-light: #3d5ca2; /* Surface Tint */
            --primary-glow: rgba(0, 45, 114, 0.3);
            
            --secondary: #fd8100; /* Secondary Container */
            --secondary-glow: rgba(253, 129, 0, 0.2);
            
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
            --glass-shadow: 0 8px 32px 0 rgba(0, 45, 114, 0.08);
            
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

        /* Organic Background Shapes */
        .shape-1 {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(0, 45, 114, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -300px; /* Right for RTL */
            z-index: -1;
            filter: blur(40px);
            animation: float 12s infinite ease-in-out alternate;
        }
        
        .shape-2 {
            position: absolute;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(253, 129, 0, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: 10%;
            left: -200px; /* Left for RTL */
            z-index: -1;
            filter: blur(50px);
            animation: float 15s infinite ease-in-out alternate-reverse;
        }

        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-50px) scale(1.1); }
        }

        /* Navbar */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(244, 246, 249, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.4);
            direction: ltr; /* English standard layout */
        }

        .nav-logo {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 2px;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Outfit', sans-serif; /* English brand name */
            direction: ltr; /* Icon on the left of the text */
        }

        .nav-links {
            display: flex;
            gap: 32px;
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
            padding: 120px 20px 60px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 42px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 16px;
        }
        
        .section-subtitle {
            font-size: 18px;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Hero */
        .hero {
            text-align: center;
            padding-top: 180px;
            padding-bottom: 80px;
        }

        .hero h1 {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 24px;
            color: var(--text-main);
        }
        
        .hero h1 span {
            color: var(--primary);
        }

        /* Glassmorphism Models */
        .pricing-container {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 32px;
            flex-wrap: wrap;
        }

        .pricing-card {
            flex: 1;
            min-width: 320px;
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            border-radius: var(--card-radius);
            padding: 40px;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 45, 114, 0.15);
            background: rgba(255, 255, 255, 0.85);
        }

        .pricing-card.premium {
            border: 2px solid var(--primary-light);
            background: rgba(255, 255, 255, 0.9);
        }

        .premium-badge {
            position: absolute;
            top: 24px;
            left: -36px; /* RTL - absolute positioning flipped */
            background: var(--secondary);
            color: white;
            font-size: 12px;
            font-weight: 800;
            padding: 8px 40px;
            transform: rotate(-45deg);
            letter-spacing: 1.5px;
            box-shadow: 0 4px 12px var(--secondary-glow);
            font-family: 'Outfit', sans-serif;
        }

        .tier-name {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .tier-desc {
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 32px;
            line-height: 1.8;
        }

        .feature-list {
            list-style: none;
            margin-bottom: 40px;
            flex-grow: 1;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 15px;
            color: var(--text-main);
            font-weight: 500;
        }

        .feature-list li.disabled {
            color: #94a3b8;
            opacity: 0.6;
        }

        .feature-list li .material-icons-round {
            font-size: 22px;
            color: var(--secondary);
        }

        .feature-list li.disabled .material-icons-round {
            color: #cbd5e1;
        }

        .login-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            margin-top: auto;
        }

        .login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px;
            border-radius: 16px;
            border: 1px solid rgba(0, 45, 114, 0.2);
            background: rgba(0, 45, 114, 0.03);
            color: var(--primary);
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .login-btn:hover {
            background: rgba(0, 45, 114, 0.08);
            border-color: rgba(0, 45, 114, 0.3);
        }

        .login-btn.primary {
            background: var(--primary);
            color: white;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 45, 114, 0.2);
        }

        .login-btn.primary:hover {
            background: var(--primary-light);
            box-shadow: 0 12px 24px rgba(0, 45, 114, 0.3);
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
            padding: 60px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        
        .about-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: center;
        }
        
        .about-text p {
            font-size: 18px;
            line-height: 1.9;
            color: var(--text-muted);
            margin-bottom: 24px;
            text-align: justify;
        }
        
        .about-image {
            width: 100%;
            height: 350px;
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(0, 45, 114, 0.1), rgba(253, 129, 0, 0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid var(--glass-border);
        }
        
        .about-image .material-icons-round {
            font-size: 100px;
            color: var(--secondary);
            opacity: 0.9;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 20px;
        }
        
        .contact-card {
            background: rgba(255,255,255,0.6);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid var(--glass-border);
            transition: transform 0.3s;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            background: white;
            box-shadow: 0 10px 20px rgba(0, 45, 114, 0.05);
        }
        
        .contact-card .material-icons-round {
            font-size: 40px;
            color: var(--secondary);
            margin-bottom: 16px;
        }
        
        .contact-card h4 {
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 700;
        }
        
        .contact-card p {
            color: var(--text-muted);
            font-weight: 500;
            font-family: 'Outfit', 'Vazirmatn', sans-serif;
        }

        footer {
            text-align: center;
            padding: 40px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 40px;
            border-top: 1px solid rgba(0, 45, 114, 0.1);
            direction: ltr;
        }

        @media (max-width: 900px) {
            .about-grid { grid-template-columns: 1fr; }
            .contact-grid { grid-template-columns: 1fr; }
            .hero h1 { font-size: 40px; }
            nav { padding: 20px; }
            .nav-links { display: none; }
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
            <a href="#models">مدل‌های ما</a>
            <a href="#about">درباره ما</a>
            <a href="#contact">تماس با ما</a>
        </div>
    </nav>

    <section class="hero">
        <h1>مراقبتی هوشمندانه برای<br><span>همراهان همیشگی شما</span></h1>
        <p class="section-subtitle" style="margin-top: 24px; font-size: 20px;">
            تجربه‌ای زیبا، صمیمی و کارآمد. طراحی شده مخصوص کلینیک‌های دامپزشکی و صاحبان حیوانات خانگی.
        </p>
    </section>

    <section id="models">
        <div class="section-header">
            <h2 class="section-title">مدل‌های اپلیکیشن</h2>
            <p class="section-subtitle">پلن مناسب برای کلینیک خود را انتخاب کنید و دموهای تعاملی ما را بررسی نمایید.</p>
        </div>

        <div class="pricing-container">
            
            <!-- Basic Tier -->
            <div class="pricing-card">
                <h2 class="tier-name">مدل پایه</h2>
                <p class="tier-desc">امکانات ضروری برای افراد و کلینیک‌های کوچک.</p>
                
                <ul class="feature-list">
                    <li><span class="material-icons-round">check_circle</span> پرونده پزشکی هسته‌ای</li>
                    <li><span class="material-icons-round">check_circle</span> سیستم نوبت‌دهی آنلاین</li>
                    <li><span class="material-icons-round">check_circle</span> فروشگاه الکترونیک پایه</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> سیستم پشتیبانی تیکت</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> مدیریت اشتراک‌های خودکار</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند (هوش مصنوعی)</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> باشگاه مشتریان و امتیاز وفاداری</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=basic&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> ورود به عنوان کاربر
                    </a>
                    <a href="auto_login.php?model=basic&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> ورود به عنوان پزشک
                    </a>
                    <a href="auto_login.php?model=basic&role=admin" class="login-btn primary">
                        <span class="material-icons-round">admin_panel_settings</span> ورود به عنوان مدیر
                    </a>
                </div>
            </div>

            <!-- Standard Tier -->
            <div class="pricing-card">
                <h2 class="tier-name">مدل حرفه‌ای</h2>
                <p class="tier-desc">ابزارهای پیشرفته مدیریت کلینیک همراه با سیستم پشتیبانی.</p>
                
                <ul class="feature-list">
                    <li><span class="material-icons-round">check_circle</span> پرونده پزشکی هسته‌ای</li>
                    <li><span class="material-icons-round">check_circle</span> سیستم نوبت‌دهی آنلاین</li>
                    <li><span class="material-icons-round">check_circle</span> فروشگاه الکترونیک پایه</li>
                    <li><span class="material-icons-round">check_circle</span> سیستم پشتیبانی تیکت</li>
                    <li><span class="material-icons-round">check_circle</span> مدیریت اشتراک‌های خودکار</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> دستیار هوشمند (هوش مصنوعی)</li>
                    <li class="disabled"><span class="material-icons-round">cancel</span> باشگاه مشتریان و امتیاز وفاداری</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=standard&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> ورود به عنوان کاربر
                    </a>
                    <a href="auto_login.php?model=standard&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> ورود به عنوان پزشک
                    </a>
                    <a href="auto_login.php?model=standard&role=admin" class="login-btn primary">
                        <span class="material-icons-round">admin_panel_settings</span> ورود به عنوان مدیر
                    </a>
                </div>
            </div>

            <!-- Premium Tier -->
            <div class="pricing-card premium">
                <div class="premium-badge">ENTERPRISE</div>
                <h2 class="tier-name">مدل سازمانی</h2>
                <p class="tier-desc">تجربه کامل پلتفرم آسنا همراه با هوش مصنوعی و باشگاه مشتریان.</p>
                
                <ul class="feature-list">
                    <li><span class="material-icons-round">check_circle</span> پرونده پزشکی هسته‌ای</li>
                    <li><span class="material-icons-round">check_circle</span> سیستم نوبت‌دهی آنلاین</li>
                    <li><span class="material-icons-round">check_circle</span> فروشگاه الکترونیک پایه</li>
                    <li><span class="material-icons-round">check_circle</span> سیستم پشتیبانی تیکت</li>
                    <li><span class="material-icons-round">check_circle</span> مدیریت اشتراک‌های خودکار</li>
                    <li><span class="material-icons-round">check_circle</span> دستیار هوشمند (لئو)</li>
                    <li><span class="material-icons-round">check_circle</span> باشگاه مشتریان و امتیاز وفاداری</li>
                </ul>

                <div class="login-grid">
                    <a href="auto_login.php?model=premium&role=user" class="login-btn">
                        <span class="material-icons-round">person</span> ورود به عنوان کاربر
                    </a>
                    <a href="auto_login.php?model=premium&role=doctor" class="login-btn">
                        <span class="material-icons-round">medical_services</span> ورود به عنوان پزشک
                    </a>
                    <a href="auto_login.php?model=premium&role=admin" class="login-btn primary">
                        <span class="material-icons-round">admin_panel_settings</span> ورود به عنوان مدیر
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section id="about">
        <div class="glass-panel">
            <div class="section-header" style="margin-bottom: 30px;">
                <h2 class="section-title">درباره آسنا</h2>
            </div>
            
            <div class="about-grid">
                <div class="about-text">
                    <p>در آسنا، ما باور داریم که مراقبت از حیوانات خانگی باید یکپارچه، دلسوزانه و بسیار کارآمد باشد. پلتفرم ما که توسط تیمی متخصص و عاشق حیوانات توسعه یافته، پلی است میان صاحبان حیوانات و دامپزشکان متعهد.</p>
                    <p>ما پلتفرم آسنا را از پایه و اساس طراحی کردیم تا محیطی دیجیتال، گرم و صمیمی فراهم کنیم و از فضای سرد و خشک نرم‌افزارهای مدیریتی سنتی فاصله بگیریم. هدف ما قدرت بخشیدن به کلینیک‌ها با ابزارهای نوین از جمله دستیار هوش مصنوعی، فروشگاه یکپارچه و پرونده الکترونیک سلامت است؛ تا شما بتوانید روی مهم‌ترین موضوع تمرکز کنید: سلامت و شادی حیواناتی که تحت مراقبت شما هستند.</p>
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
            <p class="section-subtitle">سوالی در مورد مدل‌های مختلف یا استقرار اختصاصی دارید؟ خوشحال می‌شویم صدای شما را بشنویم.</p>
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
</body>
</html>
