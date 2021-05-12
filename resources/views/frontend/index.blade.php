@extends('frontend.layouts.layout')

@section('subcontent')
    <div id="root">
        <!-- banner -->
        <div class="banner">
            <img src="{{ asset('plugins/frontend/images/photos/banner.jpg') }}" class="img-responsive" alt="slide" style="max-height: 350px">
            <div class="welcome-message">
                <div class="wrap-info">
                    <div class="information">
                        <h1 class="animated fadeInDown">PDCLERC</h1>
                        <p class="animated fadeInUp">PDCLERC Hotel Booking Portal</p>
                    </div>
                    {{--<a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i
                            class="fa fa-angle-down"></i></a>--}}
                </div>
            </div>
        </div>
        <h2 class="text-center text-success mt-2">Our Hotels</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="form-group col-md-4 col-sm-3 col-xs-12">
                    <label>From date</label>
                    <input type="date" class="form-control" placeholder="From" name="from" v-model="from">
                </div>
                <div class="form-group col-md-4 col-sm-3 col-xs-12">
                    <label>To date</label>
                    <input type="date" class="form-control" placeholder="To" name="to" v-model="to">
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="container">
            @foreach($hotels as $hotel)
                <div class="row mt-4 hotel-block">
                    <div class="col-md-4">
                        <img class="img-fluid w-100" src="{{ $hotel->bannerImage() }}" alt="">
                    </div>
                    <div class="col-md-8 row">
                        <div class="col-md-8">
                            <h2 class="text-primary m-0 p-0">{{ $hotel->name }} | <span
                                    class="text-muted">{{ $hotel->city }}</span></h2>
                            <p class="text-success">No of rooms: {{ $hotel->rooms->count() }}</p>
                            <p>{{ $hotel->full_address }}</p>
                            <p><i class="fa fa-phone-square"></i> {{ $hotel->contact_phone }} &nbsp;&nbsp; <i
                                    class="fa fa-envelope"></i> {{ $hotel->contact_email }}</p>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <br>
                            <p><i class="fa fa-clock-o"></i> Check In: {{ $hotel->check_in }}</p>
                            <p><i class="fa fa-clock-o"></i> Check Out: {{ $hotel->check_out }}</p>
                            <br>
                            <br>
                            <a class="btn btn-success" @click.prevent="availability({{ $hotel->id }})" href="#">Check
                                Availability</a>
                        </div>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
        <div id="information" class="spacer reserve-info ">
            <!-- services -->
            <div class="spacer services wowload fadeInUp">
                <div class="container">
                    <div class="padding-2">
                        <div class="row">
                            <div class="col-md-12 center head-1">Policies</div>
                            <div class="col-md-12">
                                <div class="center" style="font-size: 2em"><i class="fa fa-check-circle"
                                                                              aria-hidden="true"></i>
                                </div>
                                <ul>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        USER ACCOUNT IS STRICTLY RESERVED FOR WBPDCL EMPLOYEES ONLY TOWARDS BOOKING OF
                                        GUEST
                                        HOUSE
                                        FOR SELF AND/OR THEIR RELATIONS ON HIS SOLE DISCRETION AND RESPONSIBILITY.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        Booking is non-transferable.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        No Alteration of booking should be entertained by the club authority.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        Booking is strictly prohibited for any unmarried couple.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        Proper government photo Identity Cards must be produced by the Guests at the
                                        time of
                                        Check-in
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        Any kind of malpractice pertaining to booking by the guest(employee/outsider),
                                        if
                                        any, would
                                        be taken seriously by the Club Authority.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        Booking may cancel by us with prior Notice over phone/email/user’s account to
                                        the
                                        valuable
                                        Guest due to any unforeseen/unavoidable circumstance which is beyond our
                                        jurisdiction, if
                                        any arise. Only in that case full refund will be initiated and User will be duty
                                        bound to
                                        cooperate us concluding the fact as “Exceptional Matter”. Club Authority may
                                        help
                                        for
                                        rebooking depending upon availability of room to any of our Guest Houses.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>
                                        Club Authority shall not be held responsible for any
                                        loss/delay/overstay/cancellation due to
                                        natural calamity and unforeseen circumstance.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="center" style="font-size: 2em"><i class="fa fa-times-circle"
                                                                              aria-hidden="true"></i>
                                </div>
                                <div class="center head-1">Rules only for Mumbai Guest House</div>
                                <ul>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> Keys of the Room should be
                                        collected
                                        from
                                        Corp. Office submitting copy of Appointment Slip as provided from TATA Medical
                                        Centre.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> Key of the room would not be
                                        handed
                                        over to
                                        the Guest more than 3 working days before checkin date.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> Guest should return the key
                                        within 3
                                        working
                                        days after checkout date otherwise a penalty @Rs.50 should be borne for each
                                        calendar day.
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> Only one room should be allotted
                                        for
                                        each
                                        patient
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> Maximum 2(two) attendants per
                                        patient
                                        are
                                        allowed against one room.
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="center head-1">Cancellation Charges</div>
                                <ul>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> If cancelled more than 90 days
                                        before
                                        check-in: Nil
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i> If cancelled within 8-89 days
                                        before
                                        check-in: 50%
                                    </li>
                                    <li><i class="fa fa-check" aria-hidden="true"></i>If cancelled within 1-7 days
                                        before
                                        check-in:
                                        75%
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- services -->
@endsection

@section('js-code')
    <script>
        const app = new Vue({
            el: '#root',
            data: {
                from: null,
                to: null,
            },
            methods: {
                availability(hotel_id) {
                    if (this.from == null) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Please select from date',
                        })
                    }else if (this.to == null) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Please select to date'
                        })
                    }
                    else {
                        location.href = "{{ url('availability') }}" + "?hotel_id=" + hotel_id + "&from=" + this.from + "&to=" + this.to;
                    }
                }
            }
        })
    </script>
@endsection
