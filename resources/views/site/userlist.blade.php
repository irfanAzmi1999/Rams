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
                Pengguna
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Pengguna</h5>
                    <div class="ibox-tools">
                        @if(Auth::user()->admin())
                        <a class="btn btn-outline btn-success user-new">
                            Daftar Pengguna
                        </a>
                        @endif
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
                        <table class="table table-striped table-bordered table-hover table-list-user">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>Nama Penuh</th>
                                    <th>No. Kad Pengenalan</th>
                                    <th>Bahagian/Negeri/Daerah</th>
                                    <th>Peranan</th>
                                    <th>Tarikh Daftar</th>
                                    <th>Status</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Penuh</th>
                                    <th>No. Kad Pengenalan</th>
                                    <th>Bahagian/Negeri/Daerah</th>
                                    <th>Peranan</th>
                                    <th>Tarikh Daftar</th>
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

<div class="modal inmodal" id="modal-new-user">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Daftar Maklumat Pengguna Baru</h4>
            </div>
            <form id="form-new-user">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Penuh</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="fullname" class="form-control" placeholder="Nama Penuh" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Kad Pengenalan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="icno" class="form-control" placeholder="Nombor Kad Pengenalan" data-required="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Kata Laluan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" placeholder="Kata Laluan" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Bahagian</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
									{!! html()->select('department_id', $department, old('department_id'))
                                    ->class('form-control m-b chosen-department')
                                    ->attribute('data-required', 'true')
                                    ->placeholder('Pilih Bahagian') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Alamat Emel</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control" placeholder="Alamat Emel" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Peranan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    @if(Auth::user()->admin())

									{!! html()->select('role_id', $role, old('role_id'))
                                    ->class('form-control m-b chosen-role')
                                    ->attribute('data-required', 'true')
                                    ->placeholder('Pilih Peranan') !!}

                                    @elseif(Auth::user()->adminjkr())

                                    <select data-placeholder="Pilih Peranan" class="form-control m-b chosen-role" name="role_id">
                                        <option value="">Pilih Peranan</option>
                                        <option value="4">PENTADBIR JKR</option>
                                        <option value="5">JKR NEGERI</option>
                                        <option value="6">JKR DAERAH</option>
                                        <option value="2">PENGGUNA SISTEM</option>
                                        <option value="99">TIDAK DIKETAHUI</option>
                                    </select>

                                    @elseif(Auth::user()->jkrnegeri())

                                    <select data-placeholder="Pilih Peranan" class="form-control m-b chosen-role" name="role_id">
                                        <option value="">Pilih Peranan</option>
                                        <option value="5">JKR NEGERI</option>
                                        <option value="6">JKR DAERAH</option>
                                        <option value="2">PENGGUNA SISTEM</option>
                                        <option value="99">TIDAK DIKETAHUI</option>
                                    </select>

                                    @elseif(Auth::user()->daerah())

                                    <select data-placeholder="Pilih Peranan" class="form-control m-b chosen-role" name="role_id">
                                        <option value="">Pilih Peranan</option>
                                        <option value="6">JKR DAERAH</option>
                                        <option value="2">PENGGUNA SISTEM</option>
                                        <option value="99">TIDAK DIKETAHUI</option>
                                    </select>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-state" style="display:none">
                                <label><strong>Negeri</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    @if(Auth::user()->admin() || Auth::user()->adminjkr())

									{!! html()->select('negeri_id', $negeri, old('negeri_id'))
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri') !!}

                                    @elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah())

                                    {!! html()->select('negeri_id', $negeri, Auth::user()->negeri_id)
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri')
                                    ->attribute('disabled', true) !!}

                                    <input type="hidden" name="negeri_id" value="{{Auth::user()->negeri_id}}">

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-district" style="display:none">
                                <label><strong>Daerah</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
									<select data-placeholder="Pilih Daerah" class="form-control m-b chosen-district" name="daerah_id[]" multiple>
                                        <option value="" disabled>Pilih Daerah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="register-user" class="btn btn-primary">Daftar</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-view-user">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Papar Maklumat Pengguna</h4>
            </div>
            <form id="form-view-user">
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Penuh</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="v_full_name" class="form-control" placeholder="Nama Penuh" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Kad Pengenalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="v_nric" class="form-control" placeholder="Nombor Kad Pengenalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Peranan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    <input type="text" name="v_role" class="form-control" placeholder="Peranan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-v-state" style="display:none">
                            <div class="form-group">
                                <label><strong>Negeri</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
                                    <input type="text" name="v_state" class="form-control" placeholder="Negeri" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-v-district" style="display:none">
                                <label><strong>Daerah</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" name="v_district" class="form-control" placeholder="Daerah" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Bahagian</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <input type="text" name="v_department" class="form-control" placeholder="Bahagian" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Alamat Emel</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input type="text" name="v_email" class="form-control" placeholder="Alamat Emel" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Akaun Diwujudkan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-save"></i>
                                    </span>
                                    <input type="text" name="v_created_date" class="form-control" placeholder="Tarikh Akaun Diwujudkan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Terakhir Log Masuk</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sign-in"></i>
                                    </span>
                                    <input type="text" name="v_logged_in_date" class="form-control" placeholder="Tarikh Terakhir Log Masuk" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Terakhir Log Keluar</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sign-out"></i>
                                    </span>
                                    <input type="text" name="v_logged_out_date" class="form-control" placeholder="Tarikh Terakhir Log Keluar" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-edit-user">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Kemaskini Maklumat Pengguna</h4>
            </div>
            <form id="form-edit-user">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
					<input type="hidden" name="e_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Penuh</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="e_full_name" class="form-control" placeholder="Nama Penuh" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Kad Pengenalan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="e_nric" class="form-control" placeholder="Nombor Kad Pengenalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Peranan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    @if(Auth::user()->admin())

									{!! html()->select('e_role', $role, old('role_id'))
                                    ->class('form-control m-b chosen-e-role')
                                    ->attribute('data-required', 'true')
                                    ->placeholder('Pilih Peranan') !!}

                                    @elseif(Auth::user()->adminjkr())

                                    <select data-placeholder="Pilih Peranan" class="form-control m-b chosen-e-role" name="e_role">
                                        <option value="">Pilih Peranan</option>
                                        <option value="4">PENTADBIR JKR</option>
                                        <option value="5">JKR NEGERI</option>
                                        <option value="6">JKR DAERAH</option>
                                        <option value="2">PENGGUNA SISTEM</option>
                                        <option value="99">TIDAK DIKETAHUI</option>
                                    </select>

                                    @elseif(Auth::user()->jkrnegeri())

                                    <select data-placeholder="Pilih Peranan" class="form-control m-b chosen-e-role" name="e_role">
                                        <option value="">Pilih Peranan</option>
                                        <option value="5">JKR NEGERI</option>
                                        <option value="6">JKR DAERAH</option>
                                        <option value="2">PENGGUNA SISTEM</option>
                                        <option value="99">TIDAK DIKETAHUI</option>
                                    </select>

                                    @elseif(Auth::user()->daerah())

                                    <select data-placeholder="Pilih Peranan" class="form-control m-b chosen-e-role" name="e_role">
                                        <option value="">Pilih Peranan</option>
                                        <option value="6">JKR DAERAH</option>
                                        <option value="2">PENGGUNA SISTEM</option>
                                        <option value="99">TIDAK DIKETAHUI</option>
                                    </select>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-e-state" style="display:none">
                                <label><strong>Negeri</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
                                    @if(Auth::user()->admin() || Auth::user()->adminjkr())

                                    {!! html()->select('e_state', $negeri, old('negeri_id'))
                                    ->class('form-control m-b chosen-e-state tah')
                                    ->placeholder('Pilih Negeri') !!}

                                    @elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah())

                                    {!! html()->select('e_state', $negeri, Auth::user()->negeri_id)
                                    ->class('form-control m-b chosen-e-state tah')
                                    ->placeholder('Pilih Negeri') !!}

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-e-district" style="display:none">
                                <label><strong>Daerah</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>

									<select data-placeholder="Pilih Daerah" class="form-control m-b chosen-e-district" name="e_district[]" multiple>
                                        <option value="" disabled>Pilih Daerah</option>
                                    </select>
                                    <input type="hidden" id="districttemp" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Bahagian</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
									{!! html()->select('e_department', $department, old('department_id'))
                                    ->class('form-control m-b chosen-department')
                                    ->attribute('data-required', 'true')
                                    ->placeholder('Pilih Bahagian') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Alamat Emel</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input type="text" name="e_email" class="form-control" placeholder="Alamat Emel" data-required="true" />
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->admin() || Auth::user()->adminjkr())
						<div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Kata Laluan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="e_password" class="form-control" placeholder="Kata Laluan" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <a id="update-user" class="btn btn-primary">Simpan</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-delete-user">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Hapus Maklumat Pengguna
                    <br /><small>Anda pasti untuk menghapuskan maklumat pengguna ini?</small>
                </h4>
            </div>
            <form id="form-delete-user">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <input type="hidden" name="d_id" class="user-id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Penuh</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="d_full_name" class="form-control" placeholder="Nama Pertama" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Kad Pengenalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="d_nric" class="form-control" placeholder="Nombor Kad Pengenalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Peranan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    <input type="text" name="d_role" class="form-control" placeholder="Peranan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-d-state" style="display:none">
                                <label><strong>Negeri</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
                                    <input type="text" name="d_state" class="form-control" placeholder="Negeri" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-d-district" style="display:none">
                                <label><strong>Daerah</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <input type="text" name="d_district" class="form-control" placeholder="Daerah" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Bahagian</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <input type="text" name="d_department" class="form-control" placeholder="Bahagian" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Alamat Emel</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input type="text" name="d_email" class="form-control" placeholder="Alamat Emel" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete-user" class="btn btn-primary">Hapus</a>
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
<script src="{{ URL::asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('rams/js/userlist.js') }}"></script>
<script>
$('.table-list-user').DataTable({
	processing: true,
	serverSide: true,
	ajax: '{{ route('getUserData') }}',
	columns: [
		{data: 'id', name: 'id'},
		{data: 'fullname', name: 'fullname'},
		{data: 'icno', name: 'icno'},
		{data: 'department', name: 'department.name'},
		{data: 'role', name: 'role.name'},
		{data: 'created_at', name: 'created_at'},
		{data: 'sekatan', name: 'sekatan'},
		{data: 'action', name: 'action'},
	],
	pageLength: 25,
	responsive: true,
	dom: 'lTfgitp',
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

$(document).on('change','.chosen-state',function() {
    if($('.chosen-role option:selected').val() == 6){
        $('.form-district').show('500');
        $('.chosen-district').html('').trigger("chosen:updated");

        $.ajax({
            type: 'GET',
            url : 'populateDaerah',
            data : {
                negeri : $(this).val()
            },
            success:function(data){
                $('.chosen-district').append('<option value="">Pilih Daerah</option>').trigger("chosen:updated");
                $.each(data, function(k,v){
                    $('.chosen-district').append('<option value="'+v.id+'">'+v.name+'</option>').trigger("chosen:updated");
                });
                @if(Auth::user()->jkrdaerah())
                    $('.chosen-district').val(56).prop('disabled',true).trigger("chosen:updated");
                    $('.chosen-district').append('<input name="daerah_id" type="hidden" value="56">');
                @endif
            }
        });
    }
});

$(document).on('click','.user-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-user').modal('show');
    $('#form-edit-user')[0].reset();
	$('.message-form').html('');

	$.ajax({
		url: "ajaxViewUser&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
			$('[name="e_id"]').val(data.id);
			$('[name="e_full_name"]').val(data.fullname);
			$('[name="e_nric"]').val(data.icno);
			$('[name="e_role"]').val(data.role_id).trigger('chosen:updated');
			$('[name="e_department"]').val(data.department_id).trigger('chosen:updated');
			$('[name="e_state"]').val(data.negeri_id).trigger('chosen:updated');
            $('[name="e-district"]').val(data.district_id);//.trigger("chosen:updated");
			$('#districttemp').val(data.district_id);
			$('[name="e_email"]').val(data.email);
            $('.chosen-e-role').change();
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});


$(document).on('change','.chosen-e-state',function() {
    if($('.chosen-e-role option:selected').val() == 6){
        $('.form-e-district').show('500');
        $('.chosen-e-district').html('').trigger("chosen:updated");

        $.ajax({
            type: 'GET',
            url : 'populateDaerah',
            data : {
                negeri : $(this).val()
            },
            success:function(data){
                $('.chosen-e-district').append('<option value="">Pilih Daerah</option>').trigger("chosen:updated");
                $.each(data, function(k,v){
                    var daerah_ids = $('#districttemp').val().split(',');
                    console.log(daerah_ids);
                    console.log("v.id:"+v.id.toString());
                    console.log("jquery: " + jQuery.inArray(v.id.toString(), daerah_ids));
                    // if(v.id == $('#districttemp').val()){
                    var selected = '';
                    if(jQuery.inArray(v.id.toString(), daerah_ids) != -1){
                    // if(daerah_ids.includes(v.id)){
                        selected = 'selected';
                    }
                    $('.chosen-e-district').append('<option value="'+v.id+'" '+selected+'>'+v.name+'</option>').trigger("chosen:updated");
                });

            }
        });
    }
});
</script>
@endsection