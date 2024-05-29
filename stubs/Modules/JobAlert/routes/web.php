<?php

use App\Http\Controllers\JobAlertController;

Route::prefix('job-alerts')->name('job-alert.')->group(function () {
    Route::get('/{jobAlert}/voorkeuren', [JobAlertController::class, 'preferences'])->middleware('signed')->name('preferences');
    Route::get('/{jobAlert}/bevestig', [JobAlertController::class, 'verify'])->middleware('signed')->name('verify');
    Route::get('/{jobAlert}/unsubscribe', [JobAlertController::class, 'unsubscribe'])->middleware('signed')->name('unsubscribe');
});
