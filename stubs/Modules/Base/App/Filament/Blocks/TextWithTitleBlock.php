<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class TextWithTitleBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('textWithTitle')
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->string()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('text')
                    ->label(__('Text'))
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->string()
                    ->maxLength(65535)
                    ->required(),
            ])
            ->label(__('Text with title'));
    }
}
