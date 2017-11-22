<?php

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

Auth::routes();

Route::get('/', 'HomeController@index');

/*
 * Admin routes
 */

Route::prefix('admin')
    ->middleware('user_type:1')
    ->group(function () {
        $resource_except = ['except' => ['create', 'edit']];

        Route::view('/', 'admin.dashboard')->name('dashboard');

        //Configuration view
        Route::view('configuration','admin.configuration')->name('admin_configuration');

        //States
        Route::resource('states', 'StatesController', $resource_except);
        Route::get('mexico_states', 'StatesController@getMexicoStates');
        Route::get('states_all','StatesController@all');

        //Places
        Route::resource('places','PlacesController', $resource_except);
    });

/*
 * Client routes
 */

Route::middleware('user_type:2')
    ->group(function() {
        Route::view('index', 'client.index')->name('index');
        Route::get('profile', function() { return "Profile"; })->name('profile');
        Route::get('history', function() { return "History"; })->name('history');
        Route::get('configuration', function() { return "Configuration"; })->name('configuration');
        Route::get('help', function() { return "Help";  })->name('help');
    });
