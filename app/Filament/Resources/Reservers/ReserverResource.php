<?php

namespace App\Filament\Resources\Reservers;

use App\Filament\Resources\Reservers\Pages\CreateReserver;
use App\Filament\Resources\Reservers\Pages\EditReserver;
use App\Filament\Resources\Reservers\Pages\ListReservers;
use App\Filament\Resources\Reservers\Pages\ViewReserver;
use App\Filament\Resources\Reservers\Schemas\ReserverForm;
use App\Filament\Resources\Reservers\Schemas\ReserverInfolist;
use App\Filament\Resources\Reservers\Tables\ReserversTable;
use App\Models\Reserver;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReserverResource extends Resource
{
    protected static ?string $model = Reserver::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PaperAirplane;

    protected static ?string $recordTitleAttribute = 'Reserver';

    protected static string|UnitEnum|null $navigationGroup = 'GoodTrav Society';

    public static function form(Schema $schema): Schema
    {
        return ReserverForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReserverInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReserversTable::configure($table);
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
            'index' => ListReservers::route('/'),
            'create' => CreateReserver::route('/create'),
            'view' => ViewReserver::route('/{record}'),
            'edit' => EditReserver::route('/{record}/edit'),
        ];
    }
}
