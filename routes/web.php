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

Route::get('/contact', function () {
        return view('frontend.contact');
});

Route::group(['prefix' => ''], function(){
    Route::get('', 'HomeController@index');
    Route::get('availability', 'HomeController@availability');
});

Route::group(['prefix' => 'admin' ,'middleware' => ['auth', 'CheckAdminRoleMiddleware']], function () {
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'hotel'], function () {

        Route::get('', 'HotelController@index')->name('hotel.index');
        Route::get('create', 'HotelController@create')->name('hotel.create');
        Route::get('{id?}', 'HotelController@view')->name('hotel.view');
        Route::get('edit/{id}', 'HotelController@edit')->name('hotel.edit');

        Route::post('', 'HotelController@store')->name('hotel.store');
        Route::post('image', 'HotelController@uploadHotelImages')->name('hotel.image');
        // Route::post('{id}/reserve', 'HotelController@reserve')->name('hotel.reserve');
        Route::post('{id}', 'HotelController@update')->name('hotel.update');
        Route::get('delete/{id}', 'HotelController@delete')->name('hotel.delete');

        Route::group(['prefix' => '{id?}/room'], function(){
            Route::get('create', 'HotelController@createRoom')->name('hotel.room.create');
            Route::post('', 'HotelController@saveRoom')->name('hotel.room.store');
            Route::post('{room_id?}', 'HotelController@updateRoom')->name('hotel.room.update');
            Route::post('image/{room_id?}', 'HotelController@addImage')->name('hotel.room.image');
            Route::get('delete/{room_id?}', 'HotelController@deleteRoom')->name('hotel.room.delete');
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'UserController@index')->name('user.index');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/store', 'UserController@store')->name('user.store');
        Route::post('/update', 'UserController@update')->name('user.update');
        Route::get('/changeStatus/{id}', 'UserController@changeUserStatus')->name('user.change.status');
        Route::get('/delete/{id}', 'UserController@delete')->name('user.delete');
    });
});

Route::group(['prefix' => 'reservation' ,'middleware' => ['auth']], function () {
        Route::get('', 'ReservationController@index')->name('reservation.index');
        Route::post('check-avilable', 'ReservationController@availabilityCheck')->name('reservation.availability');
        Route::get('check-avilable', 'ReservationController@availabilityCheck')->name('reservation.availability');
        Route::get('/calender', 'ReservationController@calenderViewIndex')->name('reservation.calender.index');
        Route::get('/calender/search', 'ReservationController@calenderView')->name('reservation.calender.search');
        Route::post('hotel/{id}/reserve', 'HotelController@reserve')->name('hotel.reserve');
        Route::get('create', 'ReservationController@create')->name('reservation.create');
        Route::post('store', 'ReservationController@store')->name('reservation.store');

    });

// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
