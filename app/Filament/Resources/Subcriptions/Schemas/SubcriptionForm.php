<?php

namespace App\Filament\Resources\Subcriptions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;

class SubcriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->helperText('Nombre de la suscripción')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(16)
                    ->prefix('€'),
                TextInput::make('stripe_price_id')
                    ->label('ID de Precio en Stripe')
                    ->helperText('Identificador del precio asociado en Stripe')
                    ->required(),
                TextInput::make('duration')
                    ->label('Duración')
                    ->helperText('Duración de la suscripción en meses')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->helperText('Descripción detallada de la suscripción')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('features')
                    ->label('Características')
                    ->helperText('Características de la suscripción')
                    ->schema([
                        TextInput::make('feature')
                            ->label('Característica')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
