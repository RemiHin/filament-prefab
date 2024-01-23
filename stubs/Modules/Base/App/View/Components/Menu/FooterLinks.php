<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Enums\MenuEnum;

class FooterLinks extends MenuComponent
{
    public string $menuEnum = MenuEnum::FOOTER;

    public function render()
    {
        return view('components.menu.footer-links');
    }
}
