<?php

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
