@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listado de Mails</div>

                <div class="card-body">

                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Para</th>
                                  <th>Asunto</th>
                                  <th>Día</th>
                                  <th>Hora</th>
                                  <th>Editar</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($mails as $item)
                                    <tr>
                                        <th>{{$item->para}}</th>
                                        <th>{{$item->asunto}}</th>
                                        <th>{{$item->day_of_week}}</th>
                                        <th>{{$item->hour}}</th>
                                        <th>
                                        <a name="" id="" class="btn btn-primary" href="{{route('editarMail',['id'=>$item->id])}}" role="button">Editar</a>
                                        </th>
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
