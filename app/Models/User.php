<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterConfirmation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nif', 'telephone', 'email', 'year', 'password', 'email_code', 'verified', 'publicViewable',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verify()
    {
        $this->verified = true;
        $this->email_code = null;

        $this->save();
    }

    public function sendVerifyEmail()
    {
        Mail::to($this->email)->send(new RegisterConfirmation($this));
    }

    /**
     * Buildings.
     */
    public function buildings()
    {
        return $this->hasMany('App\Models\Building');
    }

    /**
     * Api token.
     */
    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}
