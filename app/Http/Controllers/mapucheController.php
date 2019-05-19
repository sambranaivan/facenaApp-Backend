<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mapucheController extends Controller
{
    //

    public function index(){
        $ch = curl_init();
        $url = "https://10.20.15.80:7070/mapuche/agentes/legajo/4028";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "exactas:Exa2019_");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        print_r($info);

        print_r($output);
    }
}
