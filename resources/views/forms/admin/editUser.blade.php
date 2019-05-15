<form action="{{ route("admin.user.edit") }}" method="post" novalidate>
    {{ csrf_field() }}

    <input type="hidden" name="id" id="id" value="{{ old("id") }}">

    <div class="form-group">
        <label for="name" class="control-label">@lang("Nombre")</label>

        <input type="text" name="name" id="name" class="form-control{{ $errors->has("name") ? " is-invalid" : "" }}" autofocus value="{{ old("name") }}">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="nif" class="control-label">@lang("NIF")</label>

        <input type="text" name="nif" id="nif" class="form-control{{ $errors->has("nif") ? " is-invalid" : "" }}" value="{{ old("nif") }}">
        @if ($errors->has('nif'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('nif') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="telephone" class="control-label">@lang("Teléfono")</label>

        <input type="number" name="telephone" id="telephone" class="form-control{{ $errors->has("telephone") ? " is-invalid" : "" }}" value="{{ old("telephone") }}">
        @if ($errors->has('telephone'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('telephone') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="email" class="control-label">@lang("E-mail")</label>

        <input type="text" name="email" id="email" class="form-control{{ $errors->has("email") ? " is-invalid" : "" }}" value="{{ old("email") }}">
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-check form-check-inline">
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="verified" value="0" @if(old("verified") == false){{ "checked" }}@endif>
            @lang("No Verificada")
        </label>
    </div>
    <div class="form-check form-check-inline">
        <label class="form-check form-check-label">
            <input type="radio" name="verified" value="1" @if(old("verified") == true){{ "checked" }}@endif>
            @lang("Verificada")
        </label>
    </div>

    <button type="submit" class="btn btn-default">
        <div class="fa fa-pencil"></div>
        @lang("Guardar Cambios")
    </button>

</form>

@if(Request::session()->get("editFailed"))
<script type="text/javascript">
    $(function() {
        $("#editUserModal").modal("show");
    });
</script>
@endif
