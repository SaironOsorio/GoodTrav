<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->label('Imagen')
                    ->helperText('La imagen que se mostrará en el anuncio.')
                    ->disk('public')
                    ->directory('announcements')
                    ->image()
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
