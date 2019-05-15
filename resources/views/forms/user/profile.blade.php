<form action="{{ route('user.profile') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="name" class="col-form-label col-sm-4" >@lang("Nombre")</label>
        <div class="col-sm-8">
            <input id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ (old('name')) ? old('name') : Auth::user()->name }}">

            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="nif" class="col-form-label col-sm-4" >@lang("DNI")</label>
        <div class="col-sm-8">
            <input id="nif" name="nif" class="form-control{{ $errors->has('nif') ? ' is-invalid' : '' }}" value="{{ (old('nif')) ? old('nif') : Auth::user()->nif }}" autocomplete="off">

            @if ($errors->has('nif'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nif') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="telephone" class="col-form-label col-sm-4" >@lang("Teléfono")</label>
        <div class="col-sm-8">
            <input id="telephone" name="telephone" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" value="{{ (old('telephone')) ? old('telephone') : Auth::user()->telephone }}">

            @if ($errors->has('telephone'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('telephone') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-form-label col-sm-4" >@lang("E-mail")</label>
        <div class="col-sm-8">
            <input id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ (old('email')) ? old('email') : Auth::user()->email }}">

            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="publicViewable" class="col-form-label col-sm-4" >@lang("Tipo de cuenta")</label>
        <div class="col-sm-8">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="publicViewable" id="publicViewableTrue" value="1"{{ (old("publicViewable") && old("publicViewable") === 1) ? " checked" : (Auth::user()->publicViewable === 1) ? " checked" : "" }}>
                <label class="form-check-label" for="publicViewableTrue">
                    @lang("Público")
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="publicViewable" id="publicViewableFalse" value="0"{{ (old("publicViewable") && old("publicViewable") == 0) ? " checked" : (Auth::user()->publicViewable === 0) ? " checked" : "" }}>
                <label class="form-check-label" for="publicViewableFalse">
                    @lang("Privado")
                </label>
            </div>

            @if ($errors->has('publicViewable'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('publicViewable') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary topButtonProfile">
        @lang("Guardar Cambios")
    </button>
    <a href="{{ route("user.profile.changePassword") }}" class="btn btn-default topButtonProfilePass">
        <i class="fa fa-key"></i>
        @lang("Cambiar contraseña")
    </a>
</form>
