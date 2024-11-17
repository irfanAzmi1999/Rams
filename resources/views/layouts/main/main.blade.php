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
        <link href="{{ URL::asset('inspinia/css/plugins/slick/slick.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/slick/slick-theme.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/c3/c3.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('rams/css/sweetalert/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('rams/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('rams/css/style3.css') }}" rel="stylesheet">
    </head>
    <body class="fixed-nav">
        <div id="wrapper">
            @include('layouts.main.menu')
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    @include('layouts.main.header')
                </div>
                @yield('content')
                <div class="footer fixed">
                    <div class="pull-right">
                        &copy; <?php echo date('Y'); ?>
                    </div>
                    <div>
                        <strong>Hakcipta Terpelihara</strong> <?php echo date('Y'); ?> &copy; Kementerian Kerja Raya Malaysia
                    </div>
                </div>
            </div>
        </div>
    </body>
    @include('layouts/main/footer')
</html>
