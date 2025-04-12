<?php
use Illuminate\Support\Facades\Route;
// admin
use App\Http\Controllers\admin\HariLiburController;
use App\Http\Controllers\admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// ADMIN
Route::prefix('admin')->group(function(){
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.admin');
    // HARI LIBUR
    Route::prefix('hari-libur')->group(function(){
        Route::get('', [HariLiburController::class, 'index'])->name('harilibur');
        // CREATE
        Route::get('create', [HariLiburController::class, 'create'])->name('harilibur.create');
        Route::post('store', [HariLiburController::class, 'store'])->name('harilibur.store');
        // edit
        Route::get('edit/{slug}', [HariLiburController::class, 'edit'])->name('harilibur.edit');
        Route::put('update/{id}', [HariLiburController::class, 'update'])->name('harilibur.update');
        // delete
        Route::delete('delete/{id}', [HariLiburController::class, 'delete'])->name('harilibur.delete');
    });
});

// GURU
Route::prefix('guru')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.guru');
});

// KURIKULUM
Route::prefix('kurikulum')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.kurikulum');
});

// SISWA
Route::prefix('siswa')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.siswa');
});

// WALIKELAS
Route::prefix('walikelas')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.walikelas');
});
