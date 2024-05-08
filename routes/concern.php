<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\concernController;
use App\Http\Controllers;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('concern', [concernController::class, 'adminIndex'])->name('admin-concern');
        Route::get('concern/{id}', [concernController::class, 'concernDetail'])->name('admin-concern-detail');
    });