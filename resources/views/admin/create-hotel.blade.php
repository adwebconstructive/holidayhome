
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

            @if(empty($hotel))
            <form  method="post" action="{{route('hotels.store')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">
                <div class="row">
                <div class="form-group col-6">
                    <label for="name">Hotel Name</label>
                    <input name="name" class="form-control" value="{{old('name')}}"  placeholder="Hotel Name" required>
                </div>
                <div class="form-group col-6">
                    <label for="country">Country</label>
                    <input name="country" class="form-control" value="{{old('country')}}" id="country" placeholder="Country" required>
                </div>
                <div class="form-group col-6">
                    <label for="state">State</label>
                    <input name="state" class="form-control" value="{{old('state')}}"  placeholder="State" >
                </div>
                <div class="form-group col-6">
                    <label for="state">City</label>
                    <input name="city" class="form-control" value="{{old('city')}}" placeholder="City" >
                </div>
                <div class="form-group col-6">
                    <label for="address">Address</label>
                    <input  name="address" class="form-control" value="{{old('address')}}" placeholder="Address" required>
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
                    <label for="exampleInputFile">Logo</label>
                    <div class="input-group">
                        
                            <input type="file" class="form-control"  name="logo">
                        
                        
                    </div>
                </div>
            </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
            @else
                <form  method="POST" action="{{route('hotels.update',$hotel->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="card-body">
                        <div class="row">
                        <div class="form-group col-6">
                            <label for="name">Hotel Name</label>
                            <input name="name" class="form-control"  value="{{$hotel->name}}" required>
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
                            <input  name="address" class="form-control" id="address" value="{{$hotel->address}}" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="pin_code">Pin</label>
                            <input  type="number" name="pin_code" class="form-control" id="pin_code" value="{{$hotel->pin_code}}" required>
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
                            <label for="exampleInputFile">Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"  name="logo">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            @endif
        </div>
    </div>



@endsection
