<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DNS1D;
use App\hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }




    public function fillBarcode(){

/**
 *
 */
    $number = 0;
    $stack = [];
    for($j=0;$j<10000;$j++)
    {

         $numero = '09-2019-';
         $number =  $j;
                    if($number < 10)
                        {$numero .='0000'.$number;}
                    elseif($number < 100)
                        {$numero .='000'.$number;}
                    elseif($number < 1000)
                        {$numero .='00'.$number;}
                    elseif($number < 10000)
                        {$numero .='0'.$number;}
                    elseif($number < 100000)
                        {$numero .= $number;}

                    /**
                     * Genero codigo
                     */
                    do
                    {
                        $flag = true;
                        $length = 4;
                    $string = '';
                    for ($i=0; $i < $length; $i++)
                        {
                        $string .= substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1);
                        }
                    /** */
                    ///probar que no este repetido
                    if(!in_array($string,$stack))
                    {
                        $stack[] = $string;
                        $flag = false;
                        $hash = new hash;
                        $hash->numero = $numero;
                        $hash->hash = $string;
                        $hash->save();
                    }
                    else{
                        echo "repetido busco otro";
                    }

                    }while($flag);



        echo $numero." ".$string.'</br>';
    }
}






}




