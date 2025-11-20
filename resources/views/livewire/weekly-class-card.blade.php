<div class="bg-[#70ff51] dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm hover:shadow-md transition-shadow">
    {{-- Header --}}
    <div class="mb-4 flex items-start justify-between">
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1 poppins-bold">Clase de la Semana</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 montserrat-regular">{{ $formattedDateRange ?? 'No Date Available' }}</p>
        </div>

        {{-- Total Points Badge --}}
        <div class="bg-gradient-to-r from-[#5170ff] to-purple-500 text-white px-4 py-2 rounded-lg text-center shadow-lg flex-shrink-0">
            <div class="text-2xl font-bold poppins-bold">{{ $points  ?? 0}}</div>
            <div class="text-xs opacity-90 montserrat-regular">/ {{ $points ?? 0 }} pts</div>
        </div>
    </div>

    {{-- Video Preview Area --}}
    <div class="relative aspect-video  dark:bg-zinc-800 rounded-lg mb-4 flex items-center justify-center  dark:border-zinc-700">
        <div class="text-center">
            @if (empty($image))
                <img src="{{ asset('assets/images/image.svg')  }}" alt="Clase de la Semana" class="object-cover w-full h-full">
            @else
                <img src="{{ Storage::url($image)}}" alt="Clase de la Semana" class="object-cover w-full h-full">
            @endif
        </div>
    </div>

    {{-- Action Button --}}
    <a href="{{ route('study') }}"
       class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-[#ff5170] hover:bg-[#e04466] text-black font-medium rounded-lg transition-colors poppins-bold cursor-pointer"
       wire:navigate>
        Ir a la clase
    </a>
</div>
