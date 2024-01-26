<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class VideoBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('video')
            ->schema(self::videoFields())
            ->label(__('Video'));
    }

    public static function videoFields(): array
    {
        return [
            Forms\Components\TextInput::make('video_url')
                ->label(__('Video URL'))
                ->required()
                ->string()
                ->url()
                ->helperText(__('Enter the link to the Youtube or Vimeo video')),

            Forms\Components\Toggle::make('autoplay')
                ->label(__('Autoplay'))
                ->default(false)
                ->helperText(__('Vimeo\'s autoplay function doesn\'t always work')),

            Forms\Components\Toggle::make('loop')
                ->label(__('Repeat'))
                ->default(false),

            Forms\Components\Toggle::make('mute')
                ->label(__('Mute'))
                ->default(false)
                ->helperText(__('The video is always mutes when autoplay is on')),
        ];
    }
}
