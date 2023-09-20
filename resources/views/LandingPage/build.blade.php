<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="_token" content="{{ csrf_token() }}" />

        <title inertia>{{ config("app.name", "Laravel") }}</title>

        <!-- Scripts -->
        @routes @vite(['resources/js/grapesjs.js'])
    </head>

    <body class="font-sans antialiased">
        <div id="gjs"></div>
    </body>
</html>
