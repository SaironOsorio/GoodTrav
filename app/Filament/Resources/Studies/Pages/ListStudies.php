<?php

namespace App\Filament\Resources\Studies\Pages;

use App\Filament\Resources\Studies\StudyResource;
use Filament\Actions\CreateAction;
use App\Models\Study;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudies extends ListRecords
{
    protected static string $resource = StudyResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        
        if (Study::count() === 0) {
            $actions[] = CreateAction::make()
                ->label('Nueva clase');
        }
        
        return $actions;
    }
    
    public function getTitle(): string
    {
        return 'Clases';
    }
}
