<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use App\Models\Story;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class StoryBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('story')
            ->schema([
                Forms\Components\Select::make('story')
                    ->required()
                    ->options(Story::visible()->published()->pluck('name','id')),
            ])
            ->label(__('Story'));
    }
}
