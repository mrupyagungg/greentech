<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LaporanPresensi;
use App\Http\Controllers\LaporanPembelian;

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
Route::get('/dashboard-data', [DashboardController::class, 'getData']);
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

// Route untuk master data barang
Route::get('/barang', 'BarangController@index')->name('barang.index');
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/destroy/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::post('/barang/create', [BarangController::class, 'store']);
Route::delete('/barang/{id}', 'BarangController@destroy')->name('barang.destroy');

// untuk transaksi penjualan
Route::get('penjualan/barang/{id}', [App\Http\Controllers\PenjualanController::class,'getDataBarang'])->middleware(['auth']);
Route::get('penjualan/keranjang', [App\Http\Controllers\PenjualanController::class,'keranjang'])->middleware(['auth']);
Route::get('penjualan/destroypenjualandetail/{id}', [App\Http\Controllers\PenjualanController::class,'destroypenjualandetail'])->middleware(['auth']);
Route::get('penjualan/barang', [App\Http\Controllers\PenjualanController::class,'getDataBarangAll'])->middleware(['auth']);
Route::get('penjualan/jmlbarang', [App\Http\Controllers\PenjualanController::class,'getJumlahBarang'])->middleware(['auth']);
Route::get('penjualan/keranjangjson', [App\Http\Controllers\PenjualanController::class,'keranjangjson'])->middleware(['auth']);
Route::get('penjualan/checkout', [App\Http\Controllers\PenjualanController::class,'checkout'])->middleware(['auth']);
Route::get('penjualan/invoice', [App\Http\Controllers\PenjualanController::class,'invoice'])->middleware(['auth']);
Route::get('penjualan/jmlinvoice', [App\Http\Controllers\PenjualanController::class,'getInvoice'])->middleware(['auth']);
Route::get('penjualan/status', [App\Http\Controllers\PenjualanController::class,'viewstatus'])->middleware(['auth']);
Route::resource('penjualan', PenjualanController::class)->middleware(['auth']);

// transaksi pembayaran viewkeranjang
Route::get('pembayaran/viewkeranjang', [App\Http\Controllers\PembayaranController::class,'viewkeranjang'])->middleware(['auth']);
Route::get('pembayaran/viewstatus', [App\Http\Controllers\PembayaranController::class,'viewstatus'])->middleware(['auth']); 
Route::get('pembayaran/viewapprovalstatus', [App\Http\Controllers\PembayaranController::class,'viewapprovalstatus'])->middleware(['auth']);
Route::get('pembayaran/approve/{no_transaksi}', [App\Http\Controllers\PembayaranController::class,'approve'])->middleware(['auth']);
Route::get('pembayaran/unapprove/{no_transaksi}', [App\Http\Controllers\PembayaranController::class,'unapprove'])->middleware(['auth']);
Route::get('pembayaran/viewstatusPG', [App\Http\Controllers\PembayaranController::class,'viewstatusPG'])->middleware(['auth']);
Route::resource('pembayaran', PembayaranController::class)->middleware(['auth']);


Route::get('/artikel',[ArticleController::class,'index'])->name('artikel.index');
Route::post('/artikel',[ArticleController::class,'store'])->name('artikel.store');

// presensi
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
Route::get('/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
Route::get('/presensi/{presensi}', [PresensiController::class, 'show'])->name('presensi.show');
Route::get('/presensi/{presensi}/edit', [PresensiController::class, 'edit'])->name('presensi.edit');
Route::put('/presensi/{presensi}', [PresensiController::class, 'update'])->name('presensi.update');
Route::delete('/presensi/{presensi}', [PresensiController::class, 'destroy'])->name('presensi.destroy');
Route::resource('presensi', PresensiController::class);

// supplier
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');

// retur
Route::get('/retur', [ReturController::class, 'index'])->name('retur.index');
Route::get('/retur/create', [ReturController::class, 'create'])->name('retur.create');
Route::post('/retur', [ReturController::class, 'store'])->name('retur.store');
Route::delete('/retur/{retur}', [ReturController::class, 'destroy'])->name('retur.destroy');
Route::get('/retur/{retur}/edit', [ReturController::class, 'edit'])->name('retur.edit');
Route::put('/retur/{retur}', [ReturController::class, 'update'])->name('retur.update');


// pembelian
Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
Route::delete('/pembelians/{pembelian}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');
Route::get('/pembelians/{pembelian}/edit', [PembelianController::class, 'edit'])->name('pembelian.edit');


// laporanpresensi
Route::get('laporan/laporanbulanan', [LaporanPresensi::class, 'laporanbulanan'])->name('laporanbulanan');
Route::get('/laporan/bulanan/{periode}', [LaporanPresensi::class, 'viewlaporanbulanan'])->name('laporan.laporanbulanan');

// laporan pembelian
Route::get('/laporan/laporanpembelian', [LaporanPembelian::class, 'laporanpembelian'])->name('laporanpembelian');
Route::get('/laporan/pembelian/{periode}', [LaporanPembelian::class, 'viewlaporanpembelian'])->name('laporan.laporanpembelian');
require __DIR__.'/auth.php';
