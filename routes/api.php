<?php

use App\Http\Controllers\API\MerchantController;
use App\Http\Controllers\API\ObatController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\PartnerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('obat', [ObatController::class, 'ShowObat']);
Route::get('obat/{id}', [ObatController::class, 'DetailObat']);
Route::post('addobat', [ObatController::class, 'AddObat']);
Route::put('updateobat/{id}', [ObatController::class, 'UpdateObat']);
Route::delete('deleteobat/{id}', [ObatController::class, 'DeleteObat']);

Route::get('merchantdetail', [MerchantController::class, 'index']);
Route::get('services', [EkspedisiController::class, 'services']);
Route::get('kota', [EkspedisiController::class, 'kota']);

Route::get('detailtransaction', [PartnerController::class, 'transaction']);
Route::get('detailpengiriman', [PartnerController::class, 'pengiriman']);

