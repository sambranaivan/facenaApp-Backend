@extends('layouts.app')

@section('content')

    <script>
    $(document).ready(function(){
            $("#descargar_1").click(function(){
                $("#tabla_1").table2excel({
                exclude: ".excludeThisClass",
                name: "Pagina 1",
                filename: "reporte_rectorado_" + new Date().toISOString().replace(/[\-\:\.]/g, ""), //do not include extension
            });
            })

             $("#descargar_2").click(function(){
                $("#tabla_2").table2excel({
                exclude: ".excludeThisClass",
                name: "Pagina 1",
                filename: "reporte_rectorado_" + new Date().toISOString().replace(/[\-\:\.]/g, ""), //do not include extension
            });
            })
    })
</script>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">

                            <h4 class="card-title">Expedientes en Rectorado</h4>
                        </div>
                        <div class="col-md-2">
                            <a name="" id="descargar_1" class="btn btn-success" href="#" role="button"><strong>Descargar Excel </strong><i class="far fa-file-excel"></i></a>
                        </div>
                    </div>

                </div>

                <div class="card-body">

                        <table class="table table-sm table-striped" id="tabla_1">
                            <thead>
                                <tr>
                                    {{-- <td>N° de Expediente</td>

                                    <td>Detalle</td>

                                    <td>... desde el:</td>

                                    <td>Estado<td>
                                    <td>Pasaron <td> --}}
                                        <th>N° de Expediente</th>
                                        <th>Asunto</th>
                                        <th>Detalle</th>
                                        <th>.. Desde el</th>
                                        <th>Estado</th>
                                        <th>Pasaron</th>
                                        <th class="excludeThisClass"></th>
                                        <th class="excludeThisClass"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expedientes as $item)

                                    @if($item->getPases->last()->codigo_destino == 983)
                                    {{-- FILTRO AQUELLOS EXPEDIENTE QUE SU ULTIMO PASE SE RECTORADO --}}
                                    <tr>
                                    <td scope="row" style="width:8rem;">{{$item->numero}}</td>
                                    {{-- <td scope="row">{{$item->hash()}}</td> --}}
                                       @if($item->getAsunto)

                                    <td scope="row" colspan="1">{{$item->getAsunto->descripcion}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td scope="row">{{$item->detalle_asunto}}</td>
                                    {{-- <td>{{$item->getPases->last()->destino}}</td> --}}
                                    <td style="width:6rem;">{{$item->getPases->last()->fecha}}</td>
                                    {{-- <td style="width:6rem;">{{$item->getPases->last()->fecha_ingreso}}</td>
                                    <td style="width:6rem;">{{$item->getPases->last()->fecha_salida}}</td> --}}
                                    @if($item->getEstado() == "no-recibido")
                                        <td  scope="row" class="bg-danger" style="width:6rem;">No Recibido</td>
                                    @elseif($item->getEstado() == "recibido")
                                        <td  scope="row" class="bg-warning" style="width:6rem;">Recibido</td>
                                    @elseif($item->getEstado() == "tratandose")
                                        <td scope="row"  class="bg-success" style="width:6rem;">Tratándose</td>
                                    @endif


                                    <td scope="row" style="width:6rem;">{{$item->diff}} días</td>
                                    <td scope="row" class="excludeThisClass"><a name="" id="" class="btn btn-sm btn-primary btn-block" href="{{ route('movimientos', ['exp' => $item->numero]) }}" role="button">Ver Movimientos <span class="badge badge-light">{{$item->getPases->count()}}</span> </a></td>
                                    @if($item->seguido())
                                    <td scope="row" class="excludeThisClass"><a name="" id="" class="btn btn-sm btn-secondary btn-block" href="{{ route('unFollow', ['exp' => $item->numero]) }}" role="button">Dejar de Seguir</a></td>
                                    @else
                                    <td scope="row" class="excludeThisClass"><a name="" id="" class="btn btn-sm btn-primary btn-block" href="{{ route('seguirExpediente', ['exp' => $item->numero]) }}" role="button">Seguir</a></td>
                                    @endif
                                    {{-- <td scope="row"><a class="btn btn-sm btn-primary btn-block" href="#">Seguimiento</a></td> --}}
                                    </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>

                </div>
            </div>

             <div class="card">
                <div class="card-header">
                 <div class="row">
                     <div class="col-md-10">

                            <h4 class="card-title">Expedientes que regresaron de rectorado</h4>
                        </div>
                        <div class="col-md-2">
                            <a name="" id="descargar_2" class="btn btn-success" href="#" role="button"><strong>Descargar Excel </strong><i class="far fa-file-excel"></i></a>
                        </div>
                 </div>
                </div>

                <div class="card-body">

                        <table class="table table-sm table-striped" id="tabla_2">
                            <thead>
                                <tr>
                                    <th>N° de Expediente</th>
                                    {{-- <th>Hash</th> --}}
                                    <th>Asunto</th>
                                    <th>Detalle</th>
                                    <th>Esta en</th>
                                    <th>Regreso de rectorado el</th>
                                    <th>Pasaron <th>
                                    {{-- <th><th> --}}
                                    <th class="excludeThisClass"><th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expedientes as $item)
                                    @if($item->getPases->last()->codigo_destino !== 983)
                                    {{-- FILTRO AQUELLOS EXPEDIENTE QUE SU ULTIMO PASE SE RECTORADO --}}
                                    <tr>
                                    <td scope="row" style="width:8rem;">{{$item->numero}}</td>
                                    {{-- <td scope="row">{{$item->hash()}}</td> --}}
                                    @if($item->getAsunto)

                                    <td scope="row" colspan="1">{{$item->getAsunto->descripcion}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td scope="row">{{$item->detalle_asunto}}</td>
                                    <td>{{$item->getPases->last()->destino}}</td>
                                    {{-- <td style="width:6rem;">{{$item->getPases->last()->fecha}}</td> --}}
                                    <td style="width:6rem;">{{$item->since(983)[1]->fecha_salida}}</td>
                                    {{-- <td style="width:6rem;">{{$item->diff}} días</td> --}}
                                    <td style="width:6rem;">{{$item->since(983)[0]}} días</td>
                                    <td scope="row" class="excludeThisClass"><a name="" id="" class="btn btn-sm btn-primary btn-block" href="{{ route('movimientos', ['exp' => $item->numero]) }}" role="button">Ver Movimientos <span class="badge badge-light">{{$item->getPases->count()}}</span> </a></td>
                                    {{-- <td scope="row"><a class="btn btn-sm btn-primary btn-block" href="#">Seguimiento</a></td> --}}
                                    </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
