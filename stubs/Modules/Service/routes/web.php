<?php

use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/diensten', [ServiceController::class, 'index'])->name('service.index');
Route::get('/diensten/{service:slug}', [ServiceController::class, 'show'])->name('service.show');
