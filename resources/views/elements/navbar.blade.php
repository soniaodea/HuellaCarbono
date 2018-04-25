<nav class="navbar navbar-expand-lg fixed-top navbar-dark @if(Request::url() == route("landing")){{ "bg-primary-alpha" }}@else{{ "bg-primary" }}@endif" id="mainNavbar">

    <a class="navbar-brand" href="{{ route("landing") }}">{{ config("app.name") }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav mr-auto">
                <li id="initial" class="nav-item">
                    @if(Request::url() == route("landing"))
                    <a class="nav-link" href="#inicio">
                        Inicio
                    </a>
                    @endif
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ Request::url() == route("landing") ? "" : route("landing") }}#queEs">
                        Que es la Huella de Carbono
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ Request::url() == route("landing") ? "" : route("landing") }}#comoFunciona">
                        Cómo funciona
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ Request::url() == route("landing") ? "" : route("landing") }}#centrosInvolucrados">
                        Centros involucrados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ Request::url() == route("landing") ? "" : route("landing") }}#contacto">
                        Contacto
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav navbar-right">
                @unless(Request::segment(1) == "admin")
                    @guest
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route("login") }}" data-toggle="modal" data-target="#loginModal">
                            <i class="fa fa-sign-in"></i>
                            Login
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route("register") }}" data-toggle="modal" data-target="#registerModal">
                            <i class="fa fa-user-plus"></i>
                            Registro
                        </a>
                    </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route("home") }}">
                                  <i class="fa fa-home" aria-hidden="true"></i>
                                  Home
                              </a>
                              <a class="dropdown-item" href="{{ route("logout") }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <i class="fa fa-sign-out"></i>
                                  Cerrar Sesion
                              </a>
                              <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display:none">
                                  {{ csrf_field() }}
                              </form>
                          </div>
                        </li>
                    @endauth
                @endunless

                @auth("admin")
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-unlock-alt"></i>
                        {{ Auth::guard("admin")->user()->code }}
                        <small>(admin)</small>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route("admin.home") }}">
                          <i class="fa fa-home"></i>
                          Dashboard
                      </a>
                      <a class="dropdown-item" href="{{ route("admin.mails.show") }}">
                          <i class="fa fa-envelope"></i>
                          Mensajes
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route("admin.logout") }}" onclick="event.preventDefault(); document.getElementById('adminlogout-form').submit();">
                          <i class="fa fa-sign-out"></i>
                          Cerrar Sesión
                      </a>
                      <form id="adminlogout-form" action="{{ route("admin.logout") }}" method="POST" style="display:none">
                          {{ csrf_field() }}
                      </form>
                  </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>

</nav>
