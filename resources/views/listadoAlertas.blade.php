@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h2>Alertas</h2>
                        </div>
                        <div class="col-md-2">
                            <a name="" id="" class="btn btn-primary" href="./alertas" role="button">
                                Nuevo
                            </a>
                        </div>
                    </div>

                </div>
    <div class="card">
        <div class="card-body">



        <ul class="list-group list-group-flush">


            @foreach ($departamentos as $item)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-10">
                             {{$item->codigo}} - {{$item->descripcion}}
                        </div>
                        <div class="col-md-2">
                           <form method="post" action="./alertas">
                            @csrf
                           <input type="hidden" name="dpto_id" value="{{$item->codigo}}">
                            <button class="btn btn-small btn-success">
                                    Editar <i class="fas fa-edit"></i>
                            </button>
                           </form>
                        </div>

                    </div>
                </li>

            @endforeach
        </ul>
        </div>
    </div>

            </div>
        </div>
    </div>
</div>
@endsection
