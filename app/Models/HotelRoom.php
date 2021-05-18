<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $fillable = [
        'hotel_id',
        'room_number',
        'description',
        'max_person_allowed',
        'rate',
    ];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }

    public function images()
    {
        return $this->morphMany('App\Models\HotelImage', 'imageable');
    }
    
    public function getUniqueName()
    {
        return $this->hotel->id . '-'. $this->id;
    }

    public function reservations(){
        return $this->hasMany('App\Models\Reservation','room_id');
    }
}
