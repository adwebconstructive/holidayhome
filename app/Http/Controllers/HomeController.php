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
        $dateRange = CarbonPeriod::create(Carbon::createFromFormat('Y-m-d', $input['from']), Carbon::createFromFormat('Y-m-d', $input['to']));
        $reservations = Reservation::where('hotel_id',$request->get('hotel_id'))
            ->whereBetween('reserved_date', [$request->get('from'), $request->get('to')])
            ->pluck('reserved_date', 'hotel_id')->toArray();
        return view('frontend.availability', compact(['input', 'hotels', 'selected', 'dateRange','reservations']));
    }
}
