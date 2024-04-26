<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <title>Pawfect Care</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=caveat-brush:400" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        #map {
            height: 400px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @if(Auth::user())
        @include('layouts.navigation')
        @else
        @include('layouts.guest-navigation')
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

<footer class="w-full bg-gray-800">
    <div class="flex flex-row max-w-3xl mx-auto p-6">
        <div class="flex flex-col items-center">
            <h3 class="text-white font-bold">Pawfect Care</h3>
            <p class="text-gray-400 text-center">We connect dog owners with carers and facilitate safe places for your pups when you're away!</p>
            <p class="opacity-50 text-xs mb-0 p-2 text-gray-500">Pawfect Care © 2024</p>
        </div>
    </div>

</footer>

</html>