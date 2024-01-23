<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Label;
use App\Models\Page;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class BlogOverview extends Component
{
    use WithPagination;

    public const AMOUNT_PER_PAGE = 6;

    public Page|Model $blogOverviewPage;

    public function mount()
    {
        $this->blogOverviewPage = Label::getModel('blog-overview');
        $this->blogs = $this->getBlogs();
    }

    protected function getBlogs()
    {
        $blogs = Blog::query()
            ->visible()
            ->published()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE)
            ->setPath(route('blog.index'));

        return $blogs;
    }

    protected function setPath(): void
    {
        request()->server->set('REQUEST_URI', $this->blogOverviewPage->slug);
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

        return view('livewire.blog-overview', [
            'blogs' => $this->getBlogs()
        ]);
    }
}
