<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('titulo_home', '') </title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>



    <div class="container-fluid">
        @include('layouts.nav')

        @include('layouts.mensaje')

        @yield('home_contenido')

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        @yield('script')
    </div>

</body>
</html>
