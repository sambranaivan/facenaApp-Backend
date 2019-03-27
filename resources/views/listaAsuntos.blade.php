@extends('layouts.app')

<style>
    #buscar{
         background-image: url('/css/searchicon.png'); Add a search icon to input
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
    }
    </style>
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
                $.get("{{route('subscribe')}}",{asunto:asunto},function(data){
                console.log(data);
                if(data == 'registrado'){
                    boton.html("desactivar").removeClass('btn-success').addClass('btn-danger');
                    boton.data('status','desactivar');

                }
            })
            }
            else
            {
                 $.get("{{route('unsubscribe')}}",{asunto:asunto},function(data){
                console.log(data);
                if(data == 'unsubscribe ok'){
                    boton.html("Activar").removeClass('btn-danger').addClass('btn-success');
                    boton.data('status','activar');

                }
            })}

        })

        $("#buscar").keyup(function ()
        {
            filtrar();
        })
    // /
    function filtrar() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscar");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabla-asuntos");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
            }


    })
</script>
<div class="container">
{{-- <div class="row">
    <div class="col-md-4 offset-md-8 text-right">
        <button type="button" name="" id="" class="btn btn-primary" data-toggle="modal" data-target="#claveModal">Vincular con Aplicación Movil</button>
    </div>
</div> --}}
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
    <div class="card text-left">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h4>Activar y Desactivar Alertas
                    @if($filtro)
                    <a class="btn btn-success" href="{{route('notificaciones_todos')}}">Ver todos</a>
                    @else
                        <a class="btn btn-success" href="{{route('notificaciones')}}">Ver más usados</a>
                    @endif</h4>
                </div>
                <div class="col-md-4  text-right">
                    <button type="button" name="" id="" class="btn btn-primary" data-toggle="modal" data-target="#claveModal">Vincular con Aplicación Movil</button>
                </div>
            </div>

        </div>
            <div class="card-body">
<input type="text" id="buscar" placeholder="Buscar.." >
            <table class="table table-sm" id="tabla-asuntos">
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Noticaciones

                    </th>
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
                                    <button class="btn btn-sm btn-danger subscribe" data-status="desactivar" data-ref="{{ $item->codigo }}">desactivar</button>
                                @else
                                    <button class="btn btn-sm btn-success subscribe" data-status="activar" data-ref="{{ $item->codigo }}">Activar</button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
            </table>
            </div>

    </div>


</div>
@endsection
