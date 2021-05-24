<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = ['transaction_id', 'rate'];

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel', 'hotel_id');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\HotelRoom', 'room_id');
    }

    public function getReservedTypeAttribute()
    {
        return $this->booking_for_relative ? "Relative" : "Self";
    }

    public function reservedByUser()
    {
        return $this->belongsTo('App\User', 'reserved_by','id')->withTrashed()->withDefault(['name' => null]);
    }
    public function reservedForUser()
    {
        return $this->belongsTo('App\User', 'reserved_for','id')->withTrashed()->withDefault(['name' => null]);
    }

    public static function getNextReservationID()
    {
        $recent = static::orderBy('id', 'desc')->first();
        if ($recent != null) {
            $last_res_id = $recent->reservation_id;
            $year_part = intval(explode('-', $last_res_id)[0]);
            $id_part = intval(explode('-', $last_res_id)[1]);
            if($year_part == now()->year){
                $id_part ++;
            }else{
                $id_part = 1;
            }
        }else{
            $id_part = 1;
        }
        return now()->year . "-".$id_part;
    }

}
