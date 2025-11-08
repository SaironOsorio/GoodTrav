<?php

namespace App\Filament\Resources\Contributors\Pages;

use App\Filament\Resources\Contributors\ContributorsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContributors extends EditRecord
{
    protected static string $resource = ContributorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
