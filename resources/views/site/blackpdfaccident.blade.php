@extends('layouts/main/blackpdf')

@section('content')
<html>
    <head>
        <style type="text/css">
            header {
                position: fixed;
                top: 0px;
                left: 0px;
                right: 0px;
                height: 50px;
            }

            body {
                margin-top: 210px;
            }

          table, th, td{
            font-size: 7px;
            border: 1px solid black;
          }

          table{
            border-collapse: collapse;
            width: 100% !important;
          }

          th{
            background-color: #1a7bb9;
            color: white;
            text-align: center;
            height: 20px;
          }

          td{
            padding-left: 3px;
            padding-right: 3px; 
          }

        </style>
    </head>
    <header>
        <center>
            <img src="{{Request::root()}}/rams/images/rams_banner.png" style="width: 198.536px; height: 54.6429px;">
            <h1>KEMENTERIAN KERJA RAYA</h1>
            <h3>SISTEM PENGURUSAN KEMALANGAN JALAN RAYA</h3>
            <h3>KAWASAN KERAP KEMALANGAN (BLACK SPOT)</h3>
        </center>
    </header>
    <body>
        <table class="table table-striped table-hover table-condensed">
            <tbody>
                <?php $i=0; $j=0 ?>
                @foreach($blackspot as $black)
                    <tr>
                        <th>No</th>
                        <th>No Laporan</th>
                        <th>Tahun</th>
                        <th>Negeri</th>
                        <th>Daerah</th>
                        <th>Tempat Kejadian</th>
                        <th>Nombor Laluan</th>
                        <th>Pos Kilometer</th>
                        <th>Pos KM 1</th>
                        <th>Pos KM 2</th>
                        <th>Nombor Seksyen</th>
                        <th>Bentuk Jalan</th>
                        <th>Jenis Kemalangan</th>
                        <th>Jenis Langgar Pertama</th>
                        <th>Cuaca</th>
                        <th>Cahaya</th>
                        <th>Bil Pemandu Mati</th>
                        <th>Bil Pemandu Cedera</th>
                        <th>Bil Penumpang Mati</th>
                        <th>Bil Penumpang Cedera</th>
                        <th>Bil Pejalan Mati</th>
                        <th>Bil Pejalan Cedera</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Tarikh Kejadian</th>
                        <th>Tarikh Pengaduan</th>
                        <th>Status</th>
                        <th>Maut</th>
                        <th>Parah</th>
                        <th>Ringan</th>
                        <th>Rosak</th>
                        <th>Tidak Diketahui</th>
                        <th>Pemberat</th>
                    </tr>
                    <tr><th colspan="30">Blackspot Bil #{{$j+1}}</th></tr>
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
</html>
@endsection