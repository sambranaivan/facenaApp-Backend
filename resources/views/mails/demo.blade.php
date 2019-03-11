
@if($mail->tipo)
<p>Reporte Semanal de Pases para el Departamento {{$demo[0]->destino}}</p>



<table class="table">
    <thead>
        <tr>
            <th>Expediente</th>
            <th>Asunto</th>
            <th>Fecha Ingreso</th>
            <th>Dias</th>
            <th>Origen</th>
        </tr>
    </thead>
    <tbody>
@foreach ($demo as $item)

                <tr>
                    <td scope="row">{{$item->numero}}</td>
                    <td scope="row">{{$item->getExpediente->detalle_asunto}}</td>
                    <td scope="row">{{$item->fecha_ingreso}}</td>
                    <td scope="row"
                    @if($item->color == 'red')
                style="background-color: red; color:white; text-aling:center"
                @elseif($item->color == 'yellow')
                style="background-color: yellow; text-aling:center"
                @else
                style="background-color: white; text-aling:center"
                @endif
                    >{{$item->diff}}</td>
                    <td scope="row">{{$item->origen->codigo}} - {{$item->origen->descripcion}}</td>
                </tr>

@endforeach
    </tbody>
</table>
Gracias,
<br/>

@else
Este es un Mail de Prueba

@endif
