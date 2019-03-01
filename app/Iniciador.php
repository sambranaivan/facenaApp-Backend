<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iniciador extends Model
{
    //
    protected $connection = 'mysql2';
    protected $table = 'det_iniciador';
    protected $primaryKey  = 'registro';


    public function getPases(){
        return $this->hasMany('App\Pase','codigo_destino','registro');
    }
}
