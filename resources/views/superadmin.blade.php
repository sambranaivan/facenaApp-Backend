@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">SuperAdmin</div>

                <div class="card-body">
                    @if(Auth::user()->superadmin)
                    <form class="form" method="POST" action="updatefilters">
                        @csrf
                        <div class="form-group">
                            <label for="asuntos">Asuntos por defecto</label>
                            <input type="text" name="asuntos" id="" class="form-control" value="{{$config->filter}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>



                    @else
                        Acceso no Autorizado
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
