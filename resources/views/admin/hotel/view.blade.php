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
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-primary">Room no: {{ $room->room_number }}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4 class="text-success">
                                    ₹{{ $room->rate }}/Night
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <p>{{ $room->description }}</p>
                        <p>Maximum person allowed: {{ $room->max_person_allowed }}</p>
                        <div class="row">
                            @foreach ($room->images as $image )
                            <div class="col-md-4">
                                <img class="card-img-top" src="{{ $image->image_path }}" alt="Card image cap">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-sm btn-primary">Edit Details</button>
                        <button class="btn btn-sm btn-success">Add Images</button>
                        <a class="btn btn-sm btn-danger confirm" href="#">Delete Room</a>
                    </div>
                </div>

            </div>
            @endforeach
            <div class="col-md-4 py-2">
                <div class="card h-100">
                    <div class="card-body h-100">
                        <form method="post" action="{{ route('hotel.room.store',$hotel->id) }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="contact_person">Room Number</label>
                                    <input name="room_number" class="form-control" value="{{ old('room_number') }}" placeholder="Room Number" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contact_person">Room Type</label>
                                    <input name="room_type" class="form-control" value="{{ old('room_type') }}" placeholder="Room type" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="contact_person">Description</label>
                                    <input name="description" class="form-control" value="{{ old('description') }}" placeholder="Description" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="contact_person">Person Allowed</label>
                                    <input type="number" name="person_allowed" class="form-control" value="{{ old('person_allowed') }}" placeholder="Person allowed" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="max_person_allowed">Max Person Allowed</label>
                                    <input type="number" name="max_person_allowed" class="form-control" value="{{ old('max_person_allowed') }}" placeholder="Max Person Allowed" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="max_person_allowed">Rate</label>
                                    <input type="number" name="rate" class="form-control" value="{{ old('Rate') }}" placeholder="Rate" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('Price') }}" placeholder="Price" required>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="col-md-12">Images</label>
                                    <input type="file" class="form-control-file" multiple name="images[]">
                                </div>
                            </div>
                            <div class="form-group col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Create Room</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection