{{-- filepath: d:\Projects\goodtrap\resources\views\livewire\weekly-challenges-card.blade.php --}}
<div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm">
    {{-- Header --}}
    <div class="mb-4">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Retos semanales</h3>
        <p class="text-sm text-[#5170ff] dark:text-[#6b8aff]">
            Completa tus actividades semanales
        </p>
    </div>

    {{-- Progress --}}
    <div class="mb-4">
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-600 dark:text-gray-400">Progreso</span>
            <span class="font-semibold text-gray-900 dark:text-white">{{ $completedCount }}/{{ $totalCount }}</span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-[#5170ff] h-2.5 rounded-full transition-all duration-500"
                 style="width: {{ $totalCount > 0 ? ($completedCount / $totalCount) * 100 : 0 }}%"></div>
        </div>
    </div>

    {{-- Pending Activities List --}}
    @if($pendingActivities->where('is_completed', false)->count() > 0)
        <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
            @foreach($pendingActivities->where('is_completed', false) as $activity)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-zinc-800 rounded-lg border border-gray-200 dark:border-zinc-700">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            @if($activity['type'] === 'quiz')
                                <svg class="w-4 h-4 text-[#5170ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            @elseif($activity['type'] === 'audio')
                                <svg class="w-4 h-4 text-[#5170ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                </svg>
                            @elseif($activity['type'] === 'video')
                                <svg class="w-4 h-4 text-[#5170ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @elseif($activity['type'] === 'reading')
                                <svg class="w-4 h-4 text-[#5170ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            @elseif($activity['type'] === 'writing')
                                <svg class="w-4 h-4 text-[#5170ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            @endif
                            <h4 class="font-medium text-sm text-gray-900 dark:text-white truncate">{{ $activity['title'] }}</h4>
                        </div>
                        @if(isset($activity['platform']))
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity['platform'] }}</p>
                        @endif
                        <p class="text-xs text-[#4ade80] font-semibold">+{{ $activity['points'] }} pts</p>
                    </div>
                    <button
                        wire:click="markAsCompleted({{ $activity['id'] }})"
                        class="ml-3 px-3 py-1.5 bg-[#5170ff] hover:bg-[#4060ef] text-white text-xs font-medium rounded-lg transition-colors">
                        Completar
                    </button>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-8">
            <svg class="w-16 h-16 mx-auto mb-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-gray-600 dark:text-gray-400 font-medium">¡Felicidades!</p>
            <p class="text-sm text-gray-500">Has completado todos los retos semanales</p>
        </div>
    @endif

    @if(session()->has('message'))
        <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
            <p class="text-sm text-green-800 dark:text-green-200">{{ session('message') }}</p>
        </div>
    @endif
</div>
