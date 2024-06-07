<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\concernController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\FloodController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\sendNotifController;




Route::get('/', function () {
    return view('welcome');
});


//Route::get('notif', [TrashController::class, 'sendNotif']);


// Admin/Petugas
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::resource('pengaduans', 'PengaduanController');
        Route::resource('tanggapan', 'TanggapanController');


        // Route::resource('petugas', 'PetugasController');
        Route::get('laporan', 'AdminController@laporan');
        Route::get('laporan/cetak', 'AdminController@cetak')->name("export_pdf");
        Route::get('laporan/cetak/{identifier}', [AdminController::class,'pdf'])->name("export_one_pdf");
        // Route::get('pengaduan/cetak/{id}', 'AdminController@pdf');
        // Route::get('pengaduan/{id}', 'AdminController@pdf');

        Route::prefix('trash')->group(function () {
            Route::get('/edit/{identifiers}', [TrashController::class, 'edit_trash_page'])->name('trash.edit.page');
            Route::post('/edit/{identifiers}', [TrashController::class, 'edit_trash'])->name('trash.edit');
            Route::delete('delete/{identifiers}', [TrashController::class, 'deleteTrash'])->name('trash.delete');
        });
        Route::prefix('water')->group(function () {
            Route::get('/edit/{identifiers}', [FloodController::class, 'edit_water_page'])->name('water.edit.page');
            Route::post('/edit/{identifiers}', [FloodController::class, 'edit_water'])->name('water.edit');
            Route::delete('delete/{identifiers}', [FloodController::class, 'deleteWater'])->name('water.delete');
        });
    });

Route::prefix('trash')->group(function () {
    Route::get('/', [TrashController::class, 'index'])->name('trash.index');
    Route::get('/create', [TrashController::class, 'add_trash_page'])->name('trash.create');
    Route::post('/create', [TrashController::class, 'addTrash'])->name('trash.add.data');
    Route::get('trash', [TrashController::class, 'waste_level'])->name('trash.data');
    Route::get('trash/status', [TrashController::class, 'waste_status'])->name('trash.status');
    Route::get('/sendNotif', [TrashController::class, 'sendNotification'])->name('trash.sendNotif');
    Route::get('/update/{trashLevel}/{id}', [TrashController::class, 'simpanData'])->name('trash.update');
});

Route::prefix('water-level')->group(function () {
    Route::get('/', [FloodController::class, 'index'])->name('water.index');
    Route::get('update/{waterLevel}/{id}', [FloodController::class, 'simpanData'])->name('water.update');
    Route::get('water', [FloodController::class, 'water_level'])->name('water.data');
    Route::get('water/status', [FloodController::class, 'water_status'])->name('water.status');
    Route::get('/create', [FloodController::class, 'add_water_page'])->name('water.create');
    Route::post('/create', [FloodController::class, 'addWater'])->name('water.add.data');

});

Route::prefix('user')
    ->middleware(['auth', 'MasyarakatMiddleware'])
    ->group(function () {
        Route::get('/', 'MasyarakatController@index')->name('masyarakat-dashboard');
        Route::resource('pengaduan', 'MasyarakatController');
        // Route::get('concern', 'MasyarakatController@lihat');
        Route::get('concern', [concernController::class, 'userIndex'])->name('user_concern');
        Route::get('concernform', [concernController::class, 'concernForm'])->name('concern_form');
        Route::get('concern/{id}', [concernController::class, 'userconcernDetail'])->name('user-concern-detail');

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