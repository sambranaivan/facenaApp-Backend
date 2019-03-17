@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($error))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Ah ocurrido un error!.</strong> Verifique el codigo ingresado e intente de nuevo.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Seguimiento de Expedientes</div>

                    <div class="card-body">

                          <form class="form-inline" method="POST" action={{route('buscarExpediente')}}>
                              <div class="form-group" >
                                @csrf
                                  <label for="">Codigo de Seguimiento: </label>
                                  <input type="text" name="hash" id="" class="form-control" placeholder="hash" aria-describedby="helpId" required>
                                  {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                                  <button type="submit" class="btn btn-primary">Buscar</button>
                              </div>
                          </form>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
