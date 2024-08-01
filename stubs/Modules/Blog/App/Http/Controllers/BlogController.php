<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $page = Label::getModel('blog-overview');
        return view('resources.page.blog-overview', ['model' => $page]);
    }

    public function show(Blog $blog)
    {
        abort_if(! $blog->isVisible() || ! $blog->isPublished(), 404);

        return view('resources.blog.show', ['model' => $blog]);
    }
}
