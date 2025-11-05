<div>
    {{-- Tabs --}}
    <div class="flex gap-2 mt-5 mb-6">
        <button
            wire:click="setTab('classes')"
            wire:navigate
            type="button"
            class="px-5 py-2.5 font-medium rounded-lg text-lg transition-colors cursor-pointer
                {{ $activeTab === 'classes'
                    ? 'text-white bg-[#5170ff] hover:bg-[#4158d0]'
                    : 'text-black hover:text-white border border-[#5170ff] hover:bg-[#4158d0]'
                }}">
            Clases
        </button>
        <button
            wire:click="setTab('challenges')"
            wire:navigate
            type="button"
            class="px-5 py-2.5 font-medium rounded-lg text-lg transition-colors cursor-pointer
                {{ $activeTab === 'challenges'
                    ? 'text-white bg-[#5170ff] hover:bg-[#4158d0]'
                    : 'text-black hover:text-white border border-[#5170ff] hover:bg-[#4158d0]'
                }}">
            Desafíos
            @if($challenges && $challenges->count() > 0)
                <span class="ml-2 px-2 py-0.5 bg-white/20 rounded-full text-xs">
                    {{ $challenges->where('is_completed', false)->count() }}
                </span>
            @endif
        </button>
    </div>

    {{-- Flash Messages --}}
    @if(session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg animate-fade-in">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-green-800 dark:text-green-200 font-medium">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg animate-fade-in">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Content --}}
    <div class="relative h-full flex-1 overflow-hidden rounded-xl">
        @if($activeTab === 'classes')
            {{-- Sección de Clase Semanal - Grid 2 columnas --}}
            <div class="grid gap-6 lg:grid-cols-3">
                {{-- Columna izquierda: Video (2/3) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 shadow-sm">
                        {{-- Header con título y badge --}}
                        <div class="p-6 pb-4 flex items-center justify-between border-b border-neutral-200 dark:border-neutral-700">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $study->title ?? 'Clase de esta semana' }}
                            </h3>
                            <span class="inline-flex items-center px-6 py-2 rounded-full text-xs font-semibold bg-[#5170ff] text-white">
                                {{ $formattedDateRange ?? 'Fecha de la clase' }}
                            </span>
                        </div>

                        {{-- Video Container --}}
                        <div class="p-6">
                            <div class="relative aspect-video bg-black rounded-xl overflow-hidden">
                                @if($study && $study->url_video)
                                    <video
                                        class="w-full h-full object-contain"
                                        controls
                                        controlsList="nodownload"
                                        preload="metadata">
                                        <source src="{{ Storage::url($study->url_video) }}" type="video/mp4">
                                        <source src="{{ Storage::url($study->url_video) }}" type="video/webm">
                                        <source src="{{ Storage::url($study->url_video) }}" type="video/ogg">
                                        Tu navegador no soporta la reproducción de video.
                                    </video>
                                @else
                                    {{-- Placeholder --}}
                                    <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-zinc-800">
                                        <div class="text-center">
                                            <svg class="w-20 h-20 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="text-gray-500 dark:text-gray-400">Video no disponible</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Action Button y puntos --}}
                            <div class="mt-4 flex items-center justify-between">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="text-[#4ade80] font-semibold">{{ $study->points ?? 100 }} puntos automáticos</span> por ver la clase.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Columna derecha: Descripción (1/3) --}}
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm h-full">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-neutral-200 dark:border-neutral-700">
                            Descripción
                        </h3>

                        {{-- Título --}}
                        <div class="mb-4">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $study->title ?? 'Título de la clase' }}
                            </h4>
                        </div>

                        {{-- Descripción --}}
                        @if($study && $study->description)
                            <div class="mb-4">
                                <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</h5>
                                <div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed prose prose-sm dark:prose-invert max-w-none">
                                    {!! $study->description !!}
                                </div>
                            </div>
                        @endif

                        {{-- Notas importantes --}}
                        @if($study && $study->notes)
                            <div class="mt-6 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-[#5170ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Notas importantes
                                </h5>
                                <div class="text-xs text-gray-600 dark:text-gray-400 prose prose-sm dark:prose-invert max-w-none">
                                    {!! $study->notes !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            {{-- Sección de Desafíos --}}
            <div id="retos-semanales" class="grid gap-6 md:grid-cols-2">
                {{-- Lista de desafíos activos --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Desafíos activos</h3>

                    @if($challenges && $challenges->where('is_completed', false)->count() > 0)
                        <div class="space-y-4">
                            @foreach($challenges->where('is_completed', false) as $challenge)
                                <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start gap-4">
                                        {{-- Icon --}}
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center
                                            {{ $challenge['type'] === 'quiz' ? 'bg-blue-100 dark:bg-blue-900' : '' }}
                                            {{ $challenge['type'] === 'audio' ? 'bg-green-100 dark:bg-green-900' : '' }}
                                            {{ $challenge['type'] === 'writing' ? 'bg-purple-100 dark:bg-purple-900' : '' }}
                                            {{ $challenge['type'] === 'video' ? 'bg-red-100 dark:bg-red-900' : '' }}
                                            {{ $challenge['type'] === 'reading' ? 'bg-yellow-100 dark:bg-yellow-900' : '' }}">

                                            @if($challenge['type'] === 'quiz')
                                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            @elseif($challenge['type'] === 'audio')
                                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                                </svg>
                                            @elseif($challenge['type'] === 'writing')
                                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            @elseif($challenge['type'] === 'video')
                                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ $challenge['title'] }}</h4>
                                            @if($challenge['description'])
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 line-clamp-2">{{ $challenge['description'] }}</p>
                                            @endif
                                            <div class="flex items-center gap-2 flex-wrap">
                                                @if($challenge['platform'])
                                                    <span class="text-xs text-gray-500 bg-gray-100 dark:bg-zinc-700 px-2 py-1 rounded">{{ $challenge['platform'] }}</span>
                                                @endif
                                                <span class="text-xs text-[#4ade80] font-semibold">+{{ $challenge['points'] }} pts</span>
                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-2 flex-shrink-0">
                                            @if($challenge['url_resource'])
                                                <a href="{{ $challenge['url_resource'] }}"
                                                   target="_blank"
                                                   class="px-4 py-2 bg-gray-200 dark:bg-zinc-700 hover:bg-gray-300 dark:hover:bg-zinc-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors text-center whitespace-nowrap">
                                                    Abrir
                                                </a>
                                            @endif
                                            <button
                                                wire:click="markAsCompleted('{{ $challenge['code'] }}')"
                                                class="px-4 py-2 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                                                Completar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-full mb-3 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">¡Felicidades! 🎉</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Has completado todos los retos</p>
                            <p class="text-xs text-[#5170ff] font-semibold">+{{ $totalPoints }} puntos ganados</p>
                        </div>
                    @endif
                </div>

                {{-- Estadísticas y progreso --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Tu progreso semanal</h3>

                    {{-- Stats Card --}}
                    <div class="bg-gradient-to-br from-[#5170ff] to-[#6b8aff] rounded-xl p-6 text-white mb-6 shadow-lg">
                        <h4 class="text-lg font-semibold mb-4">Estadísticas</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm opacity-90">Desafíos completados</span>
                                <span class="text-2xl font-bold">{{ $completedCount }}/{{ $challenges ? $challenges->count() : 0 }}</span>
                            </div>
                            <div class="w-full bg-white/20 rounded-full h-2">
                                <div class="bg-white h-2 rounded-full transition-all duration-500"
                                     style="width: {{ $challenges && $challenges->count() > 0 ? ($completedCount / $challenges->count()) * 100 : 0 }}%"></div>
                            </div>
                            <div class="flex justify-between items-center pt-3">
                                <span class="text-sm opacity-90">Puntos ganados</span>
                                <span class="text-2xl font-bold">{{ $earnedPoints }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Completados --}}
                    @if($challenges && $challenges->where('is_completed', true)->count() > 0)
                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Retos completados
                            </h4>
                            <div class="space-y-2">
                                @foreach($challenges->where('is_completed', true) as $challenge)
                                    <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                        <span class="text-sm text-gray-700 dark:text-gray-300 truncate flex-1">{{ $challenge['title'] }}</span>
                                        <span class="text-xs text-green-600 dark:text-green-400 font-semibold ml-2 flex-shrink-0">+{{ $challenge['points'] }} pts</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Estilos personalizados para el video */
    video::-webkit-media-controls-panel {
        background-color: rgba(0, 0, 0, 0.8);
    }

    video::-webkit-media-controls-play-button,
    video::-webkit-media-controls-volume-slider,
    video::-webkit-media-controls-mute-button,
    video::-webkit-media-controls-timeline,
    video::-webkit-media-controls-current-time-display,
    video::-webkit-media-controls-time-remaining-display,
    video::-webkit-media-controls-fullscreen-button {
        filter: brightness(1.2);
    }
</style>
@endpush
