<?php

use Illuminate\Http\Request;

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

//v1 api route

Route::prefix('v1')->group(function(){
    Route::post('addCartItem', 'CartController@add');
    Route::post('deleteCartItem', 'CartController@delete');
    Route::get('getCartCount', 'CartController@getCartCount');
    Route::get('getCartItems', 'CartController@getCartItems');
});
