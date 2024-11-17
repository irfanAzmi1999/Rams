@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Analisis Waran Pemasangan Lampu Jalan</h2>
        <ol class="breadcrumb">
            <li>
                Lampu Jalan
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
                    <h5>Laporan Pemasangan Lampu Jalan</h5>
                    <div class="ibox-tools">
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
                                    <th>No Laporan</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>No Laluan</th>
                                    <th>Nama Laluan</th>
                                    <th>Tarikh Kejadian</th>
                                    <th>Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center">1</td>
                                    <td>20241001000101</td>
                                    <td>SELANGOR</td>
                                    <td>PETALING</td>
                                    <td>FT1</td>
                                    <td>JALAN KLANG LAMA</td>
                                    <td>01-10-2024<br /><i class="fa fa-clock-o"></i>12:30:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">2</td>
                                    <td>20240929000202</td>
                                    <td>JOHOR</td>
                                    <td>BATU PAHAT</td>
                                    <td>FT5</td>
                                    <td>JALAN BATU PAHAT-MUAR</td>
                                    <td>29-09-2024<br /><i class="fa fa-clock-o"></i>09:45:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">3</td>
                                    <td>20241003000303</td>
                                    <td>PAHANG</td>
                                    <td>TEMERLOH</td>
                                    <td>FT2</td>
                                    <td>JALAN KUANTAN-KUALA LUMPUR</td>
                                    <td>03-10-2024<br /><i class="fa fa-clock-o"></i>14:50:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">4</td>
                                    <td>20241002000404</td>
                                    <td>PERAK</td>
                                    <td>TAIPING</td>
                                    <td>FT6</td>
                                    <td>JALAN TAIPING-KUALA KANGSAR</td>
                                    <td>2024-10-02<br /><i class="fa fa-clock-o"></i>08:15:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">5</td>
                                    <td>20240928000505</td>
                                    <td>KEDAH</td>
                                    <td>SUNGAI PETANI</td>
                                    <td>FT7</td>
                                    <td>ALAN SUNGAI PETANI-GURUN</td>
                                    <td>28-09-2024<br /><i class="fa fa-clock-o"></i>18:30:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">6</td>
                                    <td>20241004000606</td>
                                    <td>TERENGGANU</td>
                                    <td>DUNGUN</td>
                                    <td>FT3</td>
                                    <td>JALAN KUALA TERENGGANU-KUANTAN</td>
                                    <td>04-10-2024<br /><i class="fa fa-clock-o"></i>11:20:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">7</td>
                                    <td>20240930000707</td>
                                    <td>KELANTAN</td>
                                    <td>GUA MUSANG</td>
                                    <td>FT8</td>
                                    <td>JALAN GUA MUSANG-KUALA LIPIS</td>
                                    <td>30-09-2024<br /><i class="fa fa-clock-o"></i>16:45:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">8</td>
                                    <td>20240927000808</td>
                                    <td>MELAKA</td>
                                    <td>JASIN</td>
                                    <td>FT19</td>
                                    <td>JALAN JASIN-BEMBAN</td>
                                    <td>27-09-2024<br /><i class="fa fa-clock-o"></i>20:10:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">9</td>
                                    <td>20240925000909</td>
                                    <td>PERLIS</td>
                                    <td>KANGAR</td>
                                    <td>FT7</td>
                                    <td>JALAN KANGAR-ARAU</td>
                                    <td>25-09-2024<br /><i class="fa fa-clock-o"></i>17:35:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">10</td>
                                    <td>20241006001010</td>
                                    <td>SABAH</td>
                                    <td>SANDAKAN</td>
                                    <td>FT22</td>
                                    <td>JALAN SANDAKAN-TELUPID</td>
                                    <td>06-10-2024<br /><i class="fa fa-clock-o"></i>09:00:00</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-primary waran-apply" data-toggle="tooltip" data-placement="top" data-id="" title="Permohonan"><i class="fa fa-file-text-o"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLampujalanBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Bil</th>
                                    <th>No Laporan</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>No Laluan</th>
                                    <th>Nama Laluan</th>
                                    <th>Tarikh Kejadian</th>
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