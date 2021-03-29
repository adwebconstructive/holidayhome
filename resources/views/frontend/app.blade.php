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
        <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap.min.css')}}" />

        <!-- uniform -->
        <link type="text/css" rel="stylesheet" href="{{ asset('frontend/assets/uniform/css/uniform.default.min.css')}}" />

        <!-- animate.css -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/wow/animate.css')}}" />


        <!-- gallery -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/gallery/blueimp-gallery.min.css')}}">


        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <link rel="icon" href="images/favicon.png" type="image/x-icon">

        <link rel="stylesheet" href="{{asset('frontend/assets/style.css')}}">

       
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

        </head>

    @yield('content')

</html>