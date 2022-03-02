<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\KontrolController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggunaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    
//     return view('halaman_utama');
// });

Route::get('ytbs1/{tegangan}/{arus}/{dy_aktif}/{energi}', [SensorController::class, 'masuk']);
Route::get('/', [DashboardController::class, 'energi']);
Route::get('/arus', [DashboardController::class, 'arus']);
Route::get('/daya', [DashboardController::class, 'daya']);
Route::get('/semua', [LaporanController::class, 'semua']);
Route::post('/filter_laporan', [LaporanController::class, 'saring']);
Route::post('/pdf', [LaporanController::class, 'unduh']);
Route::get('/tegangan', [DashboardController::class, 'index']);
Route::get('/chart_teg', [ChartController::class, 'tegangan'])->name('chart_teg');
Route::get('/chart_arus', [ChartController::class, 'arus'])->name('chart_arus');
Route::get('/chart_daya', [ChartController::class, 'daya'])->name('chart_daya');
Route::get('/chart_energi', [ChartController::class, 'energi'])->name('chart_energi');
Route::get('/device', [KontrolController::class, 'kontrol'])->name('device');

//projek yutub 2
    Route::get('/kelola_pengguna', [PenggunaController::class, 'halamanPengguna']);
	Route::get('/tambah_pengguna', [PenggunaController::class, 'tambahPengguna']);
	Route::post('/simpan_pengguna', [PenggunaController::class, 'simpanPengguna']);
	Route::get('/lihat_pengguna/{id}', [PenggunaController::class, 'lihatPengguna']);
	Route::get('/edit_pengguna/{id}', [PenggunaController::class, 'editPengguna']);
	Route::post('/update_pengguna/{id}', [PenggunaController::class,'updatePengguna']);
	Route::get('/hapus_pengguna/{id}', [PenggunaController::class, 'hapusPengguna']);