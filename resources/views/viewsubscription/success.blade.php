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

        <header>
            <nav class="bg-[#5170ff] border-b-2 border-[#ff5170] px-4 lg:px-6 py-2.5">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl gap-2">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('assets/images/GoodTrav.png') }}" class="h-8 sm:h-10 lg:h-12 w-auto object-contain" alt="Goodtrav Logo" />
                    </a>


                    <a href="tel:614189556" class="flex items-center gap-2 text-white hover:text-[#ff5170] transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span class="hidden sm:inline font-medium">614189556</span>
                    </a>

                    <div class="flex items-center gap-2 lg:order-2">
                        @auth
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <a type="button" type="submit" class="text-white bg-[#ff5170] hover:bg-[#ff6f70] focus:ring-4 focus:ring-[#ff6f70] font-medium rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 focus:outline-none transform hover:translate-y-1 hover:scale-105 transition-all cursor-pointer" data-test="logout-button">
                            {{ __('Log Out') }}
                        </a>
                        @endauth
                    </form>
                    </div>
                </div>
            </nav>
        </header>

        <br>
        <br>
        <br>
        <br>
        <br>

        <main class="flex-grow">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="text-center">
                            <svg class="mx-auto h-16 w-16 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>

                            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">¡Pago Exitoso!</h2>
                            <p class="text-gray-600 mb-6">Tu suscripción ha sido activada correctamente.</p>

                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                                <p class="text-sm font-medium text-green-800">
                                    <strong>Fecha de inicio:</strong> {{ auth()->user()->subscription_start_date?->format('d/m/Y') ?? 'Procesando...' }}<br>
                                    <strong>Fecha de fin:</strong> {{ auth()->user()->subscription_end_date?->format('d/m/Y') ?? 'Procesando...' }}
                                </p>
                            </div>

                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                Ir al Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>


        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <x-navigation.footer />


        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
