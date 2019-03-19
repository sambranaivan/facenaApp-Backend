<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DNS1D;
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



    /**
     * codigo de barras
     */

    //
    public function print()
    {
        // $desde = $request->desde;
        // $paginas = $request->paginas;
        echo '<style>
        body {
        background: rgb(204,204,204);
        font-family:verdana;
        font-size:10px;
        }
        .numero{
            font-size:12px;
        }
        page {
        background: white;
        display: block;
        margin: 0 auto;
        //   margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        page[size="A4"] {
        width: 21.6cm;
        height: 27.9cm;
        }
        page[size="A4"][layout="landscape"] {
        width: 27.9cm;
        height:  21.6cm;
        }
        page[size="A3"] {
        width: 29.7cm;
        height: 42cm;
        }
        page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29.7cm;
        }
        page[size="A5"] {
        width: 14.8cm;
        height: 21cm;
        }
        page[size="A5"][layout="landscape"] {
        width: 21cm;
        height: 14.8cm;
        }

        .etiqueta{
            width: 5.4cm;
            height: 2.54cm;
            float:left;
            display:block;
            // border:1px solid black;
            text-align:center;
        }

        .etiqueta .contains{
            width:90%;
            margin:5%;
            height:90%;
        }
        @media print {
        body, page {
            margin: 0;
            box-shadow: 0;
        }


        }</style>';
        echo '<page size="A4">';

// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($numero, "C128",1,40,array(1,1,1),true) . '" alt="barcode"  title="name" />';
    for ($i=10; $i < 54; $i++)
    {
        $numero = '09-2019-000'.$i;
                $hash = str_replace("-","",$numero);
//         ///integer to base 36
        $hash = strtoupper(base_convert($hash,10,36));
//         echo"</br>";
//         echo $numero;
// echo"</br>";
//         echo $hash;
    echo '<div class="etiqueta"><div class="contains">
    <span>Facultad de Ciencias Exactas</span>
     <img src="data:image/png;base64,' . DNS1D::getBarcodePNG($numero, "C128",1.05,40,array(1,1,1),true) . '" alt="barcode"  title="name" />
    <span class="numero"><strong>'.$numero.'</strong></span></br>
    <span class="hash">'.$hash.'</span>
     </div>
     </div>';
    }

echo '</page>';
    }
}




