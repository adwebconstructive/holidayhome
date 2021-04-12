@extends('frontend.layouts.layout')

@section('subcontent')


<!-- reservation-information -->
<div id="app">
<div id="information" class="spacer reserve-info ">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">
    <form role="form" method="get" action="{{url('check-available')}}" class="home-form">
        <div class="form-group col-md-3">
            <label>Hotel</label>
            <select class="form-control form-control-lg" name="hotel_id">
                <option>Select Hotel</option>
                @foreach ($hotels as $hotel)
                    <option value="{{$hotel->id}}" @if($input['hotel_id'] == $hotel->id ) selected @endif>{{$hotel->name}}/{{$hotel->city}}</option>
                @endforeach
           </select>
        </div>     
        <div class="form-group col-md-3">
            <label>From date</label>
            <input type="date" class="form-control"  name="from" value="{{$input['from']}}">
        </div>    
        <div class="form-group col-md-3">
            <label>To date</label>
            <input type="date" class="form-control"  name="to" value="{{$input['to']}}">
        </div>  
       
        <div class="form-group col-md-3" style="margin-top: 1.4em">   
        <button class="btn btn-default">Check Availability</button>
        </div>
    </form>  
  
</div>
<hr>
<div class="col-sm-12 col-md-12">
    <br>
    <span class="head-1"> {{$hotel->name}}</span> <span class="head-2">CheckIn:  {{$hotel->check_in_time}}</span><span class="head-2"> Check out: {{$hotel->check_out_time}} </span>
</div>
<div class="col-sm-12 col-md-12">
    <h2  class="head-1">Available Room</h2>
</div>
@foreach ($rooms as $room)
<div class="col-sm-12 col-md-12">
  <div class="block">
      <div class="row">
        <div class="col-md-4">
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($room->images as $key=>$image)
                    <div class="carousel-item @if($key == 0) active @endif" data-interval="10000">
                        <img src="{{$image->image_path}}" class="img-responsive" alt="slide">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div> 
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="head-1">{{$room->room_number}}  </div>
                     
                    <div class="head-2">Person Allowed: {{$room->max_person_allowed}} </div> 
                    <div class="head-2">Price: ₹ {{$room->rate}}/Night </div>      

                </div>
                <div class="col-md-6">
                    <div class="head-2">Description: {{$room->description}} </div>  
                    
                     
                </div>
                
            </div>
            <div class="col-md-12">
                @foreach($dateRange as $day)
                <div class="box-cal">
                <div v-if="date_array.includes('{{$day}}')" class="">
                    <i class="fa fa-check " style="display: -webkit-inline-box;
                    position: absolute;
                    z-index: 1;
                    font-size: 26px;
                    color: #242b04;" aria-hidden="true"></i>
                </div>
                <a href="#">
                    <div class="date-as-calendar position-pixels" v-on:click="getDate('{{ $day}}','{{$room->rate}}')" >
                        <span class="day">{{Carbon\Carbon::parse($day)->format('d')}}</span>
                        <span class="month">{{Carbon\Carbon::parse($day)->format('M')}}</span>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
            <div class="col-md-12">
                <br>
                <div class="pull-right txt-20">
                    <span v-if="total">₹ @{{total}} </span>
                    <span v-else>₹ {{$room->rate}}</span>
                    <input type="submit" class="btn btn-default" value="Book Now"> 
                </div>
           </div>
        </div>
      </div>

  </div>
</div>
@endforeach
</div>  
</div>
</div>
</div>
<script>
 new Vue({
    el: '#app',
    data: {
        date_array:[],
        total:'',
      },
      methods:{
            getDate: function (day,value) {
                this.total= {{$room->rate}}
                if(this.date_array.includes(day)){
                    this.date_array.splice(this.date_array.indexOf(day), 1);
                }
                else{
                    this.date_array.push(day);
                    
                }
                if(this.date_array.length != 0){
                    this.total = value * this.date_array.length;
                }
                else{
                    this.total = value
                }
                console.log(this.date_array);
                return;
            },
        }
}); 
</script>

@endsection