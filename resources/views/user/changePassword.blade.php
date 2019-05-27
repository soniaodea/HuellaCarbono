@extends("layouts.userHome")

@section("title", __("Cambiar contraseña"))

@section("userContent")

    <div class="container">
        <h2>@lang("Cambiar contraseña")</h2>
        <hr>

        @if(session()->has("changed"))
        <noscript>
            <div class="alert alert-success">
                <i class="fa fa-check"></i>&nbsp;{{ trans("passwords.reset") }}
            </div>
        </noscript>
        <script type="text/javascript" defer>
        document.addEventListener("DOMContentLoaded", function () {
            swal({
                icon: "success",
                title: "{{ trans("passwords.reset") }}"
            });
        });
        </script>
        @endif

        @include("forms.user.changePassword")
    </div>

@endsection
