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
                Proses Data
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <!--Display-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Fail Proses</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-outline btn-success no-laporan">
                            Tambah Fail Laporan 24 Jam
                        </a>
                        <a class="btn btn-outline btn-success pol-27">
                            Tambah Fail POL27
                        </a>
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
                        <table class="table table-striped table-bordered table-hover table-list-file">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>Nama Fail</th>
                                    <th>Status</th>
                                    <th>Tarikh Proses</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Fail</th>
                                    <th>Status</th>
                                    <th>Tarikh Proses</th>
                                    <th>Tindakan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

 {{-- Modal untuk api --}}
    <div class="modal inmodal" id="no-laporan">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                    <h4 class="modal-title">Laporan 24 Jam</h4>
                </div>
                <form id="form-no-laporan">
                    @csrf
                    <div class="modal-body">
                        <div class="message-form"></div>

                        <div class="row tarikh">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Tarikh Laporan</strong><i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        {!! html()->text('startDate', null)
                                        ->class('form-control')
                                        ->attribute('onkeydown', 'return false') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a id="laporan24" class="btn btn-primary">Hantar</a>
                        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk api --}}
    <div class="modal inmodal" id="POL27">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                    <h4 class="modal-title">Laporan POL27</h4>
                </div>
                <form id="form-api-pol27">
                    @csrf
                    <div class="modal-body">
                        <div class="message-form"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Jenis</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    {!! html()->select('Jenis', ['Date' => 'Search By Date'], 'Date')
                                    ->class('form-control')
                                    ->attribute('data-required', 'true')
                                    ->id('jenis27') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row tarikh">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Tarikh Kemalangan Mula</strong><i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        {!! html()->text('startDate1', null)
                                        ->class('form-control')
                                        ->attribute('onkeydown', 'return false') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Tarikh Kemalangan Akhir</strong><i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        {!! html()->text('endDate', null)
                                        ->class('form-control')
                                        ->attribute('onkeydown', 'return false') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row laporan">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>No Laporan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    {!! html()->text('noLaporan', null)->class('form-control') !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <a id="laporan27" class="btn btn-primary">Hantar</a>
                        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk Export List --}}
<div class="modal inmodal" id="export_list">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">List Export</h4>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-list-export">
                                    <thead>
                                    <tr>
                                        <th width="6%">#</th>
                                        <th>No. laporan</th>
                                        <th>Tarikh</th>
                                        <th width="15%">No. Laluan</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th width="6%">#</th>
                                        <th>No. laporan</th>
                                        <th>Tarikh</th>
                                        <th width="15%">No. Laluan</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
        </div>
    </div>
</div>
</div>
        </div>
    </div>
</div>


@endsection

@section('js')
<script src="{{ URL::asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.extend.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ URL::asset('rams/js/dataprocess.js') }}"></script>

<script src="{{ URL::asset('rams/js/sweetalert/sweetalert.min.js') }}"></script>
@endsection