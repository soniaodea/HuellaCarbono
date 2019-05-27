@extends("layouts.userHome")

@section("title", __("Mi perfil"))

@section("userContent")

    <div class="container">
        <h2>@lang("Mi perfil")</h2>
        <hr>
        
        @include("forms.user.profile")
    </div>

@endsection
