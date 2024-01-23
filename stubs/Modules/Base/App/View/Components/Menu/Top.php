<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Enums\MenuEnum;

class Top extends MenuComponent
{
    public string $menuEnum = MenuEnum::TOP;

    public function render()
    {
        return view('components.menu.top');
    }
}
