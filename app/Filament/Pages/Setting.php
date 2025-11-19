<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Setting as ModelSetting;
use Filament\Support\Icons\Heroicon;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;


class Setting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $model = ModelSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;
    protected string $view = 'filament.pages.setting';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = ModelSetting::first();

        $this->form->fill($setting ? $setting->toArray() : []);
    }


    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('YouTube Landing')
                    ->description('Configura la URL del video de YouTube para la página principal.')
                    ->schema([
                        Forms\Components\TextInput::make('url_youtube_landing')
                            ->label('URL YouTube Landing')
                            ->helperText('Ingrese la URL del video de YouTube para la página de Principal (Descubre GoodTrav).')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=XXXXXXX')
                            ->maxLength(255),
                    ])
                    ->columns(1),

                Section::make('Lista de Colaboradores')
                    ->description('Configura los títulos y subtítulos para la sección de lista de colaboradores.')
                    ->schema([
                        Forms\Components\TextInput::make('title_contributors_list_title')
                            ->label('Título Lista de Colaboradores')
                            ->helperText('Ingrese el título para la sección de lista de colaboradores.')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('title_contributors_list_subtitle')
                            ->label('Subtítulo Lista de Colaboradores')
                            ->helperText('Ingrese el subtítulo para la sección de lista de colaboradores.')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Nuevo Colaborador')
                    ->description('Configura los títulos, subtítulos y precios para la sección de nuevo colaborador.')
                    ->schema([
                        Forms\Components\TextInput::make('title_contributors_new_title')
                            ->label('Título Nuevo Colaborador')
                            ->helperText('Ingrese el título para la sección de nuevo colaborador.')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('title_contributors_new_subtitle')
                            ->label('Subtítulo Nuevo Colaborador')
                            ->helperText('Ingrese el subtítulo para la sección de nuevo colaborador.')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('title_contributors_price_base')
                            ->label('Precio Base Colaborador')
                            ->helperText('Ingrese el precio base para la sección de colaboradores.')
                            ->numeric(),

                        Forms\Components\TextInput::make('title_contributors_price_new')
                            ->label('Precio Nuevo Colaborador')
                            ->helperText('Ingrese el precio para la sección de nuevo colaborador.')
                            ->numeric(),
                    ])
                    ->columns(2),

                Section::make('Suscripciones')
                    ->description('Configura los textos relacionados con las suscripciones.')
                    ->schema([
                        Forms\Components\TextInput::make('subcription_title')
                            ->label('Título de Suscripción')
                            ->helperText('Ingrese el título para la sección de suscripciones.')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('subcription_description')
                            ->label('Descripción de Suscripción')
                            ->helperText('Ingrese la descripción para la sección de suscripciones.')
                            ->rows(4),
                    ])
                    ->columns(1),

                Section::make('Autenticación')
                    ->description('Configura la imagen utilizada en la autenticación.')
                    ->schema([
                        FileUpload::make('image_path_authentication')
                            ->label('Imagen de Autenticación')
                            ->helperText('Suba una imagen para la sección de autenticación.')
                            ->image()
                            ->directory('authentication-images')
                            ->maxSize(1024), // Tamaño máximo en KB
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    protected function getActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar Configuración')
                ->button()
                ->color('primary')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $setting = ModelSetting::first();
        if ($setting) {
            $setting->update($data);
        } else {
            ModelSetting::create($data);
        }

        Notification::make()
            ->success()
            ->title('Guardado exitosamente')
            ->body('La configuración se ha actualizado correctamente.')
            ->send();
    }
}
