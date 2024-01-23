<?php

declare(strict_types=1);

namespace App\View\Components\Menu;

use App\Models\Label;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

//use  todo: Motivo\Liberiser\Modules\Menu\Models\Menu;
//use Motivo\Liberiser\Modules\Motivo\Models\Label;
//use Motivo\Liberiser\Modules\Menu\Models\MenuItem;

abstract class MenuComponent extends Component
{
    public $menu = [];

    public string $textColor;

    public string $menuEnum;

    public function __construct(string $textColor)
    {
        $this->menu = $this->getMenu();
        $this->textColor = $textColor;
    }

    protected function getMenu(): ?Collection
    {
        return Cache::remember('menu.' . $this->menuEnum, 60 * 60 * 24, function () {
//       todo:     /** @var Menu $menu */
            $menu = Label::getModel($this->menuEnum);

            return $menu?->children()
                ->with([
                    'resource',
                    'children',
                    'children.resource',
                    'children.children',
                    'children.children.resource',
                    'children.children.children',
                    'children.children.children.resource',
                ])
                ->get();
        });
    }
}
