@extends('layouts.app')

@section('content')
<div class="container">
<a name="" id="" class="btn btn-primary" href="{{route('newUser')}}" role="button">Crear Nuevo Usuario</a>
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>usuario</th>
            <th>departamentos</th>
            <th>superadmin</th>
            <th>alertas</th>
            <th>rectorado</th>
            <th>consejo</th>
            <th>notificaciones</th>
            <th>buscar_expediente</th>
            <th>listadoMails</th>
            <th>mapuche</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
            <tr>
            <td scope="row">{{$item->name}}</td>
            <th>
                @if($item->permiso->usuarios)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'usuarios','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'usuarios','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->departamentos)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'departamentos','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'departamentos','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->superadmin)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'superadmin','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'superadmin','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->alertas)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'alertas','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'alertas','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->rectorado)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'rectorado','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'rectorado','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->consejo)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'consejo','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'consejo','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->notificaciones)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'notificaciones','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'notificaciones','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->buscar_expediente)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'buscar_expediente','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'buscar_expediente','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->listadoMails)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'listadoMails','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'listadoMails','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
            <th>
                @if($item->permiso->mapuche)
                    <a name="" id="" class="btn-sm btn-block text-center btn-success" href="{{route('setPermision',['permision'=>'mapuche','user_id'=>$item->id,'status'=>0])}}" role="button">Otorgado</a>
                @else

                    <a name="" id="" class="btn-sm btn-block text-center btn-danger" href="{{route('setPermision',['permision'=>'mapuche','user_id'=>$item->id,'status'=>1])}}" role="button">Oculto</a>
                @endif
            </th>
        </tr>
        @endforeach


    </tbody>
</table>



</div>
@endsection
