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
	
	Route::get('/home/scooter/{scooterId}/KmCheck/{check}','ScooterController@kmCheckSheet');
	Route::get('/home/scooter/checked/{scooterId}/kmCheck/{check}','ScooterController@checkKilometers');

	//Repairs
	Route::post('/scooter/{scooterId}/repair','ScooterController@addRepair');
	Route::get('/scooter/{repairId}/removeRepair', 'ScooterController@removeRepair');

// BOOKINGS
Route::resource('bookings','BookingController');
//Users
	Route::post('/booking/quote', 'BookingController@quote');
	Route::get('/confirm/{bookingId}/{email}/booking', 'BookingController@confirmBooking');
//Admin
	Route::get('/pastbookings','BookingController@pastbookings');
	Route::post('/pastbookings','BookingController@pastbookings');
	Route::get('/bookings/{booking}/destroy', 'BookingController@destroy');
	Route::post('/bookings', 'BookingController@store');
	Route::post('/bookings/{booking}', 'BookingController@update');

	//Payments
	Route::get('/booking/payment/delete/{paymentsId}/{bookindId}', 'PaymentsController@destroy');
	Route::get('/booking/payment/delete/{paymentsId}/{bookindId}/bondBack', 'PaymentsController@destroyAndBondBack');
	Route::get('/bookings/{bookingId}/payBond', 'BookingController@payBond');
	Route::get('/bookings/{bookingId}/payBondFinancial', 'BookingController@payBondFinancial');

	//Creation of users from Booking file
	Route::get('/users/create/fromBooking/{booking}','UserController@create');

// DRIVERS 
Route::get('/home/drivers', 'DriversController@index');
Route::get('/home/drivers/{driver_id}', 'DriversController@show');
Route::get('/home/drivers/{driver_id}/confirm', 'DriversController@confirm');
Route::post('/home/drivers/{driver_id}/update', 'DriversController@update');

// ADMIN
Route::get('/home', 'BookingController@dashboard')->middleware('admin');

// USERS
Route::resource('users','UserController');
Route::get('/banned', 'UserController@indexBanned');
Route::get('/profile', 'UserController@show');
Route::get('/profile/{userId}', 'UserController@showUser');
Route::get('/profile/{userId}/delete', 'UserController@destroy');

Route::post('/user/update', 'UserController@smallUpdate');
Route::post('/user/changePassword', 'UserController@changePassword');
Route::get('/user/confirm/{userId}', 'UserController@confirmUser');
Route::get('/users/fromBooking/{bookingId}', 'UserController@createFromBooking');

//Tolls
Route::resource('tolls','TollsController');
Route::get('/tolls/{sort}/{order}/{limit}', 'TollsController@index');
Route::post('/tolls/edit', 'TollsController@edit');
Route::post('/tolls/update', 'TollsController@update');
Route::post('/tolls/delete', 'TollsController@destroy');