@extends("layouts.main")

@section("content")

@include("elements.userNavbar")

<div class="px-3 mt-3" id="userContent">
    @yield("userContent")
</div>

<style>footer{
        display: none;
    }</style>

@endsection
