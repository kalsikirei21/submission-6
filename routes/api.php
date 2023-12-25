<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Pengunjung\PengunjungController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'create']);
Route::post('login', [AuthController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::group(['prefix' => 'pegawai'], function () {
        Route::get('get-data',  [PegawaiController::class, 'getDataPegawai']);
        Route::post('save-data',  [PegawaiController::class, 'saveDataPegawai']);
        Route::delete('delete-data',  [PegawaiController::class, 'deleteDataPegawai']);
    });

    Route::group(['prefix' => 'pengunjung'], function () {
        Route::get('get-data',  [PengunjungController::class, 'getPengunjung']);
        Route::post('save-data',  [PengunjungController::class, 'savePengunjung']);
        Route::delete('delete-data',  [PengunjungController::class, 'deletePengunjung']);
    });
});

Route::group(['prefix' => 'users'], function () {
    Route::get('get-data',  [UserController::class, 'getDataUser']);
    Route::post('create-data', [UserController::class, 'createDataUser']);
    Route::put('update-data', [UserController::class, 'updateDataUser']);
    Route::delete('delete-data', [UserController::class, 'deleteDataUser']);
});
