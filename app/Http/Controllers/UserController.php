<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::whereRaw('1');
        if (!empty($request['table_search'])) {
            $users = $users->where(
                'name',
                'like',
                $request['table_search'] . '%'
            );
        }
        $users = $users->withTrashed()->paginate(config('settings.variable.page_size'));

        return view('admin.user.index',compact(['users']));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit($id)
    {   
        $user = User::find($id);
        return view('admin.user.edit',compact(['user']));
    }

    public function store(Request $request){

        $params = $request->validate(config('settings.user.creation_validation_rules'));

        User::create([
            'emp_id' => $params['emp_id'],
            'name' => $params['name'],
            'email' => $params['email'],
            'phone_number' => $params['phone_number'],
            'password' => Hash::make('123456'),
        ]);
        return back()->with('success', 'user created successfully');
    }
    public function update(Request $request){
       
        $params = $request->validate(config('settings.user.update_validation_rules'));

        User::where('id',$request['id'])->update([
            'emp_id' => $params['emp_id'],
            'name' => $params['name'],
            'email' => $params['email'],
            'phone_number' => $params['phone_number'],
            
        ]);
        if(!empty($params['password'])){

            User::where('id',$request['id'])->update([
                'emp_id' => $params['emp_id'],
                'name' => $params['name'],
                'email' => $params['email'],
                'phone_number' => $params['phone_number'],
                'password' => Hash::make($params['password'])
                
            ]);
        }
        return back()->with('success', 'user created successfully');
    }

    public function changeUserStatus($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->delete();
        } else {
            User::onlyTrashed()->where('id', $id)->restore();
        }
        return back();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function myReservation(Request $request)
    {
        $reservations = collect([]);
        $db_data = Reservation::where('reserved_by',Auth::user()->id)->get();
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
        return view('frontend.reservation', compact('reservations'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

}
