@extends('layouts.layout')

@section('subcontent')
<div class="padding">
    <div class="content-wrapper">
        <!-- /.row -->
        <div class="row">
            <div class="col-12 mb-2">
                <a href="{{route('user.create')}}" type="button" class="btn btn-info">
                    Add User
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>

                        <div class="card-tools">
                            <form action="{{route('user.index')}}" method="get">
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
                                    <th>EMP ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->emp_id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td> {{$user->phone_number}} </td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('user.change.status',$user->id)}}" class="btn btn-warning">
                                                @if($user->deleted_at != "")
                                                <i class="fas fa-arrow-circle-up"></i> Enable
                                                @else
                                                <i class="fas fa-arrow-circle-down"></i> Disable
                                               @endif
                                            </a>
                                            
                                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-info">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            {{-- <a class="btn btn-danger confirm" href="{{route('user.delete',$user->id)}}">
                                                <i class="fas fa-trash"></i> Delete </a> --}}
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-delete{{$user->id}}">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h4 class="modal-title">Delete User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure ?
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="" method="GET">
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
                        {{ $users->links() }}
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