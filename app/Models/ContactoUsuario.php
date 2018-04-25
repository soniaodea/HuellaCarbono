<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoUsuario extends Model
{
    protected $table = 'contactoUsuarios';
    public $timestamps = false;
    protected $fillable = [
        'email', 'subject', 'message',
    ];
}
