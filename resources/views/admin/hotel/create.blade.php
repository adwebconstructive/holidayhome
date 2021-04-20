@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <form method="post" action="{{route('hotel.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Hotel Name</label>
                        <input name="name" class="form-control" value="{{old('name')}}" placeholder="Hotel Name" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="country">Country</label>
                        <input name="country" class="form-control" value="{{old('country')}}" id="country" placeholder="Country" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="state">State</label>
                        <input name="state" class="form-control" value="{{old('state')}}" placeholder="State">
                    </div>
                    <div class="form-group col-6">
                        <label for="state">City</label>
                        <input name="city" class="form-control" value="{{old('city')}}" placeholder="City">
                    </div>
                    <div class="form-group col-6">
                        <label for="address">Address</label>
                        <input name="address" class="form-control" value="{{old('address')}}" placeholder="Address" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="pin_code">Pin</label>
                        <input type="number" name="pin_code" class="form-control" value="{{old('pin_code')}}" id="" placeholder="Pin Code" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="gstn">GSTN</label>
                        <input name="gstn" class="form-control" id="gstn" value="{{old('gstn')}}" placeholder="GSTN">
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_person">Contact Person</label>
                        <input name="contact_person" class="form-control" id="contact_person" value="{{old('contact_person')}}" placeholder="Contact Person" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_email">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" id="contact_email" value="{{old('contact_email')}}" placeholder="Contact Email" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="number" maxlength="10" name="contact_phone" class="form-control" value="{{old('contact_phone')}}" id="contact_phone" placeholder="Contact Phone" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="check_in">Check In</label>
                        <input type="number" maxlength="10" name="check_in" class="form-control" value="{{old('check_in')}}" id="check_in" placeholder="Contact Phone" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="check_out">Check Out</label>
                        <input type="number" maxlength="10" name="check_out" class="form-control" value="{{old('check_out')}}" id="check_out" placeholder="Contact Phone" required>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @include('partials.validation-error')
    </div>
</div>



@endsection