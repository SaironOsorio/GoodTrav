<?php

namespace App\Filament\Resources\Announcements\Pages;

use App\Filament\Resources\Announcements\AnnouncementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\Announcement;

class ListAnnouncements extends ListRecords
{
    protected static string $resource = AnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];

        if (Announcement::count() === 0) {
            $actions[] = CreateAction::make()
                ->label('Nuevo anuncio');
        }

        return $actions;
    }
}
