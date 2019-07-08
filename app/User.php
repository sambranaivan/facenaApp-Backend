<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\permiso;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permiso(){
            return $this->hasOne('App\permiso');
    }

    public function crearPermiso()
    {
        if(is_null(($this->permiso)))
        {
            $p = new permiso();
            $p->user_id = $this->id;
            $p->save();
        }
    }

    public function followed(){
        return $this->hasMany("App\seguimiento");

    }

}
