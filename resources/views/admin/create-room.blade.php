
@extends('layouts.layout')

@section('subcontent')
<div class="padding">
    <div class="content-wrapper">
         @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
             @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        @if(empty($hotelRoom))
            <form  method="post" action="{{route('add.hotel.room',$hotel->id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
                <input type="hidden" name="hotel_id" value="{{$hotel->id}}">

        <div class="row">
            <div class="form-group col-6">
                <label for="contact_person">Room Number</label>
                <input name="room_number" class="form-control" value="{{ old('room_number') }}" placeholder="Room Number" required>
            </div>
            <div class="form-group col-6">
                <label for="contact_person">Description</label>
                <input name="description" class="form-control" value="{{ old('description') }}" placeholder="Description" required>
            </div>
            <div class="form-group col-6">
                <label for="contact_person">Room Type</label>
                <input name="room_type" class="form-control" value="{{ old('room_type') }}" placeholder="Room type" required>
            </div>
            <div class="form-group col-6">
                <label for="contact_person">Person Allowed</label>
                <input type="number" name="person_allowed" class="form-control" value="{{ old('person_allowed') }}" placeholder="Person allowed" required>
            </div>
            <div class="form-group col-6">
                <label for="max_person_allowed">Max Person Allowed</label>
                <input type="number" name="max_person_allowed" class="form-control" value="{{ old('max_person_allowed') }}" placeholder="max_person_allowed" required>
            </div>
            <div class="form-group col-6">
                <label for="max_person_allowed">Rate</label>
                <input type="number" name="rate" class="form-control" value="{{ old('rate') }}" placeholder="rate" required>
            </div>
            <div class="form-group col-6">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}"  placeholder="price" required>
            </div>
            <div class="input-group col-6">
                <label class="col-12">Image </label>
                <input type="file" class="form-control"  multiple name="images[]">
            </div>
        </div>
    <button type="submit" class="btn btn-primary">Save</button>
    </form>
        @else
            <form  method="post" action="{{route('room.update',$hotelRoom->id)}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$hotelRoom->hotel_id}}">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="contact_person">Room Number</label>
                        <input name="room_number" class="form-control" id="room_number" value="{{$hotelRoom->room_number}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_person">Description</label>
                        <input name="description" class="form-control" id="description" value="{{$hotelRoom->room_number}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_person">Room Type</label>
                        <input name="room_type" class="form-control" id="room_type" value="{{$hotelRoom->room_type}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_person">Person Allowed</label>
                        <input type="number" name="person_allowed" class="form-control"  value="{{$hotelRoom->person_allowed}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="max_person_allowed">Max Person Allowed</label>
                        <input type="number" name="max_person_allowed" class="form-control" value="{{$hotelRoom->max_person_allowed}}" placeholder="max_person_allowed" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="max_person_allowed">Rate</label>
                        <input type="number" name="rate" class="form-control" id="rate" value="{{$hotelRoom->rate}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" value="{{$hotelRoom->price}}" placeholder="price" required>
                    </div>
                    <div class="input-group col-6">
                        <label class="col-12">Image </label>
                        <input type="file" class="form-control"  multiple name="images[]">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            @endif
    </div>
</div>
@endsection
