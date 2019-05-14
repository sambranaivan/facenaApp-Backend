<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Configuracion;
use App\Notification;
use App\subcription;
use App\Asunto;
use GuzzleHttp\Client;
use DB;
class AsuntoController extends Controller
{
    //

    public function activarTodos(){

        $u = Auth::user();
        $asuntos = Asunto::all();

        foreach ($asuntos as $asunto)
        {
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
        }

        return redirect()->route('notificaciones_todos');
    }

    public function activarTodosFiltro(){

    }


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


/**
* Notificacion de prueba
*/
    public function sendNotificacion()
    {
        $client = new Client([
            'curl' => [ CURLOPT_SSLVERSION => 1 ],
          ]);
        $user = User::find(1);
             $response = $client->request('POST', 'https://exp.host/--/api/v2/push/send', [
            'form_params' =>
            [
                'to'=> "ExponentPushToken[zjYKarCIWgfBJMU6U3_gir]", //User->getToken();
                "title"=>"titulo",
                "body"=>"cuerpo",
                "data"=>['message'=>'Ultimo Enviado','type'=>'test']]
            ]);

            $data = [
            'form_params' =>
            [
                'to'=> "ExponentPushToken[zjYKarCIWgfBJMU6U3_gir]", //User->getToken();
                "title"=>"titulo",
                "body"=>"cuerpo",
                "data"=>['message'=>'Ultimo Enviado','type'=>'test']]
            ];
            // header('Content-Type: application/json');
            // echo json_encode($data);
            $notification = new Notification();
            $notification->user_id = 1;
            $notification->token = 'token test';
            $notification->mensaje = json_encode($data);
            // $notification->save();

	// echo "Enviado Ok";
    }


    public function verAsuntos(){

        $config = Configuracion::first();
        $asuntos = DB::connection('mysql2')->select('SELECT * from mesa_exactas.TABLAS
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
