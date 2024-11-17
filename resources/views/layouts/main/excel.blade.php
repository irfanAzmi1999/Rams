<?php
    ob_start();
    $filename = "Data_Kemalangan.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$filename");
?>
@yield('content')