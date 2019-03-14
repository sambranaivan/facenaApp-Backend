<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departamento;
use App\Pase;
use App\Configuracion;
use App\Expediente;
use DB;
class DepartamentoController extends Controller
{
    //
    /**
    * Pase pendientes para tomar por el departamento
    *con fecha de ingreso distinto de 0000
    *y fecha de salida igual  0000
    *codigo destino igual al departamento
     */
    public function pasePorTomar($departamento_id){

        $c = Configuracion::first();

        $departamento = Departamento::find($departamento_id);
        $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha_ingreso) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso not like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino ='.$departamento_id.'
                                                        order by registro desc
                                                        limit 0,100');
        $pases = Pase::hydrate($results);
        // TODO filtros temporales para noticiaciones


        return view('pasesPorTomar',(['pases'=>$pases,'departamento'=>$departamento]));
    }

    /**
    *Pases en departamento
    *con fecha de ingreso igual a 0000
    *y fecha de salida igual a 0000
    *codigo ultimo_destino igual al departamento
     */

     public function paseEnDepartamento($departamento_id){
           $c = Configuracion::first();

        $departamento = Departamento::find($departamento_id);
        $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha_ingreso) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                            and fecha like "%'.$c->filtrofecha.'%"
                                                        and ultimo_destino ='.$departamento_id.'

                                                        order by registro desc
                                                        limit 0,100
                                                        ');


        $pases = Pase::hydrate($results);
        // TODO filtros temporales para noticiaciones

        return view('paseEnDepartamento',(['pases'=>$pases,'departamento'=>$departamento]));
    }


    public function verDepartamentos(){
          $departamentos = Departamento::all();

          return view('departamentos')->with('departamentos',$departamentos);
    }


    public function rectorado(){
        $config = Configuracion::first();
        $rectorado_id = $config->rectorado_id;
        ///obtener pases que tengan algo que ver con rectorado
        $expedientes = DB::connection('mysql2')->select('SELECT e.* FROM EXPEDIEN e left JOIN EXP_PASE p on e.numero = p.numero
                    WHERE p.codigo_destino = 983  and p.fecha >= "2019-01-01" order by p.registro desc' );
//         SELECT e.* FROM expedien e left JOIN exp_pase p
// on e.numero = p.numero
// WHERE
// p.codigo_destino = 983
// and p.fecha >= "2019-01-01"
        $expedientes = Expediente::hydrate($expedientes);


        return view('rectorado')->with('expedientes',$expedientes);

    }


}
