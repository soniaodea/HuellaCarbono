<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang("En mantenimiento")</title>
    @include("elements.head")
</head>
<body class="bg-primary">
    <div class="container d-flex justify-content-center align-items-center error">

        <div>
            <div class="jumbotron">
                <h1 class="display-4 text-center">@lang("Error 503")</h1>
                <p class="lead">
                    @lang("Estamos realizando trabajos de mantenimiento, volvemos en breves.")
                </p>
                <p class="text-center">
                    @lang("Disculpad la interrupción")
                </p>
                <p class="text-center text-primary">
                     <i class="fa fa-paw fa-2x"></i>
                </p>
            </div>
        </div>

    </div>
</body>
</html>
