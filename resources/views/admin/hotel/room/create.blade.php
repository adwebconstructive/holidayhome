@extends('layouts.layout')

@section('subcontent')
<div class="padding">
    <div class="content-wrapper">
        <div class="box box-info">
            <h3>You are creating room for hotel {{ $hotel->name }}</h3>
            <br>
            <form method="post" action="{{ route('hotel.room.store',$hotel->id) }}" enctype="multipart/form-data" class="form-horizontal">
                <div class="box-body">
                    {{csrf_field()}}
                    <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
                    <div class="form-group">
                        <label for="contact_person" class="control-label col-sm-4">Room Number</label>
                        <div class="col-sm-8">
                            <input name="room_number" class="form-control" value="{{ old('room_number') }}" placeholder="Room Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="contact_person">Description</label>
                        <div class="col-sm-8">
                            <input name="description" class="form-control" value="{{ old('description') }}" placeholder="Description" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="contact_person">Room Type</label>
                        <div class="col-sm-8">
                            <input name="room_type" class="form-control" value="{{ old('room_type') }}" placeholder="Room type" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="contact_person">Person Allowed</label>
                        <div class="col-sm-8">
                            <input type="number" name="person_allowed" class="form-control" value="{{ old('person_allowed') }}" placeholder="Person allowed" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="max_person_allowed">Max Person Allowed</label>
                        <div class="col-sm-8">
                            <input type="number" name="max_person_allowed" class="form-control" value="{{ old('max_person_allowed') }}" placeholder="max_person_allowed" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="max_person_allowed">Rate</label>
                        <div class="col-sm-8">
                            <input type="number" name="rate" class="form-control" value="{{ old('rate') }}" placeholder="rate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="price">Price</label>
                        <div class="col-sm-8">
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" class="col-12">Image </label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" multiple name="images[]">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection