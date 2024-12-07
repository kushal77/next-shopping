<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | Next Shopping</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="icon" href="{{asset("pics/logo1.png")}}" type="image/gif" >
        <link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/flat/blue.css')}}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{asset('admin/plugins/morris/morris.css')}}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{asset('admin/plugins/datepicker/datepicker3.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker-bs3.css')}}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        @yield('styles')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">