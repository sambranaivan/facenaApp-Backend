<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Departamento;
use App\Alarma;
use DB;
class AlarmaController extends Controller
{
    //
    public function alertas(){

        //busco todo los departamentos
        $departamentos = Departamento::all()->sortBy('codigo');

        return view('crearAlerta')
        ->with('departamentos',$departamentos)->with('editar',false)
        ;
    }

    public function verAlertaDetalle(Request $request){
         //busco todo los departamentos
        $dpto = Departamento::find($request->dpto_id);
        $departamentos = Departamento::all()->sortBy('codigo');


        // buscar si hay registro de alarmas
        $alarmas = Alarma::where('departamento',$dpto->codigo)->count();
        //si hay cargo para editar
        if($alarmas)
        {

            $alarma_1 = Alarma::where('departamento',$dpto->codigo)->where('tipo',1)->first();
            $alarma_2 = Alarma::where('departamento',$dpto->codigo)->where('tipo',2)->first();
            return view('crearAlerta')
            ->with('departamentos',$departamentos)
            ->with('editar',true)
            ->with('alarma_1',$alarma_1)
            ->with('alarma_2',$alarma_2)
            ->with('selected',$dpto);
        }
        else
        {
            return view('crearAlerta')
            ->with('departamentos',$departamentos)
            ->with('editar',true)
            ->with('selected',$dpto);
        }





    }

     public function editarAlerta(Request $request){
         ///

        $dpto = Departamento::find($request->dpto_id);
        $departamentos = Departamento::all()->sortBy('descripcion');
   // buscar si hay registro de alarmas
        $count = Alarma::where('departamento',$dpto->codigo)->count();
        ////recibo registro
        if($count)
        {
            $a_1 = Alarma::where('departamento',$dpto->codigo)->where('tipo',1)->first();
            $a_2 = Alarma::where('departamento',$dpto->codigo)->where('tipo',2)->first();
        }
        else {
            $a_1 = new Alarma();
            $a_2 = new Alarma();
        }

        $a_1->departamento = $request->dpto_id;
        $a_1->amarillo = $request->amarillo_1;
        $a_1->rojo = $request->rojo_1;
        $a_1->email = $request->email_1;
        $a_1->escalar = $request->escalar_1;
        $a_1->tipo = 1;
        $a_1->save();
        $a_2->departamento = $request->dpto_id;
        $a_2->amarillo = $request->amarillo_2;
        $a_2->rojo = $request->rojo_2;
        $a_2->email = $request->email_2;
        $a_2->escalar = $request->escalar_2;
        $a_2->tipo = 2;
        $a_2->save();
        //
        //    return view('crearAlerta')
        //     ->with('departamentos',$departamentos)
        //     ->with('editar',true)
        //     ->with('alarma_1',$a_1)
        //     ->with('alarma_2',$a_2)
        //     ->with('selected',$dpto)
        //     ->with('updated',true);
        return redirect('/superadmin/listaAlertas');

    }

    public function verListado()
    {
        $q = DB::select('SELECT DISTINCT departamento from alarmas');
        $d = [];

        foreach ($q as $dpto) {
            $d[] = Departamento::find($dpto->departamento);
        }


        return view('listadoAlertas')->with('departamentos',$d);
    }
}
