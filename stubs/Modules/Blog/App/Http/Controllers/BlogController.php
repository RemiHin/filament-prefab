<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\NewsItem;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $page = Label::getModel('blog-overview');
        return view('resources.page.blog-overview', ['model' => $page]);
    }

    public function show(NewsItem $blog)
    {
        return view('resources.blog.show', ['model' => $blog]);
    }
}
