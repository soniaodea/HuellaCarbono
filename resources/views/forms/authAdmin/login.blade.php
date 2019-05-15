<form class="form-horizontal" method="POST" action="{{ route('admin.login.submit') }}" novalidate>
    {{ csrf_field() }}

    <div class="form-group">
        <label for="code" class="control-label">@lang("Código")</label>

        <input id="code" type="code" class="form-control{{ ($errors->has('code') || isset($invalidCredentials)) ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required autofocus>

        @if ($errors->has('code'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('code') }}</strong>
            </div>
        @elseif(isset($invalidCredentials))
            <div class="invalid-feedback">
                <strong>{{ $invalidCredentials }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="password" class="control-label">@lang("Contraseña")</label>

        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang("Mantener sesión iniciada")
            <small class="form-text text-muted">
                @lang("Marcando la siguiente casilla la sesión será conservada hasta que cierres la sesión manualmente")
            </small>
        </label>
    </div>

    <button type="submit" class="btn btn-primary">
        @lang("Iniciar Sesión")
    </button>
</form>
