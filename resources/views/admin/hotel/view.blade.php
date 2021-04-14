@extends('layouts.layout')

@section('subcontent')

<div class="content-wrapper">
    <!-- /.row -->
    <section class="content-header">
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="text-success">{{ $hotel->name }}</h1>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Address</h4>
                                    <p>{{ $hotel->full_address}}</p>
                                    <h4>Contact Info</h4>
                                    <p>{{ $hotel->contact_details }}</p>
                                    <h4>Contract Details</h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        @foreach ($hotel->images as $image)
                                        <div class="col-md-4">
                                            <img class="" src="{{ $image->image_path }}"
                                                style="height: 150px" alt="Hotel image">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Create
                                Room</button>
                            <button class="btn btn-success" data-toggle="modal"
                                data-target="#uploadHotelImagesModal">Upload Image</button>
                        </div>
                    </div>
                    <div class="modal fade" id="uploadHotelImagesModal" tabindex="-1" role="dialog"
                        aria-labelledby="uploadHotelImagesModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                {!! Form::open(['url' => route('hotel.image'), 'files' => true])!!}
                                {!! Form::hidden('hotel_id', $hotel->id) !!}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="">Upload images hotel {{ $hotel->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="custom-file">
                                        <input type="file" name="images[]" class="custom-file-input" id="customFile"
                                            multiple>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                                {!! Form::close() !!}
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
                        <button class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#editModal{{$room->id}}">Edit Details</button>
                        <button class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#imageModal{{$room->id}}">Add Images</button>
                        <a class="btn btn-sm btn-danger confirm"
                            href="{{ route('hotel.room.delete', ['id' => $hotel->id, 'room_id' => $room->id]) }}">Delete
                            Room</a>
                    </div>
                </div>

                <div class="modal fade" id="editModal{{$room->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="editModal{{$room->id}}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!! Form::model($room, ['url' => route('hotel.room.update', ['id' => $hotel->id,
                            'room_id' =>
                            $room->id])]) !!}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit room details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="room_number">Room Number</label>
                                        {!! Form::text('room_number', null, ['class' => 'form-control',
                                        'placeholder' =>
                                        'Room Number', 'required']) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="max_person_allowed">Max Person Allowed</label>
                                        {!! Form::text('max_person_allowed', null, ['class' => 'form-control',
                                        'placeholder' => 'Max Person Allowed', 'required']) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="rate">Rate / Night</label>
                                        {!! Form::text('rate', null, ['class' => 'form-control', 'placeholder'
                                        =>'Rate',
                                        'required']) !!}
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Description</label>
                                        {!! Form::textarea('description', null, ['class' => 'form-control',
                                        'placeholder' =>
                                        'Description', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="imageModal{{$room->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="imageModal{{$room->id}}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!! Form::model($room, ['url' => route('hotel.room.image', ['id' => $hotel->id,
                            'room_id' =>
                            $room->id]), 'files' => true])
                            !!}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload images for room no:
                                    {{ $room->room_number }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="custom-file">
                                    <input type="file" name="images[]" class="custom-file-input" id="customFile"
                                        multiple>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        {!! Form::open(['url' => route('hotel.room.store', ['id' => $hotel->id])]) !!}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create room</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="room_number">Room Number</label>
                                    {!! Form::text('room_number', null, ['class' => 'form-control', 'placeholder' =>
                                    'Room Number', 'required']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="max_person_allowed">Max Person Allowed</label>
                                    {!! Form::text('max_person_allowed', null, ['class' => 'form-control',
                                    'placeholder' => 'Max Person Allowed', 'required']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rate">Rate / Night</label>
                                    {!! Form::text('rate', null, ['class' => 'form-control', 'placeholder' =>'Rate',
                                    'required']) !!}
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    {!! Form::textarea('description', null, ['class' => 'form-control',
                                    'placeholder' =>
                                    'Description', 'required']) !!}
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Room</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

@endsection