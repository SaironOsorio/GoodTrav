<?php

namespace App\Filament\Resources\Legals;

use App\Filament\Resources\Legals\Pages\CreateLegal;
use App\Filament\Resources\Legals\Pages\EditLegal;
use App\Filament\Resources\Legals\Pages\ListLegals;
use App\Filament\Resources\Legals\Schemas\LegalForm;
use App\Filament\Resources\Legals\Tables\LegalsTable;
use App\Models\Legal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LegalResource extends Resource
{
    protected static ?string $model = Legal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShieldCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Landing Page';

    protected static ?string $recordTitleAttribute = 'Informacion Legal';

    protected static ?string $navigationLabel = 'Informacion Legal';

    protected static ?string $modelLabel = 'Informacion Legal';

    protected static ?string $pluralModelLabel = 'Informacion Legal';

    public static function form(Schema $schema): Schema
    {
        return LegalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LegalsTable::configure($table);
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
            'index' => ListLegals::route('/'),
            'create' => CreateLegal::route('/create'),
            'edit' => EditLegal::route('/{record}/edit'),
        ];
    }
}
