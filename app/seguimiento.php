<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seguimiento extends Model
{

    /**
     * Primer ejecucion
     * Relleno la tabla de seguimientos con los
     * expedientes que pasaron por rectorado
     */
    public function populate()
    {
        /**
         * Busco los expedientes que esten en rectorado
         * y los guardo en la tabla de seguimientos
         */

    }
    public function seguimiento()
    {
        /**
         * escucho los cambios de la tabla pases
         */
    }
}
