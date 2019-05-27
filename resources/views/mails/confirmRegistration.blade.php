<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang("Confirmación de Registro")</title>
</head>
<body>
    <h2>
        @lang("Confirmación de registro,") {{ config("app.name") }}
    </h2>
    <p>
        {{--Tu dirección de correo {{ $email }} ha sido registrada en nuestra aplicación {{ config("app.url") }}. Pulsa sobre <a href="{{ route( "registerEmailConfirmation",["token" => $confirmLink]) }}">este enlace</a> o copia la siguiente url en tu navegador <a href="{{ route( "registerEmailConfirmation",["token" => $confirmLink]) }}">{{ route( "registerEmailConfirmation",["code" => $confirmLink]) }}</a> para activar tu cuenta.--> --}}
            @lang("Tu dirección de correo") {{ $email }} @lang("ha sido registrada en nuestra aplicación web Karbono Aztarna. Pulsa sobre") <a href="{{ route( "registerEmailConfirmation",["token" => $confirmLink]) }}">@lang("este enlace")</a> @lang("o copia la siguiente url en tu navegador") <a href="{{ route( "registerEmailConfirmation",["token" => $confirmLink]) }}">{{ route( "registerEmailConfirmation",["code" => $confirmLink]) }}</a> @lang("para activar tu cuenta.")
    </p>
</body>
</html>
