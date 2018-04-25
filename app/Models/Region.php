<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $fillable = [
        'name',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function buildings()
    {
        return $this->hasMany('App\Models\Building');
    }
}
