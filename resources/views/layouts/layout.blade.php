@extends('app')

@section('plugins')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE3/dist/css/adminlte.min.css')}}">
    <!-- AdminLTE -->
    <script src="{{ asset('plugins/AdminLTE3/dist/js/adminlte.js')}}"></script>
    <!-- SweetAlert -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <!-- Bootstrap custom file input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    {{--custom css--}}
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css')}}">
    <!-- Table Row Merge -->
    <script src="{{ asset('plugins/merge-adjacent-row/dist/row-merge-bundle.min.js') }}"></script>
@endsection

@section('content')
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')
            @yield('subcontent')
        @include('layouts.footer')
    </div>
    @yield('js-code')
@stop
