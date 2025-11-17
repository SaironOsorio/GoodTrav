<?php

namespace App\Filament\Resources\Reservers\Pages;

use App\Filament\Resources\Reservers\ReserverResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReserver extends ViewRecord
{
    protected static string $resource = ReserverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
