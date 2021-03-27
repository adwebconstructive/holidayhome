<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $fillable = [
        'hotel_id',
        'room_number',
        'description',
        'room_type',
        'person_allowed',
        'max_person_allowed',
        'rate',
        'price',
    ];

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }

    public function roomImage()
    {
        return $this->hasMany('App\Models\HotelImage', 'room_id');
    }
    
    public function getUniqueName()
    {
        return $this->hotel->id . '-'. $this->id;
    }
}
