<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Activity;

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('student_name')
                    ->label('Nombre del Estudiante')
                    ->disabled()            
                    ->dehydrated(false)
                    ->afterStateHydrated(function (TextInput $component, ?Activity $record) {
                        $component->state($record?->user?->student_name ?? auth()->user()?->student_name);
                    }),
                TextInput::make('type')
                    ->label('Tipo de Envío')
                    ->readOnly(true)
                    ->required(),
                FileUpload::make('image_path')
                    ->label('Evidencia (Imagen)')
                    ->disk('public')
                    ->image(),
                Select::make('status')
                    ->label('Estado')
                    ->helperText('Actualizar el estado de la actividad')
                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
