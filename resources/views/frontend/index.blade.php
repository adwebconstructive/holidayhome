@extends('frontend.layouts.layout')

@section('subcontent')

<!-- banner -->
<div class="banner" >    	   
    <img src="frontend/images/photos/banner.jpg"  class="img-responsive" alt="slide" style="max-height: 470px">
    <div class="welcome-message" >
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">Best hotel in India</h1>
                <p class="animated fadeInUp">Most luxurious hotel of asia with the royal treatments and excellent customer service.</p>                
            </div>
            {{-- <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a> --}}
        </div>
    </div>
</div>
<!-- banner-->


<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">
    <form role="form" method="get" action="{{url('check-available')}}" class="wowload fadeInRight">
        <div class="form-group col-md-3">
            <label>Hotel</label>
           <select class="form-control" name="hotel_id">
                <option>Select Hotel</option>
                @foreach ($hotels as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->name}}/{{$hotel->city}}</option>
                @endforeach
           </select>
        </div>     
        <div class="form-group col-md-3">
            <label>From date</label>
            <input type="date" class="form-control"  placeholder="From" name="from">
        </div>    
        <div class="form-group col-md-3">
            <label>To date</label>
            <input type="date" class="form-control"  placeholder="To" name="to">
        </div>  
       
        <div class="form-group col-md-3" style="margin-top: 1.4em">   
        <button class="btn btn-default">Check Availability</button>
        </div>
    </form>    
</div>
</div>  
</div>
</div>
<!-- reservation-information -->



<!-- services -->
<div class="spacer services wowload fadeInUp">
<div class="container">
    <div class="row">
        @foreach ($hotels as $hotel)
        <div class="col-sm-4">
            <!-- RoomCarousel -->
            <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="frontend/images/photos/8.jpg" class="img-responsive" alt="slide"></div>                
                <div class="item  height-full"><img src="frontend/images/photos/9.jpg"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="frontend/images/photos/10.jpg"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#RoomCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#RoomCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <!-- RoomCarousel-->
            <div class="caption">{{$hotel->name}} / {{$hotel->city}}<a href="rooms-tariff.php" class="pull-right"><i class="fa fa-bed"></i></a></div>
        </div>
        @endforeach
    </div>
</div>
</div>
<!-- services -->


@endsection