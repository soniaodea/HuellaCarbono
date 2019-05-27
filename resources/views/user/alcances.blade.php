@extends("layouts.userHome")

@section("title", (($action == "view") ? __("Visualización de Alcances") : __("Gestión de Alcances")))

@section("userContent")

    <div class="container">
        <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
            @if(count($studies) > 0)
                @foreach($studies as $study)
                <li class="nav-item">
                    <a class="nav-link{{ ($errors->first("inputYear") == $study->year || Session::get("showYear") == $study->year) ? " active" : "" }}" id="study-{{ $study->year }}-tab" data-toggle="tab" href="#study-{{ $study->year }}">
                        @if($study->carbon_footprint)
                        <i class="fa fa-paw" title=@lang("Huella calculada")></i>
                        @else
                        <i class="fa fa-exclamation-triangle text-warning" title=@lang("Huella no calculada")></i>
                        @endif
                        {{ $study->year }}
                    </a>
                </li>
                @endforeach
            @elseif(count($studies) == 0 && $action == "view")
            <li class="nav-item">
                <a class="nav-link active">
                    <i class="fa fa-exclamation-triangle text-warning" title=@lang("Huella no calculada")></i>
                    @lang("Sin alcances")
                </a>
            </li>
            @endif

            @if($action == "create")
            <li class="nav-item">
                    <a class="nav-link{{ (empty($errors->first("inputYear")) && !Session::get("showYear")) ? " active" : "" }}" id="contact-tab" data-toggle="tab" href="#contact">
                    <i class="fa fa-plus"></i>
                    @lang("Crear nuevo")
                </a>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="myTabContent">
            @if(count($studies) > 0)
                @foreach($studies as $study)
                <div class="tab-pane fade{{ ($errors->first("inputYear") == $study->year || Session::get("showYear") == $study->year) ? " show active" : "" }}" id="study-{{ $study->year }}">

                    @if(!$study->carbon_footprint)
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        @lang("Cálculo del borrador de la huella de carbono") {{ $study->temporal_footprint }} tCO<sub>2</sub>e <br/>
                        <strong>@lang("¡Atención!")</strong>
                        @lang("Confirme los datos y pulse sobre el botón Calcular Huella de Carbono.") <br/>
                        @lang("Una vez calculada la huella definitivamente NO se podrán volver a editar sus valores.")
                    </div>
                    @else
                    <div class="alert alert-info">
                        <strong><i class="fa fa-paw"></i></strong> @lang("Valor de la huella:") {{ $study->carbon_footprint }} tCO<sub>2</sub>e
                    </div>
                    @endif

                    @include("forms.user.alcances", ["study" => $study])
                </div>
                @endforeach
            @elseif(count($studies) == 0 && $action == "view")
            <p>
                @lang("No se ha encontrado ningún alcance finalizado,") <a href="{{ route("alcancesCreate", ["id" => $id]) }}">@lang("acceder al panel de gestión")</a>.
            </p>
            @endif

            @if($action == "create")
            <div class="tab-pane fade{{ (empty($errors->first("inputYear")) && !Session::get("showYear")) ? " show active" : "" }}" id="contact">
                @include("forms.user.alcances", ["study" => new App\Models\Study])
            </div>
            @endif
        </div>
    </div>

    <script src="{{ asset("assets/js/user/studies.js") }}" defer></script>

    @if ($action == "view")
        @if (!Session::get("showYear"))

            <script type="text/javascript">
                $(function () {
                    $("#myTab .nav-item .nav-link").last().addClass("show active");
                    $("#myTabContent .tab-pane").last().addClass("show active");
                });
            </script>
        @endif
    @endif

    @if(Session::get("showYear"))
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            swal({
                icon: "success",
                title: @lang("Datos guardados"),
                text: " ",
                timer: 1500,
                buttons: false
            });
        });
    </script>
    @endif

    @if($errors->has("year"))
    <script type="text/javascript">
        $(function () {
            if (!!$("#myTab").find("li.active")) {
                $("#myTab a").last().click();
            }
        });
    </script>
    @endif

@endsection
