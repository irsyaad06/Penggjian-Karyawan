<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SlipGajiController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\LaporanGajiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ini adalah tempat untuk mendaftarkan rute aplikasi web. Semua rute ini 
| akan dimuat oleh RouteServiceProvider dan ditetapkan ke grup "web".
|
*/

// Route Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Resource Routes
Route::resource('hak-akses', HakAksesController::class);
Route::resource('pengguna', PenggunaController::class);
Route::resource('jabatan', JabatanController::class);
Route::resource('karyawan', KaryawanController::class);
Route::resource('slip-gaji', SlipGajiController::class);
Route::resource('potongan', PotonganController::class);
Route::resource('laporan-gaji', LaporanGajiController::class);
