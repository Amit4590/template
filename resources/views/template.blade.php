<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{{ csrf_token() }}">
  <title>Bukmuk|Admin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/dist/css/custom.css')}}">
  <style type="text/css">
    .overlay {display: none;position: fixed;width: 100%;height: 100%;top: 0;left: 0;z-index: 999999;background: rgba(255, 255, 255, 0.9) url("{{url('assets/dist/img/loader.gif')}}") center no-repeat;}body.loading {overflow: hidden;}body.loading .overlay {display: block;}.progress {height: 9px;}
  </style>
  @yield('css')
  <script type="text/javascript">
    var siteUrl = '{{url('/')}}';
  </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="overlay"></div>
<div class="wrapper">

  @include('layouts.header')
  @include('layouts.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('layouts.footer')
</div>
<script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{url('assets/dist/js/demo.js')}}"></script>
<script src="{{url('assets/dist/js/custom.js')}}"></script>
@yield('script')
</body>
</html>