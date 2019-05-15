<form action="{{ route("user.profile.changePassword") }}" method="POST">
    {{ csrf_field() }}

    <div class="form-group row">
        <label for="currentPassword" class="col-form-label col-sm-4" >@lang("Contraseña actual")</label>
        <div class="col-sm-8">
            <input type="password" id="currentPassword" name="currentPassword" class="form-control{{ $errors->has('currentPassword') ? ' is-invalid' : '' }}" autofocus>

            @if ($errors->has('currentPassword'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('currentPassword') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="newPassword" class="col-form-label col-sm-4" >@lang("Nueva contraseña")</label>
        <div class="col-sm-8">
            <input type="password" id="newPassword" name="newPassword" class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}">

            @if ($errors->has('newPassword'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('newPassword') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="newPassword_confirmation" class="col-form-label col-sm-4" >@lang("Confirmar nueva contraseña")</label>
        <div class="col-sm-8">
            <input type="password" id="newPassword_confirmation" name="newPassword_confirmation" class="form-control{{ $errors->has('newPassword_confirmation') ? ' is-invalid' : '' }}">

            @if ($errors->has('newPassword_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('newPassword_confirmation') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fa fa-key"></i>
        @lang("Cambiar contraseña")
    </button>
</form>
