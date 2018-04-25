<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoAlcance extends Model
{
    protected $table = 'resultado_alcances';
    protected $fillable = ['calculo_huella'];

    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }
}
