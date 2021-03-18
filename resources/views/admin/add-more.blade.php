@extends('layouts.layout')

@section('subcontent')
    <div class="padding">
        <div class="content-wrapper">
            <!-- /.row -->
            <div class="row">
                 @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                <div class="col-12 mb-2">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                        Add Image
                    </button>

                    <a href="{{url('admin/hotels/room-create',$hotel->id)}}" class="btn btn-info" >
                        Add Room
                    </a>
                </div>
            </div>
            <div>
                <h4>  Hotel Images</h4>
                <div class="row">

                @foreach($hotel->hotelImage as $data)
                    <div>
                        <img src="{{$data->image_path}}" width="250px" height="200px" class="ml-2 mr-2">
                        <div style="width:250px;" class="ml-2 mr-2">
                            <a href="{{url('admin/hotels/image-delete',$data->id)}}" class="btn btn-danger full-widh"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                @endforeach
                @if($hotel->hotelImage->count() == 0)
                   <h5 class="ml-2"> No image found</h5>
                @endif
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
                                     <i class="fas fa-image"></i>
                                </button>
                                <a href="{{url('admin/hotels/room-edit',$data->id)}}" class="btn btn-sm btn-info" >
                                     <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete{{$data->id}}">
                                     <i class="fas fa-trash"></i>
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
                                        <div class="row"> 
                                        @foreach($data->roomImage as $image)
                                                     <div class="mb-2">
                                                        <img src="{{$image->image_path}}" width="220px" height="200px" class="ml-2">
                                                        <div style="width:220px;" class="ml-2 mr-2">
                                                            <a href="{{url('admin/hotels/image-delete',$image->id)}}" class="btn btn-danger full-widh"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                        @endforeach
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="modal fade" id="modal-delete{{$data->id}}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h4 class="modal-title">Delete</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are U sure ??
                                    
                                    </div>
                                <div class="modal-footer justify-content-between">
                                    <a href="{{url('admin/hotels/room-delete',$data->id)}}" class="btn btn-primary">Yes</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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




    </div>
@endsection
