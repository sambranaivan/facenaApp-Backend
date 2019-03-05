@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listado de Departamentos</div>

                <div class="card-body">

                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active">Active item</a>
                            <a href="#" class="list-group-item list-group-item-action">Item</a>
                            <a href="#" class="list-group-item list-group-item-action disabled">Disabled item</a>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
