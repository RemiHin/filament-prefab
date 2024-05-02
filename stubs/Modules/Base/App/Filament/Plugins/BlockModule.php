<?php

declare(strict_types=1);

namespace App\Filament\Plugins;

use Filament\Forms;

abstract class BlockModule
{
    protected static function blocks(string $group): array
    {
        return collect(config('blocks.' . $group, []))
            ->map(fn (string|BaseBlock $block) => $block::make())
            ->toArray();
    }

    public static function make(string $column, string $group = 'active'): Forms\Components\Fieldset
    {
        // TODO: Translations!!!!!

        return Forms\Components\Fieldset::make(__('Blocks'))
            ->schema([
                Forms\Components\Builder::make($column)
                    ->addActionLabel(__('Add block'))
                    ->label(__('Blocks'))
                    ->blocks(
                        self::blocks($group)
                    ),

            ])
            ->columns(1);
    }
}
