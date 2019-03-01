<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\configuracion;
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

     public function verTodos(){

        $asuntos = Asunto::all();



        $subs = subcription::where(['user_id'=>Auth::user()->id,'estado'=>true])->get();

        $clave = rand(1000,9999);

           $u = User::find(Auth::user()->id);

        if(!$u->clave)
            {
                $u->clave = $clave;
                $u->save();
            }
            $u->save();

        // print_r($asuntos);
        return view('listaAsuntos')->with('asuntos',$asuntos)->with('subs',$subs)->with('clave',$u->clave)->with('filtro',false);;


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

        $config = configuracion::first();
        $asuntos = DB::select('SELECT * from mesa_exactas.tablas
        where codigo in ('.$config->filter.')'
            );

        $asuntos = Asunto::hydrate($asuntos);

        $subs = subcription::where(['user_id'=>Auth::user()->id,'estado'=>true])->get();

        $clave = rand(1000,9999);

           $u = User::find(Auth::user()->id);

        if(!$u->clave)
            {
                $u->clave = $clave;
                $u->save();
            }
            $u->save();

        // print_r($asuntos);
        return view('listaAsuntos')->with('asuntos',$asuntos)->with('subs',$subs)->with('clave',$u->clave)->with('filtro',true);


    }
}
