<?php

namespace App\Filament\Resources\ChallengeAudioSubmissions\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\DB;

class ChallengeAudioSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.student_name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->icon('heroicon-o-user')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('challenge.title')
                    ->label('Reto')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->challenge?->title)
                    ->wrap()
                    ->icon('heroicon-o-academic-cap')
                    ->iconColor('info'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'approved' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendiente',
                        'approved' => 'Aprobado',
                        'rejected' => 'Rechazado',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('challenge.points')
                    ->label('Puntos')
                    ->suffix(' pts')
                    ->alignEnd()
                    ->sortable()
                    ->color('success')
                    ->weight('bold')
                    ->icon('heroicon-o-sparkles')
                    ->iconColor('success'),

                Tables\Columns\TextColumn::make('submitted_at')
                    ->label('Enviado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->description(fn ($record) => $record->submitted_at->diffForHumans()),

                Tables\Columns\TextColumn::make('reviewed_at')
                    ->label('Revisado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('—')
                    ->description(fn ($record) => $record->reviewed_at?->diffForHumans()),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'pending' => '⏳ Pendiente',
                        'approved' => '✅ Aprobado',
                        'rejected' => '❌ Rechazado',
                    ])
                    ->native(false)
                    ->multiple(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->color('primary')
                        ->mutateFormDataUsing(function (array $data) {
                            $data['reviewed_at'] = now();
                            $data['reviewed_by'] = Auth::id();
                            return $data;
                        })
                        ->after(function ($record) {
                            if ($record->status === 'approved') {
                                $user = $record->user;
                                $challenge = $record->challenge;

                                if ($challenge && $user) {
                                    $alreadyCompleted = DB::table('challenge_user')
                                        ->where('user_id', $user->id)
                                        ->where('challenge_code', $challenge->code)
                                        ->exists();

                                    if (!$alreadyCompleted) {
                                        DB::table('challenge_user')->insert([
                                            'user_id' => $user->id,
                                            'challenge_code' => $challenge->code,
                                            'created_at' => now(),
                                            'updated_at' => now(),
                                        ]);

                                        // Otorgar puntos
                                        $user->increment('gt_points', $challenge->points);
                                    }
                                }
                            }
                        })
                        ->successNotificationTitle('Audio revisado correctamente')
                        ->modalWidth('3xl'),

                    Action::make('listen')
                        ->label('Escuchar')
                        ->icon('heroicon-o-speaker-wave')
                        ->color('info')
                        ->url(fn ($record) => Storage::url($record->audio_path))
                        ->openUrlInNewTab(),

                    DeleteAction::make()
                        ->before(function ($record) {
                            if ($record->audio_path && Storage::disk('public')->exists($record->audio_path)) {
                                Storage::disk('public')->delete($record->audio_path);
                            }
                        })
                        ->successNotificationTitle('Audio eliminado correctamente'),
                ])
                ->label('Acciones')
                ->icon('heroicon-m-ellipsis-vertical')
                ->size('sm')
                ->color('primary')
                ->button(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('approve')
                        ->label('Aprobar seleccionados')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update([
                                    'status' => 'approved',
                                    'reviewed_at' => now(),
                                    'reviewed_by' => Auth::id(),
                                ]);

                                $user = $record->user;
                                $challenge = $record->challenge;

                                if ($challenge && $user) {
                                    $alreadyCompleted = DB::table('challenge_user')
                                        ->where('user_id', $user->id)
                                        ->where('challenge_code', $challenge->code)
                                        ->exists();

                                    if (!$alreadyCompleted) {
                                        DB::table('challenge_user')->insert([
                                            'user_id' => $user->id,
                                            'challenge_code' => $challenge->code,
                                            'created_at' => now(),
                                            'updated_at' => now(),
                                        ]);

                                        $user->increment('gt_points', $challenge->points);
                                    }
                                }
                            }
                        })
                        ->deselectRecordsAfterCompletion()
                        ->successNotificationTitle('Audios aprobados correctamente'),

                    DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->audio_path && Storage::disk('public')->exists($record->audio_path)) {
                                    Storage::disk('public')->delete($record->audio_path);
                                }
                            }
                        })
                        ->successNotificationTitle('Audios eliminados correctamente'),
                ]),
            ])
            ->defaultSort('submitted_at', 'desc')
            ->poll('30s')
            ->striped();
    }
}
