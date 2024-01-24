<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Enums\MenuEnum;
use App\Models\Label;
use App\Models\Menu;
use Illuminate\View\Component;

class Top extends Component
{
    public ?Menu $menu;

    public function __construct()
    {
        $this->menu = Label::getModel(MenuEnum::TOP);
    }

    public function render()
    {
        return view('components.menu.tree');
    }
}
