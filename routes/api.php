<?php

use App\Http\Controllers\AuthController;
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
// Passport::routes();
Route::group([
    'middleware' => ['api', 'auth:api','web'],
    'prefix' => 'auth'
 ], function () {
    Route::post('login',[\App\Http\Controllers\AuthController::class,'login'])->withoutMiddleware(['auth:api']);
    Route::post('logout',[\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('refresh',[\App\Http\Controllers\AuthController::class,'refresh'])->withoutMiddleware(['auth:api']);
    Route::get('user', [\App\Http\Controllers\AuthController::class,'me']);
 });

