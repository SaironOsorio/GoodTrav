<?php

namespace App\Filament\Resources\Reservers\Pages;

use App\Filament\Resources\Reservers\ReserverResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReserver extends EditRecord
{
    protected static string $resource = ReserverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
