<div>
    {{-- Tabs --}}
    <div class="flex gap-2 mt-5 mb-6">
        <button
            wire:click="setTab('classes')"
            wire:navigate
            type="button"
            class="px-5 py-2.5 font-medium rounded-lg text-lg transition-colors cursor-pointer poppins-bold
                {{ $activeTab === 'classes'
                    ? 'text-black bg-[#70ff51] hover:bg-[#62d647]'
                    : 'text-black hover:text-white border border-[#70ff51] hover:bg-[#62d647]'
                }}">
            Clases
        </button>
        <button
            wire:click="setTab('challenges')"
            wire:navigate
            type="button"
            class="px-5 py-2.5 font-medium rounded-lg text-lg transition-colors cursor-pointer poppins-bold
                {{ $activeTab === 'challenges'
                    ? 'text-black bg-[#ff5170] hover:bg-[#da4f68]'
                    : 'text-black hover:text-white border border-[#ff5170] hover:bg-[#da4f68]'
                }}">
            Retos
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
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white poppins-bold">
                                {{ $study->title ?? 'Clase de esta semana' }}
                            </h3>
                            <span class="inline-flex items-center px-6 py-2 rounded-full text-xs font-semibold bg-[#5170ff] text-white montserrat-medium">
                                {{ $formattedDateRange ?? 'Fecha de la clase' }}
                            </span>
                        </div>

                        {{-- Video Container --}}
                        <div class="p-6">
                            <div class="relative aspect-video bg-black rounded-xl overflow-hidden">
                                @if($study && $study->url_video)
                                        {{-- Video de YouTube con iframe --}}
                                        <iframe
                                            id="youtube-iframe"
                                            class="w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $youtubeVideoId }}?enablejsapi=1&rel=0&modestbranding=1"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>

                                        {{-- Indicador de progreso --}}
                                        @if(!$hasWatchedVideo)
                                            <div id="progressIndicator" class="absolute top-4 right-4 bg-black/70 backdrop-blur-sm px-4 py-2 rounded-lg text-white text-sm font-medium opacity-0 transition-opacity pointer-events-none z-10">
                                                <span id="watchPercentage">0%</span> visto
                                            </div>
                                        @endif
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

                            {{-- Botón de completar (sin cambios) --}}
                            <div class="mt-4">
                                @if($hasWatchedVideo)
                                    <div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                        <svg class="w-6 h-6 text-green-600 dark:text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold text-green-800 dark:text-green-200">Video completado</p>
                                            <p class="text-xs text-green-600 dark:text-green-400">+{{ $study->points }} puntos obtenidos ✓</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center gap-3">
                                        {{-- Barra de progreso --}}
                                        <div class="flex-1">
                                            <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400 mb-1">
                                                <span>Progreso del video</span>
                                                <span id="progressPercentageText">0%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                <div id="videoProgressBar" class="bg-[#5170ff] h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                            </div>
                                        </div>

                                        {{-- Botón --}}
                                        <button
                                            id="completeVideoBtn"
                                            wire:click="markVideoAsWatched"
                                            disabled
                                            class="px-6 py-2.5 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-[#5170ff] whitespace-nowrap">
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span id="btnText">Marcar como visto</span>
                                            </span>
                                        </button>
                                    </div>

                                    {{-- Mensaje informativo --}}
                                    <p id="unlockMessage" class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                                        📺 Ve al menos el <strong>80%</strong> del video para desbloquear el botón y ganar <strong class="text-[#4ade80]">{{ $study->points }} puntos</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Columna derecha: Descripción (1/3) --}}
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm h-full">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-neutral-200 dark:border-neutral-700 open-sans-bold">
                            Descripción
                        </h3>

                        {{-- Título --}}
                        <div class="mb-4">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white open-sans-medium">
                                {{ $study->title ?? 'Título de la clase' }}
                            </h4>-
                        </div>

                        {{-- Descripción --}}
                        @if($study && $study->description)
                            <div class="mb-4">
                                <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 open-sans-medium">Descripción</h5>
                                <div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed prose prose-sm dark:prose-invert max-w-none open-sans-regular">
                                    {!! $study->description !!}
                                </div>
                            </div>
                        @endif

                        {{-- Notas importantes --}}
                        @if($study && $study->notes)
                            <div class="mt-6 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2 open-sans-medium">
                                    <svg class="w-4 h-4 text-[#5170ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Notas importantes
                                </h5>
                                <div class="text-xs text-gray-600 dark:text-gray-400 prose prose-sm dark:prose-invert max-w-none open-sans-regular">
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
                                {{-- Si el reto es de audio --}}
                                @if($challenge['is_audio'])
                                    @php
                                        $submission = $challenge['audio_submission'] ?? null;
                                    @endphp

                                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start gap-4">
                                            {{-- Icon --}}
                                            <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center bg-green-100 dark:bg-green-900">
                                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                                </svg>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ $challenge['title'] }}</h4>
                                                @if($challenge['description'])
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 line-clamp-2">{{ $challenge['description'] }}</p>
                                                @endif
                                                <span class="text-xs text-[#4ade80] font-semibold">+{{ $challenge['points'] }} pts</span>

                                                {{-- Estado de la grabación --}}
                                                @if($submission)
                                                    <div class="mt-3 p-3 rounded-lg
                                                        {{ $submission->status === 'pending' ? 'bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800' : '' }}
                                                        {{ $submission->status === 'approved' ? 'bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800' : '' }}
                                                        {{ $submission->status === 'rejected' ? 'bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800' : '' }}">

                                                        @if($submission->status === 'pending')
                                                            <div class="flex items-center gap-2 mb-2">
                                                                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-yellow-600"></div>
                                                                <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-200">En revisión</p>
                                                            </div>
                                                            <p class="text-xs text-yellow-600 dark:text-yellow-400 mb-2">Tu audio está siendo revisado por el profesor</p>
                                                        @elseif($submission->status === 'approved')
                                                            <div class="flex items-center gap-2 mb-2">
                                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                                <p class="text-sm font-semibold text-green-800 dark:text-green-200">Aprobado</p>
                                                            </div>
                                                            <p class="text-xs text-green-600 dark:text-green-400 mb-2">+{{ $challenge['points'] }} puntos obtenidos ✓</p>
                                                        @else
                                                            <div class="flex items-center gap-2 mb-2">
                                                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                                <p class="text-sm font-semibold text-red-800 dark:text-red-200">Rechazado</p>
                                                            </div>
                                                            @if($submission->admin_feedback)
                                                                <p class="text-xs text-red-600 dark:text-red-400 mb-2"><strong>Motivo:</strong> {{ $submission->admin_feedback }}</p>
                                                            @endif
                                                        @endif

                                                        {{-- Reproductor de audio --}}
                                                        <audio controls class="w-full mt-2" preload="metadata">
                                                            <source src="{{ Storage::url($submission->audio_path) }}" type="audio/mpeg">
                                                            Tu navegador no soporta el elemento de audio.
                                                        </audio>

                                                        {{-- Botón para eliminar si fue rechazado --}}
                                                        @if($submission->status === 'rejected')
                                                            <button
                                                                wire:click="deleteSubmission('{{ $challenge['code'] }}')"
                                                                wire:confirm="¿Estás seguro de eliminar este audio?"
                                                                class="mt-2 w-full px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors">
                                                                🗑️ Eliminar y subir nuevo
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex flex-col gap-2 flex-shrink-0">
                                                @if(!$submission || $submission->status === 'rejected')
                                                    {{-- Formulario de subida --}}
                                                    @if($uploadingChallengeCode === $challenge['code'])
                                                        <div class="flex flex-col gap-2 min-w-[200px]">
                                                            <input
                                                                type="file"
                                                                wire:model="audioFile"
                                                                accept="audio/*,audio/mp3,audio/wav,audio/ogg,audio/m4a,audio/webm"
                                                                class="text-xs text-gray-500 file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#5170ff] file:text-white hover:file:bg-[#4060ef] file:cursor-pointer">

                                                            @error('audioFile')
                                                                <span class="text-xs text-red-500">{{ $message }}</span>
                                                            @enderror

                                                            <div wire:loading wire:target="audioFile" class="text-xs text-blue-500 flex items-center gap-2">
                                                                <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                </svg>
                                                                Subiendo archivo...
                                                            </div>

                                                            <div class="flex gap-2">
                                                                <button
                                                                    wire:click="uploadAudio('{{ $challenge['code'] }}')"
                                                                    wire:loading.attr="disabled"
                                                                    wire:target="uploadAudio"
                                                                    class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                                                                    <span wire:loading.remove wire:target="uploadAudio">✅ Enviar</span>
                                                                    <span wire:loading wire:target="uploadAudio" class="flex items-center gap-2">
                                                                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                                        </svg>
                                                                        Enviando...
                                                                    </span>
                                                                </button>
                                                                <button
                                                                    wire:click="cancelUpload"
                                                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                                                                    ❌
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <button
                                                            wire:click="setUploadingChallenge('{{ $challenge['code'] }}')"
                                                            class="px-4 py-2 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap flex items-center gap-2">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                            </svg>
                                                            Subir audio
                                                        </button>
                                                    @endif

                                                    @if($challenge['url_resource'])
                                                        <a href="{{ $challenge['url_resource'] }}"
                                                        target="_blank"
                                                        class="px-4 py-2 bg-gray-200 dark:bg-zinc-700 hover:bg-gray-300 dark:hover:bg-zinc-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors text-center whitespace-nowrap flex items-center gap-2 justify-center">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                            </svg>
                                                            Ver recurso
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Código existente para otros tipos de retos --}}
                                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-start gap-4">
                                            {{-- Icon --}}
                                            <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center
                                                {{ $challenge['type'] === 'quiz' ? 'bg-blue-100 dark:bg-blue-900' : '' }}
                                                {{ $challenge['type'] === 'writing' ? 'bg-purple-100 dark:bg-purple-900' : '' }}
                                                {{ $challenge['type'] === 'video' ? 'bg-red-100 dark:bg-red-900' : '' }}
                                                {{ $challenge['type'] === 'reading' ? 'bg-yellow-100 dark:bg-yellow-900' : '' }}">

                                                @if($challenge['type'] === 'quiz')
                                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
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
                                                    wire:click="markAsCompleted('{{ $challenge['code'] }}')"
                                                    class="px-4 py-2 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-medium rounded-lg transition-colors text-center whitespace-nowrap flex items-center gap-2 justify-center">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                        </svg>
                                                        Abrir y completar
                                                    </a>
                                                @else
                                                    <button
                                                        wire:click="markAsCompleted('{{ $challenge['code'] }}')"
                                                        class="px-4 py-2 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                                                        Completar
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
                                <span class="text-sm opacity-90">Retos completados</span>
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

                    {{-- Desafíos completados --}}
                    @if($challenges && $challenges->where('is_completed', true)->count() > 0)
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Desafíos completados
                            </h3>

                            <div class="space-y-3">
                                @foreach($challenges->where('is_completed', true) as $challenge)
                                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-green-200 dark:border-green-800 p-4">
                                        <div class="flex items-start gap-3">
                                            {{-- Icon --}}
                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center bg-green-100 dark:bg-green-900">
                                                @if($challenge['is_audio'])
                                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                                    </svg>
                                                @elseif($challenge['type'] === 'quiz')
                                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                @elseif($challenge['type'] === 'video')
                                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @endif
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-0.5">{{ $challenge['title'] }}</h4>
                                                <p class="text-xs text-green-600 dark:text-green-400 font-medium">✓ +{{ $challenge['points'] }} puntos obtenidos</p>

                                                {{-- Si es audio aprobado, mostrar reproductor --}}
                                                @if($challenge['is_audio'] && $challenge['audio_submission'] && $challenge['audio_submission']->status === 'approved')
                                                    <audio controls class="w-full mt-2 h-8" preload="metadata">
                                                        <source src="{{ Storage::url($challenge['audio_submission']->audio_path) }}" type="audio/mpeg">
                                                    </audio>
                                                @endif
                                            </div>
                                        </div>
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

