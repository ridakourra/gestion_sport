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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 overflow-x-hidden">
            @include('layouts.navigation')


            {{-- Flashes messages --}}
            @if(session('success'))
                {{-- success --}}
                <div id="flash" class="absolute right-8 top-8 p-3 visible opacity-100 transition-all duration-[2s] bg-green-500 flex gap-3 items-center justify-center rounded-md text-white w-max">
                    <span>
                        {{session('success')}}
                    </span>
                    <i onclick="handleFlash(this.parentElement)" class="fas fa-close"></i>
                </div>
            @elseif(session('warning'))
                {{-- warning --}}
                <div id="flash" class="absolute right-8 top-8 p-3 visible opacity-100 transition-all duration-[2s] bg-yellow-500 flex gap-3 items-center justify-center rounded-md text-white w-max">
                    <span>
                        {{session('warning')}}
                    </span>
                    <i onclick="handleFlash(this.parentElement)" class="fas fa-close"></i>
                </div>
            @elseif(session('error'))
                {{-- error --}}
                <div id="flash" class="absolute right-8 top-8 p-3 visible opacity-100 transition-all duration-[2s] bg-red-500 flex gap-3 items-center justify-center rounded-md text-white w-max">
                    <span>
                        {{session('error')}}
                    </span>
                    <i onclick="handleFlash(this.parentElement)" class="fas fa-close"></i>
                </div>
            @endif
            

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>


        <script>
            function handleFlash(parent){
                parent.classList.remove('opacity-100')
                parent.classList.add('opacity-0')
            }

            @if(session('success') || session('warming') || session('error'))
                setTimeout(() => {
                    document.getElementById('flash').classList.add('opacity-0')
                    document.getElementById('flash').classList.remove('opacity-100')
                }, 3000);
            @endif

        </script>

    </body>
</html>
