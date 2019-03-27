<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departamento;
use App\Alarma;
use App\Pase;
use App\Configuracion;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
use DB;
class AlarmaController extends Controller
{
    //
    public function alertas(){

        //busco todo los departamentos
        $departamentos = Departamento::all()->sortBy('codigo');

        return view('crearAlerta')
        ->with('departamentos',$departamentos)->with('editar',false)
        ;
    }

    public function verAlertaDetalle(Request $request){
         //busco todo los departamentos
        $dpto = Departamento::find($request->dpto_id);
        $departamentos = Departamento::all()->sortBy('codigo');


        // buscar si hay registro de alarmas
        $alarmas = Alarma::where('departamento',$dpto->codigo)->count();
        //si hay cargo para editar
        if($alarmas)
        {

            $alarma_1 = Alarma::where('departamento',$dpto->codigo)->where('tipo',1)->first();
            $alarma_2 = Alarma::where('departamento',$dpto->codigo)->where('tipo',2)->first();
            return view('crearAlerta')
            ->with('departamentos',$departamentos)
            ->with('editar',true)
            ->with('alarma_1',$alarma_1)
            ->with('alarma_2',$alarma_2)
            ->with('selected',$dpto);
        }
        else
        {
            return view('crearAlerta')
            ->with('departamentos',$departamentos)
            ->with('editar',true)
            ->with('selected',$dpto);
        }





    }

     public function editarAlerta(Request $request){
         ///

        $dpto = Departamento::find($request->dpto_id);
        $departamentos = Departamento::all()->sortBy('descripcion');
   // buscar si hay registro de alarmas
        $count = Alarma::where('departamento',$dpto->codigo)->count();
        ////recibo registro
        if($count)
        {
            $a_1 = Alarma::where('departamento',$dpto->codigo)->where('tipo',1)->first();
            $a_2 = Alarma::where('departamento',$dpto->codigo)->where('tipo',2)->first();
        }
        else {
            $a_1 = new Alarma();
            $a_2 = new Alarma();
        }

        $a_1->departamento = $request->dpto_id;
        $a_1->amarillo = $request->amarillo_1;
        $a_1->rojo = $request->rojo_1;
        $a_1->email = $request->email_1;
        $a_1->escalar = $request->escalar_1;
        $a_1->tipo = 1;
        $a_1->save();
        $a_2->departamento = $request->dpto_id;
        $a_2->amarillo = $request->amarillo_2;
        $a_2->rojo = $request->rojo_2;
        $a_2->email = $request->email_2;
        $a_2->escalar = $request->escalar_2;
        $a_2->tipo = 2;
        $a_2->save();
        //
        //    return view('crearAlerta')
        //     ->with('departamentos',$departamentos)
        //     ->with('editar',true)
        //     ->with('alarma_1',$a_1)
        //     ->with('alarma_2',$a_2)
        //     ->with('selected',$dpto)
        //     ->with('updated',true);
        // return redirect('/superadmin/listaAlertas');
        return redirect()->route('alertas');

    }

    public function verListado()
    {
        $q = DB::select('SELECT DISTINCT departamento from alarmas');
        $d = [];

        foreach ($q as $dpto) {
            $d[] = Departamento::find($dpto->departamento);
        }


        return view('listadoAlertas')->with('departamentos',$d);
    }

// public function send()
//         {
//         $objDemo = new \stdClass();
//         $objDemo->demo_one = 'Demo One Value';
//         $objDemo->demo_two = 'Demo Two Value';
//         $objDemo->sender = 'SenderUserName';
//         $objDemo->receiver = 'ReceiverUserName';

//         Mail::to("sambranaivan@gmail.com")->send(new DemoEmail($objDemo));
//         }

public function borrarAlerta($departamento_id){

            $a = Alarma::where('departamento',$departamento_id)->get();

            foreach ($a as $alarma)
            {
                $alarma->delete();
            }
          return redirect()->route('alertas');
    }


    /**
     * FUNCION PRINCIPAL DE ENVIO DE MAILS
     *
     *
     */

