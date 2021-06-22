@extends('layouts.app')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Magic Shirts</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    
</head>


<body id="particles-js">
    <div class="position-ref">
        <div class="content">
            <div class="title m-b-md ">
                MagicShirts Store
            </div>
            <div>
                <a href="{{route('estampas.list')}}" class="btn btn-secondary"> Catalogo de Estampas</a>
            </div>
        </div>
    </div>

</body>

<script>
particlesJS.load('particles-js', 'js/package.json', function() {
    console.log('callback - particles.js config loaded')
});
</script>

</html>
@endsection