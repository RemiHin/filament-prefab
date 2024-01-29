<?php

declare(strict_types=1);

namespace App\View\Components\Content;

use App\Models\Story;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class HighlightedStories extends Component
{
    public Collection $stories;

    public function __construct()
    {
        $this->stories = Story::visible()
            ->highlighted()
            ->latest()
            ->take(3)
            ->get();
    }

    public function render(): View
    {
        return view('components.content.highlighted-stories');
    }
}
