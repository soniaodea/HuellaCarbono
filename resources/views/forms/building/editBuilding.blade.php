<form action="{{ route("building.edit") }}" method="post" novalidate>
    {{ csrf_field() }}
    <input type="hidden" name="id" id="id">
    <div class="form-group">
        <input type="text" name="name" id="name" class="form-control{{ $errors->has("name") ? " is-invalid" : "" }}" autofocus value="{{ old("name") }}" placeholder="Nombre del edificio">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <textarea name="description" id="description" rows="3" class="form-control{{ $errors->has("desciption") ? " is-invalid" : "" }}" placeholder="Descripción del centro (opcional)">{{ old("description") }}</textarea>
        @if ($errors->has('desciption'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('desciption') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <select name="country_id" id="country_id" class="form-control{{ $errors->has("country_id") ? " is-invalid" : "" }}" placeholder="Descripción del edificio">
            <option disabled selected>--Selecciona un pais--</option>
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
        <select name="region_id" id="region_id" class="form-control{{ $errors->has("region_id") ? " is-invalid" : "" }}" placeholder="Descripción del edificio">
            <option disabled selected>--Selecciona una provincia--</option>
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
        <input type="number" id="postcode" name="postcode" class="form-control{{ $errors->has("postcode") ? " is-invalid" : "" }}" value="{{ old("postcode") }}" placeholder="Introduce código postal">
        @if ($errors->has('postcode'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('postcode') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <input type="text" name="address" id="address" class="form-control{{ $errors->has("address") ? " is-invalid" : "" }}" value="{{ old("address") }}" placeholder="Calle y número">
        @if ($errors->has('address'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('address') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <div class="alert alert-info">
            <i class="fa fa-info"></i>
            Nota: al seleccionar una nueva ubicación se actualizarán automáticamente los datos relacionados con la dirección del edificio.
        </div>
        <input type="hidden" name="latitude" id="editLatitude">
        <input type="hidden" name="longitude" id="editLongitude">

        <div id="editMap" style="min-height: 50vh;"></div>
    </div>

    <button type="submit" class="btn btn-default topp">
        <div class="fa fa-pencil"></div>
        Guardar Cambios
    </button>

</form>
