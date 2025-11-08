<?php

namespace App\Filament\Resources\Subcriptions;

use App\Filament\Resources\Subcriptions\Pages\CreateSubcription;
use App\Filament\Resources\Subcriptions\Pages\EditSubcription;
use App\Filament\Resources\Subcriptions\Pages\ListSubcriptions;
use App\Filament\Resources\Subcriptions\Schemas\SubcriptionForm;
use App\Filament\Resources\Subcriptions\Tables\SubcriptionsTable;
use App\Models\Subcription;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SubcriptionResource extends Resource
{
    protected static ?string $model = Subcription::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    protected static ?string $recordTitleAttribute = 'Suscripciones';

    protected static string|UnitEnum|null $navigationGroup = 'Administrador de Suscripciones';

    protected static ?string $navigationLabel = 'Suscripciones';

    protected static ?string $modelLabel = 'Suscripción';

    protected static ?string $pluralModelLabel = 'Suscripciones';

    protected static ?string $slug = 'suscripciones';


    public static function form(Schema $schema): Schema
    {
        return SubcriptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubcriptionsTable::configure($table);
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
            'index' => ListSubcriptions::route('/'),
            'create' => CreateSubcription::route('/create'),
            'edit' => EditSubcription::route('/{record}/edit'),
        ];
    }
}
