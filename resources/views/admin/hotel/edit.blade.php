@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <form method="POST" action="{{route('hotel.update',$hotel->id)}}" enctype="multipart/form-data" class="confirm">
            {{csrf_field()}}

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Hotel Name</label>
                        <input name="name" class="form-control" value="{{$hotel->name}}" required>
                    </div>

                    <div class="form-group col-6">
                        <label for="country">Country</label>
                        <input name="country" class="form-control" id="country" value="{{$hotel->country}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="state">State</label>
                        <input name="state" class="form-control" id="state" value="{{$hotel->state}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="state">City</label>
                        <input name="city" class="form-control" id="city" value="{{$hotel->city}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="address">Address</label>
                        <input name="address" class="form-control" id="address" value="{{$hotel->address}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="pin_code">Pin</label>
                        <input type="number" name="pin_code" class="form-control" id="pin_code" value="{{$hotel->pin_code}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="gstn">GSTN</label>
                        <input name="gstn" class="form-control" id="gstn" value="{{$hotel->gstn}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_person">Contact Person</label>
                        <input name="contact_person" class="form-control" id="contact_person" value="{{$hotel->contact_person}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_email">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" id="contact_email" value="{{$hotel->contact_email}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="number" maxlength="10" name="contact_phone" class="form-control" id="contact_phone" value="{{$hotel->contact_phone}}" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="check_in">Check In</label>
                        <input type="text" maxlength="10" name="check_in" class="form-control" value="{{$hotel->check_in}}" id="check_in" placeholder="Contact Phone" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="check_out">Check Out</label>
                        <input type="text" maxlength="10" name="check_out" class="form-control" value="{{$hotel->check_out}}" id="check_out" placeholder="Contact Phone" required>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="form-group col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </form>
    </div>
    @include('partials.validation-error')
</div>

@endsection