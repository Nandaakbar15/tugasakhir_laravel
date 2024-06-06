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

Route::get('/datauser', 'App\Http\Controllers\Api\DataUserApiController@index');

// Route::post('/login', LoginController::class, ['login']);

Route::middleware('auth:sanctum')->group(function () {

});


