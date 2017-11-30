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
    ->middleware(['auth','user_type:1'])
    ->group(function () {
        $resource_except = ['except' => ['create', 'edit']];

        Route::view('/', 'admin.dashboard')->name('admin_dashboard');
        Route::view('help','admin.help')->name('admin_help');

        //Configuration view
        Route::view('configuration','admin.configuration')->name('admin_configuration');

        //States
        Route::resource('states', 'StatesController', $resource_except);
        Route::get('mexico_states', 'StatesController@getMexicoStates');
        Route::get('states_all','StatesController@all');

        //Places
        Route::resource('places','PlacesController', $resource_except);
        Route::get('places_all', 'PlacesController@all');

        //Areas
        Route::resource('areas','AreasController', $resource_except);

        //Events
        Route::resource('events','EventsController',$resource_except);
        Route::get('event_types_all','EventsController@getEventTypes');

        //Reservations
        Route::get('reservations','ReservationsController@index')->name('reservations.index');
        Route::get('reservations/{id}','ReservationsController@show')->name('reservations.show');
        Route::delete('reservations/{id}','ReservationsController@destroy')->name('reservations.destroy');

    });

/*
 * Client routes
 */

Route::middleware(['auth','user_type:2'])
    ->group(function() {
        Route::view('profile', 'client.profile.index')->name('profile');
        Route::view('history', 'client.profile.history')->name('history');
        Route::view('configuration', 'client.profile.configuration')->name('configuration');

        Route::post('reservations','ReservationsController@store')->name('reservations.store');
        Route::get('reservations/{id}','ClientsController@showReservation')->name('client.reservations.show');

        Route::resource('users', 'UsersController');
        Route::put('users_password/{id}', 'UsersController@updatePassword')->name('users.update_password');
    });

Route::get('index', 'ClientsController@index')->name('index');
Route::get('events','EventsController@getClientEvents')->name('client.events.index');
Route::get('events/{id}','ClientsController@showEvent')->name('client.events.show');
