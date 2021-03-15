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
    Route::resource('hotels', 'HotelController');
    Route::post('hotels/{id}', 'HotelController@updateHotel');
    Route::get('hotel/{id}', 'HotelController@deleteHotel')->name('delete.hotel');
    Route::get('hotel-add-more/{id}', 'HotelController@moreView');
    Route::post('hotel-image-add/{id}', 'HotelController@addImage')->name('add.hotel.image');
    Route::post('hotel-room-add/{id}', 'HotelController@addRoom')->name('add.hotel.room');
    Route::get('change-hotel-status/{id}', 'HotelController@changeHotelStatus');

});
