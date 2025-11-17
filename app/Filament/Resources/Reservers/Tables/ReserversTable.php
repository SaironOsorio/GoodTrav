<?php

namespace App\Filament\Resources\Reservers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class ReserversTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.student_name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name_trip')
                    ->label('Viaje')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_trip')
                    ->label('Fecha del viaje')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('phone_called_at')
                    ->label('Llamada agendada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('discount')
                    ->label('Descuento')
                    ->suffix('%')
                    ->sortable()
                    ->default('0')
                    ->badge()
                    ->color('success'),
                TextColumn::make('total_points')
                    ->label('Puntos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_price')
                    ->label('Precio')
                    ->money('EUR')
                    ->sortable(),
                TextColumn::make('status')
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
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha de solicitud')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'pending' => 'Pendiente',
                        'confirmed' => 'Confirmado',
                        'cursor' => 'En Curso',
                        'canceled' => 'Cancelado',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('approve')
                    ->label('Iniciar')
                    ->icon('heroicon-o-play')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Iniciar reserva')
                    ->modalDescription('¿Marcar esta reserva como en curso? Esto pondrá en 0 los referidos utilizados para el descuento.')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        DB::beginTransaction();

                        try {
                            // Buscar al usuario en societies y poner user_count en 0
                            $society = \App\Models\Society::where('user_id', $record->user_id)->first();

                            if ($society) {
                                $oldCount = $society->user_count;
                                $society->update(['user_count' => 0]);

                                $message = "La reserva está ahora en curso. Referidos cambiados de {$oldCount} a 0.";
                            } else {
                                $message = "La reserva está ahora en curso. El usuario no tiene registro en societies.";
                            }

                            $record->update(['status' => 'cursor']);

                            DB::commit();

                            Notification::make()
                                ->title('Reserva en curso')
                                ->body($message)
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            DB::rollBack();

                            Notification::make()
                                ->title('Error')
                                ->body('Error: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                Action::make('complete')
                    ->label('Completar')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Completar reserva')
                    ->modalDescription('¿Completar esta reserva? El registro será eliminado y los referidos quedarán en 0.')
                    ->visible(fn($record) => $record->status === 'cursor')
                    ->action(function ($record) {
                        DB::beginTransaction();

                        try {
                            $record->delete();

                            DB::commit();

                            Notification::make()
                                ->title('Reserva completada')
                                ->body('El registro ha sido eliminado. Los referidos quedan en 0.')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            DB::rollBack();

                            Notification::make()
                                ->title('Error')
                                ->body('No se pudo completar la reserva.')
                                ->danger()
                                ->send();
                        }
                    }),
                Action::make('cancel')
                    ->label('Cancelar')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Cancelar reserva')
                    ->modalDescription('¿Estás seguro de que quieres cancelar esta reserva? El registro será eliminado y la plaza devuelta al inventario.')
                    ->visible(fn($record) => in_array($record->status, ['pending', 'cursor']))
                    ->action(function ($record) {
                        DB::beginTransaction();

                        try {
                            // Si el usuario tiene registro en societies y estaba en cursor, devolver el user_count
                            if ($record->status === 'cursor') {
                                $society = \App\Models\Society::where('user_id', $record->user_id)->first();
                                if ($society && $society->user_count === 0) {
                                    // Devolver el user_count al valor del descuento que tenía
                                    $userCountToRestore = 0;
                                    if ($record->discount == 5) $userCountToRestore = 5;
                                    elseif ($record->discount == 10) $userCountToRestore = 10;
                                    elseif ($record->discount == 15) $userCountToRestore = 15;
                                    elseif ($record->discount == 20) $userCountToRestore = 20;
                                    elseif ($record->discount == 50) $userCountToRestore = 50;

                                    if ($userCountToRestore > 0) {
                                        $society->update(['user_count' => $userCountToRestore]);
                                    }
                                }
                            }

                            // Devolver la plaza al trip si existe la relación
                            if ($record->trip) {
                                $record->trip->increment('plazas_available');
                            }

                            // Eliminar el registro de la base de datos
                            $record->delete();

                            DB::commit();

                            Notification::make()
                                ->title('Reserva eliminada')
                                ->body('El registro ha sido eliminado y la plaza devuelta al inventario.')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            DB::rollBack();

                            Notification::make()
                                ->title('Error')
                                ->body('No se pudo cancelar la reserva.')
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
