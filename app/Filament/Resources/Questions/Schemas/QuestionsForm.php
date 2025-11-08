<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class QuestionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Pregunta')
                    ->helperText('Escriba la pregunta que desea agregar.')
                    ->required(),
                Textarea::make('response')
                    ->label('Respuesta')
                    ->helperText('Escriba la respuesta que desea agregar.')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
