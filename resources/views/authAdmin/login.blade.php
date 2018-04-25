@extends("layouts.main")

@section("title", "Admin Login")

@section("content")
<div class="container">

    @include("forms.authAdmin.login")
</div>
@endsection
