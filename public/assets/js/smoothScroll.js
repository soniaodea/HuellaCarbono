$(document).ready(function(){
    $('body').scrollspy({target: "#mainNavbar", offset: 57});

    if (location.pathname == "/") {
        $("#mainNavbar a").on('click', function(event) {
            if (this.hash !== "") {
                event.preventDefault();

                var hash = this.hash;
                smoothScroll(hash);
                window.history.pushState(null, null, hash);
            }
        });
    }

    $(".botonHeader").on("click", function() {
        smoothScroll(this.hash);
    });

});

function smoothScroll(nodeElement) {
    $('html').animate({
        scrollTop: $(nodeElement).offset().top
    }, 500);
}
