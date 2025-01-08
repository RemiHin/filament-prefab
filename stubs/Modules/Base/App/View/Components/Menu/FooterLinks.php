<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Enums\MenuEnum;
use App\Models\MenuItem;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class FooterLinks extends Component
{
    public Collection $menuItems;

    public function __construct()
    {
        $this->menuItems = MenuItem::query()
            ->whereHas('menu.label', fn(Builder $builder) => $builder->where('label', MenuEnum::FOOTER))
            ->where('parent_id', -1)
            ->with(['children'])
            ->orderBy('order')
            ->get();
    }

    public function render(): View
    {
        return view('components.menu.footer-links');
    }
}
