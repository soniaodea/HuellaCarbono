<form action="{{ route("building.add") }}" method="post" novalidate>
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" name="name" class="form-control{{ $errors->has("name") ? " is-invalid" : "" }}" autofocus value="{{ old("name") }}" placeholder="Nombre del edificio">
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <textarea name="description" rows="3" class="form-control{{ $errors->has("desciption") ? " is-invalid" : "" }}" placeholder="Descripción del centro (opcional)">{{ old("description") }}</textarea>
        @if ($errors->has('desciption'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('desciption') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <select name="country_id" class="form-control{{ $errors->has("country_id") ? " is-invalid" : "" }}" placeholder="Descripción del edificio">
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
        <select name="region_id" class="form-control{{ $errors->has("region_id") ? " is-invalid" : "" }}" placeholder="Descripción del edificio">
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
        <input type="number" name="postcode" class="form-control{{ $errors->has("postcode") ? " is-invalid" : "" }}" value="{{ old("postcode") }}" placeholder="Introduce código postal">
        @if ($errors->has('postcode'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('postcode') }}</strong>
            </div>
        @endif
    </div>

    <div class="form-group">
        <input type="text" name="address" class="form-control{{ $errors->has("address") ? " is-invalid" : "" }}" value="{{ old("address") }}" placeholder="Calle y número">
        @if ($errors->has('address'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('address') }}</strong>
            </div>
        @endif
    </div>

    <style media="screen">
        input[name="updateCoords"]not(:checked) + .locateOnMap {
            display: none;
        }
    </style>

    <div class="form-check">
        <input type="hidden" name="latitude" id="createLatitude">
        <input type="hidden" name="longitude" id="createLongitude">

        <div id="createMap" style="min-height: 50vh;"></div>
    </div>

    <button type="submit" class="btn btn-default topp">
        <div class="fa fa-pencil"></div>
        Guardar Cambios
    </button>

</form>
