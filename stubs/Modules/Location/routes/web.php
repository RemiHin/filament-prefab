<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/locatie', [LocationController::class, 'index'])->name('location.index');
Route::get('/locatie/{location:slug}', [LocationController::class, 'show'])->name('location.show');
