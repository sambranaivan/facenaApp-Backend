<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agregado extends Model
{
    //
    protected $connection = 'mysql2';
    protected $table = 'exp_agre';
    protected $primaryKey  = 'numero';
}
