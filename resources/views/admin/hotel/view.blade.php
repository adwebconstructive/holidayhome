@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
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
                <a href="{{ route('hotel.room.create', ['id' => $hotel->id]) }}" class="btn btn-primary">Add Room</a>
            </div>
        </div>
    </div>
</div>
@endsection