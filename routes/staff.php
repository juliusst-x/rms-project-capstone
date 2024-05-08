<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\staffController;
use App\Http\Controllers;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/staff', [staffController::class, 'index'])->name('staff.view');
        Route::get('/staff/create', [staffController::class, 'addStaffPage'])->name('staff.create');
        Route::post('/staff/add', [staffController::class, 'addStaff'])->name('staff.store');

        Route::get('staff/{id}/', [staffController::class, 'editStaffPage'])->name('staff.edit');
        Route::put('staff/{id}/update', [staffController::class, 'updateStaff'])->name('staff.update');

        Route::delete('/staff/{id}', [staffController::class, 'deleteStaff'])->name('staff.delete');


    });