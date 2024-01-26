<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class TextWithImageBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('textWithImage')
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->string()
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('text')
                    ->label(__('Text'))
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->string()
                    ->maxLength(65535)
                    ->required(),

                CuratorPicker::make('image')
                    ->label(__('Image'))
                    ->required(),

                Forms\Components\Radio::make('position')
                    ->label(__('Position'))
                    ->options([
                        'left' => __('Left'),
                        'right' => __('Right'),
                    ])
                    ->required()
                    ->default('left'),
            ])
            ->label(__('Text with image'));
    }
}
