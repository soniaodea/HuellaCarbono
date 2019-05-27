@extends("layouts.main")

@section("title", __("Error interno"))

@section("content")
    <div class="container d-flex justify-content-center align-items-center error">

        <div>
            <div class="jumbotron">
                <h1 class="display-4 text-center">@lang("Error 500")</h1>
                <p class="lead">
                    @lang("Oops, hemos tenido problemas al procesar tu solicitud, vuelve a intentarlo pasados unos segundos")
                </p>
            </div>
        </div>

    </div>
@endsection
