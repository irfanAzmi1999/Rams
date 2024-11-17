<?php
    ob_start();
    $filename = "Laporan_24_Jam.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$filename");
?>
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
        font-size:17px;
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
        <h3>LAPORAN 24 JAM</h3>
        </center>
    </div>    
</header>
<body>
    <table class="table table-striped table-hover table-condensed">
        <tbody>
            <?php $i=0; ?>
            <tr>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No Laporan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tarikh & Masa Kejadian</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Negeri</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Daerah</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Kategori Jalan:(Persekutuan / Negeri)</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Tempat Kejadian</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Nombor Laluan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">No seksyen</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Koordinate (Latitude / Longitude)</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Jenis Perlanggaran</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Cuaca</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Bentuk Jalan</th>
                <th style="background-color: #1a7bb9 !important; color: white; text-align: center; height: 20px;">Punca Kemalangan</th>
            </tr>
            @foreach($laporan as $laporan24jam)
                @if (!empty($laporan24jam))
                    <tr>
                        <td style="text-align: center !important">{{$i+1}}</td>
                        <td style="text-align: right !important; mso-number-format:'\@';">{{ $laporan24jam->no_laporan }}</td>
                        <td style="text-align: center !important">{{ date('d F Y / Hi',strtotime($laporan24jam->tarikh_kejadian)).'hrs' }}</td>
                        <td style="text-align: center !important">{{ !empty($laporan24jam->negeri) ? $laporan24jam->negeri->name : ''}}</td>
                        <td style="text-align: center !important">{{ !empty($laporan24jam->daerah) ? $laporan24jam->daerah->name : '' }}</td>
                        <td style="text-align: center !important">{{ !empty($laporan24jam->jenisJalan) ? $laporan24jam->jenisJalan->name : '' }}</td>
                        <td style="text-align: center !important">{{ $laporan24jam->tempat_kejadian }}</td>
                        <td style="text-align: center !important">{{ $laporan24jam->no_laluan }}</td>
                        <td style="text-align: center !important">{{ $laporan24jam->nombor_seksyen }}</td>
                        <td style="text-align: center !important">{{ $laporan24jam->latitude }} / {{ $laporan24jam->logitude }}</td>
                        <td style="text-align: center !important">{{ !empty($laporan24jam->jenisLanggarPertama) ? $laporan24jam->jenisLanggarPertama->name : '' }}</td>
                        <td style="text-align: center !important">{{ !empty($laporan24jam->cuaca) ? $laporan24jam->cuaca->name : '' }}</td>
                        <td style="text-align: center !important">{{ !empty($laporan24jam->keadaanJalan) ? $laporan24jam->keadaanJalan->name : ''}}</td>
                        <td style="text-align: center !important"><?php echo !empty($laporan24jam->kategoriKesilapan) ? $laporan24jam->kategoriKesilapan->name : ''; ?></td>
                    </tr>
                    <?php $i++ ?>
                @endif
            @endforeach
        </tbody> 
    </table>
</body>
<?php ob_end_flush(); ?>