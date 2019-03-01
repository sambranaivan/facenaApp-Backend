<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\configuracion;
class ConfiguracionController extends Controller
{
    //

      public function set($id){
    	$c = configuracion::first();
    	echo $c->last_id;

    	$c->last_id = $id;

    	$c->save();
    	echo "->>";
    	echo $c->last_id;
    	return "ok";
    }

        public function get(){
    	$c = configuracion::first();
    	echo $c->last_id;

    }
}
