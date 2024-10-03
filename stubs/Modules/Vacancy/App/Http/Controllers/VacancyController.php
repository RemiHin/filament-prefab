<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VacancyController extends Controller
{
    public function index(): View
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

    public function download(string $path): StreamedResponse
    {
        return Storage::disk('cv')->download($path);
    }
}
