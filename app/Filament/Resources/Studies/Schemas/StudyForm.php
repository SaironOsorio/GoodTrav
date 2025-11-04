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
                        FileUpload::make('url_video')
                            ->label('Video de la clase')
                            ->helperText('Sube un video de la clase en formato MP4, AVI, MOV, WMV, FLV o MKV. Tamaño máximo: 2GB')
                            ->maxParallelUploads(1)
                            ->maxFiles(1)
                            ->acceptedFileTypes([
                                'video/mp4',
                                'video/avi',
                                'video/mov',
                                'video/wmv',
                                'video/flv',
                                'video/mkv',
                                'video/x-msvideo',
                                'video/quicktime',
                                'video/x-ms-wmv',
                                'video/x-flv',
                                'video/x-matroska',
                            ])
                            ->disk('public')
                            ->directory('studies/videos')
                            ->visibility('public')
                            ->maxSize(2097152) // 2GB en KB (2 * 1024 * 1024)
                            ->uploadProgressIndicatorPosition('left')
                            ->previewable(false)
                            ->openable()
                            ->uploadingMessage('Subiendo video... Esto puede tardar varios minutos.')
                            ->removeUploadedFileButtonPosition('right')
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file && Storage::disk('public')->exists($file)) {
                                    Storage::disk('public')->delete($file);
                                }
                            })
                            ->required(),
                        FileUpload::make('image')
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
                                    ->placeholder('Ej: Crea tu primer componente')
                                    ->helperText('Nombre corto y descriptivo del reto.')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                    
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
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('➕ Agregar reto')
                            ->reorderable()
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->collapsed()
                            ->cloneable()
                            ->deleteAction(
                                fn ($action) => $action->requiresConfirmation()
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