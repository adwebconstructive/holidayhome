@extends('frontend.layouts.layout')

@section('subcontent')
<!-- reservation-information -->
<div id="app">
    <div id="information" class="spacer reserve-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <form role="form" method="get" action="{{ url('availability') }}" class="home-form">
                        <div class="form-group col-md-3">
                            <label>Hotel</label>
                            <select class="form-control" name="hotel_id" v-model="selected_id">
                                @foreach ($hotels as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->name}}/{{$hotel->city}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>From date</label>
                            <input type="date" class="form-control" name="from" value="{{$input['from']}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>To date</label>
                            <input type="date" class="form-control" name="to" value="{{$input['to']}}">
                        </div>

                        <div class="form-group col-md-3 mt-4">
                            <button class="btn btn-primary">Check Availability</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12">
                    <hr>
                    <h1 class="text-center mt-4 mb-0">{{$selected->name}}</h1>
                    <h2 class="text-center mt-0">CheckIn: {{$selected->check_in_time}} Check out:
                        {{$selected->check_out_time}}
                    </h2>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-9 col-md-9 col-xs-12 mt-2">
                    @foreach ($selected->rooms as $key=> $room)
                   
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
                                            <div class="head-1">Room No: {{$room->room_number}} </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <h3 class="head-1 text-success">₹ {{$room->rate}}/Night </h3>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="head-2">Description: {{$room->description}} </div>
                                            <div class="head-2">Person Allowed: {{$room->max_person_allowed}} </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @foreach($dateRange as $day)

                                        @foreach($reservations as $data)
                                        <?php $disable = null ?>
                                        @if($data['room_id'] == $room->id)
                                            @if( date('Y-m-d', strtotime($day)) == date('Y-m-d', strtotime($data['reservation_date'])))
                                            <?php $disable = "disable"; break; ?> 
                                            @endif 
                                        @endif 
                                        @endforeach 
                                        <div class="box-cal">
                                            <div v-if="date_array.includes('{{ date('Y-m-d', strtotime($day))}}|{{$room->id}}')" class="">
                                                <i class="fa fa-check " style="display: -webkit-inline-box;
                                                position: absolute;
                                                z-index: 1;
                                                font-size: 26px;
                                                color: #242b04;" aria-hidden="true"></i>
                                            </div>


                                            <span @if(!empty( $disable)) class="disabled" @endif>
                                                <div class="date-as-calendar position-pixels @if(!empty( $disable)) disable @endif" v-on:click="getDate('{{  date('Y-m-d', strtotime($day))}}|{{$room->id}}','{{$room->rate}}','{{$room->room_number}}','{{date('Y-m-d', strtotime($day))}}')">
                                                    <span class="day">{{Carbon\Carbon::parse($day)->format('d')}}</span>
                                                    <span class="month">{{Carbon\Carbon::parse($day)->format('M')}}</span>
                                                </div>
                                            </span>
                                        </div>
                                       
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                @endforeach
                </div>
                <div class="col-sm-3 col-md-3 c0l-xs-12 mt-2">
                    <div class="block">
                        <div class="pull-right txt-20">
                            <div v-if="total">
                                <div v-for="data in selected_data" :key="data.day">
                                    <br>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>  @{{data.date}}
                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                    <br>
                                    <br>
                                    Room : @{{data.number}}
                                    <br>
                                    
                                    <br>
                                </div>
                                <hr>
                                Payable : ₹ @{{total}} 
                            </div>
                            <div v-else>Not select any room</div>
                            <br>
                            <form v-if="total>0" method="POST" action="{{route('reservation.store')}}">
                                {{csrf_field()}}
                                <input type="hidden"  v-model="selected_id" name="hotel_id">

                                <div v-for="data in selected_data" :key="data.day">
                                    <input type="hidden"  v-model="data.dateID" name="room_info[]">
                                </div>
                                <input type="submit" class="btn btn-primary" value="Procced to Pay">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
    const app = new Vue({
        el: '#app',
        data: {
            total: 0,
            date_array: [],
            reservations_data: {},
            selected_id: "{{ $selected->id }}",
            selected_data:[],
        },
        methods: {
            getDate: function(dayWithID, value,room_number,day) {
                if (this.date_array.includes(dayWithID)) {
                    this.total = eval(this.total) - eval(value)
                    this.date_array.splice(this.date_array.indexOf(dayWithID), 1);
                    this.selected_data.splice(this.selected_data.indexOf(dayWithID), 1);
                } else {
                    this.total = eval(this.total) + eval(value)
                    this.date_array.push(dayWithID);
                    let val= {}
                    val.number = room_number
                    val.date = day
                    val.dateID = dayWithID
                    this.selected_data.push(val);
                    console.log(this.selected_data);
                }
            },
        }
    });
</script>

@endsection