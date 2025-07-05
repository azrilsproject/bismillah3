<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;


//  Route yang dapat diakses jika user belum login
Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login');
    
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

//  Route yang dapat diakses jika user sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    //  Route yang dapat diakses jika user sudah login dan Role = Admin Logistik atau Staff Logistik
    Route::middleware('role:Admin Logistik,Staff Logistik,Manajer Logistik')->group(function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('/barang/tambah', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/barang/detail/{id}', [BarangController::class, 'show'])->name('barang.show');
        Route::get('/barang/ubah/{id}', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    
        Route::get('/jenis', [JenisController::class, 'index'])->name('jenis.index');
        Route::get('/jenis/tambah', [JenisController::class, 'create'])->name('jenis.create');
        Route::post('/jenis', [JenisController::class, 'store'])->name('jenis.store');
        Route::get('/jenis/ubah/{id}', [JenisController::class, 'edit'])->name('jenis.edit');
        Route::put('/jenis/{id}', [JenisController::class, 'update'])->name('jenis.update');
        Route::delete('/jenis/{id}', [JenisController::class, 'destroy'])->name('jenis.destroy');

        Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
        Route::get('/satuan/tambah', [SatuanController::class, 'create'])->name('satuan.create');
        Route::post('/satuan', [SatuanController::class, 'store'])->name('satuan.store');
        Route::get('/satuan/ubah/{id}', [SatuanController::class, 'edit'])->name('satuan.edit');
        Route::put('/satuan/{id}', [SatuanController::class, 'update'])->name('satuan.update');
        Route::delete('/satuan/{id}', [SatuanController::class, 'destroy'])->name('satuan.destroy');
        
        Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
        Route::get('/barang-masuk/tambah', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
        Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
        Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');
        
        Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
        Route::get('/barang-keluar/tambah', [BarangKeluarController::class, 'create'])->name('barang-keluar.create');
        Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
        Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.destroy');
    });

    Route::get('/laporan-stok/filter', [LaporanStokController::class, 'filter'])->name('laporan-stok.filter');
    Route::get('/laporan-stok/print/{stok}', [LaporanStokController::class, 'print'])->name('laporan-stok.print');

    Route::get('/laporan-barang-masuk/filter', [LaporanBarangMasukController::class, 'filter'])->name('laporan-barang-masuk.filter');
    Route::get('/laporan-barang-masuk/print/{tgl_awal}/{tgl_akhir}', [LaporanBarangMasukController::class, 'print'])->name('laporan-barang-masuk.print');
    
    Route::get('/laporan-barang-keluar/filter', [LaporanBarangKeluarController::class, 'filter'])->name('laporan-barang-keluar.filter');
    Route::get('/laporan-barang-keluar/print/{tgl_awal}/{tgl_akhir}', [LaporanBarangKeluarController::class, 'print'])->name('laporan-barang-keluar.print');

    //  Route yang dapat diakses jika user sudah login dan Role = Admin Logistik
    Route::middleware('role:Admin Logistik')->group(function () {        
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/tambah', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/ubah/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    
    Route::view('/tentang', 'tentang.index')->name('tentang');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
