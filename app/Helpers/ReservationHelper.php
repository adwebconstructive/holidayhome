<?php

namespace App\Helpers;

use App\Models\Reservation;
use stdClass;

class ReservationHelper{

    public function getReservations($count = 10)
    {
        $reservation_data = [];
        $reservation_ids = Reservation::selectRaw("distinct reservation_id as res_id")->take($count)->get()->toArray();
        $reservations = Reservation::with(['hotel.rooms', 'room', 'reservedByUser', 'reservedForUser'])->whereIn('reservation_id', array_values($reservation_ids))->get()->groupBy(['reservation_id', 'room_id']);
        dd($reservations);
        foreach($reservations as $reservation_id => $data_list){
            $obj = new Reservation();
            $obj->reservation_id = $reservation_id;
            foreach($data_list as $data){

            }
            
            $reservation_data[$reservation_id] = $data_list->groupBy('room_id');
        }
        dd($reservations);
        return $reservations;
    }

}