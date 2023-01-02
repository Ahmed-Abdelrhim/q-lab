<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{$info['name']}} | @yield('title')</title>
<link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/icons/favicon.ico')}}">
<link rel="manifest" href="{{asset('img/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{asset('img/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- Datatables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css')}}">
<!-- toastr css -->
<link rel="stylesheet" href="{{ asset::asset('css/toastr.min.css')}}">
<!-- select2 css -->
<link rel="stylesheet" href="{{ asset('css/select2.css')}}" type="text/css">
<!-- jquery ui -->
<link rel="stylesheet" href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}">
<!-- sweetalert -->
<link rel="stylesheet" href="{{asset('plugins/sweet-alert/sweetalert.css')}}">
<!-- RTL -->
@if(session('rtl'))
    <link rel="stylesheet" href="{{asset('css/rtl.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.min.css')}}">
@endif

@yield('css')
