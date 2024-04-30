<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StatusServisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    return "hallooooo!";
});

// routes login dan register
Route::get('/login', 'App\Http\Controllers\LoginController@login')->name('login'); // view login
Route::post('/login', 'App\Http\Controllers\LoginController@cekLogin'); // validasi login
Route::get('/logout', 'App\Http\Controllers\LoginController@logout'); // logout
Route::get('/register', 'App\Http\Controllers\RegisterController@register'); // view register
Route::post('/register', 'App\Http\Controllers\RegisterController@cekRegister'); // cek register

// // verifikasi email
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/login'); // Redirect to the dashboard after successful verification
// })->middleware(['auth', 'signed'])->name('verification.verify');


// routes pelanggan
Route::prefix('pelanggan')->group(function() {
    Route::get('/dashboardpelanggan', 'App\Http\Controllers\PelangganController@index')->middleware('auth'); // view dashboard pelanggan
    Route::get('/profilToko', 'App\Http\Controllers\PelangganController@profiltoko')->middleware('auth'); // view profil toko
    Route::get('/statusservis', 'App\Http\Controllers\PelangganController@statusservis')->middleware('auth'); // melihat statsus servis di dashboard pelanggan
    Route::get('/servis', 'App\Http\Controllers\PelangganController@create')->middleware('auth'); // view untuk servis
    Route::post('/isidata', 'App\Http\Controllers\PelangganController@store')->middleware('auth'); // logika untuk mengisi data
    Route::get('/daftargame', 'App\Http\Controllers\DaftarGameController@daftar_game'); // view daftar game
    Route::post('/tambahGame', 'App\Http\Controllers\DaftarGameController@tambah_game'); // logika tambah game
    Route::get('/pembayaran', 'App\Http\Controllers\PembayaranController@viewpembayaran');
    Route::get('/checkout', 'App\Http\Controllers\PembayaranController@showCheckout')->name('checkout');
    Route::post('/bayar', 'App\Http\Controllers\PembayaranController@bayar');
});


// routes admin/teknisi
Route::middleware(['web','auth', 'checkRole:admin'])->group(function() {
    Route::get('/dashboard', 'App\Http\Controllers\TeknisiController@index'); // dashboard admin / teknisi
    Route::get('/status_pembayaran', 'App\Http\Controllers\StatusPembayaranController@viewstatuspembayaran'); // view status pembayaran
    Route::get('/status_servis', 'App\Http\Controllers\StatusServisController@index'); // view status servis
    Route::get('/ubahstatus_servis/{antrian}', 'App\Http\Controllers\StatusServisController@edit'); // view ubah status
    Route::put('/ubahstatus_servis/{antrian}', 'App\Http\Controllers\StatusServisController@update'); // logika ubah status
    Route::get('/datauser', 'App\Http\Controllers\DataUserController@index'); // view data user
    Route::get('/ubahdata_pelanggan/{pelanggan}', 'App\Http\Controllers\PelangganController@edit'); // view ubah data pelanggan
    Route::put('/ubahdata_pelanggan/{pelanggan}', 'App\Http\Controllers\PelangganController@update'); // ubah data pelanggan
    Route::delete('/hapusPelanggan', 'App\Http\Controllers\PelangganController@destroy'); // hapus data pelanggan
    Route::delete('/hapusTeknisi', 'App\Http\Controllers\TeknisiController@destroy'); // hapus data teknisi
    Route::get('/datagame', 'App\Http\Controllers\GameRequestController@index'); // view data game
    Route::post('/carigame', 'App\Http\Controllers\GameRequestController@cariGame'); // filter cari data game
    Route::get('/tambahgame', 'App\Http\Controllers\GameRequestController@create'); // view tambah data game
    Route::post('/tambahgame', 'App\Http\Controllers\GameRequestController@store'); // logika tambah game
    Route::get('/ubahGame/{game_request}', 'App\Http\Controllers\GameRequestController@edit'); // view ubah game
    Route::post('/ubahGame/update/{game_request}', 'App\Http\Controllers\GameRequestController@update'); // logika ubah game
    Route::get('/kelolaprofiltoko', 'App\Http\Controllers\KelolaProfilTokoController@kelolaprofil_toko'); // view kelola profil toko
    Route::get('/ubahprofilToko/{profiltoko_request}', 'App\Http\Controllers\KelolaProfilTokoController@editprofil_toko'); // view ubah profil toko
    Route::post('/ubahprofilToko/{profiltoko_request}', 'App\Http\Controllers\KelolaProfilTokoController@updateprofiltoko'); // ubah profil toko
    Route::get('/datalaporanservis', 'App\Http\Controllers\TeknisiController@datalaporan_servis'); // view data laporan servis
    Route::post('/cariLaporan', 'App\Http\Controllers\TeknisiController@cari_laporan'); // cari laporan servis berdasarkan tanggalnya
    Route::get('/tambahTeknisi', 'App\Http\Controllers\TeknisiController@create'); // view tambah teknisi
    Route::post('/tambahTeknisi', 'App\Http\Controllers\TeknisiController@store'); // logika tambah teknisi
    Route::get('/ubah_teknisi/{teknisi}', 'App\Http\Controllers\TeknisiController@edit'); // view ubah teknisi
    Route::put('/ubah_teknisi/{teknisi}', 'App\Http\Controllers\TeknisiController@update'); // logika ubah teknisi
    Route::get('/kirim-pesan', 'App\Http\Controllers\WhatsAppController@sendMessage'); // kirim pemberitahuan kepada pelanggan proses servis
    Route::get('/pesanselesai', 'App\Http\Controllers\WhatsAppController@pesanselesai'); // kirim pemberitahuan kepada pelanggan servis selesai
    Route::get('/exportexcel', 'App\Http\Controllers\TeknisiController@exportExcel'); // export excel
    Route::get('/exportpdf', 'App\Http\Controllers\TeknisiController@exportpdf'); // export pdf
});

