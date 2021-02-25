<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Examen 1 ABM Tareas - Netcommerce</title>
</head>
<body>
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
                <a href="{{ route('tasks.index') }}" class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none">Tareas</a>
                <a href="#" class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none">Usuarios</a>
                @auth
                    <a href="{{ url('dashboard') }}" class="block md:inline-block text-white hover:text-gray-500 px-3 py-3 border-b-2 md:border-none underline">
                        Dashboard
                    </a>
                @else
                    <a href="{{ url('login') }}" class="block md:inline-block text-purple-800 hover:text-gray-500 px-3 py-3 border-b-2 md:border-none underline">
                        Login
                    </a>
                    <a href="{{ url('register') }}" class="block md:inline-block text-purple-800 hover:text-gray-500 px-3 py-3 border-b-2 md:border-none underline">
                        Register
                    </a>
                @endif
            </div>
        </nav>
    </header>
    <main class="py-10">
        <div class="container mx-auto px-4">
            @yield('content')
        </div>
    </main>
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