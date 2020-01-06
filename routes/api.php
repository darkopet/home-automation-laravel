<?php

use App\DeviceType;
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

//Path with user prefix and middleware
Route::prefix('user')->middleware('auth:api')->group(function() {
    Route::get('', 'AuthController@user');
    Route::get('logout', 'AuthController@logout');
});

//Path with user prefix without middleware
Route::prefix('user')->group(function() {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::prefix('devices')->middleware('auth:api')->group(function() {
    Route::get('{device}', 'DeviceController@show');
    Route::put('{device}', 'DeviceController@update');
    Route::delete('{device}', 'DeviceController@destroy');
    Route::get('', 'DeviceController@devices');
    Route::post('', 'DeviceController@store');
});

Route::prefix('device-type')->middleware('auth:api')->group(function() {
    Route::get('', 'DeviceTypeController@deviceTypes');
    Route::get('{deviceType}', 'DeviceTypeController@show');
    Route::post('', 'DeviceTypeController@store');
    Route::put('{deviceType}', 'DeviceTypeController@update');
    Route::delete('{deviceType}', 'DeviceTypeController@destroy');
});

Route::fallback(function(){
    return response()->json(['message' => 'Page Not Found.'], 404);
});