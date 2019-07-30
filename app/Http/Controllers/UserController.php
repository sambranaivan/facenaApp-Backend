<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\permiso;
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
    	// return "ok";
        return response()->json($user);
    	// print_r($data);
    	// print_r($request->getContent());
    }

    public function getUser(Request $request){
        $data = json_decode($request->getContent());
        // $user =  User::find($data->user_id);
        $user =  User::find($data->user_id);
    	// $user->token = $data->token;
    	// $user->save();
    return response()->json($user);
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

    public function index(){
        $u = User::all();
        return view('users',['users'=>$u]);
    }

    public function setPermission($user_id,$permision,$status){
        $p = permiso::where('user_id',$user_id)->first();

        $p[$permision] = $status;
        $p->save();

        return redirect(route('usuarios'));

    }

    public function new(){

        return view('new');
    }

    public function create(request $request)
    {
        $u = new user();
        $u->name = $request->name;
        $u->email = $request->email;
        $u->password = \bcrypt($request->password);
        $u->save();

        $p = new permiso();
        $p->user_id = $u->id;
        $p->save();

        return redirect(route('usuarios'));
    }

    public function borrar($user_id){
        $u = user::find($user_id);
        $u->delete();
        return "ok";
    }

}
