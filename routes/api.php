<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\SearchController;

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
    Route::post('login',    [ LoginController::class, 'login']);
    Route::get('profile',   [ ProfileController::class, 'profile']);
});

Route::get('google',          [ GoogleController::class, 'redirectToGoogle']);
Route::get('google/callback', [ GoogleController::class, 'handleGoogleCallback']);

Route::post('notices/store',         [ NoticeController::class, 'store']);
Route::delete('notices/delete/{id}', [ NoticeController::class, 'destroy']);
Route::post('notices/update/{id}',   [ NoticeController::class, 'update']);
Route::get('notices/show/{id}',      [ NoticeController::class, 'show']);
Route::get('notices/all',            [ NoticeController::class, 'index']);
Route::get('notices/my_notices',     [ NoticeController::class, 'showMyNotices']);
Route::post('notices/status/{id}',   [ NoticeController::class, 'freshStatus']);
Route::post('notices/search',        [ SearchController::class, 'search']);
Route::post('notices/search/between',        [ SearchController::class, 'searchBetween']);


Route::post('comments/{id}/store',         [ CommentController::class, 'store']);


Route::post('fav/{id}/store', [ FavouriteController::class, 'store']);
Route::get('fav/get',         [ FavouriteController::class, 'show']);
Route::get('fav/counter',     [ FavouriteController::class, 'count']);
Route::post('fav/{id}/unf',   [ FavouriteController::class, 'unfavourite']);

