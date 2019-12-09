<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cargo extends Model
{
    //
    protected $connection = 'mysql3';
    protected $table = 'cargos';
    protected $primaryKey  = 'id';

}
