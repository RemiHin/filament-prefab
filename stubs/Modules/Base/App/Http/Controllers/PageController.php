<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        if ($page->label?->label && file_exists(resource_path('views/resources/page/') . $page->label->label . '.blade.php')) {
            return view('resources/page/' . $page->label->label, ['model' => $page]);
        }

        if(file_exists(resource_path('views/resources/page/show.blade.php'))) {
            return view('resources/page/show', ['model' => $page]);
        }

        return view('index', ['model' => $page]);
    }
}
