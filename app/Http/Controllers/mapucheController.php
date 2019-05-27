<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use exception;

class mapucheController extends Controller
{
    //

    public function indexx(){
        $ch = curl_init();
        $url = "https://10.20.15.80/mapuche/agentes/legajo/4028";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PORT, 7070);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "exactas:Exa2019_");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        print_r($output);
        echo"</br>";

        // print_r($output);
    }

    public function indexj(){
        echo "curl";
            //The URL of the resource that is protected by Basic HTTP Authentication.
            $url = "https://10.20.15.80/mapuche/agentes/legajo/4028";

            //Your username.
            $username = 'exactas';

            //Your password.
            $password = 'Exa2019_';

            //Initiate cURL.
            $ch = curl_init($url);

            //Specify the username and password using the CURLOPT_USERPWD option.
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
            curl_setopt($ch, CURLOPT_PORT, 7070);
            //Tell cURL to return the output as a string instead
            //of dumping it to the browser.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification

            //Execute the cURL request.
            $response = curl_exec($ch);

            //Check for errors.
            if(curl_errno($ch)){
            //If an error occured, throw an Exception.
            throw new Exception(curl_error($ch));
            }

            //Print out the response.
            echo $response;
    }

    public function index(){


            //The URL of the resource that is protected by Basic HTTP Authentication.
            $url = "https://10.20.15.80/mapuche/agentes/legajo/4028";



            //Initiate cURL.
            $ch = curl_init($url);

            //Specify the username and password using the CURLOPT_USERPWD option.
            curl_setopt($ch, CURLOPT_USERPWD,"exactas:Exa2019_");
            curl_setopt($ch, CURLOPT_PORT, 7070);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            //Tell cURL to return the output as a string instead
            //of dumping it to the browser.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


            //Execute the cURL request.
            $response = curl_exec($ch);

            //Check for errors.
            if(curl_errno($ch)){
            //If an error occured, throw an Exception.
            throw new Exception(curl_error($ch));
            }

            //Print out the response.
            echo $response;


}}
