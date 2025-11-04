<?php

namespace App\Filament\Resources\Studies;

use App\Filament\Resources\Studies\Pages\CreateStudy;
use App\Filament\Resources\Studies\Pages\EditStudy;
use App\Filament\Resources\Studies\Pages\ListStudies;
use App\Filament\Resources\Studies\Schemas\StudyForm;
use App\Filament\Resources\Studies\Tables\StudiesTable;
use App\Models\Study;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Log;


class StudyResource extends Resource
{
    protected static ?string $model = Study::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'Administrador de Contenidos';

    protected static ?string $recordTitleAttribute = 'Clases';

    protected static ?string $navigationLabel = 'Clases';

    protected static ?string $modelLabel = 'clase';

    protected static ?string $pluralModelLabel = 'clases';

    protected static ?string $slug = 'clases';



    public static function form(Schema $schema): Schema
    {
        return StudyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudiesTable::configure($table);
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
            'index' => ListStudies::route('/'),
            'create' => Pages\CreateStudy::route('/create'),
            'edit' => EditStudy::route('/{record}/edit'),
        ];
    }

}
