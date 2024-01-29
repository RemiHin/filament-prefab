<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Label;
use App\Models\Page;
use App\Models\NewsItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class NewsOverview extends Component
{
    use WithPagination;

    public const AMOUNT_PER_PAGE = 6;

    public Page|Model $newsOverviewPage;

    public function mount()
    {
        $this->newsOverviewPage = Label::getModel('news-overview');
        $this->newsItems = $this->getNewsItems();
    }

    protected function getNewsItems()
    {
        $newsItems = NewsItem::query()
            ->visible()
            ->published()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE)
            ->setPath(route('news.index'));

        return $newsItems;
    }

    protected function setPath(): void
    {
        request()->server->set('REQUEST_URI', $this->newsOverviewPage->slug);
        request()->initialize(
            request()->query->all(),
            request()->request->all(),
            request()->attributes->all(),
            request()->cookies->all(),
            request()->files->all(),
            request()->server->all(),
            request()->getContent(),
        );
    }

    public function render()
    {
        $this->setPath();

        return view('livewire.news-overview', [
            'newsItems' => $this->getNewsItems()
        ]);
    }
}
