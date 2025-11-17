<?php

namespace App\Filament\Resources\Reservers\Pages;

use App\Filament\Resources\Reservers\ReserverResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReservers extends ListRecords
{
    protected static string $resource = ReserverResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
