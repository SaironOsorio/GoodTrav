<x-layouts.app :title="__('GT Points')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="font-bold text-4xl text-[#5170ff] poppins-extrabold">{{ __('GT Points') }}</h1>
        <h2 class="font-light text-2xl montserrat-medium">{{ __('Earn points by studying and traveling') }}</h2>

        <div class="bg-white rounded-2xl p-8 shadow-sm">
            <h3 class="text-2xl font-bold mb-6 poppins-bold">{{ __('Cómo ganar puntos') }}</h3>

            <div class="flex gap-4 mb-6">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex-shrink-0"></div>
                <div class="flex-1">
                    <h4 class="font-semibold text-lg mb-1 poppins-bold">{{ __('Ver la clase semanal') }}</h4>
                    <p class="text-blue-600 text-sm mb-2 montserrat-medium">{{ __('Ganas los puntos de la semana') }}</p>
                    @if(auth()->user()->has_watched_weekly_video)
                        <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                            {{ __('✓ Completado') }}
                        </button>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ __('Visto el') }} {{ auth()->user()->video_watched_at?->format('d/m/Y') }}
                        </p>
                    @else
                        <form action="{{ route('study') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                {{ __('Ver la Clase') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Completar reto semanal -->
            <div class="flex gap-4 mb-6">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex-shrink-0"></div>
                <div class="flex-1">
                    <h4 class="font-semibold text-lg mb-1 poppins-bold">{{ __('Completar reto semanal') }}</h4>
                    <p class="text-gray-600 text-sm mb-2 montserrat-medium">{{ __('Aprobación profesor si es un audio') }}</p>
                    @php
                        $currentStudy = \App\Models\Study::find(auth()->user()->current_study_id);
                        $currentChallenge = $currentStudy?->challenges()->first();
                        $userChallenge = $currentChallenge ? auth()->user()->challenges()
                            ->where('challenges.code', $currentChallenge->code)
                            ->first() : null;
                        $audioSubmission = $currentChallenge && $currentChallenge->is_audio
                            ? $currentChallenge->getUserSubmission(auth()->id())
                            : null;
                    @endphp

                    @if($userChallenge && $userChallenge->pivot->is_completed)
                        <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                            {{ __('✓ Completado') }}
                        </button>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ __('+') }}{{ $userChallenge->pivot->points_earned }} {{ __('puntos ganados') }}
                        </p>
                    @elseif($audioSubmission && $audioSubmission->status === 'pending')
                        <button disabled class="bg-yellow-300 text-yellow-800 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                            {{ __('⏳ Pendiente aprobación') }}
                        </button>
                    @elseif($audioSubmission && $audioSubmission->status === 'rejected')
                        <div>
                            <button disabled class="bg-red-300 text-red-800 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed mb-2">
                                {{ __('❌ Rechazado') }}
                            </button>
                            @if($audioSubmission->admin_feedback)
                                <p class="text-xs text-red-600">{{ $audioSubmission->admin_feedback }}</p>
                            @endif
                            <a href="{{ route('challenges.show', $currentChallenge->code) }}" class="text-blue-600 text-sm hover:underline">
                                {{ __('Intentar de nuevo') }}
                            </a>
                        </div>
                    @else
                        @if($currentChallenge)
                            <a href="{{ route('challenges.show', $currentChallenge->code) }}" class="inline-block bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                {{ __('Ir al reto (+') }}{{ $currentChallenge->points }}{{ __(')') }}
                            </a>
                        @else
                            <button disabled class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                                {{ __('No hay reto disponible') }}
                            </button>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Seguirnos en redes -->
            <div class="flex gap-4 mb-6">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex-shrink-0"></div>
                <div class="flex-1">
                    <h4 class="font-semibold text-lg mb-1 poppins-bold">{{ __('Seguirnos en redes') }}</h4>
                    <p class="text-gray-600 text-sm mb-2 montserrat-medium">{{ __('+500 IG y +500 TikTok (una sola vez)') }}</p>
                    @php
                        $socialMedia = \App\Models\Socialmedia::first();
                        $tiktok = trim($socialMedia?->tiktok ?? 'goodtrap');
                        $instagram = trim($socialMedia?->instagram ?? 'goodtrap');
                    @endphp
                    <div class="flex gap-2">
                        <a href="https://www.tiktok.com/search/user?q={{ $tiktok }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                            {{ __('TikTok +500') }}
                        </a>
                        <a href="https://www.instagram.com/{{ $instagram }}" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                            {{ __('IG +500') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
