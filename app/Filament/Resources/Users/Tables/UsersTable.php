<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // INFORMACIÓN BÁSICA
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->tooltip('Haz clic para copiar'),

                TextColumn::make('student_name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->tooltip('Haz clic para copiar'),

                IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-user')
                    ->trueColor('danger')
                    ->falseColor('gray'),

                // PUNTOS Y ACTIVIDAD
                TextColumn::make('gt_points')
                    ->label('Puntos GT')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        $state >= 1000 => 'success',
                        $state >= 500 => 'warning',
                        default => 'gray',
                    })
                    ->suffix(' pts')
                    ->alignCenter(),

                // SUSCRIPCIÓN
                TextColumn::make('subscription_end_date')
                    ->label('Fin Suscripción')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn ($state) => $state && now()->gt($state) ? 'danger' : 'success')
                    ->icon(fn ($state) => $state && now()->gt($state) ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->toggleable(),

                IconColumn::make('is_on_trial')
                    ->label('Prueba')
                    ->boolean()
                    ->trueColor('info')
                    ->toggleable(),

                // SOCIEDAD Y REDES
                IconColumn::make('is_society')
                    ->label('Sociedad')
                    ->boolean()
                    ->trueColor('success')
                    ->toggleable(),

                TextColumn::make('society_code')
                    ->label('Código Sociedad')
                    ->searchable()
                    ->badge()
                    ->color('success')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_instagram')
                    ->label('Instagram')
                    ->boolean()
                    ->trueColor('warning')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_tiktok')
                    ->label('TikTok')
                    ->boolean()
                    ->trueColor('info')
                    ->toggleable(isToggledHiddenByDefault: true),

                // CONTACTO
                TextColumn::make('country.name')
                    ->label('País')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('date_of_birth')
                    ->label('Fecha Nacimiento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // VERIFICACIÓN
                TextColumn::make('email_verified_at')
                    ->label('Email Verificado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('has_watched_weekly_video')
                    ->label('Video Semanal')
                    ->boolean()
                    ->trueColor('success')
                    ->toggleable(isToggledHiddenByDefault: true),

                // STRIPE
                TextColumn::make('stripe_id')
                    ->label('Stripe ID')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('pm_type')
                    ->label('Método Pago')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('pm_last_four')
                    ->label('****')
                    ->toggleable(isToggledHiddenByDefault: true),

                // REFERIDOS
                TextColumn::make('referral_code')
                    ->label('Código Referido')
                    ->searchable()
                    ->copyable()
                    ->badge()
                    ->color('primary')
                    ->toggleable(isToggledHiddenByDefault: true),

                // FECHAS
                TextColumn::make('created_at')
                    ->label('Registrado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // FILTRO: Administradores
                TernaryFilter::make('is_admin')
                    ->label('Administradores')
                    ->placeholder('Todos')
                    ->trueLabel('Solo Administradores')
                    ->falseLabel('Solo Usuarios')
                    ->native(false),

                // FILTRO: Sociedad
                TernaryFilter::make('is_society')
                    ->label('Miembros de Sociedad')
                    ->placeholder('Todos')
                    ->trueLabel('En Sociedad')
                    ->falseLabel('No en Sociedad')
                    ->native(false),

                // FILTRO: Período de Prueba
                TernaryFilter::make('is_on_trial')
                    ->label('En Período de Prueba')
                    ->placeholder('Todos')
                    ->trueLabel('En Prueba')
                    ->falseLabel('Suscripción Activa')
                    ->native(false),

                // FILTRO: Email Verificado
                TernaryFilter::make('email_verified')
                    ->label('Email Verificado')
                    ->placeholder('Todos')
                    ->trueLabel('Verificado')
                    ->falseLabel('Sin Verificar')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('email_verified_at'),
                        false: fn (Builder $query) => $query->whereNull('email_verified_at'),
                    )
                    ->native(false),

                // FILTRO: Redes Sociales
                SelectFilter::make('social_media')
                    ->label('Redes Sociales')
                    ->options([
                        'instagram' => 'Instagram',
                        'tiktok' => 'TikTok',
                        'both' => 'Ambas',
                    ])
                    ->query(function (Builder $query, array $data) {
                        return match ($data['value'] ?? null) {
                            'instagram' => $query->where('is_instagram', true),
                            'tiktok' => $query->where('is_tiktok', true),
                            'both' => $query->where('is_instagram', true)->where('is_tiktok', true),
                            default => $query,
                        };
                    })
                    ->native(false),

                // FILTRO: Puntos GT
                Filter::make('gt_points')
                    ->label('Puntos GT')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('from')
                            ->label('Desde')
                            ->numeric()
                            ->placeholder('0'),
                        \Filament\Forms\Components\TextInput::make('to')
                            ->label('Hasta')
                            ->numeric()
                            ->placeholder('1000'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $value): Builder => $query->where('gt_points', '>=', $value),
                            )
                            ->when(
                                $data['to'],
                                fn (Builder $query, $value): Builder => $query->where('gt_points', '<=', $value),
                            );
                    }),

                // FILTRO: Suscripción Activa
                Filter::make('active_subscription')
                    ->label('Suscripción Activa')
                    ->query(fn (Builder $query): Builder => $query
                        ->whereNotNull('subscription_end_date')
                        ->where('subscription_end_date', '>=', now())
                    )
                    ->toggle(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Ver'),
                EditAction::make()
                    ->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Eliminar seleccionados'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->striped();
    }
}
