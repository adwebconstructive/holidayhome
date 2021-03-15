<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hotels = \App\Models\Hotel::whereNull('deleted_at');
        if(!empty($request['table_search'])){
            $hotels = $hotels->where('name','like',$request['table_search'].'%');
        }
        $hotels = $hotels->paginate(30);
        return view('admin.hotel',compact('hotels'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $hotel= new \App\Models\Hotel();
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

        $hotel->save();

        return back()->with('success','Hotel added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $id)
//    {
//
//    }

    public function updateHotel(Request $request, $id){
        $hotel= \App\Models\Hotel ::find($id);
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

        $hotel->save();

        return back()->with('success','Hotel updated successfully');
    }

    public  function  deleteHotel($id){
        $hotel = \App\Models\Hotel ::find($id);
        $hotel->deleted_at = now();
        $hotel->save();
        return back()->with('success','Hotel deleted successfully');
    }

    public  function moreView($id){
        $hotel = \App\Models\Hotel ::with('hotelRoom.roomImage','hotelImage')->where('id',$id)->first();
        return view('admin.add-more',compact('hotel'));
    }

    public  function addImage(Request $request,$id){

        if(!empty($request['images'])){
            foreach ($request['images'] as $img) {
                $hotelImage = new \App\Models\HotelImage();

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

        $hotelRoom= new \App\Models\HotelRoom();
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
                $hotelImage = new \App\Models\HotelImage();
                $name = time() . '.' . $img->getClientOriginalExtension();
                $destinationPath = public_path('/hotels/image');
                $img->move($destinationPath, $name);
                $hotelImage->room_id = $hotelRoom->id;
                $hotelImage->hotel_id = $id;
                $hotelImage->image_path = ENV('APP_URL') . '/hotels/image/' . $name;
                $hotelImage->save();
            }
        }

        return back()->with('success','Hotel image added successfully');
    }

    public function changeHotelStatus($id){
        $hotel= \App\Models\Hotel ::find($id);
        if($hotel->enabled == 0)
            $hotel->enabled = 1;
        else
            $hotel->enabled = 0;
        $hotel->save();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//
//    }
}
