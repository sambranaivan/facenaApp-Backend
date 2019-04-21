<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pase;
use App\Configuracion;
use DB;
class PaseController extends Controller
{
    //
    ////pases en rectorado pendientes de envio
    public function pasesEnRecotrado()
    {
        $c = Configuracion::first();

        $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                            and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino = 983
                                                        order by registro desc
                                                        limit 0,100
                                                        ');


        $pases = Pase::hydrate($results);
    }

    /**
     * Pases que rectorado envió
     * pero no se tomaron todavia
     * fecha ingreso != 0000
     * fecha saldio == 00000
     * el destino seria el receptor que esta esperando el pase
     * ultimo destino es rectorado
     */
    public function desdeRectorado()
    {
        $c = Configuracion::first();
        $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha_ingreso) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso not like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                          and fecha like "%'.$c->filtrofecha.'%"
                                                        and ultimo_destino = 983
                                                        order by registro desc
                                                        limit 0,100
                                                        ');


        $pases = Pase::hydrate($results);

        return view('desdeRectorado')->with('pases',$pases);
    }


}
