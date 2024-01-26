<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class TextBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('text')
            ->schema([
                Forms\Components\RichEditor::make('text')
                    ->label(__('Text'))
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->string()
                    ->maxLength(65535)
                    ->required(),
            ])
            ->label(__('Text'));
    }
}
