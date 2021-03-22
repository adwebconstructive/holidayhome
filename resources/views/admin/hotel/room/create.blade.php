@extends('layouts.layout')

@section('subcontent')
<div class="padding">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h3>Create room for hotel {{ $hotel->name }}</h3>
                <hr>
                <form method="post" action="{{ route('hotel.room.store',$hotel->id) }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="contact_person">Room Number</label>
                            <input name="room_number" class="form-control" value="{{ old('room_number') }}"
                                placeholder="Room Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact_person">Description</label>
                            <input name="description" class="form-control" value="{{ old('description') }}"
                                placeholder="Description" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="contact_person">Room Type</label>
                            <input name="room_type" class="form-control" value="{{ old('room_type') }}"
                                placeholder="Room type" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="contact_person">Person Allowed</label>
                            <input type="number" name="person_allowed" class="form-control"
                                value="{{ old('person_allowed') }}" placeholder="Person allowed" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="max_person_allowed">Max Person Allowed</label>
                            <input type="number" name="max_person_allowed" class="form-control"
                                value="{{ old('max_person_allowed') }}" placeholder="max_person_allowed" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="max_person_allowed">Rate</label>

                            <input type="number" name="rate" class="form-control" value="{{ old('rate') }}"
                                placeholder="rate" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}"
                                placeholder="price" required>
                        </div>
                        <div class="form-group">
                            <label class="col-12">Image</label>
                            <input type="file" class="form-control-file" multiple name="images[]">
                        </div>
                    </div>
                    <div class="form-group col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection