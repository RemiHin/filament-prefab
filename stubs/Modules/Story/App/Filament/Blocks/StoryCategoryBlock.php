<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use App\Models\StoryCategory;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class StoryCategoryBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('storyCategory')
            ->schema([
                Forms\Components\Select::make('storyCategory')
                    ->required()
                    ->options(StoryCategory::whereHas('stories', fn ($builder) => $builder->visible()->published())->pluck('name','id')),
            ])
            ->label(__('Story Category'));
    }
}
