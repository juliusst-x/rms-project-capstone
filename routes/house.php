<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\houseController;
use App\Http\Controllers;


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/houses', [houseController::class, 'index'])->name('house.view');
        Route::get('/house/create', [houseController::class, 'addHousePage'])->name('house.create');
        Route::post('/house/add', [houseController::class, 'addHouse'])->name('house.store');
        Route::get('house/{id}', [houseController::class, 'editHousePage'])->name('house.edit');
        Route::put('house/{id}/update', [houseController::class, 'updateHouse'])->name('house.update');
        Route::delete('house/{id}', [houseController::class, 'deleteHouse'])->name('house.delete');
    });