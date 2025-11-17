<?php

namespace App\Filament\Resources\Reservers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReserverForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('trip_id')
                    ->numeric(),
                TextInput::make('name_trip')
                    ->required(),
                DatePicker::make('date_trip')
                    ->required(),
                TextInput::make('total_points')
                    ->required()
                    ->numeric(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric(),
                TextInput::make('discount'),
                Select::make('status')
                    ->options([
            'pending' => 'Pending',
            'cursor' => 'Cursor',
            'confirmed' => 'Confirmed',
            'canceled' => 'Canceled',
        ])
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('phone_called_at'),
            ]);
    }
}
