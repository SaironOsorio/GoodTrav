{{-- filepath: d:\Projects\goodtrap\resources\views\livewire\weekly-challenges-card.blade.php --}}

<div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm hover:shadow-md transition-shadow">
    {{-- Header --}}
    <div class="p-6 pb-4 flex items-center justify-between border-b border-neutral-200 dark:border-neutral-700">
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">Retos semanales</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Completa tus actividades y gana puntos
            </p>
        </div>

        {{-- Total Points Badge --}}
        <div class="bg-gradient-to-r from-[#5170ff] to-purple-500 text-white px-4 py-2 rounded-lg text-center shadow-lg">
            <div class="text-2xl font-bold">{{ $earnedPoints }}</div>
            <div class="text-xs opacity-90">/ {{ $totalPoints }} pts</div>
        </div>
    </div>

    {{-- Progress Bar --}}
    <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800/50">
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-600 dark:text-gray-400">Progreso</span>
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $completedCount }}/{{ $totalCount }} completados
            </span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
            <div class="bg-gradient-to-r from-[#5170ff] to-purple-500 h-2 rounded-full transition-all duration-500 relative"
                 style="width: {{ $totalCount > 0 ? ($completedCount / $totalCount) * 100 : 0 }}%">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-shimmer"></div>
            </div>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            {{ $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0 }}% completado
        </p>
    </div>

    {{-- Action Button --}}
    <div class="p-6 pt-4">
        @if($totalCount > 0)
            <a href="{{ route('study') }}" wire:navigate
               class="w-full block px-4 py-3 bg-gradient-to-r from-[#5170ff] to-purple-500 hover:from-[#4060ef] hover:to-purple-600 text-white text-sm font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg text-center inline-flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                Ver todos los retos ({{ $totalCount - $completedCount }} pendientes)
            </a>
        @else
            <div class="text-center py-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">No hay retos disponibles</p>
            </div>
        @endif
    </div>

    {{-- Flash Messages --}}
    @if(session()->has('message'))
        <div class="mx-6 mb-6 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-600 dark:text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-green-800 dark:text-green-200 font-medium">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mx-6 mb-6 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-red-600 dark:text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .animate-shimmer {
        animation: shimmer 2s infinite;
    }
</style>
@endpush
