<?php

namespace App\Http\Controllers;

use App\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hash;
class ExpedienteController extends Controller
{
    //

    public function verExpediente($hash)
    {
        ///hash reverse
        if(!$hash)
        {
            return view('expediente_error')->with('error',true);
        }

        $hash = strtoupper($hash);

        $hash = Hash::where('hash',$hash)->first();
          if(!$hash)
        {
            return view('expediente_error')->with('error',true);
        }
         $e = $hash->expediente;

         if($e)
         {
            return view('expediente_detalle')->with('expediente',$e);
         }
         else{
             return view('buscar_expediente')->with('error',true);
         }
        // print_r($e);

    }




    public function buscarExpediente(request $request)
    {
        return redirect()->route('verExpediente', ['hash' => $request->hash]);
    }
}
