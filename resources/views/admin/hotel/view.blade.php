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
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="text-primary">Room no: {{ $room->room_number }}</h4>
                        <hr>
                        <p>{{ $room->description }}</p>
                        <p>Maximum person allowed: {{ $room->max_person_allowed }}</p>
                        <p>Rate: {{ $room->rate }}</p>
                        <div class="row">
                            @foreach ($room->images as $image )
                            <div class="col-md-4">
                                <img class="card-img-top" src="{{ $image->image_path }}" alt="Card image cap">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
            <div class="col-md-4 py-2">
                <div class="card h-100">
                    <div class="card-body h-100 d-flex text-center">
                        <a href="{{ route('hotel.room.create', ['id' => $hotel->id]) }}" class="btn btn-primary justify-content-center align-self-center">Add
                            Room</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection