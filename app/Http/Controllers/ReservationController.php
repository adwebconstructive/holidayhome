<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
   public function index(Request $request){

   		$reservations = Reservation::whereRaw('1');
        if (!empty($request['from'] && !empty($request['to']))) {
            $reservations = $reservations->whereBetween('from', [$request['from'],$request['to']]);
        }
        $reservations = $reservations->paginate(config('settings.variable.page_size'));

       
        return view('reservation.index', compact('reservations'));
   }

    public function create(Request $request){
    	$hotels = Hotel::get();
        $rooms = HotelRoom::get();
        return view('reservation.create',compact('hotels','rooms'));
   }


   public function store(Request $request){
       
    $this->validate($request, [
            'hotel_id' => 'required|string',
            'room_id' => 'required|integer',
            'from' => 'required|string',
            'to' => 'required|string',
        ]);
        
    
        

        $from = Carbon::parse($request['from']);
        $to = Carbon::parse($request['to']);
        $newDateTime = Carbon::now()->addMonth(3);

        if($from == $to ){
            return back()->with('error', 'From date and to date should not be same ');
        }

        if($from > $to ){
            return back()->with('error', 'From date should not be grater than to date ');
        }

        if($from > $newDateTime){
            return back()->with('error', 'From date should not be grater than 3 monthes ');
        }

        $room = HotelRoom::find($request['room_id']);

        $diff_in_days = $to->diffInDays($from);;
        $request['rate'] =  $room->rate * $diff_in_days ;
        $request['reserved_by'] = "1";

        Reservation::create($request->all());

        return back()->with('success', 'Room  booked successfully');
    }

}
