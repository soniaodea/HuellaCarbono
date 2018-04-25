<form action="{{ route("admin.mail.reply", ["id" => 0]) }}" method="post" novalidate data-action-url="{{ route("admin.mail.reply", ["id" => "id"])}}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="for" class="control-label">Para</label>

        <input type="email" name="for" id="for" class="form-control{{ $errors->has("for") ? " is-invalid" : "" }}" value="{{ old("for") }}" readonly>
        @if ($errors->has('for'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('for') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="subject" class="control-label">Asunto</label>

        <input type="text" name="subject" id="subject" class="form-control{{ $errors->has("subject") ? " is-invalid" : "" }}" value="{{ old("subject") }}" readonly>
        @if ($errors->has('subject'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('subject') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="reply" class="control-label">Mensaje</label>

        <textarea name="reply" id="reply" rows="3" class="form-control{{ $errors->has("reply") ? " is-invalid" : "" }}" autofocus value="{{ old("reply") }}"></textarea>
        @if ($errors->has('reply'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('reply') }}</strong>
            </div>
        @endif
        <p id="message">asd</p>
    </div>

    <button type="submit" class="btn btn-default">
        <div class="fa fa-envelope-o"></div>
        Enviar
    </button>

</form>

@if(Request::session()->get("replyStatus"))
<script type="text/javascript">
    $(function() {
        @switch(Request::session()->get("replyStatus"))
            @case("sent")
                swal({
                    title: "Respuesta enviada",
                    icon: "success",
                });
                @break

            @case("failed")
                $("#replyUserModal").modal("show");
                @break;
        @endswitch
    });
</script>
@endif
