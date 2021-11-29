<!DOCTYPE html>
<html lang="fa">
<head>
    <title>ورود به سیستم</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/admin/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.min.css')}}">
</head>
<body>
    @include('sweetalert::alert')
@yield('content')
<script src="{{asset('js/auth/auth.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/formValidationBootstrap.js')}}"></script>
</body>

</html>




