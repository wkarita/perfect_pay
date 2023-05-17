<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CepController;

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

Route::get('clients', [ClientController::class, 'index']);
Route::get('client/{id}', [ClientController::class, 'show']);
Route::post('client', [ClientController::class, 'store']);
Route::put('client/{id}', [ClientController::class, 'update']);
Route::delete('client/{id}', [ClientController::class, 'destroy']);

Route::get('billings', [BillingController::class, 'index']);
Route::get('billings/{id}', [BillingController::class, 'show']);
Route::post('billing', [BillingController::class, 'store']);

Route::get('cep/{cep}', [CepController::class, 'show']);