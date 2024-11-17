@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Pengurusan Pengguna</h2>
        <ol class="breadcrumb">
            <li>
                Pengurusan Pengguna
            </li>
            <li>
                Akses
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Akses</h5>
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
                        <table class="table table-striped table-bordered table-hover table-list-access">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>Akses Modul</th>
                                    <th>Akses Halaman</th>
                                    <th width="25%">Akses Oleh</th>
                                    <th width="5%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">1</span>
                                    </td>
                                    <td>PENGURUSAN IDENTITI</td>
                                    <td>PENGURUSAN IDENTITI</td>
                                    <td>
                                        <span class="label label-danger">PENTADBIR SISTEM</span>
                                        <span class="label label-success">PENGGUNA SISTEM</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline btn-sm btn-warning access-edit" data-toggle="tooltip" data-placement="top" title="Kemaskini Akses"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">2</span>
                                    </td>
                                    <td>PENGURUSAN PENGGUNA</td>
                                    <td>PENGGUNA</td>
                                    <td>
                                        <span class="label label-danger">PENTADBIR SISTEM</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline btn-sm btn-warning access-edit" data-toggle="tooltip" data-placement="top" title="Kemaskini Akses"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">3</span>
                                    </td>
                                    <td>PENGURUSAN PENGGUNA</td>
                                    <td>PERANAN</td>
                                    <td>
                                        <span class="label label-danger">PENTADBIR SISTEM</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline btn-sm btn-warning access-edit" data-toggle="tooltip" data-placement="top" title="Kemaskini Akses"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">4</span>
                                    </td>
                                    <td>PENGURUSAN PENGGUNA</td>
                                    <td>AKSES</td>
                                    <td>
                                        <span class="label label-danger">PENTADBIR SISTEM</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline btn-sm btn-warning access-edit" data-toggle="tooltip" data-placement="top" title="Kemaskini Akses"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">5</span>
                                    </td>
                                    <td>DATA KEMALANGAN</td>
                                    <td>PROSES DATA</td>
                                    <td>
                                        <span class="label label-danger">PENTADBIR SISTEM</span>
                                        <span class="label label-success">PENGGUNA SISTEM</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline btn-sm btn-warning access-edit" data-toggle="tooltip" data-placement="top" title="Kemaskini Akses"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">6</span>
                                    </td>
                                    <td>DATA KEMALANGAN</td>
                                    <td>PAPARAN DATA</td>
                                    <td>
                                        <span class="label label-danger">PENTADBIR SISTEM</span>
                                        <span class="label label-success">PENGGUNA SISTEM</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline btn-sm btn-warning access-edit" data-toggle="tooltip" data-placement="top" title="Kemaskini Akses"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <span class="badge badge-primary">7</span>
                                    </td>
                                    <td>KAWASAN KERAP KEMALANGAN</td>
                                    <td>KAWASAN KERAP KEMALANGAN</td>
                                    <td>
                                        <span class="label label-danger">PENTADBIR SISTEM</span>
                                        <span class="label label-success">PENGGUNA SISTEM</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline btn-sm btn-warning access-edit" data-toggle="tooltip" data-placement="top" title="Kemaskini Akses"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Akses Modul</th>
                                    <th>Akses Halaman</th>
                                    <th>Akses Oleh</th>
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

<div class="modal inmodal" id="modal-edit-access">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Kemaskini Maklumat Akses</h4>
            </div>
            <form id="form-edit-access">
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Akses Modul</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    <input type="text" name="e_modul_access_name" class="form-control" placeholder="Nama Akses Modul" value="PENGURUSAN PENGGUNA" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Akses Halaman</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-file-text-o"></i>
                                    </span>
                                    <input type="text" name="e_page_access_name" class="form-control" placeholder="Nama Akses Halaman" value="PENGGUNA" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Peranan Akses Halaman</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    <select data-placeholder="Pilih Peranan" name="e_role_access_name" class="form-control chosen-role" multiple="true" data-required="true">
                                        <option></option>
                                        <option>PENTADBIR SISTEM</option>
                                        <option>PENGGUNA SISTEM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="update-access" class="btn btn-primary">Simpan</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.extend.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ URL::asset('rams/js/useraccess.js') }}"></script>
@endsection