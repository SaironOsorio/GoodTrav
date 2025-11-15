<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Study;
use App\Models\ChallengeAudioSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeeklyChallengesCard extends Component
{
    public $completedCount = 0;
    public $totalCount = 0;
    public $totalPoints = 0;
    public $earnedPoints = 0;
    public $imagePath = null;
    public $startDate;
    public $endDate;
    public $formattedDateRange;

    public function mount()
    {
        $this->loadChallenges();
    }

    private function loadChallenges()
    {
        $user = Auth::user();

        $study = Study::with('challenges')->first();

        Carbon::setLocale('es');
        $start = Carbon::parse($study->start_date);
        $end = Carbon::parse($study->end_date);

        $this->startDate = $start;
        $this->endDate = $end;
        $this->formattedDateRange = ucfirst($start->isoFormat('ddd D MMM, HH:mm')) . ' - ' . ucfirst($end->isoFormat('ddd D MMM, HH:mm'));

        if ($study && $study->challenges->count() > 0) {
            $this->totalCount = $study->challenges->count();
            $this->totalPoints = $study->challenges->sum('points');
            $this->imagePath = $study->image_reto ? asset('storage/' . $study->image_reto) : null;


            $this->completedCount = $study->challenges->filter(function ($challenge) use ($user) {
                $isCompletedInPivot = DB::table('challenge_user')
                    ->where('user_id', $user->id)
                    ->where('challenge_code', $challenge->code)
                    ->exists();

                if ($isCompletedInPivot) {
                    return true;
                }

                if ($challenge->is_audio) {
                    $audioSubmission = ChallengeAudioSubmission::where('user_id', $user->id)
                        ->where('challenge_code', $challenge->code)
                        ->where('status', 'approved')
                        ->exists();

                    return $audioSubmission;
                }

                return false;
            })->count();


            $this->earnedPoints = $study->challenges->filter(function ($challenge) use ($user) {
                $isCompletedInPivot = DB::table('challenge_user')
                    ->where('user_id', $user->id)
                    ->where('challenge_code', $challenge->code)
                    ->exists();

                if ($isCompletedInPivot) {
                    return true;
                }


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
