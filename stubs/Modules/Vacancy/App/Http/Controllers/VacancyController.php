<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;

class VacancyController extends Controller
{
    public function idnex(): View
    {
        $page = Label::getModel('vacancy-overview');

        return view('resources.page.vacancy-overview', [
            'model' => $page,
        ]);
    }

    public function show(Vacancy $vacancy): View
    {
        abort_if(! $vacancy->isVisible(), $vacancy->isPublished(), 404);

        return view('resources.vacancy.show', ['model' => $vacancy]);
    }
}
