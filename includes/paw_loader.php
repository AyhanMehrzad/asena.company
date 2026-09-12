<?php
/**
 * ASENA Ultra-Cute Pet Care Launch & Progress System
 * Features cute puppy & kitten, vet stethoscope, food treats, and smooth non-blocking transition
 */
?>
<!-- Top Turbo Progress Bar -->
<div id="asena-top-bar"></div>

<!-- Cute Pet Startup Splash Overlay -->
<div id="asena-cute-splash" class="cute-splash-overlay">
    <div class="cute-splash-card">
        <div class="cute-splash-img-wrap">
            <span class="cute-bubble-particle cb-1">✨</span>
            <span class="cute-bubble-particle cb-2">🩺</span>
            <span class="cute-bubble-particle cb-3">🍖</span>
            <span class="cute-bubble-particle cb-4">💖</span>
            <span class="cute-bubble-particle cb-5">🐾</span>
            <img src="assets/images/cute-splash-icon-512.png" alt="ASENA Cute Pets & Vet Care" class="cute-hero-pet-img" width="180" height="180">
        </div>

        <h1 class="cute-splash-brand">
            <span>آسنا</span>
            <span class="cute-paw-icon">🐾</span>
        </h1>
        <p class="cute-splash-motto">مراقبت مهربان، درمان و غذای لذیذ پت شما</p>

        <div class="cute-tags-row">
            <span class="cute-tag">🐶 پت شاد</span>
            <span class="cute-tag">🩺 ویزیت آنلاین</span>
            <span class="cute-tag">🥣 غذای مقوی</span>
        </div>

        <div class="cute-pill-track">
            <div class="cute-pill-fill" id="cuteSplashFill"></div>
        </div>
    </div>

    <div class="cute-splash-footer">
        <span>ASENA Pet Care Platform</span>
        <span>•</span>
        <span>همراه مهربان شما</span>
    </div>
</div>

<style>
#asena-top-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, #0284c7, #38bdf8, #f59e0b);
    z-index: 2147483647;
    transition: width 0.2s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
    box-shadow: 0 0 8px rgba(56, 189, 248, 0.6);
    pointer-events: none;
}
#asena-top-bar.bar-hidden {
    opacity: 0;
}

/* Cute Splash Screen Styles */
.cute-splash-overlay {
    position: fixed;
    inset: 0;
    z-index: 2147483640;
    background: radial-gradient(circle at 50% 38%, #f0fdfa 0%, #ffffff 65%, #f8fafc 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    direction: rtl;
    font-family: 'Geist', 'Vazirmatn', system-ui, -apple-system, sans-serif;
    transition: opacity 0.45s cubic-bezier(0.4, 0, 0.2, 1), transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

.cute-splash-overlay.splash-visible {
    opacity: 1;
    pointer-events: auto;
}

.cute-splash-overlay.splash-hidden {
    opacity: 0 !important;
    transform: scale(1.03) !important;
    pointer-events: none !important;
}

.cute-splash-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 24px 20px;
    max-width: 360px;
    width: 90%;
}

.cute-splash-img-wrap {
    position: relative;
    width: 180px;
    height: 180px;
    margin-bottom: 20px;
    animation: cuteImgFloat 3.2s ease-in-out infinite;
}

.cute-hero-pet-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 36px;
    filter: drop-shadow(0 16px 30px rgba(14, 116, 144, 0.22));
    background: #ffffff;
    box-shadow: 0 10px 25px -5px rgba(0, 45, 114, 0.12), 0 0 0 4px #ffffff;
    transition: transform 0.3s ease;
}

/* Cute Floating Particles */
.cute-bubble-particle {
    position: absolute;
    pointer-events: none;
    animation: cuteParticleFloat 2.8s ease-in-out infinite;
    font-size: 20px;
    z-index: 3;
}
.cb-1 { top: -10px; right: -8px; animation-delay: 0s; font-size: 22px; }
.cb-2 { bottom: 12px; left: -14px; animation-delay: 0.9s; font-size: 24px; }
.cb-3 { top: 30px; left: -18px; animation-delay: 1.4s; font-size: 20px; }
.cb-4 { top: -14px; left: 16px; animation-delay: 0.5s; font-size: 22px; }
.cb-5 { bottom: -6px; right: -4px; animation-delay: 1.8s; font-size: 20px; }

