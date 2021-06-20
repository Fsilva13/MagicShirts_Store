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
                    <a class="show-mini-cart badge badge-light" href="{{ route('carrinho.index') }}">Carrinho <span class="cart_count">
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