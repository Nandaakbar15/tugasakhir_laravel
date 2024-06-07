<?php

use App\Http\Controllers\Api\DataUserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/testApi', function() {
    return response()->json([
        'message' => 'Hello World'
    ], 200);
});



// Route::post('/login', LoginController::class, ['login']);

Route::post('/login', 'App\Http\Controllers\Api\LoginApiController@login');

Route::middleware('auth:sanctum')->group(function () {

    // route API Admin/Teknisi
    Route::prefix('admin')->middleware('checkRole:admin')->group(function() {
        Route::get('/datauser', 'App\Http\Controllers\Api\DataUserApiController@index');
        Route::get('/datagame', 'App\Http\Controllers\Api\DataGameApiController@index');
        Route::get('/status_pembayaran', 'App\Http\Controllers\Api\StatusPembayaranApiController@index');
        Route::get('/status_servis', 'App\Http\Controllers\Api\StatusServisApiController@index');
        Route::put('/ubahstatus_servis/{antrian}', 'App\Http\Controllers\Api\StatusServisApiController@update'); // logika ubah status
        Route::post('/cariUser', 'App\Http\Controllers\Api\DataUserApiController@cariUser'); // filter cari data user
        Route::put('/ubahdata_pelanggan/{pelanggan}', 'App\Http\Controllers\PelangganController@update'); // ubah data pelanggan
        Route::delete('/hapusTeknisi', 'App\Http\Controllers\Api\TeknisiApiController@destroy'); // hapus data teknisi
        Route::post('/carigame', 'App\Http\Controllers\Api\DataGameApiController@cariGame'); // filter cari data game
        Route::post('/tambahgame', 'App\Http\Controllers\Api\DataGameApiController@store'); // logika tambah game
        Route::post('/ubahGame/update/{game_request}', 'App\Http\Controllers\DataGameApiController@update'); // logika ubah game
        Route::post('/ubahprofilToko/{profiltoko_request}', 'App\Http\Controllers\KelolaProfilTokoController@updateprofiltoko'); // ubah profil toko
        Route::get('/datalaporanservis', 'App\Http\Controllers\TeknisiController@datalaporan_servis');
        Route::get('/dataTeknisi', 'App\Http\Controller\Api\TeknisiApiController@index');
        Route::post('/cariLaporan', 'App\Http\Controllers\Api\TeknisiApiController@cari_laporan'); // cari laporan servis berdasarkan tanggalnya
        Route::post('/tambahTeknisi', 'App\Http\Controllers\Api\TeknisiApiController@store'); // logika tambah teknisi
        Route::put('/ubah_teknisi/{teknisi}', 'App\Http\Controllers\Api\TeknisiApiController@update'); // logika ubah teknisi
    });

    // route API Pelanggan
    Route::prefix('pelanggan')->group(function() {
        Route::get('/', 'App\Http\Controllers\Api\PelangganApiController@index');
        Route::post('/isidata', 'App\Http\Controllers\Api\PelangganApiController@store');
        Route::get('/status_servis', 'App\Http\Controllers\Api\PelangganApiController@statusservis');
    });
});









