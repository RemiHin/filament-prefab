<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/blog', [NewsController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog:slug}', [NewsController::class, 'show'])->name('blog.show');
