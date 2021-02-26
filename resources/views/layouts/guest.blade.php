<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <!-- Page Heading -->
        <header class="shadow-lg">
            <nav class="flex flex-wrap items-center justify-between p-5 bg-green-400">
                <a href="{{ route('home') }}">
                    ABM de Tareas
                </a>
                <div class="flex md:hidden">
                    <button id="hamburger">
                        <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png" width="40" height="40" />
                        <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png" width="40" height="40" />
                    </button>
                </div>
                <div class="toggle hidden md:flex w-full md:w-auto text-right text-bold mt-5 md:mt-0 border-t-2 border-white md:border-none">        
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </header>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <script>
            document.getElementById("hamburger").onclick = function toggleMenu() {
                const navToggle = document.getElementsByClassName("toggle");
                for (let i = 0; i < navToggle.length; i++) {
                    navToggle.item(i).classList.toggle("hidden");
                }
            };
        </script>
    </body>
</html>
