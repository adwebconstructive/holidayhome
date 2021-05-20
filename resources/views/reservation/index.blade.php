@extends('layouts.layout')

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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rooms plus</h3>
                            {{--
                                                    <div class="card-tools">
                                                        <form action="{{route('hotels.index')}}" method="get">
                                                            <div class="input-group input-group-sm" style="width: 250px;">

                                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search by name">
                                                                <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-default">
                                                                        <i class="fas fa-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover reservations">
                                <thead>
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Reserved By</th>
                                    <th>Hotel</th>
                                    <th>Room No</th>
                                    <th>Reserved Date</th>
                                    <th>Rate</th>
                                    <th>Transaction</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $data)
                                    <tr>
                                        <td>{{$data->reservation_id}}</td>
                                        <td>{{$data->reserved_by}}</td>
                                        <td>{{$data->hotel->name}}</td>
                                        <td>{{ $data->room->room_number }}</td>
                                        <td>
                                            @foreach($data->reserved_dates as $date)
                                                {{ $date }} <br>
                                            @endforeach
                                        </td>
                                        <td>Rs. {{$data->rate}}</td>
                                        @if(empty($data->transaction_id))
                                            <td>Not Paid</td>
                                        @else
                                            <td>Paid</td>
                                        @endif
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{--                            {{ $reservations->links() }}--}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
