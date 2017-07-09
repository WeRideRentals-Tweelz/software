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
Auth::routes();

Route::get('/', function(){
	return view('home');
});

// SCOOTERS
Route::resource('scooters','ScooterController');
Route::get('/scooters/color/{scooter_model}/{color}', 'ScooterController@showcolor');
Route::post('/scooters/{scooterId}', 'ScooterController@update');
Route::get('/scooters/{scooterId}/destroy', 'ScooterController@destroy');
//Admin
	Route::get('/home/scooters', 'ScooterController@adminScooterIndex');
	Route::get('/home/scooters/{scooter_id}', 'ScooterController@adminScooterInfo');

// BOOKINGS
Route::resource('bookings','BookingController');
//Users
	Route::post('/booking/quote', 'BookingController@quote');
	Route::get('/confirm/{bookingId}/{email}/booking', 'BookingController@confirmBooking');
//Admin
	Route::get('/bookings/{booking}/destroy', 'BookingController@destroy');
	Route::post('/bookings', 'BookingController@store');
	Route::post('/bookings/{booking}', 'BookingController@update');

	//Creation of users from Booking file
	Route::get('/users/create/fromBooking/{booking}','UserController@create');

// DRIVERS 
Route::get('/home/drivers', 'DriversController@index');
Route::get('/home/drivers/{driver_id}', 'DriversController@show');
Route::get('/home/drivers/{driver_id}/confirm', 'DriversController@confirm');
Route::post('/home/drivers/{driver_id}/update', 'DriversController@update');

// ADMIN
Route::get('/home', 'BookingController@dashboard');

// USERS
Route::get('/profile', 'UserController@show');
Route::get('/profile/{userId}', 'UserController@showUser');
Route::post('/user/update', 'UserController@smallUpdate');
Route::post('/user/changePassword', 'UserController@changePassword');
Route::get('/user/confirm/{userId}', 'UserController@confirmUser');