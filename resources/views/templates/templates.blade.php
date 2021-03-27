<!DOCTYPE html>
<!-- 
Template Name: BRILLIANT Bootstrap Admin Template
Version: 4.5.6
Author: WebThemez
Website: http://www.webthemez.com/ 
-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="" name="description" />
    <meta content="webthemez" name="author" />
    <title>SPK SIGADIS - {{ \Auth::user()->level }}</title>
    <!-- Bootstrap Styles-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="{{ asset('assets/js/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="{{ asset('assets/css/custom-styles.css') }}" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{ asset('assets/js/Lightweight-Chart/cssCharts.css') }}">

    @yield("style")
</head>

<body>
    <div id="wrapper">

        <!--/. NAV TOP  -->
        @include('templates.nav')

        @include('templates.aside')
        <!-- /. NAV SIDE  -->

        @include('templates.content')

        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
    <!-- Bootstrap Js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Js -->
    <script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>

    @yield('script')

    <!-- Custom Js -->
    <script src="{{ asset('assets/js/custom-scripts.js') }}"></script>

</body>

</html>
