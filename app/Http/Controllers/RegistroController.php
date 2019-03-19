<?php

namespace App\Http\Controllers;
use App\Expediente;
use App\Pase;
use App\Registro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroController extends Controller
{
    //

    function test(){

        $p = Pase::where('codigo_destino','=','983')->orderby('registro','desc')->take(50)->get();

        foreach ($p as $pase)
        {
            echo $pase->registro.'  ';
            echo $pase->fecha.' ';
            $ingreso = $pase->fecha_ingreso;
            $salida = $pase->fecha_salida;
            echo $ingreso.' ';
            echo $salida.' ';
            if($ingreso == '0000-00-00' & $salida == '0000-00-00')
            {
                echo ' No recibido - Rojo';
            }
            elseif($ingreso != '0000-00-00' & $salida == '0000-00-00')
            {
                echo 'Recibido - En mesa de Entrada de Rectorado';
            }
            elseif($ingreso != '0000-00-00' & $salida != '0000-00-00')
            {
                echo ' Tratandose';

            }
            else //  O-X
            {
                echo 'Inconsistente';
            }
            echo '</br>';

        }


    }
}
