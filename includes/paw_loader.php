<?php
/**
 * ASENA Signature Cute PWA Starter & Splash Suite
 * High-performance, self-contained, adorable splash screen for PWA app launches
 */
?>
<div id="asena-pwa-splash" aria-hidden="true">
    <style>
        #asena-pwa-splash {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999999;
            background: radial-gradient(circle at 50% 35%, #ffffff 0%, #f0f7ff 55%, #e1effe 100%);
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
            user-select: none;
            -webkit-user-select: none;
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #asena-pwa-splash.splash-active {
            display: flex;
        }

        #asena-pwa-splash.splash-dismissed {
            opacity: 0 !important;
            transform: scale(1.04) !important;
            pointer-events: none !important;
        }

        .cute-splash-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 32px 24px;
            position: relative;
            z-index: 2;
        }

        .cute-paw-badge-wrap {
            position: relative;
            width: 148px;
            height: 148px;
            margin-bottom: 24px;
            animation: cutePawFloat 2.8s ease-in-out infinite;
        }

        .cute-paw-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 36px;
            box-shadow: 0 20px 40px -10px rgba(0, 45, 114, 0.28), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
            filter: drop-shadow(0 8px 16px rgba(56, 189, 248, 0.25));
            animation: cutePawBounce 1.4s ease-in-out infinite alternate;
        }

        /* Floating cute sparkles and hearts */
        .cute-floating-particle {
            position: absolute;
            pointer-events: none;
            animation: floatParticle 3s ease-in-out infinite;
            opacity: 0.85;
            font-size: 20px;
        }

        .p-1 { top: -10px; right: -12px; animation-delay: 0s; }
        .p-2 { bottom: 15px; left: -18px; animation-delay: 1.2s; font-size: 22px; }
        .p-3 { top: 20px; left: -14px; animation-delay: 0.6s; font-size: 16px; }
        .p-4 { bottom: -6px; right: -8px; animation-delay: 1.8s; font-size: 18px; }

        .cute-splash-title {
            font-size: 28px;
            font-weight: 900;
            color: #002d72;
            margin: 0 0 6px 0;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: -0.5px;
        }

        .cute-splash-title span.paw-emoji {
            display: inline-block;
            animation: cuteWobble 2s ease-in-out infinite;
            transform-origin: 70% 70%;
        }

        .cute-splash-sub {
            font-size: 14px;
            font-weight: 600;
            color: #0369a1;
            margin: 0 0 28px 0;
            opacity: 0.92;
        }

        /* Cute Candy Pill Progress Bar */
        .cute-progress-container {
            width: 170px;
            height: 10px;
            background: rgba(2, 132, 199, 0.12);
            border-radius: 999px;
            padding: 2px;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .cute-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #38bdf8, #0284c7, #f472b6);
            border-radius: 999px;
            transition: width 1.1s cubic-bezier(0.1, 0.85, 0.25, 1);
        }

        .cute-bottom-badge {
            position: absolute;
            bottom: 28px;
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 0.5px;
            opacity: 0.8;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        @keyframes cutePawFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes cutePawBounce {
            0% { transform: scale(1); }
            100% { transform: scale(1.035); }
        }

        @keyframes cuteWobble {
            0%, 100% { transform: rotate(0deg); }
            20% { transform: rotate(-12deg); }
            40% { transform: rotate(12deg); }
            60% { transform: rotate(-6deg); }
            80% { transform: rotate(6deg); }
        }

        @keyframes floatParticle {
            0%, 100% { transform: translateY(0) scale(0.9); opacity: 0.6; }
            50% { transform: translateY(-10px) scale(1.15); opacity: 1; }
        }
    </style>

    <div class="cute-splash-card">
        <div class="cute-paw-badge-wrap">
            <span class="cute-floating-particle p-1">✨</span>
            <span class="cute-floating-particle p-2">💖</span>
            <span class="cute-floating-particle p-3">🐾</span>
            <span class="cute-floating-particle p-4">🌸</span>
            <img src="assets/images/pwa-icon-512.png?v=cute2" alt="ASENA Cute Paw" class="cute-paw-img" width="148" height="148">
        </div>

        <h1 class="cute-splash-title">
            <span>آسنا</span>
            <span class="paw-emoji">🐾</span>
        </h1>
        <p class="cute-splash-sub">همراه مهربان و دوست‌داشتنی پت شما</p>

        <div class="cute-progress-container">
            <div class="cute-progress-bar" id="cuteProgressBar"></div>
        </div>
    </div>

    <div class="cute-bottom-badge">
        <span>ASENA Pet Care Platform</span>
        <span>•</span>
        <span>نسخه هوشمند</span>
    </div>
</div>

<script>
(function() {
    // Detect PWA launch, standalone mode, or debug flag ?pwa=1
    const isPwaLaunch = window.matchMedia('(display-mode: standalone)').matches || 
                        window.navigator.standalone === true || 
                        window.location.search.includes('pwa=1') ||
                        document.referrer.includes('android-app://');

    const splash = document.getElementById('asena-pwa-splash');
    if (!splash) return;

    // Check if splash was already shown in this tab session
    const seen = sessionStorage.getItem('asena_pwa_splash_seen');

    if (!isPwaLaunch || seen) {
        // Instant bypass: Zero delay, zero visual footprint for normal browsing
        splash.style.display = 'none';
        return;
    }

    // Activate cute splash for PWA opening
    splash.classList.add('splash-active');
    sessionStorage.setItem('asena_pwa_splash_seen', '1');

    // Animate progress pill smoothly
    requestAnimationFrame(() => {
        const bar = document.getElementById('cuteProgressBar');
        if (bar) {
            setTimeout(() => { bar.style.width = '100%'; }, 50);
        }
    });

    // Gracefully dismiss after 1.2s
    function dismissCuteSplash() {
        if (!splash || splash.classList.contains('splash-dismissed')) return;
        splash.classList.add('splash-dismissed');
        setTimeout(() => {
            try { splash.remove(); } catch(e) {}
        }, 520);
    }

    if (document.readyState === 'complete') {
        setTimeout(dismissCuteSplash, 1250);
    } else {
        window.addEventListener('load', () => setTimeout(dismissCuteSplash, 1100));
        setTimeout(dismissCuteSplash, 1800); // Fail-safe timer
    }
})();
</script>
