<?php

namespace App\Filament\Resources\Questions;

use App\Filament\Resources\Questions\Pages\CreateQuestions;
use App\Filament\Resources\Questions\Pages\EditQuestions;
use App\Filament\Resources\Questions\Pages\ListQuestions;
use App\Filament\Resources\Questions\Schemas\QuestionsForm;
use App\Filament\Resources\Questions\Tables\QuestionsTable;
use App\Models\Questions;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class QuestionsResource extends Resource
{
    protected static ?string $model = Questions::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;

    protected static string|UnitEnum|null $navigationGroup = 'Landing Page';

    protected static ?string $recordTitleAttribute = 'Preguntas';

    protected static ?string $navigationLabel = 'Preguntas';

    protected static ?string $modelLabel = 'Pregunta';

    protected static ?string $pluralModelLabel = 'Preguntas';

    public static function form(Schema $schema): Schema
    {
        return QuestionsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionsTable::configure($table);
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
            'index' => ListQuestions::route('/'),
            'create' => CreateQuestions::route('/create'),
            'edit' => EditQuestions::route('/{record}/edit'),
        ];
    }
}
