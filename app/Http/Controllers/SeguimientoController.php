<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\seguimiento;
use App\Expediente;
use App\Pase;
use Auth;
class SeguimientoController extends Controller
{
    //

    public function seguir($id)
    {
        $seguimiento = new Seguimiento();
        $expediente = Expediente::where('numero','=',$id)->first();

        $seguimiento->expediente = $id;
        $seguimiento->estado = $expediente->getEstado();
        $seguimiento->ultimo_movimiento = $expediente->getPases->last()->registro;
        $seguimiento->mail = Auth::user()->email;
        $seguimiento->user_id = Auth::user()->id;
        $seguimiento->save();
        return redirect()->route("rectorado");
    }

    public function unfollow($id){
        $seguimientos = Seguimiento::where('expediente',$id)->where('user_id',Auth::user()->id)->get();

        foreach ($seguimientos as $key => $value)
        {
            $value->delete();
        }
        return redirect()->route("rectorado");
    }

    public function checkUpdate(){
        // {return "no-recibido";}
        // {return "recibido";}
        // {return "tratandose";}
        $seguimientos = Seguimiento::where('notify',false)->get();

        $flag = false;
        $ret = [];

        foreach ($seguimientos as $seguimiento)
        {
            $exp = $seguimiento->getExpediente;
            // buscar si hubo cambios
            if($exp->getEstado() == "regreso")
            {
                $flag = true;
                // Notificar
                $mail = array('to' => $seguimiento->mail,'asunto'=>"Actualización Expediente ".$exp->numero,'body'=>"Expediente ".$exp->numero." regresó de Rectorado");
                $seguimiento->notify = true;
                $seguimiento->save();
                $ret[] = $mail;
            }

        }

        if($flag)
        {
            return response($ret);
        }
    }
}
