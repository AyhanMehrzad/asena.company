document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.classList.contains('cursor-not-allowed') && !this.classList.contains('no-ripple')) {
                const ripple = document.createElement('div');
                ripple.className = 'absolute bg-white/20 rounded-full w-2 h-2 animate-ping';
                
                // Keep existing relative position if it exists, otherwise add it
                if (window.getComputedStyle(this).position === 'static') {
                    this.style.position = 'relative';
                }
                this.style.overflow = 'hidden';
                
                // Position ripple at click coordinates
                const rect = this.getBoundingClientRect();
                ripple.style.left = (e.clientX - rect.left - 4) + 'px';
                ripple.style.top = (e.clientY - rect.top - 4) + 'px';
                
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 500);
            }
        });
    });

    // Simple smooth scroll for the doctor list
    const doctorList = document.querySelector('.snap-x');
    if (doctorList) {
        let isDown = false;
        let startX;
        let scrollLeft;

        doctorList.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - doctorList.offsetLeft;
            scrollLeft = doctorList.scrollLeft;
        });
        doctorList.addEventListener('mouseleave', () => { isDown = false; });
        doctorList.addEventListener('mouseup', () => { isDown = false; });
        doctorList.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - doctorList.offsetLeft;
            const walk = (x - startX) * 2;
            doctorList.scrollLeft = scrollLeft - walk;
        });
    }
});
