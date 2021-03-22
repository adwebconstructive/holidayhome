@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <!-- /.row -->
        <div class="row">
            <div class="col-12 mb-2">
                <a href="{{url('admin/hotels/create')}}" type="button" class="btn btn-info">
                    Add Hotel
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Hotels</h3>

                        <div class="card-tools">
                            <form action="{{route('hotels.index')}}" method="get">
                                <div class="input-group input-group-sm" style="width: 250px;">

                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover hotels">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>GSTN</th>
                                    <th>Contact Details</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hotels as $hotel)
                                <tr>
                                    <td>{{$hotel->name}}</td>
                                    <td>{{ $hotel->full_address }}</td>
                                    <td>{{$hotel->gstn}}</td>
                                    <td>{{$hotel->contact_person}} <br> {{$hotel->contact_phone}} <br> {{$hotel->contact_email}}</td>
                                    <td><img src="{{$hotel->logo}}" width="100px" height="100px"></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url('admin/change-hotel-status',$hotel->id)}}" class="btn btn-warning">
                                                @if($hotel->enabled == 0)
                                                <i class="fas fa-arrow-circle-up"></i> Enable
                                                @else
                                                <i class="fas fa-arrow-circle-down"></i> Disable
                                                @endif
                                            </a>
                                            <a href="{{route('hotels.view',$hotel->id)}}" class="btn btn-default">
                                                <i class="fas fa-eye"></i> View
                                            </a>

                                            <a href="{{url('admin/hotels/edit',$hotel->id)}}" class="btn btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a class="btn btn-danger confirm" href="{{route('delete.hotel',$hotel->id)}}">
                                                <i class="fas fa-trash"></i> Delete </a>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-delete{{$hotel->id}}">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h4 class="modal-title">Delete Hotel</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure ?
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="{{route('delete.hotel',$hotel->id)}}" method="GET">
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                {{-- <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--end delete modal--}}
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

</div>
@endsection