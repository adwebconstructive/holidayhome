@extends('layouts.layout')
@section('subcontent')


<div id="app">
<div class="padding">
    <div class="content-wrapper">
        <!-- /.row -->
        <div class="row">
            <div class="col-12 mb-2">
                <a href="{{route('reservation.create')}}" type="button" class="btn btn-info">
                    Reserve Room
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card" style="overflow: auto;max-hight:400px">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Reservations Details</h3>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                
                    <div class="row">
                      
                    </div>
                  
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    </div>
</div>
</div>
</div>
@endsection
