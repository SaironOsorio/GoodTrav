<?php

namespace App\Filament\Resources\Legals\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;

class LegalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                RichEditor::make('content_legal')
                    ->label('Contenido Legal')
                    ->helpertext('Aqui va el contenido del aviso legal')
                    ->required()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'link'],
                        ['h2', 'h3'],
                        ['undo', 'redo'],
                    ])
                    ->columnSpanFull(),
                RichEditor::make('content_privacity')
                    ->label('Contenido de Privacidad')
                    ->helpertext('Aqui va el contenido de la politica de privacidad')
                    ->required()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'link'],
                        ['h2', 'h3'],
                        ['undo', 'redo'],
                    ])
                    ->columnSpanFull(),
                RichEditor::make('content_cookies')
                    ->label('Contenido de Cookies')
                    ->helpertext('Aqui va el contenido de la politica de cookies')
                    ->required()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'link'],
                        ['h2', 'h3'],
                        ['undo', 'redo'],
                    ])
                    ->columnSpanFull(),
                RichEditor::make('content_terms')
                    ->label('Contenido de Terminos y Condiciones')
                    ->helpertext('Aqui va el contenido de los terminos y condiciones')
                    ->required()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'link'],
                        ['h2', 'h3'],
                        ['undo', 'redo'],
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
