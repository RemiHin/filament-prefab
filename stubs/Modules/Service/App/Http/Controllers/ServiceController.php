<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $page = Label::getModel('service-overview');
        return view('resources.page.service-overview', ['model' => $page]);
    }

    public function show(Service $service)
    {
        abort_if(! $service->isVisible(), 404);

        return view('resources.service.show', ['model' => $service]);
    }
}
