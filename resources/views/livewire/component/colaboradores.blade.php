<div>
    <section class="bg-gradient-to-b from-gray-50 to-white dark:bg-gray-900 relative overflow-hidden">
        <!-- Elementos decorativos -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#70ff51]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#5170ff]/5 rounded-full blur-3xl"></div>

        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6 relative z-10">
            <!-- Header -->
            <div class="mx-auto max-w-screen-sm mb-8 lg:mb-16 fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#70ff51]/10 rounded-full mb-4">
                    <svg class="w-5 h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                    </svg>
                    <span class="text-sm font-semibold text-[#70ff51]">Colaboradores</span>
                </div>

                <h2 class="mb-4 text-4xl md:text-5xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Centros colaboradores
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    Trabajamos con las mejores instituciones educativas
                </p>
            </div>

            @if($colaboradores && $colaboradores->count() > 0)
                <!-- Carousel para móvil (siempre) -->
                <div class="relative overflow-hidden block md:hidden mb-8">
                    <!-- Gradientes laterales -->
                    <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-gray-50 to-transparent dark:from-gray-900 z-10 pointer-events-none"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-gray-50 to-transparent dark:from-gray-900 z-10 pointer-events-none"></div>

                    <div class="overflow-hidden">
                        <div class="flex colaboradores-carousel" style="animation: scroll 30s linear infinite;">
                            @foreach (array_merge($colaboradores->toArray(), $colaboradores->toArray()) as $colaborador)
                            <div class="flex-shrink-0 w-full px-4">
                                <div class="colaborador-card group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700">
                                    <!-- Logo -->
                                    <div class="mb-4 flex justify-center">
                                        <div class="w-32 h-32 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-700 flex items-center justify-center p-4">
                                            <img src="{{ Storage::url($colaborador['imagen_path']) }}"
                                                 alt="{{ $colaborador['name'] }}"
                                                 class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300">
                                        </div>
                                    </div>

                                    <!-- Nombre -->
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $colaborador['name'] }}
                                    </h3>

                                    <!-- URL -->
                                    @if($colaborador['url'])
                                    <a href="{{ $colaborador['url'] }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 text-[#5170ff] hover:text-[#ff5170] font-semibold transition-colors">
                                        <span>Visitar sitio web</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Desktop: Carousel si hay más de 4, Grid si hay 4 o menos -->
                @if($colaboradores->count() > 4)
                    <div class="relative overflow-hidden hidden md:block">
                        <!-- Gradientes laterales -->
                        <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-gray-50 to-transparent dark:from-gray-900 z-10 pointer-events-none"></div>
                        <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-gray-50 to-transparent dark:from-gray-900 z-10 pointer-events-none"></div>

                        <div class="overflow-hidden">
                            <div class="flex colaboradores-carousel" style="animation: scroll 40s linear infinite;">
                                @foreach (array_merge($colaboradores->toArray(), $colaboradores->toArray()) as $colaborador)
                                <div class="flex-shrink-0 w-1/2 lg:w-1/4 px-4">
                                    <div class="colaborador-card group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700 h-full">
                                        <!-- Logo -->
                                        <div class="mb-4 flex justify-center">
                                            <div class="w-32 h-32 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-700 flex items-center justify-center p-4">
                                                <img src="{{ Storage::url($colaborador['imagen_path']) }}"
                                                     alt="{{ $colaborador['name'] }}"
                                                     class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300">
                                            </div>
                                        </div>

                                        <!-- Nombre -->
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                            {{ $colaborador['name'] }}
                                        </h3>

                                        <!-- URL -->
                                        @if($colaborador['url'])
                                        <a href="{{ $colaborador['url'] }}"
                                           target="_blank"
                                           class="inline-flex items-center gap-2 text-[#5170ff] hover:text-[#ff5170] font-semibold transition-colors text-sm">
                                            <span>Visitar sitio web</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Grid estático para 4 o menos -->
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 hidden md:grid max-w-5xl mx-auto">
                        @foreach ($colaboradores as $index => $colaborador)
                        <div class="colaborador-card fade-in-up animation-delay-{{ $index * 100 }} group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 dark:border-gray-700">
                            <!-- Logo -->
                            <div class="mb-4 flex justify-center">
                                <div class="w-32 h-32 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-700 flex items-center justify-center p-4">
                                    <img src="{{ Storage::url($colaborador->imagen_path) }}"
                                         alt="{{ $colaborador->name }}"
                                         class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300">
                                </div>
                            </div>

                            <!-- Nombre -->
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ $colaborador->name }}
                            </h3>

                            <!-- URL -->
                            @if($colaborador->url)
                            <a href="{{ $colaborador->url }}"
                               target="_blank"
                               class="inline-flex items-center gap-2 text-[#5170ff] hover:text-[#ff5170] font-semibold transition-colors text-sm">
                                <span>Visitar sitio web</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif

            @else
                <!-- Estado vacío -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                        Próximamente colaboradores
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Estamos estableciendo alianzas con instituciones educativas
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

    .colaboradores-carousel:hover {
        animation-play-state: paused;
    }

    .colaborador-card {
        transition: all 0.3s ease;
    }

    .colaborador-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush


