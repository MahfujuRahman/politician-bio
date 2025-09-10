<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-F70C2BSCS2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-F70C2BSCS2');
    </script>


    <!-- <title>Senatory Political HTML-5 Template</title> -->
    <!-- favicon -->
    <link rel="icon" href="{{ asset('frontend') }}/assets/img/favicon.png" sizes="20x20" type="image/png" />
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.css" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css" />
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/magnific-popup.css" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.carousel.min.css" />
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/font-awesome.min.css" />
    <!-- iconmoon -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/iconmoon.css">
    <!-- Hover CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/hover-min.css" />
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/style.css" />
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/responsive.css" />

    @inertiaHead
</head>

<body>




    <!--/*
    |--------------------------------------------------------------------------
    | Main App Layout
    |--------------------------------------------------------------------------
    */-->

    @inertia

    <!--//*
    |--------------------------------------------------------------------------
    | Main App Layout
    |--------------------------------------------------------------------------
    *//-->


    <!-- footer area start -->
    <script src="{{ asset('frontend') }}/assets/js/jquery-2.2.4.min.js"></script>
    <!-- bootstrap -->
    <script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script>
    <!-- magnific popup -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.magnific-popup.js"></script>
    <!-- wow -->
    <script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>
    <!-- owl carousel -->
    <script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>
    <!-- slick Slider -->
    <script src="{{ asset('frontend') }}/assets/js/slick.min.js"></script>
    <!-- waypoint -->
    <script src="{{ asset('frontend') }}/assets/js/waypoints.min.js"></script>
    <!-- counterup -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.counterup.min.js"></script>
    <!-- countdown -->
    <script src="{{ asset('frontend') }}/assets/js/jquery.countdown.min.js"></script>
    <!-- main js -->
    <script src="{{ asset('frontend') }}/assets/js/main.js"></script>

    @vite(['resources/js/frontend/app.js'])
</body>


<!-- Mirrored from themeim.com/demo/senatory/index-05.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Jul 2025 12:03:52 GMT -->

</html>