    public function runAlarma(){
        $c = Configuracion::first();
        echo "Buscando Alarmas de Tipo: Pases EN DEPARTAMENTO</br>";
        ////obtengo todas las alarmas
        $alarmas = Alarma::where('tipo',2)->get();///alerta por pase en departameto
        // en el !XX-XX-XXXX y 00-00-00
        echo "Buscando Alarmas para ".sizeof($alarmas)." Departamentos";
        foreach ($alarmas as $alarma)///aca deberia ser por departameto
        {///por cada alarma osea aca tengo un deparamento nomas por alarma
            echo "</br>";
            echo "Buscando Pases para ".$alarma->departamento;
            echo "</br>";
            // busco todos los pases en (x-O) del departamento de la alarma
            $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha_ingreso) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso not like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino ='.$alarma->departamento.'
                                                        order by diff desc, registro desc
                                                        limit 0,100');

            $pases = Pase::hydrate($results);//convierto registro en objeto
            echo "Se Encontraron".sizeof($results)." Pases para ".$alarma->departamento;
            echo "</br>";
            // return;

            $reporte = [];//creo array por departamento
            $reporte_escalar = [];//creo array por departamento
            // obtengo todos los pases y calculo el color segun la alarma
            foreach ($pases as $pase)///por cada pase que encuentro le pongo color
            {
                    // if($pase->diff< $alarma->amarrillo)
                    // {
                    //     $color = 'white';
                    //     $pase->color = $color;
                    //     $pase->alarma = $alarma;
                    // }
                    // else
                    if ($pase->diff >= $alarma->amarillo & $pase->diff < $alarma->rojo)
                    {
                        $color = 'yellow';
                        $pase->color = $color;
                        $pase->alarma = $alarma;
                        $reporte[] = $pase;
                    }
                    else
                    {
                        $color = 'red';
                        $pase->color = $color;
                        $pase->alarma = $alarma;
                        $reporte_escalar[] = $pase;
                        $reporte[] = $pase;
                    }

            }///bucle foreach pase
            ///return $reporte y $reporte_escalar

                //enviar mail normal
                $email = $alarma->email;
                $escalar = $alarma->escalar;

                $titulo    = 'Expedientes Facena - Reporte Semanal';

                $cabeceras = 'From: expedientes@exa.unne.edu.ar' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'Content-Type: text/html; charset=UTF-8'. "\r\n" .
                'X-Mailer: PHP/' . phpversion();


                ///envio mail normal
                if(sizeof($reporte))
                {
                $mensaje = view('mails.demo')->with('demo',$reporte)->render();
                mail($email, $titulo, $mensaje, $cabeceras);
                echo "Email Enviado a ".$email." con ".sizeof($reporte).' Registros </br>';
                }
                else
                {
                    echo 'no hay pases que reportar para';

                }
                if(sizeof($reporte_escalar))
                {
                    $mensaje = view('mails.demo')->with('demo',$reporte_escalar)->render();
                mail($escalar, $titulo, $mensaje, $cabeceras);
                echo "Email Enviado a ".$escalar." con ".sizeof($reporte_escalar).' Registros </br>';
                }
                else
                {
                    echo 'Escalar no hay pases que reportar para';
                }



        }

        /**
         * bloque de expedientes en expera
         */
        // $c = Configuracion::first();
        echo "Buscando Alarmas de Tipo: EN ESPERA DE SER TOMADOS</br>";
        ////obtengo todas las alarmas
        $alarmas = Alarma::where('tipo',1)->get();///alerta por pase en departameto
        // en el !XX-XX-XXXX y 00-00-00
        echo "Buscando Alarmas para ".sizeof($alarmas)." Departamentos";
        foreach ($alarmas as $alarma)
        {///por cada alarma osea aca tengo un deparamento nomas por alarma
            echo "</br>";
            echo "Buscando Pases para ".$alarma->departamento;
            echo "</br>";
            // busco todos los pases en (x-O) del departamento de la alarma
            $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino ='.$alarma->departamento.'
                                                        order by diff desc, registro desc
                                                        limit 0,100');

            $pases = Pase::hydrate($results);//convierto registro en objeto
            echo "Se Encontraron".sizeof($results)." Pases para ".$alarma->departamento;
            echo "</br>";
            // return;

            $reporte = [];//creo array por departamento
            $reporte_escalar = [];//creo array por departamento
            // obtengo todos los pases y calculo el color segun la alarma
            foreach ($pases as $pase)///por cada pase que encuentro le pongo color
            {

                    // if($pase->diff < $alarma->amarrillo)
                    // {
                    //     $color = 'white';
                    //     // echo ' blanco!!</br>';
                    //     $pase->color = $color;
                    //     $pase->alarma = $alarma;
                    // }
                    if ($pase->diff >= $alarma->amarillo & $pase->diff < $alarma->rojo)
                    {
                        $color = 'yellow';
                        $pase->color = $color;
                        $pase->alarma = $alarma;
                        $reporte[] = $pase;
                    }
                     if($pase->diff >= $alarma->rojo)
                    {
                        $color = 'red';
                        $pase->color = $color;
                        $pase->alarma = $alarma;
                        $reporte[] = $pase;
                        $reporte_escalar[] = $pase;
                    }

            }///bucle foreach pase
            ///return $reporte y $reporte_escalar

                //enviar mail normal
                $email = $alarma->email;
                $escalar = $alarma->escalar;

                $titulo    = 'Expedientes Facena - Reporte Semanal de Pases';

                $cabeceras = 'From: expedientes@exa.unne.edu.ar' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'Content-Type: text/html; charset=UTF-8'. "\r\n" .
                'X-Mailer: PHP/' . phpversion();


                ///envio mail normal
                if(sizeof($reporte))
                {
                $mensaje = view('mails.espera')->with('demo',$reporte)->render();
                mail($email, $titulo, $mensaje, $cabeceras);
                echo "Email Enviado a ".$email." con ".sizeof($reporte).' Registros </br>';
                }
                else
                {
                    echo 'no hay pases que reportar para';

                }
                if(sizeof($reporte_escalar))
                {
                    $mensaje = view('mails.espera')->with('demo',$reporte_escalar)->render();
                mail($escalar, $titulo, $mensaje, $cabeceras);
                echo "Email Enviado a ".$escalar." con ".sizeof($reporte_escalar).' Registros </br>';
                }
                else
                {
                    echo 'Escalar no hay pases que reportar para';
                }

        }

