@extends("layouts.main")

@section("title", config("app.name"))

@section("content")

    <section class="container-fluid row mx-0" id="queEs">
        <div class="container align-self-center">
            <h1> @lang("¿Qué es la huella de carbono?") </h1>
            <hr>
            <div class="row align-items-center">

                <img src="{{ url("assets/img/huella.png") }}" class="offset-4 col-4 offset-sm-0 order-2 order-sm-1" alt= @lang("Huella de pie verde creado con bombillas, simbolo de reciclaje y otras imagenes que fomentan el ecologismo.")>

                <div class="col-12 col-sm-8 order-1 order-sm-2 text-justify">
                    <p>
                        @lang("El cambio climático")
                    </p>
                    <p class="d-none d-sm-block">
                        @lang("Bajo este prisma")
                    </p>
                </div>

                <p class="d-block d-sm-none col-sm-8 order-3 text-justify">
                    @lang("Bajo este prisma")
                </p>

            </div>
        </div>
    </section>

    <section class="container-fluid row mx-0" id="comoFunciona">
        <div class="container align-self-center">
            <h1> @lang("Cómo funciona") </h1>
            <hr>

            <p class="text-justify">
                @lang("Nunca había sido tan fácil")
            </p>

            <div class="card-deck mb-2">

                <div class="card bg-primary text-white">
                    <div class="card-header text-center">
                        <i class="fa fa-building-o fa-4x"></i>
                    </div>
                    <div class="card-body text-center">
                        @lang("Para comenzar")
                    </div>
                </div>
                <div class="card bg-primary text-white">
                    <div class="card-header text-center">
                        <i class="fa fa-database fa-4x"></i>
                    </div>
                    <div class="card-body text-center">
                        @lang("Una vez hayas terminado")
                    </div>
                </div>
                <div class="card bg-primary text-white">
                    <div class="card-header text-center">
                        <i class="fa fa-bar-chart fa-4x"></i>
                    </div>
                    <div class="card-body text-center">
                        @lang("Tras varias inserciones")
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid row px-0 mx-0" id="centrosInvolucrados">
        <div class="container align-self-center">
            <h1> @lang("Centros involucrados") </h1>
            <hr>
            <p> @lang("A continuación") </p>
            <ul class="buildings list-unstyled"></ul>
        </div>
        <div class="container-fluid px-0 mx-0" id="map">
            <noscript>
                <div class="container">
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong> @lang("¡Atención!") </strong>, @lang("parece ser que tienes javascript deshabilitado en tu navegador. Esto está impidiendo la carga del mapa, considera activarlo para poder disfrutar de mayor contenido y fluidez en la web.")
                    </div>
                </div>
            </noscript>
        </div>
    </section>

    <script src="{{ asset("assets/js/landingMap.js")}}" charset="utf-8" defer></script>
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        createMap();
        createMarkers(buildings);
    });

    let buildings = [
        @foreach(App\Models\Building::all() as $building)
        @if ($building->user->publicViewable && $building->latitude && $building->longitude)
        {
            "type": "building",
            "properties": {
                "name": "{{ $building->name }}",
                "description": "<p>{{ $building->description }}</p>",
            },
            "geometry": {
                "type": "Point",
                "coordinates": [{{ $building->longitude }}, {{ $building->latitude}}],
                "longitude": {{ $building->longitude }},
                "latitude": {{ $building->latitude }}
            }
        },
        @endif
        @endforeach
        ];
    </script>

    <section class="container-fluid row mx-0" id="contacto">
        <div class="container align-self-center">
            <div class="row">
                <div class="col-md-12">

                    <h1>@lang("Contacto")</h1>
                    <hr>
                    @include("forms.guest.contacto")

                </div>
            </div>
        </div>
    </section>

@endsection
