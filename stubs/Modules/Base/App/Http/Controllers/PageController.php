<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(): View
    {
        /** @var Page $page */
        $page = Page::query()
            ->whereHas('label', fn (MorphOne|Builder $builder) => $builder->where('label', 'home'))
            ->firstOrFail();

        return $this->getView($page);
    }

    public function show(Page $page): View
    {
        return $this->getView($page);
    }

    protected function getView(Page $page): View
    {
        abort_if(! $page->isVisible(), 404);

        if ($page->label?->label && file_exists(resource_path('views/resources/page/') . $page->label->label . '.blade.php')) {
            return view('resources/page/' . $page->label->label, ['model' => $page]);
        }

        if(file_exists(resource_path('views/resources/page/show.blade.php'))) {
            return view('resources/page/show', ['model' => $page]);
        }

        return view('index', ['model' => $page]);
    }
}
