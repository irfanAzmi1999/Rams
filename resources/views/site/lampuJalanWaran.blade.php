@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Lampu Jalan Waran Analisis</h2>
        <ol class="breadcrumb">
            <li>
                Laporan Lampu Jalan
            </li>
            <li>
                Laporan Waran
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content" id="wrapper-laporan-awalan">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Laporan Awalan</h5>
                    <div class="ibox-tools">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-outline btn-success dropdown-toggle">Export<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button id="export-excel-fdata" target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">Excel</a></button>
                                </li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-outline btn-success data-bfilter"><i class="fa fa-search"></i> Carian</button>
                        </div>
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
                        <table class="table table-striped table-bordered table-hover table-list-laporan">
                            <thead>
                                <tr>
                                    <th>Bil</th>
                                    <th width="6%">No Laporan</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>No Laluan</th>
                                    <th>Nama Laluan</th>
                                    <th>Tarikh Kejadian</th>
                                    <th>Masa Kejadian</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2052022000383</td>
                                    <td>Negeri Sembilan</td>
                                    <td>Kuala Pilah</td>
                                    <td>23</td>
                                    <td>Jalan Dato</td>
                                    <td>23 Februari 2021</td>
                                    <td>2:00 Petang</td>
                                    <td>
                                        <span class="btn btn-success">
                                            Baru
                                        </span>
                                    </td>
                                    <td>

                                        <!--<a href="{{route('borangWaran')}}" class="btn btn-outline btn-sm btn-primary laporan-awalan-view" data-toggle="tooltip">
                                            <i class="fa fa-search"></i>
                                        </a>-->
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>2052022000383</td>
                                    <td>Negeri Sembilan</td>
                                    <td>Kuala Pilah</td>
                                    <td>23</td>
                                    <td>Jalan Dato</td>
                                    <td>23 Februari 2021</td>
                                    <td>2:00 Petang</td>
                                    <td>
                                        <!--<span class="btn btn-primary">
                                            Waran
                                        </span>-->
                                    </td>
                                    <td>

                                        <a href="{{route('borangWaran')}}" class="btn btn-outline btn-sm btn-primary laporan-awalan-view" data-toggle="tooltip">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Bil</td>
                                    <th width="6%">No Laporan</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>No Laluan</th>
                                    <th>Nama Laluan</th>
                                    <th>Tarikh Kejadian</th>
                                    <th>Masa Kejadian</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Tindakan</th>
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