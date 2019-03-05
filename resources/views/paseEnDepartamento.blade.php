@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Expedientes en Departamento</strong> {{$departamento->descripcion}}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Exp. Numero</th>
                            <th>Fecha</th>
                            <th>Origen</th>
                        </tr>
                    @foreach ($pases as $pase)
                        <tr>
                        <td>{{$pase->numero}}</td>
                        <td>{{$pase->fecha}}</td>
                        {{-- <td>{{$pase->diff}}</td> --}}
                        <td>
                            @isset($pase->destino)
                                {{$pase->destino}}
                            @endisset
                        </td>
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
