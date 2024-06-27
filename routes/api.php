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
Route::post('/register', 'App\Http\Controllers\Api\RegisterApiController@register');



// route api admin
Route::group(['prefix' => 'admin'], function() {
    Route::get('/datagame', 'App\Http\Controllers\Api\DataGameApiController@index');
    Route::get('/getOneGame/{game_request}', 'App\Http\Controllers\Api\DataGameApiController@show');
    Route::get('/datauser', 'App\Http\Controllers\Api\DataUserApiController@index');
    Route::get('/dataprofilToko', 'App\Http\Controllers\Api\TeknisiApiController@profilToko');
    Route::get('/status_pembayaran', 'App\Http\Controllers\Api\StatusPembayaranApiController@index');
    Route::get('/status_servis', 'App\Http\Controllers\Api\StatusServisApiController@index');
    Route::put('/updatestatus/{antrian}', 'App\Http\Controllers\Api\StatusServisApiController@update'); // logika ubah status
    Route::post('/findUser', 'App\Http\Controllers\Api\DataUserApiController@cariUser'); // filter cari data user
    Route::put('/updatePelanggan/{pelanggan}', 'App\Http\Controllers\Api\PelangganApiController@update'); // ubah data pelanggan
    Route::delete('/hapusTeknisi', 'App\Http\Controllers\Api\TeknisiApiController@destroy'); // hapus data teknisi
    Route::post('/findGame', 'App\Http\Controllers\Api\DataGameApiController@cariGame'); // filter cari data game
    Route::post('/addGame', 'App\Http\Controllers\Api\DataGameApiController@store'); // logika tambah game
    Route::post('/update/{game_request}', 'App\Http\Controllers\DataGameApiController@update'); // logika ubah game
    Route::post('/editprofilToko/{profiltoko_request}', 'App\Http\Controllers\Api\TeknisiApiController@editprofiltoko'); // ubah profil toko
    Route::get('/datalaporanservis', 'App\Http\Controllers\Api\TeknisiApiController@datalaporan_servis');
    Route::get('/dataTeknisi', 'App\Http\Controllers\Api\TeknisiApiController@index');
    Route::post('/findReport', 'App\Http\Controllers\Api\TeknisiApiController@cari_laporan_servis'); // cari laporan servis berdasarkan tanggalnya
    Route::post('/tambahTeknisi', 'App\Http\Controllers\Api\TeknisiApiController@store'); // logika tambah teknisi
    Route::put('/updateTeknisi/{teknisi}', 'App\Http\Controllers\Api\TeknisiApiController@update'); // logika ubah teknisi
});

// route API Pelanggan
Route::group(['prefix' => 'pelanggan'], function() {
    Route::get('/dataPelanggan', 'App\Http\Controllers\Api\PelangganApiController@index');
    Route::post('/isidata', 'App\Http\Controllers\Api\PelangganApiController@store');
    Route::get('/status_servis', 'App\Http\Controllers\Api\PelangganApiController@statusservis');
    Route::get('/profilToko', 'App\Http\Controllers\Api\PelangganApiController@profil_toko');
});










