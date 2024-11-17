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
        <link href="{{ URL::asset('inspinia/css/animate.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('inspinia/css/style.css') }}" rel="stylesheet">
    </head>
    <body class="gray-bg">
        <div class="middle-box text-center animated fadeInDown">
            @yield('content')
        </div>
    </body>
    <!-- Mainly scripts -->
    <script src="{{ URL::asset('inspinia/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ URL::asset('inspinia/js/bootstrap.min.js') }}"></script>
</html>