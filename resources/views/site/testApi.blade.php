@extends('layouts/main/main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Data Kemalangan</h2>
            <ol class="breadcrumb">
                <li>
                    Data Kemalangan
                </li>
                <li>
                    Test data Api
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Test data Api</h5>
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
                            <table class="table table-striped table-bordered table-hover table-list-laporan">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Api</th>
                                    <th>Api Link</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>PDRM</td>
                                    <td><a href="{{Request::root()}}/apiTest/1/startdate/enddate">Report24</a></td>
                                </tr><tr>
                                    <td>2</td>
                                    <td>PDRM</td>
                                    <td><a href="{{Request::root()}}/apiTest/2/startdate/enddat">Pol27</a></td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection