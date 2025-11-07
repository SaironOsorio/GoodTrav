<div class="container mx-auto px-4 py-8">
    {{-- Sección: Mis viajes --}}
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Mis viajes</h2>
        @if($reserver->isEmpty())
            <div class="bg-white  border border-blue-200  rounded-lg p-4 mb-6">
                <p class="text-sm text-blue-800 ">
                    Aún no has reservado ningún viaje. Explora nuestros destinos y reserva tu próxima aventura.
                </p>
            </div>
        @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($reserver as $item )
            <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm hover:shadow-md transition-shadow">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $item->destination }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">{{ $item->start_date }} - {{ $item->end_date }} · {{ $item->price }} EUR</p>
                <p class="text-xs text-gray-500 dark:text-gray-500 mb-4">{{ $item->user_type }} · {{ $item->points }} GT pts</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Sección: Próximos viajes --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Próximos viajes</h2>

        @if($trips->isEmpty())
            <div class="bg-white  border border-blue-200  rounded-lg p-4 mb-6">
                <p class="text-sm text-blue-800 ">
                    No hay próximos viajes disponibles en este momento. Por favor, vuelve más tarde para ver nuevas ofertas.
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
                    
                    // Verificar si ya lo tiene reservado
                    $isReserved = $reserver->contains('trip_id', $trip->id);
                @endphp
                <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-full h-48 overflow-hidden bg-gray-100 dark:bg-zinc-800">
                        <img
                            class="w-full h-full object-cover"
                            src="{{ asset('storage/' . $trip->image_path) }}"
                            alt="{{ $trip->destination }}"
                            loading="lazy"
                        >
                    </div>

                    {{-- Contenido --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $trip->destination }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                            {{ \Carbon\Carbon::parse($trip->start_date)->locale('es')->translatedFormat('d') }}–{{ \Carbon\Carbon::parse($trip->end_date)->locale('es')->translatedFormat('d F Y') }} · {{ number_format($trip->price) }} EUR
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mb-4">{{ ucfirst($trip->rank) }} · {{ number_format($trip->points) }} GT pts</p>

                        @if($isReserved)
                            {{-- Ya reservado --}}
                            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3 mb-4">
                                <p class="text-sm text-green-800 dark:text-green-200">
                                    ✓ Ya has reservado este viaje
                                </p>
                            </div>
                            <button
                                disabled
                                class="w-full px-4 py-2.5 bg-green-500 text-white text-sm font-semibold rounded-lg cursor-not-allowed">
                                Reservado
                            </button>
                        @elseif(!$canAccess)
                            {{-- Sin acceso --}}
                            <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-3 mb-4">
                                <p class="text-sm text-amber-800 dark:text-amber-200">
                                    {{ $message }}
                                </p>
                            </div>
                            <button
                                disabled
                                class="w-full px-4 py-2.5 bg-gray-300 dark:bg-zinc-700 text-gray-500 dark:text-gray-500 text-sm font-semibold rounded-lg cursor-not-allowed">
                                Acceder
                            </button>
                        @else
                            {{-- Puede acceder/reservar --}}
                            <button
                                wire:click="accessTrip('{{ $trip->slug }}')"
                                class="w-full px-4 py-2.5 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-semibold rounded-lg transition-colors shadow-md hover:shadow-lg cursor-pointer">
                                Acceder
                            </button>
                        @endif
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
