<?php

declare(strict_types=1);

namespace App\View\Components\Content;

use App\Models\Employee;
use App\Models\Label;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeOverview extends Component
{
    public const AMOUNT_PER_PAGE = 12;

    public ?LengthAwarePaginator $employees;

    public function __construct()
    {
        $this->employees = Employee::query()
            ->visible()
            ->paginate(self::AMOUNT_PER_PAGE);

        $employeePage = Label::getModel('employee-overview');

        $this->employees->setPath($employeePage->url);
    }

    public function render(): View
    {
        return view('components.content.employee-overview');
    }
}
