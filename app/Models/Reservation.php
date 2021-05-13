<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['reserved_by','hotel_id','room_id','reserved_date','rate'];
    protected $guarded =  ['transaction_id'];


    public  function  hotel(){
        return $this->belongsTo('App\Models\Hotel', 'hotel_id');
    }

    public  function  room(){
        return $this->belongsTo('App\Models\HotelRoom', 'room_id');
    }
}
