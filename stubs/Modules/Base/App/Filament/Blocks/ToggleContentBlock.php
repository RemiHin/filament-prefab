<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;

class ToggleContentBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('toggle_content')
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->string()
                    ->maxLength(255),

                Builder::make('toggle_content')
                    ->label('Blokken')
                    ->blocks(
                        BlockModule::blocksWithoutToggle()
                    ),
            ])
            ->label(__('Toggle content'));
    }
}
