@extends("layouts.main")

@section("title", "Iniciar sesión")

@section("content")
    <div class="container">

        @if(isset($emailVerified) && !$emailVerified)
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                swal("Email no verificado", "Tienes que verificar el correo electrónico para poder iniciar sesión.", "info");
            });
        </script>

        <noscript>
            <div class="alert alert-info">
                <h4>Email no verificado</h4>
                <p>
                    Tienes que verificar el correo electrónico para poder iniciar sesión.
                </p>
            </div>
        </noscript>
        @endif

        @include("forms.auth.login")
    </div>



@endsection
