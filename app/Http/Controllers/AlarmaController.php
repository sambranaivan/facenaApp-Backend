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

public function send()
        {
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';

        Mail::to("sambranaivan@gmail.com")->send(new DemoEmail($objDemo));
        }

public function borrarAlerta($departamento_id){

            $a = Alarma::where('departamento',$departamento_id)->get();

            foreach ($a as $alarma)
            {
                $alarma->delete();
            }
          return redirect()->route('alertas');
    }



    public function runAlarma(){
        $c = Configuracion::first();
        ////obtengo todas las alarmas
        $alarmas = Alarma::where('tipo',1)->get();///alerta por pase en espera
        // en el 00-00-00 y 00-00-00

        foreach ($alarmas as $alarma)
        {///por cada alarma osea aca tengo un deparamento nomas por alarma

            // busco todos los pases del departamento de la alarma
            $results = DB::connection('mysql2')->select('SELECT *,
                                                    DATEDIFF(NOW(),fecha_ingreso) as diff
                                                    FROM `EXP_PASE`
                                                        where fecha_ingreso like "%0000-00-00%"
                                                        and fecha_salida like "%0000-00-00%"
                                                        and fecha like "%'.$c->filtrofecha.'%"
                                                        and codigo_destino ='.$alarma->departamento.'
                                                        order by diff desc, registro desc
                                                        limit 0,100');
            $pases = Pase::hydrate($results);//convierto registro en objeto

            $reporte = [];//creo array por departamento
            $reporte_escalar = [];//creo array por departamento
            // obtengo todos los pases y calculo el color segun la alarma
            foreach ($pases as $pase)///por cada pase que encuentro le pongo color
            {
                    if($pase->diff< $alarma->amarrillo)
                    {
                        $color = 'white';
                        $pase->color = $color;
                        $pase->alarma = $alarma;
                    }
                    elseif ($pase->diff >= $alarma->amarillo & $pase->diff < $alarma->rojo)
                    {
                        $color = 'yellow';
                        $pase->color = $color;
                        $pase->alarma = $alarma;
                    }
                    else
                    {
                        $color = 'red';
                        $pase->color = $color;
                        $pase->alarma = $alarma;
                        $reporte_escalar[] = $pase;
                    }


                    $reporte[] = $pase;
            }

                $email = $alarma->email;
                $escalar = $alarma->escalar;
                $mail = new \stdClass();
                $mail->subject = 'Expedientes Facena - Reporte Semanal';
                $mail->tipo = 1;
                $mail->escalar = false;
                Mail::to($email)->send(new DemoEmail($reporte,$mail));


                ///escalar email
                $mail = new \stdClass();
                $mail->subject = 'Expedientes Facena - Reporte Semanal - Escalar';
                $mail->tipo = 1;
                $mail->escalar = true;
                Mail::to('ivanss.s91@gmail.com')->send(new DemoEmail($reporte_escalar,$mail));






        }


        ///todos los resultados armos el mail
    }


    public function probarMail()
    {

        $para      = 'emanuelirrazabal@gmail.com,sambranaivan@gmail.com';
        $titulo    = 'El título';
        $mensaje   = 'Hola';
        $cabeceras = 'From: subsecretaria@exa.unne.edu.ar' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($para, $titulo, $mensaje, $cabeceras);


    }
}
