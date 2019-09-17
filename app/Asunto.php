<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asunto extends Model
{
    //
    // un comentario

    protected $connection = 'mysql2';
    protected $table = 'TABLAS';
    protected $primaryKey  = 'codigo';
}
