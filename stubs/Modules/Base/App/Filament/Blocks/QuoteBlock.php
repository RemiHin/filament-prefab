<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class QuoteBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('quote')
            ->schema([
                Forms\Components\Textarea::make('quote')
                    ->label(__('Quote'))
                    ->string()
                    ->maxLength(65535)
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->nullable()
                    ->string()
                    ->maxLength(255),

                CuratorPicker::make('image')
                    ->label(__('Image'))
                    ->required(),

                ])
            ->label(__('Quote'));
    }
}
