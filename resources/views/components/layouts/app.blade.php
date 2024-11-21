<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title . ' - ' . config('app.name') }}</title>

        <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
        
        @livewireStyles
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @paddleJS
        @stack('styles')
        @stack('header-scripts')
    </head>
    <body>
        <div class="page">

            {{ $slot }}
            
        </div>
        
        @livewireScripts

        <script src="{{ asset('js/script.js') }}"></script>
        @stack('scripts')
    </body>
</html>