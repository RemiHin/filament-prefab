<?php

declare(strict_types=1);

namespace App\View\Components\Content;

use App\Models\Label;
use App\Models\Location;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LocationOverview extends Component
{
    public const AMOUNT_PER_PAGE = 6;

    public ?LengthAwarePaginator $locations;

    public function __construct()
    {
        $this->locations = Location::visible()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE);

        $locationPage = Label::getModel('location-overview');

        $this->locations->setPath(url($locationPage->slug));
    }

    public function render(): View
    {
        return view('components.content.location-overview');
    }
}
