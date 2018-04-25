@extends("layouts.userHome")

@section("title", "Mi Perfil")

@section("userContent")

    <div class="container">
        <h2>Mi perfil</h2>
        <hr>
        
        @include("forms.user.profile")
    </div>

@endsection
