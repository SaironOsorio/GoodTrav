<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Study;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use App\Models\ChallengeAudioSubmission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StudyPage extends Component
{
     use WithFileUploads;
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
    public $isYoutubeVideo = false;
    public $youtubeVideoId = null;
    public $audioFile;
    public $uploadingChallengeCode;

    public function mount()
    {
        $this->loadStudyData();
        $this->checkVideoWatched();
        $this->checkIfYoutubeVideo();
    }

    private function checkVideoWatched()
    {
        $user = Auth::user();

        if ($user->current_study_id === $this->study->id && $user->has_watched_weekly_video) {
            $this->hasWatchedVideo = true;
        }
    }

    private function checkIfYoutubeVideo()
    {
        if ($this->study && $this->study->url_video) {
            $urlVideo = $this->study->url_video;


            if (preg_match('/(?:youtube\.com|youtu\.be)/', $urlVideo)) {
                $this->isYoutubeVideo = true;


                preg_match(
                    '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                    $urlVideo,
                    $matches
                );

                $this->youtubeVideoId = $matches[1] ?? null;
            } else {

                $this->isYoutubeVideo = false;
                $this->youtubeVideoId = null;
            }
        }
    }

    private function loadStudyData()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->study = Study::with(['challenges' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->first();

        if (!$this->study) {
            $this->challenges = collect();
            return;
        }

        $this->startDate = $this->study->start_date;
        $this->endDate = $this->study->end_date;
        $this->formattedDateRange = $this->startDate->format('M d') . ' - ' . $this->endDate->format('M d, Y');

        $this->challenges = $this->study->challenges->map(function ($challenge) use ($user) {
            $isCompleted = DB::table('challenge_user')
                ->where('user_id', $user->id)
                ->where('challenge_code', $challenge->code)
                ->exists();


            $audioSubmission = null;
            if ($challenge->is_audio) {
                $audioSubmission = \App\Models\ChallengeAudioSubmission::where('user_id', $user->id)
                    ->where('challenge_code', $challenge->code)
                    ->first();

                if ($audioSubmission && $audioSubmission->status === 'approved') {
                    $isCompleted = true;
                }
            }

            return [
                'id' => $challenge->id,
                'code' => $challenge->code,
                'title' => $challenge->title,
                'description' => $challenge->description,
                'points' => $challenge->points,
                'url_resource' => $challenge->url_resource,
                'is_audio' => $challenge->is_audio,
                'audio_file' => $challenge->audio_file,
                'type' => $this->getChallengeType($challenge),
                'platform' => $this->getPlatformName($challenge->url_resource),
                'is_completed' => $isCompleted,
                'audio_submission' => $audioSubmission,
            ];
        });


        $this->completedCount = $this->challenges->where('is_completed', true)->count();
        $this->totalPoints = $this->challenges->sum('points');


        $this->earnedPoints = $this->challenges
            ->where('is_completed', true)
            ->sum('points');
    }

    public function markVideoAsWatched()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();


        if ($user->current_study_id === $this->study->id && $user->has_watched_weekly_video) {
            session()->flash('error', 'Ya has recibido los puntos por ver este video.');
            return;
        }


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

        $alreadyCompleted = DB::table('challenge_user')
            ->where('user_id', $user->id)
            ->where('challenge_code', $challenge->code)
            ->exists();

        if ($alreadyCompleted) {
            session()->flash('error', 'Ya has completado este reto.');
            return;
        }

        DB::table('challenge_user')->insert([
            'user_id' => $user->id,
            'challenge_code' => $challenge->code,
            'created_at' => now(),
            'updated_at' => now(),
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

     public function uploadAudio($challengeCode)
    {
        $this->validate([
            'audioFile' => 'required|file|mimes:mp3,wav,ogg,m4a,webm|max:10240', // 10MB
        ], [
            'audioFile.required' => 'Debes seleccionar un archivo de audio',
            'audioFile.mimes' => 'El archivo debe ser MP3, WAV, OGG, M4A o WEBM',
            'audioFile.max' => 'El archivo no debe superar los 10MB',
        ]);

        $user = Auth::user();
        $challenge = Challenge::where('code', $challengeCode)->first();

        if (!$challenge) {
            session()->flash('error', 'Reto no encontrado.');
            return;
        }


        $existingSubmission = ChallengeAudioSubmission::where('user_id', $user->id)
            ->where('challenge_code', $challengeCode)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingSubmission) {
            if ($existingSubmission->status === 'approved') {
                session()->flash('error', 'Este reto ya fue aprobado.');
            } else {
                session()->flash('error', 'Ya tienes un audio en revisión para este reto.');
            }
            return;
        }

        try {
            $audioPath = $this->audioFile->store('challenge-audios', 'public');


            ChallengeAudioSubmission::create([
                'user_id' => $user->id,
                'challenge_code' => $challengeCode,
                'audio_path' => $audioPath,
                'status' => 'pending',
                'submitted_at' => now(),
            ]);

            session()->flash('message', '¡Audio enviado! Espera la revisión del administrador 🎙️');

            $this->audioFile = null;
            $this->uploadingChallengeCode = null;
            $this->loadStudyData();
        } catch (\Exception $e) {
            session()->flash('error', 'Error al subir el audio. Intenta de nuevo.');
            Log::error('Error uploading audio: ' . $e->getMessage());
        }
    }

    public function setUploadingChallenge($challengeCode)
    {
        $this->uploadingChallengeCode = $challengeCode;
    }

    public function cancelUpload()
    {
        $this->audioFile = null;
        $this->uploadingChallengeCode = null;
    }

    public function deleteSubmission($challengeCode)
    {
        $user = Auth::user();

        $submission = ChallengeAudioSubmission::where('user_id', $user->id)
            ->where('challenge_code', $challengeCode)
            ->where('status', 'rejected')
            ->first();

        if ($submission) {

            if (Storage::disk('public')->exists($submission->audio_path)) {
                Storage::disk('public')->delete($submission->audio_path);
            }

            $submission->delete();
            session()->flash('message', 'Audio eliminado. Puedes subir uno nuevo.');
            $this->loadStudyData();
        }
    }

    public function render()
    {
        return view('livewire.study-page');
    }
}
