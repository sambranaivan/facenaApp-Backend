<?php

namespace App;

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

}
