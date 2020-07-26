<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('titulo_home', '') </title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        @include('layouts.nav')

        @include('layouts.mensaje')

        <div class="pt-2">
            @yield('home_contenido')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/productos.js') }}"></script>
        <script src="{{ asset('js/mp.js') }}"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        @yield('script')
    </div>

</body>
</html>
