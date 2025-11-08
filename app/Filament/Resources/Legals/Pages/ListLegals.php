<?php

namespace App\Filament\Resources\Legals\Pages;

use App\Filament\Resources\Legals\LegalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\legal;

class ListLegals extends ListRecords
{
    protected static string $resource = LegalResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        
        if (legal::count() === 0) {
            $actions[] = CreateAction::make()
                ->label('Nueva clase');
        }
        
        return $actions;
    }
}
