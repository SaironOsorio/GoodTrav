<x-layouts.app :title="__('GT Points')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="font-bold text-4xl text-[#5170ff] poppins-extrabold">{{ __('GT Points') }}</h1>
        <h2 class="font-light text-2xl montserrat-medium">{{ __('Earn GT Points and Travel') }}</h2>

        <div class="bg-white rounded-2xl p-8 shadow-sm">
            <h3 class="text-2xl font-bold mb-6 poppins-bold">{{ __('Gana GT Points para viajar') }}</h3>

            <!-- Tabla horizontal -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>

                    </thead>
                    <tbody>
                        <!-- Ver clase semanal -->
                        <tr class="border-b border-gray-200">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <h4 class="font-semibold poppins-bold">{{ __('Ver clase') }}</h4>
                                        <p class="text-xs text-gray-500 montserrat-regular">{{ __('(semanal)') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                @php
                                    $class = App\Models\Study::first();
                                    $points = $class->points;
                                @endphp
                                <span class="font-bold text-black poppins-bold">{{ $points }} GT Points</span>
                            </td>
                            <td class="p-4 text-center">
                                @if(auth()->user()->has_watched_weekly_video)
                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __('✓ Completado') }}
                                    </span>
                                @else
                                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __('Automático') }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if(auth()->user()->has_watched_weekly_video)
                                    <button disabled class="bg-[#70ff51] text-black px-4 py-2 rounded-lg text-sm cursor-not-allowed poppins-medium">
                                        {{ __('Completado') }}
                                    </button>
                                @else
                                    <a href="{{ route('study') }}" class="bg-[#70ff51] hover:bg-[#5eea3e] text-black px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                                        {{ __('Completar') }}
                                    </a>
                                @endif
                            </td>
                        </tr>

                        @php
                            $retostotal = App\Models\Challenge::all();
                            $pointstotal = $retostotal->sum('points');
                            $currentStudy = \App\Models\Study::find(auth()->user()->current_study_id);


                            // Obtener TODOS los retos del estudio actual
                            $allChallenges = $currentStudy?->challenges ?? collect();
                            $totalAvailableChallenges = $allChallenges->count();

                            // Calcular retos completados (IGUAL QUE EN STUDYPAGE)
                            $completedCount = 0;
                            $earnedPoints = 0;

                            foreach ($allChallenges as $challenge) {
                                $isCompleted = false;

                                if ($challenge->is_audio) {
                                    // Verificar en challenge_audio_submissions - AUDIO APROBADO
                                    $audioSubmission = \App\Models\ChallengeAudioSubmission::where('user_id', auth()->id())
                                        ->where('challenge_code', $challenge->code)
                                        ->where('status', 'approved')
                                        ->exists();

                                    $isCompleted = $audioSubmission;
                                } else {
                                    // Verificar en challenge_user - RETO NORMAL COMPLETADO
                                    $normalChallenge = \Illuminate\Support\Facades\DB::table('challenge_user')
                                        ->where('user_id', auth()->id())
                                        ->where('challenge_code', $challenge->code)
                                        ->exists();

                                    $isCompleted = $normalChallenge;
                                }

                                if ($isCompleted) {
                                    $completedCount++;
                                    $earnedPoints += $challenge->points;
                                }
                            }

                            // Verificar si TODOS están completados
                            $allChallengesCompleted = ($totalAvailableChallenges > 0) && ($completedCount === $totalAvailableChallenges);

                            // Obtener el primer reto pendiente
                            $currentChallenge = null;
                            $audioSubmission = null;

                            if (!$allChallengesCompleted && $totalAvailableChallenges > 0) {
                                // Buscar el primer reto NO completado
                                foreach ($allChallenges as $challenge) {
                                    $isCompleted = false;

                                    if ($challenge->is_audio) {
                                        $audioCheck = \App\Models\ChallengeAudioSubmission::where('user_id', Auth::id())
                                            ->where('challenge_code', $challenge->code)
                                            ->where('status', 'approved')
                                            ->exists();

                                        $isCompleted = $audioCheck;
                                    } else {
                                        $normalCheck = \Illuminate\Support\Facades\DB::table('challenge_user')
                                            ->where('user_id', Auth::id())
                                            ->where('challenge_code', $challenge->code)
                                            ->exists();

                                        $isCompleted = $normalCheck;
                                    }

                                    // Si NO está completado, es el próximo
                                    if (!$isCompleted) {
                                        $currentChallenge = $challenge;

                                        // Si es audio, obtener su submission para ver estado
                                        if ($challenge->is_audio) {
                                            $audioSubmission = \App\Models\ChallengeAudioSubmission::where('user_id', Auth::id())
                                                ->where('challenge_code', $challenge->code)
                                                ->first();
                                        }
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <tr class="border-b border-gray-200">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div>
                                        <h4 class="font-semibold poppins-bold">{{ __('Completar reto') }}</h4>
                                        <p class="text-xs text-gray-500 montserrat-regular">{{ __('(semanal)') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="font-bold text-black poppins-bold">
                                     {{ $pointstotal }} GT Points
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                @if($allChallengesCompleted)
                                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __('✓ Completado') }}
                                    </span>
                                @elseif($audioSubmission && $audioSubmission->status === 'pending')
                                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __('⏳ Pendiente') }}
                                    </span>
                                @elseif($audioSubmission && $audioSubmission->status === 'rejected')
                                    <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __('❌ Rechazado') }}
                                    </span>
                                @else
                                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ __('Automático') }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if($allChallengesCompleted)
                                    <button disabled class="bg-[#70ff51] text-black px-4 py-2 rounded-lg text-sm cursor-not-allowed poppins-medium">
                                        {{ __('Completado') }}
                                    </button>
                                @elseif($currentChallenge)
                                    <a href="{{ route('study') }}" class="inline-block bg-[#70ff51] hover:bg-[#5eea3e] text-black px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                                        {{ __('Completar') }}
                                    </a>
                                @else
                                    @if($totalAvailableChallenges > 0 && $completedCount === 0)
                                        <a href="{{ route('study') }}" class="inline-block bg-[#70ff51] hover:bg-[#5eea3e] text-black px-4 py-2 rounded-lg text-sm font-medium transition cursor-pointer">
                                            {{ __('Completar') }}
                                        </a>
                                    @else
                                        <button disabled class="bg-gray-200 text-gray-400 px-4 py-2 rounded-lg text-sm cursor-not-allowed">
                                            {{ __('No disponible') }}
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <livewire:points-social />
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="bg-white rounded-2xl p-8 shadow-sm">
            <h1 class="text-4xl font-bold mb-4 poppins-extrabold bg-gradient-to-br from-pink-500 to-orange-400
                bg-clip-text text-transparent">¿Eres miembro de Goodtrav Society?</h1>
            <h3 class="text-2xl font-bold mb-6 poppins-bold">{{ __('Gana extra GT Points y viaja antes') }}</h3>
            <livewire:activitysociety />
        </div>
    </div>
</x-layouts.app>
