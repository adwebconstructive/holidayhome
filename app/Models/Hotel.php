<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','address','city','state','country','pin_code','contact_person','contact_email','contact_phone', 'logo'];

    public  function  rooms(){
        return $this->hasMany('App\Models\HotelRoom', 'hotel_id');
    }
    public  function  hotelImage(){
        return $this->hasMany('App\Models\HotelImage', 'hotel_id');
    }

     public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
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
