<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cargo;
use App\costo;
use App\antiguedad;
use App\fijo;
use Carbon\Carbon;

class sueldoController extends Controller
{
    //


    public function calcula(request $request)
    {
        $cargo = cargo::where(['cargo'=>$request->cargo,'dedicacion'=>$request->dedicacion])->get()->first();

        if($cargo)
        {
            // continue
        }
        else
        {
            return view('sueldos.sueldos')->with('error','Cargo o Dedicación no Corresponden')->with('request',$request);
        }

        $antiguedad = antiguedad::where('desde','<=',$request->antiguedad)->where('hasta', '>=', $request->antiguedad)->get()->first();

        $costo = costo::where(['cargo_id'=>$cargo->id])
        ->where(['antiguedad_id'=>$antiguedad->id])->get()->first();

        $posgrado = 0;
        switch ($request->adicional) {
            case 'doctor':
                $posgrado = fijo::find(0)->valor;
                $_tipo_titulo =  "DOCTOR";
                break;
            case 'master':
                $posgrado = fijo::find(1)->valor;
                $_tipo_titulo =  "MAESTRIA"   ;
                break;
            case 'esp':
                $posgrado = fijo::find(2)->valor;
                $_tipo_titulo =     "ESPECIALISTA";
                break;
            default:
                $posgrado=  0;
                $_tipo_titulo =  "";
                break;
        }


        /**
         *
         */

         $_sueldo_basico = $costo->cargo->sueldo;
         $_sueldo_antiguedad = $_sueldo_basico * ($costo->antiguedad->adicional / 100);
         $_garantia = $costo->garantia;
         $_adicion_titulo = $_sueldo_basico * ($posgrado / 100);
         $_adicional_no_remunerativo = $costo->adic_norem;
         $_adicional_jeraquico = $costo->adic_rem;
         $_total_bruto = ($_sueldo_basico
                            + $_sueldo_antiguedad
                            + $_garantia
                            + $_adicion_titulo
                            + $_adicional_no_remunerativo
                            + $_adicional_jeraquico);

        /**
         * Calculo de dias del periodo
         */

       $desde =  Carbon::parse($request->desde);
       $hasta =  Carbon::parse($request->hasta);




        // echo  (30 - $desde->day + 1) + ($hasta->month - $desde->month) * 30;
        if($desde->month <= 6)
        {
            $primer_bimestre =  (30 - $desde->day + 1) + ((7 - $desde->month - 1) * 30);
        }
        else
        {
            $primer_bimestre = 0;
        }


        if($hasta->month > 6)
        {
            $segundo_bimestre = ($hasta->month - 6) * 30;
        }
        else
        {
            $segundo_bimestre = 0;
        }

        $dias = $primer_bimestre + $segundo_bimestre;

        //
        $_asignaciones = ($_sueldo_basico / 30 * $dias);
        $_adicionales = (($_sueldo_antiguedad   + $_garantia    + $_adicion_titulo) / 30 ) * $dias;
        $_adicionales_nrnb = (( $_adicional_no_remunerativo + $_adicional_jeraquico)/30)*$dias;
        $_primer_sac = (($_sueldo_basico + $_sueldo_antiguedad + $_garantia + $_adicion_titulo) * $primer_bimestre)/360;
        $_segundo_sac = (($_sueldo_basico + $_sueldo_antiguedad + $_garantia + $_adicion_titulo) * $segundo_bimestre) / 360;
        $_sub_total = ($_asignaciones +
                        $_adicionales +
                        $_adicionales_nrnb +
                        $_primer_sac +
                        $_segundo_sac);
        /**
         * Patronales
         */
        $_aux = ($_asignaciones +
            $_adicionales +
            // $_adicionales_nrnb +
            $_primer_sac +
            $_segundo_sac);
            $_cuota_patronal =  $_aux * (fijo::find(3)->valor / 100);
            $_obra_social =  $_aux * (fijo::find(4)->valor / 100);
            $_ley = $_aux * (fijo::find(5)->valor / 100);
            $_art = $_aux * (fijo::find(6)->valor / 100);
            $_patronal_total = ($_cuota_patronal + +$_obra_social + $_ley + $_art);
        //
        $total_periodo = $_sub_total + $_patronal_total;

        $total_costo_mensual = ($_sueldo_basico + $_sueldo_antiguedad + $_garantia + $_adicion_titulo) * (fijo::find(7)->valor/100) + $_total_bruto;

        $resultado = (object)
        [
            'cargo'=>$costo->cargo->cargo,
            'dedicacion' => $costo->cargo->dedicacion,
            'antiguedad_anios' => $request->antiguedad,
                'sueldo_basico'=> $_sueldo_basico,
                'antiguedad'=>	$_sueldo_antiguedad,
                'garantia'=>	$_garantia,
                'adicional_titulo'=>  $_adicion_titulo,
            'tipo_titulo' =>  $_tipo_titulo,
                'adicional_no_remunerativo'=>	$_adicional_no_remunerativo,
                'adicional_jeraquico'=>	$_adicional_jeraquico,
                'total_bruto'=> $_total_bruto,

                "desde"=>$desde,
                "hasta" => $hasta,
                "primer_bimestre" => $primer_bimestre,
                "segundo_bimestre" =>$segundo_bimestre,
                "dias"=>$dias,
                "totales"=>(object)[
                    "asignaciones" =>$_asignaciones,
                    "adicionales" =>$_adicionales,
                    "adicionales_nrnb" =>$_adicionales_nrnb,
                    "primer_sac" =>$_primer_sac,
                    "segundo_sac" =>$_segundo_sac,
                    "sub_total" =>$_sub_total
                ],
                "patronales"=>(object)[
                    "cuota_patronal" => $_cuota_patronal,
                    "obra_social" => $_obra_social,
                    "ley" => $_ley,
                    "art" => $_art,
                    "total" =>$_patronal_total
                ],
                "total_perido"=>$total_periodo,
                "total_costo_mensual"=> $total_costo_mensual
        ];

        // return response()->json($resultado);
        return view('sueldos.sueldos')->with('resultado',$resultado)->with('request', $request);
        // return $request;





    }


    public function home(){
        return view('sueldos.sueldos');
    }
}
