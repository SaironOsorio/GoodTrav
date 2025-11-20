<div class="bg-[#ff5170] dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm hover:shadow-md transition-shadow">
    {{-- Header --}}
    <div class="mb-4 flex items-start justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1 poppins-bold">Retos semanales</h3>
            <p class="text-sm text-black dark:text-gray-400 rounded-lg montserrat-regular">{{ $formattedDateRange }}</p>
        </div>

        {{-- Total Points Badge --}}
        <div class="bg-gradient-to-r from-[#5170ff] to-purple-500 text-white px-4 py-2 rounded-lg text-center shadow-lg flex-shrink-0">
            <div class="text-2xl font-bold">{{ $earnedPoints }}</div>
            <div class="text-xs opacity-90">/ {{ $totalPoints }} pts</div>
        </div>
    </div>

    {{-- Image --}}
    <div class="relative aspect-videorounded-lg mb-4 overflow-hidden">
        @if (empty($imagePath))
        <img src="{{ asset('assets/images/image.svg')  }}" alt="Retos semanales" class="object-cover w-full h-full">
        @else
        <img src="{{ $imagePath }}" alt="Retos semanales" class="object-cover w-full h-full">
        @endif
    </div>

    {{-- Action Button --}}
    @if($totalCount > 0)
        <a href="{{ route('study') }}" wire:navigate
            class="w-full block px-6 py-3 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-semibold rounded-lg transition-all duration-300 text-center inline-flex items-center justify-center gap-2 poppins-bold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            Ir a los retos ({{ $totalCount - $completedCount }} pendientes)
        </a>
    @else
        <div class="text-center py-4">
            <p class="text-sm text-gray-500 dark:text-gray-400 poppins-bold">No hay retos disponibles</p>
        </div>
    @endif
</div>
