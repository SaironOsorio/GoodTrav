<?php
// filepath: d:\Projects\goodtrap\app\Livewire\WeeklyChallengesCard.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Study;
use Illuminate\Support\Facades\Auth;

class WeeklyChallengesCard extends Component
{
    public $completedCount = 0;
    public $totalCount = 0;
    public $totalPoints = 0;
    public $earnedPoints = 0;

    public function mount()
    {
        $this->loadChallenges();
    }

    private function loadChallenges()
    {
        $user = Auth::user();

        // Obtener el estudio activo (ID 1 según tu configuración)
        $study = Study::with('challenges')->find(1);

        if ($study && $study->challenges->count() > 0) {
            $this->totalCount = $study->challenges->count();
            $this->totalPoints = $study->challenges->sum('points');

            // Contar retos completados
            $this->completedCount = $study->challenges->filter(function ($challenge) use ($user) {
                return $challenge->isCompletedBy($user);
            })->count();

            // Calcular puntos ganados
            $this->earnedPoints = $study->challenges->filter(function ($challenge) use ($user) {
                return $challenge->isCompletedBy($user);
            })->sum('points');
        }
    }

    public function render()
    {
        return view('livewire.weekly-challenges-card');
    }
}
