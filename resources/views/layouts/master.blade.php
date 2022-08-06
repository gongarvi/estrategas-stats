<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel pp</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ url('css/app.css'); }} ">
        <link rel="stylesheet" type="text/css" href="{{ url('css/spinner.css'); }} ">

        @yield('headers')
    </head>
    <body class="antialiased">
        <div id="hidden-content">
            <x-spinner/>
        </div>
        <div id="show-content" class="min-h-screen bg-slate-300 flex flex-col w-full">
            <header id="header" class="w-full">
                @yield('header')
            </header>
            <main id="main" class="w-full grow h-full flex place-items-center">
                @yield('content')
            </main>
        </div>        
        <script src="{{asset('js/spinner.js')}}"></script>
    </body>
</html>