<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Contracts\View\View;

class ApplicantController
{
    public function applicationForm(Vacancy $vacancy): View
    {
        return view('application.apply', ['vacancy' => $vacancy]);
    }
}
