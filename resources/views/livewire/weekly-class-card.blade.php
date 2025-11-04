<div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm hover:shadow-md transition-shadow">
    {{-- Header --}}
    <div class="mb-4">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $title }}</h3>
        <p class="text-sm text-[#5170ff] dark:text-[#6b8aff]">{{ $formattedDateRange }}</p>
    </div>

    {{-- Video Preview Area --}}
    <div class="relative aspect-video bg-gray-50 dark:bg-zinc-800 rounded-lg mb-4 flex items-center justify-center border border-gray-200 dark:border-zinc-700">
        <div class="text-center">
             <img src="{{ asset('storage/' . $image) }}" alt="">
        </div>
    </div>

    {{-- Action Button --}}
    <a href="{{ route('study') }}"
       class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-[#5170ff] hover:bg-[#4060ef] text-white font-medium rounded-lg transition-colors"
       wire:navigate>
        Ir a la clase
    </a>
</div>
