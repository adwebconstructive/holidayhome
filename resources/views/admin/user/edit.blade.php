@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <form method="post" action="{{route('user.update')}}" >
            {{csrf_field()}}
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="id" class="form-control" value="{{$user->id}}">
                    <div class="form-group col-6">
                        <label for="emp_id">Empid</label>
                        <input name="emp_id" class="form-control" value="{{$user->emp_id}}" placeholder="empid" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="country">Name</label>
                        <input name="name" class="form-control" value="{{$user->name}}" id="name" placeholder="name" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input name="email" class="form-control" value="{{$user->email}}" placeholder="email">
                    </div>
                    <div class="form-group col-6">
                        <label for="phone_number">Phone Numeber</label>
                        <input name="phone_number" class="form-control" value="{{$user->phone_number}}" placeholder="phone_number">
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