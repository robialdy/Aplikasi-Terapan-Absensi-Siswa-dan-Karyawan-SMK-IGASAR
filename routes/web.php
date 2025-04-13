<?php
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
// admin
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\MataPelajaranController;
use App\Http\Controllers\admin\HariLiburController;
use App\Http\Controllers\admin\DashboardController;
// guru
use App\Http\Controllers\guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\kurikulum\DashboardController as KurikulumDashboardController;
use App\Http\Controllers\siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\walikelas\DashboardController as WalikelasDashboardController;

// walikelas

// kurikulum

// siswa


// AUTH
Route::prefix('auth')->group(function(){
    Route::get('', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    // register
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('register/store', [AuthController::class, 'registerStore'])->name('auth.register.store');
    // logout
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/', function () {
    return view('welcome');
});

// ADMIN
Route::middleware(['auth', 'role:Admin'])->group(function(){
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
        // MATA PELAJARAN
        Route::prefix('mata-pelajaran')->group(function (){
            Route::get('', [MataPelajaranController::class, 'index'])->name('matapelajaran');
            // CREATE
            Route::get('create', [MataPelajaranController::class, 'create'])->name('matapelajaran.create');
            Route::post('store', [MataPelajaranController::class, 'store'])->name('matapelajaran.store');
            // EDIT
            Route::get('edit/{slug}', [MataPelajaranController::class, 'edit'])->name('matapelajaran.edit');
            Route::put('update/{id}', [MataPelajaranController::class, 'update'])->name('matapelajaran.update');
            // DELETE
            Route::delete('delete/{id}', [MataPelajaranController::class, 'delete'])->name('matapelajaran.delete');
        });
        // USER
        Route::prefix('user')->group(function(){
            Route::get('', [UserController::class, 'index'])->name('user');
            // create
            Route::get('create', [UserController::class, 'create'])->name('user.create');
            Route::post('store', [UserController::class, 'store'])->name('user.store');
            // edit
            Route::get('edit/{slug}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('update/{id}', [UserController::class, 'update'])->name('user.update');
            // delete
            Route::delete('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        });
        // SISWA
        Route::prefix('siswa')->group(function () {
            Route::get('', [SiswaController::class, 'index'])->name('siswa');
            // create
            Route::get('create', [SiswaController::class, 'create'])->name('siswa.create');
            Route::post('store', [SiswaController::class, 'store'])->name('siswa.store');
            // edit
            Route::get('edit/{slug}', [SiswaController::class, 'edit'])->name('siswa.edit');
            Route::put('update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
            // delete
            Route::delete('delete/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
        });
    });
});

// GURU
Route::middleware(['auth', 'role:Guru/Karyawan'])->group(function () {
    Route::prefix('guru')->group(function () {
        Route::get('', [GuruDashboardController::class, 'index'])->name('dashboard.guru');
    });
});

// KURIKULUM
Route::middleware(['auth', 'role:Kurikulum'])->group(function () {
    Route::prefix('kurikulum')->group(function () {
        Route::get('', [KurikulumDashboardController::class, 'index'])->name('dashboard.kurikulum');
    });
});

// SISWA
Route::middleware(['auth', 'role:Siswa'])->group(function () {
    Route::prefix('siswa')->group(function () {
        Route::get('', [SiswaDashboardController::class, 'index'])->name('dashboard.siswa');
    });
});

// WALIKELAS
Route::middleware(['auth', 'role:Walikelas'])->group(function () {
    Route::prefix('walikelas')->group(function () {
        Route::get('', [WalikelasDashboardController::class, 'index'])->name('dashboard.walikelas');
    });
});
