@extends('app')

@section('content')
    <div class="wrapper" >
        @include('layouts.header')
        @include('layouts.sidebar')

            @yield('subcontent')
        @include('layouts.footer')
    </div>
    @yield('js-code')
@stop
