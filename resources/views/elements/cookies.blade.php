<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js" defer></script>
<script defer>
    document.addEventListener("DOMContentLoaded", function () {
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#000000",
                    "text": "#ffffff"
                },
                "button": {
                    "background": "trasparent",
                    "text": "#5cb85c",
                    "border": "#5cb85c"
                }
            },
            "content": {
                "message": @lang("Utilizamos cookies para proporcionar una mejor experiencia web, si continuas navengando entendemos que aceptas la utilización de las mismas."),
                "dismiss": @lang("Entendido"),
                "link": @lang("Más información"),
                "href": "{{ route("termsOfService") }}"
            },
            "showLink": true,
        });
    });
</script>
