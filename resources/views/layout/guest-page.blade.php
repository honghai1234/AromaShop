<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @yield('meta')

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aroma Shop - Home</title>
    <link rel="icon" href="img/Fevicon.png" type="image/png">
    <link rel="stylesheet" href="{{ URL::asset('vendors/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    @yield('css')

</head>

<body>
    <!--================ Start Header Menu Area =================-->
    <x-header />
    <!--================ End Header Menu Area =================-->
    @yield('content')
    <!--================ Start footer Area  =================-->
    <x-footer />
    <!--================ End footer Area  =================-->


    

</body>
<script src="{{ URL::asset('vendors/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/skrollr.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/nice-select/jquery.nice-select.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/mail-script.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
@yield('script')
</html>
