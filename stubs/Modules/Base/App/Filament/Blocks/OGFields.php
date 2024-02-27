<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Filament\Forms;
use Awcodes\Curator\Components\Forms\CuratorPicker;

abstract class OGFields
{
    public static function make($title = 'og'): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make($title)
            ->relationship(
                name: 'og',
            )
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->string()
                    ->maxLength(250)
                    ->nullable()
                    ->helperText(__('This title will be used when sharing on social media platforms')),

                CuratorPicker::make('image')
                    ->label(__('Image'))
                    ->nullable()
                    ->helperText(__('This image will be used when sharing on social media platforms. An image with the dimensions of :width by :height is recommended for the best results.', ['width' => 1200, 'height' => 630])),
            ])
            ->columns(1);
    }
}