@push('scripts')
@if($isYoutubeVideo && $youtubeVideoId)
<script src="https://www.youtube.com/iframe_api"></script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isYoutube = {{ $isYoutubeVideo ? 'true' : 'false' }};
    const hasWatched = {{ $hasWatchedVideo ? 'true' : 'false' }};

    if (hasWatched) return;

    const progressIndicator = document.getElementById('progressIndicator');
    const progressBar = document.getElementById('videoProgressBar');
    const progressText = document.getElementById('progressPercentageText');
    const watchPercentage = document.getElementById('watchPercentage');
    const completeBtn = document.getElementById('completeVideoBtn');
    const btnText = document.getElementById('btnText');
    const unlockMessage = document.getElementById('unlockMessage');
    const studyPoints = {{ $study->points ?? 100 }};

    let watchedSegments = [];
    const totalSegments = 10;
    const UNLOCK_THRESHOLD = 80;

    for (let i = 0; i < totalSegments; i++) {
        watchedSegments[i] = false;
    }

    function updateProgress(currentTime, duration) {
        const percentage = (currentTime / duration) * 100;
        const currentSegment = Math.floor(percentage / 10);

        if (currentSegment < totalSegments) {
            watchedSegments[currentSegment] = true;
        }

        const segmentsWatched = watchedSegments.filter(seg => seg === true).length;
        const coveragePercentage = (segmentsWatched / totalSegments) * 100;

        if (progressBar) progressBar.style.width = coveragePercentage + '%';

        if (progressText && watchPercentage) {
            const rounded = Math.round(coveragePercentage);
            progressText.textContent = rounded + '%';
            watchPercentage.textContent = rounded + '%';
        }

        if (progressIndicator) {
            progressIndicator.classList.remove('opacity-0');
            progressIndicator.classList.add('opacity-100');
        }

        if (coveragePercentage >= UNLOCK_THRESHOLD && completeBtn && completeBtn.disabled) {
            completeBtn.disabled = false;
            completeBtn.classList.add('animate-pulse');

            if (btnText) {
                btnText.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Obtener ${studyPoints} puntos
                `;
            }

            if (unlockMessage) {
                unlockMessage.innerHTML = '✅ <strong class="text-green-600">¡Botón desbloqueado!</strong> Haz clic cuando estés listo';
            }

            setTimeout(() => completeBtn.classList.remove('animate-pulse'), 3000);
        }
    }

    if (isYoutube) {
        let player;
        let updateInterval;

        window.onYouTubeIframeAPIReady = function() {
            player = new YT.Player('youtube-iframe', {
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
        };

        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING) {
                updateInterval = setInterval(() => {
                    const currentTime = player.getCurrentTime();
                    const duration = player.getDuration();
                    if (duration > 0) updateProgress(currentTime, duration);
                }, 1000);
            } else {
                if (updateInterval) clearInterval(updateInterval);
                if (progressIndicator) progressIndicator.classList.add('opacity-0');
            }
        }

        if (typeof YT !== 'undefined' && typeof YT.Player !== 'undefined') {
            onYouTubeIframeAPIReady();
        }
    } else {
        const video = document.getElementById('weeklyVideo');
        if (!video) return;

        video.addEventListener('timeupdate', () => updateProgress(video.currentTime, video.duration));
        video.addEventListener('pause', () => progressIndicator?.classList.add('opacity-0'));
        video.addEventListener('play', () => {
            progressIndicator?.classList.remove('opacity-0');
            progressIndicator?.classList.add('opacity-100');
        });
    }
});
</script>
@endpush
