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
        <style>
            html,
            body {
                height: 100%;
            }

            @media (min-width: 640px) {
                table {
                display: inline-table !important;
                }

                thead tr:not(:first-child) {
                display: none;
                }
            }

            td:not(:last-child) {
                border-bottom: 0;
            }

            th:not(:last-child) {
                border-bottom: 2px solid rgba(0, 0, 0, .1);
            }
        </style>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            <header class="shadow-lg">
                <nav class="flex flex-wrap items-center justify-between p-5 text-white bg-green-400">
                    <a href="{{ route('dashboard') }}">
                        ABM de Tareas
                    </a>
                    <div class="flex md:hidden">
                        <button id="hamburger">
                            <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png" width="40" height="40" />
                            <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png" width="40" height="40" />
                        </button>
                    </div>
                    <div class="toggle hidden md:flex w-full md:w-auto text-right text-bold mt-5 md:mt-0 border-t-2 border-white md:border-none">        
                        @can('task_access')
                            <a href="{{ route('tasks.index') }}" class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none">Tareas</a>
                        @endcan
                        @can('user_access')
                            <a href="{{ route('users.index') }}" class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none">Usuarios</a>
                        @endcan
                        @if (Route::has('login'))
                            @auth
                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                        class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none">
                                        {{ Auth::user()->name }} - Logout
                                    </a>
                                </form>
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

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
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
