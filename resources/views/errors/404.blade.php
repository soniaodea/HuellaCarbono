@extends("layouts.main")

@section("title", __("Página no encontrada"))

@section("content")
    <div class="container d-flex justify-content-center align-items-center error">

        <div>
            <section class="error-container">
                <span class="four"><h1 class="sr-only">4</h1></span>
                <span class="zero"><h1 class="sr-only">0</h1></span>
                <span class="four"><h1 class="sr-only">4</h1></span>
            </section>

            <h2 class="text-center">
                @lang("La página solicitada no ha sido encontrada")
            </h2>
            <p class="text-center">
                <a href="{{ route("landing") }}" class="btn btn-lg btn-outline-primary">
                    <i class="fa fa-home"></i>
                    @lang("Volver a inicio")
                </a>
            </p>
        </div>

    </div>
@endsection
