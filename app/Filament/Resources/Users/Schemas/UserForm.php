<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Models\Country;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // SECCIÓN: Información Personal
                Section::make('Información Personal')
                    ->description('Datos básicos del usuario')
                    ->icon('heroicon-o-user')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre Completo')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Juan Pérez'),

                        TextInput::make('student_name')
                            ->label('Nombre de Estudiante')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: juanp123'),

                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('correo@ejemplo.com'),

                        DateTimePicker::make('email_verified_at')
                            ->label('Email Verificado En')
                            ->displayFormat('d/m/Y H:i')
                            ->seconds(false),

                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->required(fn($context) => $context === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->minLength(8)
                            ->placeholder('Mínimo 8 caracteres'),

                        Toggle::make('is_admin')
                            ->label('Es Administrador')
                            ->inline(false)
                            ->default(false),
                    ]),

                // SECCIÓN: Contacto y Ubicación
                Section::make('Contacto y Ubicación')
                    ->description('Información de contacto')
                    ->icon('heroicon-o-map-pin')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        Select::make('country_id')
                            ->label('País')
                            ->options(Country::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),

                        TextInput::make('country_code')
                            ->label('Código de País')
                            ->placeholder('+34')
                            ->maxLength(5),

                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('612345678'),

                        DatePicker::make('date_of_birth')
                            ->label('Fecha de Nacimiento')
                            ->displayFormat('d/m/Y')
                            ->native(false)
                            ->maxDate(now()->subYears(13)),

                        Textarea::make('address')
                            ->label('Dirección')
                            ->columnSpanFull()
                            ->rows(3)
                            ->placeholder('Calle, número, ciudad, código postal'),
                    ]),

                // SECCIÓN: Puntos y Actividad
                Section::make('Puntos y Actividad')
                    ->description('Sistema de puntos GT y progreso')
                    ->icon('heroicon-o-star')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('gt_points')
                            ->label('Puntos GT')
                            ->numeric()
                            ->default(0)
                            ->suffix('pts'),

                        TextInput::make('current_study_id')
                            ->label('ID Estudio Actual')
                            ->numeric(),

                        Toggle::make('has_watched_weekly_video')
                            ->label('Ha Visto Video Semanal')
                            ->inline(false)
                            ->default(false),

                        DateTimePicker::make('video_watched_at')
                            ->label('Video Visto En')
                            ->displayFormat('d/m/Y H:i')
                            ->seconds(false),
                    ]),

                // SECCIÓN: Suscripción y Pagos
                Section::make('Suscripción y Pagos')
                    ->description('Información de suscripción y Stripe')
                    ->icon('heroicon-o-credit-card')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        DatePicker::make('subscription_start_date')
                            ->label('Inicio de Suscripción')
                            ->displayFormat('d/m/Y')
                            ->native(false),

                        DatePicker::make('subscription_end_date')
                            ->label('Fin de Suscripción')
                            ->displayFormat('d/m/Y')
                            ->native(false),

                        Toggle::make('is_on_trial')
                            ->label('En Período de Prueba')
                            ->inline(false)
                            ->default(false),

                        DateTimePicker::make('trial_ends_at')
                            ->label('Prueba Termina En')
                            ->displayFormat('d/m/Y H:i')
                            ->seconds(false),

                        TextInput::make('stripe_id')
                            ->label('Stripe ID')
                            ->maxLength(255)
                            ->placeholder('cus_...')
                            ->disabled(),

                        TextInput::make('stripe_subscription_id')
                            ->label('Stripe Subscription ID')
                            ->maxLength(255)
                            ->placeholder('sub_...')
                            ->disabled(),

                        TextInput::make('pm_type')
                            ->label('Tipo de Pago')
                            ->maxLength(50)
                            ->placeholder('card')
                            ->disabled(),

                        TextInput::make('pm_last_four')
                            ->label('Últimos 4 Dígitos')
                            ->maxLength(4)
                            ->placeholder('****')
                            ->disabled(),
                    ]),

                // SECCIÓN: Referidos y Sociedad
                Section::make('Referidos y Sociedad')
                    ->description('Códigos de referido y membresía de sociedad')
                    ->icon('heroicon-o-user-group')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('referral_code')
                            ->label('Código de Referido')
                            ->maxLength(50)
                            ->unique(ignoreRecord: true)
                            ->placeholder('GOODTRAV123'),

                        Toggle::make('is_society')
                            ->label('Es Miembro de Sociedad')
                            ->inline(false)
                            ->default(false),

                        TextInput::make('society_code')
                            ->label('Código de Sociedad')
                            ->maxLength(50)
                            ->placeholder('SOC123'),
                    ]),

                // SECCIÓN: Redes Sociales
                Section::make('Redes Sociales')
                    ->description('Puntos ganados por redes sociales')
                    ->icon('heroicon-o-hashtag')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        Toggle::make('is_instagram')
                            ->label('Conectado a Instagram')
                            ->inline(false)
                            ->default(false),

                        Toggle::make('is_tiktok')
                            ->label('Conectado a TikTok')
                            ->inline(false)
                            ->default(false),

                        Toggle::make('has_received_post_points')
                            ->label('Puntos por Post Recibidos')
                            ->inline(false)
                            ->default(false),

                        Toggle::make('has_received_event_points')
                            ->label('Puntos por Evento Recibidos')
                            ->inline(false)
                            ->default(false),
                    ]),

                // SECCIÓN: Autenticación de Dos Factores
                Section::make('Autenticación de Dos Factores')
                    ->description('Configuración de seguridad 2FA')
                    ->icon('heroicon-o-shield-check')
                    ->columns(1)
                    ->collapsed()
                    ->schema([
                        DateTimePicker::make('two_factor_confirmed_at')
                            ->label('2FA Confirmado En')
                            ->displayFormat('d/m/Y H:i')
                            ->seconds(false)
                            ->disabled(),

                        Textarea::make('two_factor_secret')
                            ->label('Secreto 2FA')
                            ->rows(2)
                            ->disabled()
                            ->dehydrated(false),

                        Textarea::make('two_factor_recovery_codes')
                            ->label('Códigos de Recuperación 2FA')
                            ->rows(3)
                            ->disabled()
                            ->dehydrated(false),
                    ]),
            ]);
    }
}
