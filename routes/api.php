<?php

use App\Models\provinsi;
use App\Models\kasuses;
use App\Models\kota;
use App\Models\kecamatan;
use App\Models\kelurahan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\Api\ApiController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ROUTE ProvinsiController
// Route::get('provinsi',[ProvinsiController::class, 'index']);
// Route::post('provinsi',[ProvinsiController::class, 'store']);
// Route::get('provinsi/{id?}',[ProvinsiController::class, 'show']);
// Route::delete('provinsi/{id?}',[ProvinsiController::class, 'destroy']);


//ROUTE ApiController
Route::get('indonesia',[ApiController::class, 'indo']);
Route::get('kota',[ApiController::class, 'kota']);
Route::get('kota/{id?}',[ApiController::class, 'kota']);
Route::get('kecamatan',[ApiController::class, 'kecamatan']);
Route::get('kecamatan/{id?}',[ApiController::class, 'kecamatan']);
Route::get('kelurahan',[ApiController::class, 'kelurahan']);
Route::get('kelurahan/{id?}',[ApiController::class, 'kelurahan']);
Route::get('provinsi',[ApiController::class, 'index']);
Route::get('provinsi/{id?}',[ApiController::class, 'provinsi']);
Route::get('global',[ApiController::class, 'global']);
