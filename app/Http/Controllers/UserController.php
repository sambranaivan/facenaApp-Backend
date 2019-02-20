<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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


}
