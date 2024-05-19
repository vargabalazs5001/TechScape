$(document).ready(function () {
    // Ellenőrzi, hogy a felhasználó korábban választott-e már témamódot
    function checkTheme() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            setDarkMode();
        } else {
            setLightMode();
        }
    }

    // Funkció a sötét mód beállításához
    function setDarkMode() {
        $('body').addClass('dark-mode');
        localStorage.setItem('theme', 'dark');
    }

    // Funkció a világos mód beállításához
    function setLightMode() {
        $('body').removeClass('dark-mode');
        localStorage.setItem('theme', 'light');
    }

    // Figyeljük az oldal betöltését
    checkTheme();

    // Eseménykezelő a sötét és világos mód váltásához
    $('.material-symbols-rounded').click(function () {
        if ($('body').hasClass('dark-mode')) {
            setLightMode();
        } else {
            setDarkMode();
        }
    });

    // Figyeljük az AJAX kéréseket
    $(document).ajaxComplete(function () {
        checkTheme();
    });
});
