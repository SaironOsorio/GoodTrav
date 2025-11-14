<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Socialmedia;
use Filament\Support\Icons\Heroicon;
use Filament\Forms;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use UnitEnum;
use BackedEnum;
use Filament\Actions\Action;

class SocialMediaSettings extends Page
{
    use InteractsWithSchemas;

    protected static ?string $model = Socialmedia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;
    protected string $view = 'filament.pages.social-media-settings';

    public ?array $data = [];


    public function mount(): void
    {
        $socialMedia = Socialmedia::first();

        $this->form->fill($socialMedia ? $socialMedia->toArray() : []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información de Contacto')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->placeholder('+1 234 567 8900')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->placeholder('contacto@goodtrap.com')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('whats_app')
                            ->label('WhatsApp')
                            ->tel()
                            ->placeholder('+1 234 567 8900')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Redes Sociales')
                    ->schema([
                        Forms\Components\TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('@goodtrap')
                            ->prefix('@')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('tiktok')
                            ->label('TikTok')
                            ->placeholder('@goodtrap')
                            ->prefix('@')
                            ->maxLength(255),
                    ])
                    ->footer(
                        Action::make('save')
                            ->label('Guardar')
                            ->button()
                            ->color('primary')
                            ->submit('save')
                    )
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $socialMedia = Socialmedia::first();

        if ($socialMedia) {
            $socialMedia->update($data);
        } else {
            Socialmedia::create($data);
        }

        Notification::make()
            ->success()
            ->title('Guardado exitosamente')
            ->body('La configuración de redes sociales se ha actualizado correctamente.')
            ->send();
    }
}
