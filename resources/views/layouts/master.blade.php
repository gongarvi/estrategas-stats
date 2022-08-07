<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Estrategas stats generator</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
        

        <link rel="stylesheet" type="text/css" href="{{ url('css/app.css'); }} ">
        <link rel="stylesheet" type="text/css" href="{{ url('css/spinner.css'); }} ">

        @yield('headers')
    </head>
    <body class="antialiased min-h-screen">
        <x-spinner/>
        <main id="main" class="bg-slate-300">
            @yield('content')
        </main>
        <script src="{{asset('js/spinner.js')}}"></script>
    </body>
</html>