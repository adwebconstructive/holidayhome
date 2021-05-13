<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'city', 'state', 'country', 'pin_code', 'contact_person', 'contact_email', 'contact_phone', 'check_in', 'check_out'];

    public  function  rooms()
    {
        return $this->hasMany('App\Models\HotelRoom', 'hotel_id');
    }

    public  function  hotelImage()
    {
        return $this->hasMany('App\Models\HotelImage', 'hotel_id');
    }

    public function images()
    {
        return $this->morphMany(HotelImage::class, 'imageable');
    }

    public function getUniqueName()
    {
        return $this->id . '-' . str_slug($this->name);
    }

    public function bannerImage()
    {
        return $this->images->first()->image_path ?? '';
    }

    public function getFullAddressAttribute()
    {
        return $this->address . ", " . $this->city . ", " . $this->state . ", " . $this->pin_code;
    }

    public function getContactDetailsAttribute()
    {
        return $this->contact_person . ", " . $this->contact_email . ", " . $this->contact_phone;
    }

    public function rates(){
        return $this->rooms->pluck('rate','id');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function getReservations($from, $to)
    {
        return $this->reservations()->whereBetween('reserved_date', [$from, $to])
            ->selectRaw("concat(room_id, '~', reserved_date) as reservation_data")
            ->get();
    }

}
