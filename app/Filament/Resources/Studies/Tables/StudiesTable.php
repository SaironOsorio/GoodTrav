<?php

namespace App\Filament\Resources\Studies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class StudiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Fecha de inicio')
                    ->dateTime(),
                TextColumn::make('end_date')
                    ->label('Fecha de fin')
                    ->dateTime(),
                TextColumn::make('points')
                    ->label('Puntos')
                    ->numeric(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                    Action::make('resetStudyData')
                        ->label('🔄 Resetear datos de esta clase')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Resetear datos de la clase')
                        ->modalDescription('Esto eliminará TODOS los datos de progreso de esta clase: retos completados, audios enviados y marcará como no vista para todos los usuarios. ¿Estás seguro?')
                        ->modalSubmitActionLabel('Sí, resetear todo')
                        ->modalCancelActionLabel('Cancelar')
                        ->action(function ($record) {
                            if (!$record) {
                                Notification::make()
                                    ->title('Error')
                                    ->body('Primero debes guardar la clase.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            DB::beginTransaction();
                            try {
                                $studyId = $record->id;


                                $challengeCodes = $record->challenges()->pluck('code')->toArray();


                                DB::table('challenge_user')
                                    ->whereIn('challenge_code', $challengeCodes)
                                    ->delete();


                                DB::table('challenge_audio_submissions')
                                    ->whereIn('challenge_code', $challengeCodes)
                                    ->delete();


                                DB::table('users')
                                    ->where('current_study_id', $studyId)
                                    ->update([
                                        'current_study_id' => null,
                                        'has_watched_weekly_video' => 0,
                                        'video_watched_at' => null,
                                    ]);

                                DB::commit();

                                Notification::make()
                                    ->title('✓ Datos reseteados')
                                    ->body('Se eliminaron todos los progresos de esta clase.')
                                    ->success()
                                    ->send();

                            } catch (\Exception $e) {
                                DB::rollBack();

                                Notification::make()
                                    ->title('Error al resetear')
                                    ->body('Ocurrió un error: ' . $e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->visible(fn ($record) => $record !== null),
                ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }


}
