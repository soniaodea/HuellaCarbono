<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $table = 'studies';
    protected $fillable = [
        'building_id',
        'year',
        'carbon_footprint',
        'temporal_footprint',
        'a1_gas_natural_kwh',
        'a1_gas_natural_nm3',
        'a1_gasoleoc',
        'a1_fueloleo',
        'a1_recarga_gases_refrigerantes',
        'a2_electricidad_kwh',
        'a3_agua_potable_m3',
        'a3_papel_carton_consumo_kg', //Ya no se ofrece, se podría eliminar y volver a migrar la bd
        'a3_papel_carton_residuos_kg',
        'a3_combustionMovil',             //numeric
        'a3_combustionMovilKmRecorridos', //Boolean

    ];
    protected $attributes = [
        'a3_combustionMovilKmRecorridos'=>true, //default value
        'a2_electricidad_kwh'=>0, //default value
    ];
    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }
}
