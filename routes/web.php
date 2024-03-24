<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//jika belum login
Route::middleware(['guest'])->group(function () {
	Route::get('/',[AuthController::class, 'index']);
	Route::post('/',[AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
	Route::group(['middleware' => ['auth','checkRole:admin,kasir']], function(){
		Route::get('/logout',[AuthController::class, 'logout']);
		Route::get('/home',[HomeController::class, 'index']);
				
		//Setting Profile
		Route::get('/profile', [UserController::class, 'profile']);
		Route::post('/profile/updateprofile/{id}', [UserController::class, 'updateprofile']);

		//Transaksi
		Route::get('/transaksi', [TransaksiController::class, 'index']);
		Route::get('/transaksi/create', [TransaksiController::class, 'create']);
		Route::post('/transaksi/get_detail_barang', [TransaksiController::class, 'get_detail_barang']);
		Route::post('/transaksi/addToCart', [TransaksiController::class, 'addToCart']);
		Route::get('/transaksi/deleteCart/{id}', [TransaksiController::class, 'deleteCart']);
		Route::post('/transaksi/store', [TransaksiController::class, 'store']);
	});
	
	Route::group(['middleware' => ['auth','checkRole:admin']], function(){
		//crud data user
		Route::get('/user', [UserController::class, 'index']);
		Route::post('/user/store', [UserController::class, 'store']);
		Route::post('/user/update/{id}', [UserController::class, 'update']);
		Route::post('/user/destroy/{id}', [UserController::class, 'destroy']);

		//crud data jenis barang
		Route::get('/jenisbarang', [JenisBarangController::class, 'index']);
		Route::post('/jenisbarang/store', [JenisBarangController::class, 'store']);
		Route::post('/jenisbarang/update/{id}', [JenisBarangController::class, 'update']);
		Route::post('/jenisbarang/destroy/{id}', [JenisBarangController::class, 'destroy']);

		//crud data  barang
		Route::get('/barang', [BarangController::class, 'index']);
		Route::post('/barang/store', [BarangController::class, 'store']);
		Route::post('/barang/update/{id}', [BarangController::class, 'update']);
		Route::post('/barang/destroy/{id}', [BarangController::class, 'destroy']);

		//Setting Diskon
		Route::get('/setdiskon', [DiskonController::class, 'index']);
		Route::post('/setdiskon/update/{id}', [DiskonController::class, 'update']);
	});

});