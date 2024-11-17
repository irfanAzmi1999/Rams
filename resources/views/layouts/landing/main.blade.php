<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>RAMS</title>
        
        <!-- Favicon Icon -->
        <link rel="shortcut icon" href="{{ URL::asset('rams/images/favicon.png') }}" type="image/png" />
        <link rel="icon" href="{{ URL::asset('rams/images/favicon.png') }}" type="image/png" />
        <!-- Favicon Icon -->
        
        <!-- ALL CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/font-awesome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/owl.carousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/owl.theme.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/flaticon.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/settings.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/style.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/preset.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bespoke/css/responsive.css') }}">

        <!--[if lt IE 9]>
              <script src="{{ URL::asset('bespoke/js/html5shiv.js') }}"></script>
              <script src="{{ URL::asset('bespoke/js/respond.min.js') }}"></script>
        <![endif]-->
    </head>
    <body>

        <!--PRELOADER START-->
        <div class="preloader">
            <div class="loader">
                <img src="bespoke/images/loader.gif" alt="">
            </div>
        </div>
        <!--PRELOADER END-->

        <!--HEADER START-->
        <header class="header isSticky" id="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-2 noPaddingLeft">
                        <div class="logo">
                            <a href="/"><img src="{{ URL::asset('rams/images/rams_white_wh31.png') }}" alt=""></a>
                        </div>
                        <div class="logo logoText hidden">
                            <h1><a href="/">RAMS</a></h1>
                        </div>
                        <div class="stickyLogo">
                            <a href="/"><img src="{{ URL::asset('rams/images/rams_wh31.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-8">&nbsp;</div>
                    <div class="col-md-2 hidden-sm md_class noPaddingRight">
                        <nav class="mainMenu">
                            <div class="mobileBar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <ul>
                                <li class="scroll"><a href="{{ url('login') }}">Log Masuk</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!--HEADER END-->

        @yield('content')
    
    </body>
    @include('layouts.landing.footer')
</html>
