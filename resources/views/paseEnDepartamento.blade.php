@extends('layouts.app')

@section('content')
<script>
$(document).ready(function(){
  $("#buscar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tabla .r").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

$("#descargar_excel").click(function(){
                $("#tabla").table2excel({
                exclude: ".excludeThisClass",
                name: "Pagina 1",
                filename: "reporte_departamento" + new Date().toISOString().replace(/[\-\:\.]/g, ""), //do not include extension
            });
            })

});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Expedientes en Departamento</strong> {{$departamento->descripcion}}</div>

                <div class="card-body">
                {{--  --}}
                <div class="row">
                <div class="col-md-5">

                <input class="form-control form-control-sm" placeholder="buscar" id="buscar">
                </div>
                <div class="col-md-5">

                    <form method="post" action="{{route('endepartamentoFilter')}}" class="form text-center">
                            @csrf
                    <input type="hidden" name="departamento_id" value={{$departamento->codigo}}>
                            <div class="form-row ">
                                <div class="col-md-2">
                                <label for="my-input">Desde</label>
                                </div>
                                <div class="col-md-10">
                                    <input id="my-input"
                                    @if(isset($desde))
                                        value={{$desde}}
                                    @endif

                                    class="form-control form-control-sm" type="date" name="desde" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="my-input">Hasta</label>
                                </div>
                                <div class="col-md-10">
                                    <input id="my-input"
                                    @if(isset($hasta))
                                        value={{$hasta}}
                                    @endif
                                    class="form-control form-control-sm" type="date" name="hasta" required>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar por fechas</button>
                    </form>

                    </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-sm" id="descargar_excel"><i class="fa fa-file-excel" aria-hidden="true"></i>&nbsp;Descargar Excel</button>
                </div>
                </div>
                    <table class="table" id="tabla">
                        <thead>
                            <th>Exp. Numero</th>
                            <th>Fecha de Ingreso</th>
                            <th>Asunto</th>
                            <th>Durante</th>
                        </thead>
                    @foreach ($pases as $pase)
                        <tr class="r">
                        <td>{{$pase->numero}}</td>
                        <td>{{$pase->fecha_ingreso}}</td>
                        <td>
                            {{-- @isset($pase->getExpediente->getAsunto->descripcion)
                                {{$pase->getExpediente->getAsunto->descripcion}}
                            @endisset --}}
                             @isset($pase->getExpediente->detalle_asunto)
                                {{$pase->getExpediente->detalle_asunto}}
                            @endisset
                        </td>
                        <td>{{$pase->diff}} Días</td>


                        </tr>
                    @endforeach
                    </table>
                    {{-- {{ $pases->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
