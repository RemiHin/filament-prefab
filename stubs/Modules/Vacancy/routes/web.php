<?php

use App\Http\Controllers\VacancyController;

Route::get('/vacatures', [VacancyController::class, 'index'])->name('vacancy.index');
Route::get('/vacatures/{vacancy:slug}', [VacancyController::class, 'show'])->name('vacancy.show');
