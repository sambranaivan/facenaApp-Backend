@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Expedientes en Rectorado</div>

                <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <td>N° de Expediente</td>
                                    <td>Actual</td>
                                    <td>Ultimo Movimiento</td>
                                    <td><td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expedientes as $item)
                                    <tr>
                                    <td scope="row">{{$item->numero}}</td>
                                    <td>{{$item->getPases->last()->destino}}</td>
                                    <td>{{$item->getPases->last()->fecha}}</td>
                                    <td scope="row"><a name="" id="" class="btn btn-small btn-primary btn-block" href="#" role="button">Ver Movimientos {{$item->getPases->count()}}</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
