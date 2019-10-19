<?php

namespace App;
use Datetime;
use Auth;
use App\seguimiento;
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

     public function getEstado(){
         $ultimo_pase = $this->getPases->last();
         $destino = $ultimo_pase->codigo_destino; ///pregunto si es distion a rectorado ahi aviso que volvio
            if($destino !== 983)
            {
                return "regreso";
            }
         $fecha_ingreso = $ultimo_pase->fecha_ingreso;
         $fecha_salida = $ultimo_pase->fecha_salida;
            if($fecha_ingreso == "0000-00-00" && $fecha_salida == "0000-00-00")
                {return "no-recibido";}
            else if($fecha_ingreso !== "0000-00-00" && $fecha_salida == "0000-00-00")
                {return "recibido";}
            else if($fecha_ingreso !== "0000-00-00" && $fecha_salida !== "0000-00-00")
                {return "tratandose";}

     }
      public function getConsejo(){
         $ultimo_pase = $this->getPases->last();
         $destino = $ultimo_pase->codigo_destino; ///pregunto si es distion a rectorado ahi aviso que volvio
            if($destino !== 916)
            {
                return "regreso";
            }
         $fecha_ingreso = $ultimo_pase->fecha_ingreso;
         $fecha_salida = $ultimo_pase->fecha_salida;
            if($fecha_ingreso == "0000-00-00" && $fecha_salida == "0000-00-00")
                {return "no-recibido";}
            else if($fecha_ingreso !== "0000-00-00" && $fecha_salida == "0000-00-00")
                {return "recibido";}
            else if($fecha_ingreso !== "0000-00-00" && $fecha_salida !== "0000-00-00")
                {return "tratandose";}

     }

     public function seguimientos(){
         return $this->hasMany("App\seguimiento",'expediente','numero');
     }

     public function seguido(){
         $seguimientos = $this->seguimientos;
         $ret = false;
        foreach ($seguimientos as $key => $value)
        {
            if($value->user_id == Auth::user()->id)
            {
                $ret = true;
            }
        }

        return $ret;


     }

     public function agregados(){

        return $this->hasMany("App\adjunto",'numero','numero');

     }


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
