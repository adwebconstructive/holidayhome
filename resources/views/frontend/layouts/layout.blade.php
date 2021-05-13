@extends('app')

@section('plugins')
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- gallery -->
    <link rel="stylesheet" href="{{ asset('plugins/frontend/assets/gallery/blueimp-gallery.min.css')}}">
    <!-- uniform -->
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/frontend/assets/uniform/css/uniform.default.min.css')}}"/>
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('plugins/frontend/assets/wow/animate.css')}}"/>
    <!-- Frontend styles -->
    <link rel="stylesheet" href="{{asset('plugins/frontend/assets/style.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/frontend/css/style.css')}}"/>
    <!-- wow script -->
    <script src="{{ asset('plugins/frontend/assets/wow/wow.min.js')}}"></script>
    <!-- uniform -->
    <script src="{{ asset('plugins/frontend/assets/uniform/js/jquery.uniform.js')}}"></script>
    <!-- jquery mobile -->
    <script src="{{ asset('plugins/frontend/assets/mobile/touchSwipe.min.js')}}"></script>
    <!-- jquery mobile -->
    <script src="{{ asset('plugins/frontend/assets/respond/respond.js')}}"></script>
    <!-- gallery -->
    <script src="{{ asset('plugins/frontend/assets/gallery/jquery.blueimp-gallery.min.js')}}"></script>
    <!-- custom script -->
    <script src="{{ asset('plugins/frontend/assets/script.js')}}"></script>
@endsection

@section('content')
        @include('frontend.layouts.header')
            @yield('subcontent')
        @include('frontend.layouts.footer')
    @yield('js-code')
@stop
