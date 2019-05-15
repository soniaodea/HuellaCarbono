@if(session()->get("isContactValid") === true)
    <div class="alert alert-success print-success-msg">
        @lang("Tu mensaje se ha enviado correctamente.")
    </div>
@endif

<div class="alert alert-danger print-error-msg" style="display:none">
    <ul></ul>
</div>

<form id="contactForm" action="{{ route('contact') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email">@lang("E-mail:")</label>
        <input id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old("email") ? old("email") : !Auth::user() ? "" : Auth::user()->email }}">

        @if ($errors->has('email'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="subject">@lang("Asunto:")</label>
        <input id="subject" name="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" value="{{ old("subject") }}">

        @if ($errors->has('subject'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('subject') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="message">@lang("Mensaje:")</label>
        <textarea id="message" name="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" placeholder=@lang("Escribe tu mensaje aqui...")>{{ old("message") }}</textarea>
        @if ($errors->has('message'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('message') }}</strong>
            </div>
        @endif
    </div>

    <button id="btn-submit" type="submit" class="btn btn-primary">
        <i class="fa fa-send"></i>
        @lang("Enviar mensaje")
    </button>
</form>
