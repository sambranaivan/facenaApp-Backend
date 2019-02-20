@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function(){

        console.log("ready");


        $(".subscribe").click(function(){
            boton = $(this);
            asunto = boton.data('ref');
            estado = boton.data('status');

            if(estado == 'activar')
            {
                $.get('subscribe',{asunto:asunto},function(data){
                console.log(data);
                if(data == 'registrado'){
                    boton.html("Desactivar").removeClass('btn-success').addClass('btn-danger');
                    boton.data('status','desactivar');

                }
            })
            }
            else
            {
                 $.get('unsubscribe',{asunto:asunto},function(data){
                console.log(data);
                if(data == 'unsubscribe ok'){
                    boton.html("Activar").removeClass('btn-danger').addClass('btn-success');
                    boton.data('status','activar');

                }
            })}

        })



    })
</script>
<div class="container">
<div class="row">
    <div class="col-md-4 offset-md-8 text-right">
        <button type="button" name="" id="" class="btn btn-primary" data-toggle="modal" data-target="#claveModal">Vincular con Aplicación Movil</button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="claveModal" tabindex="-1" role="dialog" aria-labelledby="claveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="claveModalLabel">Clave de vinculación para Aplicación Movil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <h1>{{$clave}}</h1>
      </div>

    </div>
  </div>
</div>
    <table class="table table-sm">
    	<tr>
    		<th>Codigo</th>
    		<th>Descripcion</th>
    		<th>Noticaciones</th>
    	</tr>
@foreach ($asuntos as $item)
	<tr>
		<td>{{ $item->codigo }}</td>
		<td>{{ $item->descripcion}}</td>
		<td>
            @php
                $aux = false;
            @endphp
            @foreach ($subs as $sub)
                {{-- {{$sub->id}} --}}
                @if ($sub->asunto_id == $item->codigo)
                    @php
                        $aux = true;
                    @endphp
                @endif
            @endforeach
            @if ($aux)
                <button class="btn btn-sm btn-danger subscribe" data-status="desactivar" data-ref="{{ $item->codigo }}">Descativar</button>
            @else
                 <button class="btn btn-sm btn-success subscribe" data-status="activar" data-ref="{{ $item->codigo }}">Activar</button>
            @endif
        </td>

	</tr>
@endforeach
    </table>


</div>
@endsection
