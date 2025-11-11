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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


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
                            Conquista nuevos retos,
                            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#70ff51] via-[#5170ff] to-[#ff5170] animate-gradient poppins-bold">
                            Y VIAJA.
                            </span>
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

        <div id="como-funciona" class="bg-gradient-to-b from-white to-gray-50 dark:bg-gray-900">
            <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <!-- Header Section -->
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                        Así funciona
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Un proceso simple de 3 pasos para dominar el inglés mientras viajas
                    </p>
                </div>

                <!-- Cards Grid -->
                <div class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 text-left gap-6 md:gap-8 items-stretch">

                    <!-- Card 1: Preparación -->
                    <div class="process-card group flex flex-col rounded-3xl bg-gradient-to-br from-[#5170ffÑ] to-[#6ad5ff] border-2 border-[#9ce0ff] p-8 flex-1 shadow-2xl hover:shadow-[#51c7ff]/50 transition-all duration-500 transform hover:-translate-y-2 fade-in-up animation-delay-100">
                        <!-- Número e Icono -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm border-2 border-white/40">
                                <span class="text-3xl font-extrabold text-white">1</span>
                            </div>
                            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="flex flex-col gap-4 flex-1">
                            <h3 class="font-extrabold text-2xl md:text-3xl text-white leading-tight">
                                Se preparan antes de viajar
                            </h3>

                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <p class="font-semibold text-white text-sm">
                                    🎯 <span class="font-bold">Objetivo:</span> Adquirir las frases y estructuras necesarias para comunicarse en el destino.
                                </p>
                            </div>

                            <div class="space-y-3 text-white/95">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-white flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Cada lunes acceden a una nueva clase de inglés online y un reto semanal</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-white flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Disponen hasta el domingo a las 23:59 para completar ambos</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-white flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Aprenden expresiones prácticas: pedir comida, comprar, orientarse…</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Puntos GT -->
                    <div class="process-card group flex flex-col rounded-3xl bg-gradient-to-br from-[#70ff51] to-[#8aff6f] border-2 border-[#99ff83] p-8 flex-1 shadow-2xl hover:shadow-[#70ff51]/50 transition-all duration-500 transform hover:-translate-y-2 fade-in-up animation-delay-200">
                        <!-- Número e Icono -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm border-2 border-white/40">
                                <span class="text-3xl font-extrabold text-gray-900">2</span>
                            </div>
                            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-9 h-9 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="flex flex-col gap-4 flex-1">
                            <h3 class="font-extrabold text-2xl md:text-3xl text-gray-900 leading-tight">
                                Ganan puntos GT
                            </h3>

                            <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 border border-white/30">
                                <p class="font-semibold text-gray-900 text-sm">
                                    🎯 <span class="font-bold">Objetivo:</span> Asegurar que lleguen al viaje con confianza real, no a "probar suerte".
                                </p>
                            </div>

                            <div class="space-y-3 text-gray-900">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-900 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Cada clase y reto completado suma puntos GT</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-900 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Los puntos muestran su nivel de preparación real</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-gray-900 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Más puntos = retos más avanzados en el destino = más aprendizaje</p>
                                </div>
                                <div class="bg-gray-900/10 rounded-lg p-3 mt-4">
                                    <p class="text-sm font-semibold">💡 Por eso recomendamos unirse desde los 11 años, incluso si el viaje será más adelante.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Viaje -->
                    <div class="process-card group flex flex-col rounded-3xl bg-gradient-to-br from-[#ff5170] to-[#ff6f88] border-2 border-[#ff8399] p-8 flex-1 shadow-2xl hover:shadow-[#ff5170]/50 transition-all duration-500 transform hover:-translate-y-2 md:col-span-2 lg:col-span-1 md:max-w-2xl lg:max-w-none md:mx-auto fade-in-up animation-delay-300">
                        <!-- Número e Icono -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm border-2 border-white/40">
                                <span class="text-3xl font-extrabold text-white">3</span>
                            </div>
                            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="flex flex-col gap-4 flex-1">
                            <h3 class="font-extrabold text-2xl md:text-3xl text-white leading-tight">
                                Viajan y practican lo aprendido
                            </h3>

                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <p class="font-semibold text-white text-sm">
                                    🎯 <span class="font-bold">Objetivo:</span> Practicar inglés en situaciones reales con hablantes nativos.
                                </p>
                            </div>

                            <div class="space-y-3 text-white/95">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-white flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Una vez conseguidos los puntos necesarios, ¡listos para viajar!</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-white flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Viajes de 5 días completando retos con nativos</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-white flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p>Supervisión constante de profesores cualificados</p>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 mt-4 border border-white/20">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="font-bold text-sm">100% Seguro</p>
                                    </div>
                                    <p class="text-sm">Sin familias de acogida. Alumnos viajan y duermen con su grupo y profesores 24/7.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Flecha de proceso visual (solo desktop) -->
                <div class="hidden lg:flex items-center justify-center gap-4 mt-12 fade-in-up animation-delay-400">
                    <div class="flex items-center gap-2">
                        <div class="w-12 h-12 rounded-full bg-[#51c7ff] flex items-center justify-center text-white font-bold">1</div>
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <div class="w-12 h-12 rounded-full bg-[#70ff51] flex items-center justify-center text-gray-900 font-bold">2</div>
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <div class="w-12 h-12 rounded-full bg-[#ff5170] flex items-center justify-center text-white font-bold">3</div>
                    </div>
                </div>

            </section>
        </div>

        <livewire:component.opiniones />


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
