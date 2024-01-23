<?php

declare(strict_types=1);

namespace App\View\Components\Content;

use App\Models\Label;
use App\Models\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class BlogOverview extends Component
{
    public const AMOUNT_PER_PAGE = 6;

    public ?LengthAwarePaginator $blogs;

    public function __construct()
    {
        $this->blogs = Blog::visible()
            ->published()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE);
        $blogPage = Label::getModel('blog-overview');

        $this->blogs->setPath(route('blog.index'));
    }

    public function render(): View
    {
        return \App\View\Components\Content\view('components.content.blog-overview');
    }
}
