<?php

namespace App\Filament\Resources\Modals\Pages;

use App\Filament\Resources\Modals\ModalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\Modal;

class ListModals extends ListRecords
{
    protected static string $resource = ModalResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];

        if (Modal::count() === 0) {
            $actions[] = CreateAction::make()
                ->label('Nuevo anuncio');
        }

        return $actions;
    }
}
