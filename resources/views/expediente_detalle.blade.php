@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header">
                <p>Expediente:<strong> N° {{$expediente->numero}}</strong></p>
            <p><strong>
                {{$expediente->detalle_asunto}}
                {{-- {{$expediente->hash()}} --}}
            </p></strong>
              <?php $item = $expediente->getPases->reverse()->first() ;?>
            <p>en <strong>{{$item->destino}}</strong> desde el <strong>{{$item->fecha}}</strong></p>
            </div>


            </div>
        </div>
    </div>
</div>
@endsection
