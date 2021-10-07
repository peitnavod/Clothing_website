<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @yield('title')

    <!-- Font Awesome Icons -->
 {{--   <link rel="stylesheet" href="{{asset('../AdminIte/fontawesome-free/css/all.min.css')}}">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('../AdminIte/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('partials.header')
    @include('partials.sidebar')
    @yield('content')
    <!-- Main Footer -->
    @include('partials.footer')
</div>

<!-- jQuery -->
<script src="{{asset('../AdminIte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('../AdminIte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('../AdminIte/dist/js/adminlte.min.js')}}"></script>
@yield('js')
</body>
</html>
