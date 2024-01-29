<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Employee as EmployeeModel;
use Filament\Forms\Get;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Awcodes\Curator\Components\Forms\CuratorPicker;

trait Employeeable
{
    public static function bootEmployeeable(): void
    {
        static::resolveRelationUsing('employees', function (Model $model) {
            return $model->morphToMany(EmployeeModel::class, 'model', 'employee_model')
                ->orderByPivot('order');
        });
    }

    // In order to implement these fields add `static::$model::employeeableFields(),` to your fields like any other field
    public static function employeeableFields(): Forms\Components\Fieldset
    {
        return
            Forms\Components\Fieldset::make('Employee')
                ->schema([
                    Forms\Components\Repeater::make('employees')
                        ->relationship('employees')
                        ->orderColumn('order')
                        ->simple(
                            Forms\Components\Select::make('employee')
                                ->options(EmployeeModel::visible()->pluck('name', 'id'))
                        ),
                ])
                ->columns(1);
    }
}
