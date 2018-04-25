@extends("layouts.main")

@section("title", config("app.name"))

@section("content")

    <section class="container-fluid row mx-0" id="queEs">
        <div class="container align-self-center">
            <h1>¿Qué es la huella de carbono?</h1>
            <hr>
            <div class="row align-items-center">

                <img src="{{ url("assets/img/huella.png") }}" class="offset-4 col-4 offset-sm-0 order-2 order-sm-1" alt="Huella de pie verde creado con bombillas, simbolo de reciclaje y otras imagenes que fomentan el ecologismo.">

                <div class="col-12 col-sm-8 order-1 order-sm-2 text-justify">
                    <p>
                        El cambio climático, provocado por el aumento de la emisión de Gases de Efecto Invernadero (GEI) y en especial del CO<sub>2</sub>, es uno de los mayores problemas de nuestro tiempo y existen evidencias considerables de que la mayor parte de este aumento, ha sido causado por las actividades humanas. Hoy día, casi todas las actividades que realizamos y bienes que poseemos y utilizamos implican consumir materias primas como agua, energía, combustibles fósiles... y además una generación de residuos, contribuyendo a ese aumento de emisiones a la atmósfera.

                        La Huella de Carbono se conoce como una medida de la totalidad de gases de efecto invernadero, también conocidos como GEI, emitidos por efecto directo (por el centro/organización) o indirecto (emitidos por terceros).

                    </p>
                    <p class="d-none d-sm-block">
                        Bajo este prisma, la Huella de Carbono, representa una medida de la contribución de las organizaciones a dichas emisiones. Esto nos ayuda a ser entidades socialmente responsables y nos brinda una oportunidad más de concienciación para la divulgación entre los ciudadanos de prácticas más sostenibles con el objetivo de reducir nuestra contribución al cambio climático.
                        Con esta iniciativa se pretende cuantificar la cantidad de emisiones de GEI, medidas en emisiones de CO<sub>2</sub> equivalente, que son liberadas a la atmósfera debido a  en las actividades cotidianas de  nuestra organización  incluyendo una visión del ciclo de vida de los productos que utilizamos diariamente, desde la adquisición de las materias primas hasta su gestión como residuo. Esto permite a los consumidores decidir qué  productos comprar.

                    </p>
                </div>

                <p class="d-block d-sm-none col-sm-8 order-3 text-justify">
                    Bajo este prisma, la Huella de Carbono, representa una medida de la contribución de las organizaciones a dichas emisiones. Esto nos ayuda a ser entidades socialmente responsables y nos brinda una oportunidad más de concienciación para la divulgación entre los ciudadanos de prácticas más sostenibles con el objetivo de reducir nuestra contribución al cambio climático.
                    Con esta iniciativa se pretende cuantificar la cantidad de emisiones de GEI, medidas en emisiones de CO<sub>2</sub> equivalente, que son liberadas a la atmósfera debido a  en las actividades cotidianas de  nuestra organización  incluyendo una visión del ciclo de vida de los productos que utilizamos diariamente, desde la adquisición de las materias primas hasta su gestión como residuo. Esto permite a los consumidores decidir qué  productos comprar.

                </p>

            </div>
        </div>
    </section>

    <section class="container-fluid row mx-0" id="comoFunciona">
        <div class="container align-self-center">
            <h1>Cómo funciona</h1>
            <hr>

            <p class="text-justify">
                Nunca había sido tan fácil realizar el cálculo de la huella de carbono, una vez activada tu cuenta sigue los siguientes pasos.
            </p>

            <div class="card-deck mb-2">

                <div class="card bg-primary text-white">
                    <div class="card-header text-center">
                        <i class="fa fa-building-o fa-4x"></i>
                    </div>
                    <div class="card-body text-center">
                        Para comenzar has de registrar el edificio, simplemente indica un nombre y la dirección del mismo.
                    </div>
                </div>
                <div class="card bg-primary text-white">
                    <div class="card-header text-center">
                        <i class="fa fa-database fa-4x"></i>
                    </div>
                    <div class="card-body text-center">
                        Una vez hayas terminado con la inserción de los edificios inserta los datos requeridos. Es posible que necesites tener las facturas a mano para poder completar de forma precisa los datos.
                    </div>
                </div>
                <div class="card bg-primary text-white">
                    <div class="card-header text-center">
                        <i class="fa fa-bar-chart fa-4x"></i>
                    </div>
                    <div class="card-body text-center">
                        Tras varias inserciones tendrás a tu disposición gráficos con opción de realizar comparativas respecto a valores de otros años.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid row px-0 mx-0" id="centrosInvolucrados">
        <div class="container align-self-center">
            <h1>Centros involucrados</h1>
            <hr>
            <p>A continuación puedes ver los centros que ya utilizan la aplicación para realizar un seguimiento de la huella de carbono</p>
            <ul class="buildings list-unstyled"></ul>
        </div>
        <div class="container-fluid px-0 mx-0" id="map">
            <noscript>
                <div class="container">
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong>¡Atención!</strong>, parece ser que tienes javascript deshabilitado en tu navegador. Esto está impidiendo la carga del mapa, considera activarlo para poder disfrutar de mayor contenido y fluidez en la web.
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

                    <h1>Contacto</h1>
                    <hr>
                    @include("forms.guest.contacto")

                </div>
            </div>
        </div>
    </section>

@endsection
