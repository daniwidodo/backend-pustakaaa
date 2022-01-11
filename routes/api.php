<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Quote;
use App\Models\Book;
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

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {

    ///// USERS API ///////////

    Route::get('/users', function () {
        return auth()->user();
    });

    Route::put('/users/{id}', [App\Http\Controllers\AuthController::class, 'update']);
    Route::get('/users/{id}', [App\Http\Controllers\AuthController::class, 'view']);


    ///// USER-QUOTES ///////




});
