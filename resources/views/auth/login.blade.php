@extends("layouts.main")

@section("title", "Iniciar sesión")

@section("content")
    <div class="container">

        @if(isset($emailVerified) && !$emailVerified)
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                swal(@lang("Correo electrónico no verificado"), @lang("Tienes que verificar el correo electrónico para poder iniciar sesión."), "info");
            });
        </script>

        <noscript>
            <div class="alert alert-info">
                <h4>@lang("Correo electrónico no verificado")</h4>
                <p>
                    @lang("Tienes que verificar el correo electrónico para poder iniciar sesión.")
                </p>
            </div>
        </noscript>
        @endif

        @include("forms.auth.login")
    </div>

@endsection
