@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h1>{{ $hotel->name }}</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Address</h4>
                                <p>{{ $hotel->full_address}}</p>
                                <h4>Contact Info</h4>
                                <p>{{ $hotel->contact_details }}</p>
                                <h4>Contract Details</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($hotel->rooms as $room)
            <div class="col-md-4 py-2">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h4>Room no: {{ $room->room_number }}</h4>
                        <hr>
                        <p>{{ $room->description }}</p>
                        <p>Maximum person allowed: {{ $room->max_person_allowed }}</p>
                        <p>Rate: {{ $room->rate }}</p>
                    </div>
                </div>

            </div>
            @endforeach
            <div class="col-md-4 py-2">
                <div class="card h-100">
                   <div class="card-body h-100 d-flex text-center">
                        <a href="{{ route('hotel.room.create', ['id' => $hotel->id]) }}"
                            class="btn btn-primary justify-content-center align-self-center">Add
                            Room</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection