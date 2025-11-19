<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GoodTrav</title>

        <link rel="icon" href="/favicon.ico" sizes="any">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&display=swap" rel="stylesheet">


        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-[#FDFDFC] overflow-x-hidden">

        <x-navigation.header />


        <section class="hero-section relative bg-cover bg-center bg-no-repeat dark:bg-gray-900 min-h-[85vh] flex items-center overflow-hidden"
                style="background-image: url('{{ asset('assets/images/fondobg.jpg') }}');">

            <!-- Overlay con gradiente para mejor legibilidad -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-transparent"></div>


            <div class="relative z-10 py-8 px-4 sm:px-6 lg:px-12 w-full h-full flex items-center">
                <div class="max-w-screen-xl mx-auto w-full">
                    <div class="max-w-xl">
                        <!-- Título principal -->
                        <h1 class="fade-in-up animation-delay-200 mb-6 tracking-tight text-3xl sm:text-4xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight poppins-bold">
                            Aprende inglés,<br>
                            Conquista nuevos retos y
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#70ff51] via-[#5170ff] to-[#ff5170] animate-gradient poppins-bold">VIAJA.</span>
                        </h1>

                        <!-- Botones CTA -->
                        <div class="fade-in-up animation-delay-500 flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('register') }}"
                            class="btn-primary group relative inline-flex items-center justify-center gap-2 text-white bg-[#5170ff] hover:shadow-2xl hover:shadow-[#5170ff]/50 focus:outline-none focus:ring-4 focus:ring-[#5170ff]/50 font-bold rounded-full text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4 text-center transition-all duration-300 poppins-bold hover:scale-105">
                                <span>Comenzar gratis</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <livewire:component.card />

        <div id="como-funciona" class="bg-white">
            <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <!-- Header Section -->
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white poppins-bold">
                        Así funciona
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto montserrat-medium">
                        Un proceso simple de 3 pasos para dominar el inglés mientras viajas
                    </p>
                </div>

                <!-- Cards Grid -->
                <div class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 text-left gap-6 md:gap-8 items-stretch">

                    <!-- Card 1: Preparación -->
                    <div class="process-card group flex flex-col rounded-3xl bg-[#6ad5ff] border-[#9ce0ff] p-8 flex-1 shadow-2xl hover:shadow-[#51c7ff]/50 transition-all duration-500 transform hover:-translate-y-2 fade-in-up animation-delay-100">
                        <!-- Número e Icono -->
                        <div class="flex items-start justify-center mb-6">
                            <div class="flex items-center justify-center w-20 h-20 rounded-2xl backdrop-blur-sm group-hover:scale-110 transition-transform duration-300 overflow-hidden">
                                <img
                                    src="{{ asset('assets/images/1.png') }}"
                                    alt="PuntosGt"
                                    class="w-full h-full object-contain p-2"
                                    loading="lazy"
                                />
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="flex flex-col gap-4 flex-1">
                            <h3 class="font-extrabold text-2xl md:text-3xl text-black leading-tight poppins-extrabold">
                                Te preparas antes de viajar
                            </h3>

                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <p class="font-semibold text-black text-sm open-sans-regular">
                                <span class="font-bold open-sans-bold">Objetivo:</span> Adquirir las frases y estructuras
                                    necesarias para comunicarte en el destino.
                                </p>
                            </div>

                            <div class="space-y-3 text-black open-sans-regular">
                                <div class="flex items-start gap-3 ">
                                    <svg class="w-5 h-5 text-black flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Cada lunes accedes a una nueva clase de inglés online y a un nuevo reto semanal.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-black flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Dispones hasta el domingo a las 23:59 de esa semana para completar ambos.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-black flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Aquí aprenderás las  expresiones que usarás al viajar: pedir comida, comprar, orientarse…</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Card 2: Puntos GT -->
                    <div class="process-card group flex flex-col rounded-3xl bg-gradient-to-br from-[#ff5170] to-[#ff6f88] border-2 border-[#ff8399] p-8 flex-1 shadow-2xl hover:shadow-[#ff5170]/50 transition-all duration-500 transform hover:-translate-y-2 md:col-span-2 lg:col-span-1 md:max-w-2xl lg:max-w-none md:mx-auto fade-in-up animation-delay-300">
                        <!-- Número e Icono -->
                        <div class="flex items-start justify-center mb-6">
                            <div class="flex items-center justify-center w-20 h-20 rounded-2xl backdrop-blur-sm group-hover:scale-110 transition-transform duration-300 overflow-hidden">
                                <img
                                    src="{{ asset('assets/images/2.png') }}"
                                    alt="PuntosGt"
                                    class="w-full h-full object-contain p-2"
                                    loading="lazy"
                                />
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="flex flex-col gap-4 flex-1">
                            <h3 class="font-extrabold text-2xl md:text-3xl text-black leading-tight poppins-bold">
                                Ganas puntos GT
                            </h3>

                            <br>


                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 open-sans-regular">
                                <p class="font-semibold text-black text-sm open-sans-regular">
                                <span class="font-bold open-sans-bold">Objetivo:</span> Asegurar que llegas al viaje con confianza y soltura, no a “probar suerte”.
                                </p>
                            </div>

                            <div class="space-y-3 text-black/95 open-sans-regular">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-black flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Cada clase que ves y reto que completas suma puntos GT.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-black flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Los puntos muestran tu nivel de preparación real.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-black flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Más puntos = retos más avanzados en el destino = más aprendizaje.</p>
                                </div>

                                <br>
                                <br>


                                <div class="bg-gray-900/10 rounded-lg p-3 mt-4">
                                    <p class="text-sm font-semibold open-sans-regular"> 💡 Por eso recomendamos unirse a la comunidad
                                    GoodTrav desde los 11 años, incluso si el viaje será más
                                    adelante.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Viajes -->
                    <div class="process-card group flex flex-col rounded-3xl  bg-[#70ff51]  border-[#99ff83] p-8 flex-1 shadow-2xl hover:shadow-[#70ff51]/50 transition-all duration-500 transform hover:-translate-y-2 fade-in-up animation-delay-200">
                        <!-- Número e Icono -->
                        <div class="flex items-center justify-center mb-6">
                            <div class="flex items-center justify-center w-20 h-20 rounded-2xl  group-hover:scale-110 transition-transform duration-300 overflow-hidden">
                                <img
                                    src="{{ asset('assets/images/tl.png') }}"
                                    alt="Viajes"
                                    class="w-full h-full object-contain p-2"
                                    loading="lazy"
                                />
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="flex flex-col gap-4 flex-1">
                            <h3 class="font-extrabold text-2xl md:text-3xl text-gray-900 leading-tight poppins-bold">
                                Viajas y practicas lo aprendido
                            </h3>

                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 border border-white/30">
                                <p class="font-semibold text-gray-900 text-sm open-sans-regular">
                                <span class="font-bold open-sans-bold">Objetivo:</span>  Practicar inglés en situaciones reales con hablantes nativos.
                                </p>
                            </div>

                            <div class="space-y-3 text-gray-900 open-sans-regular">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-900 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Una vez obtenidos los puntos necesarios, ¡listos para viajar!</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-900 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Viajes donde los alumnos han de completar retos interactuando con hablantes nativos.</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-900 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Supervisión de profesores cualificados que enseñan, guían y corrigen durante todo el viaje. </p>
                                </div>

                                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 mt-4 border border-white/20">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="font-bold text-sm">100% Seguro</p>
                                    </div>
                                    <p class="text-sm open-sans-regular">No hay familias de acogida. Alumnos viajan y duermen con su grupo y profesores 24/7.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flecha de proceso visual (solo desktop) -->
                <div class="hidden lg:flex items-center justify-center gap-4 mt-12 fade-in-up animation-delay-400">
                    <div class="flex items-center gap-2">
                        <div class="w-12 h-12 rounded-full bg-[#51c7ff] flex items-center justify-center text-black font-bold">1</div>
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <div class="w-12 h-12 rounded-full bg-[#ff5170] flex items-center justify-center text-black font-bold">2</div>
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <div class="w-12 h-12 rounded-full bg-[#70ff51] flex items-center justify-center text-black font-bold">3</div>
                    </div>
                </div>

            </section>
        </div>

        <!-- livewire:component.opiniones --->

        <section class="bg-white py-16 px-4">
            <div class="max-w-screen-xl mx-auto">
                <div class="text-center mb-12 fade-in-up">
                    <div class="relative inline-block">
                        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-2 caveat-bold ">
                            Descubre GoodTrav
                        </h2>
                        <p class="text-2xl md:text-3xl font-bold text-gray-700 dark:text-gray-300 caveat-bold ">
                            por dentro
                        </p>

                        <div class="flex justify-center mt-6 animate-bounce">
                            <svg class="w-12 h-12 text-gray-900 caveat-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="max-w-5xl mx-auto fade-in-up animation-delay-200">
                    <div class="relative bg-gray-900 rounded-3xl p-2 shadow-2xl">
                        <div class="bg-gray-800 rounded-t-2xl px-4 py-3 flex items-center gap-2">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                            <div class="flex-1 bg-gray-700 rounded-lg px-4 py-1.5 mx-4">
                                <p class="text-xs text-gray-400 truncate">goodtrav.com/dashboard</p>
                            </div>
                        </div>

                        <div class="relative bg-white dark:bg-gray-800 rounded-b-2xl overflow-hidden" style="padding-bottom: 56.25%;">
                            @php
                                $setting = App\Models\Setting::first();
                                $videoUrl = $setting->url_youtube_landing ?? 'https://www.youtube.com/embed/HFy1WUcA';
                            @endphp
                            <iframe
                                class="absolute top-0 left-0 w-full h-full"
                                src="{{ $videoUrl }}"
                                title="Descubre GoodTrav"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy">
                            </iframe>
                        </div>

                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-tr from-transparent via-white/5 to-transparent pointer-events-none"></div>
                    </div>
                </div>
            </div>
        </section>


        <section class="bg-gradient-to-br from-indigo-500 to-blue-500">
            <div class="grid max-w-screen-xl px-4 py-16 mx-auto lg:gap-8 xl:gap-0 lg:py-24 lg:grid-cols-12 items-center">
                <!-- Texto principal -->
                <div class="mr-auto place-self-center lg:col-span-7 text-center lg:text-left">
                    <blockquote class="max-w-2xl mb-6 text-2xl md:text-3xl xl:text-4xl font-bold tracking-tight leading-tight text-white poppins-bold">
                        "Aquí convertimos a nuestros alumnos en personas independientes y capaces de moverse solos por el mundo"
                    </blockquote>
                    <p class="max-w-2xl mb-6 font-light text-white text-base md:text-lg montserrat-regular opacity-90">
                        Nerea<br>
                        Filóloga y fundadora de GoodTrav
                    </p>
                </div>
                <!-- Imagen decorativa -->
                <div class="lg:col-span-5 flex justify-center lg:justify-end">
                    <img src="{{ asset('assets/images/Nerea-bg.png') }}" alt="Nerea - Fundadora de GoodTrav" class="w-full max-w-md lg:max-w-lg h-auto object-contain">
                </div>
            </div>
        </section>



        <livewire:component.subcriptions />


        <livewire:component.colaboradores />

        <livewire:component.faq />

        <livewire:form-contacto />

        <x-navigation.footer />

        <button id="scrollToTop" class="fixed bottom-4 right-4 bg-[#5170ff] text-white p-3 rounded-full shadow-lg opacity-0 transition-opacity duration-300 z-50 hover:bg-[#049CB7] cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
        </button>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const scrollToTopButton = document.getElementById('scrollToTop');


            window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollToTopButton.classList.remove('opacity-0');
                scrollToTopButton.classList.add('opacity-100');
            } else {
                scrollToTopButton.classList.remove('opacity-100');
                scrollToTopButton.classList.add('opacity-0');
            }
            });


            scrollToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            });
        });
        </script>
    </body>
</html>
