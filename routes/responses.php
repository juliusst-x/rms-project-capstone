<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\responseController;
use App\Http\Controllers;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/response/{id}', [responseController::class, 'index'])->name('response.view');
        Route::post('/response/{id}/create', [responseController::class, 'addResponse'])->name('response.create');
    });