<?php

namespace App\Filament\Resources\ChallengeAudioSubmissions\Schemas;

use Filament\Forms;
use Illuminate\Support\Facades\Storage;
use Filament\Schemas\Components\Section;


class ChallengeAudioSubmissionForm
{
    public static function configure($schema): mixed
    {
        return $schema->schema([
            Section::make('Información del envío')
                ->schema([
                    Forms\Components\TextInput::make('user.name')
                        ->label('Usuario')
                        ->default(fn ($record) => $record?->user?->name)
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('challenge.title')
                        ->label('Reto')
                        ->default(fn ($record) => $record?->challenge?->title)
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('challenge_code')
                        ->label('Código del reto')
                        ->disabled(),
                ])
                ->columns(3),

            Section::make('Audio enviado')
                ->schema([
                    Forms\Components\Placeholder::make('audio_preview')
                        ->label('Reproductor')
                        ->content(fn ($record) => $record ?
                            new \Illuminate\Support\HtmlString('
                                <div class="space-y-3">
                                    <audio controls class="w-full" preload="metadata" controlsList="nodownload">
                                        <source src="' . Storage::url($record->audio_path) . '" type="audio/mpeg">
                                        Tu navegador no soporta el elemento de audio.
                                    </audio>
                                    <div class="text-xs text-gray-500 space-y-1 bg-gray-50 dark:bg-gray-800 p-3 rounded-lg">
                                        <p><strong>📅 Enviado:</strong> ' . $record->submitted_at->format('d/m/Y H:i') . '</p>
                                        ' . ($record->reviewed_at ? '<p><strong>✅ Revisado:</strong> ' . $record->reviewed_at->format('d/m/Y H:i') . '</p>' : '') . '
                                        ' . ($record->reviewer ? '<p><strong>👤 Revisado por:</strong> ' . $record->reviewer->name . '</p>' : '') . '
                                    </div>
                                </div>
                            ')
                            : new \Illuminate\Support\HtmlString('<p class="text-sm text-gray-500">No hay audio disponible</p>')
                        ),
                ]),

            Section::make('Revisión del admin')
                ->description('Evalúa el audio del estudiante')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label('Estado')
                        ->options([
                            'pending' => '⏳ Pendiente',
                            'approved' => '✅ Aprobado',
                            'rejected' => '❌ Rechazado',
                        ])
                        ->required()
                        ->native(false)
                        ->live()
                        ->afterStateUpdated(function ($state, $set) {
                            if ($state === 'approved') {
                                $set('admin_feedback', null);
                            }
                        })
                        ->helperText('Selecciona el estado de la revisión'),

                    Forms\Components\Textarea::make('admin_feedback')
                        ->label('Comentarios para el estudiante')
                        ->placeholder('Explica por qué fue rechazado el audio (pronunciación, claridad, contenido, etc.)...')
                        ->rows(4)
                        ->visible(fn ($get) => $get('status') === 'rejected')
                        ->required(fn ($get) => $get('status') === 'rejected')
                        ->helperText('Este mensaje será visible para el estudiante')
                        ->maxLength(500),
                ])
                ->collapsible(),
        ]);
    }
}
