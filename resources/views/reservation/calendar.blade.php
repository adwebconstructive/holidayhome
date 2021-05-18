@extends('layouts.layout')
<style>

    * {box-sizing: border-box;}
    ul {list-style-type: none;}


    .days {
        padding: 10px 0;
        background: #eee;
        margin: 0;
        width: 100%;
    }

    .days li {
        list-style-type: none;
        display: inline-block;
        width: 13.6%;
        text-align: center;
        margin-bottom: 5px;
        font-size:16px;

    }

    .days li span {
        display: table-cell;
        text-align: center;
        width: 200px
    }

    /* Add media queries for smaller screens */
    @media screen and (max-width:720px) {
        .weekdays li, .days li {width: 13.1%;}
    }

    @media screen and (max-width: 420px) {
        .weekdays li, .days li {width: 12.5%;}
        .days li .active {padding: 2px;}
    }

    @media screen and (max-width: 290px) {
        .weekdays li, .days li {width: 12.2%;}
    }
</style>
@section('subcontent')

    <div class="padding">
        <div class="content-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{route('reservation.create')}}" type="button" class="btn btn-info">
                        Reserve Room
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" style="overflow: auto;max-hight:400px">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="card-title">Reservations Details</h3>
                                </div>
                                <div class="col-md-8">
                                    <form method="get" action="{{route('reservation.index')}}">
                                        Select Month
                                        <select name="month" required>
                                            @foreach($month as $key=>$mo)
                                                <option value="{{$key+1}}" @if($selectedMonth == $key+1) selected @endif>{{$mo}}</option>
                                            @endforeach
                                        </select>


                                        Select Year
                                        <select name="year" required>
                                            @foreach($years as $key=>$mo)
                                                <option value="{{$mo}}" @if($selectedYear == $mo) selected @endif>{{$mo}}</option>
                                            @endforeach
                                        </select>
                                        <input type="submit" value="Search" class="btn btn-sm btn-info">
                                    </form>
                                    <div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            @foreach($hotels as $data)
                                <div class="row">
                                    <div class="col-md-12"><h3>{{$data->name}}</h3></div>
                                    @foreach($data->rooms as $room)
                                        <div class="col-md-12 p-2"><h4>{{$room->room_number}}</h4></div>


                                        <ul class="days">
                                            @for($i=1 ; $i <=31 ;$i++)

                                                <li>{{$i}}
                                                    @foreach($room->reservations as $res)
                                                        @if(\Carbon\Carbon::parse($res->reserved_date)->format('d') == $i && \Carbon\Carbon::parse($res->reserved_date)->format('m')== $selectedMonth)
                                                            <span>
                                                {{$res->reserved_by}} Test{{$i}} Name
                                               </span>
                                                        @endif
                                                    @endforeach

                                                </li>
                                            @endfor


                                        </ul>

                                    @endforeach
                                </div>
                            @endforeach
                            @if($hotels->count() == 0)
                                <h4>No Booking Available</h4>
                            @endif
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>

        </div>
@endsection
