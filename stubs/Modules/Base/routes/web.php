<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\SearchController;

Route::post('/cookies', CookieConsentController::class)->name('cookie_consent');

Route::get('/zoeken', [SearchController::class, 'search'])->name('search');
Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
