<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Alerta FACENA</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{{ asset('img/icon.png') }}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script>
    $(document).ready(function(){


       $("#volver").click(function(){
           window.close();
           window.history.back();
       })
    })
    </script>
</head>
<body>
    <div id="app">
        <main class="py-4">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header">
                <p>Expediente:<strong> N° {{$expediente->numero}}</strong></p>
            </div>
                <div class="card-body">
                    <p>
                        <strong>
                    {{$expediente->detalle_asunto}}
                    {{-- {{$expediente->hash()}} --}}
                    </p></strong>
                    <?php $item = $expediente->getPases->reverse()->first() ;?>
                    <p>en <strong>{{$item->destino}}</strong> desde el <strong>{{$item->fecha}}</strong></p>
                    <div class="text-center">
                            <a name="" id="volver" class="btn btn-primary" href="#" role="button">Cerrar</a>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
</div>


        </main>
    </div>
</body>
</html>

