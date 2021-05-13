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

Route::group(['prefix' => ''], function(){
    Route::get('', 'HomeController@index');
    Route::get('availability', 'HomeController@availability');
});

Route::group(['prefix' => 'admin'], function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // });

    Route::group(['prefix' => 'hotel'], function () {

        Route::get('', 'HotelController@index')->name('hotel.index');
        Route::get('create', 'HotelController@create')->name('hotel.create');
        Route::get('{id?}', 'HotelController@view')->name('hotel.view');
        Route::get('edit/{id}', 'HotelController@edit')->name('hotel.edit');

        Route::post('', 'HotelController@store')->name('hotel.store');
        Route::post('image', 'HotelController@uploadHotelImages')->name('hotel.image');
        Route::post('{id}/reserve', 'HotelController@reserve')->name('hotel.reserve');
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
});

Route::group(['prefix' => 'reservation'], function () {
        Route::get('', 'ReservationController@index');
        Route::get('create', 'ReservationController@create')->name('reservation.create');
        Route::post('store', 'ReservationController@store')->name('reservation.store');

    });
