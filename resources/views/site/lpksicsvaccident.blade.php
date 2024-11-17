@extends('layouts/main/blackcsv')

@section('content')

KEMENTERIAN KERJA RAYA
SISTEM PENGURUSAN KEMALANGAN JALAN RAYA
KAWASAN LOKASI LINTASAN PEJALAN KAKI SEARAS BERLAMPU ISYARAT

"No. Laporan","Tahun","Negeri","Daerah","Tempat Kejadian","Nombor Laluan","Pos Kilometer","Pos KM 1","Pos KM 2","Nombor Seksyen","Bentuk Jalan","Jenis Kemalangan","Jenis Langgar Pertama","Cuaca","Cahaya","Bil Pemandu Mati","Bil Pemandu Cedera","Bil Penumpang Mati","Bil Penumpang Cedera","Bil Pejalan Mati","Bil Pejalan Cedera","Latitude","Longitude","Tarikh Kejadian","Tarikh Pengaduan","Status","Maut","Parah","Ringan","Rosak","Tidak Diketahui","Pemberat",

@foreach($blackspot as $black)
	@foreach($black['point'] as $b)
		{{ $b['detail']['no_laporan'] }},{{ $b['tahun'] }},{{ $b['detail']['negeri'] }},{{ $b['detail']['daerah'] }},{{ $b['detail']['tempat_kejadian'] }},{{ $b['detail']['no_laluan'] }},{{ $b['detail']['pos_kilometer'] }},{{ $b['detail']['pos_km1'] }},{{ $b['detail']['pos_km2'] }},<?php if($b['detail']['nombor_seksyen']){ ?>{{ $b['detail']['nombor_seksyen'] }}<?php }else{ ?> - <?php } ?>
		,{{ $b['detail']['bentuk_jalan'] }},{{ $b['detail']['jenis_kemalangan'] }},{{ $b['detail']['jenis_langgar_pertama'] }},{{ $b['detail']['cuaca'] }},{{ $b['detail']['cahaya'] }},{{ $b['detail']['bil_pemandu_mati'] }},{{ $b['detail']['bil_pemandu_cedera'] }},{{ $b['detail']['bil_penumpang_mati'] }},{{ $b['detail']['bil_penumpang_cedera'] }},{{ $b['detail']['bil_pejalan_mati'] }},{{ $b['detail']['bil_pejalan_cedera'] }},{{ $b['detail']['latitude'] }},{{ $b['detail']['logitude'] }},{{ $b['detail']['tarikh_kejadian'] }},{{ $b['detail']['tarikh_pengaduan'] }},{{ $b['detail']['status_la'] }},{{ $black['analisa']['count_maut'] }},{{ $black['analisa']['count_parah'] }},{{ $black['analisa']['count_ringan'] }},{{ $black['analisa']['count_rosak'] }},{{ $black['analisa']['count_tidak_diketahui'] }},{{ $black['analisa']['pemberat'] }}
	@endforeach
@endforeach

@endsection

