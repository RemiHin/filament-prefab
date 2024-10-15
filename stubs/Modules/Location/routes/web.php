<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/locaties', [LocationController::class, 'index'])->name('location.index');
Route::get('/locaties/{location:slug}', [LocationController::class, 'show'])->name('location.show');
