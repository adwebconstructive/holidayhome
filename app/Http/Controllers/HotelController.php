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
        $hotel->logo = $this->saveImage($request->file('logo'), $hotel->getUniqueName(), 'hotel');
        $hotel->save();
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
        $path = $this->saveImage($request->file('logo'), $hotel->getUniqueName(), 'hotel');
        $hotel->update($params + ['logo' => $path]);
        return back()->with('success', 'Hotel updated successfully!');
    }

    public function delete($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return back()->with('success', 'Hotel deleted successfully');
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

    public function addImage(Request $request, $id)
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
                $hotelImage->image_path =
                    ENV('APP_URL') . '/hotels/image/' . $name;
                $hotelImage->save();
            }
        }
        return back()->with('success', 'Hotel image added successfully');
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

    public function saveImage($image, $name, $folder)
    {
        if ($image != null) {
            $name = $name . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/' . $folder), $name);
            return asset('storage/' . $folder . '/' . $name);
        }
        return null;
    }
}
