<?php

namespace App\Http\Controllers;

use App\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpedienteController extends Controller
{
    //

    public function verExpediente($hash)
    {
        ///hash reverse
        if(!$hash)
        {
            return view('buscar_expediente')->with('error',true);
        }
        $numero = $this->hash_reverse($hash);
        // $ua =

         $e = Expediente::where('numero','=',$numero)->first();

         if($e)
         {
            return view('expediente_detalle')->with('expediente',$e);
         }
         else{
             return view('buscar_expediente')->with('error',true);
         }
        // print_r($e);

    }


    public function hash_reverse($hash)
    {
        $hash = strtolower($hash);
        $hash = base_convert($hash,36,10);

        ///si la longitud es de 10 agrego un 0 al inicio para completar las 2 cifras
        //9201900831
        if(strlen($hash) <= 10)
        {
            $hash = "0".$hash;
        }
        // echo $hash.'</br>';

        $ua = substr($hash,-11,2);
        $year = substr($hash,-9,4);
        $exp = substr($hash,-5);
        return ($ua."-".$year."-".$exp);
    }

    public function buscarExpediente(request $request)
    {
        return redirect()->route('verExpediente', ['hash' => $request->hash]);
    }
}
