<form action="{{ route("building.edit") }}" method="post" novalidate>
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id">

    <div class="form-group">
        <input type="text" name="name" id="name" class="form-control{{ $errors->has("name") ? " is-invalid" : "" }}" autofocus value="{{ old("name") }}" placeholder=@lang("Nombre")>
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-grou">
        <div class="input-group">
            <input type="number" name="surface" id="surface" class="form-control{{ $errors->has("surface") ? " is-invalid" : "" }}" autofocus value="{{ old("surface") }}" placeholder=@lang("Superficie")>
            <div class="input-group-append">
                <span class="input-group-text">@lang("m2")</span>
            </div>
            @if ($errors->has('surface'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('surface') }}</strong>
                </div>
            @endif
        </div>
    </div>


    <div class="form-group">
        <select name="country_id" id="country_id" class="form-control{{ $errors->has("country_id") ? " is-invalid" : "" }}" placeholder=@lang("Descripción")>
            <option disabled selected>@lang("--Selecciona un país--")</option>
            @foreach (App\Models\Country::all() as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('country_id'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('country_id') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <select name="region_id" id="region_id" class="form-control{{ $errors->has("region_id") ? " is-invalid" : "" }}" placeholder=@lang("Descripción")>
            <option disabled selected>@lang("--Selecciona una provincia--")</option>
            @foreach (App\Models\Region::where("country_id", $country->id)->get() as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('region_id'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('region_id') }}</strong>
            </div>
        @endif
    </div>



    <div class="form-group">
        <div class="alert alert-info">
            <i class="fa fa-info"></i>
            @lang("Nota: al seleccionar una nueva ubicación se actualizarán automáticamente los datos relacionados con la dirección del edificio.")
        </div>
        <input type="hidden" name="latitude" id="editLatitude">
        <input type="hidden" name="longitude" id="editLongitude">

        <div id="editMap" style="min-height: 50vh;"></div>
    </div>

    <button type="submit" class="btn btn-default topp">
        <div class="fa fa-pencil"></div>
        @lang("Guardar Cambios")
    </button>

</form>
