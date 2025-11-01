<?php

namespace App\Livewire;

use Livewire\Component;

class WeeklyChallengesCard extends Component
{
    public $pendingActivities;
    public $completedCount;
    public $totalCount;

    public function mount()
    {
        $this->pendingActivities = collect([
            ['id' => 1, 'title' => 'Quiz: Vocabulario básico', 'type' => 'quiz', 'platform' => 'Genially', 'points' => 150, 'is_completed' => false],
            ['id' => 2, 'title' => 'Escucha: Conversación aeropuerto', 'type' => 'audio', 'platform' => 'SoundCloud', 'points' => 100, 'is_completed' => false],
            ['id' => 3, 'title' => 'Video: Present Perfect', 'type' => 'video', 'platform' => 'YouTube', 'points' => 120, 'is_completed' => false],
            ['id' => 4, 'title' => 'Lectura: Destinos Europa', 'type' => 'reading', 'platform' => 'Medium', 'points' => 80, 'is_completed' => false],
            ['id' => 5, 'title' => 'Escritura: Tu viaje ideal', 'type' => 'writing', 'platform' => 'Google Forms', 'points' => 200, 'is_completed' => false],
        ]);

        $this->completedCount = $this->pendingActivities->where('is_completed', true)->count();
        $this->totalCount = $this->pendingActivities->count();
    }

    public function markAsCompleted($activityId)
    {
        // Marcar como completado en el array
        $this->pendingActivities = $this->pendingActivities->map(function ($activity) use ($activityId) {
            if ($activity['id'] == $activityId) {
                $activity['is_completed'] = true;
            }
            return $activity;
        });

        // Actualizar contadores
        $this->completedCount = $this->pendingActivities->where('is_completed', true)->count();

        // Obtener puntos de la actividad
        $activity = $this->pendingActivities->firstWhere('id', $activityId);

        session()->flash('message', '¡Actividad completada! +' . $activity['points'] . ' puntos');
    }
    
    public function render()
    {
        return view('livewire.weekly-challenges-card');
    }
}
