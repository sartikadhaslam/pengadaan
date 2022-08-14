<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('/home');
    });

    //Master Barang
    Route::get('/master-barang', [App\Http\Controllers\MasterBarangController::class, 'index'])->name('masterbarang');
    Route::get('/master-barang/add', 'App\Http\Controllers\MasterBarangController@add');
    Route::post('/master-barang/store', 'App\Http\Controllers\MasterBarangController@store');
    Route::get('/master-barang/edit/{id}', 'App\Http\Controllers\MasterBarangController@edit');
    Route::put('/master-barang/update/{id}', 'App\Http\Controllers\MasterBarangController@update');
    Route::delete('/master-barang/delete/{id}', 'App\Http\Controllers\MasterBarangController@delete');

    //Master Customer
    Route::get('/master-customer', [App\Http\Controllers\MasterCustomerController::class, 'index'])->name('mastercustomer');
    Route::get('/master-customer/add', 'App\Http\Controllers\MasterCustomerController@add');
    Route::post('/master-customer/store', 'App\Http\Controllers\MasterCustomerController@store');
    Route::get('/master-customer/edit/{id}', 'App\Http\Controllers\MasterCustomerController@edit');
    Route::put('/master-customer/update/{id}', 'App\Http\Controllers\MasterCustomerController@update');
    Route::delete('/master-customer/delete/{id}', 'App\Http\Controllers\MasterCustomerController@delete');

    //Master Principle
    Route::get('/master-principle', [App\Http\Controllers\MasterPrincipleController::class, 'index'])->name('masterprinciple');
    Route::get('/master-principle/add', 'App\Http\Controllers\MasterPrincipleController@add');
    Route::post('/master-principle/store', 'App\Http\Controllers\MasterPrincipleController@store');
    Route::get('/master-principle/edit/{id}', 'App\Http\Controllers\MasterPrincipleController@edit');
    Route::put('/master-principle/update/{id}', 'App\Http\Controllers\MasterPrincipleController@update');
    Route::delete('/master-principle/delete/{id}', 'App\Http\Controllers\MasterPrincipleController@delete');

    //Master Pemesanan
    Route::get('/pemesanan', [App\Http\Controllers\PemesananController::class, 'index'])->name('pemesanan');
    Route::get('/pemesanan/add', 'App\Http\Controllers\PemesananController@add');
    Route::post('/pemesanan/store', 'App\Http\Controllers\PemesananController@store');
    Route::get('/pemesanan/edit/{id}', 'App\Http\Controllers\PemesananController@edit');
    Route::put('/pemesanan/update/{id}', 'App\Http\Controllers\PemesananController@update');
    Route::delete('/pemesanan/delete/{id}', 'App\Http\Controllers\PemesananController@delete');

    Route::post('/pemesanan_detail/store', 'App\Http\Controllers\PemesananController@storeDetail');
    Route::delete('/pemesanan_detail/delete/{id}', 'App\Http\Controllers\PemesananController@deleteDetail');

    //Master Pembelian
    Route::get('/pembelian', [App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian');
    Route::get('/pembelian/add', 'App\Http\Controllers\PembelianController@add');
    Route::post('/pembelian/store', 'App\Http\Controllers\PembelianController@store');
    Route::get('/pembelian/edit/{id}', 'App\Http\Controllers\PembelianController@edit');
    Route::put('/pembelian/update/{id}', 'App\Http\Controllers\PembelianController@update');
    Route::delete('/pembelian/delete/{id}', 'App\Http\Controllers\PembelianController@delete');

    //Master Penerimaan
    Route::get('/Penerimaan', [App\Http\Controllers\PenerimaanController::class, 'index'])->name('penerimaan');
    Route::get('/Penerimaan/add', 'App\Http\Controllers\PenerimaanController@add');
    Route::post('/Penerimaan/store', 'App\Http\Controllers\PenerimaanController@store');
    Route::get('/Penerimaan/edit/{id}', 'App\Http\Controllers\PenerimaanController@edit');
    Route::put('/Penerimaan/update/{id}', 'App\Http\Controllers\PenerimaanController@update');
    Route::delete('/Penerimaan/delete/{id}', 'App\Http\Controllers\PenerimaanController@delete');

    //Master Pengiriman
    Route::get('/pengiriman', [App\Http\Controllers\PengirimanController::class, 'index'])->name('pengiriman');
    Route::get('/pengiriman/add', 'App\Http\Controllers\PengirimanController@add');
    Route::post('/pengiriman/store', 'App\Http\Controllers\PengirimanController@store');
    Route::get('/pengiriman/edit/{id}', 'App\Http\Controllers\PengirimanController@edit');
    Route::put('/pengiriman/update/{id}', 'App\Http\Controllers\PengirimanController@update');
    Route::delete('/pengiriman/delete/{id}', 'App\Http\Controllers\PengirimanController@delete');
});