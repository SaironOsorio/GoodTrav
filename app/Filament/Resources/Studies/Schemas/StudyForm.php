<?php

namespace App\Filament\Resources\Studies\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->schema([
            Tabs::make('Tabs')
            ->tabs([
                Tab::make('Clase')
                    ->schema([
                        TextInput::make('url_video')
                            ->label('Video de la clase')
                            ->helperText('Ingresa la URL del video de la clase (YouTube)')
                            ->required(),
                        FileUpload::make('image')
                            ->label('Imagen del Reto')
                            ->helperText('Sube una imagen representativa para el reto. Formatos aceptados: JPG, PNG. Tamaño máximo: 5MB')
                            ->maxFiles(1)
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                            ])
                            ->disk('public')
                            ->directory('studies/images')
                            ->visibility('public')
                            ->maxSize(5120) // 5MB en KB (5 * 1024)
                            ->image()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeMode('cover')
                            ->uploadProgressIndicatorPosition('left')
                            ->removeUploadedFileButtonPosition('right')
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file && Storage::disk('public')->exists($file)) {
                                    Storage::disk('public')->delete($file);
                                }
                            })
                            ->required(),
                        FileUpload::make('image_reto')
                            ->label('Imagen de la clase')
                            ->helperText('Sube una imagen representativa para la clase. Formatos aceptados: JPG, PNG. Tamaño máximo: 5MB')
                            ->maxFiles(1)
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                            ])
                            ->disk('public')
                            ->directory('studies/images')
                            ->visibility('public')
                            ->maxSize(5120) // 5MB en KB (5 * 1024)
                            ->image()
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeMode('cover')
                            ->uploadProgressIndicatorPosition('left')
                            ->removeUploadedFileButtonPosition('right')
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file && Storage::disk('public')->exists($file)) {
                                    Storage::disk('public')->delete($file);
                                }
                            })
                            ->required(),
                        TextInput::make('title')
                            ->label('Título de la clase')
                            ->placeholder('Ej: Introducción a Laravel')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Descripción de la clase')
                            ->placeholder('Describe de qué trata esta clase...')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'link'],
                                ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                ['undo', 'redo'],
                            ])
                            ->maxLength(1250)
                            ->columnSpanFull(),
                        RichEditor::make('notes')
                            ->label('Notas')
                            ->placeholder('Agrega enlaces, documentos o cualquier otro recurso adicional...')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'link'],
                                ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                ['undo', 'redo'],
                            ])
                            ->maxLength(2000)
                            ->columnSpanFull(),
                        DateTimePicker::make('start_date')
                            ->label('Fecha de inicio')
                            ->helperText('Cuándo estará disponible esta clase')
                            ->native(false)
                            ->displayFormat('d/m/Y H:i')
                            ->seconds(false)
                            ->required()
                            ->default(now()),

                        DateTimePicker::make('end_date')
                            ->label('Fecha de fin')
                            ->helperText('Hasta cuándo estará disponible esta clase')
                            ->native(false)
                            ->displayFormat('d/m/Y H:i')
                            ->seconds(false)
                            ->required()
                            ->after('start_date')
                            ->default(now()->addDays(30)),

                        TextInput::make('points')
                            ->label('Puntos de la clase')
                            ->helperText('Puntos que obtiene el estudiante al completar la clase')
                            ->numeric()
                            ->default(100)
                            ->minValue(0)
                            ->maxValue(1000)
                            ->suffix('pts')
                            ->required(),
                    ])
                    ->columns(2),

                Tab::make('Retos')
                    ->badge(fn ($get) => count($get('challenges') ?? []))
                    ->schema([
                        Repeater::make('challenges')
                            ->label('Retos de la clase')
                            ->relationship()
                            ->schema([
                                TextInput::make('title')
                                    ->label('Título del reto')
                                    ->placeholder('Ej: Quiz: Vocabulario del Verbo to be')
                                    ->helperText('Nombre corto y descriptivo del reto.')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        if (!empty($state)) {
                                            $newCode = Str::slug($state) . '-' . Str::random(6);
                                            $set('code', $newCode);
                                        }
                                    })
                                    ->columnSpanFull(),
                                TextInput::make('code')
                                    ->label('Código del reto')
                                    ->placeholder('Se genera automáticamente desde el título')
                                    ->helperText('Este código identifica el reto de manera única.')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(100)
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpanFull(),
                                TextInput::make('order')
                                    ->label('Orden')
                                    ->helperText('Orden de aparición del reto (menor primero).')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                                Textarea::make('description')
                                    ->label('Descripción del reto')
                                    ->placeholder('Explica qué debe hacer el estudiante...')
                                    ->helperText('Instrucciones detalladas del reto.')
                                    ->rows(4)
                                    ->maxLength(1000)
                                    ->columnSpanFull(),

                                TextInput::make('points')
                                    ->label('Puntos del reto')
                                    ->helperText('Puntos que vale completar este reto.')
                                    ->numeric()
                                    ->default(50)
                                    ->minValue(0)
                                    ->maxValue(500)
                                    ->suffix('pts')
                                    ->required(),

                                TextInput::make('url_resource')
                                    ->label('Recurso (URL)')
                                    ->placeholder('https://ejemplo.com/recurso')
                                    ->helperText('Enlace a documentación, video o material de apoyo.')
                                    ->url()
                                    ->maxLength(500),

                                Toggle::make('is_audio')
                                    ->label('¿Es un reto de audio?')
                                    ->helperText('Activa si el reto requiere grabación de audio.')
                                    ->default(false)
                                    ->inline(false),
                            ])
                            ->orderColumn('order')
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('➕ Agregar reto')
                            ->reorderable()
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->collapsed()
                            ->cloneable()
                            ->deleteAction(
                                fn ($action) => $action
                                    ->requiresConfirmation()
                                    ->modalHeading('Eliminar reto')
                                    ->modalDescription('¿Estás seguro de que quieres eliminar este reto? Esta acción no se puede deshacer.')
                                    ->modalSubmitActionLabel('Sí, eliminar')
                                    ->modalCancelActionLabel('Cancelar')
                            )
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Nuevo reto'),
                    ])
                    ->columns(1),
            ])
            ->contained(false)
            ->columnSpanFull()
            ->persistTab()
            ->persistTabInQueryString(),
        ]);
    }
}
