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
    <body class="font-sans antialiased h-screen min-h-screen flex flex-col gap-2 p-2 bg-gray-100">
        {{-- header --}}
        @include('layouts.header')

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="flash-message success fixed top-5 right-5 z-50 p-4 rounded-lg text-white flex items-center justify-between bg-green-500 animate-slide-in">
            <span>{{ session('success') }}</span>
            <button class="close-btn ml-4 text-md text-white hover:text-gray-200">X</button>
        </div>
        @endif

        @if(session('warning'))
            <div class="flash-message warning fixed top-5 right-5 z-50 p-4 rounded-lg text-white flex items-center justify-between bg-yellow-500 animate-slide-in">
                <span>{{ session('warning') }}</span>
                <button class="close-btn ml-4 text-white hover:text-gray-200">X</button>
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message error fixed top-5 right-5 z-50 p-4 rounded-lg text-white flex items-center justify-between bg-red-500 animate-slide-in">
                <span>{{ session('error') }}</span>
                <button class="close-btn ml-4 text-white hover:text-gray-200">X</button>
            </div>
        @endif

        <div class="w-full h-full flex overflow-hidden">
            {{-- navbar --}}
            @include('layouts.navbar')
            {{-- main --}}
            <main class="h-full w-full overflow-auto">
                {{ $slot }}
            </main>
        </div>

        <!-- Script to handle flash messages -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Close button functionality
                const closeButtons = document.querySelectorAll('.close-btn');
                closeButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const flashMessage = this.closest('.flash-message');
                        flashMessage.remove();
                    });
                });

                // Auto-remove flash messages after 3 seconds
                const flashMessages = document.querySelectorAll('.flash-message');
                flashMessages.forEach(message => {
                    setTimeout(() => {
                        message.remove();
                    }, 3000); // 3 seconds
                });
            });
        </script>
    </body>
</html>