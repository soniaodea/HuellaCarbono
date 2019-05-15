<header id="inicio">
    <div class="embed-responsive embed-responsive-16by9">
        <video class="embed-responsive-item video-js" autoplay loop muted poster="https://images.unsplash.com/photo-1502219778817-93d41333bd19?dpr=1&auto=format&fit=crop&w=1000&q=80&cs=tinysrgb&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" style="object-fit:cover;">
            <source src="assets/video/video.mp4" type="video/mp4">
            <source src="assets/video/video.webm" type="video/webm">
        </video>
    </div>
    <div id="superpuesto">
        <div class="vertical-aligned">

            @if(Request::session()->get("postRegister"))
            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function () {
                    swal(@lang("Activación de cuenta"), @lang("Se ha enviado un email de confirmación a la dirección indicada,una vez confirmado el email se activará la cuenta"), "info");
                });
            </script>

            <noscript>
                <div class="alert alert-info">
                    <h4> @lang("Activación de cuenta") </h4>
                    <p>
                        @lang("Se ha enviado un email de confirmación a la dirección indicada,una vez confirmado el email se activará la cuenta")
                    </p>
                </div>
            </noscript>
            @endif

            @if(Request::session()->get("accountActivated"))
            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function () {
                    swal(@lang("Cuenta activada"), @lang("Se ha realizado la activación de la cuenta"), "success").then(function() {
                        $("#loginModal #email").val("{{ Request::session()->get("emailAddress") }}");
                        $("#loginModal").modal("show");
                    });
                });
            </script>

            <noscript>
                <div class="alert alert-success">
                    <h4> @lang("Cuenta activada") </h4>
                    <p>
                        @lang("Se ha enviado un email de confirmación a la dirección indicada,una vez confirmado el email se activará la cuenta")
                    </p>
                </div>
            </noscript>
            @endif

            @if(Request::session()->get("emailVerified") === false)
            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function () {
                    swal(@lang("Cuenta pendiente de activación"), @lang("Te ha sido enviado un email para confirmar la cuenta, no podrás iniciar sesión hasta que esta quede activada"), "error").then(function() {
                        $("#loginModal #email").val("{{ Request::session()->get("emailAddress") }}");
                        $("#loginModal").modal("show");
                    });
                });
            </script>

            <noscript>
                <div class="alert alert-danger">
                    <h4> @lang("Cuenta pendiente de activación") </h4>
                    <p>
                        @lang("Te ha sido enviado un email para confirmar la cuenta, no podrás iniciar sesión hasta que esta quede activada")
                    </p>
                </div>
            </noscript>
            @endif

            <div class="titleContainer">
                <h2 class="headerText text-uppercase" data-target-resolver>
                    @lang("Huella de Carbono")
                </h2>
            </div>

            <a class="fa fa-chevron-down fa-3x botonHeader whiteScroll" href="#queEs"></a>
        </div>
    </div>
</header>
