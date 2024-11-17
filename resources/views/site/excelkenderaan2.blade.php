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
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tahun</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Kenderaan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenama</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Model Kenderaan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tahun Kenderaan Dibuat</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Punca Kemalangan</th>
            
            </tr>
        </thead>
        <tbody>
            <?php $n=1?>
            @foreach($datacontent as $accident)  
            @foreach($accident->kenderaans as $kenderaan)
            <tr>
                <td style="text-align: center !important">{{$n++}}</td>
                <td>{{ $accident->negeri->name }}</td>
                <td>{{ $accident->daerah->name }}</td>
                <td>{{ $accident->tempat_kejadian }}</td>
                <td>{{ $accident->no_laporan }}</td>
                <td>{{ $accident->no_laluan }}</td>
                <td>{{ $accident->nombor_seksyen }}</td>
                <td>{{ $accident->pos_kilometer }}</td>
                <td>{{ $accident->latitude }}</td>
                <td>{{ $accident->longitude }}</td>
                <td>{{ $accident->jenisKemalangan->name }}</td>
                <td>{{ $accident->bulan->name }}</td>
                <td>{{ $accident->jenisPermukaan->name }}</td>
                <td>{{ $accident->keadaanJalan->name }}</td>
                <td>{{ $accident->kualitiPermukaan->name }}</td>
                <td>{{ $accident->sistemLaluan->name }}</td>
                <td>{{ $accident->cuaca->name }}</td>
                <td>{{ $accident->jenisLanggarPertama->name }}</td>
                <td>{{ $accident->bentukJalan->name }}</td>
                <td>{{ $accident->jenisGaris->name }}</td>
                <td>{{ $accident->mukaJalan->name }}</td>
                <td>{{ $accident->sebabCacatJalan->name }}</td>
                <td>{{ $accident->cahaya->name }}</td>
                <td style="text-align: left !important">{{ $accident->tarikh_kejadian }}</td>
                <td style="text-align: left !important">{{ $accident->tarikh_pengaduan }}</td>
                <td style="text-align: left !important">{{ $accident->tahun }}</td>
                <td style="text-align: center !important">
                    @if($kenderaan->jenis && is_object($kenderaan->jenis))
                        {{ $kenderaan->jenis->name }}
                    @elseif($kenderaan->jenis_kenderaan && isset($name_jenis_kenderaan[$kenderaan->jenis_kenderaan]))
                        {{ $name_jenis_kenderaan[$kenderaan->jenis_kenderaan] }}
                    @elseif(in_array(substr($kenderaan->jenis_kenderaan, 0, 1), $jenis_kenderaan_codes->toArray()))
                        {{ $name_jenis_kenderaan[substr($kenderaan->jenis_kenderaan, 0, 1) . '*'] }}
                    @else
                        N/A
                    @endif
                </td>
                                              
                <td style="text-align: center !important">{{ $kenderaan->jenama }}</td>
                <td style="text-align: center !important">{{ $kenderaan->model_kenderaan }}</td>
                <td style="text-align: center !important">{{ $kenderaan->tahun_dibuat }}</td>
                <td style="text-align: left !important">{{ $accident->puncaKemalangan->name ?? 'N/A' }}</td>
            </tr>
            @endforeach
        @endforeach
        </tbody> 
    </table>
</body>
@endsection
