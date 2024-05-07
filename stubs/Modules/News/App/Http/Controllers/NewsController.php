<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\NewsItem;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $newsItem = Label::getModel('news-overview');
        return view('resources.page.news-overview', ['model' => $newsItem]);
    }

    public function show(NewsItem $newsItem)
    {
        abort_if(! $newsItem->isVisible() || ! $newsItem->isPublished(), 404);

        return view('resources.news.show', ['model' => $newsItem]);
    }
}
