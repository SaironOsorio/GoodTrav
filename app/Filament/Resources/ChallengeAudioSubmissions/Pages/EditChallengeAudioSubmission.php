<?php

namespace App\Filament\Resources\ChallengeAudioSubmissions\Pages;

use App\Filament\Resources\ChallengeAudioSubmissions\ChallengeAudioSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditChallengeAudioSubmission extends EditRecord
{
    protected static string $resource = ChallengeAudioSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($record) {
                    if ($record->audio_path && Storage::disk('public')->exists($record->audio_path)) {
                        Storage::disk('public')->delete($record->audio_path);
                    }
                })
                ->successNotificationTitle('Audio eliminado correctamente'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Revisión guardada correctamente';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['reviewed_at'] = now();
        $data['reviewed_by'] = Auth::id();

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        if ($record->status === 'approved') {
            $user = $record->user;
            $challenge = $record->challenge;

            if ($challenge && $user) {
                $alreadyCompleted = DB::table('challenge_user')
                    ->where('user_id', $user->id)
                    ->where('challenge_code', $challenge->code)
                    ->exists();

                if (!$alreadyCompleted) {

                    DB::table('challenge_user')->insert([
                        'user_id' => $user->id,
                        'challenge_code' => $challenge->code,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $user->increment('gt_points', $challenge->points);

                    \Filament\Notifications\Notification::make()
                        ->success()
                        ->title('✅ Puntos otorgados')
                        ->body("Se han otorgado {$challenge->points} puntos a {$user->name}")
                        ->send();
                } else {
                    \Filament\Notifications\Notification::make()
                        ->warning()
                        ->title('⚠️ Ya completado')
                        ->body('El usuario ya tenía este reto completado')
                        ->send();
                }
            }
        }
    }
}
