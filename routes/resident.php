<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\residentController;
use App\Http\Controllers;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('resident', [residentController::class, 'index'])->name("resident.view");
        Route::get('resident/create', [residentController::class, 'addResidentPage'])->name('resident.create');
        Route::post('resident/add', [residentController::class, 'addResident'])->name('resident.store');
        Route::get('resident/{id}/', [residentController::class, 'editResident'])->name('resident.edit');
        Route::put('resident/{id}/update', [residentController::class, 'updateResident'])->name('resident.update');
        Route::delete('resident/{id}', [residentController::class, 'deleteResident'])->name('resident.delete');
    });
