@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pases enviados desde Rectorado</div>

                <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Expediente</th>
                                    <th>Descripcion</th>
                                    <th>Fecha</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Días</th>
                                    <th>Destino</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pases as $item)
                                    <tr>
                                    <td scope="row">{{$item->numero}}</td>
                                        <td scope="row">{{$item->getExpediente->detalle_asunto}}</td>
                                        <td scope="row">{{$item->fecha}}</td>
                                        <td scope="row">{{$item->fecha_ingreso}}</td>
                                        <td scope="row">{{$item->diff}}</td>
                                        <td scope="row">{{$item->destino}}</td>
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
