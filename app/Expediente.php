<?php

namespace App;
use Datetime;

use Illuminate\Database\Eloquent\Model;
class Expediente extends Model
{
    //
    protected $connection = 'mysql2';
    protected $table = 'EXPEDIEN';
    protected $primaryKey  = 'registro';

    public function getAsunto(){

        return $this->hasOne("App\Asunto",'codigo','asunto');
    }

     public function getPases(){
        return $this->hasMany("App\Pase",'numero','numero');
    }

    public function hash(){
        ///expediento to integer
        $hash = str_replace("-","",$this->numero);
        ///integer to base 36
        $hash = strtoupper(base_convert($hash,10,36));
        return $hash;
    }

    /**
     * hace cuanto volvio de rectorado?
     */

     public function since($codigo_departamento){
         $since = 0;
         $_pase = "";
         foreach ($this->getPases as $pase)
         {
            if($pase->codigo_destino == $codigo_departamento)
            {
                $_pase = $pase;
                // $pase->fecha_salida - hoy
                // $fecha = strtotime($pase->fecha_salida);
                $fecha = new DateTime(($pase->fecha_salida));
                $hoy = new DateTime();
                $interval = date_diff($fecha, $hoy);
                $since =  $interval->format("%a");
                return [$since,$pase];
            }
         }
         return [$since,$pase];


     }



}
