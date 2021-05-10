<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Reservation;
use DB;
class HomeController extends Controller
{
    public function index()
    {

        $hotels = Hotel::where('enabled', 1)->get();
        return view('frontend.index', compact('hotels'));
    }

    public function availability(Request $request)
    {
        $input = $request->validate(['hotel_id' => 'required', 'from' => 'required', 'to' => 'required']);
        $newDateTime = now()->addMonth(3);
        $now = now();

        if($input['from'] < $now){
            return back()->with('error', 'From date should not be less than current date ');
        }
        if($input['from']== $input['to'] ){
            return back()->with('error', 'From date and to date should not be same ');
        }

        if($input['from'] > $input['to'] ){
            return back()->with('error', 'From date should not be grater than to date ');
        }

        if($input['from'] > $newDateTime){
            return back()->with('error', 'From date should not be grater than 3 monthes ');
        }

        $hotels = Hotel::where('enabled', 1)->get();
        $selected = Hotel::with('images')->find($request->get('hotel_id'));
        $startDate = Carbon::createFromFormat('Y-m-d', $input['from']);
        $endDate = Carbon::createFromFormat('Y-m-d', $input['to']);
        $dateRange = CarbonPeriod::create($startDate, $endDate);

        $reservations = Reservation::select('room_id','from','to')->where('from','>=' ,date('Y-m-d', strtotime($startDate)))
                                    ->orWhere('to','<=' ,date('Y-m-d', strtotime($endDate)))
                                    ->where('hotel_id',$request->get('hotel_id'))->get();


        if(!empty($reservations)){
            $reservations = $reservations->toArray();
        }
        else{
            $reservations =[];
        }
        return view('frontend.availability', compact(['input', 'hotels', 'selected', 'dateRange','reservations']));
    }
}
