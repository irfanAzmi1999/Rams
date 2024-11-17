@extends('layouts/main/blackexcel')

@section('content')
<style type="text/css">
    header {
        position: fixed;
        top: 0px;
        left: 0px;
        right: 0px;
        height: 50px;
    }

    header, div{
        display: block !important;
    }    

    body {
        margin-top: 170px;
    }

    table, th, td{
        font-size: 7px;
        border: 1px solid black;
    }

    table{
        border-collapse: collapse;
        width: 100% !important;
    }

    td{
        padding-left: 1px;
        padding-right: 1px; 
    }
</style>
<header>   
    <div>
        <center>
        <h1>KEMENTERIAN KERJA RAYA</h1>
        <h3>SISTEM PENGURUSAN KEMALANGAN JALAN RAYA</h3>
        <h3>KAWASAN LOKASI SMART TRAFFIC LIGHT</h3>
        </center>
    </div>    
</header>
<body>
    <table class="table table-striped table-hover table-condensed">
        <tbody>
            <?php $i=0; $j=0 ?>
            @foreach($blackspot as $black)
                <tr>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No Laporan</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tahun</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Negeri</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Daerah</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tempat Kejadian</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Nombor Laluan</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Pos Kilometer</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Pos KM 1</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Pos KM 2</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Nombor Seksyen</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bentuk Jalan</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Kemalangan</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Langgar Pertama</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Cuaca</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Cahaya</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bil Pemandu Mati</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bil Pemandu Cedera</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bil Penumpang Mati</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bil Penumpang Cedera</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bil Pejalan Mati</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bil Pejalan Cedera</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Latitude</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Longitude</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tarikh Kejadian</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tarikh Pengaduan</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Status</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Maut</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Parah</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Ringan</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Rosak</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tidak Diketahui</th>
                    <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Pemberat</th>
                </tr>
                <tr><th colspan="33" style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Blackspot Bil #{{$j+1}}</th></tr>
                <?php $k = 0; ?>
                @foreach($black['point'] as $b)
                    <?php $k++; ?>
                    <tr>
                        <td style="text-align: center !important">{{$i+1}}</td>
                        <td style="text-align: center !important">{{ $b['detail']['no_laporan'] }}</td>
                        <td style="text-align: center !important">{{ $b['tahun'] }}</td>
                        <td>{{ $b['detail']['negeri'] }}</td>
                        <td>{{ $b['detail']['daerah'] }}</td>
                        <td>{{ $b['detail']['tempat_kejadian'] }}</td>
                        <td>{{ $b['detail']['no_laluan'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['pos_kilometer'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['pos_km1'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['pos_km2'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['nombor_seksyen'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['bentuk_jalan'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['jenis_kemalangan'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['jenis_langgar_pertama'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['cuaca'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['cahaya'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['bil_pemandu_mati'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['bil_pemandu_cedera'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['bil_penumpang_mati'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['bil_penumpang_cedera'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['bil_pejalan_mati'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['bil_pejalan_cedera'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['latitude'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['logitude'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['tarikh_kejadian'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['tarikh_pengaduan'] }}</td>
                        <td style="text-align: center !important">{{ $b['detail']['status_la'] }}</td>
                        @if($k == 1)
                            <td style="text-align: center !important;vertical-align: middle" rowspan="{{count($black['point'])}}">{{ $black['analisa']['count_maut'] }}</td>
                            <td style="text-align: center !important;vertical-align: middle" rowspan="{{count($black['point'])}}">{{ $black['analisa']['count_parah'] }}</td>
                            <td style="text-align: center !important;vertical-align: middle" rowspan="{{count($black['point'])}}">{{ $black['analisa']['count_ringan'] }}</td>
                            <td style="text-align: center !important;vertical-align: middle" rowspan="{{count($black['point'])}}">{{ $black['analisa']['count_rosak'] }}</td>
                            <td style="text-align: center !important;vertical-align: middle" rowspan="{{count($black['point'])}}">{{ $black['analisa']['count_tidak_diketahui'] }}</td>
                            <td style="text-align: center !important;vertical-align: middle" rowspan="{{count($black['point'])}}">{{ $black['analisa']['pemberat'] }}</td>
                        @endif
                    </tr>
                    <?php $i++ ?>
                @endforeach
                <?php $j++ ?>
            @endforeach
        </tbody> 
    </table>
</body>
@endsection