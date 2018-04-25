$(document).ready(function() {
    $(window).on('scroll', updateNavbarColor);

    updateNavbarColor();
});

function updateNavbarColor() {
    try {
        if ($("#initial .nav-link").hasClass('active')){
            $("#mainNavbar").removeClass("bg-primary");
            $("#mainNavbar").addClass("bg-primary-alpha");
        } else {
            $("#mainNavbar").removeClass("bg-primary-alpha");
            $("#mainNavbar").addClass("bg-primary");
        }
    } catch(e) {}
}
