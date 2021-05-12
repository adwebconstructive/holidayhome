<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
{{--    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">--}}
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE/dist/css/adminlte.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css')}}">
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- gallery -->
    <link rel="stylesheet" href="{{ asset('plugins/frontend/assets/gallery/blueimp-gallery.min.css')}}">
    <!-- uniform -->
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/frontend/assets/uniform/css/uniform.default.min.css')}}"/>
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('plugins/frontend/assets/wow/animate.css')}}"/>
    <!-- Frontend styles -->
    <link rel="stylesheet" href="{{ asset('plugins/frontend/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('plugins/frontend/assets/style.css')}}">
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
    <!-- VueJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <!-- Moment.js -->
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
    <!-- DateRangePicker -->
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
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

        $('form').on('submit', (event) => {
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
