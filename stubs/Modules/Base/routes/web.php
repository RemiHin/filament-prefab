<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;


Route::get('/zoeken', [SearchController::class, 'search'])->name('search');
Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
