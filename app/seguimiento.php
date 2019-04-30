<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seguimiento extends Model
{

     protected $connection = 'mysql';
    /**
     * Primer ejecucion
     * Relleno la tabla de seguimientos con los
     * expedientes que pasaron por rectorado
     */


    public function getExpediente(){
        return $this->hasOne('App\Expediente','numero','expediente');
    }

}
