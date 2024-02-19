<?php

declare(strict_types=1);

namespace App\View\Components\Content;

use App\Models\Label;
use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class ServiceOverview extends Component
{
    public const AMOUNT_PER_PAGE = 6;

    public ?LengthAwarePaginator $services;

    public function __construct()
    {
        $this->services = Service::visible()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE);
        $servicePage = Label::getModel('service-overview');

        $this->services->setPath(route('service.index', ['model' => $servicePage]));
    }

    public function render(): View
    {
        return view('components.content.service-overview');
    }
}
