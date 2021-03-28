<?php

namespace App\Http\Controllers;

use App\Helpers\EmailHelper;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\User;
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
       
        $params = $request->validate(config('settings.reservation.creation_validation_rules'));

        $from = Carbon::parse($params['from']);
        $to = Carbon::parse($params['to']);
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
        $user = User::find(1);
        $diff_in_days = $to->diffInDays($from);;
        $params['rate'] =  $room->rate * $diff_in_days ;
        $params['reserved_by'] = $user->id;

        $book= Reservation::create($params);

        $full_details = Reservation::where('id',$book->id)->with('hotel','room')->first();
      
        $admin = User::find(2);

        $email = new EmailHelper();
        $email->sendSuccessReservationAdminEmail($full_details,$user, $admin->email);
        $email->sendSuccessReservationUserEmail($full_details, $user->email);

        return back()->with('success', 'Room  booked successfully');
    }

}
