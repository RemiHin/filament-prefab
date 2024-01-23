<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Enums\MenuEnum;

class Main extends MenuComponent
{
    public string $menuEnum = MenuEnum::MAIN;

    public function render()
    {
        return view('components.menu.main');
    }
}
