<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Society;
use App\Models\Setting;
use Livewire\WithFileUploads;

class Activitysociety extends Component
{
    use WithFileUploads;

    public $activities;
    public $is_activity_completed = false;
    public $is_activity_event_completed = false;
    public $count_user = 0;
    public $image;
    public $imageEvent;
    public $uploading = false;
    public $uploadingEvent = false;
    public $successMessage = '';
    public $successMessageEvent = '';
    public $pendingActivity = null;
    public $pendingEventActivity = null;

    public function mount()
    {
        $this->loadAllData();
    }

    private function loadAllData()
    {
        $this->LoadActivitiesPost();
        $this->LoadActiviesEvents();

        $this->count_user = Society::where('user_id', Auth::id())->count();

        // Verificar actividades pendientes DESPUÉS de cargar los estados completados
        $this->pendingActivity = Activity::where('user_id', Auth::id())
            ->where('type', 'post')
            ->where('status', 'pending')
            ->first();

        $this->pendingEventActivity = Activity::where('user_id', Auth::id())
            ->where('type', 'event')
            ->where('status', 'pending')
            ->first();
    }

    private function LoadActivitiesPost()
    {
        $approvedCount = Activity::where('user_id', Auth::id())
            ->where('type', 'post')
            ->where('status', 'approved')
            ->count();

        $this->is_activity_completed = $approvedCount >= 4;

        if($this->is_activity_completed && !Auth::user()->has_received_post_points)
        {
            $user = Auth::user();
            $user->increment('gt_points', 1000);
            $user->update(['has_received_post_points' => true]);
        }
    }

    private function LoadActiviesEvents()
    {
        $approvedCount = Activity::where('user_id', Auth::id())
            ->where('type', 'event')
            ->where('status', 'approved')
            ->count();

        $count = Setting::pluck('event_count')->first() ?? 1;

        $this->is_activity_event_completed = $approvedCount >= $count;

        if($this->is_activity_event_completed && !Auth::user()->has_received_event_points)
        {
            $user = Auth::user();
            $user->increment('gt_points', 1000);
            $user->update(['has_received_event_points' => true]);
        }
    }

    public function uploadImage()
    {
        // Verificar primero si ya completó las 4
        $approvedCount = Activity::where('user_id', Auth::id())
            ->where('type', 'post')
            ->where('status', 'approved')
            ->count();

        if ($approvedCount >= 4) {
            $this->successMessage = '';
            $this->addError('image', 'Ya completaste las 4 publicaciones requeridas.');
            return;
        }

        // Verificar si hay una imagen pendiente
        $hasPending = Activity::where('user_id', Auth::id())
            ->where('type', 'post')
            ->where('status', 'pending')
            ->exists();

        if ($hasPending) {
            $this->successMessage = '';
            $this->addError('image', 'Ya tienes una imagen pendiente de aprobación.');
            return;
        }

        $this->validate([
            'image' => 'required|image|max:2048',
        ]);

        $this->uploading = true;

        $path = $this->image->store('activities', 'public');

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'type' => 'post',
            'status' => 'pending',
            'image_path' => $path,
        ]);

        $this->uploading = false;
        $this->successMessage = 'Imagen subida correctamente. Espera a que sea aprobada.';
        $this->image = null;

        // Recargar datos
        $this->loadAllData();
    }

    public function uploadImageEvent()
    {
        // Verificar primero si ya completó los eventos requeridos
        $approvedCount = Activity::where('user_id', Auth::id())
            ->where('type', 'event')
            ->where('status', 'approved')
            ->count();

        $count = Setting::pluck('event_count')->first() ?? 1;

        if ($approvedCount >= $count) {
            $this->successMessageEvent = '';
            $this->addError('imageEvent', 'Ya completaste todos los eventos requeridos.');
            return;
        }

        // Verificar si hay una imagen pendiente
        $hasPending = Activity::where('user_id', Auth::id())
            ->where('type', 'event')
            ->where('status', 'pending')
            ->exists();

        if ($hasPending) {
            $this->successMessageEvent = '';
            $this->addError('imageEvent', 'Ya tienes una imagen de evento pendiente de aprobación.');
            return;
        }

        $this->validate([
            'imageEvent' => 'required|image|max:2048',
        ]);

        $this->uploadingEvent = true;

        $path = $this->imageEvent->store('activities', 'public');

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'type' => 'event',
            'status' => 'pending',
            'image_path' => $path,
        ]);

        $this->uploadingEvent = false;
        $this->successMessageEvent = 'Imagen de evento subida correctamente. Espera a que sea aprobada.';
        $this->imageEvent = null;

 
        $this->loadAllData();
    }

    public function render()
    {
        return view('livewire.activitysociety');
    }
}
