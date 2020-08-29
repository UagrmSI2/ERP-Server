<?php

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
Route::get('users','UserController@getAll');
Route::get('readCities','CityController@getAll');


Route::get('category','CategoryController@read');
Route::post('category','CategoryController@create');
Route::put('category/{id}','CategoryController@update');
Route::delete('category/{id}','CategoryController@destroy');

Route::get('product','ProductController@read');
Route::post('product','ProductController@create');
Route::put('product/{id}','ProductController@update');
Route::delete('product/{id}','ProductController@destroy');





