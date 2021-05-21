@extends('frontend.layouts.layout')

@section('subcontent')
    <!-- reservation-information -->
    <div id="app">
        <div id="information" class="spacer reserve-info">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <form role="form" method="get" action="{{ url('availability') }}" class="home-form">
                            <div class="form-group col-md-4">
                                <label>Select Hotel</label>
                                <select class="form-control" name="hotel_id" v-model="hotel_id">
                                    @foreach ($hotels as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->name}}/{{$hotel->city}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Check In - Check out</label>
                                <input type="text" class="form-control daterange" name="from"
                                       value="{{$input['from']}}">
                                <input type="hidden" name="from" v-model="from">
                                <input type="hidden" name="to" v-model="to">
                            </div>
                            <div class="form-group col-md-4 mt-4">
                                <button class="btn btn-primary">Check Availability</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <hr>
                        <h1 class="text-center mt-4 mb-0">{{$selected->name}}</h1>
                        <h2 class="text-center mt-0">CheckIn: {{$selected->check_in}} | Check out:
                            {{$selected->check_out}}
                        </h2>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-3 mt-3">
                        <div class="custom-control">
                           
                                <input type="checkbox" v-model="reletive" @change=changeRate()>
                                For Relative
                           
                          </div>
                    </div>
                    @foreach ($selected->rooms as $room)
                        <div class="col-sm-12 col-md-12 mt-2">
                            <div class="block">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($room->images as $key=>$image)
                                                    <div class="carousel-item @if($loop->iteration == 1) active @endif"
                                                         data-interval="10000">
                                                        <img src="{{$image->image_path}}" class="img-responsive"
                                                             alt="slide">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleInterval"
                                               role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleInterval"
                                               role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="head-1">Room No: {{$room->room_number}} </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h3 class="head-1 rate text-success">₹ {{$room->rate}}/Night </h3>
                                                <h3 class="head-1 rate2 text-success">₹ {{$room->rate2}}/Night </h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="head-2">Description: {{$room->description}} </div>
                                                <div class="head-2">Person Allowed: {{$room->max_person_allowed}} </div>
                                            </div>
                                            <div class="col-md-12">
                                                @foreach($dateRange as $day)
                                                    <div class="box-cal">
                                                        <div
                                                            class="overlay d-flex align-items-center justify-content-center"
                                                            v-if="reservations.includes('{{ $room->id.'~'.$day->format('Y-m-d') }}')">
                                                            <i class="fa fa-ban text-danger" style="font-size: 2em"></i>
                                                        </div>
                                                        <i class="fa fa-check-circle date-check"
                                                           v-show="date_array.includes('{{ $room->id.'~'.$day->format('Y-m-d') }}')"></i>
                                                        <div class="date-as-calendar position-pixels
                                                                    @if(in_array($day->format('Y-m-d'), $reservations)) disable @endif"
                                                             @click="toggleDateSelect('{{ $room->id.'~'.$day->format('Y-m-d') }}')">
                                                            <span class="weekday">{{ $day->format('l') }}</span>
                                                            <span class="day">{{$day->format('d')}}</span>
                                                            <span class="month">{{$day->format('M')}}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <h3 class="m-0 head-1 text-primary">Total: <span v-text="getRoomTotal({{ $room->id }})"></span>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12 text-right">
                        <br>
                        <br>
                        {!! Form::open(['url' => route('hotel.reserve', ['id' => $selected->id]), 'class' => 'confirm']) !!}
                        <input type="hidden" name="reservation_data" :value="reservation_data">
                        <input type="hidden" name="relative" value="@{{reletive}}">
                        <button type="submit" class="btn pay-button"> Book and Pay ₹@{{ total }}</button>
                        {!! Form::close() !!}
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-code')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                from: moment('{{ $input['from'] }}', 'YYYY-MM-DD'),
                to: moment('{{ $input['to'] }}', 'YYYY-MM-DD'),
                rates: @json($selected->rates()),
                rates2: @json($selected->rates2()),
                date_array: [],
                reservations: @json($reservations),
                hotel_id: "{{ $selected->id }}",
                reletive:false,
            },
            computed: {
                reservation_data() {
                    return this.date_array.join('|');
                },
                total() {
                    return this.date_array.reduce((total = 0, item) => {
                        let room_id = item.split("~")[0];
                        if(this.reletive == false){
                            let rate = app.rates[room_id];
                            return total + rate;
                        }
                        else{
                            let rate = app.rates2[room_id];
                            return total + rate;
                        }
                    }, 0);
                }
            },
            methods: {
                getRoomTotal(room_id) {
                    let entries = this.date_array.filter((item) => {
                        let id = item.split("~")[0];
                        return parseInt(room_id) === parseInt(id);
                    });
                    if(this.reletive == false){
                        return entries.length * this.rates[room_id];
                    }
                    else{
                        return entries.length * this.rates2[room_id];
                    }
                },
                toggleDateSelect(value) {
                    if (this.date_array.includes(value)) {
                        const index = this.date_array.indexOf(value);
                        if (index > -1) {
                            this.date_array.splice(index, 1);
                        }
                    } else {
                        this.date_array.push(value);
                    }
                },
                changeRate(){
                   if(this.reletive == true){
                        $(".rate").hide();
                        $(".rate2").show();
                   }
                   else{
                        $(".rate2").hide();
                        $(".rate").show();
                   }
                }
            },
            created() {
                $(document).ready(() => {
                    $(".rate2").hide()

                    $(".daterange").daterangepicker({
                        locale: {
                            format: 'DD-MMM-YYYY'
                        },
                        startDate: moment('{{ $input['from'] }}', 'YYYY-MM-DD'),
                        endDate: moment('{{ $input['to'] }}', 'YYYY-MM-DD'),
                        minDate: moment().add(1, 'days'),
                        maxDate: moment().add(90, 'days')
                    }, function (start, end, label) {
                        app.from = start.format('YYYY-MM-DD');
                        app.to = end.format('YYYY-MM-DD');
                    });
                });
            }
        });
    </script>

@endsection
