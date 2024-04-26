<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\CookieConsent;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CookieConsentController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $types = $request->input('cookie_consent_types', []);

        $cookie = CookieConsent::createCookie($types);

        return Redirect::back()
            ->withCookie($cookie);
    }
}
