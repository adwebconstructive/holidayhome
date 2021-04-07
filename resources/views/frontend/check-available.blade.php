@extends('frontend.layouts.layout')

@section('subcontent')


<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">
    <form role="form" class="wowload fadeInRight">
        <div class="form-group col-md-3">
            <label>Hotel</label>
           <select class="form-control">
                <option>Select Hotel</option>
                @foreach ($hotels as $hotel)
                    <option value="{{$hotel->id}}" @if($input['hotel_id'] == $hotel->id ) selected @endif>{{$hotel->name}}/{{$hotel->city}}</option>
                @endforeach
           </select>
        </div>     
        <div class="form-group col-md-3">
            <label>From date</label>
            <input type="date" class="form-control"  value="{{$input['from']}}">
        </div>    
        <div class="form-group col-md-3">
            <label>To date</label>
            <input type="date" class="form-control"  value="{{$input['to']}}">
        </div>  
       
        <div class="form-group col-md-3" style="margin-top: 1.4em">   
        <button class="btn btn-default">Check Availability</button>
        </div>
    </form>  
  
</div>
<div class="col-sm-12 col-md-12">
    <h2 class="ml-1">Available Room</h2>
</div>
@foreach ($rooms as $room)
<div class="col-sm-12 col-md-12">
  <div class="block">
    

    </div>
</div>
@endforeach
</div>  
</div>
</div>


@endsection