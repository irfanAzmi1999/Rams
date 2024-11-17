<?php
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=Data_Kemalangan.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
?>
@yield('content')