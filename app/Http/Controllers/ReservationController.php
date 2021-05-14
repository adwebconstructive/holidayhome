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

   		

        $month = [];
        for ($m=1; $m<=12; $m++) {
            $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
        $years = [];
        for ($year=2021; $year <= 2040; $year++) $years[$year] = $year;

        $hotels = Hotel::With('rooms','rooms.reservations');

        $now = Carbon::now();
        if(empty($request->get('month'))){
          
            $selectedMonth= $now->month;
        }
        else{
            $selectedMonth = $request->get('month');
            $hotels=  $hotels->whereHas('reservations', function ($q) use ($selectedMonth){
                $q->whereRaw('MONTH(reserved_date) = '.$selectedMonth);
            });
            
            
            
        }
        if(empty($request->get('year'))){
            $selectedYear=  $now->year;
            
        }
        else{
            $selectedYear = $request->get('year');
            $hotels=  $hotels->whereHas('reservations', function ($q) use ($selectedYear){
                $q->whereRaw('YEAR(reserved_date) = '.$selectedYear);
            });
        }

        $hotels=  $hotels->get();

        return view('reservation.index', compact('hotels','month','years','selectedMonth','selectedYear'));
   }

    public function create(Request $request){
    	$hotels = Hotel::get();
        $rooms = HotelRoom::get();
        return view('reservation.create',compact('hotels','rooms'));
   }


   public function store(Request $request){
       
        $params = $request->validate(config('settings.reservation.creation_validation_rules'));
        $user = User::find(1);


        foreach($request['room_info'] as $data){

            $arr = explode('|',$data);
            $room = HotelRoom::find($arr[1]);
            
            $params['room_id'] = $arr[1];
            $params['reservation_date'] = $arr[0];
            $params['rate'] =  $room->rate;
            $params['reserved_by'] = $user->id;

            $book= Reservation::create($params);
        
        }

        // $full_details = Reservation::where('id',$book->id)->with('hotel','room')->first();
      
        // $admin = User::find(2);

        // $email = new EmailHelper();
        // $email->sendSuccessReservationAdminEmail($full_details,$user, $admin->email);
        // $email->sendSuccessReservationUserEmail($full_details, $user->email);

        return back()->with('success', 'Room  booked successfully');
    }

}
