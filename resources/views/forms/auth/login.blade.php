<form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
    {{ csrf_field() }}

    <div class="form-group">
        <label for="email" class="col-control-label"> @lang("E-Mail") </label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="password" class="col-control-label"> @lang("Contraseña") </label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

        @if ($errors->has('password'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="remember">
                @lang("Mantener sesión iniciada")
            </label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            @lang("Iniciar Sesión")
        </button>
    </div>

    <div class="form-group">
        <p>
           @lang("¿Se te ha olvidado la contraseña?") </br>
           <a href="password/reset"> @lang("Recuperar contraseña") </a>
        </p>
    </div>

</form>
