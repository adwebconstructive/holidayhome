<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $table= 'hotel_rooms';

    protected  $fillable =['hotel_id','room_number','description','room_type','person_allowed','max_person_allowed','rate','price'];

    public  function  roomImage(){
        return $this->hasMany('App\Models\HotelImage','room_id');
    }

}
