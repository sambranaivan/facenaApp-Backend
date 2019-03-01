<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Asunto;
use App\Iniciador;
class Pase extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'EXP_PASE';
    protected $primaryKey  = 'registro';

    //

    public function asunto(){
        return $this->hasOne('App\Asunto','codigo','asunto_pase');
    }
     public function origen(){
        return $this->hasOne('App\Iniciador','registro','codigo_destino');
    }
     public function anterior(){
        return $this->hasOne('App\Iniciador','registro','ultimo_destino');
    }

    public function getExpediente(){
        return $this->hasOne('App\Expediente','numero','numero');
    }




}
