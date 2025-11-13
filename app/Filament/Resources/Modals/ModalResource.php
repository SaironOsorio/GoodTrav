<?php

namespace App\Filament\Resources\Modals;

use App\Filament\Resources\Modals\Pages\CreateModal;
use App\Filament\Resources\Modals\Pages\EditModal;
use App\Filament\Resources\Modals\Pages\ListModals;
use App\Filament\Resources\Modals\Schemas\ModalForm;
use App\Filament\Resources\Modals\Tables\ModalsTable;
use App\Models\Modal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModalResource extends Resource
{
    protected static ?string $model = Modal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::RocketLaunch;

    protected static string|UnitEnum|null $navigationGroup = 'Anuncios';

    protected static ?string $recordTitleAttribute = 'Anuncios';

    protected static ?string $navigationLabel = 'Anuncios';

    protected static ?string $modelLabel = 'Anuncio';

    protected static ?string $pluralModelLabel = 'Anuncios';

    public static function form(Schema $schema): Schema
    {
        return ModalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModalsTable::configure($table);
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
            'index' => ListModals::route('/'),
            'create' => CreateModal::route('/create'),
            'edit' => EditModal::route('/{record}/edit'),
        ];
    }
}
