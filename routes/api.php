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

Route::post('auth/register', 'Auth\AuthController@register');
Route::post('auth/login', 'Auth\AuthController@login');
Route::get('auth/logout','Auth\AuthController@logout')->middleware('auth:api');

Route::middleware('auth:api')->name('api.')->prefix('book')->group(function () {



 Route::post('','MyBookController@addMyBook')->name('add.mybook');

 Route::get('','MyBookController@listMyBook')->name('list.mybook');

 Route::put('', 'MyBookController@update')->name('update.book');

 Route::delete('/{id}/{type}', 'MyBookController@destroy')->name('delete.book');


});
