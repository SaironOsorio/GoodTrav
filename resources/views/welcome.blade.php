<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GoodTrav</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-[#FDFDFC]">

        <x-navigation.header />

        <section class="bg-cover bg-center bg-no-repeat dark:bg-gray-900 h-[85vh]" style="background-image: url('https://www.conmishijos.com/uploads/tareas_escolares/quizpaises-1.jpg');">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6 h-full flex items-center">
                <div class="max-w-screen-md">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Aprende inglés, conquista nuevos retos y viaja más lejos.</h2>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="text-white bg-[#5170ff] hover:bg-[#4158d0] focus:outline-none focus:ring-4 focus:ring-[#4158d0] font-medium rounded-full text-lg px-8 py-4 text-center cursor-pointer inline-block">Comenzar</a>
                    </div>
                </div>
            </div>
        </section>


        <livewire:component.card />

        <livewire:component.opiniones />

        <x-navigation.footer />

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
