<?php

namespace App\Filament\Resources\Reservers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReserverInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextEntry::make('user.student_name')
                    ->label('Nombre'),
                TextEntry::make('user.email')
                    ->label('Email')
                    ->copyable(),
                TextEntry::make('user.phone')
                    ->label('Teléfono')
                    ->copyable(),

                TextEntry::make('name_trip')
                    ->label('Viaje')
                    ->columnSpanFull(),
                TextEntry::make('date_trip')
                    ->label('Fecha del viaje')
                    ->date('d/m/Y'),
                TextEntry::make('phone_called_at')
                    ->label('Llamada agendada')
                    ->dateTime('d/m/Y H:i'),
                TextEntry::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cursor' => 'info',
                        'canceled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Pendiente',
                        'confirmed' => 'Confirmado',
                        'cursor' => 'En Curso',
                        'canceled' => 'Cancelado',
                        default => $state,
                    }),

                TextEntry::make('total_points')
                    ->label('Puntos totales')
                    ->numeric(),
                TextEntry::make('total_price')
                    ->label('Precio total')
                    ->money('EUR'),
                TextEntry::make('discount')
                    ->label('Descuento aplicado')
                    ->suffix('%')
                    ->badge()
                    ->color('success')
                    ->default('0'),

                TextEntry::make('created_at')
                    ->label('Fecha de solicitud')
                    ->dateTime('d/m/Y H:i'),
                TextEntry::make('updated_at')
                    ->label('Última actualización')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}
