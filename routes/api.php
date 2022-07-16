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

Route::get('/report-house', [reportHouseController::class,'index']);
Route::post('/add-report-house', [reportHouseController::class,'store']);
Route::get('get-report-house/{id}',[reportHouseController::class,'show']);
Route::put('/update-report-House/{id}',[reportHouseController::class,'update']);
Route::get('/get-report-house-byuser/{id}/{state}',[reportHouseController::class,'getbyuser']);
Route::get('/get-report-house-byUSer-byHouse/{idUser}/{idHouse}/{state}',[reportHouseController::class,'getByUserByHouse']);


Route::get('/report-Hotel', [reportHotelController::class,'index']);
Route::post('/add-report-Hotel', [reportHotelController::class,'store']);
Route::get('get-report-hotel/{id}',[reportHotelController::class,'show']);
Route::put('/update-report-Hotel/{id}',[reportHotelController::class,'update']);
Route::get('/get-report-hotel-byUSer/{id}/{state}',[reportHotelController::class,'getReportByUser']);
Route::get('/get-report-byUser-byHotel/{idUser}/{idHotel}/{state}',[reportHotelController::class,'getByUserHotel']);

Route::get('/report-Touristic', [reportTouristicController::class,'index']);
Route::post('/add-report-Touristic', [reportTouristicController::class,'store']);
Route::get('get-report-Touristic/{id}',[reportTouristicController::class,'show']);
Route::put('/update-report-Touristic/{id}',[reportTouristicController::class,'update']);
Route::get('/get-report-touristic-byUser/{id}/{state}',[reportTouristicController::class,'getTouristicByUser']);
Route::get('/get-report-touristic-byUSer-byHouse/{idUser}/{idTouristic}/{state}',[reportTouristicController::class,'getByUserHotel']);
