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

        $from = Carbon::parse($input['from']);
        $to = Carbon::parse($input['to']);

        $redirect = false;

        if ($from->lt(now())) {
            $message = "From date cannot be less than current date!";
            $redirect = true;
        }
        if ($to->gt(now()->addDays(90))) {
            $message = "To date cannot be more than 90 days from from date!";
            $redirect = true;
        }

        if($redirect){
            return back()->with('error', $message);
        }

        $hotels = Hotel::select(['id', 'name', 'city'])->get();
        $selected = Hotel::with(['images', 'rooms'])->find($request->get('hotel_id'));
        $dateRange = CarbonPeriod::create($input['from'], $input['to']);
        $reservations = $selected->getReservations($input['from'], $input['to'])->toArray();
        $reservations = array_flatten($reservations);
        return view('frontend.availability', compact(['input', 'hotels', 'selected', 'dateRange', 'reservations']));
    }
}
