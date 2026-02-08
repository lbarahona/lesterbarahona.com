/**
 * Dark / Light mode toggle
 */
(function() {
    var btn = document.querySelector('.theme-toggle');
    if (!btn) return;

    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
    }

    btn.addEventListener('click', function() {
        var current = document.documentElement.getAttribute('data-theme');
        setTheme(current === 'dark' ? 'light' : 'dark');
    });
})();
