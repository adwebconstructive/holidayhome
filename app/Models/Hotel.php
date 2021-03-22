<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','address','city','state','country','pin_code','contact_person','contact_email','contact_phone'];

    public  function  hotelRoom(){
        return $this->hasMany('App\Models\HotelRoom', 'hotel_id')->whereNull('deleted_at');
    }
    public  function  hotelImage(){
        return $this->hasMany('App\Models\HotelImage', 'hotel_id')->whereNull('room_id');
    }

    public function getUniqueName()
    {
        return $this->id . '-'. str_slug($this->name);
    }

    public function getFullAddressAttribute()
    {
        return $this->address. ", ". $this->city . ", " . $this->state . ", " . $this->pin_code;
    }

     public function getContactDetailsAttribute()
    {
        return $this->contact_person. ", ". $this->contact_email . ", " . $this->contact_phone ;
    }
}
