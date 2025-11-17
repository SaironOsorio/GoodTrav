<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use App\Models\Pagesociety;
use UnitEnum;
use Filament\Actions\Action;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Filament\Notifications\Notification;

class SocietyPage extends Page
{
    use InteractsWithSchemas;
    protected static ?string $model = Pagesociety::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;
    protected string $view = 'filament.pages.society-page';
    protected static string|UnitEnum|null $navigationGroup = 'GoodTrav Society';

    public ?array $data = [];


    public function mount()
    {
        $society = Pagesociety::first();

        $this->form->fill($society ? $society->toArray() : []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Titulo y subtitulo')
                    ->description('Configura el título y subtítulo de la sección GoodTrav Society')
                    ->schema([
                         Forms\Components\TextInput::make('title')
                            ->helperText('Título principal de la sección GoodTrav Society')
                            ->label('Título')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->helperText('Subtítulo de la sección GoodTrav Society')
                            ->label('Subtítulo')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('Imagen de la Seccion')
                    ->description('Establece la imagen representativa para la sección GoodTrav Society')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->helperText('Imagen representativa de GoodTrav Society')
                            ->image()
                            ->maxSize(2048)
                            ->directory('society-page')
                            ->disk('public')
                            ->placeholder('Selecciona una imagen para la sección de GoodTrav Society')
                            ->helperText('Tamaño máximo: 2MB. Formatos permitidos: jpg, png, gif.'),
                    ])
                    ->columns(1),
                Section::make('Informacion de la Seccion')
                    ->description('Configura la información que se mostrará en las tarjetas de GoodTrav Society')
                    ->schema([
                        Forms\Components\TextInput::make('title_card_one')
                            ->helperText('Título principal de la tarjeta uno de GoodTrav Society')
                            ->label('Título')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('text_card_one')
                            ->label('Información Principal')
                            ->helperText('Información principal de la tarjeta uno de GoodTrav Society')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'link',
                                'undo',
                                'redo',
                            ])
                            ->placeholder('Escribe la información de GoodTrav Society aquí...'),
                        Forms\Components\TextInput::make('title_card_two')
                            ->helperText('Título principal de la tarjeta dos de GoodTrav Society')
                            ->label('Título')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('text_card_two')
                            ->label('Información secundaria')
                            ->helperText('Información secundaria de la tarjeta dos de GoodTrav Society')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'link',
                                'undo',
                                'redo',
                            ])
                            ->placeholder('Escribe la información de GoodTrav Society aquí...'),   
                    ])
                    ->columns(2)
                    ->footer(
                        Action::make('save')
                            ->label('Guardar')
                            ->button()
                            ->color('primary')
                            ->submit('save')
                    ),
                    
            ])
            ->statePath('data');
            
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $society = Pagesociety::first();

        if ($society) {
            $society->update($data);
        } else {
            Pagesociety::create($data);
        }

        Notification::make()
            ->success()
            ->title('Guardado exitosamente')
            ->body('La configuración de redes sociales se ha actualizado correctamente.')
            ->send();
    }
}
