<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <base href="{{ asset('') }}">

    <!-- Bootstrap core CSS     -->
    <link href="templates/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="templates/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="templates/assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="templates/assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="templates/assets/css/themify-icons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        span{
            color: red;
            display: block;
        }
    </style>
    
</head>
<body>
    <div class="wrapper">
        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand">Trang quản trị viên</a>
                    </div>
                    <div class="nav navbar-nav navbar-right" >
                        Xin chào, <strong>{{ Auth::user()->name }}</strong> <a href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-danger square-btn-adjust">Logout</a>
                    <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
                    </div>
                    
                </div>
            </nav>