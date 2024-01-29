<?php

declare(strict_types=1);

namespace App\Filament\Blocks;

use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;

class EmployeeBlock
{
    public static function make(): Block
    {
        return Forms\Components\Builder\Block::make('employee')
            ->schema([
                Forms\Components\Select::make('employee')
                    ->required()
                    ->options(Employee::visible()->pluck('name','id')),
            ])
            ->label(__('Employee'));
    }
}
