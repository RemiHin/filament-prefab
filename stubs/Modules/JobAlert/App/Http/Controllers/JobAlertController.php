<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Page;
use App\Models\JobAlert;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JobAlertController extends Controller
{
    public function verify(JobAlert $jobAlert): RedirectResponse
    {
        $jobAlert->verify();

        /** @var Page $page */
        $page = Label::getModel('job-alert-confirmed');

        return redirect()->to($page->slug);
    }

    public function preferences(JobAlert $jobAlert): View
    {
        return view('job-alerts.show', ['jobAlert' => $jobAlert]);
    }

    public function unsubscribe(JobAlert $jobAlert): RedirectResponse
    {
        $jobAlert->delete();

        /** @var Page $page */
        $page = Label::getModel('job-alert-unsubscribe');

        return redirect()->to($page->slug);
    }
}
