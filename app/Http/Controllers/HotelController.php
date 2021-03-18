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
        $hotels = Hotel::whereNull('deleted_at');
        if(!empty($request['table_search'])){
            $hotels = $hotels->where('name','like',$request['table_search'].'%');
        }
        $hotels = $hotels->paginate(config('app.variable.page_size'));
        return view('admin.hotel',compact('hotels'));

    }

    public function create()
    {
        return view('admin.create-hotel');
    }

    public function edit($id)
    {
        $hotel= Hotel::find($id);
        return view('admin.create-hotel',compact('hotel'));
    }

    public function roomIndex($id)
    {
        $hotel= Hotel::find($id);
        return view('admin.create-room',compact('hotel'));

    }

    public function editRoomIndex($id)
    {
        $hotelRoom= HotelRoom::find($id);
        return view('admin.create-room',compact('hotelRoom'));

    }

    public function store(Request $request)
    {
         $this->validate($request,[
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required',
            'country' => 'required',
            'pin_code' => 'required|integer',
            'contact_person' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|min:10|string',
        ]);

        $hotel= Hotel::create($request->all());
      

        if(!empty($request['logo'])){
            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/hotels/logo');
            $image->move($destinationPath, $name);

            $hotel->logo = ENV('APP_URL').'/hotels/logo/'.$name;

        }
        $hotel->save();

        return back()->with('success','Hotel added successfully');
    }

    public function updateHotel(Request $request, $id){

        $this->validate($request,[
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required',
            'country' => 'required',
            'pin_code' => 'required|integer',
            'contact_person' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|min:10|string',
        ]);

        $hotel= Hotel::find($id);
        $hotel->name= $request['name'];
        $hotel->address= $request['address'];
        $hotel->city= $request['city'];
        $hotel->state= $request['state'];
        $hotel->country= $request['country'];
        $hotel->pin_code= $request['pin_code'];
        $hotel->gstn= $request['gstn'];
        $hotel->contact_person= $request['contact_person'];
        $hotel->contact_email= $request['contact_email'];
        $hotel->contact_phone= $request['contact_phone'];

        if(!empty($request['logo'])){
            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/hotels/logo');
            $image->move($destinationPath, $name);

            $hotel->logo = ENV('APP_URL').'/hotels/logo/'.$name;

        }
        $hotel->enabled = 1;
        $hotel->save();

        return back()->with('success','Hotel updated successfully');
    }

    public  function  deleteHotel($id){
        $hotel = Hotel::find($id);
        $hotel->deleted_at = now();
        $hotel->save();
        return back()->with('success','Hotel deleted successfully');
    }

    public  function moreView($id){
        $hotel = Hotel::with('hotelRoom.roomImage','hotelImage')->where('id',$id)->first();
        return view('admin.add-more',compact('hotel'));
    }

    public  function addImage(Request $request,$id){

        if(!empty($request['images'])){
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
        return back()->with('success','Hotel image added successfully');
    }

    public  function addRoom(Request $request,$id){

        $this->validate($request,[
            'room_number' => 'required|string',
            'hotel_id' => 'required|integer',
            'description' => 'required|string',
            'room_type' => 'required|string',
            'person_allowed' => 'required|integer',
            'max_person_allowed' => 'required|integer',
            'rate' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $hotelRoom= HotelRoom::create($request->all());
        
        if(!empty($request['images'])){
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

        return back()->with('success','Hotel  added successfully');
    }

    protected  function  roomUpdate(Request  $request,$id){
        $this->validate($request,[
            'room_number' => 'required|string',
            'id' => 'required|integer',
            'description' => 'required|string',
            'room_type' => 'required|string',
            'person_allowed' => 'required|integer',
            'max_person_allowed' => 'required|integer',
            'rate' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $hotelRoom= HotelRoom::find($id);
        $hotelRoom->hotel_id= $request['id'];
        $hotelRoom->room_number= $request['room_number'];
        $hotelRoom->description= $request['description'];
        $hotelRoom->room_type= $request['room_type'];
        $hotelRoom->person_allowed= $request['person_allowed'];
        $hotelRoom->max_person_allowed= $request['max_person_allowed'];
        $hotelRoom->rate= $request['rate'];
        $hotelRoom->price= $request['price'];


        $hotelRoom->save();
        if(!empty($request['images'])){
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
        return back()->with('success','Hotel room updated successfully');
    }

    public  function  deleteRoom($id){
        $hotel = HotelRoom::find($id);
        $hotel->deleted_at = now();
        $hotel->save();
        return back()->with('success','Hotel Room is deleted successfully');
    }


    public function changeHotelStatus($id){
        $hotel= Hotel::find($id);
        if($hotel->enabled == 0)
            $hotel->enabled = 1;
        else
            $hotel->enabled = 0;
        $hotel->save();
        return back();
    }



     public function imageDelete($id){
        HotelImage::where('id',$id)->delete();

        return back();
    }



}
