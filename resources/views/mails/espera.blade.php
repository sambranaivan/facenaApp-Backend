

<p>Reporte Semanal de Pases en espera de ser ingresados al Departamento <strong>{{$demo[0]->destino}}</strong></p>

<table class="table" style="border:1px solid black">
    <thead>
        <tr>
            <th>Expediente</th>
            <th>Asunto</th>
            <th>Desde el</th>
            <th>Durante</th>
            <th>Origen</th>
        </tr>
    </thead>
    <tbody style="font-size: 0.8em;">
@foreach ($demo as $item)

                <tr>
                    <td scope="row" style="  border: 1px solid black;">{{$item->numero}}</td>
                    <td scope="row" style="  border: 1px solid black;">{{$item->fecha}}</td>
                    <td scope="row" style="  border: 1px solid black;">{{$item->getExpediente->detalle_asunto}}</td>
                    <td scope="row"
                    @if($item->color == 'red')
                style="background-color: red; color:white; text-aling:center;  border: 1px solid black;"
                @elseif($item->color == 'yellow')
                style="background-color: yellow; text-aling:center;  border: 1px solid black;"
                @elseif($item->color == 'white')
                style="background-color: white; text-aling:center;  border: 1px solid black;"
                @endif
                    ><strong>{{$item->diff}}</strong> Días</td>
                    <td scope="row" style="  border: 1px solid black;">{{$item->origen->codigo}} - {{$item->origen->descripcion}}</td>
                </tr>

@endforeach
    </tbody>
</table>
Gracias
<br/>

