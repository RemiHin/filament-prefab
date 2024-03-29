<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use Filament\Forms;

abstract class SeoFields
{
    public static function make($title = 'seo'): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make($title)
            ->relationship(
                name: 'seo',
            )
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('SEO title'))
                    ->string()
                    ->maxLength(250)
                    ->nullable()
                    ->helperText(__('The recommended length is between :min and :max characters', [
                        'min' => 50,
                        'max' => 60,
                    ])),

                Forms\Components\Textarea::make('description')
                    ->label(__('SEO description'))
                    ->string()
                    ->maxLength(250)
                    ->nullable()
                    ->helperText(__('The recommended length is between :min and :max characters', [
                        'min' => 120,
                        'max' => 170,
                    ])),

                Forms\Components\Toggle::make('noindex')
                    ->label(__('Allow index'))
                    ->default(true),

                Forms\Components\Toggle::make('nofollow')
                    ->label(__('Allow follow'))
                    ->default(false)
                    ->helperText(__('Allow search engines to follow links on this resource')),
            ])
            ->columns(1);
    }
}
