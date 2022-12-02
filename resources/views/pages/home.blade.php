<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{  config("app.name","My Library") }}</title>

    {{-- LOading Script & Styles --}}
    @vite('resources/js/app.js')

</head>
<body class="antialiased dark:bg-gray-900">
<main id="app"></main>
</body>
</html>
