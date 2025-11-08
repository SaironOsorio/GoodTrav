<?php

namespace App\Filament\Resources\Contributors;

use App\Filament\Resources\Contributors\Pages\CreateContributors;
use App\Filament\Resources\Contributors\Pages\EditContributors;
use App\Filament\Resources\Contributors\Pages\ListContributors;
use App\Filament\Resources\Contributors\Schemas\ContributorsForm;
use App\Filament\Resources\Contributors\Tables\ContributorsTable;
use App\Models\Contributors;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ContributorsResource extends Resource
{
    protected static ?string $model = Contributors::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static string|UnitEnum|null $navigationGroup = 'Landing Page';

    protected static ?string $recordTitleAttribute = 'Colaboradores';

    protected static ?string $navigationLabel = 'Colaboradores';

    protected static ?string $modelLabel = 'Colaborador';

    protected static ?string $pluralModelLabel = 'Colaboradores';



    public static function form(Schema $schema): Schema
    {
        return ContributorsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContributorsTable::configure($table);
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
            'index' => ListContributors::route('/'),
            'create' => CreateContributors::route('/create'),
            'edit' => EditContributors::route('/{record}/edit'),
        ];
    }
}
