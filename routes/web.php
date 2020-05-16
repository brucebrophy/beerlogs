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
    Route::get('styles/forms', function() {
        return view('styleguide.forms');
    });
    Route::get('styles/components', function() {
        JavaScript::put([
            'malts' => App\Malts\Malt::orderBy('name')->get(['id', 'name']),
            'hops' => App\Hops\Hop::orderBy('name')->get(['id', 'name']),
        ]);
        return view('styleguide.components');
    });
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    // Beers - Authenticated
    Route::resource('beers', 'BeerController')->except(['index', 'show']);
    Route::resource('beers.recipes', 'RecipeController')->except(['index', 'show']);

    // Profiles - Authenticated 
    Route::get('/@{user:username}/edit', 'UserController@edit')->name('users.edit');
    Route::patch('/@{user:username}', 'UserController@update')->name('users.update');
    Route::delete('/@{user:username}', 'UserController@destroy')->name('users.destroy');
});

// Beers - Public
Route::get('/beers', 'BeerController@index')->name('beers.index');
Route::get('/beers/{beer}', 'BeerController@show')->name('beers.show');

// Profiles - Public
Route::get('/@{user:username}', 'UserController@show')->name('users.show');

Auth::routes(['verify' => true]);

