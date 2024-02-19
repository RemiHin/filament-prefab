<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class ServiceBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('service')
            ->schema([
                Forms\Components\Select::make('service')
                    ->required()
                    ->options(Service::visible()->published()->pluck('name','id')),
            ])
            ->label(__('Service'));
    }
}
