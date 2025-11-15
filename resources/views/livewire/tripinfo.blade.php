<div class="container mx-auto px-4 py-8">
    {{-- Sección: Mis viajes --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 poppins-bold">Mis viajes</h2>
        @if($reserver->isEmpty())
            <div class="bg-white border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-blue-800">
                    Aún no has reservado ningún viaje. Explora nuestros destinos y reserva tu próxima aventura.
                </p>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($reserver as $item)
                    <div class="group relative bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                        <div class="relative overflow-hidden">
                            <img
                                class="w-full h-56 object-cover rounded-t-2xl group-hover:scale-110 transition-transform duration-500"
                                src="{{ asset('storage/' . $item->image_path) }}"
                                alt="{{ $item->destination }}"
                                loading="lazy"
                            />
                            <div class="absolute top-4 right-4 poppins-bold">
                                <span class="px-4 py-2 bg-green-500 text-white font-bold text-sm rounded-full shadow-lg">
                                    RESERVADO
                                </span>
                            </div>
                        </div>

                        <div class="p-6 space-y-3">
                            <h5 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white poppins-bold text-center">
                                {{ strtoupper($item->destination) }}
                            </h5>


                            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-sm font-medium open-sans-regular">
                                    {{ \Carbon\Carbon::parse($item->start_date)->locale('es')->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->end_date)->locale('es')->format('d/m/Y') }}
                                </p>
                            </div>

                            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <p class="text-sm font-medium open-sans-regular">
                                    <span class="font-bold">{{ number_format($item->points) }}</span> Puntos GT
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="text-xs text-gray-500 open-sans-regular">Precio</p>
                                    <p class="text-3xl font-bold text-[#5170ff] open-sans-regular">€{{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Sección: Próximos viajes --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 poppins-bold">Próximos viajes</h2>

        @if($trips->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2 poppins-bold">
                    No hay viajes disponibles
                </h3>
                <p class="text-gray-500 dark:text-gray-400 montserrat-medium">
                    Pronto habrá nuevas aventuras disponibles. ¡Vuelve pronto!
                </p>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($trips as $trip)
                    @php
                        $user = Auth::user();
                        $canAccess = true;
                        $message = '';

                        $userRank = strtolower($userAgeCategory);
                        $tripRank = strtolower($trip->rank);

                        if ($userRank !== $tripRank) {
                            $canAccess = false;
                            $message = "No puedes acceder: eres {$userAgeCategory}.";
                        }

                        if ($user->gt_points < $trip->points) {
                            $canAccess = false;
                            $message = "No tienes suficientes puntos (" . number_format($user->gt_points) . "/" . number_format($trip->points) . " requeridos).";
                        }

                        $isReserved = $reserver->contains('trip_id', $trip->id);
                    @endphp

                    <div class="group relative bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden dark:bg-gray-800 dark:border-gray-700">
                        <!-- Imagen con overlay -->
                        <div class="relative overflow-hidden">
                            <img
                                class="w-full h-56 object-cover rounded-t-2xl group-hover:scale-110 transition-transform duration-500"
                                src="{{ asset('storage/' . $trip->image_path) }}"
                                alt="{{ $trip->destination }}"
                                loading="lazy"
                            />

                            <!-- Badge de categoría -->
                            <div class="absolute top-4 right-4 poppins-bold">
                                @if($trip->rank === 'junior')
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

                        <!-- Contenido -->
                        <div class="p-6 space-y-3">
                            <h5 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white hover:text-[#5170ff] transition-colors poppins-bold text-center">
                                {{ strtoupper($trip->destination) }}
                            </h5>

                            <p class="text-lg italic font-normal text-gray-700 dark:text-gray-300 -mt-2 text-center">
                                    {{ $trip->title }}
                            </p>

                            <p class="text-lg italic font-normal text-gray-700 dark:text-gray-300 -mt-2 text-center">
                                    {{ $trip->plazas_available }} plazas disponibles
                            </p>


                            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-[#5170ff]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                                </svg>

                                <p class="text-sm font-medium open-sans-regular">
                                    Salida: {{ $trip->city }}
                                </p>
                            </div>

                            <!-- Fechas -->
                            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-[#5170ff]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-sm font-medium open-sans-regular">
                                    {{ \Carbon\Carbon::parse($trip->start_date)->locale('es')->translatedFormat('d') }}–{{ \Carbon\Carbon::parse($trip->end_date)->locale('es')->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            <!-- Puntos GT -->
                            <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-[#70ff51]" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <p class="text-sm font-medium open-sans-regular">
                                    <span class="font-bold">{{ number_format($trip->points) }}</span> Puntos GT
                                </p>
                            </div>


                            @if($isReserved)
                                <!-- Ya reservado -->
                                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3">
                                    <p class="text-sm text-green-800 dark:text-green-200">
                                        ✓ Ya has reservado este viaje
                                    </p>
                                </div>
                            @elseif(!$canAccess)
                                <!-- Sin acceso -->
                                <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-3">
                                    <p class="text-sm text-amber-800 dark:text-amber-200">
                                        {{ $message }}
                                    </p>
                                </div>
                            @endif

                            <!-- Precio y botón -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="text-xs text-gray-500 open-sans-regular">Desde</p>
                                    <p class="text-3xl font-bold text-[#5170ff] open-sans-regular">€{{ number_format($trip->price, 2) }}</p>
                                </div>

                                @if($isReserved)
                                    <button disabled class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-green-500 rounded-lg cursor-not-allowed poppins-bold">
                                        Reservado
                                    </button>
                                @elseif(!$canAccess)
                                    <button disabled class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-500 bg-gray-300 dark:bg-zinc-700 rounded-lg cursor-not-allowed poppins-bold">
                                        Bloqueado
                                    </button>
                                @else
                                    <button
                                        wire:click="accessTrip('{{ $trip->slug }}')"
                                        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-[#5170ff] to-[#ff5170] rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300 focus:ring-4 focus:ring-[#5170ff]/50 poppins-bold cursor-pointer">
                                        Me interesa
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@push('styles')
<style>
    /* Animación suave para hover */
    .hover\:shadow-md {
        transition: box-shadow 0.3s ease;
    }

    /* Asegurar que las imágenes carguen correctamente */
    img[loading="lazy"] {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s ease-in-out infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
</style>
@endpush
