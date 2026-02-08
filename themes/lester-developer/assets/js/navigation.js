/**
 * Navigation — mobile toggle + scroll-aware header
 */
(function() {
    var toggle = document.querySelector('.menu-toggle');
    var navGroup = document.getElementById('header-nav');
    var header = document.getElementById('masthead');

    // Mobile menu toggle
    if (toggle && navGroup) {
        toggle.addEventListener('click', function() {
            navGroup.classList.toggle('toggled');
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !expanded);
        });

        document.addEventListener('click', function(event) {
            if (!navGroup.contains(event.target) && !toggle.contains(event.target)) {
                navGroup.classList.remove('toggled');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                navGroup.classList.remove('toggled');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Scroll-aware header shadow
    if (header) {
        var scrolled = false;
        window.addEventListener('scroll', function() {
            var isScrolled = window.scrollY > 10;
            if (isScrolled !== scrolled) {
                scrolled = isScrolled;
                header.classList.toggle('scrolled', scrolled);
            }
        }, { passive: true });
    }
})();
