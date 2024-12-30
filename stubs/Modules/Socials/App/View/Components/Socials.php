<?php

namespace RemiHin\FilamentPrefabStubs\Modules\Socials\App\View\Components;

use App\Models\Social;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use function App\View\Components\view;

class Socials extends Component
{
    public Collection $socials;

    public function __construct()
    {
        $this->socials = Social::query()
            ->visible()
            ->orderBy('sort')
            ->get();
    }

    public function render(): View
    {
        return view('components.socials');
    }
}
