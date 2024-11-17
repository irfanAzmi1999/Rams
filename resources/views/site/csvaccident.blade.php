@extends('layouts/main/csv')

@section('content')

KEMENTERIAN KERJA RAYA
SISTEM PENGURUSAN KEMALANGAN JALAN RAYA

"Negeri","Daerah","Kategori Jalan","Tempat Kejadian","No Laporan","No Laluan","No Seksyen","Pos Kilometer","Latitude","Longitude","Jenis Kemalangan","Bulan","Jenis Permukaan","Keadaan Jalan","Kualiti Permukaan","Sistem Laluan","Cuaca","Jenis Langgar Pertama","Bentuk Jalan","Jenis Garis","Muka Jalan","Sebab Cacat Jalan","Cahaya","Tarikh Kejadian","Tarikh Pengaduan","Tahun","Status"

@foreach($datacontent as $accidents)
    {{$accidents->negeri->name}},{{$accidents->daerah->name}},{{$accidents->jenisJalan->name}},{{$accidents->tempat_kejadian}},{{$accidents->no_laporan}},{{$accidents->no_laluan}},{{$accidents->nombor_seksyen}},{{$accidents->pos_kilometer}},{{$accidents->latitude}},{{$accidents->logitude}},{{$accidents->jenisKemalangan->name}},{{$accidents->bulan->name}},{{$accidents->jenisPermukaan->name}},{{$accidents->keadaanJalan->name}},{{$accidents->kualitiPermukaan->name}},{{$accidents->sistemLaluan->name}},{{$accidents->cuaca->name}},{{$accidents->jenisLanggarPertama->name}},{{$accidents->bentukJalan->name}},{{$accidents->jenisGaris->name}},{{$accidents->mukaJalan->name}},{{$accidents->sebabCacatJalan->name}},{{$accidents->cahaya->name}},{{$accidents['tarikh_kejadian']}},{{$accidents['tarikh_pengaduan']}},{{$accidents['tahun']}},{{$accidents['status_la']}},
@endforeach

@endsection

