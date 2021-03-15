<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public  function  hotelRoom(){
        return $this->hasMany('App\Models\HotelRoom', 'hotel_id');
    }
    public  function  hotelImage(){
        return $this->hasMany('App\Models\HotelImage', 'hotel_id')->whereNull('room_id');
    }
}
