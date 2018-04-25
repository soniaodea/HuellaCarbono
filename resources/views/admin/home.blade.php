@extends("layouts.main")

@section("title", "Usuarios")

@section("content")
    <div class="container">
        <h3>Lista de usuarios</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <td>#</td>
                    <td>Nombre</td>
                    <td>NIF</td>
                    <td>Teléfono</td>
                    <td>Email</td>
                    <td>Estado de la cuenta</td>
                    <td>Visible para el público</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @if($users->count() > 0)
                    @foreach($users as $user)
                    <tr class="text-center">
                        <td class="id">{{ $user->id }}</td>
                        <td class="name">{{ $user->name }}</td>
                        <td class="nif">
                            @if(!empty($user->nif))
                                {{ $user->nif }}
                            @else
                            <span class="text-info">N/D</span>
                            @endif
                        </td>
                        <td class="telephone" data-phone="{{ (!empty($user->phone)) ? $user->telephone : '' }}">
                            @if(!empty($user->telephone))
                            <a href="tel:{{ $user->telephone }}">
                                <i class="fa fa-phone"></i>
                                ({{ $user->telephone }})
                            </a>
                            @else
                            <span class="text-info">N/D</span>
                            @endif
                        </td>
                            <td class="email" data-email="{{ $user->email }}">
                            <a href="mailto:{{ $user->email }}">
                                <i class="fa fa-envelope"></i>
                                ({{ $user->email }})
                            </a>
                        </td>
                        <td class="verified" data-verified="{{ $user->verified ? "1" : "0"}}">
                            @if($user->verified)
                            <span class="text-success">Verificada</span>
                            @else
                            <span class="text-danger">No verificada</span>
                            @endif
                        </td>
                        <td>
                            @if($user->publicViewable)
                            <span class="text-success">Si</span>
                            @else
                            <span class="text-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info" data-action="edit">
                                    <fa class="fa fa-pencil"></fa>
                                </button>
                                <button class="btn btn-danger" data-action="delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form class="d-none" action="{{ route("admin.user.delete", ["id" => $user->id]) }}" method="post">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center text-info">
                            No existe ningún usuario registrado
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="modal fade" tabindex="-1" role="dialog" id="editUserModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span   aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        @include("forms.admin.editUser")
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/admin/userManagement.js"></script>
@endsection
