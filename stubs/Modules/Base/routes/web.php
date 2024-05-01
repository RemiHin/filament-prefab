<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

Route::post('/contact', [ContactController::class, 'submit'])->name('contact');

Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
