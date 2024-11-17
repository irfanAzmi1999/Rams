@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Audit</h2>
        <ol class="breadcrumb">
            <li>
                Audit
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Audit</h5>
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
                        <table class="table table-striped table-bordered table-hover table-audit">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>Model Semasa</th>
                                    <th>ID Pengguna</th>
                                    <th>Kaedah</th>
                                    <th>Audit ID</th>
                                    <th>Audit Model</th>
                                    <th>Nilai Lama</th>
                                    <th>Nilai Baru</th>
                                    <th>URL</th>
                                    <th>Alamat IP</th>
                                    <th>Agen Semasa</th>
                                    <th>Tag</th>
                                    <th>Tarikh Daftar</th>
                                    <th>Tarikh Kemaskini</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Model Semasa</th>
                                    <th>ID Pengguna</th>
                                    <th>Kaedah</th>
                                    <th>Audit ID</th>
                                    <th>Audit Model</th>
                                    <th>Nilai Lama</th>
                                    <th>Nilai Baru</th>
                                    <th>URL</th>
                                    <th>Alamat IP</th>
                                    <th>Agen Semasa</th>
                                    <th>Tag</th>
                                    <th>Tarikh Daftar</th>
                                    <th>Tarikh Kemaskini</th>
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
$('.table-audit').DataTable({
	processing: true,
	serverSide: true,
	ajax: '{{ route('getAuditData') }}',
	columns: [
		{data: 'id', name: 'id'},
		{data: 'user_type', name: 'user_type'},
		{data: 'user_id', name: 'user_id'},
                {data: 'event', name: 'event'},
                {data: 'auditable_id', name: 'auditable_id'},
                {data: 'auditable_type', name: 'auditable_type'},
                {data: 'old_values', name: 'old_values'},
                {data: 'new_values', name: 'new_values'},
                {data: 'url', name: 'url'},
                {data: 'ip_address', name: 'ip_address'},
                {data: 'user_agent', name: 'user_agent'},
                {data: 'tags', name: 'tags'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
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