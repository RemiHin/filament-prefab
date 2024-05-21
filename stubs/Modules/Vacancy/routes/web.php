<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\VacancyController;

Route::get('/vacatures', [VacancyController::class, 'index'])->name('vacancy.index');
Route::get('/vacatures/{vacancy:slug}', [VacancyController::class, 'show'])->name('vacancy.show');
Route::get('/vacatures/download/{path}', [VacancyController::class, 'download'])->middleware('signed')->name('vacancy.download-cv');
Route::get('/solliciteer/{vacancy}', [ApplicantController::class, 'applicationForm'])->name('application.form');
