<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{  config("app.name","My Library") }}</title>

    {{-- LOading Script & Styles --}}
    @vite('resources/js/app.js')

</head>
<body class="antialiased">
<main id="app"></main>
</body>
</html>
