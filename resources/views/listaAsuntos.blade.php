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
