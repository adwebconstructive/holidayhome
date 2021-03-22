@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <!-- /.row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ $hotel->name }}</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Logo</h4>
                                <img src="{{ $hotel->logo}}" alt="Logo">
                            </div>
                            <div class="col-md-3">
                                <h4>Address</h4>
                                {{ $hotel->full_address}}
                            </div>
                            <div class="col-md-3">
                                <h4>Contact Info</h4>
                            </div>
                            <div class="col-md-3">
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