@extends('layouts/main/pdf')

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
                margin-top: 170px;
            }

            table, th, td{
                font-size: 7px;
                border: 1px solid black;
            }

            table{
                border-collapse: collapse;
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
        </center>
    </header>
    <body>
        <table class="table table-striped table-hover table-condensed">    
            <thead>
                <tr>
                    <th>No</th>
                    <th>Negeri</th>
                    <th>Daerah</th>
                    <th>Kategori Jalan</th>
                    <th>Tempat Kejadian</th>
                    <th>No Laporan</th>
                    <th>No Laluan</th>
                    <th>No Seksyen</th>
                    <th>Pos Kilometer</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Jenis Kemalangan</th>
                    <th>Bulan</th>
                    <th>Jenis Permukaan</th>
                    <th>Keadaan Jalan</th>
                    <th>Kualiti Permukaan</th>
                    <th>Sistem Laluan</th>
                    <th>Cuaca</th>
                    <th>Jenis Langgar Pertama</th>
                    <th>Bentuk Jalan</th>
                    <th>Jenis Garis</th>
                    <th>Muka Jalan</th>
                    <th>Sebab Cacat Jalan</th>
                    <th>Cahaya</th>
                    <th>Tarikh Kejadian</th>
                    <th>Tarikh Pengaduan</th>
                    <th>Tahun</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $n=1?>
                @foreach($datacontent as $accidents)  
                <tr>
                    <td>{{$n++}}</td>
                    <td>{{$accidents->negeri ? $accidents->negeri->name : ''}}</td>
                    <td>{{$accidents->daerah ? $accidents->daerah->name : ''}}</td>
                    <td>{{$accidents->jenisJalan ? $accidents->jenisJalan->name : ''}}</td>
                    <td>{{$accidents->tempat_kejadian}}</td>
                    <td>{{$accidents->no_laporan}}</td>
                    <td>{{$accidents->no_laluan}}</td>
                    <td>{{$accidents->nombor_seksyen}}</td>
                    <td>{{$accidents->pos_kilometer}}</td>
                    <td>{{$accidents->latitude}}</td>
                    <td>{{$accidents->logitude}}</td>
                    <td>{{$accidents->jenisKemalangan->name}}</td>
                    <td>{{$accidents->bulan->name}}</td>
                    <td>{{$accidents->jenisPermukaan->name}}</td>
                    <td>{{$accidents->keadaanJalan->name}}</td>
                    <td>{{$accidents->kualitiPermukaan->name}}</td>
                    <td>{{$accidents->sistemLaluan->name}}</td>
                    <td>{{$accidents->cuaca->name}}</td>
                    <td>{{$accidents->jenisLanggarPertama->name}}</td>
                    <td>{{$accidents->bentukJalan->name}}</td>
                    <td>{{$accidents->jenisGaris->name}}</td>
                    <td>{{$accidents->mukaJalan->name}}</td>
                    <td>{{$accidents->sebabCacatJalan->name}}</td>
                    <td>{{$accidents->cahaya->name}}</td>
                    <td>{{$accidents['tarikh_kejadian']}}</td>
                    <td>{{$accidents['tarikh_pengaduan']}}</td>
                    <td>{{$accidents['tahun']}}</td>
                    <td>{{$accidents['status_la']}}</td>
                </tr>
                @endforeach
            </tbody> 
        </table>
    </body>
</html>
@endsection