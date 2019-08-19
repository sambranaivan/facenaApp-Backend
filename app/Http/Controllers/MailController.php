<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mail;
class MailController extends Controller
{
    //
    public function index(){
        return view('mails.editor');
    }

    public function save(request $request){
            $mail = new mail();
            // $mail->id = $request->id;
            $mail->asunto = $request->asunto;
            $mail->para = $request->para;
            $mail->mensaje = $request->mensaje;
            $mail->day_of_week = $request->day_of_week;
            $mail->hour = $request->hour;
            $mail->save();
               return redirect()->route('listadoMails');


    }
     public function edit($id){
            $mail = mail::find($id);
            return view('mails.actualizar')->with('mail',$mail);

    }
     public function delete($id){
            $mail = mail::find($id);
            $mail->delete();
            return redirect()->route('listadoMails');

    }

    public function update(request $request){
            $mail = mail::find($request->id);
            // $mail->id = $request->id;
            $mail->asunto = $request->asunto;
            $mail->para = $request->para;
            $mail->mensaje = $request->mensaje;
            $mail->day_of_week = $request->day_of_week;
            $mail->hour = $request->hour;
            $mail->save();
           return redirect()->route('listadoMails');
    }

    public function listado(){
        $mails = mail::all();
        $dias = array('','Lunes',"Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
        foreach ($mails as $mail)
        {
            $mail->letras = $dias[$mail->day_of_week];
        }
        return view('mails.listado')->with('mails',$mails);
    }

    public function send(){///envio de mail autoatizados

        ini_set('display_errors',1);
        $day_of_week = date('N');
        $hour = date('G');
         $cabeceras = 'From: expedientes@exa.unne.edu.ar' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'Content-Type: text/html; charset=UTF-8'. "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        $mails = mail::where('day_of_week',$day_of_week)->where('hour',$hour)->get();
        // if($mails->count())
        // {
        //     echo "Enviando ".$mails->count()." Mails";
        //     foreach ($mails as $mail)
        //     {
        //         echo "Enviando ".$mail->para."....";
        //         mail("sambranaivan@gmail.com", "heartbeat", "<b>Hola Mundo</b>", $cabeceras);
        //         $response = (mail($mail->para, $mail->asunto, $mail->mensaje, $cabeceras));
        //          if($response)
        //          {
        //              print_r($response);
        //             echo "Enviado</br>";
        //          }
        //          else
        //          {
        //              echo "Error</br>";
        //              print_r(error_get_last());
        //          }

        //     }
        // }
        // else {
        //     echo 'No Hay Mails';
        // }

        return response($mails);


    }

}
