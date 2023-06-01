<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("titulo")</title>
    <link rel="stylesheet" href="{{url('/css/estilos.css')}}">
    <link rel="stylesheet" href="{{url('/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('/css/bulma.min.css')}}"/>
    <script type="text/javascript">
        const URL_BASE = "{{url("/")}}",
            URL_BASE_API = "{{url('/api')}}",
            TOKEN_CSRF = "{{csrf_token()}}";
    </script>
    <script src="{{url('/js/principal.js?q=') . time()}}"></script>
    <script src="{{url('/js/wireframe.js?q=') . time()}}"></script>
    <script src="{{url('/js/utiles.js')}}"></script>
    <script src="{{url('/js/vue.js')}}"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <div class="container">
            <br><br>
            @yield('contenido')
        </div>
    </div>
    
</body>

</html>