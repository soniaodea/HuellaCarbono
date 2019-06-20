<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Building;
use App\Models\Study;
use App\Models\User;

class StudiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function alcancesView($id)
    {
        return view('user.alcances', ['id' => $id, 'studies' => Building::find($id)->studies()->whereNotNull('carbon_footprint')->orderBy('year', 'asc')->get(), 'action' => 'view']);
    }

    public function alcancesCreate($id)
    {
        return view('user.alcances', ['id' => $id, 'studies' => Building::find($id)->studies()->whereNull('carbon_footprint')->orderBy('year', 'asc')->get(), 'action' => 'create']);
    }

    public function alcances(Request $request)
    {

        $validator = $this::alcancesValidator($request->all());
        if ($validator->fails()) {
            $validator->errors()->add('inputYear', $request->year);

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $kmRecorridos = false;
        if ($request->combustionType == 'kilometros_recorridos') {
            $kmRecorridos = true;
        }
        $alcances = Study::updateOrCreate([
             'building_id' => $request->building_id,
             'year' => $request->year,
         ], [
             'numperson' => $request->numperson,
             'hours' => $request->hours,
             'a1_gas_natural_kwh' => $request->a1_gas_natural_kwh,
             //Realizamos la conversión de kwh a nm3 (a 1nm3 le corresponde 11.7kwh) para aplicar posteriormente a nm3 el factor en el cálculo de la huella
             'a1_gas_natural_nm3' => ($request->a1_gas_natural_kwh/11.7),
             //'a1_refrigerantes' => $request->a1_refrigerantes,
             'a1_gasoleoc' => $request->a1_gasoleoc,
             'a1_fueloleo' => $request->a1_fueloleo,
             'a1_recarga_gases_refrigerantes' => $request->a1_recarga_gases_refrigerantes, //TODO Sonia: Cambiar nombre a recarga aire acondicionado
             'a2_electricidad_kwh' => $request->a2_electricidad_kwh,
             'a3_agua_potable_m3' => $request->a3_agua_potable_m3,
             //'a3_papel_carton_consumo_kg' => $request->a3_papel_carton_consumo_kg,
             'a3_papel_carton_residuos_kg' => $request->a3_papel_carton_residuos_kg,
             'a3_combustionMovil' => $request->a3_combustionMovil,
             'a3_combustionMovilKmRecorridos' => $kmRecorridos,
            //'a3_factor_kwh_nm3' => 4,
         ]);

        $value = $this->calculateStudy($alcances);
//error_log("valor calculado" + $value);
        if ('calculateStudy' == $request->input('submit')) {
            if ($value == 0) {
                $alcances->carbon_footprint = "0.00";
                $alcances->carbon_footprintnumperson = "0.00";
                $alcances->carbon_footprinthours = "0.00";
            } else {
                $alcances->carbon_footprint = $value;
                if ($request->numperson > 0) {
                    $alcances->carbon_footprintnumperson = round($value / $request->numperson, 2);
                }
                if ($request->hours > 0) {
                    $alcances->carbon_footprinthours = round($value / $request->hours,2);
                }
            }
            $alcances->save();
            return redirect(route('alcancesView', ['id' => $request->building_id]))->with(['showYear' => $request->year]);
        } else { //Guardar borrador
            $alcances->temporal_footprint = $value;
            if ($request->numperson > 0) {
                $alcances->temporal_footprintnumperson = round($value / $request->numperson, 2);
            }
            if ($request->hours > 0) {
                $alcances->temporal_footprinthours = round($value / $request->hours,2);
            }
            $alcances->save();
            return redirect(route('alcancesCreate', ['id' => $request->building_id]))->with(['showYear' => $request->year]);
        }
    }

    protected function alcancesValidator(array $data)
    {
        $validator = Validator::make($data, [
             'building_id' => 'required',
             'year' => [
                 'required',
                 'numeric',
                 'min:'.(date('Y') - 20),
                 'max:'.date('Y'),
             ],
             'numperson' => 'required|numeric',
             'hours' => 'required|numeric',
             //'a1_gas_natural_kwh' => 'nullable|numeric',
             'a1_gas_natural_kwh' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             'a1_gasoleoc' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             'a1_fueloleo' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             'a1_recarga_gases_refrigerantes' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             'a2_electricidad_kwh' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             'a3_agua_potable_m3' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
             //'a3_papel_carton_consumo_kg' => 'nullable|numeric',
             'a3_papel_carton_residuos_kg' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'a3_combustionMovil' => 'nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
         ]);

/*
        $validator = Validator::make($data, [
            'building_id' => 'required',
            'year' => [
                'required',
                'numeric',
                'min:'.(date('Y') - 20),
                'max:'.date('Y'),
            ],
            'a1_gas_natural_kwh' => 'required_unless:a1_gasoleoc,filled,a1_fueloleo,filled|numeric',
            'a1_gasoleoc' => 'required_unless:a1_gas_natural_kwh,filled,a1_fueloleo,filled|numeric',
            'a1_fueloleo' => 'required_unless:a1_gas_natural_kwh,filled,a1_gasoleoc,filled|numeric',
            'a1_recarga_gases_refrigerantes' => 'required|numeric',
            'a2_electricidad_kwh' => 'required|numeric',
            'a3_agua_potable_m3' => 'nullable|numeric',
            'a3_papel_carton_consumo_kg' => 'nullable|numeric',
            'a3_papel_carton_residuos_kg' => 'nullable|numeric',
        ]);
*/
        // validate year field (create)
        $validator->sometimes('year', Rule::unique('studies')->where('building_id', $data['building_id']), function ($input) {
            return empty($input->id);
        });
        // validate year field (update)
        $validator->sometimes('year', Rule::unique('studies')->where('building_id', $data['building_id'])->ignore($data['id'], 'id'), function ($input) {
            return !empty($input->id);
        });

        return $validator;
    }

    /**
     * Calculo huella.
     */
    protected function calculateStudy(Study $study)
    {
        $formula =
            //$study->a1_gas_natural_kwh +
            (($study->a1_gas_natural_nm3 * 210) / 100000)
            + (($study->a1_gasoleoc * 285) / 100000)
            + (($study->a1_fueloleo * 239) / 100000)
            + $study->a1_recarga_gases_refrigerantes
            + (($study->a2_electricidad_kwh * 36) /100000)
            + (($study->a3_agua_potable_m3 * 344) /100000)
            //+ (($study->a3_papel_carton_consumo_kg))
            + (($study->a3_papel_carton_residuos_kg * 21) /100000);

        if ($study->a3_combustionMovilKmRecorridos) {
            $formula += (($study->a3_combustionMovil * 20) /100000);
        }
        else { //Litros de gasolina consumida
            $formula += (($study->a3_combustionMovil * 257) /100000);
        }

        return round($formula,2);
    }
}
