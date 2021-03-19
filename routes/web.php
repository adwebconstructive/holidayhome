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

    Route::group(['prefix' => 'hotels'], function(){
        Route::get('', 'HotelController@index')->name('hotels.index');
        Route::get('create', 'HotelController@create');
        Route::get('edit/{id}', 'HotelController@edit');
        Route::post('', 'HotelController@store')->name('hotels.store');
        Route::post('{id}', 'HotelController@update')->name('hotels.update');
        Route::get('delete/{id}', 'HotelController@delete')->name('delete.hotel');
    });

    Route::get('hotel-add-more/{id}', 'HotelController@moreView');
    Route::post('hotel-image-add/{id}', 'HotelController@addImage')->name('add.hotel.image');
    Route::post('hotel-room-add/{id}', 'HotelController@addRoom')->name('add.hotel.room');
    Route::get('change-hotel-status/{id}', 'HotelController@changeHotelStatus');

    Route::get('hotels/room-create/{id}', 'HotelController@roomIndex');

    Route::post('hotels/room-update/{id}', 'HotelController@roomUpdate')->name('room.update');
    Route::get('hotels/room-edit/{id}', 'HotelController@editRoomIndex');
    Route::get('hotels/room-delete/{id}', 'HotelController@deleteRoom');

    Route::get('hotels/image-delete/{id}', 'HotelController@imageDelete');


});
