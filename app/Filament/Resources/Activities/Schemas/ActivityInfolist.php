<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.student_name')
                    ->label('Nombre del Estudiante'),
                TextEntry::make('type')
                    ->label('Tipo de envío'),
                ImageEntry::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->width(400) // Ancho más estrecho para móvil
                    ->height(800) // Alto más grande para formato vertical
                    ->extraImgAttributes([
                        'class' => 'object-contain rounded-lg shadow-lg mx-auto', // Centrado y con sombra
                    ]),
                TextEntry::make('status')
                    ->label('Estado')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
