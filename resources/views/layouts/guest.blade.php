<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased w-screen min-h-screen overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="{{ asset('storage/sports/test.gif') }}" alt="Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/50 to-indigo-600/50 backdrop-blur-sm"></div>
        </div>
        <main class="w-full min-h-screen flex relative">
            <!-- Home Link -->
            <div class="absolute top-4 left-4 z-10">
                <a href="/" 
                class="group flex items-center space-x-2 px-4 py-2 text-white hover:text-gray-200 bg-white/10 rounded-lg backdrop-blur-sm transition duration-150 ease-in-out">
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="text-sm font-medium">Return Home</span>
                </a>
            </div>
            {{$slot}}
        </main>
    </body>
</html>
