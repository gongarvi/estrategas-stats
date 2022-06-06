<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel pp</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ url('css/app.css'); }} ">

        @yield('headers')
    </head>
    <body class="antialiased min-h-screen">
        <main id="main" class="bg-slate-300">
            @yield('content')
        </main>
    </body>
</html>