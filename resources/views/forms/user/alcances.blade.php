<div class="container-fluid mb-3">
    <form action="{{ route('alcances') }}" method="POST" class="huellaForm">
        {{ csrf_field() }}
        <div class="alcance">
            <h3 class="text-primary">Datos generales</h3>
            <hr>

            <div class="form-group row">
                <label for="year" class="col-form-label col-sm-4">Año </label>
                <div class="col-sm-8">
                    <div class="input-group">
                        @if(!$study->carbon_footprint)
                        <input type="hidden" name="year" value="{{ $study->year }}">
                        @endif

                        <input type="number" required {!! $study->year ? "readonly" : "id=\"year\" name=\"year\"" !!} class="form-control{{ !$study->year && $errors->has('year') ? ' is-invalid' : '' }}" value="{{ $study->year ? $study->year : old("year") }}" autofocus>
                        @if ($errors->has('year'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('year') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="alcance">
            <h3 class="text-primary">Alcance 1</h3>
            <hr>

            <div class="form-group row">
                <label for="a1_gas_natural_kwh" class="col-form-label col-sm-4" >Gas natural</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" required {!! $study->carbon_footprint ? "readonly" : "id=\"a1_gas_natural_kwh\" name=\"a1_gas_natural_kwh\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a1_gas_natural_kwh') ? ' is-invalid' : '' }}" value="{{ $study->a1_gas_natural_kwh ? $study->a1_gas_natural_kwh : old("a1_gas_natural_kwh")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">kWh</span>
                        </div>
                        @if ($errors->has('a1_gas_natural_kwh'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('a1_gas_natural_kwh') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

{{-- Por Sonia: Eliminado campo "Alcance1: Refrigerantes"
            <div class="form-group row">
                <label for="a1_refrigerantes" class="col-form-label col-sm-4">Refrigerantes</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" required {!! $study->carbon_footprint ? "readonly" : "id=\"a1_refrigerantes\" name=\"a1_refrigerantes\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a1_refrigerantes') ? ' is-invalid' : '' }}" value="{{ $study->a1_refrigerantes ? $study->a1_refrigerantes : old("a1_refrigerantes")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">kg</span>
                        </div>
                        @if ($errors->has('a1_refrigerantes'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('a1_refrigerantes') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
--}}
{{--Añadido por Sonia-> --}}
            <div class="form-group row">
                <label for="a1_gasoleoc" class="col-form-label col-sm-4">GasoleoC</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" required {!! $study->carbon_footprint ? "readonly" : "id=\"a1_gasoleoc\" name=\"a1_gasoleoc\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a1_gasoleoc') ? ' is-invalid' : '' }}" value="{{ $study->a1_gasoleoc ? $study->a1_gasoleoc : old("a1_gasoleoc")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">l</span>
                        </div>
                        @if ($errors->has('a1_gasoleoc'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('a1_gasoleoc') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="a1_fueloleo" class="col-form-label col-sm-4">Fueloleo</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" required {!! $study->carbon_footprint ? "readonly" : "id=\"a1_fueloleo\" name=\"a1_fueloleo\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a1_fueloleo') ? ' is-invalid' : '' }}" value="{{ $study->a1_fueloleo ? $study->a1_fueloleo : old("a1_fueloleo")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">l</span>
                        </div>
                        @if ($errors->has('a1_fueloleo'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('a1_fueloleo') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
{{-- <- --}}

            <div class="form-group row">
                <label for="a1_recarga_gases_refrigerantes" class="col-form-label col-sm-4">Recarga aire acondicionado</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" required {!! $study->carbon_footprint ? "readonly" : "id=\"a1_recarga_gases_refrigerantes\" name=\"a1_recarga_gases_refrigerantes\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a1_recarga_gases_refrigerantes') ? ' is-invalid' : '' }}" value="{{ $study->a1_recarga_gases_refrigerantes ? $study->a1_recarga_gases_refrigerantes : old("a1_recarga_gases_refrigerantes")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">kg</span>
                        </div>
                        @if ($errors->has('a1_recarga_gases_refrigerantes'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('a1_recarga_gases_refrigerantes') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="alcance">
            <h3 class="text-primary">Alcance 2</h3>
            <hr>

            <div class="form-group row" >
                <label for="a2_electricidad_kwh" class="col-form-label col-sm-4">Electricidad</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" required {!! $study->carbon_footprint ? "readonly" : "id=\"a2_electricidad_kwh\" name=\"a2_electricidad_kwh\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a2_electricidad_kwh') ? ' is-invalid' : '' }}" value="{{ $study->a2_electricidad_kwh ? $study->a2_electricidad_kwh : old("a2_electricidad_kwh")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">kWh</span>
                        </div>
                        @if ($errors->has('a2_electricidad_kwh'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('a2_electricidad_kwh') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="alcance">
            <h3 class="text-primary">Alcance 3</h3>
            <hr>

            <div class="form-group row" >
                <label for="a3_agua_potable_m3" class="col-form-label col-sm-4">Agua potable</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" {!! $study->carbon_footprint ? "readonly" : "id=\"a3_agua_potable_m3\" name=\"a3_agua_potable_m3\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a3_agua_potable_m3') ? ' is-invalid' : '' }}" value="{{ $study->a3_agua_potable_m3 ? $study->a3_agua_potable_m3 : old("a3_agua_potable_m3")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">m<sup>3</sup></span>
                        </div>
                        @if ($errors->has('a3_agua_potable_m3'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('a3_agua_potable_m3') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="a3_papel_carton_consumo_kg" class="col-form-label col-sm-4">Papel y cartón</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" {!! $study->carbon_footprint ? "readonly" : "id=\"a3_papel_carton_consumo_kg\" name=\"a3_papel_carton_consumo_kg\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a3_papel_carton_consumo_kg') ? ' is-invalid' : '' }}" value="{{ $study->a3_papel_carton_consumo_kg ? $study->a3_papel_carton_consumo_kg : old("a3_papel_carton_consumo_kg") }}">
                        <div class="input-group-append">
                            <span class="input-group-text">consumo en kg</span>
                        </div>
                        @if ($errors->has('a3_papel_carton_consumo_kg'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('a3_papel_carton_consumo_kg') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="a3_papel_carton_residuos_kg" class="col-form-label col-sm-4">Papel y cartón</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" {!! $study->carbon_footprint ? "readonly" : "id=\"a3_papel_carton_residuos_kg\" name=\"a3_papel_carton_residuos_kg\"" !!} class="form-control{{ !$study->carbon_footprint && $errors->has('a3_papel_carton_residuos_kg') ? ' is-invalid' : '' }}" value="{{ $study->a3_papel_carton_residuos_kg ? $study->a3_papel_carton_residuos_kg : old("a3_papel_carton_residuos_kg")}}">
                        <div class="input-group-append">
                            <span class="input-group-text">residuos en kg</span>
                        </div>
                        @if ($errors->has('a3_papel_carton_residuos_kg'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('a3_papel_carton_residuos_kg') }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
        @if (!$study->carbon_footprint)
            <input type="hidden" name="building_id" value="{{ $id }}">
            <input type="hidden" name="id" value="{{ $study->id }}">
            <input type="submit" name="submit" value="Guardar" class="btn btn-primary"/>
            <button type="submit" name="submit" value="calculateStudy" class="btn btn-primary">
                Calcular <i class="fa fa-paw" aria-hidden="true" aria-label="huella"></i> de Carbono
            </button>
        @endif
    </form>
</div>
