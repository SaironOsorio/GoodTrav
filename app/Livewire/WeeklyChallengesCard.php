<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Study;
use App\Models\ChallengeAudioSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WeeklyChallengesCard extends Component
{
    public $completedCount = 0;
    public $totalCount = 0;
    public $totalPoints = 0;
    public $earnedPoints = 0;
    public $imagePath = null;

    public function mount()
    {
        $this->loadChallenges();
    }

    private function loadChallenges()
    {
        $user = Auth::user();

        // Obtener el estudio activo
        $study = Study::with('challenges')->first();

        if ($study && $study->challenges->count() > 0) {
            $this->totalCount = $study->challenges->count();
            $this->totalPoints = $study->challenges->sum('points');
            $this->imagePath = $study->image_reto ? asset('storage/' . $study->image_reto) : null;

            // Contar retos completados
            $this->completedCount = $study->challenges->filter(function ($challenge) use ($user) {
                // Verificar si está completado en la tabla pivot (por code)
                $isCompletedInPivot = DB::table('challenge_user')
                    ->where('user_id', $user->id)
                    ->where('challenge_code', $challenge->code)
                    ->exists();

                if ($isCompletedInPivot) {
                    return true;
                }

                // Si es audio, verificar si está aprobado
                if ($challenge->is_audio) {
                    $audioSubmission = ChallengeAudioSubmission::where('user_id', $user->id)
                        ->where('challenge_code', $challenge->code)
                        ->where('status', 'approved')
                        ->exists();
                    
                    return $audioSubmission;
                }

                return false;
            })->count();

            // Calcular puntos ganados
            $this->earnedPoints = $study->challenges->filter(function ($challenge) use ($user) {
                // Verificar si está completado en la tabla pivot (por code)
                $isCompletedInPivot = DB::table('challenge_user')
                    ->where('user_id', $user->id)
                    ->where('challenge_code', $challenge->code)
                    ->exists();

                if ($isCompletedInPivot) {
                    return true;
                }

                // Si es audio, verificar si está aprobado
                if ($challenge->is_audio) {
                    $audioSubmission = ChallengeAudioSubmission::where('user_id', $user->id)
                        ->where('challenge_code', $challenge->code)
                        ->where('status', 'approved')
                        ->exists();
                    
                    return $audioSubmission;
                }

                return false;
            })->sum('points');
        }
    }

    public function render()
    {
        return view('livewire.weekly-challenges-card');
    }
}