<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

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

Route::post('user', [UserController::class, 'store']);

Route::post('recarga',   [WalletController::class, 'recarga']);
Route::post('saldo',     [WalletController::class, 'index']);
Route::post('pagar',     [WalletController::class, 'pagar']);
Route::post('confirmar', [WalletController::class, 'confirmar']);