<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Enums\MenuEnum;
use App\Models\Label;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Main extends Component
{
    public Collection $menuItems;

    public function __construct()
    {
        $this->menuItems = MenuItem::query()
            ->whereHas('menu.label', fn(Builder $builder) => $builder->where('label', MenuEnum::MAIN))
            ->orderBy('order')
            ->where('parent_id', -1)
            ->with(['children'])
            ->get();
    }

    public function render()
    {
        return view('components.menu.tree');
    }
}
