<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AreaController;
use App\Http\Controllers;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/areas', [AreaController::class, 'index'])->name('area.view');
        Route::get('/areas/create', [AreaController::class, 'addAreaPage'])->name('area.create');
        Route::post('/areas/add', [AreaController::class, 'addArea'])->name('area.store');

        Route::get('areas/{id}/', [AreaController::class, 'editAreaPage'])->name('area.edit');
        Route::put('areas/{id}/update', [AreaController::class, 'updateArea'])->name('area.update');

        Route::delete('/areas/{id}', [AreaController::class, 'delete'])->name('area.delete');


    });