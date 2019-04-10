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


    }
     public function edit($id){
            $mail = mail::find($id);
            return view('mails.actualizar')->with('mail',$mail);

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
    }

    public function listado(){
        $mails = mail::all();
        return view('mails.listado')->with('mails',$mails);
    }
}
