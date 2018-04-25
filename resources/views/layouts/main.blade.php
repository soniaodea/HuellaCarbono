<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset("favicon.png") }}" type="image/png">

    @include("elements.head")

    <title>
        @yield("title", config("app.name"))
    </title>
</head>
<body @if(Request::url() == route("landing")) style="position:relative;" data-spy="scroll" data-target="mainNavbar" @else style="padding-top:74px;" @endif>

    @include("elements.navbar")

    @if(Request::url() == route("landing"))
        @include("elements.header")
    @endif

    <main class="p-0">
        @yield("content")
    </main>

    @include("elements.footer")

    @if (Request::route())
        @guest
            @include("elements.authModals")
        @endguest
    @endif

</body>
</html>
