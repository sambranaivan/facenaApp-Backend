<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departamento;
use App\Pase;
use App\Configuracion;
use App\ignored;
use App\Expediente;
use Auth;
use DB;
class DepartamentoController extends Controller
{


    /**
     * fecha_ingreso|  fecha_salida
     *  0000-00-00      0000-00-00   ||| No lo tomó en espera
     *  XXXX-XX-XX      0000-00-00   ||| En Departamento
     *  XXXX-XX-XX      XXXX-XX-XX   ||| Ya paso a otro dpto
     *  0000-00-00      XXXX-XX-XX   ||| Inicio de Pase
    */



    /**
     * Por tomar = 00
     */
    public function pasePorTomar($departamento_id){

        $c = Configuracion::first();

        $departamento = Departamento::find($departamento_id);
        $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino ='.$departamento_id.'
                                                        order by registro desc
                                                        limit 0,100');
        $pases = Pase::hydrate($results);



        return view('pasesPorTomar',(['pases'=>$pases,'departamento'=>$departamento]));
    }

    /**
    *Pases en departamento = XO
    *codigo destino igual al departamento
     */

     public function paseEnDepartamento($departamento_id){
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
                                                        ');
        $pases = Pase::hydrate($results);
        return view('paseEnDepartamento',(['pases'=>$pases,'departamento'=>$departamento]));
    }
    public function paseEnDepartamentoFilter(request $request)
    {
        $c = Configuracion::first();
        $departamento = Departamento::find($request->departamento_id);
        // print_r($request->desde);
        $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha_ingreso) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso not like "%0000-00-00%"
                                                        and fecha_ingreso <= "'.$request->hasta.'"
                                                        and fecha_ingreso >= "'.$request->desde.'"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%' . $c->filtrofecha . '%"
                                                        and codigo_destino =' . $departamento->codigo . '
                                                        order by registro desc
                                                        ');
        // print_r('SELECT *,
        //                                             DATEDIFF(NOW(),fecha_ingreso) as diff
        //                                             FROM `EXP_PASE`
        //                                                 where fecha_ingreso not like "%0000-00-00%"
        //                                                 and fecha_ingreso <= "' . $request->hasta . '"
        //                                                 and fecha_ingreso >= "' . $request->desde . '"
        //                                                 and fecha_salida like "%0000-00-00%"
        //                                                 and fecha like "%' . $c->filtrofecha . '%"
        //                                                 and codigo_destino =' . $departamento->codigo . '
        //                                                 order by registro desc
        //                                                 ');

        $pases = Pase::hydrate($results);
        // print_r($pases);
        return view('paseEnDepartamento', (['pases' => $pases, 'departamento' => $departamento, 'desde'=>$request->desde, 'hasta'=>$request->hasta]));
    }


    public function verDepartamentos(){
          $departamentos = Departamento::all();

          return view('departamentos')->with('departamentos',$departamentos);
    }


    public function rectorado(){
        $config = Configuracion::first();
        $ignored = ignored::where("user_id",Auth::user()->id)->get();
        $ignored_list = "";
        foreach ($ignored as $key => $value)
        {
            $ignored_list .="'$value->numero'".",";
        }
        $ignored_list .="'0'";
        // obtengo string para la consulta


        $rectorado_id = $config->rectorado_id;
                //
        // $last_week = \date('Y-m-d',(strtotime ( '-7 day' , strtotime ( now()) ) ));;
        // echo $hoy;
        $last_week = "2019-01-01";

        ///obtener pases que tengan algo que ver con rectorado
        $expedientes = DB::connection('mysql2')->select('SELECT e.*, DATEDIFF(NOW(),p.fecha) as diff FROM EXPEDIEN e
        left JOIN EXP_PASE p on e.numero = p.numero
        WHERE p.codigo_destino = 983  and p.fecha >= "'.$last_week.'" and e.numero not in('.$ignored_list.') order by p.registro desc' );

//TODO API avisar si diff > N si last()->codigo_destino sigue siendo 983
        $expedientes = Expediente::hydrate($expedientes);
        // separar lo que siguen y los que no
        $followed = Auth::user()->followed;
        return view('rectorado')->with('expedientes',$expedientes)->with('followed',$followed);

    }

    public function ocultos()
    {
        //
        $config = Configuracion::first();
        $ignored = ignored::where("user_id",Auth::user()->id)->get();
        $ignored_list = "";
        foreach ($ignored as $key => $value)
        {
            $ignored_list .="'$value->numero'".",";
        }
        $ignored_list .="'0'";
        // obtengo string para la consulta


        $rectorado_id = $config->rectorado_id;
                //
        // $last_week = \date('Y-m-d',(strtotime ( '-7 day' , strtotime ( now()) ) ));;
        // echo $hoy;
        $last_week = "2019-01-01";

        ///obtener pases que tengan algo que ver con rectorado
        $expedientes = DB::connection('mysql2')->select('SELECT e.*, DATEDIFF(NOW(),p.fecha) as diff FROM EXPEDIEN e
        left JOIN EXP_PASE p on e.numero = p.numero
        WHERE p.codigo_destino = 983  and p.fecha >= "'.$last_week.'" and e.numero not in('.$ignored_list.') order by p.registro desc' );

//TODO API avisar si diff > N si last()->codigo_destino sigue siendo 983
        $expedientes = Expediente::hydrate($expedientes);

        $ocultos = DB::connection('mysql2')->select('SELECT e.*, DATEDIFF(NOW(),p.fecha) as diff FROM EXPEDIEN e
        left JOIN EXP_PASE p on e.numero = p.numero
        WHERE p.codigo_destino = 983  and p.fecha >= "'.$last_week.'" and e.numero in('.$ignored_list.') order by p.registro desc' );
        $ocultos = Expediente::hydrate($ocultos);


        return view('rectorado')->with('expedientes',$expedientes)->with('ocultos',$ocultos)->with("flag",true);
        //
    }
    public function consejo()
    {
        $config = Configuracion::first();
        // $consejo_id = 916;
        //        $expedientes = DB::connection('mysql2')->select('SELECT e.* ,p.*, DATEDIFF(NOW(),p.fecha) as diff FROM EXPEDIEN e
        // left JOIN EXP_PASE p on e.numero = p.numero
        // WHERE p.codigo_destino = 916  and p.fecha >= "2019-01-01" and p.fecha_ingreso not like "%0000%" and p.fecha_salida like "%0000%" order by p.registro desc' );
        $expedientes = DB::connection('mysql2')->select('SELECT e.* ,p.*, DATEDIFF(NOW(),p.fecha) as diff FROM EXPEDIEN e
        left JOIN EXP_PASE p on e.numero = p.numero
        WHERE p.codigo_destino = 916  and p.fecha >= "2019-01-01" order by p.registro desc' );

        $expedientes = Expediente::hydrate($expedientes);


       return view('consejo')->with('expedientes',$expedientes);
    }

    public function movimientos($exp_numero)
    {
        $e = Expediente::where('numero','=',$exp_numero)->first();

        // print_r($e);
        return view('movimientos')->with('expediente',$e);
    }


}
