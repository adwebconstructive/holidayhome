<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $table= 'hotel_rooms';

    public  function  roomImage(){
        return $this->hasMany('App\Models\HotelImage','room_id');
    }

}
