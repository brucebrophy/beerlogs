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


Route::resource('beers.comments', 'Api\Beers\CommentController')->except(['create', 'edit', 'show']);

Route::middleware('auth:api')->group(function () {
    Route::get('yeasts', 'Api\YeastController@index');
    Route::get('malts', 'Api\MaltController@index');
    Route::get('hops', 'Api\HopController@index');
    Route::get('hops/types', 'Api\HopTypeController@index');
    Route::get('hops/methods', 'Api\HopMethodController@index');
    Route::get('units', 'Api\UnitController@index');
});
