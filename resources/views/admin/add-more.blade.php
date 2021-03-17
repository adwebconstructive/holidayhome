@extends('layouts.layout')

@section('subcontent')
    <div class="padding">
        <div class="content-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-12 mb-2">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                        Add Image
                    </button>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg-room">
                        Add Room
                    </button>
                </div>
            </div>
            <div>
                <h4>  Hotel Images</h4>
                <div class="row">

                @foreach($hotel->hotelImage as $data)
                        <img src="{{$data->image_path}}" width="250px" height="200px" class="ml-2 mr-2">

                @endforeach
                </div>
            </div>
            <hr>
            <h4>Rooms</h4>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Description</th>
                        <th>Room Type</th>
                        <th>Person Allowed</th>
                        <th>Max Person Allowed</th>
                        <th>Rate</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($hotel->hotelRoom as $data)
                        <tr>
                            <td>
                                {{$data->room_number}}
                            </td>
                            <td>{{$data->description}}</td>
                            <td>{{$data->room_type}}</td>
                            <td>{{$data->person_allowed}}</td>
                            <td>{{$data->max_person_allowed}}</td>
                            <td>{{$data->rate}}</td>
                            <td>{{$data->price}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-image{{$data->id}}">
                                    More <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-image{{$data->id}}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h4 class="modal-title">Images</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach($data->roomImage as $image)
                                            <div>
                                                <img src="{{$image->image_path}}" class="col-md-3">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  method="post" action="{{route('add.hotel.image',$hotel->id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputFile">Select Images</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control"  multiple name="images[]">

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-lg-room">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Room</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  method="post" action="{{route('add.hotel.room',$hotel->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="contact_person">Room Number</label>
                                    <input name="room_number" class="form-control" id="room_number" placeholder="Room Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact_person">Description</label>
                                    <input name="description" class="form-control" id="description" placeholder="Description" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact_person">Room Type</label>
                                    <input name="room_type" class="form-control" id="room_type" placeholder="room_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="contact_person">Person Allowed</label>
                                    <input type="number" name="person_allowed" class="form-control" id="person_allowed" placeholder="person_allowed" required>
                                </div>
                                <div class="form-group">
                                    <label for="max_person_allowed">Max Person Allowed</label>
                                    <input type="number" name="max_person_allowed" class="form-control" id="max_person_allowed" placeholder="max_person_allowed" required>
                                </div>
                                <div class="form-group">
                                    <label for="max_person_allowed">Rate</label>
                                    <input type="number" name="rate" class="form-control" id="rate" placeholder="rate" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control" id="price" placeholder="price" required>
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control"  multiple name="images[]">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
