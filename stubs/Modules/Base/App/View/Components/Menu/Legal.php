<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Enums\MenuEnum;

class Legal extends MenuComponent
{
    public string $menuEnum = MenuEnum::LEGAL_TERMS;

    public function render()
    {
        return view('components.menu.legal');
    }
}
