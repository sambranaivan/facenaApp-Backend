<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hash extends Model
{
    //
    public function expediente(){
        return $this->belongsTo('App\Expediente','numero','numero');
    }
}
