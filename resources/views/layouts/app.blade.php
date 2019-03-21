<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
<body>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>