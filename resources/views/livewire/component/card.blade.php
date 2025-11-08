<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <!-- Header Section -->
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    Prepárate para tus próximos viajes dominando el inglés.
                </h2>
                <p class="text-black sm:text-xl dark:text-gray-400">
                    Nuestra comunidad te ayuda a ganar confianza, superar retos y comunicarte con el mundo.
                </p>
            </div>

            <!-- Banner de categorías - MOVIDO ARRIBA -->
            <div class="mb-8 bg-gradient-to-r from-[#5170ff] to-[#912539] rounded-2xl p-6 border-2 border-gray-200 shadow-lg">
                <div class="flex flex-col md:flex-row justify-center items-center gap-4 md:gap-8">
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-lg px-6 py-3">
                        <div class="w-3 h-3 rounded-full bg-[#70ff51] animate-pulse"></div>
                        <p class="text-white font-bold text-lg md:text-xl">
                            11-14 años: <span class="text-[#70ff51] font-extrabold">JUNIOR</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-lg px-6 py-3">
                        <div class="w-3 h-3 rounded-full bg-[#ff5170] animate-pulse"></div>
                        <p class="text-white font-bold text-lg md:text-xl">
                            15-18 años: <span class="text-[#ff5170] font-extrabold">SENIOR</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            @if($card && $card->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($card as $item)
                        <div class="group relative bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                            <!-- Imagen con overlay -->
                            <div class="relative overflow-hidden">
                                <img 
                                    class="w-full h-56 object-cover rounded-t-2xl group-hover:scale-110 transition-transform duration-500" 
                                    src="{{ Storage::url($item->image_path) }}" 
                                    alt="{{ $item->destination }}"
                                    loading="lazy"
                                />
                                
                                <!-- Badge de categoría sobre la imagen -->
                                <div class="absolute top-4 right-4">
                                    @if($item->rank === 'junior')
                                        <span class="px-4 py-2 bg-[#70ff51] text-black font-bold text-sm rounded-full shadow-lg">
                                            JUNIOR
                                        </span>
                                    @else
                                        <span class="px-4 py-2 bg-[#ff5170] text-white font-bold text-sm rounded-full shadow-lg">
                                            SENIOR
                                        </span>
                                    @endif
                                </div>

                                <!-- Gradient overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <!-- Contenido de la card -->
                            <div class="p-6 space-y-3">
                                <!-- Destino -->
                                <h5 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white hover:text-[#5170ff] transition-colors">
                                    {{ strtoupper($item->destination) }}
                                </h5>

                                <!-- Fechas -->
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                    <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-sm font-medium">
                                        {{ \Carbon\Carbon::parse($item->start_date)->locale('es')->translatedFormat('d') }}–{{ \Carbon\Carbon::parse($item->end_date)->locale('es')->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                                <!-- Puntos GT -->
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                    <svg class="w-5 h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <p class="text-sm font-medium">
                                        <span class="font-bold">{{ $item->points }}</span> Puntos GT
                                    </p>
                                </div>

                                <!-- Precio y botón -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div>
                                        <p class="text-3xl font-bold text-[#5170ff]">€{{ number_format($item->price, 2) }}</p>
                                        <p class="text-xs text-gray-500">por persona</p>
                                    </div>
                                    <a 
                                        href="#" 
                                        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-[#5170ff] to-[#ff5170] rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300 focus:ring-4 focus:ring-[#5170ff]/50">
                                        Me interesa
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Estado vacío mejorado -->
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                        No hay viajes disponibles
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Pronto habrá nuevas aventuras disponibles. ¡Vuelve pronto!
                    </p>
                </div>
            @endif

            <!-- Botones Ver más/menos mejorados -->
            @if ($tieneMasCards)
                <div class="flex justify-center mt-12">
                    <button 
                        type="button" 
                        wire:click="mostrarMasOmenos" 
                        class="group relative inline-flex items-center gap-2 px-8 py-3 text-base font-semibold text-white bg-gradient-to-r from-[#5170ff] to-[#ff5170] rounded-full hover:shadow-xl hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-[#5170ff]/50">
                        @if($mostrarTodas)
                            Ver menos viajes
                            <svg class="w-5 h-5 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                            </svg>
                        @else
                            Ver más viajes
                            <svg class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        @endif
                    </button>
                </div>
            @endif
        </div>
    </section>
</div>