@extends('frontend.layouts.layout')

@section('subcontent')


<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profile</h3>
                </div>

                <!-- /.card-header -->
                <div class = "col-6">
                   Emp ID :{{$user->emp_id}}
                </div>
                <div class = "col-6">
                   Name  : {{$user->name}}
                </div>
                <div class = "col-6">
                    Email  : {{$user->email}}
                </div>
                <div class = "col-6">
                    Phone  : {{$user->phone_number}}
                </div>
                
            </div>
            <!-- /.card -->
        </div>
    </div>

</div>
<br>
<br>
<br>
<br>
@endsection