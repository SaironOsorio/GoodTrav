<?php

namespace App\Filament\Resources\Trips\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\Column;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Facades\Storage;

class TripForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Viaje')
                    ->description('Agrega los detalles principales del viaje.')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Imagen del Viaje')
                            ->helperText('Sube una imagen representativa del destino del viaje.')
                            ->disk('public')
                            ->directory('trip-images')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                            ->required()
                            ->columnSpanFull()
                            ->deleteUploadedFileUsing(function ($file) {
                                if ($file && Storage::disk('public')->exists($file)) {
                                    Storage::disk('public')->delete($file);
                                }
                            }),
                        TextInput::make('destination')
                            ->label('Destino')
                            ->helperText('Ingresa el destino del viaje.')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('city')
                            ->label('Ciudad')
                            ->helperText('Ingresa la ciudad de salida del viaje.')
                            ->maxLength(255),
                        DatePicker::make('start_date')
                            ->label('Fecha de Inicio')
                            ->helperText('Selecciona la fecha de inicio del viaje.')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Fecha de Fin')
                            ->helperText('Selecciona la fecha de fin del viaje.')
                            ->required(),
                        Select::make('rank')
                            ->label('Rango')
                            ->helperText('Selecciona el rango del viaje.')
                            ->options([
                                'junior' => 'Junior',
                                'senior' => 'Senior',
                            ])
                            ->required()
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Detalles Adicionales')
                    ->description('Proporciona información adicional sobre el viaje.')
                    ->schema([
                        TextInput::make('price')
                            ->label('Precio')
                            ->helperText('Ingresa el precio del viaje.')
                            ->required()
                            ->numeric()
                            ->suffix('EUR'),
                        TextInput::make('points')
                            ->label('Puntos')
                            ->helperText('Ingresa los puntos asociados al viaje.')
                            ->required()
                            ->numeric()
                            ->suffix('pts'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Descripción')
                    ->description('Agrega una descripción detallada del viaje.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->helperText('Proporciona un título breve para el viaje.')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('subtitle')
                            ->label('Subtítulo')
                            ->helperText('Proporciona un subtítulo para el viaje.')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Repeater::make('itinerary')
                            ->label('Días del Itinerario')
                            ->helperText('Agrega los días y sus descripciones para el itinerario del viaje.')
                            ->schema([
                                TextInput::make('day_number')
                                    ->label('Número de Día')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('day_title')
                                    ->label('Título del Día')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('description')
                                    ->label('Descripción del Día')
                                    ->required()
                                    ->maxLength(1000),
                                TextInput::make('reto')
                                    ->label('Reto del Día')
                                    ->helperText('Proporciona un reto para el día.')
                                    ->required()
                                    ->maxLength(1000),
                                TextInput::make('objective')
                                    ->label('Objetivo del Día')
                                    ->helperText('Proporciona un objetivo para el día.')
                                    ->required()
                                    ->maxLength(1000),
                                FileUpload::make('day_image_path')
                                    ->label('Imagen del Día')
                                    ->helperText('Sube una imagen representativa para este día del itinerario.')
                                    ->disk('public')
                                    ->directory('trip-itinerary-images')
                                    ->image()
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                                    ->required()
                                    ->deleteUploadedFileUsing(function ($file) {
                                        if ($file && Storage::disk('public')->exists($file)) {
                                            Storage::disk('public')->delete($file);
                                        }
                                    }),
                            ])
                            ->minItems(1)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                    Section::make('Condiciones del Viaje')
                        ->description('Agrega las condiciones y términos del viaje.')
                        ->schema([
                            RichEditor::make('card_description_one')
                                ->label('Descripción de la Tarjeta Uno')
                                ->helperText('Proporciona la primera descripción detallada para la tarjeta del viaje.')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['undo', 'redo'],
                                ])
                                ->required()
                                ->maxLength(2000)
                                ->columnSpanFull(),
                            RichEditor::make('card_description_two')
                                ->label('Descripción de la Tarjeta Dos')
                                ->helperText('Proporciona la segunda descripción detallada para la tarjeta del viaje.')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['undo', 'redo'],
                                ])
                                ->required()
                                ->maxLength(2000)
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull(),

                    Section::make('Notas')
                        ->description('Agrega notas adicionales sobre el viaje.')
                        ->schema([
                            RichEditor::make('note')
                                ->label('Notas')
                                ->helperText('Proporciona información adicional que pueda ser útil.')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['undo', 'redo'],
                                ])
                                ->required()
                                ->maxLength(2000)
                                ->columnSpanFull(),
                            FileUpload::make('path_image_note')
                                ->label('Imagen de la Nota')
                                ->helperText('Sube una imagen relacionada con las notas del viaje.')
                                ->disk('public')
                                ->directory('trip-note-images')
                                ->image()
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                                ->deleteUploadedFileUsing(function ($file) {
                                if ($file && Storage::disk('public')->exists($file)) {
                                    Storage::disk('public')->delete($file);
                                }
                            })
                        ])
                        ->columnSpanFull(),
                    Section::make('Disponibilidad y Requisitos')
                        ->description('Define la disponibilidad y los requisitos para el viaje.')
                        ->schema([
                            TextInput::make('plazas_available')
                                ->label('Plazas Disponibles')
                                ->helperText('Ingresa el número de plazas disponibles para el viaje.')
                                ->required()
                                ->numeric(),
                            RichEditor::make('requirements')
                                ->label('Requisitos')
                                ->helperText('Proporciona los requisitos necesarios para participar en el viaje.')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'link'],
                                    ['h2', 'h3','orderedList'],
                                    ['undo', 'redo'],
                                ])
                                ->required()
                                ->maxLength(2000)
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull(),
            ]);

    }
}
