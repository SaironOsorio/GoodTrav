<?php

namespace App\Filament\Resources\Contributors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage; 

class ContributorsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->helpertext('Nombre del colaborador')
                    ->required(),
                TextInput::make('url')
                    ->label('URL')
                    ->helpertext('Enlace al sitio web del colaborador')
                    ->url(),
                FileUpload::make('imagen_path')
                    ->label('Imagen')
                    ->helpertext('Imagen del colaborador')
                    ->disk('public')
                    ->directory('contributors')
                    ->deleteUploadedFileUsing(function ($file) {
                        if ($file && Storage::disk('public')->exists($file)) {
                            Storage::disk('public')->delete($file);
                        }
                    }),
            ]);
    }
}