.cute-splash-brand {
    font-size: 32px;
    font-weight: 900;
    color: #002d72;
    margin: 0 0 6px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    letter-spacing: -0.5px;
}

.cute-paw-icon {
    display: inline-block;
    animation: cutePawWobble 2s ease-in-out infinite;
    transform-origin: 75% 75%;
}

.cute-splash-motto {
    font-size: 14px;
    font-weight: 600;
    color: #0e7490;
    margin: 0 0 14px 0;
    line-height: 1.5;
}

.cute-tags-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 22px;
    flex-wrap: wrap;
}

.cute-tag {
    font-size: 11px;
    font-weight: 700;
    color: #0369a1;
    background: #e0f2fe;
    border: 1px solid #bae6fd;
    padding: 4px 10px;
    border-radius: 999px;
}

/* Cute Gradient Pill Progress Bar */
.cute-pill-track {
    width: 170px;
    height: 8px;
    background: #e2e8f0;
    border-radius: 999px;
    padding: 2px;
    overflow: hidden;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.06);
}

.cute-pill-fill {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, #38bdf8, #0ea5e9, #ec4899);
    border-radius: 999px;
    transition: width 1.1s cubic-bezier(0.15, 0.85, 0.35, 1);
}

.cute-splash-footer {
    position: absolute;
    bottom: 24px;
    font-size: 12px;
    font-weight: 700;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: 6px;
}

@keyframes cuteImgFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-7px); }
}

@keyframes cutePawWobble {
    0%, 100% { transform: rotate(0deg); }
    20% { transform: rotate(-14deg); }
    40% { transform: rotate(14deg); }
    60% { transform: rotate(-8deg); }
    80% { transform: rotate(8deg); }
}

@keyframes cuteParticleFloat {
    0%, 100% { transform: translateY(0) scale(0.95); opacity: 0.75; }
    50% { transform: translateY(-9px) scale(1.18); opacity: 1; }
}
</style>

<script>
(function() {
    // 1. Top progress bar logic (always runs fast for pages)
    var bar = document.getElementById('asena-top-bar');
    if (bar) {
        bar.style.width = '35%';
        var p = 35;
        var timer = setInterval(function() {
            if (p < 85) {
                p += 15;
                bar.style.width = p + '%';
            }
        }, 80);

        function finishBar() {
            clearInterval(timer);
            bar.style.width = '100%';
            setTimeout(function() {
                bar.classList.add('bar-hidden');
                setTimeout(function() {
                    try { bar.remove(); } catch(e) {}
                }, 350);
            }, 150);
        }

        if (document.readyState === 'complete') {
            finishBar();
        } else {
            window.addEventListener('load', finishBar);
            setTimeout(finishBar, 1500);
        }
    }

    // 2. Cute Startup Splash Logic (for PWA launch & fresh visits)
    var splash = document.getElementById('asena-cute-splash');
    if (!splash) return;

    var isPwa = window.matchMedia('(display-mode: standalone)').matches || 
                window.navigator.standalone === true || 
                window.location.search.includes('pwa=1') ||
                window.location.search.includes('splash=1') ||
                document.referrer.includes('android-app://');

    var seenInSession = sessionStorage.getItem('asena_cute_splash_seen');

    // Show on PWA launch or first visit in this browser session
    if (!seenInSession || window.location.search.includes('splash=1')) {
        splash.classList.add('splash-visible');
        sessionStorage.setItem('asena_cute_splash_seen', '1');

        requestAnimationFrame(function() {
            var fill = document.getElementById('cuteSplashFill');
            if (fill) {
                setTimeout(function() { fill.style.width = '100%'; }, 60);
            }
        });

        function dismissSplash() {
            if (!splash || splash.classList.contains('splash-hidden')) return;
            splash.classList.add('splash-hidden');
            setTimeout(function() {
                try { splash.remove(); } catch(e) {}
            }, 460);
        }

        // Tap/click to dismiss instantly
        splash.addEventListener('click', dismissSplash);

        if (document.readyState === 'complete') {
            setTimeout(dismissSplash, 1200);
        } else {
            window.addEventListener('load', function() {
                setTimeout(dismissSplash, 1100);
            });
            setTimeout(dismissSplash, 1800); // Fail-safe
        }
    } else {
        // Internal page-to-page navigation: instantly skip
        splash.remove();
    }
})();
</script>

