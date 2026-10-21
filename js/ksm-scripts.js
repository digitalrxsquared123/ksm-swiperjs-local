/* ==============================
   KSM STICKY HEADER ON SCROLL
   ============================== */

(function() {

    setTimeout(function() {

        const header = document.querySelector('.site-header');
        if (!header) return;

        // Remove WordPress auto-generated navy BG class
        // from inner groups so our CSS controls background
        const navyGroups = header.querySelectorAll(
            '.has-ksm-navy-background-color'
        );
        navyGroups.forEach(function(el) {
            el.classList.remove('has-ksm-navy-background-color');
        });

        // Set correct initial state on load
        if (window.scrollY > 80) {
            header.classList.add('scrolled');
        } else {
            header.classList.add('at-top');
        }

        // Scroll listener — desktop only
        window.addEventListener('scroll', function() {
            if (window.innerWidth <= 900) return;
            if (window.scrollY > 80) {
                header.classList.remove('at-top');
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
                header.classList.add('at-top');
            }
        }, { passive: true });

    }, 100);

})();
