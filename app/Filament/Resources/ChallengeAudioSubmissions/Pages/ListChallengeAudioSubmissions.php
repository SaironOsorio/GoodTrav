<?php

namespace App\Filament\Resources\ChallengeAudioSubmissions\Pages;

use App\Filament\Resources\ChallengeAudioSubmissions\ChallengeAudioSubmissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListChallengeAudioSubmissions extends ListRecords
{
    protected static string $resource = ChallengeAudioSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
