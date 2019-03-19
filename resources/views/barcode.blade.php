@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Generar Etiquetas</div>

                <div class="card-body">

                    <form class="form-inline" method="POST" action={{route('barcode')}}>
                        @csrf
                        <div class="form-group">
                            <label for="">Desde 09-2019-</label>
                            <input type="number" name="numero" id="" step="1" max="99999" class="form-control" placeholder="00001" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Páginas</label>
                            <input type="number" name="paginas"  class="form-control" step="1" min="1" value="1" aria-describedby="helpId">
                        </div>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
