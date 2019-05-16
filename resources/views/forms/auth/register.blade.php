<form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
    {{ csrf_field() }}

    <div class="form-group">
        <label for="name" class="col-control-label"> @lang("Nombre de la organización") </label>

        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </div>
        @endif
    </div>

    <div class="form-group">
        <label for="email" class="col-control-label">@lang("E-mail")</label>

        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </div>
        @endif
    </div>

    <div class="form-group">
        <label for="password" class="col-control-label">@lang("Contraseña")</label>

        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </div>
        @endif
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-control-label">@lang("Confirmar contraseña")</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="form-check">
        <label id="terms" class="form-check-label">
            <input  type="checkbox" name="terms" value="true" @if(old("terms")){{ 'checked' }}@endif>
                @lang("He leído y acepto los") <a href="{{ route("termsOfService") }}" target="_blank"> @lang("Términos de servicio") </a>
        </label>

        @if ($errors->has('terms'))
        <div class="d-block invalid-feedback">
            <strong>{{ $errors->first('terms') }}</strong>
        </div>
        @endif
    </div>

    <br/>
    
    <button type="submit" class="btn btn-primary">
        @lang("Registrarse")
    </button>
</form>
