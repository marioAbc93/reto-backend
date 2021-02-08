<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoapController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);

Route::get('user',       [SoapController::class, 'registrarUsuario']);
Route::post('user',       [SoapController::class, 'registrarUsuario']);