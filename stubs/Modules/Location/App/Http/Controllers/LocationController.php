<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Location;


class LocationController extends Controller
{
    public function index()
    {
        $page = Label::getModel('location-overview');
        return view('resources.page.location-overview', ['model' => $page]);
    }

    public function show(Location $location)
    {
        abort_if(! $location->isVisible(), 404);

        return view('resources.location.show', ['model' => $location]);
    }
}
