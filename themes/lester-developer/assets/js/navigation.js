/**
 * Navigation toggle for mobile
 */
(function() {
    const toggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-navigation');

    if (!toggle || !navigation) {
        return;
    }

    toggle.addEventListener('click', function() {
        navigation.classList.toggle('toggled');
        const expanded = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', !expanded);
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!navigation.contains(event.target) && !toggle.contains(event.target)) {
            navigation.classList.remove('toggled');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            navigation.classList.remove('toggled');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
})();
