<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\subcription;
use App\Asunto;
use GuzzleHttp\Client;
use DB;
class AsuntoController extends Controller
{
    //


    public function subscribe(Request $request)
    {
        // chequeo si la subscripcion existe
        $count = subcription::where(['asunto_id'=>$request->asunto,'user_id'=>Auth::user()->id])->count();
        if(!$count)
        {
            $subs = new subcription();
        }
        else
        {
            $subs = subcription::where(['asunto_id'=>$request->asunto,'user_id'=>Auth::user()->id])->first();
        }


        $subs->user_id = Auth::user()->id;
    	$subs->asunto_id = $request->asunto;
    	$subs->estado = true;
    	$subs->save();
        return "registrado";
    }

    public function unsubscribe(Request $request)
    {
        $subs = subcription::where(['asunto_id'=>$request->asunto,'user_id'=>Auth::user()->id])->first();

        $subs->estado = false;
        $subs->save();
        return "unsubscribe ok";
    }

    public function viewAsuntos(){///view all
    	$asuntos = Asunto::orderBy('descripcion')->get();

        // $db = DB::pg_select(connection, table_name, assoc_array)

    	return view('listaAsuntos')->with('asuntos',$asuntos);
    }


    public function sendNotificacion()
    {
        $client = new Client();

             $response = $client->request('POST', 'https://exp.host/--/api/v2/push/send', [
            'form_params' =>
            [
                'to'=> "ExponentPushToken[YK3CFNO9JLwjZc0LC-ZYt8]", //User->getToken();
                "title"=>"titulo",
                "body"=>"cuerpo",
                "data"=>['message'=>'cuna ultima prueba da']]
            ]);

    }


    public function verAsuntos(){

        $asuntos = DB::select('SELECT * from mesa_exactas.tablas
        where codigo in
            (SELECT asunto from (select asunto, COUNT(*) as cantidad from mesa_exactas.expedien e left join mesa_exactas.tablas a on e.asunto = a.codigo
                where fecha like "2019%"
                GROUP by asunto
                ) as sub where cantidad > 3) ORDER by descripcion desc');

        $asuntos = Asunto::hydrate($asuntos);

        $subs = subcription::where(['user_id'=>Auth::user()->id,'estado'=>true])->get();


        // print_r($asuntos);
        return view('listaAsuntos')->with('asuntos',$asuntos)->with('subs',$subs);


    }
}
