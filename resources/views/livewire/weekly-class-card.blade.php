<div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm hover:shadow-md transition-shadow">
    {{-- Header --}}
    <div class="mb-4">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $title }}</h3>
        <p class="text-sm text-[#5170ff] dark:text-[#6b8aff]">{{ $schedule }}</p>
    </div>

    {{-- Video Preview Area --}}
    <div class="relative aspect-video bg-gray-50 dark:bg-zinc-800 rounded-lg mb-4 flex items-center justify-center border border-gray-200 dark:border-zinc-700">
        <div class="text-center">
            <svg class="w-12 h-12 mx-auto mb-2 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $videoType }}</p>
        </div>
    </div>

    {{-- Action Button --}}
    <a href="{{ $classUrl }}"
       class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-[#5170ff] hover:bg-[#4060ef] text-white font-medium rounded-lg transition-colors"
       wire:navigate>
        Ver clase
    </a>
</div>
