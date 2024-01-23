<?php

use App\Http\Controllers\PageController;


Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
