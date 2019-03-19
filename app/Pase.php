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
     public function getDestino(){
        return $this->hasOne('App\Departamento','codigo','codigo_destino');
    }
     public function origen(){
        return $this->hasOne('App\Departamento','codigo','ultimo_destino');
    }

    public function getExpediente(){
        return $this->hasOne('App\Expediente','numero','numero');
    }








}
