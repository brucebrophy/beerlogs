<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    // Beers - Authenticated
    Route::resource('beers', 'BeerController')->except(['index', 'show']);
    // Recipes - Authenticated
    Route::resource('beers.recipes', 'RecipeController')->except(['index', 'show']);

    // Profiles - Authenticated 
    Route::get('@{user:username}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('@{user:username}', 'UserController@update')->name('users.update');
    Route::delete('@{user:username}', 'UserController@destroy')->name('users.destroy');
});

// Beers - Public
Route::get('beers', 'BeerController@index')->name('beers.index');
Route::get('beers/{beer}', 'BeerController@show')->name('beers.show');

// Profiles - Public
Route::get('@{user:username}', 'UserController@show')->name('users.show');

Auth::routes(['verify' => true]);