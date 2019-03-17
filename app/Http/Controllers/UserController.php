<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\configuracion;
class UserController extends Controller
{
    //

    public function registerapp(Request $request)
    {
    	$data = json_decode($request->getContent());
        // $user =  User::find($data->user_id);
        $user =  User::where('clave',"=",$data->clave)->first();
    	$user->token = $data->token;
    	$user->save();
    	return "ok";
    	// print_r($data);
    	// print_r($request->getContent());
    }

    public function superadmin(){
        $config = configuracion::first();
        return view('superadmin')->with(['config'=>$config]);
    }

    public function updateFilters(Request $request){
        $config = configuracion::first();

        $config->filter = $request->asuntos;
        $config->save();
        return redirect('superadmin');
    }

    public function userList(){

    }


}
