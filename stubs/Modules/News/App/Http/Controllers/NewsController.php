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
        return view('resources.news.show', ['model' => $newsItem]);
    }
}
