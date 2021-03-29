@extends('frontend.app')

@section('content')
        @include('frontend.layouts.header')
            @yield('subcontent')
        @include('frontend.layouts.footer')
    @yield('js-code')
@stop