        ///todos los resultados armos el mail
        return "listo";
    }


    public function probarMail()
    {

        $para      = 'dustingassmann@gmail.com ,sambranaivan@gmail.com,juampy.vallejo@gmail.com,pereiramatin@gmail.com,alonso.651@gmail.com';
        $titulo    = 'Todos aprueban por decreto';
        $mensaje   = 'Titulos para todos';
        $cabeceras = 'From: sambrana@exa.unne.edu.ar' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($para, $titulo, $mensaje, $cabeceras);


    }


    public function semanal(){
        $c = Configuracion::first();

        $dptos = Departamento::all();
        /// $deptos con alarmas
        $all = DB::connection('mysql')->select("SELECT DISTINCT departamento from alarmas");

        $dptos = [];
        foreach ($all as $d_id)
        {
            $dptos[] = Departamento::find($d_id->departamento);
        }
        // print_r($dptos);

        // return ;

        foreach ($dptos as $dpto)
        {
            ///por cada depto
            ///alarma
            $alarma_en_espera = Alarma::where('tipo',1)->where('departamento',$dpto->codigo)->first();
            $alarma_en_dpto = Alarma::where('tipo',2)->where('departamento',$dpto->codigo)->first();

            ///existen las las alarmas=??

            //alarma en espera
            $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino ='.$dpto->codigo.'
                                                        order by diff desc, registro desc
                                                        limit 0,100');

            $pases_en_espera = Pase::hydrate($results);//convierto registro en objeto
            echo "Se Encontraron".sizeof($results)." Pases para ".$dpto->descripcion;
            echo "</br>";
            $reporte_en_espera = [];
            $reporte_en_espera_escalar = [];
            foreach ($pases_en_espera as $pase)
            {
                  if ($pase->diff >= $alarma_en_espera->amarillo & $pase->diff < $alarma_en_espera->rojo)
                    {
                        $color = 'yellow';
                        $pase->color = $color;
                        $pase->alarma = $alarma_en_espera;
                        $reporte_en_espera[] = $pase;
                    }
                    else
                    {
                        $color = 'red';
                        $pase->color = $color;
                        $pase->alarma = $alarma_en_espera;
                        $reporte_en_espera[] = $pase;
                        $reporte_en_espera_escalar[] = $pase;
                    }
            }
            /**
             * Pase en Departamento
             */
            $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha_ingreso) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso not like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino ='.$dpto->codigo.'
                                                        order by diff desc, registro desc
                                                        limit 0,100');

            $pases_en_dpto = Pase::hydrate($results);//convierto registro en objeto
            echo "Se Encontraron".sizeof($results)." Pases en ".$dpto->descripcion;
            echo "</br>";
            $reporte_en_dpto = [];
            $reporte_en_dpto_escalar = [];
            foreach ($pases_en_dpto as $pase)
            {
                  if ($pase->diff >= $alarma_en_dpto->amarillo & $pase->diff < $alarma_en_dpto->rojo)
                    {
                        $color = 'yellow';
                        $pase->color = $color;
                        $pase->alarma = $alarma_en_dpto;
                        $reporte_en_dpto[] = $pase;
                    }
                    else
                    {
                        $color = 'red';
                        $pase->color = $color;
                        $pase->alarma = $alarma_en_dpto;
                        $reporte_en_dpto[] = $pase;
                        $reporte_en_dpto_escalar[] = $pase;
                    }
            }
            ///En este punto tengo todo ya
            /**
              *   $reporte_en_dpto = [];
              *   $reporte_en_dpto_escalar = [];
              *   $reporte_en_espera = [];
              *   $reporte_en_espera_escalar = [];
              */

            //El problema es que tengo dos mail pero bueno uso el del en espera
            $email = $alarma_en_espera->email;
            $escalar = $alarma_en_espera->escalar;
            $titulo    = 'Expedientes Facena - Reporte Semanal';

            $cabeceras = 'From: expedientes@exa.unne.edu.ar' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'Content-Type: text/html; charset=UTF-8'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            //armar el mensaje
            //normal
            ///envio mail normal

            $mensaje = view('mails.mail')->with('espera',$reporte_en_espera)->with('en_dpto',$reporte_en_dpto)->with('dpto',$dpto)->render();
            mail($email, $titulo, $mensaje, $cabeceras);
            echo "email enviado a ".$email.'</br>';
            $mensaje = view('mails.mail')->with('espera',$reporte_en_espera_escalar)->with('en_dpto',$reporte_en_dpto_escalar)->with('dpto',$dpto)->render();
            mail($escalar, $titulo, $mensaje, $cabeceras);
            echo "email enviado  a ".$escalar.'</br>';
            // echo $mensaje;













        }


    }
}
