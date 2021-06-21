<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Home') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/carrinho.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estampas.css') }}" rel="stylesheet">
    <link href="{{ asset('css/preview.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/pass.js') }}" defer></script>
    <script src="{{ asset('js/search.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @if(Auth::user())
                <a class="navbar-brand" href="{{ Auth::user()->tipo != 'F' ? url('/') : route('encomenda.list') }}">
                    {{ config('app.name', 'MagicShirts') }}
                </a>
                @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MagicShirts') }}
                </a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                        @if(Auth::user() and Auth::user()->tipo != 'C')
                        <a href="{{ route('encomenda.list') }}">Lista Encomendas</a>
                        @endif                        
                        <div style="margin-left: 10px;">
                        @if(Auth::user() and Auth::user()->tipo == 'A')
                        <a href="{{ route('utilizador.list') }}">| Lista Clientes</a>
                        @endif
                        </div>
                        <div style="margin-left: 10px;">
                        @if(Auth::user() and Auth::user()->tipo == 'A')
                        <a href="{{ route('utilizador.create') }}">| Criar Conta Utilizador</a>
                        @endif
                        </div>
                        <div style="margin-left: 10px;">
                        @if(Auth::user() and Auth::user()->tipo == 'A')
                        <a href="{{route('cor.list')}}">| Gerir Cores</a>
                        @endif
                        </div>
                        <div style="margin-left: 10px;">
                        @if(Auth::user() and Auth::user()->tipo == 'A')
                        <a href="{{route('preco.list')}}">| Gerir Preços</a>
                        @endif
                        </div>
                        <div style="margin-left: 10px;">
                        @if(Auth::user() and Auth::user()->tipo == 'A')
                        <a href="">| Estatisticas</a>
                        @endif
                        </div>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if (Auth::user()->cliente)
                                <a class="dropdown-item" href="{{ route('encomenda.list') }}">Historico de
                                    Encomendas</a>
                                <a href="{{route('utilizador.edit', ['id' => Auth::id()]) }}" class="dropdown-item">Dados da Conta</a>
                                @endif
                                <!-- Button trigger modal -->
                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#passModalCenter">
                                    Alterar Password
                                </button>
                                <a class="dropdown-item" href="{{ route('estampas.list') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                    <!-- MINI-CART -->
                    @if(Auth::guest() or Auth::user()->tipo == 'C')

                    <a class="show-mini-cart badge badge-light" href="{{ route('carrinho.index') }}"><span class="cart_count"><img style="width: 25px;" 
                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjEuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDg2LjU2OSA0ODYuNTY5IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0ODYuNTY5IDQ4Ni41Njk7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGQ9Ik0xNDYuMDY5LDMyMC4zNjloMjY4LjFjMzAuNCwwLDU1LjItMjQuOCw1NS4yLTU1LjJ2LTExMi44YzAtMC4xLDAtMC4zLDAtMC40YzAtMC4zLDAtMC41LDAtMC44YzAtMC4yLDAtMC40LTAuMS0wLjYNCgkJYzAtMC4yLTAuMS0wLjUtMC4xLTAuN3MtMC4xLTAuNC0wLjEtMC42Yy0wLjEtMC4yLTAuMS0wLjQtMC4yLTAuN2MtMC4xLTAuMi0wLjEtMC40LTAuMi0wLjZjLTAuMS0wLjItMC4xLTAuNC0wLjItMC42DQoJCWMtMC4xLTAuMi0wLjItMC40LTAuMy0wLjdjLTAuMS0wLjItMC4yLTAuNC0wLjMtMC41Yy0wLjEtMC4yLTAuMi0wLjQtMC4zLTAuNmMtMC4xLTAuMi0wLjItMC4zLTAuMy0wLjVjLTAuMS0wLjItMC4zLTAuNC0wLjQtMC42DQoJCWMtMC4xLTAuMi0wLjItMC4zLTAuNC0wLjVjLTAuMS0wLjItMC4zLTAuMy0wLjQtMC41cy0wLjMtMC4zLTAuNC0wLjVzLTAuMy0wLjMtMC40LTAuNGMtMC4yLTAuMi0wLjMtMC4zLTAuNS0wLjUNCgkJYy0wLjItMC4xLTAuMy0wLjMtMC41LTAuNGMtMC4yLTAuMS0wLjQtMC4zLTAuNi0wLjRjLTAuMi0wLjEtMC4zLTAuMi0wLjUtMC4zcy0wLjQtMC4yLTAuNi0wLjRjLTAuMi0wLjEtMC40LTAuMi0wLjYtMC4zDQoJCXMtMC40LTAuMi0wLjYtMC4zcy0wLjQtMC4yLTAuNi0wLjNzLTAuNC0wLjEtMC42LTAuMmMtMC4yLTAuMS0wLjUtMC4yLTAuNy0wLjJzLTAuNC0wLjEtMC41LTAuMWMtMC4zLTAuMS0wLjUtMC4xLTAuOC0wLjENCgkJYy0wLjEsMC0wLjItMC4xLTAuNC0wLjFsLTMzOS44LTQ2Ljl2LTQ3LjRjMC0wLjUsMC0xLTAuMS0xLjRjMC0wLjEsMC0wLjItMC4xLTAuNGMwLTAuMy0wLjEtMC42LTAuMS0wLjljLTAuMS0wLjMtMC4xLTAuNS0wLjItMC44DQoJCWMwLTAuMi0wLjEtMC4zLTAuMS0wLjVjLTAuMS0wLjMtMC4yLTAuNi0wLjMtMC45YzAtMC4xLTAuMS0wLjMtMC4xLTAuNGMtMC4xLTAuMy0wLjItMC41LTAuNC0wLjhjLTAuMS0wLjEtMC4xLTAuMy0wLjItMC40DQoJCWMtMC4xLTAuMi0wLjItMC40LTAuNC0wLjZjLTAuMS0wLjItMC4yLTAuMy0wLjMtMC41cy0wLjItMC4zLTAuMy0wLjVzLTAuMy0wLjQtMC40LTAuNmMtMC4xLTAuMS0wLjItMC4yLTAuMy0wLjMNCgkJYy0wLjItMC4yLTAuNC0wLjQtMC42LTAuNmMtMC4xLTAuMS0wLjItMC4yLTAuMy0wLjNjLTAuMi0wLjItMC40LTAuNC0wLjctMC42Yy0wLjEtMC4xLTAuMy0wLjItMC40LTAuM2MtMC4yLTAuMi0wLjQtMC4zLTAuNi0wLjUNCgkJYy0wLjMtMC4yLTAuNi0wLjQtMC44LTAuNWMtMC4xLTAuMS0wLjItMC4xLTAuMy0wLjJjLTAuNC0wLjItMC45LTAuNC0xLjMtMC42bC03My43LTMxYy02LjktMi45LTE0LjgsMC4zLTE3LjcsNy4yDQoJCXMwLjMsMTQuOCw3LjIsMTcuN2w2NS40LDI3LjZ2NjEuMnY5Ljd2NzQuNHY2Ni41djg0YzAsMjgsMjEsNTEuMiw0OC4xLDU0LjdjLTQuOSw4LjItNy44LDE3LjgtNy44LDI4YzAsMzAuMSwyNC41LDU0LjUsNTQuNSw1NC41DQoJCXM1NC41LTI0LjUsNTQuNS01NC41YzAtMTAtMi43LTE5LjUtNy41LTI3LjVoMTIxLjRjLTQuOCw4LjEtNy41LDE3LjUtNy41LDI3LjVjMCwzMC4xLDI0LjUsNTQuNSw1NC41LDU0LjVzNTQuNS0yNC41LDU0LjUtNTQuNQ0KCQlzLTI0LjUtNTQuNS01NC41LTU0LjVoLTI1NWMtMTUuNiwwLTI4LjItMTIuNy0yOC4yLTI4LjJ2LTM2LjZDMTI2LjA2OSwzMTcuNTY5LDEzNS43NjksMzIwLjM2OSwxNDYuMDY5LDMyMC4zNjl6IE0yMTMuMjY5LDQzMS45NjkNCgkJYzAsMTUuMi0xMi40LDI3LjUtMjcuNSwyNy41cy0yNy41LTEyLjQtMjcuNS0yNy41czEyLjQtMjcuNSwyNy41LTI3LjVTMjEzLjI2OSw0MTYuNzY5LDIxMy4yNjksNDMxLjk2OXogTTQyOC42NjksNDMxLjk2OQ0KCQljMCwxNS4yLTEyLjQsMjcuNS0yNy41LDI3LjVzLTI3LjUtMTIuNC0yNy41LTI3LjVzMTIuNC0yNy41LDI3LjUtMjcuNVM0MjguNjY5LDQxNi43NjksNDI4LjY2OSw0MzEuOTY5eiBNNDE0LjE2OSwyOTMuMzY5aC0yNjguMQ0KCQljLTE1LjYsMC0yOC4yLTEyLjctMjguMi0yOC4ydi02Ni41di03NC40di01bDMyNC41LDQ0Ljd2MTAxLjFDNDQyLjM2OSwyODAuNzY5LDQyOS42NjksMjkzLjM2OSw0MTQuMTY5LDI5My4zNjl6Ii8+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==" />
                            @if(Cart::instance('default')->count() > 0)
                            {{Cart::instance('default')->count()}}
                            @endif
                        </span></a>
                    @endif
                    <!-- END MINI-CART -->
                </div>
            </div>
    </div>
    </nav>

    <main class="py-4">
        <!-- Modal -->
        <div class="modal fade" id="passModalCenter" tabindex="-1" role="dialog" aria-labelledby="passModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passModalCenterTitle">Alterar Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('utilizador.password')}}" method="POST">
                        @csrf
                        {{method_field('put')}}
                        <div class="modal-body">
                            <!-- Text input-->
                            <div class="form-group col-12 ">
                                <label class="control-label" for="PasswordAntiga">Password Antiga</label>
                                <input id="PasswordAntiga" name="passwordAntiga" type="password" class="form-control input-md" required>
                                @error('PasswordAntiga')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror

                            </div><!-- Text input-->
                            <div class="form-group col-12 ">
                                <label class="control-label" for="password">Password Nova</label>
                                <input name="passwordNova" type="password" id="password" required class="form-control input-md">
                                @error('password')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror

                            </div><!-- Text input-->
                            <div class="form-group col-12 ">
                                <label class="control-label" for="confirm_password">Repetir Password Nova</label>
                                <input type="password" id="confirm_password" required class="form-control input-md">
                                @error('confirm_password')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                        </div>
                        <div style="width:100%" class="modal-footer">
                            <button type="submit" class="btn btn-secondary btn-block">Guardar</button>
                            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @yield('content')
    </main>
    </div>

</body>

</html>