<?php

use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\FormUploadsController;


Route::get('/form-uploads/temp/{path}', [FormUploadsController::class, 'download'])->middleware('signed')->name('form-uploads.temp');
Route::post('/forms/{form}', FormBuilderController::class)->name('form.submit');
