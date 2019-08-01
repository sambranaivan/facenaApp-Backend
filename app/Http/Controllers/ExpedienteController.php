<?php

namespace App\Http\Controllers;

use App\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hash;
use Auth;
use App\ignored;
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


      public function ignorar($numero)
    {
        $ingnored = new ignored();
        $ingnored->user_id = Auth::user()->id;
        $ingnored->numero = $numero;
        $ingnored->save();
        return response("ok");
    }

    public function restaurar($numero)
    {
        $ignored = ignored::where('numero',$numero)->where('user_id',Auth::user()->id)->get();
        foreach ($ignored as $key => $value) {

            echo $value->id;
            $value->delete();

        }
        return response("ok");
    }

    public function ema()
    {
        $exp = Expediente::where("numero","09-2019-04686")->get()->first();
        $ini = $exp->iniciador;
        print_r($ini);
    }
}
