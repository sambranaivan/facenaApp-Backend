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

       $("#buscar").click(function(){
            window.open("http://alerta.exa.unne.edu.ar/alertafacena/public/expediente/"+$("#hash").val(),
        "Expediente",
        "toolbar=no,scrollbars=no,menubar=no,resizable=no,top=auto,location=no,left=auto,width=500,height=300");
       })
    })
    </script>
</head>
<body>
    <div id="app">

<div class="container-fluid">
   <div class="row" style="padding-top: 5px;">
    <div class="col-md-12">
    <img src="{{asset('img/buscador.png')}}" class="img-fluid" alt="">
    </div>
    <div class="col-md-12">
        <div class="form-inline ">
                              {{-- <div class="form-group text-center" > --}}
                                  {{-- <label for="hash">Código de Seguimiento: </label> --}}
                                  <input style="font-size: 0.9em; width:110px;" type="text" name="hash" id="hash" class="form-control form-control-sm" placeholder="Código" aria-describedby="helpId" required>
                                  {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                                  <button id="buscar" type="submit" class="btn btn-primary btn-sm">
                                      <i class="fa fa-search" aria-hidden="true"></i>
                                  </button>
                              {{-- </div> --}}
                            </div>
    </div>
   </div>
</div>



    </div>
</body>
</html>
