@extends("layouts.main")

@section("title", __("Registro"))

@section("content")
    <div class="container">

        @include("forms.auth.register")
    </div>

@endsection
