<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\HotelImage;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::whereRaw('1');
        if (!empty($request['table_search'])) {
            $hotels = $hotels->where(
                'name',
                'like',
                $request['table_search'] . '%'
            );
        }
        $hotels = $hotels->paginate(config('settings.variable.page_size'));
        return view('admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotel.create');
    }

    public function store(Request $request)
    {
        $params = $request->validate(config('settings.hotel.creation_validation_rules'));
        $hotel = Hotel::create($params);
        return back()->with('success', 'Hotel added successfully!');
    }

    public function view($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel.view', compact('hotel'));
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $params = $request->validate(config('settings.hotel.update_validation_rules'));
        $hotel = Hotel::find($id);
        $hotel->update($params);
        return back()->with('success', 'Hotel updated successfully!');
    }

    public function delete($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return back()->with('success', 'Hotel deleted successfully');
    }

    public function uploadHotelImages(Request $request)
    {
        $params = $request->validate(config('settings.hotel.image_upload_validation_rules'));
        $hotel = Hotel::findOrFail($params['hotel_id']);
        if ($request->file('images') != null) {
            foreach ($request->file('images') as $image) {
                $image_path = $this->saveImage($image, 'hotel');
                $hotel->images()->create(['image_path' => $image_path]);
            }
        }
        return back()->with('success', 'Images uploaded!');
    }



    // Hotel Room

    public function createRoom($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel.room.create', compact('hotel'));
    }

    public function saveRoom(Request $request, $id)
    {
        $params = $request->validate(config('settings.hotel.room_creation_validation_rules'));
        $hotelRoom = HotelRoom::create(['hotel_id' => $id] + $params);
        if ($request->file('images') != null) {
            foreach ($request->file('images') as $image) {
                $image_path = $this->saveImage($image, $hotelRoom->getUniqueName(), 'hotel/room');
                $hotelRoom->images()->create(['image_path' => $image_path]);
            }
        }
        return back()->with('success', 'Hotel room added successfully!');
    }

    public function updateRoom(Request $request, $id, $room_id)
    {
        $params = $request->validate(config('settings.hotel.room_creation_validation_rules'));
        $hotelRoom = HotelRoom::findOrFail($room_id);
        $hotelRoom->update($params);
        return back()->with('success', 'Hotel room updated successfully!');
    }


    public function deleteRoom($id, $room_id)
    {
        $hotel = HotelRoom::find($room_id);
        $hotel->delete();
        return back()->with('success', 'Hotel Room is deleted successfully!');
    }

    public function changeHotelStatus($id)
    {
        $hotel = Hotel::find($id);
        if ($hotel->enabled == 0) {
            $hotel->enabled = 1;
        } else {
            $hotel->enabled = 0;
        }
        $hotel->save();
        return back();
    }

    public function addImage($id, $room_id, Request $request)
    {
        $hotelRoom = HotelRoom::findOrFail($room_id);
        if ($request->file('images') != null) {
            foreach ($request->file('images') as $image) {
                $image_path = $this->saveImage($image, 'hotel/room');
                $hotelRoom->images()->create(['image_path' => $image_path]);
            }
        }
        return back()->with('success', 'Images uploaded!');
    }

    public function saveImage($image, $folder)
    {
        $unique_name = str_random(6);
        if ($image != null) {
            $name = $unique_name . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/' . $folder), $name);
            return asset('storage/' . $folder . '/' . $name);
        }
        return null;
    }

    public function reserve($hotel_id, Request $request)
    {
        $reservation_data = $request->get('reservation_data');
        $reletive  = $request->get('relative');
        $hotel = Hotel::with(['rooms'])->find($hotel_id);
        foreach(explode('|', $reservation_data) as $room_date){
            $room_date_arr = explode('~', $room_date);
            $room_id = $room_date_arr[0];
            $rate = $hotel->rooms->where('id', $room_id)->first()->rate;
            if($reletive == true)
                $rate = $hotel->rooms->where('id', $room_id)->first()->rate2;

            $reserved_date = $room_date_arr[1];
            Reservation::create(compact('hotel_id', 'room_id', 'reserved_date', 'rate'));
        }
        if(!empty($request->get('admin'))){
            return redirect()->route('reservation.index');
        }
        return redirect()->back()->with('success', 'Room reserved successfully');
    }
}
