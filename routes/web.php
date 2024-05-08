<?php

use App\Http\Controllers\concernController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\FloodController;
use App\Http\Controllers\HouseController;



Route::get('/', function () {
    return view('welcome');
});

// Admin/Petugas
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::resource('pengaduans', 'PengaduanController');
        Route::resource('tanggapan', 'TanggapanController');


        // Route::resource('petugas', 'PetugasController');
        Route::get('laporan', 'AdminController@laporan');
        Route::get('laporan/cetak', 'AdminController@cetak');
        // Route::get('pengaduan/cetak/{id}', 'AdminController@pdf');
        // Route::get('pengaduan/{id}', 'AdminController@pdf');
    

        Route::prefix('trash')->group(function () {
            Route::get('/', [TrashController::class, 'index'])->name('trash.index');
            Route::get('update/{trashLevel}/{area_id}', [TrashController::class, 'simpanData'])->name('trash.update');
        });
        Route::prefix('water-level')->group(function () {
            Route::get('/', [FloodController::class, 'index'])->name('water.index');
            Route::get('update/{waterLevel}/{area_id}', [FloodController::class, 'simpanData'])->name('water.update');
        });
    });


Route::prefix('user')
    ->middleware(['auth', 'MasyarakatMiddleware'])
    ->group(function () {
        Route::get('/', 'MasyarakatController@index')->name('masyarakat-dashboard');
        Route::resource('pengaduan', 'MasyarakatController');
        // Route::get('concern', 'MasyarakatController@lihat');
        Route::get('concern', [concernController::class, 'userIndex'])->name('user_concern');

        Route::prefix('trash')->group(function () {
            Route::get('/', [TrashController::class, 'waste'])->name('trash.waste');
            // Route::get('update/{trashLevel}/{area_id}', [TrashController::class, 'simpanData'])->name('trash.update');
        });

        Route::prefix('floodWarning')->group(function () {
            Route::get('/', [FloodController::class, 'floodWarning'])->name('water.floodWarning');
            // Route::get('update/{waterLevel}/{area_id}', [FloodController::class, 'simpanData'])->name('water.update');
        });
    });

require __DIR__ . '/auth.php';
require __DIR__ . '/resident.php';
require __DIR__ . '/house.php';
require __DIR__ . '/area.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/concern.php';
require __DIR__ . '/responses.php';
