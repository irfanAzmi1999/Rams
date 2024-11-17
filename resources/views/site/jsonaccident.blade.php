@extends('layouts/main/json')

@section('content')
<?php
    var_dump(json_decode($datacontent, true));
?>
@endsection