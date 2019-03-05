@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Listado de Departamentos</div>

                <div class="card-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Departamento</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($departamentos as $item)
                                    <tr>
                                        <td>
                                            {{$item->codigo}}
                                        </td>
                                        <td>
                                            {{$item->descripcion}}
                                        </td>
                                        <td>
                                            <a class="btn btn-small btn-primary" href="{{ route('pasesportomar',['departamento_id'=>$item->codigo]) }}" role="button">Pases en Espera</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-small btn-primary" href="{{ route('endepartamento',['departamento_id'=>$item->codigo]) }}" role="button">Pases en Departamento</a>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                                </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection

