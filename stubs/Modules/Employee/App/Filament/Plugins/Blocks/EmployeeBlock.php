<?php

namespace App\Filament\Plugins\Blocks;

use App\Filament\Plugins\BaseBlock;
use App\Models\Employee;
use Filament\Forms;

class EmployeeBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'employee';
    }

    public static function getLabel(): string
    {
        return __('Employee');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\Select::make('employee')
                ->label(__('Employee'))
                ->required()
                ->options(Employee::visible()->pluck('name','id')),
        ];
    }

    public static function factory(): ?array
    {
        return [
            'employee' => Employee::visible()->inRandomOrder()->first()?->id,
        ];
    }

    public function getEmployee(): ?Employee
    {
        return Employee::visible()->firstWhere('id', $this->employee);
    }
}
