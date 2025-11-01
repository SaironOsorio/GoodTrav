<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProfileCard extends Component
{
    public $user;
    public $points;
    public $nextMilestone = 30000;
    public $progressPercentage;

    public function mount()
    {
        $this->user = Auth::user();
        $this->points = $this->user->gt_points ?? 0;
        $this->calculateProgress();
    }

    public function calculateProgress()
    {
        $this->progressPercentage = min(($this->points / $this->nextMilestone) * 100, 100);
    }

    public function getUserLevel()
    {
        if ($this->points >= 0) return 'Principiante';
        if ($this->points < 20000) return 'Intermedio';
        if ($this->points < 30000) return 'Avanzado';
        if ($this->points < 50000) return 'Experto';
        return 'Maestro';
    }

        public function getUserYears()
    {
        if (!$this->user->date_of_birth) {
            return 'Sin edad';
        }

        $age = \Carbon\Carbon::parse($this->user->date_of_birth)->age;
        return $age . ' años';
    }

    public function getUserAgeCategory()
    {
        if (!$this->user->date_of_birth) {
            return 'Sin categoría';
        }

        $age = \Carbon\Carbon::parse($this->user->date_of_birth)->age;

        if ($age >= 11 && $age <= 14) {
            return 'Junior';
        } elseif ($age >= 15) {
            return 'Senior';
        } else {
            return 'Niño';
        }
    }

    public function render()
    {
        return view('livewire.user-profile-card', [
            'level' => $this->getUserLevel(),
            'years' => $this->getUserYears(),
            'ageCategory' => $this->getUserAgeCategory(),
        ]);
    }
}
