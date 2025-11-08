<!-- filepath: d:\Projects\goodtrap\resources\views\livewire\component\opiniones.blade.php -->
<div>
    <section class="bg-gradient-to-b from-gray-50 to-white dark:bg-gray-900 relative overflow-hidden">
        <!-- Elementos decorativos de fondo -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#5170ff]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#70ff51]/5 rounded-full blur-3xl"></div>
        
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6 relative z-10">
            <!-- Header mejorado -->
            <div class="mx-auto mb-12 max-w-screen-sm lg:mb-16 fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#5170ff]/10 rounded-full mb-4">
                    <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="text-sm font-semibold text-[#5170ff]">Testimonios</span>
                </div>
                
                <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Lo que dicen nuestras familias
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    Experiencias reales de padres y alumnos que ya forman parte de GoodTrav
                </p>
            </div> 
            
            @if(count($opiniones) > 0)
                @if(count($opiniones) > 3)
                    <!-- Carousel infinito mejorado -->
                    <div class="relative">
                        <!-- Gradientes laterales para efecto fade -->
                        <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-white to-transparent dark:from-gray-900 z-10 pointer-events-none"></div>
                        <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-white to-transparent dark:from-gray-900 z-10 pointer-events-none"></div>
                        
                        <div class="overflow-hidden">
                            <div class="flex testimonial-carousel" style="animation: scroll 30s linear infinite;">
                                @foreach (array_merge($opiniones, $opiniones) as $index => $opinion)
                                <div class="flex-shrink-0 w-full sm:w-1/2 lg:w-1/3 px-4 py-4">
                                    <div class="testimonial-card h-full bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 group">
                                        <!-- Rating estrellas -->
                                        <div class="flex justify-center gap-1 mb-4">
                                            @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            @endfor
                                        </div>

                                        <!-- Comillas decorativas -->
                                        <div class="text-[#5170ff]/20 text-6xl font-serif leading-none mb-2">"</div>
                                        
                                        <!-- Opinión -->
                                        <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed mb-6 min-h-[100px]">
                                            {{ $opinion['opinion'] }}
                                        </p>

                                        <!-- Avatar y nombre -->
                                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                            <div class="relative">
                                                <img class="w-12 h-12 rounded-full object-cover ring-2 ring-[#5170ff]/20" 
                                                     src="https://ui-avatars.com/api/?name={{ urlencode($opinion['nombre']) }}&background=5170ff&color=fff&size=128" 
                                                     alt="{{ $opinion['nombre'] }}">
                                                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-[#70ff51] rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-left">
                                                <h3 class="text-base font-bold text-gray-900 dark:text-white">
                                                    {{ $opinion['nombre'] }}
                                                </h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    Familia GoodTrav
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Grid estático mejorado para 3 o menos elementos -->
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto">
                        @foreach ($opiniones as $opinion)
                        <div class="testimonial-card fade-in-up animation-delay-{{ $loop->index * 100 }}">
                            <div class="h-full bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700">
                                <!-- Rating estrellas -->
                                <div class="flex justify-center gap-1 mb-4">
                                    @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    @endfor
                                </div>

                                <!-- Comillas decorativas -->
                                <div class="text-[#5170ff]/20 text-6xl font-serif leading-none mb-2">"</div>
                                
                                <!-- Opinión -->
                                <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed mb-6">
                                    {{ $opinion['opinion'] }}
                                </p>

                                <!-- Avatar y nombre -->
                                <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <div class="relative">
                                        <img class="w-12 h-12 rounded-full object-cover ring-2 ring-[#5170ff]/20" 
                                             src="https://ui-avatars.com/api/?name={{ urlencode($opinion['nombre']) }}&background=5170ff&color=fff&size=128" 
                                             alt="{{ $opinion['nombre'] }}">
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-[#70ff51] rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <h3 class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ $opinion['nombre'] }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Familia GoodTrav
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif

                <!-- Stats de confianza -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto fade-in-up animation-delay-400">
                    <div class="text-center">
                        <p class="text-4xl font-bold text-[#5170ff] mb-2">4.9/5</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Valoración media</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-bold text-[#70ff51] mb-2">500+</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Familias satisfechas</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-bold text-[#ff5170] mb-2">98%</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Recomendarían</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-bold text-[#5170ff] mb-2">15+</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Destinos visitados</p>
                    </div>
                </div>
            @else
                <!-- Estado vacío -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                        Próximamente testimonios
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Estamos recopilando las opiniones de nuestras familias
                    </p>
                </div>
            @endif
        </div>
    </section>
</div>

@push('styles')
    <style>
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .testimonial-carousel:hover {
            animation-play-state: paused;
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush
