<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800|Old+Standard+TT' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800' rel='stylesheet' type='text/css'>

        <!-- font awesome -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


        <!-- bootstrap -->
        {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap.min.css')}}" /> --}}

        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}" />

        <!-- uniform -->
        <link type="text/css" rel="stylesheet" href="{{ asset('frontend/assets/uniform/css/uniform.default.min.css')}}" />

        <!-- animate.css -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/wow/animate.css')}}" />


        <!-- gallery -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/gallery/blueimp-gallery.min.css')}}">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap.min.css')}}" /> --}}
        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <link rel="icon" href="images/favicon.png" type="image/x-icon">
    
        <link rel="stylesheet" href="{{asset('frontend/assets/style.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            
    
            
            <script src="{{ asset('frontend/assets/jquery.js')}}"></script>

            <!-- wow script -->
            <script src="{{ asset('frontend/assets/wow/wow.min.js')}}"></script>
            
            <!-- uniform -->
            <script src="{{ asset('frontend/assets/uniform/js/jquery.uniform.js')}}"></script>
            
            
            <!-- boostrap -->
            <script src="{{ asset('frontend/assets/bootstrap/js/bootstrap.js')}}" type="text/javascript" ></script>
            
            <!-- jquery mobile -->
            <script src="{{ asset('frontend/assets/mobile/touchSwipe.min.js')}}"></script>
            
            <!-- jquery mobile -->
            <script src="{{ asset('frontend/assets/respond/respond.js')}}"></script>
            
            <!-- gallery -->
            <script src="{{ asset('frontend/assets/gallery/jquery.blueimp-gallery.min.js')}}"></script>
            
            
            <!-- custom script -->
            <script src="{{ asset('frontend/assets/script.js')}}"></script>

            <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
            <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
        </head>

    @yield('content')
    
    <script>
    @if(session()->has('success'))
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

    @foreach ($errors->all() as $error)
        console.log('{{ $error }}');
    @endforeach
    @endif
    </script>
</html>