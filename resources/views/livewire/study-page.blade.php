<div>
    {{-- Tabs --}}
    <div class="flex gap-2 mt-5 mb-6">
        <button
            wire:click="setTab('classes')"
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
            type="button"
            class="px-5 py-2.5 font-medium rounded-lg text-lg transition-colors cursor-pointer
                {{ $activeTab === 'challenges'
                    ? 'text-white bg-[#5170ff] hover:bg-[#4158d0]'
                    : 'text-black hover:text-white border border-[#5170ff] hover:bg-[#4158d0]'
                }}">
            Desafíos
        </button>
    </div>

    {{-- Content --}}
    <div class="relative h-full flex-1 overflow-hidden rounded-xl">
        @if($activeTab === 'classes')
            {{-- Sección de Clase Semanal - Grid 2 columnas --}}
            <div class="grid gap-6 lg:grid-cols-3">
                {{-- Columna izquierda: Video (2/3) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm h-full">
                        {{-- Header con título y badge --}}
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Clase de esta semana</h3>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-[#5170ff] text-white">
                                Lunes 9:00 – Domingo 23:59
                            </span>
                        </div>

                        {{-- Video Container --}}
                        <div class="relative aspect-video bg-gray-100 dark:bg-zinc-800 rounded-xl mb-6 overflow-hidden">
                            {{-- Placeholder --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400">Video (Vimeo)</p>
                                </div>
                            </div>

                            {{-- Descomenta para video real --}}
                            {{--
                            <iframe
                                src="https://player.vimeo.com/video/YOUR_VIDEO_ID"
                                class="absolute inset-0 w-full h-full"
                                frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                            --}}
                        </div>

                        {{-- Action Button y puntos --}}
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="text-[#4ade80] font-semibold">100 puntos automáticos</span> por semana
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 shadow-sm h-full">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Descripción</h3>

                        {{-- Título --}}
                        <div class="mb-6">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-3">
                                Inglés para viajeros: Frases esenciales en el aeropuerto
                            </h4>
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-6">
                            <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</h5>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-3">
                                En esta clase aprenderás las frases más importantes que necesitas saber cuando viajas en avión.
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                Desde el check-in hasta la llegada a tu destino, cubriremos todo el vocabulario esencial.
                            </p>
                        </div>

                        {{-- Notas importantes --}}
                        <div class="mt-6">
                            <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Notas</h5>
                            <ul class="space-y-2 text-xs text-gray-600 dark:text-gray-400">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#5170ff] mt-0.5">•</span>
                                    <span>Duración: <strong>45 minutos</strong></span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#5170ff] mt-0.5">•</span>
                                    <span>Se recomienda tomar notas</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#5170ff] mt-0.5">•</span>
                                    <span>Disponible toda la semana</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#5170ff] mt-0.5">•</span>
                                    <span>Material de apoyo incluido</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Sección de Desafíos --}}
            <div class="grid gap-6 md:grid-cols-2">
                {{-- Lista de desafíos activos --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Desafíos activos</h3>
                    <div class="space-y-4">
                        {{-- Desafío 1 --}}
                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">Quiz: Vocabulario de animales</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Aprende los nombres de 20 animales en inglés</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500">Genially</span>
                                        <span class="text-xs text-[#4ade80] font-semibold">+150 pts</span>
                                    </div>
                                </div>
                                <button class="px-4 py-2 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-medium rounded-lg transition-colors">
                                    Iniciar
                                </button>
                            </div>
                        </div>

                        {{-- Desafío 2 --}}
                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">Audio: Conversación en restaurante</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Escucha y repite el diálogo completo</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500">SoundCloud</span>
                                        <span class="text-xs text-[#4ade80] font-semibold">+100 pts</span>
                                    </div>
                                </div>
                                <button class="px-4 py-2 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-medium rounded-lg transition-colors">
                                    Iniciar
                                </button>
                            </div>
                        </div>

                        {{-- Desafío 3 --}}
                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 dark:text-white mb-1">Escritura: Tu viaje ideal</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Escribe 100 palabras sobre tu destino soñado</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500">Google Forms</span>
                                        <span class="text-xs text-[#4ade80] font-semibold">+200 pts</span>
                                    </div>
                                </div>
                                <button class="px-4 py-2 bg-[#5170ff] hover:bg-[#4060ef] text-white text-sm font-medium rounded-lg transition-colors">
                                    Iniciar
                                </button>
                            </div>
                        </div>
                    </div>
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
                                <span class="text-2xl font-bold">3/8</span>
                            </div>
                            <div class="w-full bg-white/20 rounded-full h-2">
                                <div class="bg-white h-2 rounded-full" style="width: 37.5%"></div>
                            </div>
                            <div class="flex justify-between items-center pt-3">
                                <span class="text-sm opacity-90">Puntos ganados</span>
                                <span class="text-2xl font-bold">450</span>
                            </div>
                        </div>
                    </div>

                    {{-- Leaderboard mini --}}
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Top 5 esta semana</h4>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🥇</span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 dark:text-white">María García</p>
                                    <p class="text-xs text-gray-500">8/8 completados</p>
                                </div>
                                <span class="font-bold text-[#5170ff]">1200 pts</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🥈</span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 dark:text-white">Juan López</p>
                                    <p class="text-xs text-gray-500">7/8 completados</p>
                                </div>
                                <span class="font-bold text-[#5170ff]">950 pts</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🥉</span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 dark:text-white">Ana Martínez</p>
                                    <p class="text-xs text-gray-500">6/8 completados</p>
                                </div>
                                <span class="font-bold text-[#5170ff]">800 pts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
