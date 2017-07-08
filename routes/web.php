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

// SCOOTERS
Route::resource('scooters','ScooterController');
Route::get('/scooters/color/{scooter_model}/{color}', 'ScooterController@showcolor');
Route::get('/home/scooters', 'ScooterController@adminScooterIndex');
Route::get('/home/scooters/{scooter_id}', 'ScooterController@adminScooterInfo');
Route::post('/scooters/{scooterId}', 'ScooterController@update');
Route::get('/scooters/{scooterId}/destroy', 'ScooterController@destroy');


// BOOKINGS
Route::get('/confirm/{bookingId}/{email}/booking', 'bookingController@confirmBooking');

//LANDING PAGE

Route::post('/booking/quote', 'bookingController@quote');

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

Route::get('/home', 'bookingController@index');

// USERS

Route::get('/profile', 'UserController@show');
Route::get('/profile/{userId}', 'UserController@showUser');
Route::post('/user/update', 'UserController@smallUpdate');
Route::post('/user/changePassword', 'UserController@changePassword');
Route::get('/user/confirm/{userId}', 'UserController@confirmUser');