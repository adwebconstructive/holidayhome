<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css')}}">
    <!-- Date Range-->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- VueJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <!-- SweetAlert -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <!-- Moment.js -->
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <!-- Date Range-->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    @yield('plugins')
</head>

<body class="hold-transition sidebar-mini">
    @yield('content')
</body>

<script>
    $(window).on('load', () => {
        // Animate loader off screen
        $("#preloader").fadeOut("slow");
        // $("#preloader").hide();
    });
    $(document).ready(() => {
        $('a.confirm').on('click', (event) => {
            event.preventDefault();
            let url = event.currentTarget.href;
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'Please check again!',
            }).then((result) => {
                if (result.value) {
                    window.location = url;
                }
            });
        });

        $('form.confirm').on('submit', (event) => {
            event.preventDefault();
            let url = event.target.href;
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to submit the form?',
                text: 'Please confirm!',
            }).then((result) => {
                if (result.value) {
                    event.target.submit();
                }
            });
        });

        @if(session()-> has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session()->get('success') }}",
        });
        @endif
        @if(session()->has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session()->get('error') }}",
        });
        @endif
        @if($errors->any())

        @foreach($errors->all() as $error)
        console.log('{{ $error }}');
        @endforeach

        @endif
    });
</script>

</html>
