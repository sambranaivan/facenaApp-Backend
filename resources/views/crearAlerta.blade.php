@extends('layouts.app')

@section('content')
<script>
$(document).ready(function(){

$('#select_departamento').change(function(){
   var dpto_id = ($(this).children('option:selected').val());
$("#dpto_id").val(dpto_id);
  $("#form_departamento").submit();
// console.log(dpto_id)
})




})
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Configurar Alertas
                </div>

                <div class="card-body">
                    <form class="form" method="POST" id="form_departamento">
                        @csrf
                        <input type="hidden" id="dpto_id" name="dpto_id" value="nonoononne">
                    <div class="form-group">
                        <label for="departamento">Selecciona Departamento</label>
                        <select class="form-control" name="departamento" id="select_departamento">
                        <option
                        @if (!$editar){
                            selected
                        }
                        @endif
                        ></option>
                        @foreach ($departamentos as $dpto)
                            <option value="{{$dpto->codigo}}"
                                @if($editar)
                                    @if($selected->codigo == $dpto->codigo)
                                    selected
                                    @endif
                                @endif
                                >{{$dpto->codigo." - ".$dpto->descripcion}}</option>
                        @endforeach

                        </select>
                    </div>
                </form>
                </div>
                @if ($editar)

                            <div class="card-body">
                                <form class="form" action="./editarAlerta" method="POST" id="form">
                                    @csrf
                                <div class="card-header">
                                    Configurar Alertas de Pases en espera de ser tomadas
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Escalar a</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label>1° Aviso</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label>2° Aviso</label>
                                    </div>
                                </div>

                                <div class="row">
                                <input type="hidden" name="dpto_id" value="{{$selected->codigo}}" >
                                    <div class="col-md-4">
                                        <input  class="form-control " type="email" name="email_1" id=""
                                        @isset($alarma_1)
                                            value="{{$alarma_1->email}}"
                                        @endisset
                                        required>
                                    </div>
                                    <div class="col-md-4">
                                        <input  class="form-control " type="email" name="escalar_1" id=""
                                         @isset($alarma_1)
                                            value="{{$alarma_1->escalar}}"
                                        @endisset
                                        required>
                                    </div>
                                    <div class="col-md-2">
                                        <input  class="form-control bg-warning" type="number" min=0 step=1 name="amarillo_1" id="" placeholder="Días"
                                         @isset($alarma_1)
                                            value="{{$alarma_1->amarillo}}"
                                        @endisset
                                        required>
                                    </div>
                                    <div class="col-md-2">
                                        <input  class="form-control bg-danger text-white" type="number" min=0 step=1 name="rojo_1" id="" placeholder="Días"
                                         @isset($alarma_1)
                                            value="{{$alarma_1->rojo}}"
                                        @endisset
                                        required>
                                    </div>
                                </div>
                                <div class="card-header">
                                    Configurar Alertas Expedientes aun en Departamento
                                </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Escalar a</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>1° Aviso</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>2° Aviso</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input  class="form-control " type="email" name="email_2" id=""
                                             @isset($alarma_2)
                                            value="{{$alarma_2->email}}"
                                        @endisset
                                            required>
                                        </div>
                                        <div class="col-md-4">
                                            <input  class="form-control "type="email" name="escalar_2" id=""
                                             @isset($alarma_2)
                                            value="{{$alarma_2->email}}"
                                        @endisset
                                            required>
                                        </div>
                                        <div class="col-md-2">
                                            <input  class="form-control bg-warning"type="number" min=0 step=1 name="amarillo_2" id="" placeholder="Días"
                                             @isset($alarma_2)
                                            value="{{$alarma_2->amarillo}}"
                                        @endisset
                                            required>
                                        </div>
                                        <div class="col-md-2">
                                            <input  class="form-control bg-danger text-white"type="number" min=0 step=1 name="rojo_2" id="" placeholder="Días"
                                             @isset($alarma_2)
                                            value="{{$alarma_2->rojo}}"
                                        @endisset
                                            required>
                                        </div>
                                    </div>
                                    <div class="row"  style="padding-top: 10px;">

                                        <div class="col-md-12 text-right ">

                                            <button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                </div>

                @endif

        </div>
    </div>
</div>
@endsection
