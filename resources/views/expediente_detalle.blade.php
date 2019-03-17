@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">Expediente:<strong> N° {{$expediente->numero}}</strong>
            <h2>
                {{$expediente->detalle_asunto}}
                {{-- {{$expediente->hash()}} --}}
            </h2>
            </div>

                <div class="card-body">

                        <table class="table table-sm" style="font-size:0.8em">
                            <thead>
                                <tr>
                                    <td>Registro</td>
                                    {{-- <td>numero</td> --}}
                                    <td>Ultimo Movimiento</td>
                                    {{-- <td>fecha_ingreso</td>
                                    <td>fecha_salida</td> --}}
                                    <td>Desde</td>
                                    <td></td>
                                    <td>Hacia</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $item = $expediente->getPases->reverse()->first() ;?>

                                    <tr>
                                        <td>{{$item->registro}}</td>
                                        {{-- <td>{{$item->numero}}</td> --}}
                                        <td>{{$item->fecha}}</td>
                                        {{-- <td>{{$item->fecha_ingreso}}</td>
                                        <td>{{$item->fecha_salida}}</td> --}}
                                        @if($item->ultimo_destino)
                                        <td>{{$item->ultimo_destino}}-{{$item->origen->descripcion}}</td>
                                        @else
                                        <td>-</td>
                                        @endif
                                        <td><i class="fas fa-arrow-right"></i></td>
                                        <td>{{$item->codigo_destino}}-{{$item->destino}}</td>
                                    </tr>
                                {{-- @endforeach --}}

                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
