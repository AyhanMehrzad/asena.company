<?php
/**
 * ASENA Ultra-Fast Non-Blocking Progress System
 * Eliminates redundant secondary splash modals while providing instant top-bar feedback
 */
?>
<!-- Top Turbo Progress Bar -->
<div id="asena-top-bar"></div>
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
</style>
<script>
(function() {
    var bar = document.getElementById('asena-top-bar');
    if (!bar) return;
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
})();
</script>
