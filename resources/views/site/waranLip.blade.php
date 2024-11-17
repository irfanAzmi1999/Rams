@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Analisis Waran Lampu Isyarat Di Persimpangan</h2>
        <ol class="breadcrumb">
            <li>
                Lampu Isyarat Di Persimpangan
            </li>
            <li>
                Analisis Waran
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Laporan Lampu Isyarat Di Persimpangan</h5>
                    <div class="ibox-tools">
                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-success data-bfilter"><i class="fa fa-file-text-o"></i> Daftar</a>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-analisis-laporan" >
                            <thead>
                                <tr>
                                    <th>Bil</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>No Laluan</th>
                                    <th>Nama Laluan</th>
                                    <th>No Seksyen</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center">1</td>
                                    <td>SELANGOR</td>
                                    <td>HULU SELANGOR</td>
                                    <td>FT1</td>
                                    <td>JALAN KUALA LUMPUR-RAWANG</td>
                                    <td>18</td>
                                    <td>3.3750</td>
                                    <td>101.5753</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">2</td>
                                    <td>JOHOR</td>
                                    <td>BATU PAHAT</td>
                                    <td>FT5</td>
                                    <td>JALAN BATU PAHAT-KLUANG</td>
                                    <td>12</td>
                                    <td>1.8501</td>
                                    <td>102.9335</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">3</td>
                                    <td>PERAK</td>
                                    <td>BATANG PADANG</td>
                                    <td>FT1</td>
                                    <td>JALAN IPOH-KUALA LUMPUR</td>
                                    <td>45</td>
                                    <td>4.2007</td>
                                    <td>101.2614</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">4</td>
                                    <td>PAHANG</td>
                                    <td>TEMERLOH</td>
                                    <td>FT2</td>
                                    <td>JALAN TEMERLOH-BENTONG</td>
                                    <td>22</td>
                                    <td>3.4638</td>
                                    <td>102.4275</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">5</td>
                                    <td>KEDAH</td>
                                    <td>BANDAR BAHARU</td>
                                    <td>FT1</td>
                                    <td>JALAN BUTTERWORTH-KULIM</td>
                                    <td>30</td>
                                    <td>5.4116</td>
                                    <td>100.5584</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">6</td>
                                    <td>MELAKA</td>
                                    <td>JASIN</td>
                                    <td>FT19</td>
                                    <td>JALAN JASIN-BEMBAN</td>
                                    <td>8</td>
                                    <td>2.3050</td>
                                    <td>102.4286</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">7</td>
                                    <td>KELANTAN</td>
                                    <td>MACHANG</td>
                                    <td>FT8</td>
                                    <td>JALAN KUALA KRAI-MACHANG</td>
                                    <td>16</td>
                                    <td>5.7625</td>
                                    <td>102.2098</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">8</td>
                                    <td>NEGERI SEMBILAN</td>
                                    <td>TAMPIN</td>
                                    <td>FT1</td>
                                    <td>JALAN TAMPIN-ALOR GAJAH</td>
                                    <td>11</td>
                                    <td>2.4655</td>
                                    <td>102.2270</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">9</td>
                                    <td>TERENGGANU</td>
                                    <td>SETIU</td>
                                    <td>FT3</td>
                                    <td>JALAN KUALA TERENGGANU-JERTEH</td>
                                    <td>33</td>
                                    <td>5.5649</td>
                                    <td>102.7442</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">10</td>
                                    <td>PERLIS</td>
                                    <td>PADANG BESAR</td>
                                    <td>FT7</td>
                                    <td>JALAN PADANG BESAR-KANGAR</td>
                                    <td>3</td>
                                    <td>6.6602</td>
                                    <td>100.2439</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLipBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Bil</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>No Laluan</th>
                                    <th>Nama Laluan</th>
                                    <th>No Seksyen</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ URL::asset('inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.table-analisis-laporan').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ],
                language: {
                    decimal:        "",
                    emptyTable:     "Tiada data",
                    info:           "Paparan _START_ sehingga _END_ daripada _TOTAL_ rekod",
                    infoEmpty:      "Paparan 0 sehingga 0 daripada 0 rekod",
                    infoFiltered:   "(Tapisan daripada _MAX_ jumlah rekod)",
                    infoPostFix:    "",
                    thousands:      ",",
                    lengthMenu:     "Paparan _MENU_ rekod",
                    loadingRecords: "Sedang memuatkan...",
                    processing:     "Sedang diproses...",
                    search:         "Carian:",
                    zeroRecords:    "Tiada rekod yang dijumpai",
                    paginate: {
                        first:      "Pertama",
                        last:       "Terakhir",
                        next:       "Berikut",
                        previous:   "Terdahulu"
                    },
                    aria: {
                        sortAscending:  ": aktif untuk susunan jaluran menaik",
                        sortDescending: ": aktif untuk susunan jaluran menurun"
                    }
                }
            });
        });
    </script>    
@endsection