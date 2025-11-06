<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Study;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudyPage extends Component
{
    public $activeTab = 'classes';
    public $study;
    public $challenges;
    public $completedCount = 0;
    public $totalPoints = 0;
    public $earnedPoints = 0;
    public $startDate;
    public $endDate;
    public $formattedDateRange;
    public $hasWatchedVideo = false;

    public function mount()
    {
        $this->loadStudyData();
        $this->checkVideoWatched();
    }

    private function checkVideoWatched()
    {
        $user = Auth::user();

        if ($user->current_study_id === $this->study->id && $user->has_watched_weekly_video) {
            $this->hasWatchedVideo = true;
        }
    }

    private function loadStudyData()
    {
        $user = Auth::user();

        $this->study = Study::with(['challenges' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->find(1);

        if ($this->study) {
            Carbon::setLocale('es');
            $start = Carbon::parse($this->study->start_date);
            $end = Carbon::parse($this->study->end_date);

            $this->startDate = $start;
            $this->endDate = $end;
            $this->formattedDateRange = ucfirst($start->isoFormat('ddd D MMM, HH:mm')) . ' - ' . ucfirst($end->isoFormat('ddd D MMM, HH:mm'));
        }

        if ($this->study && $this->study->challenges->count() > 0) {
            $this->challenges = $this->study->challenges->map(function ($challenge) use ($user) {
                $isCompleted = $challenge->isCompletedBy($user);

                return [
                    'id' => $challenge->id,
                    'code' => $challenge->code,
                    'title' => $challenge->title,
                    'description' => $challenge->description,
                    'points' => $challenge->points,
                    'url_resource' => $challenge->url_resource,
                    'is_audio' => $challenge->is_audio,
                    'type' => $this->getChallengeType($challenge),
                    'platform' => $this->getPlatformName($challenge->url_resource),
                    'is_completed' => $isCompleted,
                ];
            });

            $this->completedCount = $this->challenges->where('is_completed', true)->count();
            $this->totalPoints = $this->challenges->sum('points');
            $this->earnedPoints = $this->challenges->where('is_completed', true)->sum('points');
        } else {
            $this->challenges = collect([]);
        }
    }

    public function markVideoAsWatched()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();


        if ($user->current_study_id === $this->study->id && $user->has_watched_weekly_video) {
            session()->flash('error', 'Ya has recibido los puntos por ver este video.');
            return;
        }

        // Otorgar puntos
        $user->gt_points += $this->study->points;
        $user->has_watched_weekly_video = true;
        $user->video_watched_at = now();
        $user->current_study_id = $this->study->id;
        $user->save();

        $this->hasWatchedVideo = true;

        session()->flash('message', '¡Felicidades! Has ganado ' . $this->study->points . ' puntos por ver el video 🎉');

        $this->loadStudyData();
    }

    private function getChallengeType($challenge): string
    {
        if ($challenge->is_audio) {
            return 'audio';
        }

        $url = strtolower($challenge->url_resource ?? '');
        $title = strtolower($challenge->title);

        if (str_contains($url, 'youtube') || str_contains($url, 'vimeo') || str_contains($url, 'youtu.be')) {
            return 'video';
        }

        if (str_contains($url, 'genially') || str_contains($title, 'quiz')) {
            return 'quiz';
        }

        if (str_contains($url, 'forms') || str_contains($url, 'typeform') || str_contains($title, 'escritura')) {
            return 'writing';
        }

        return 'reading';
    }

    private function getPlatformName(?string $url): string
    {
        if (empty($url)) {
            return '';
        }

        $url = strtolower($url);

        if (str_contains($url, 'youtube') || str_contains($url, 'youtu.be')) {
            return 'YouTube';
        }
        if (str_contains($url, 'vimeo')) {
            return 'Vimeo';
        }
        if (str_contains($url, 'genially')) {
            return 'Genially';
        }
        if (str_contains($url, 'forms.google')) {
            return 'Google Forms';
        }
        if (str_contains($url, 'typeform')) {
            return 'Typeform';
        }
        if (str_contains($url, 'soundcloud')) {
            return 'SoundCloud';
        }
        if (str_contains($url, 'spotify')) {
            return 'Spotify';
        }

        return 'Enlace externo';
    }

    public function markAsCompleted($challengeCode)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $challenge = Challenge::where('code', $challengeCode)->first();

        if (!$challenge) {
            session()->flash('error', 'Reto no encontrado.');
            return;
        }

        if ($challenge->isCompletedBy($user)) {
            session()->flash('error', 'Ya has completado este reto.');
            return;
        }


        $user->challenges()->attach($challenge->code, [
            'is_completed' => true,
            'completed_at' => now(),
            'points_earned' => $challenge->points,
        ]);


        $user->gt_points += $challenge->points;
        $user->save();

        $this->loadStudyData();
        session()->flash('message', '¡Reto completado! +' . $challenge->points . ' puntos 🎉');
    }


    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.study-page');
    }
}
