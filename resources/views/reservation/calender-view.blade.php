@extends('layouts.layout')
@section('subcontent')
    <div class="padding" id="app">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <form method="get" action="{{route('reservation.calender.search')}}">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <select name="hotel" required class="form-control">
                                    @foreach($hotels as $hotel)
                                        @if(!empty($selected))
                                            <option value="{{$hotel->id}}"
                                                    @if($selected->id == $hotel->id) selected @endif>{{$hotel->name}} / {{ $hotel->city }}</option>
                                        @else
                                            <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <select name="month" required class="form-control">
                                    <option value="1" @if($selectedMonth == 1) selected @endif>JAN</option>
                                    <option value="2" @if($selectedMonth == 2) selected @endif>FEB</option>
                                    <option value="3" @if($selectedMonth == 3) selected @endif>MAR</option>
                                    <option value="4" @if($selectedMonth == 4) selected @endif>APR</option>
                                    <option value="5" @if($selectedMonth == 5) selected @endif>MAY</option>
                                    <option value="6" @if($selectedMonth == 6) selected @endif>JUN</option>
                                    <option value="7" @if($selectedMonth == 7) selected @endif>JUL</option>
                                    <option value="8" @if($selectedMonth == 8) selected @endif>AUG</option>
                                    <option value="9" @if($selectedMonth == 9) selected @endif>SEP</option>
                                    <option value="10" @if($selectedMonth == 10) selected @endif>OCT</option>
                                    <option value="11" @if($selectedMonth == 11) selected @endif>NOV</option>
                                    <option value="12" @if($selectedMonth == 12) selected @endif>DEC</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <select name="year" required class="form-control">
                                    <option value="2021" @if($selectedYear == "2021") selected @endif>2021
                                    </option>
                                    <option value="2022" @if($selectedYear == "2022") selected @endif>2022
                                    </option>

                                    <option value="2023" @if($selectedYear == "2023") selected @endif>2023
                                    </option>

                                    <option value="2024" @if($selectedYear == "2024") selected @endif>2024
                                    </option>
                                    <option value="2025" @if($selectedYear == "2025") selected @endif>2025
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="View Calendar" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            @if(!empty($selected))
                <h2 class="text-center m-4 text-primary">{{$selected->name}}</h2>
                @foreach($selected->rooms as $room)
                    <div class="card">
                        <div class="card-body">
                            <h3 class="p-2">Room no: {{$room->room_number}} <span class=" text-success float-right"> {{ $room->rate }} / Night</span></h3>
                            <hr>
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
                                            @if(in_array($day->format('Y-m-d'), $reservations)) disable @endif">
                                        <span class="weekday">{{ $day->format('l') }}</span>
                                        <span class="day">{{$day->format('d')}}</span>
                                        <span class="month">{{$day->format('M')}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <br>
            @endif
        </div>
    </div>
@endsection
@if(!empty($selected))
@section('js-code')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                from: moment('{{ $startDate }}', 'YYYY-MM-DD'),
                to: moment('{{ $endDate }}', 'YYYY-MM-DD'),
                date_array: [],
                reservations: @json($reservations),
                hotel_id: "{{ $selected->id }}",
            },
            computed: {},
            methods: {
                toggleDateSelect(value) {
                    if (this.date_array.includes(value)) {
                        const index = this.date_array.indexOf(value);
                        if (index > -1) {
                            this.date_array.splice(index, 1);
                        }
                    } else {
                        this.date_array.push(value);
                    }
                }
            },
        });
    </script>

@endsection
@endif
