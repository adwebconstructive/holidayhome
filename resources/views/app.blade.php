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
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css')}}">
    {{--custom css--}}
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->

    <!-- FilePond-->
    <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" />




    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js')}}"></script>

    <!-- SweetAlert -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

    <!-- Moment.js -->
    <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>

    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!--AlpineJS-->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


    <script src="https://unpkg.com/filepond-plugin-image-preview"></script>
    <script src="https://unpkg.com/filepond"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-filepond"></script>

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