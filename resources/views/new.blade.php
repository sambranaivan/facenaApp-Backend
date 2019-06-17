@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo Usuario</div>

                <div class="card-body">

                <form class="form" action="{{route('createUser')}}" method="POST">
                @csrf

                    <div class="form-group">
                      <label for="">Nombre de Usuario</label>
                      <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                      {{--  --}}
                      <label for="">Direccion de Email</label>
                      <input type="email" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                      {{--  --}}
                      <label for="">Contraseña</label>
                      <input type="password" name="password" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
