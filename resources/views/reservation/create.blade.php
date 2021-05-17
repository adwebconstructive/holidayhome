@extends('layouts.layout')

@section('subcontent')

<div class="padding">
    <div class="content-wrapper">
        <form method="post" action="{{route('reservation.availability')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Hotel Name</label>
                        <select class="form-control" name="hotel_id" id="hotel">
                            <option>Select Hotel</option>
                            @foreach($hotels as $hotel)
                            <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="name">Select Room</label>
                        <select class="form-control" name="room_id" id="room">
                            <option>Select Room</option>
                           
                        </select>
                    </div>
        
                    <div class="form-group col-6">
                        <label>From:</label>
                         <input class="form-control" type="date" value="" name="from">
                      </div>
                      <div class="form-group col-6">
                        <label>To:</label>
                          <input  class="form-control"  type="date" name="to" value="">
                    </div>
                    
                    <div class="form-group col-6">
                        <label>Employee Id:</label>
                        <input  class="form-control"  type="text" name="emp_id" value="">
                    </div>
                </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.card-body -->
        </form>
        @include('partials.validation-error')
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

    $("#hotel").change(function () {
          debugger;
         let id = document.getElementById('hotel').value;
         let room_hotel_id="";
        var el = $(this);
        if (el.val() !== "") {
             $("#room").empty();
            <?php foreach($rooms as  $room){?>
                 room_hotel_id = {{$room->hotel_id}};
                if(room_hotel_id == id){
                    $("#room").append("<option value='{{$room->id}}'>Room No: {{$room->id}}/ Max-Allowed: {{$room->max_person_allowed}} @RS. {{$room->rate}}/day</option>");
                }
            <?php } ?>
        } 
    });
});



</script>


@endsection