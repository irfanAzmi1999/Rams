@extends('layouts/main/excel')

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
        </center>
    </div>    
</header>
<body>
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Negeri</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Daerah</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Kategori Jalan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tempat Kejadian</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No Laporan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No Laluan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No Seksyen</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Pos Kilometer</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Latitude</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Longitude</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Kemalangan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bulan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Permukaan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Keadaan Jalan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Kualiti Permukaan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Sistem Laluan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Cuaca</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Langgar Pertama</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bentuk Jalan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Garis</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Muka Jalan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Sebab Cacat Jalan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Cahaya</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tarikh Kejadian</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tarikh Pengaduan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tarikh Masuk</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tarikh Kemaskini</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tahun</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $n=1?>
            @foreach($datacontent as $accidents)  
            <tr>
                <td style="text-align: center !important">{{$n++}}</td>
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
                <td>{{$accidents->jenisKemalangan ? $accidents->jenisKemalangan->name : ''}}</td>
                <td>{{$accidents->bulan ? $accidents->bulan->name : ''}}</td>
                <td>{{$accidents->jenisPermukaan ? $accidents->jenisPermukaan->name : ''}}</td>
                <td>{{$accidents->keadaanJalan ? $accidents->keadaanJalan->name : ''}}</td>
                <td>{{$accidents->kualitiPermukaan ? $accidents->kualitiPermukaan->name : ''}}</td>
                <td>{{$accidents->sistemLaluan ? $accidents->sistemLaluan->name : ''}}</td>
                <td>{{$accidents->cuaca ? $accidents->cuaca->name : ''}}</td>
                <td>{{$accidents->jenisLanggarPertama ? $accidents->jenisLanggarPertama->name : ''}}</td>
                <td>{{$accidents->bentukJalan ? $accidents->bentukJalan->name : ''}}</td>
                <td>{{$accidents->jenisGaris ? $accidents->jenisGaris->name : ''}}</td>
                <td>{{$accidents->mukaJalan ? $accidents->mukaJalan->name : ''}}</td>
                <td>{{$accidents->sebabCacatJalan ? $accidents->sebabCacatJalan->name : ''}}</td>
                <td>{{$accidents->cahaya ? $accidents->cahaya->name : ''}}</td>
                <td style="text-align: left !important">{{$accidents['tarikh_kejadian']}}</td>
                <td style="text-align: left !important">{{$accidents['tarikh_pengaduan']}}</td>
                <td style="text-align: left !important">{{$accidents['created_at']}}</td>
                <td style="text-align: left !important">{{$accidents['updated_at']}}</td>
                <td style="text-align: left !important">{{$accidents['tahun']}}</td>
                <td style="text-align: left !important">{{$accidents['status_la']}}</td>
            </tr>
            @endforeach
        </tbody> 
    </table>
</body>
@endsection