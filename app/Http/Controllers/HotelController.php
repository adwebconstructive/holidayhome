<?php

namespace App\Http\Controllers;

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
            $hotels = $hotels->where('name', 'like', $request['table_search'] . '%');
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
        $this->saveImage($hotel, $request->file('logo'));
        return back()->with('success', 'Hotel added successfully');
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
        $this->saveImage($hotel, $request->file('logo'));
        return back()->with('success', 'Hotel updated successfully');
    }

    public function delete($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return back()->with('success', 'Hotel deleted successfully');
    }

    public function createRoom($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel.room.create', compact('hotel'));
    }

    public function editRoomIndex($id)
    {
        $hotelRoom = HotelRoom::findOrFail($id);
        return view('admin.create-room', compact('hotelRoom'));
    }

    public  function moreView($id)
    {
        $hotel = Hotel::with('hotelRoom.roomImage', 'hotelImage')->where('id', $id)->first();
        return view('admin.add-more', compact('hotel'));
    }

    public  function addImage(Request $request, $id)
    {

        if (!empty($request['images'])) {
            foreach ($request['images'] as $img) {
                $hotelImage = new HotelImage();

                $name = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = public_path('/hotels/image');
                $img->move($destinationPath, $name);

                if (!empty($request['room_id'])) {
                    $hotelImage->room_id = $request['room_id'];
                }
                $hotelImage->hotel_id = $id;
                $hotelImage->image_path = ENV('APP_URL') . '/hotels/image/' . $name;
                $hotelImage->save();
            }
        }
        return back()->with('success', 'Hotel image added successfully');
    }

    public  function addRoom(Request $request, $id)
    {

        $this->validate($request, [
            'room_number' => 'required|string',
            'hotel_id' => 'required|integer',
            'description' => 'required|string',
            'room_type' => 'required|string',
            'person_allowed' => 'required|integer',
            'max_person_allowed' => 'required|integer',
            'rate' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $hotelRoom = HotelRoom::create($request->all());

        if (!empty($request['images'])) {
            foreach ($request['images'] as $img) {
                $hotelImage = new HotelImage();
                $name = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = public_path('/hotels/image');
                $img->move($destinationPath, $name);
                $hotelImage->room_id = $hotelRoom->id;
                $hotelImage->hotel_id = $id;
                $hotelImage->image_path = ENV('APP_URL') . '/hotels/image/' . $name;
                $hotelImage->save();
            }
        }

        return back()->with('success', 'Hotel  added successfully');
    }

    protected  function  roomUpdate(Request  $request, $id)
    {
        $this->validate($request, [
            'room_number' => 'required|string',
            'id' => 'required|integer',
            'description' => 'required|string',
            'room_type' => 'required|string',
            'person_allowed' => 'required|integer',
            'max_person_allowed' => 'required|integer',
            'rate' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $hotelRoom = HotelRoom::find($id);
        $hotelRoom->hotel_id = $request['id'];
        $hotelRoom->room_number = $request['room_number'];
        $hotelRoom->description = $request['description'];
        $hotelRoom->room_type = $request['room_type'];
        $hotelRoom->person_allowed = $request['person_allowed'];
        $hotelRoom->max_person_allowed = $request['max_person_allowed'];
        $hotelRoom->rate = $request['rate'];
        $hotelRoom->price = $request['price'];


        $hotelRoom->save();
        if (!empty($request['images'])) {
            foreach ($request['images'] as $img) {
                $hotelImage = new HotelImage();
                $name = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = public_path('/hotels/image');
                $img->move($destinationPath, $name);
                $hotelImage->room_id = $hotelRoom->id;
                $hotelImage->hotel_id = $id;
                $hotelImage->image_path = ENV('APP_URL') . '/hotels/image/' . $name;
                $hotelImage->save();
            }
        }
        return back()->with('success', 'Hotel room updated successfully');
    }

    public  function  deleteRoom($id)
    {
        $hotel = HotelRoom::find($id);
        $hotel->deleted_at = now();
        $hotel->save();
        return back()->with('success', 'Hotel Room is deleted successfully');
    }


    public function changeHotelStatus($id)
    {
        $hotel = Hotel::find($id);
        if ($hotel->enabled == 0)
            $hotel->enabled = 1;
        else
            $hotel->enabled = 0;
        $hotel->save();
        return back();
    }



    public function imageDelete($id)
    {
        HotelImage::where('id', $id)->delete();

        return back();
    }

    public function saveImage($hotel, $image)
    {
        if ($image != null) {
            $uniqueName = $hotel->getUniqueName();
            $name = $uniqueName . "." . $image->getClientOriginalExtension();
            $destinationPath = public_path("/hotels/$uniqueName");
            $image->move($destinationPath, $name);
            $hotel->logo = asset("hotels/$uniqueName/$name");
            $hotel->save();
        }
    }
}
