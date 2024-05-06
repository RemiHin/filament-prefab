<?php

use App\Http\Controllers\FormBuilderController;


Route::post('/forms/{form}', FormBuilderController::class)->name('form.submit');
