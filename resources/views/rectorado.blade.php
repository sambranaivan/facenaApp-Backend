@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Expedientes en Rectorado</div>

                <div class="card-body">

                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <td>N° de Expediente</td>
                                    {{-- <td>Hash</td> --}}
                                    <td>Detalle</td>
                                    <td>Está en ...</td>
                                    <td>... desde el:</td>
                                    <td>Pasaron <td>
                                    <td><td>
                                    <td><td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expedientes as $item)
                                    <tr>
                                    <td scope="row" style="width:8rem;">{{$item->numero}}</td>
                                    {{-- <td scope="row">{{$item->hash()}}</td> --}}
                                    <td scope="row">{{$item->detalle_asunto}}</td>
                                    <td>{{$item->getPases->last()->destino}}</td>
                                    <td style="width:6rem;">{{$item->getPases->last()->fecha}}</td>
                                    <td style="width:6rem;">{{$item->diff}} días</td>
                                    <td scope="row"><a name="" id="" class="btn btn-sm btn-primary btn-block" href="{{ route('movimientos', ['exp' => $item->numero]) }}" role="button">Ver Movimientos <span class="badge badge-light">{{$item->getPases->count()}}</span> </a></td>
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
