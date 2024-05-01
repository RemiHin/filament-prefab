<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class ImageBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('image')
            ->schema([
                CuratorPicker::make('image')
                    ->buttonLabel(__('Add image'))
                    ->label(__('Image'))
                    ->required(),
            ])
            ->label(__('Image'));
    }
}
