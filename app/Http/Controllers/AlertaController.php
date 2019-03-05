<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\configuracion;
use App\Expediente;
use App\subcription;

use App\User;

use App\Asunto;
use GuzzleHttp\Client;
use DB;


class AlertaController extends Controller
{
    /**
     *
     * Leo la tabla expediente y guardo el ultimo ID
     *
     * dentro de 15 minutos vuelvo a leer y todo todos los registros mayores a ese id
     *
     * por cada expediente nuevo saco el asunto
     *
     *  -busco el asunto en la tabla subscripciones activas
     *  -envio notificacion al usuario si esta con App registrado
     *  -guardo la alerta en la tabla alertas
     *
     * actualizo el ultimo id leido en mi registro temporal
     * necesito una tabla configuraciones
     */

     public function checkUpdate(){

        $config = Configuracion::first();
        $last_id = $config->last_id;

        $expedientes = expediente::where('registro','>',$last_id)->get();

        foreach ($expedientes as $exp)
        {
                // ya tengo el expediente ahora busco si
                // alguien esta subscripto a la notificacion
                echo 'buscando para expediente '.$exp->registro.' asunto '.$exp->asunto.'</br>';
                $subs = Subcription::where(['asunto_id'=>$exp->asunto,'estado'=>true])->get();

                foreach ($subs as $sub)
                {
                    $u = $sub->getUser;
                    echo 'enviar Notificacion a '.$u->name.'</br>';
                    if($u->token)
                    {
                        echo 'Token OK....enviando notificacion</br>';
                        echo $exp->detalle_asunto.'</br>';
                        echo $exp->getAsunto->descripcion;
                        $this->sendNotificacion($u->token,'Nuevo Expediente '.$exp->numero,$exp->getAsunto->descripcion."-".$exp->detalle_asunto,$exp);
                    }

                }

        $config->last_id = $exp->registro;
        }
        $config->save();

     }

      public function sendNotificacion($token,$titulo,$mensaje,$data)
        {
            $client = new Client();

                $response = $client->request('POST', 'https://exp.host/--/api/v2/push/send', [
                'form_params' =>
                [
                    'to'=> $token, //User->getToken();
                    "title"=>$titulo,
                    "channelId"=> 'notif',
                    "body"=>$mensaje,
                    
                    "data"=>[
                        "type"=>'exp',
                        'asunto'=>$data->getAsunto->descripcion,
                        'expediente'=>[ 'iniciador' => $data->detalle_iniciador,
                                        'numero' => $data->numero,
                                        'fecha' => $data->fecha,
                                        // 'operador'=> $data->operador,
                                        'detalle_asunto'=>$data->detalle_asunto,
                                        'codigo_asunto'=>$data->asunto
                                        ]
                            ],


                ]]);
                    echo 'notificacion enviada</br>';


        }




}
