<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @include('partials.assets.styles')
        @stack('styles')
    </head>
    <body>
        @include('partials.navbar.main')
        <div id="app">
            @yield('content')
        </div>

        @include('partials.assets.scripts')
        @stack('scripts')
    </body>
</html>
