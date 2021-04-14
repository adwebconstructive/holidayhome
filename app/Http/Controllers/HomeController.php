<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HomeController extends Controller
{
    public function index()
    {

        $hotels = Hotel::where('enabled', 1)->get();
        return view('frontend.index', compact('hotels'));
    }

    public function availability(Request $request)
    {
        $input = $request->all();
        $hotels = Hotel::where('enabled', 1)->get();
        $selected = Hotel::with('images')->find($request->get('hotel_id'));
        $startDate = Carbon::createFromFormat('Y-m-d', $input['from']);
        $endDate = Carbon::createFromFormat('Y-m-d', $input['to']);
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        return view('frontend.availability', compact(['input', 'hotels', 'selected', 'dateRange']));
    }
}
