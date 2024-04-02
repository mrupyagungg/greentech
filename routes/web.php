<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;


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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/regist', function () {
    return view('regist');
});

// Route ke master data perusahaan
Route::resource('/pegawai', PegawaiController::class)->middleware(['auth']);
Route::get('/pegawai/destroy/{id}', [PegawaiController::class, 'destroy'])->middleware(['auth']);

Route::get('/team', function () {
    return view('team');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// route untuk validasi login
Route::post('/validasi_login', [App\Http\Controllers\LoginController::class, 'show']);

// masterdata pegawai
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'show'])->name('pegawai.show');

// edit pegawai
Route::get('/pegawai/{id}/edit', 'PegawaiController@edit')->name('pegawai.edit');
Route::get('/pegawai/{pegawai}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');

Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
Route::delete('/pegawai/{pegawaiModel}', 'PegawaiController@destroy')->name('pegawai.destroy');
Route::get('pegawai/destroy/{id}', [App\Http\Controllers\PegawaiController::class,'destroy'])->middleware(['auth']);
// Route untuk menghapus data pegawai
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
Route::delete('/pegawai/destroy/{id}', 'PegawaiController@destroy')->name('pegawai.destroy');

// route ke master data pelanggan
// Rute untuk sumber daya pelanggan dengan Route::resource()
Route::resource('/pelanggan', PelangganController::class)->middleware(['auth']);

// Rute tambahan yang tidak tercakup dalam Route::resource()
Route::get('/pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->middleware(['auth']);

// Rute untuk menghapus data pelanggan
Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

// masterdata pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan', 'PelangganController@store')->name('Pelanggan.store');
Route::get('/pelanggan/{pelanggan}', [PelangganController::class, 'show'])->name('pelanggan.show');

// edit pelanggan
Route::get('/pelanggan/{id}/edit', 'PelangganController@edit')->name('pelanggan.edit');
Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');

Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
Route::delete('/pelanggan/destroy/{id}', 'PelangganController@destroy')->name('pelanggan.destroy');
Route::delete('/pelanggan/{pelangganModel}', 'PelangganController@destroy')->name('pelanggan.destroy');
Route::get('pelanggan/destroy/{id}', [App\Http\Controllers\PelangganController::class,'destroy'])->middleware(['auth']);
// Route untuk menghapus data pelanggan
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');



Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');

require __DIR__.'/auth.php';
