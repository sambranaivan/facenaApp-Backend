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

}
