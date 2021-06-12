<?php

namespace App\Http\Controllers;

use App\Helpers\EmailHelper;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Refund;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $reservations = collect([]);
        $db_data = Reservation::take(300)->get();
        $last = null;
        foreach($db_data as $reservation){
            if($last != null && $last->reservation_id == $reservation->reservation_id){
                $last->reserved_dates->push($reservation->reserved_date);
            }else{
                if($last){
                    $reservations->push($last);
                }
                $last = $reservation;
                $last->reserved_dates = collect([$reservation->reserved_date]);
            }
        }
        $reservations->push($last);
        return view('reservation.index', compact('reservations'));
    }

    public function create(Request $request)
    {
        $hotels = Hotel::get();
        $rooms = HotelRoom::get();
        return view('reservation.create', compact('hotels', 'rooms'));
    }


    public function store(Request $request)
    {

        $params = $request->validate(config('settings.reservation.creation_validation_rules'));

        if(Auth::user()->role == 2){
            $user = Auth::user();
        }
        else{
            $user = User::where('emp_id',$request['emp_id'])->first();
        }


        foreach ($request['room_info'] as $data) {

            $arr = explode('|', $data);
            $room = HotelRoom::find($arr[1]);

            $params['room_id'] = $arr[1];
            $params['reservation_date'] = $arr[0];
            $params['rate'] = $room->rate;
            $params['reserved_by'] = $user->id;

            $book = Reservation::create($params);

        }

        // $full_details = Reservation::where('id',$book->id)->with('hotel','room')->first();

        // $admin = User::find(2);

        // $email = new EmailHelper();
        // $email->sendSuccessReservationAdminEmail($full_details,$user, $admin->email);
        // $email->sendSuccessReservationUserEmail($full_details, $user->email);

        return back()->with('success', 'Room  booked successfully');
    }

    public function calenderView(Request $request)
    {
        $hotels = Hotel::get();
        $selectedMonth = $request->get('month');
        $selectedYear = $request->get('year');
        $startDate = Carbon::createFromDate($selectedYear, $selectedMonth)->startOfMonth();
        $endDate = Carbon::createFromDate($selectedYear, $selectedMonth)->lastOfMonth();
        $selected = Hotel::with(['images', 'rooms'])->find($request->get('hotel'));
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $reservations = $selected->getReservations($startDate, $endDate)->toArray();
        $reservations = array_flatten($reservations);
        return view('reservation.calender-view', compact('hotels', 'selected', 'startDate', 'endDate', 'selectedMonth', 'selectedYear', 'dateRange', 'reservations'));

    }

    public function calenderViewIndex()
    {
        $hotels = Hotel::get();
        $now = Carbon::now();
        $selectedMonth = $now->month;
        $selectedYear = $now->year;
        $startDate = Carbon::createFromDate($selectedYear, $selectedMonth)->startOfMonth();
        $endDate = Carbon::createFromDate($selectedYear, $selectedMonth)->lastOfMonth();
        return view('reservation.calender-view', compact('hotels', 'selectedMonth', 'selectedYear'));

    }

    public function availabilityCheck(Request $request)
    {
        $input = $request->validate(['hotel_id' => 'required', 'from' => 'required', 'to' => 'required']);
        $newDateTime = now()->addMonth(3);
        $now = now();

        if ($input['from'] < $now) {
            return back()->with('error', 'From date should not be less than current date ');
        }
        if ($input['from'] == $input['to']) {
            return back()->with('error', 'From date and to date should not be same ');
        }

        if ($input['from'] > $input['to']) {
            return back()->with('error', 'From date should not be grater than to date ');
        }

        if ($input['from'] > $newDateTime) {
            return back()->with('error', 'From date should not be grater than 3 monthes ');
        }

        $hotels = Hotel::select(['id', 'name', 'city'])->get();
        $selected = Hotel::with(['images', 'rooms'])->find($request->get('hotel_id'));
        $dateRange = CarbonPeriod::create($input['from'], $input['to']);
        $reservations = $selected->getReservations($input['from'], $input['to'])->toArray();
        $reservations = array_flatten($reservations);
        return view('reservation.availability', compact(['input', 'hotels', 'selected', 'dateRange', 'reservations']));
    }

    public function cancel($reservation_id){
        $reservations = Reservation::where('reservation_id',$reservation_id)->get();
        $total=0;
        foreach($reservations as $data){
            $data->cancelled_by = Auth::user()->id;
            $data->cancelled_at = now();
            $data->save();
            $total+= $data->rate;
        }
        if($reservations->count() > 0){

            $dateRange = CarbonPeriod::create(now(), $data->reserved_date);
            $interval = $dateRange->count();

            if($interval > 60 ){
                $total= ($total*75)/100; 
            }
            if($interval< 60 && $interval > 30){
                $total= ($total*50)/100; 
            }
            if($interval< 30){
                $total= ($total*25)/100; 
            }
            $refund = new Refund();
            $refund->amount = $total;
            $refund->reservation_id = $reservation_id;
            $refund->status = "created";
            $refund->save();
        }

        return back()->with('success','successfully canceled');
        
    }   

}
