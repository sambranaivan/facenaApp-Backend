@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Pases Por Tomar</strong> {{$departamento->descripcion}}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Exp. Numero</th>
                            <th>Fecha Ingreso</th>
                            <th>Días en Espera</th>
                            <th>Último Destino</th>
                        </tr>
                    @foreach ($pases as $pase)
                        <tr>
                        <td>{{$pase->numero}}</td>
                        <td>{{$pase->fecha_ingreso}}</td>
                        <td>{{$pase->diff}}</td>
                         <td>
                            @isset($pase->origen)
                                {{$pase->origen->descripcion}}
                            @endisset
                        </td>
                        </tr>
                    @endforeach
                    </table>
                    {{-- {{$pases->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
