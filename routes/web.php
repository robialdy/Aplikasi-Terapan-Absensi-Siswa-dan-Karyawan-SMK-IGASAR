<?php
use Illuminate\Support\Facades\Route;
// admin
use App\Http\Controllers\admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// ADMIN
Route::prefix('admin')->group(function(){
    Route::get('', [DashboardController::class, 'index'])->name('dashboard.admin');
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
