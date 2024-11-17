<?php
    ob_start();
    $filename = "Blackspot_Data_Kemalangan.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$filename");
?>
@yield('content')