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
    {{-- <script src="{{ asset('js/filtable.js') }}" defer></script> --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> --}}
    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{{ asset('img/icon.png') }}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    {{-- atado con alambre --}}

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Alerta FACENA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                            @if(Auth::user()->permiso->superadmin)
                                            <a class="dropdown-item" href="{{ route('superadmin') }}">
                                            Configuración
                                            </a>
                                            @endif
                                            @if(Auth::user()->permiso->usuarios)
                                                <a class="dropdown-item"href="{{ route('usuarios') }}">
                                                Usuarios y Permisos
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->departamentos)
                                                <a class="dropdown-item"href="{{ route('departamentos') }}">
                                                Pases en Departamentos FaCENA
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->alertas)
                                                <a class="dropdown-item" href="{{ route('alertas') }}">
                                                    Notificación vía Mail a Departamentos
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->rectorado)
                                                <a class="dropdown-item" href="{{ route('rectorado') }}">
                                                    Pases a Rectorado
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->consejo)
                                                <a class="dropdown-item" href="{{ route('consejo') }}">
                                                    Actas de Consejo
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->notificaciones)
                                                <a class="dropdown-item" href="{{ route('notificaciones') }}">
                                                Alertas Móviles por Asunto
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->buscar_expediente)
                                                <a class="dropdown-item" href="{{ route('buscar_expediente') }}">
                                                    Seguimiento de Expedientes
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->listadoMails)
                                                <a class="dropdown-item" href="{{ route('listadoMails') }}">
                                                    Envio de Mails
                                                </a>
                                                @endif
                                                @if(Auth::user()->permiso->mapuche)
                                                <a class="dropdown-item"href="{{ route('mapuche') }}">
                                                    Vencimientos de Cargos
                                                </a>
                                            @endif

                                             <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       Salir
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
