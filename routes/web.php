<?php

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustromerController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DashboardController;

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
    return view('pages.login');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('daftar-barang', [BarangController::class, 'index']);
    Route::get('tambah-barang', [BarangController::class, 'create']);
    Route::post('post-barang', [BarangController::class, 'store']);
    Route::get('detail-barang/{barang}', [BarangController::class, 'show']);
    Route::get('edit-barang/{barang}', [BarangController::class, 'edit']);
    Route::post('update-barang/{barang}', [BarangController::class, 'update']);
    Route::get('delete-barang/{barang}', [BarangController::class, 'destroy']);

    Route::get('daftar-barang-masuk', [BarangMasukController::class, 'index']);
    Route::get('tambah-barang-masuk', [BarangMasukController::class, 'create']);
    Route::post('post-barang-masuk', [BarangMasukController::class, 'store']);
    Route::get('detail-barang-masuk/{barangMasuk}', [BarangMasukController::class, 'show']);
    Route::get('edit-barang-masuk/{barangMasuk}', [BarangMasukController::class, 'edit']);
    Route::post('update-barang-masuk/{barangMasuk}', [BarangMasukController::class, 'update']);
    Route::get('delete-barang-masuk/{barangMasuk}', [BarangMasukController::class, 'destroy']);

    Route::get('daftar-barang-keluar', [BarangKeluarController::class, 'index']);
    Route::get('tambah-barang-keluar', [BarangKeluarController::class, 'create']);
    Route::post('post-barang-keluar', [BarangKeluarController::class, 'store']);
    Route::get('edit-barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'edit']);
    Route::post('update-barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'update']);
    Route::get('delete-barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'destroy']);

    Route::get('/daftar-kategori', [KategoriController::class, 'index']);
    Route::get('/tambah-kategori', [KategoriController::class, 'create']);
    Route::post('post-kategori', [KategoriController::class, 'store']);
    Route::get('edit-kategori/{kategori}', [KategoriController::class, 'edit']);
    Route::post('update-kategori/{kategori}', [KategoriController::class, 'update']);
    Route::get('delete-kategori/{kategori}', [KategoriController::class, 'destroy']);

    Route::get('/daftar-supplier', [SupplierController::class, 'index']);
    Route::get('/tambah-supplier', [SupplierController::class, 'create']);
    Route::post('post-supplier', [SupplierController::class, 'store']);
    Route::get('edit-supplier/{supplier}', [SupplierController::class, 'edit']);
    Route::post('update-supplier/{supplier}', [SupplierController::class, 'update']);
    Route::get('delete-supplier/{supplier}', [SupplierController::class, 'destroy']);

    Route::get('tambah-customer', [CustromerController::class, 'create']);
    Route::post('post-customer', [CustromerController::class, 'store']);

    Route::get('buat-cart', [CartController::class, 'index']);
    Route::get('tambah-cart', [CartController::class, 'cart']);
    Route::get('update-cart/{id}/{customerid}', [CartController::class, 'updateItem']);
    Route::get('pilih-barang/{id}/{customerid}', [CartController::class, 'addItem']);
    Route::get('delete-barang/{id}/{customerid}', [CartController::class, 'deleteItem']);

    Route::post('post-checkout/{customerid}', [CartController::class, 'checkOut']);


    Route::get('transaksi-berlangsung', [TransaksiController::class, 'transaksiBerlangsung']);
    Route::get('transaksi-approved/{invoice}', [TransaksiController::class, 'paidTransaksi']);
    Route::get('transaksi-detail/{invoice}', [TransaksiController::class, 'detailTransaksi']);
    Route::get('transaksi-berhasil', [TransaksiController::class, 'transaksiBerhasil']);
    Route::get('transaksi-cancel/{invoice}', [TransaksiController::class, 'unpaidTransaksi']);
    Route::get('transaksi/{id}', [CartController::class, 'addTransaksi']);

    Route::get('daftar-user', [UserController::class, 'index']);
    Route::get('tambah-user', [UserController::class, 'create']);
    Route::post('post-user', [UserController::class, 'store']);
    Route::get('edit-user/{user}', [UserController::class, 'edit']);
    Route::post('update-user/{user}', [UserController::class, 'update']);
    Route::get('delete-user/{user}', [UserController::class, 'destroy']);
    Route::get('reset-password/{user}', [UserController::class, 'destroy']);

    Route::get('report', [DashboardController::class, 'report']);
    Route::post('post-report', [DashboardController::class, 'report']);
});

// Route::get('transaksi', [TransaksiController::class, 'index']);
// Route::get('pilih-barang/{id}/{customerid}', [CartController::class ,'addItem']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
