@extends('frontend.layouts.layout')

@section('subcontent')

<!-- banner -->
{{-- <div class="banner" >    	   
    <img src="frontend/images/photos/banner.jpg"  class="img-responsive" alt="slide" style="max-height: 470px">
    <div class="welcome-message" >
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">Best hotel in India</h1>
                <p class="animated fadeInUp">Most luxurious hotel of asia with the royal treatments and excellent customer service.</p>                
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>  --}}
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" style="max-height: 570px">
        @foreach($hotels as $hotel)
        <div class="carousel-item @if($loop->iteration == 1) active @endif">
            <img class="d-block w-100 banner" src="{{ $hotel->images->first()->image_path }}"
                alt="Second slide">
            <div class="absolute-div">
                <div class="carousel-caption agileits-banner-info">
                    <h1 class="banner-text">{{ $hotel->name }}</h1>
                    <h3 class="banner-text">{{ $hotel->city }}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- banner-->
<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
    <div class="padding-2">
        <div class="row">
            <form role="form" method="get" action="{{url('check-available')}}" class="home-form">
                <div class=" col-sm-1 col-xs-12"></div>
                <div class="col-sm-3 col-xs-12">
                    <label>Hotel</label>
                    <select class="form-control form-control-lg" name="hotel_id">
                        <option>Select Hotel</option>
                        @foreach ($hotels as $hotel)
                        <option value="{{$hotel->id}}">{{$hotel->name}}/{{$hotel->city}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-3 col-xs-12">
                    <label>From date</label>
                    <input type="date" class="form-control form-control-lg" placeholder="From" name="from">
                </div>
                <div class="form-group col-sm-3 col-xs-12">
                    <label>To date</label>
                    <input type="date" class="form-control form-control-lg" placeholder="To" name="to">
                </div>

                <div class="form-group  col-sm-2 col-xs-12" style="margin-top: 2em">
                    <button class="btn btn-default">Check Availability</button>
                </div>
            </form>
        </div>
    </div>
    <!-- reservation-information -->
    <!-- services -->
    <div class="spacer services wowload fadeInUp">
        <div class="padding-2">
            <div class="row">
                <div class="col-md-12 center head-1">Policies</div>
                <div class="col-md-6">
                    <div class="center" style="font-size: 2em"> <i class="fa fa-check-circle" aria-hidden="true"></i>
                        </i></div>

                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i>
                            USER ACCOUNT IS STRICTLY RESERVED FOR WBPDCL EMPLOYEES ONLY TOWARDS BOOKING OF GUEST HOUSE
                            FOR SELF AND/OR THEIR RELATIONS ON HIS SOLE DISCRETION AND RESPONSIBILITY.</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>
                            Booking is non-transferable.</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>
                            No Alteration of booking should be entertained by the club authority.</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i>
                            Booking is strictly prohibited for any unmarried couple.</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i>
                            Proper government photo Identity Cards must be produced by the Guests at the time of
                            Check-in</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i>
                            Any kind of malpractice pertaining to booking by the guest(employee/outsider), if any, would
                            be taken seriously by the Club Authority.</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i>
                            Booking may cancel by us with prior Notice over phone/email/user’s account to the valuable
                            Guest due to any unforeseen/unavoidable circumstance which is beyond our jurisdiction, if
                            any arise. Only in that case full refund will be initiated and User will be duty bound to
                            cooperate us concluding the fact as “Exceptional Matter”. Club Authority may help for
                            rebooking depending upon availability of room to any of our Guest Houses.</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i>
                            Club Authority shall not be held responsible for any loss/delay/overstay/cancellation due to
                            natural calamity and unforeseen circumstance. </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="center" style="font-size: 2em"> <i class="fa fa-times-circle" aria-hidden="true"></i>
                    </div>
                    <div class="center head-1">Rules only for Mumbai Guest House</div>
                    <ul>
                        <li> <i class="fa fa-check" aria-hidden="true"></i> Keys of the Room should be collected from
                            Corp. Office submitting copy of Appointment Slip as provided from TATA Medical Centre.</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i> Key of the room would not be handed over to
                            the Guest more than 3 working days before checkin date.</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i> Guest should return the key within 3 working
                            days after checkout date otherwise a penalty @Rs.50 should be borne for each calendar day.
                        </li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i> Only one room should be allotted for each
                            patient</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i> Maximum 2(two) attendants per patient are
                            allowed against one room.</li>
                    </ul>
                    <div class="center head-1">Cancellation Charges</div>
                    <ul>
                        <li> <i class="fa fa-check" aria-hidden="true"></i> If cancelled more than 90 days before
                            check-in: Nil</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i> If cancelled within 8-89 days before
                            check-in: 50%</li>
                        <li> <i class="fa fa-check" aria-hidden="true"></i>If cancelled within 1-7 days before check-in:
                            75%</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- services -->


@endsection