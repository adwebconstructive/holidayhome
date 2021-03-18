<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name','address','city','state','country','pin_code','contact_person','contact_email','contact_phone'];

    public  function  hotelRoom(){
        return $this->hasMany('App\Models\HotelRoom', 'hotel_id')->whereNull('deleted_at');
    }
    public  function  hotelImage(){
        return $this->hasMany('App\Models\HotelImage', 'hotel_id')->whereNull('room_id');
    }
}
