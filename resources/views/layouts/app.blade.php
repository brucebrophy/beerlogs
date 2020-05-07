<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;500;600;700&family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        @include('layouts.partials.navigation')
        @yield('content')
    </div>

    @auth    
    <script>
        window.user = {!! auth()->user() !!}
    </script>
    @endauth
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
