<?php

namespace App\Filament\Resources\Modals\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class ModalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->helperText('El título del anuncio que se mostrará en el modal.')
                    ->required(),
                FileUpload::make('image_path')
                    ->label('Imagen')
                    ->helperText('La imagen que se mostrará en el modal. Puede ser un archivo de imagen o video.')
                    ->disk('public')
                    ->directory('modals')
                    ->acceptedFileTypes([
                        'video/mp4',
                        'video/webm',
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                    ])
                    ->maxSize(50 * 1024 * 1024)  // 50MB
                    ->required()
                    ->deleteUploadedFileUsing(function ($file) {
                        if ($file && Storage::disk('public')->exists($file)) {
                            Storage::disk('public')->delete($file);
                        }
                    }),
                Toggle::make('is_active')
                    ->label('¿Está activo?')
                    ->helperText('Determina si el anuncio está activo o no.')
                    ->required(),
            ]);
    }
}
