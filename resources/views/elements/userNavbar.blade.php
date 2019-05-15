<i class="fa fa-bars fa-2x toggle-btn" id="toggleNav"></i>

<script type="text/javascript">
    $(function (){
        let $userNav = $(".nav-side-menu");
        $("#toggleNav").on("click", function (e) {
            $userNav.addClass("open");
            e.stopPropagation();
        });

        $(document.body).click(function(event) {
            if($userNav.hasClass("open")) {
                if(event.target.closest('.nav-side-menu') === null) {
                    $userNav.removeClass("open");
                } else if ($(event.target).attr("data-action") == "close-nav") {
                    $userNav.removeClass("open");
                }
            }
        });
    });
</script>

<nav class="nav-side-menu">
    <div class="brand">{{ Auth::user()->name }}</div>
    <i class="d-none fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a href="{{ route("user.profile") }}">
                    <i class="fa fa-user fa-lg"></i> @lang("Perfil")
                </a>
            </li>
           <li data-toggle="collapse" data-target="#service" class="collapsed">

                <a href="{{ URL::route('building') }}">
                    <i class="fa fa-globe fa-lg"></i> @lang("Edificios")
                </a>
           </li>

           <li data-toggle="collapse" data-target="#stats" class="collapsed">
                <a href="#"><i class="fa fa-bar-chart fa-lg"></i>  @lang("Estadísticas") <span class="arrow"></span></a>
           </li>
           <ul class="sub-menu collapse" id="stats">
               <a href="#">
                   <li data-toggle="collapse" data-target="#elemsAll" class="collapsed">
                        @lang("Todos los edificios") <span class="arrow"></span>
                   </li>
               </a>
               <ul class="sub-menu collapse" id="elemsAll">
                    <a href="{{ route("building.stats", ["type" => 'Huella de Carbono']) }}">
                       <li style="color: #31b0d5">@lang("Huella de Carbono")</li>
                    </a>
                   <a href="{{ route("building.stats", ["type" => 'Gas Natural']) }}">
                       <li style="color: #31b0d5">@lang("Gas Natural")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'GasoleoC']) }}">
                       <li style="color: #31b0d5">@lang("GasoleoC")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Fueloleo']) }}">
                       <li style="color: #31b0d5">@lang("Fueloleo")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Aire Acondicionado']) }}">
                       <li style="color: #31b0d5">@lang("Aire Acondicionado")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Electricidad']) }}">
                       <li style="color: #31b0d5">@lang("Electricidad")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Agua Potable']) }}">
                       <li style="color: #31b0d5">@lang("Agua Potable")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Papel y Carton']) }}">
                       <li style="color: #31b0d5">@lang("Papel y Carton")</li>
                   </a>

                 {{--
                     Para ofrecer estas dos gráficas hay que diferenciar en la tabla Study (modelo y migración(add)) los valores para
                     litrosConsumidos y kmRecorridos.
                     Flujo de ejecución: web.php -> BuildingController.php -> resources/views/building/stats.blade.php
                     Cambios a realizar sólo en stats.blade.php para añadir nombre del campo que falta. Resto ya preparado para responder a esta petición

                   <a href="{{ route("building.stats", ["type" => 'Combustion en Litros Consumidos']) }}">
                       <li style="color: #31b0d5">Combustión en Litros Consumidos</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Combustion en Kilometros Recorridos']) }}">
                       <li style="color: #31b0d5">Combustión en Kilómetros Recorridos</li>
                   </a>
                 --}}

               </ul>


               @foreach(Auth::user()->buildings as $building)
                <a href="#">
                    <li data-toggle="collapse" data-target="#elems{{ $building->name }}" class="collapsed">
                        {{ $building->name }}  <span class="arrow"></span>
                    </li>
                </a>
                <ul class="sub-menu collapse" id="elems{{ $building->name }}">
                   <a href="{{ route("building.stats", ["type" => 'Huella de Carbono',"id" => $building->id]) }}">
                       <li style="color: #31b0d5">@lang("Huella de Carbono")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Gas Natural', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">@lang("Gas Natural")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'GasoleoC', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">@lang("GasoleoC")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Fueloleo', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">@lang("Fueloleo")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Aire Acondicionado', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">@lang("Aire Acondicionado")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Electricidad', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">@lang("Electricidad")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Agua Potable', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">@lang("Agua Potable")</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Papel y Carton', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">@lang("Papel y Carton")</li>
                   </a>

                {{--
                     Para ofrecer estas dos gráficas hay que diferenciar en la tabla Study (modelo y migración(add)) los valores para
                     litrosConsumidos y kmRecorridos.
                     Flujo web.php -> BuildingController.php -> resources/views/building/stats.blade.php
                     Cambios a realizar sólo en stats.blade.php para añadir nombre del campo que falta. Resto ya preparado para responder a esta petición

                   <a href="{{ route("building.stats", ["type" => 'Combustion móvil en Litros Consumidos', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">Combustión en Litros Consumidos</li>
                   </a>
                   <a href="{{ route("building.stats", ["type" => 'Combustion en Kilometros Recorridos', "id" => $building->id]) }}">
                        <li style="color: #31b0d5">Combustión en Kilómetros Recorridos</li>
                   </a>
                 --}}

                </ul>
               @endforeach
           </ul>

        </ul>


        <ul class="menu-content bottom">
            <li>
                <a href="{{ route("user.tutorial") }}">
                    <i class="fa fa-question-circle"></i>
                    @lang("Tutorial")
                </a>
            </li>
            <li class="text-right pr-3" data-action="close-nav">
                @lang("Cerrar")
                <i class="fa fa-chevron-right"></i>
            </li>
        </ul>
    </div>
</nav>
