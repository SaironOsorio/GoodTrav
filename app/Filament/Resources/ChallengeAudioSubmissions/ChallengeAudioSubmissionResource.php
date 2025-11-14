<?php

namespace App\Filament\Resources\ChallengeAudioSubmissions;

use App\Filament\Resources\ChallengeAudioSubmissions\Pages\CreateChallengeAudioSubmission;
use App\Filament\Resources\ChallengeAudioSubmissions\Pages\EditChallengeAudioSubmission;
use App\Filament\Resources\ChallengeAudioSubmissions\Pages\ListChallengeAudioSubmissions;
use App\Filament\Resources\ChallengeAudioSubmissions\Schemas\ChallengeAudioSubmissionForm;
use App\Filament\Resources\ChallengeAudioSubmissions\Tables\ChallengeAudioSubmissionsTable;
use App\Models\ChallengeAudioSubmission;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ChallengeAudioSubmissionResource extends Resource
{
    protected static ?string $model = ChallengeAudioSubmission::class;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::SpeakerWave;

    protected static string|UnitEnum|null $navigationGroup = 'Administrador de Contenidos';

    protected static ?string $recordTitleAttribute = 'Audio Submissions';

    protected static ?string $navigationLabel = 'Audios de Retos';

    protected static ?string $modelLabel = 'Audio de Reto';

    protected static ?string $pluralModelLabel = 'Audios de Retos';
    
    public static function form(Schema $schema): Schema
    {
        return ChallengeAudioSubmissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChallengeAudioSubmissionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChallengeAudioSubmissions::route('/'),
            'edit' => EditChallengeAudioSubmission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
    
    public static function getNavigationBadgeTooltip(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count === 1 ? '1 audio pendiente' : "{$count} audios pendientes";
    }
}
