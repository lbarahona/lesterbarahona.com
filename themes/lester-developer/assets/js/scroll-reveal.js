/**
 * Scroll Reveal — entrance animations via IntersectionObserver
 */
(function() {
    var elements = document.querySelectorAll('[data-reveal]');
    if (!elements.length) return;

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var delay = entry.target.getAttribute('data-reveal-delay');
                if (delay) {
                    entry.target.style.transitionDelay = delay + 'ms';
                }
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    elements.forEach(function(el) {
        observer.observe(el);
    });
})();
