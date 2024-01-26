<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Fieldset;

abstract class BlockModule
{
    public static function make($title = 'blocks'): Fieldset
    {
        return Fieldset::make(__(''))
            ->schema([
                Builder::make($title)
                    ->addActionLabel('Blok toevoegen')
                    ->label(__('Blocks'))
                    ->blocks(
                        self::baseBlocks()
                    ),
            ])
            ->columns(1);
    }

    public static function baseBlocks(): array
    {
        return [
            TextBlock::make(),
            TextWithImageBlock::make(),
            TextWithTitleBlock::make(),
            ImageBlock::make(),
            VideoBlock::make(),
            QuoteBlock::make(),
            ToggleContentBlock::make(),
        ];
    }

    public static function blocksWithoutToggle(): array
    {
        return [
            TextBlock::make(),
            TextWithImageBlock::make(),
            TextWithTitleBlock::make(),
            ImageBlock::make(),
            VideoBlock::make(),
            QuoteBlock::make(),
        ];
    }
}
