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

if (config('app.env') === 'local') {
    Route::get('styles/buttons', function() {
        return view('styleguide.buttons');
    });
    Route::get('styles/typography', function() {
        return view('styleguide.typography');
    });
    Route::get('styles/cards', function() {
        return view('styleguide.cards');
    });
}

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/beers', 'BeerController@index')->name('beers.index');
Route::get('/beers/{beer}', 'BeerController@show')->name('beers.show');

Route::middleware(['auth'])->group(function () {
    Route::resource('beers', 'BeerController')->except(['index', 'show']);
});

