<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'BoolBnb') }} | @yield('title')</title>

    {{-- FONTAWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- GOOGLEICON --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- ICONA --}}
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/img/logo.png') }}">

    {{-- VITE --}}
    @vite(['resources/js/app.js'])

    {{-- STYLE BODY --}}
    <style>
        body {
            visibility: hidden;
        }
    </style>

    {{-- CDN --}}
    @yield('cdns')
</head>

<body>
    <div id="app">
        {{-- NAVBAR --}}
        @include('includes.layouts.navbar')

        {{-- LOGIN --}}
        @yield('login-form')

        {{-- MAIN --}}
        <main class="container">

            {{-- ALERT --}}
            @include('includes.alert')

            {{-- CONTENUTO --}}
            @yield('content')

        </main>
    </div>

    {{-- MODALE ELEMINAZIONE APPARTAMENTO --}}
    @include('includes.modal')

    {{-- SCRIPT --}}
    @yield('scripts')
</body>

</html>
