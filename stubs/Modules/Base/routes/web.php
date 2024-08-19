<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;

// RouteDefinitions

Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact');
Route::post('/cookies', CookieConsentController::class)->name('cookie_consent');
Route::get('/zoeken', [SearchController::class, 'search'])->name('search');
Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
