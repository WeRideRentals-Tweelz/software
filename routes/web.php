<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});

//LOGIN
Route::post('/login/shop', 'Auth\LoginController@shop');

// SCOOTERS
Route::get('/scooters', 'scooterController@index');

Route::get('/scooters/{scooter_id}', 'scooterController@show');

// BOOKINGS

Route::post('/bookings', 'bookingController@availability');
Route::get('/home/bookings', 'bookingController@index');
Route::post('/bookings/confirmation', 'bookingController@store');
Auth::routes();

// DRIVERS 
Route::get('/home/drivers', 'DriversController@index');
Route::get('/home/drivers/{driver_id}', 'DriversController@show');
Route::get('/home/drivers/{driver_id}/confirm', 'DriversController@confirm');
Route::post('/home/drivers/{driver_id}/update', 'DriversController@update');

// ADMIN

Route::get('/home', 'HomeController@index');