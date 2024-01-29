<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Story;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $page = Label::getModel('story-overview');
        return view('resources.page.story-overview', ['model' => $page]);
    }

    public function show(Story $story)
    {
        return view('resources.story.show', ['model' => $story]);
    }
}
