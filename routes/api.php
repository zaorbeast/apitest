<?php

use App\Models\reportHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\reportHotelController;
use App\Http\Controllers\reportHouseController;
use App\Http\Controllers\reportTouristicController;
use Database\Factories\reportTouristicFactory;

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
Route::get('/reportHouse', [reportHouseController::class,'index']);
Route::post('/addreportHouse', [reportHouseController::class,'store']);
Route::get('getreporthose/{id}',[reportHouseController::class,'show']);
Route::put('/updatereportHouse/{id}',[reportHouseController::class,'update']);

Route::get('/reportHotel', [reportHotelController::class,'index']);
Route::post('/addreportHotel', [reportHotelController::class,'store']);
Route::get('getreporthotel/{id}',[reportHotelController::class,'show']);
Route::put('/updatereportHotel/{id}',[reportHotelController::class,'update']);

Route::get('/reportTouristic', [reportTouristicController::class,'index']);
Route::post('/addreportTouristic', [reportTouristicController::class,'store']);
Route::get('getreportTouristic/{id}',[reportTouristicController::class,'show']);
Route::put('/updatereportTouristic/{id}',[reportTouristicController::class,'update']);