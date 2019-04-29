@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
<div class="row">
                    <div class="col-md-10">
                        Listado de Mails
                    </div>
                    <div class="col-md-2">
                    <a name="" id="" class="btn btn-primary" href="{{route('editorMail')}}" role="button">Nuevo</a>
                    </div>
                </div>

                </div>

                <div class="card-body">

                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Para</th>
                                  <th>Asunto</th>
                                  <th>Día</th>
                                  <th>Hora</th>
                                  <th>Editar</th>
                                  <th>Borrar</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($mails as $item)
                                    <tr>
                                        <td>{{$item->para}}</td>
                                        <td>{{$item->asunto}}</td>
                                        <td>{{$item->letras}}</td>

                                        <td class="text-center">{{$item->hour}}:00 Hs</td>
                                        <td>
                                        <a name="" id="" class="btn btn-primary" href="{{route('editarMail',['id'=>$item->id])}}" role="button">Editar</a>
                                        </td>
                                        <td>
                                        <a name="" id="" class="btn btn-danger" href="{{route('borrarMail',['id'=>$item->id])}}" role="button">Borrar</a>
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
