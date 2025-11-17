<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use App\Models\Setting;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;

class EventCountWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.widgets.event-count-widget';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::first();
        $this->form->fill([
            'event_count' => $setting?->event_count ?? 0,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('event_count')
                    ->label('Número de eventos requeridos')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->helperText('Define cuántos eventos debe asistir un usuario para completar'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $this->validate();
        
        $data = $this->form->getState();

        $setting = Setting::first();
        if ($setting) {
            $setting->update(['event_count' => $data['event_count']]);
        } else {
            Setting::create(['event_count' => $data['event_count']]);
        }

        Notification::make()
            ->title('Configuración de eventos guardada')
            ->success()
            ->send();
    }

}
