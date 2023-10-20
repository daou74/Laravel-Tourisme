<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> {{config('app.name')}} - @yield('title')</title>

        <!-- Fonts -->

        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" >

        <link rel="stylesheet" href="{{asset('assets/app.css')}}">
        
    </head>
    <body id='root'>

    <!-- Barre de navigation-->
       @include('navbar/navbar')

        <!-- tous nos contenus seron afficher ici-->
        @yield('content')

        <!-- Nos scrippt javascript-->
        @include('script')
    </body>
</html>
