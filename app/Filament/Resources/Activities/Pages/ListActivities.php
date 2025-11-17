<?php

namespace App\Filament\Resources\Activities\Pages;

use App\Filament\Resources\Activities\ActivityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\EventCountWidget;
use Filament\Actions\Action;
use App\Models\Activity;
use App\Models\User;
use Filament\Notifications\Notification;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reset_all')
                ->label('Resetear todo')
                ->icon('heroicon-o-arrow-path')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('¿Resetear todas las actividades?')
                ->modalDescription('Esto eliminará todos los registros de actividades y resetará sistema. Esta acción no se puede deshacer.')
                ->modalSubmitActionLabel('Sí, resetear todo')
                ->action(function () {

                    Activity::truncate();

                    User::query()->update([
                        'has_received_post_points' => false,
                        'has_received_event_points' => false,
                    ]);

                    Notification::make()
                        ->title('Sistema reseteado')
                        ->body('Todas las actividades fueron eliminadas y los usuarios fueron reseteados.')
                        ->success()
                        ->send();

                }),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EventCountWidget::class,
        ];
    }
}
