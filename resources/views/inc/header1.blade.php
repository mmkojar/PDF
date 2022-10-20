<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{str_replace('_',' ',config('app.name','PATEL DAIRY FARM'))}} -
        {{ Request::segment(1) == '' ? 'Dashboard' : (Request::segment(2) ? str_replace('_', ' ', Request::segment(1)) . ' ' . Request::segment(2) : str_replace('_', ' ', Request::segment(1))) }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('app.url') }}" />
    <!--  Social tags      -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <!-- Open Graph data -->
    <meta property="og:title" content="" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:description" content="" />
    <meta property="og:site_name" content="" />
    <!-- Fonts and icons -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:700|Varela+Round&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/paper-dashboard.min1036.css?v=2.1.1') }}" rel="stylesheet" />    
    {{-- <s?php //if ($_SERVER['REQUEST_URI'] !== '/PDF/' && $_SERVER['REQUEST_URI'] !== '/PDF/dashboard'): ?> --}}
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/buttons.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/responsive.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/rowGroup.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
    {{-- <s?php //endif ?> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
</head>

<body class="___class_+?0___">
    <div id="preloader">
    </div>
