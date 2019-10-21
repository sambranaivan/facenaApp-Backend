@extends('layouts.app')

@section('content')

    <script>

        function filtrar(val){
            console.log(val.value);
                                var value = val.value.toLowerCase();
                                $("#tabla_body tr").filter(function() {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                });
        }
    $(document).ready(function(){
            $("#descargar_1").click(function(){
                $("#tabla_1").table2excel({
                exclude: ".excludeThisClass",
                name: "Pagina 1",
                filename: "reporte_consejo" + new Date().toISOString().replace(/[\-\:\.]/g, ""), //do not include extension
            });
            })
});





</script>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">

                            <h4 class="card-title">Expedientes en Secretaria de actas de Consejo Directivo</h4>
                        </div>
                        <div class="col-md-2">
                            <a name="" id="descargar_1" class="btn btn-success" href="#" role="button"><strong>Descargar Excel </strong><i class="far fa-file-excel"></i></a>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    {{--  --}}
                    <form class="form-inline">
                        <div class="form-group">
                      <label for="">Estado: </label>
                      <select class="form-control" name="" id="buscador" onchange="filtrar(this)">
                        <option value="">-Todos-</option>
                        <option value="En Secretaría">En Secretaría</option>
                        <option value="Por Ingresar">Por Ingresar</option>
                      </select>
                    </div>
                    </form>
                    {{--  --}}
                        <table class="table table-sm table-striped" id="tabla_1">
                            <thead>
                                <tr>
                                        <th>N° de Expediente</th>
                                        <th>Expedientes Agregados</th>
                                        <th>Detalle</th>
                                        <th>Iniciador</th>
                                        <th>Iniciado el</th>
                                        <th>Estado</th>
                                        <th>Desde el</th>
                                        <th>Pasaron</th>
                                        <th class="excludeThisClass"></th>
                                        <th class="excludeThisClass"></th>

                                </tr>
                            </thead>
                            <tbody id="tabla_body">
                                @foreach ($expedientes as $item)
                                    @if($item->getPases->last()->codigo_destino == 916)

                                    <tr>
                                    <td scope="row" style="width:8rem;">{{$item->numero}}</td>
                                    {{-- <td scope="row">{{$item->hash()}}</td> --}}
                                    {{-- @if($item->getAsunto)

                                    <td scope="row" colspan="1">{{$item->getAsunto->descripcion}}</td>
                                    @else
                                    <td></td>
                                    @endif --}}
                                    <td scope="row" class="text-center">
                                        {{-- @if ($item->agregados->count())
                                        @foreach ($item->agregados as $a)
                                            {{$a->numero_agregado}}
                                        @endforeach
                                            @else
                                            --
                                        @endif --}}
                                        
                                    </td>
                                    <td scope="row">{{$item->detalle_asunto}}</td>
                                     <td>{{$item->detalle_iniciador}}</td>
                                    <td>{{$item->fecha}}</td>
                                    {{-- <td>{{$item->getPases->last()->destino}}</td> --}}
                                    {{-- <td style="width:6rem;">{{$item->getPases->last()->fecha_ingreso}}</td>
                                    <td style="width:6rem;">{{$item->getPases->last()->fecha_salida}}</td> --}}
                                    @if($item->getConsejo() == "no-recibido")
                                    <td  scope="row" class="" style="width:6rem;">Por Ingresar</td>
                                    @elseif($item->getConsejo() == "recibido")
                                    <td  scope="row" class="" style="width:6rem;">En Secretaría</td>
                                    @elseif($item->getConsejo() == "tratandose")
                                    <td scope="row"  class="" style="width:6rem;">Tratándose</td>
                                    @else
                                    <td scope="row"  class="" style="width:6rem;">{{$item->getConsejo()}}</td>
                                    @endif

                                    <td style="width:6rem;">{{$item->getPases->last()->fecha}}</td>

                                    <td scope="row" style="width:6rem;">{{$item->diff}} días</td>
                                    <td scope="row" class="excludeThisClass"><a name="" id="" class="btn btn-sm btn-primary btn-block" href="{{ route('movimientos', ['exp' => $item->numero]) }}" role="button">Pases<span class="badge badge-light">{{$item->getPases->count()}}</span> </a></td>
                                    @if($item->seguido())
                                    {{-- <td scope="row" class="excludeThisClass"><a name="" id="" class="btn btn-sm btn-secondary btn-block" href="{{ route('unFollow', ['exp' => $item->numero]) }}" role="button">Dejar de Seguir</a></td> --}}
                                    @else
                                    {{-- <td scope="row" class="excludeThisClass"><a name="" id="" class="btn btn-sm btn-primary btn-block" href="{{ route('seguirExpediente', ['exp' => $item->numero]) }}" role="button">Seguir</a></td> --}}
                                    @endif
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
