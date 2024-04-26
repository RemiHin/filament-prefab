<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CookieConsentController;

Route::post('/cookies', CookieConsentController::class)->name('cookie_consent');

Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
