@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Senggara</h2>
        <ol class="breadcrumb">
            <li>
                Senggara
            </li>
            <li>
                Jenis Kawalan
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Jenis Kawalan</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-outline btn-success jenisKawalan-new">
                            Daftar Jenis Kawalan
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
                        <table class="table table-striped table-bordered table-hover table-list-jenisKawalan">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>Jenis Kawalan</th>
                                    <th width="5%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Kawalan</th>
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

<div class="modal inmodal" id="modal-new-jenisKawalan">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Daftar Maklumat Jenis Kawalan</h4>
            </div>
            <form id="form-new-jenisKawalan">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Jenis Kawalan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control" placeholder="Nama Jenis Kawalan" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="register-jenisKawalan" class="btn btn-primary">Daftar</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-edit-jenisKawalan">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Kemaskini Maklumat Jenis Kawalan</h4>
            </div>
            <form id="form-edit-jenisKawalan">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
					<input type="hidden" name="e_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Jenis Kawalan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    <input type="text" name="e_name" class="form-control" placeholder="Nama Peranan" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="update-jenisKawalan" class="btn btn-primary">Simpan</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-delete-jenisKawalan">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Hapus Maklumat Jenis Kawalan
                    <br /><small>Anda pasti untuk menghapuskan maklumat Jenis Kawalan ini?</small>
                </h4>
            </div>
            <form id="form-delete-jenisKawalan">
				@csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <input type="hidden" name="d_id" class="jenisKawalan-id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Jenis Kawalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sliders"></i>
                                    </span>
                                    <input type="text" name="d_name" class="form-control" placeholder="Nama Peranan" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete-jenisKawalan" class="btn btn-primary">Hapus</a>
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
<script src="{{ URL::asset('rams/js/jenisKawalan.js') }}"></script>
<script>
$('.table-list-jenisKawalan').DataTable({
	processing: true,
	serverSide: true,
	ajax: '{{ route('getJenisKawalanData') }}',
	columns: [
		{data: 'id', name: 'id'},
		{data: 'name', name: 'name'},
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
</script>
@endsection