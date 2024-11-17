@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Data Jalan</h2>
        <ol class="breadcrumb">
            <li>
                Data Jalan
            </li>
            <li>
                Data Jalan
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Jalan</h5>
                    <div class="ibox-tools">
                        @if(Auth::user()->admin())
                        <a class="btn btn-outline btn-success jalan-new">
                            Daftar
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
                        <table class="table table-striped table-bordered table-hover table-list-jalan">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>No. Laluan</th>
                                    <th>Nama Jalan</th>
                                    <th>Negeri</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>No. Laluan</th>
                                    <th>Nama Jalan</th>
                                    <th>Negeri</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Daftar Jalan --}}
<div class="modal inmodal" id="modal-new-jalan">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Daftar Maklumat Jalan Baru</h4>
            </div>
                <form id="form-new-jalan" method="POST" action="{{ url('/ajaxRegisterJalan') }}">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Kategori Jalan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <select name="code" class="form-control chosen-select" data-required="true" placeholder="Kategori Jalan">
                                        <option value="" disabled selected>Pilih Kategori Jalan</option>
                                        @foreach($code as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Laluan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="nolaluan" class="form-control" placeholder="Nombor Laluan" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Jalan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Jalan" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Panjang Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="panjang" class="form-control" placeholder="Panjang Jalan"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label><strong>Negeri</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
									{!! html()->select('negeri_id', $negeri, old('negeri_id'))
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Warta Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="nowarta" class="form-control" placeholder="Nombor Warta Jalan" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="register-jalan" class="btn btn-primary">Daftar</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Tindakan-Papar Jalan --}}
<div class="modal inmodal" id="modal-view-jalan">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Papar Maklumat Jalan</h4>
            </div>
            <form id="form-view-jalan">
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Kategori Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <input type="text" name="v_code" class="form-control" placeholder="Kategori Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Laluan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="v_no_laluan" class="form-control" placeholder="Nombor Laluan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="v_name" class="form-control" placeholder="Nama Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Panjang Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
                                    <input type="text" name="v_panjang" class="form-control" placeholder="Panjang Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Warta Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
                                    <input type="text" name="v_nowarta" class="form-control" placeholder="Negeri" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Dikemaskini Oleh</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="v_updated_by" class="form-control" placeholder="Dikemaskini" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Dikemaskini Pada</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="v_updated_at" class="form-control" placeholder="Tarikh Kemaskini" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tindakan Kemaskini Maklumat Jalan --}}
<div class="modal inmodal" id="modal-edit-jalan">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Kemaskini Maklumat Jalan</h4>
            </div>
            <form id="form-edit-jalan">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
					<input type="hidden" name="e_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Kategori Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    {!! html()->select('e_code', $code, old('e_code'))
                                    ->class('form-control chosen-select')
                                    ->placeholder('Pilih Kategori Jalan') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Laluan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="e_no_laluan" class="form-control" placeholder="Nombor Laluan" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Jalan</strong></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="e_name" class="form-control" placeholder="Nama Jalan"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Panjang Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="e_panjang" class="form-control" placeholder="Panjang Jalan"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label><strong>Negeri</strong></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
									{!! html()->select('e_state', $negeri, old('negeri_id'))
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Warta Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="e_nowarta" class="form-control" placeholder="Nombor Warta Jalan" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="update-jalan" class="btn btn-primary">Simpan</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tindakan Delete Maklumat Jalan --}}
<div class="modal inmodal" id="modal-delete-jalan">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Hapus Maklumat Jalan
                    <br /><small>Anda pasti untuk menghapuskan maklumat jalan ini?</small>
                </h4>
            </div>
            <form id="form-delete-jalan">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <input type="hidden" name="d_id" class="jalan-id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Kategori Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                    <input type="text" name="d_code" class="form-control" placeholder="Kategori Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Laluan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="d_nolaluan" class="form-control" placeholder="Nombor Laluan Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="d_nama" class="form-control" placeholder="Nama Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Panjang Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="d_panjang" class="form-control" placeholder="Panjang Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Negeri</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-flag"></i>
                                    </span>
                                    <input type="text" name="d_state" class="form-control" placeholder="Negeri" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombor Warta Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-drivers-license-o"></i>
                                    </span>
                                    <input type="text" name="d_nowarta" class="form-control" placeholder="Nombor Warta Jalan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete-jalan" class="btn btn-primary">Hapus</a>
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
<script src="{{ URL::asset('rams/js/jalanlist.js') }}"></script>
<script>
$('.table-list-jalan').DataTable({
	processing: true,
	serverSide: true,
    searching: true,
	ajax: {
        url: '{{ route('getDataJalan') }}',
        data: function (d) {
            d.nolaluan = $('input[name=nolaluan]').val();
            d.nama = $('input[name=nama]').val();
            d.negeri = $('select[name=negeri]').val();
        }
    },
	columns: [
        {data: 'DT_RowIndex', sortable: false, searchable: false},
		{data: 'nolaluan', name: 'nolaluan'},
		{data: 'nama', name: 'nama'},
		{data: 'negeri', name: 'negeri'},
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

$(document).on('click','.jalan-edit',function() {
	var id = $(this).data('id');
    $('#modal-edit-jalan').modal('show');
    $('#form-edit-jalan')[0].reset();
	$('.message-form').html('');

	$.ajax({
		url: "ajaxViewJalan&id=" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
			$('[name="e_id"]').val(data.id);
			$('[name="e_no_laluan"]').val(data.nolaluan);
			$('[name="e_name"]').val(data.nama);
            $('[name="e_code"]').val(data.code);
            $('[name="e_state"]').val(data.negeri_id).trigger('chosen:updated');
            $('[name="e_panjang"]').val(data.panjang);
            $('[name="e_nowarta"]').val(data.nowarta);

            // $('.chosen-state').chosen();
            // $('.chosen-state').on('change', function () {
            //     var selectedValue = $(this).val();
            //     $('[name="e_state"]').val(selectedValue);
            // });

		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
});



</script>
@endsection