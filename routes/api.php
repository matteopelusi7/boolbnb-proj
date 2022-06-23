<?php

use App\Message;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {

    Route::resource('home', 'UserController')->only([
        'index', 'show'
    ]);
    Route::resource('add', 'AddsController')->only([
        'index', 'show'
    ]);
    Route::resource('apartment', 'ApartmentController')->only([
        'index', 'show'
    ]);
    Route::post('messages', 'MessageController@store');

});