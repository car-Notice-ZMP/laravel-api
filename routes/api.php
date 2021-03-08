<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;

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



Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('register', [ RegisterController::class, 'register']);
    Route::post('login', [ LoginController::class, 'login']);
    Route::get('profile', [ ProfileController::class, 'profile']);
});

Route::get('google',          [ GoogleController::class, 'redirectToGoogle']);
Route::get('google/callback', [ GoogleController::class, 'handleGoogleCallback']);
