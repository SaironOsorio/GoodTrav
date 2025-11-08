<?php

namespace App\Filament\Resources\Contributors\Pages;

use App\Filament\Resources\Contributors\ContributorsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContributors extends ListRecords
{
    protected static string $resource = ContributorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
