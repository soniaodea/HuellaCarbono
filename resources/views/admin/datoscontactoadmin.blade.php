@extends("layouts.main")

@section("title", "Mensajes")

@section("content")
    <div class="container">
        <h3>Mensajes de usuarios</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
            <tr class="text-center">
                <td>#</td>
                <td>Email</td>
                <td>Asunto</td>
                <td>Mensaje</td>
                <td>Acciones</td>
            </tr>
            </thead>
            <tbody>
            @if($mails->count() > 0)
                @foreach($mails as $mails)
                    <tr>
                        <td class="id">
                            {{ $mails->id }}
                        </td>
                        <td class="for text-center">{{ $mails->email }}</td>
                        <td class="subject text-justify">{{ $mails->subject }}</td>
                        <td class="message text-justify">{{ $mails->message }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info" data-action="reply">
                                    <i class="fa fa-reply"></i>
                                </button>
                                <button class="btn btn-danger" data-action="delete" data-action="remove">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <form class="d-none deleteForm" action="{{ route("admin.mail.delete", ["id" => $mails->id]) }}" method="post">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
            <tr class="text-center text-info">
                <td colspan="5">
                    No se ha encontrado ningún correo
                </td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="replyMailModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Responder al email</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @include("forms.admin.replyMail")
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset("/assets/js/admin/mailManagement.js") }}" charset="utf-8"></script>
@endsection
