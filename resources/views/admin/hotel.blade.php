@extends('layouts.layout')

@section('subcontent')

    <div class="padding">
        <div class="content-wrapper">
    <!-- /.row -->
            <div class="row">
                <div class="col-12 mb-2">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                   Add Hotel
                </button>
                </div>
            </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hotels</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Pin</th>
                            <th>GSTN</th>
                            <th>Contact Details</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hotels as $hotel)
                        <tr>
                            <td>{{$hotel->id}}</td>
                            <td>{{$hotel->name}}</td>
                            <td>{{$hotel->country}}</td>
                            {{--<td><span class="tag tag-success">Approved</span></td>--}}
                            <td>{{$hotel->state}}</td>
                            <td>{{$hotel->city}}</td>
                            <td>{{$hotel->address}}</td>
                            <td>{{$hotel->pin_code}}</td>
                            <td>{{$hotel->gstn}}</td>
                            <td>{{$hotel->contact_person}},{{$hotel->contact_phone}},{{$hotel->contact_email}}</td>
                            <td>{{$hotel->logo}}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $hotels->links() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        </div>
    <!-- /.row -->
        </div>
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Hotel</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  method="post" action="{{route('hotels.store')}}">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Hotel Name</label>
                                    <input name="name" class="form-control"  placeholder="Hotel Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input name="country" class="form-control" id="country" placeholder="Country" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input name="state" class="form-control" id="state" placeholder="State" required>
                                </div>
                                <div class="form-group">
                                    <label for="state">City</label>
                                    <input name="city" class="form-control" id="city" placeholder="City" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input name="address" class="form-control" id="address" placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <label for="pin_code">Address</label>
                                    <input name="pin_code" class="form-control" id="pin_code" placeholder="Pin Code" required>
                                </div>
                                <div class="form-group">
                                    <label for="gstn">GSTN</label>
                                    <input name="gstn" class="form-control" id="gstn" placeholder="GSTN">
                                </div>
                                <div class="form-group">
                                    <label for="contact_person">Contact Person</label>
                                    <input name="contact_person" class="form-control" id="contact_person" placeholder="Contact Person" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact_email">Contact Email</label>
                                    <input name="contact_email" class="form-control" id="contact_email" placeholder="Contact Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact_phone">Contact Phone</label>
                                    <input name="contact_phone" class="form-control" id="contact_phone" placeholder="Contact Phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="logo">
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
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
@endsection
