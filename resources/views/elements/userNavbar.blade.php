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
                    <i class="fa fa-user fa-lg"></i> Perfil
                </a>
            </li>


            <li data-toggle="collapse" data-target="#service" class="collapsed">
                <a href="{{ URL::route('building') }}"><i class="fa fa-globe fa-lg"></i> Edificios</a>
            </li>

            <li data-toggle="collapse" data-target="#stats" class="collapsed">
                <a href="#"><i class="fa fa-bar-chart fa-lg"></i>  Estadísticas <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="stats">
                <a href="{{ route("building.stats") }}">
                    <li>Todos los edificios</li>
                </a>
                @foreach(Auth::user()->buildings as $building)
                <a href="{{ route("building.stats", ["id" => $building->id]) }}">
                    <li>{{ $building->name }}</li>
                </a>
                @endforeach
            </ul>

        </ul>
        <ul class="menu-content bottom">
            <li>
                <a href="{{ route("user.tutorial") }}">
                    <i class="fa fa-question-circle"></i>
                    Tutorial
                </a>
            </li>
            <li class="text-right pr-3" data-action="close-nav">
                Cerrar
                <i class="fa fa-chevron-right"></i>
            </li>
        </ul>
    </div>
</nav>
