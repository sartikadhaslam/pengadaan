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
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


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

     //Master User
     Route::get('/master-user', [App\Http\Controllers\UserController::class, 'index'])->name('masterbarang');
     Route::get('/master-user/add', 'App\Http\Controllers\UserController@add');
     Route::post('/master-user/store', 'App\Http\Controllers\UserController@store');
     Route::get('/master-user/edit/{id}', 'App\Http\Controllers\UserController@edit');
     Route::put('/master-user/update/{id}', 'App\Http\Controllers\UserController@update');
     Route::delete('/master-user/delete/{id}', 'App\Http\Controllers\UserController@delete');

    //Pemesanan
    Route::get('/pemesanan', [App\Http\Controllers\PemesananController::class, 'index'])->name('pemesanan');
    Route::get('/pemesanan/add', 'App\Http\Controllers\PemesananController@add');
    Route::post('/pemesanan/store', 'App\Http\Controllers\PemesananController@store');
    Route::get('/pemesanan/edit/{id}', 'App\Http\Controllers\PemesananController@add_detail');
    Route::post('/pemesanan/store/{id}', 'App\Http\Controllers\PemesananController@store_detail');
    Route::put('/pemesanan/update/{id}', 'App\Http\Controllers\PemesananController@update');
    Route::put('/pemesanan/update/status/{id}', 'App\Http\Controllers\PemesananController@update_status');
    Route::delete('/pemesanan/delete/{id}', 'App\Http\Controllers\PemesananController@delete');
    Route::delete('/pemesanan/detail/delete/{id}', 'App\Http\Controllers\PemesananController@delete_detail');
    
    // Pembelian
    Route::get('/pembelian', [App\Http\Controllers\PembelianController::class, 'index'])->name('pembelian');
    Route::get('/pembelian/add', 'App\Http\Controllers\PembelianController@add');
    Route::post('/pembelian/store', 'App\Http\Controllers\PembelianController@store');
    Route::get('/pembelian/edit/{id}', 'App\Http\Controllers\PembelianController@add_detail');
    Route::put('/pembelian/update/{id}', 'App\Http\Controllers\PembelianController@update');
    Route::put('/pembelian/update/status/{id}', 'App\Http\Controllers\PembelianController@update_status');
    Route::delete('/pembelian/delete/{id}', 'App\Http\Controllers\PembelianController@delete');
    Route::get('principle/request', [App\Http\Controllers\PembelianController::class, 'getDataPrinciple'])->name('principle.request');
    Route::post('/pemesanan_detail/store', 'App\Http\Controllers\PemesananController@storeDetail');
    Route::delete('/pemesanan_detail/delete/{id}', 'App\Http\Controllers\PemesananController@deleteDetail');
    Route::get('/pembelian/print/{id}', 'App\Http\Controllers\PembelianController@cetak_pdf');

    //Master Penerimaan
    Route::get('/penerimaan', [App\Http\Controllers\PenerimaanController::class, 'index'])->name('penerimaan');
    Route::get('/penerimaan/add', 'App\Http\Controllers\PenerimaanController@add');
    Route::post('/penerimaan/store', 'App\Http\Controllers\PenerimaanController@store');
    Route::get('/penerimaan/edit/{id}', 'App\Http\Controllers\PenerimaanController@add_detail');
    Route::put('/penerimaan/update/{id}', 'App\Http\Controllers\PenerimaanController@update');
    Route::put('/penerimaan/update/status/{id}', 'App\Http\Controllers\PenerimaanController@update_status');
    Route::delete('/penerimaan/delete/{id}', 'App\Http\Controllers\PenerimaanController@delete');

    //Master Pengiriman
    Route::get('/pengiriman', [App\Http\Controllers\PengirimanController::class, 'index'])->name('pengiriman');
    Route::get('/pengiriman/add', 'App\Http\Controllers\PengirimanController@add');
    Route::get('/pemesanan/request', [App\Http\Controllers\PengirimanController::class, 'getDataPemesanan'])->name('pemesanan.request');
    Route::post('/pengiriman/store', 'App\Http\Controllers\PengirimanController@store');
    Route::get('/pengiriman/edit/{id}', 'App\Http\Controllers\PengirimanController@add_detail');
    Route::put('/pengiriman/update/{id}', 'App\Http\Controllers\PengirimanController@update');
    Route::put('/pengiriman/update/status/{id}', 'App\Http\Controllers\PengirimanController@update_status');
    Route::delete('/pengiriman/delete/{id}', 'App\Http\Controllers\PengirimanController@delete');
    Route::get('/pembelian/sj/{id}', 'App\Http\Controllers\PengirimanController@cetak_sj');
    Route::get('/pembelian/in/{id}', 'App\Http\Controllers\PengirimanController@cetak_in');

    //Laporan Pemesanan
    Route::get('/laporan-pemesanan', 'App\Http\Controllers\HomeController@laporan_pemesanan');

    //Laporan Pengadaan
    Route::get('/laporan-pengadaan', 'App\Http\Controllers\HomeController@laporan_pengadaan');