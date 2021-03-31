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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::group(['prefix' => 'hotels'], function () {
        Route::get('', 'HotelController@index')->name('hotels.index');
        Route::get('create', 'HotelController@create');
        Route::get('{id?}', 'HotelController@view')->name('hotels.view');
        Route::get('edit/{id}', 'HotelController@edit');
        Route::post('', 'HotelController@store')->name('hotels.store');
        Route::post('{id}', 'HotelController@update')->name('hotels.update');
        Route::get('delete/{id}', 'HotelController@delete')->name('delete.hotel');

        Route::group(['prefix' => '{id?}/room'], function(){
            Route::get('create', 'HotelController@createRoom')->name('hotel.room.create');
            Route::post('', 'HotelController@saveRoom')->name('hotel.room.store');
            Route::post('{room_id?}', 'HotelController@updateRoom')->name('hotel.room.update');
            Route::get('image/{room_id?}', 'HotelController@addImage')->name('hotel.room.image');
            Route::get('delete/{room_id?}', 'HotelController@deleteRoom')->name('hotel.room.delete');
        });
    });
});
