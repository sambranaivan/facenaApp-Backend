<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class costo extends Model
{
    //
    protected $connection = 'mysql3';
    protected $table = 'costo';
    protected $primaryKey  = 'id';


    public function antiguedad(){
        return $this->belongsTo('App\antiguedad');
    }
    public function cargo()
    {
        return $this->belongsTo('App\cargo' );
    }


}
