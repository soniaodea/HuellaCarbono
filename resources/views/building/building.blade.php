@extends("layouts.userHome")

@section("title", "Edificios")

@section("userContent")
    <div class="container">
        <h3>@lang("Lista de Edificios")</h3>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <td class="d-none">#</td>
                        <td>@lang("Nombre")</td>
                        <td>@lang("Superficie(m2)")</td>
                        <td class="d-none">@lang("País")</td>
                        <td>@lang("Provincia")</td>
                        <td class="d-none">@lang("Coordenadas (lat, lon)")</td>
                        <td>@lang("Acciones")</td>
                    </tr>
                </thead>
                <tbody>
                    @if($buildings->count() > 0)
                        @foreach($buildings as $building)
                        <tr class="text-center">
                            <td class="id d-none">{{ $building->id }}</td>
                            <td class="name">
                                @if (!empty($building->latitude))
                                    <i class="fa fa-map-pin" title=@lang("Edificio con ubicación establecida")></i>
                                @else
                                    <span class="fa-stack" title=@lang("Edificio sin ubicación establecida")>
                                        <i class="fa fa-map-pin fa-stack-1x"></i>
                                        <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                    </span>
                                @endif
                                {{ $building->name }}
                            </td>
                            <td class="surface" data-id="{{ $building->surface }}">{{ $building->surface }}</td>
                            <td class="country d-none" data-id="{{ $building->country_id }}">{{ $building->country->name }}</td>
                            <td class="region" data-id="{{ $building->region_id }}">{{ $building->region->name }}</td>
                            <td class="coordinates d-none" data-latitude="{{ $building->latitude}}" data-longitude="{{ $building->longitude }}"></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-secondary" href="{{ route('alcancesView', ['id' => $building->id]) }}" title=@lang("Visualizar estudios")>
                                        <fa class="fa fa-eye"></fa>
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('alcancesCreate', ['id' => $building->id]) }}" title=@lang("Gestionar alcances")>
                                        <fa class="fa fa-paw"></fa>
                                    </a>
                                    <button class="btn btn-info" data-action="edit" title=@lang("Editar edificio")>
                                        <fa class="fa fa-pencil"></fa>
                                    </button>
                                    <form class="d-none" action="{{ route("building.delete", ["id" => $building->id]) }}" method="post">
                                        {{ csrf_field() }}
                                    </form>
                                    <button class="btn btn-danger" data-action="delete" title=@lang("Eliminar edificio")>
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-info">
                                @lang("No has añadido ningún edificio")
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <button class="btn btn-default topForMobile" type="button" data-toggle="modal" data-target="#addBuildingModal">
            @lang("Añadir edificio")
            <i class="fa fa-plus"></i>
        </button>

        <div class="modal fade" tabindex="-1" role="dialog" id="addBuildingModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang("Añadir edificio")</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label=@lang("Cerrar")><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @include("forms.building.addBuilding")
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="editBuildingModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang("Editar edificio")</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label=@lang("Cerrar")><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @include("forms.building.editBuilding")
                    </div>
                </div>
            </div>
        </div>

        @if(Session::get("showModal"))
        <script type="text/javascript">
            $(function () {
                @switch (Session::get("showModal"))
                    @case("create")
                        $("#addBuildingModal").modal("show");
                        @break
                    @case("edit")
                        $("#editBuildingModal").modal("show");
                        @break
                @endswitch
            });
        </script>
        @endif

        @if (count(Auth::user()->buildings) == 0 || Request::session()->get("showTutorial") == true)
            @include("building.tutorial")
        @endif
    </div>

    <script src="assets/js/user/buildingManagement.js"></script>
@endsection
