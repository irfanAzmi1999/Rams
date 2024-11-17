@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Analisis Waran Lintasan Pejalan Kaki Searas Berlampu Isyarat</h2>
        <ol class="breadcrumb">
            <li>
                Lintasan Pejalan Kaki Searas Berlampu Isyarat
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
                    <h5>Laporan Lintasan Pejalan Kaki Searas Berlampu Isyarat</h5>
                    <div class="ibox-tools">
                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-success data-bfilter"><i class="fa fa-file-text-o"></i> Daftar</a>
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
                                    <td>PETALING</td>
                                    <td>FT2</td>
                                    <td>JALAN KUALA LUMPUR-SHAH ALAM</td>
                                    <td>15</td>
                                    <td>3.0830</td>
                                    <td>101.5565</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">2</td>
                                    <td>JOHOR</td>
                                    <td>MUAR</td>
                                    <td>FT5</td>
                                    <td>JALAN MUAR-BATU PAHAT</td>
                                    <td>8</td>
                                    <td>2.0506</td>
                                    <td>102.5689</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">3</td>
                                    <td>PERAK</td>
                                    <td>KAMPAR</td>
                                    <td>FT1</td>
                                    <td>JALAN IPOH-TAPAH</td>
                                    <td>37</td>
                                    <td>4.3061</td>
                                    <td>101.1545</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">4</td>
                                    <td>PAHANG</td>
                                    <td>KUANTAN</td>
                                    <td>FT3</td>
                                    <td>JALAN KUANTAN-GAMBAK</td>
                                    <td>20</td>
                                    <td>3.8255</td>
                                    <td>103.3261</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">5</td>
                                    <td>KEDAH</td>
                                    <td>POKOK SENA</td>
                                    <td>FT1</td>
                                    <td>JALAN ALOR SETAR-POKOK SENA</td>
                                    <td>5</td>
                                    <td>6.1844</td>
                                    <td>100.4250</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">6</td>
                                    <td>MELAKA</td>
                                    <td>MELAKA TENGAH</td>
                                    <td>FT19</td>
                                    <td>JALAN MELAKA-JASIN</td>
                                    <td>18</td>
                                    <td>2.2869</td>
                                    <td>102.4217</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">7</td>
                                    <td>KELANTAN</td>
                                    <td>KOTA BHARU</td>
                                    <td>FT8</td>
                                    <td>JALAN KOTA BHARU-KUALA KRAI</td>
                                    <td>29</td>
                                    <td>6.1306</td>
                                    <td>102.2386</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">8</td>
                                    <td>NEGERI SEMBILAN</td>
                                    <td>JELEBU</td>
                                    <td>FT86</td>
                                    <td>JALAN JELEBU-REMBAU</td>
                                    <td>12</td>
                                    <td>2.9510</td>
                                    <td>102.0984</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">9</td>
                                    <td>TERENGGANU</td>
                                    <td>HULU TERENGGANU</td>
                                    <td>FT14</td>
                                    <td>JALAN KUALA BERANG-AJIL</td>
                                    <td>24</td>
                                    <td>5.0575</td>
                                    <td>102.9790</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center">10</td>
                                    <td>PERLIS</td>
                                    <td>ARAU</td>
                                    <td>FT7</td>
                                    <td>JALAN ARAU-KANGAR</td>
                                    <td>6</td>
                                    <td>6.4281</td>
                                    <td>100.2754</td>
                                    <td><span class="label label-black text-12">BARU</span></td>
                                    <td>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-primary waran-view" data-toggle="tooltip" data-placement="top" data-id="" title="Papar"><i class="fa fa-search"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-warning waran-edit" data-toggle="tooltip" data-placement="top" data-id="" title="Kemaskini"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('waranLpksiBorang')}}" class="btn btn-outline btn-sm btn-danger waran-delete" data-toggle="tooltip" data-placement="top" data-id="" title="Hapus"><i class="fa fa-trash"></i></a>
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