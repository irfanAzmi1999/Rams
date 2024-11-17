<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>RAMS</title>

        <link rel="shortcut icon" href="{{ URL::asset('rams/images/favicon.png') }}" type="image/png" />
        <link rel="icon" href="{{ URL::asset('rams/images/favicon.png') }}" type="image/png" />

        <link href="{{ URL::asset('inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('rams/css/style2.css') }}" rel="stylesheet">
    </head>
    <body class="gray-bg" style="background:url({{ URL::asset('rams/images/system.jpg') }}) fixed no-repeat;">
        <div class="loginColumns animated fadeInDown">
        @yield('content')
        <hr/>
            <div class="row">
                <div class="col-md-10 text-success">
                    Hakcipta Terpelihara <?php echo date('Y'); ?> © Kementerian Kerja Raya Malaysia
                </div>
                <div class="col-md-2 text-right text-white">
                   RAMS
                </div>
            </div>
        </div>
    </body>
    @include('layouts.main.footer')
</html>