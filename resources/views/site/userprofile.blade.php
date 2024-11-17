@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Maklumat Pengguna</h2>
        <ol class="breadcrumb">
            <li>
                Maklumat Pengguna
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
                    <h5>Maklumat Pengguna</h5>
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
                        <table class="table table-striped table-bordered table-hover table-list-user">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>Nama Penuh</th>
                                    <th>No. Kad Pengenalan</th>
                                    <th>Bahagian</th>
                                    <th>Peranan</th>
                                    <th>Tarikh Daftar</th>
                                    <th>Status</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Kata Laluan</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="e_password" class="form-control" placeholder="Kata Laluan" data-required="true"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a id="update-profile-user" class="btn btn-primary">Simpan</a>
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
    ajax: '{{ route('getUserProfil') }}',
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
    lengthChange: false,
    info:false,
    paging:false,
    searching:false,
    responsive: true,
    dom: 'lTfgitp',
    language: {
        decimal: "",
        emptyTable: "Tiada data",
        info: "Paparan _START_ sehingga _END_ daripada _TOTAL_ rekod",
        infoEmpty: "Paparan 0 sehingga 0 daripada 0 rekod",
        infoFiltered: "(Tapisan daripada _MAX_ jumlah rekod)",
        infoPostFix: "",
        thousands: ",",
        lengthMenu: "Paparan _MENU_ rekod",
        loadingRecords: "Sedang memuatkan...",
        processing: "Sedang diproses...",
        search: "Carian:",
        zeroRecords: "Tiada rekod yang dijumpai",
        paginate: {
            first: "Pertama",
            last: "Terakhir",
            next: "Berikut",
            previous: "Terdahulu"
        },
        aria: {
            sortAscending: ": aktif untuk susunan jaluran menaik",
            sortDescending: ": aktif untuk susunan jaluran menurun"
        }
    }
});
</script>
@endsection