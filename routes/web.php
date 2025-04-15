<?php

use App\Http\Controllers\admin\AbsensiGerbangController;
use App\Http\Controllers\admin\AbsensiKelasController as AdminAbsensiKelasController;
use App\Http\Controllers\admin\JadwalController;
use App\Http\Controllers\admin\KelasController;
use App\Http\Controllers\admin\RiwayatKelasController;
use App\Http\Controllers\admin\ScannerController;
use App\Http\Controllers\admin\SiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
// admin
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\MataPelajaranController;
use App\Http\Controllers\admin\HariLiburController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\guru\AbsensiKelasController;
// guru
use App\Http\Controllers\guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\kurikulum\DashboardController as KurikulumDashboardController;
use App\Http\Controllers\siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\siswa\QrCodeController;
use App\Http\Controllers\walikelas\DashboardController as WalikelasDashboardController;
use App\Models\Jadwal;

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
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
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
        // KELAS
        Route::prefix('kelas')->group(function(){
            Route::get('', [KelasController::class, 'index'])->name('kelas');
            // create
            Route::get('create', [KelasController::class, 'create'])->name('kelas.create');
            Route::post('store', [KelasController::class, 'store'])->name('kelas.store');
            // edit
            Route::get('edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
            Route::put('update/{id}', [KelasController::class, 'update'])->name('kelas.update');
            // delete
            Route::delete('delete/{id}', [KelasController::class, 'delete'])->name('kelas.delete');
        });
        // JADWAL
        Route::prefix('jadwal')->group(function(){
            Route::get('', [JadwalController::class, 'index'])->name('jadwal');
            Route::get('{nig}', [JadwalController::class, 'guru'])->name('jadwal.first');
            Route::get('{nig}/{id_kelas}', [JadwalController::class, 'view_table'])->name('jadwal.two');
            // create
            Route::post('store', [JadwalController::class, 'store'])->name('jadwal.store');
            // edit
            Route::get('edit/{nig}/{id_kelas}/{id_jadwal}', [JadwalController::class, 'edit'])->name('jadwal.edit');
            Route::put('update/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
            // delete
            Route::delete('delete/{id}', [JadwalController::class, 'delete'])->name('jadwal.delete');
        });

        // ABSENSI GERBANG
        Route::prefix('absensi-gerbang')->group(function(){
            Route::get('', [AbsensiGerbangController::class, 'index'])->name('absensigerbang');
            // INSERT DATA KEHADIRAN
            Route::post('store', [AbsensiGerbangController::class, 'store'])->name('absensigerbang.store');
            // SCANNER
            Route::get('scanner', [ScannerController::class, 'index'])->name('scanner');
            Route::post('scanner/siswa', [ScannerController::class, 'scannerSiswa'])->name('scanner.siswa');
        });


        //RIWAYAT KELAS
        Route::prefix('riwayat-kelas')->group(function(){
            Route::get('', [RiwayatKelasController::class, 'index'])->name('riwayatkelas');
            // histori per kelas
            Route::get('{id_kelas}', [RiwayatKelasController::class, 'riwayat'])->name('riwayatkelas.riwayat');
            // Update Status
            Route::put('{id_riwayat}/update', [RiwayatKelasController::class, 'updateStatus'])->name('riwayatkelas.updateStatus');
            // update Kelas
            Route::put('{id_kelas}/update/kelas', [RiwayatKelasController::class, 'updateKelas'])->name('riwayatkelas.updatekelas');
        });

        // ABSENSI KELAS
        Route::prefix('absensi-kelas')->group(function(){
            // detail absensi
            Route::get('detail/{id_kehadiran}', [AdminAbsensiKelasController::class, 'detail'])->name('absensikelas.absensiswa.detail');
            Route::get('', [AdminAbsensiKelasController::class, 'index'])->name('absensikelas.admin');
            // absensi_kelas
            Route::get('{id_kelas}', [AdminAbsensiKelasController::class, 'absensi'])->name('absensikelas.absensi.admin');
            Route::get('{id_kelas}/{id_user}', [AdminAbsensiKelasController::class, 'absensi_siswa'])->name('absensikelas.absensisiswa.admin');
        });
    });
});

// GURU
Route::middleware(['auth', 'role:Guru/Karyawan'])->group(function () {
    Route::prefix('guru')->group(function () {
        Route::get('', [GuruDashboardController::class, 'index'])->name('dashboard.guru');
        // absensi kelas
        Route::prefix('absensi-kelas')->group(function(){
            Route::get('', [AbsensiKelasController::class, 'index'])->name('absensikelas');
            // tambah absen
            Route::get('create/{id_kelas}/{id_jadwal}', [AbsensiKelasController::class, 'create'])->name('absensikelas.create');
            Route::post('store', [AbsensiKelasController::class, 'store'])->name('absensikelas.store');
        });
        // kelola karyawan/guru/walikelas

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
    Route::get('/', [SiswaDashboardController::class, 'index'])->name('dashboard.siswa');
    // my qr code
    Route::get('data-diri', [QrCodeController::class, 'index'])->name('qrcode.user');

});

// WALIKELAS
Route::middleware(['auth', 'role:Walikelas'])->group(function () {
    Route::prefix('walikelas')->group(function () {
        Route::get('', [WalikelasDashboardController::class, 'index'])->name('dashboard.walikelas');
    });
});
