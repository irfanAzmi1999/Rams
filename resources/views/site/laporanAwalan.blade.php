@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Laporan 24 Jam</h2>
        <ol class="breadcrumb">
            <li>
                Laporan 24 Jam
            </li>
            <li>
                Laporan Awalan
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
                                <th>Tempat Kejadian</th>
                                <th>Tarikh Kejadian</th>
                                <th>Masa Kejadian</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tindakan</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Bil</td>
                                <th width="6%">No Laporan</th>
                                <th>Negeri</th>
                                <th>Daerah</th>
                                <th>No Laluan</th>
                                <th>Nama Laluan</th>
                                <th>Tempat Kejadian</th>
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

<div class="modal inmodal" id="modal-filter-bdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Tapisan Data Laporan 24 Jam</h4>
            </div>
            <form id="form-filter-fdata" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>No Laporan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    {!! html()->text('no_laporan', $input['no_laporan'] ?? '')
                                    ->class('form-control')
                                    ->placeholder('No Laporan') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Negeri</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    @if(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah())

                                    {!! html()->select('negeri', $negeri, Auth::user()->negeri_id)
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri')
                                    ->attribute('disabled', true) !!}
                                    <input type="hidden" name="negeri" value="{{Auth::user()->negeri_id}}">

                                    @else

                                    {!! html()->select('negeri', $negeri, $input['negeri'])
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri') !!}

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Daerah</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
									@if(!empty($input['daerah']))
                                        @if(Auth::user()->jkrdaerah())
                                            <select data-placeholder="Pilih Daerah" class="form-control m-b chosen-district" name="daerah[]" disabled multiple>
                                                <option value="">Pilih Daerah</option>
                                                @foreach($daerah as $k=>$v)
                                                     @if(in_array($k, Auth::user()->daerah()->pluck('daerah_id')->toArray()))
                                                        <option value="{{$k}}" selected>{{$v}}</option>
                                                    @else
                                                        <option value="{{$k}}">{{$v}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @else
                                            <select data-placeholder="Pilih Daerah" class="form-control m-b chosen-district" name="daerah[]" multiple>
                                                <option value="" disabled>Pilih Daerah</option>
                                                @foreach($daerah as $k=>$v)
                                                    @if(!in_array($k, $input['daerah']))
                                                        <option value="{{$k}}">{{$v}}</option>
                                                    @else
                                                        <option value="{{$k}}" selected>{{$v}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    @else
                                        @if(Auth::user()->jkrdaerah())
                                            <select data-placeholder="Pilih Daerah" class="form-control m-b chosen-district" name="daerah[]" multiple disabled>
                                                <option value="">Pilih Daerah</option>
                                                @foreach($daerah as $k=>$v)
                                                    @if(in_array($k, Auth::user()->daerah()->pluck('daerah_id')->toArray()))
                                                        <option value="{{$k}}" selected>{{$v}}</option>
                                                    @else
                                                        <option value="{{$k}}">{{$v}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @else
                                            <select data-placeholder="Pilih Daerah" class="form-control m-b chosen-district" name="daerah[]" multiple>
                                                <option value="" disabled>Pilih Daerah</option>
                                                @foreach($daerah as $k=>$v)
                                                    <option value="{{$k}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Laluan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    @if(!empty($input['nolaluan']))
                                    <select data-placeholder="Pilih Laluan" class="form-control m-b chosen-road" name="nolaluan[]" multiple>
                                        <option value="">Pilih Laluan</option>
                                        @foreach ($input['nolaluan'] as $f16)
                                            <option selected="{{$f16}}">{{$f16}}</option>
                                        @endforeach
                                        @foreach($nolaluan as $no_laluan)
                                            @if(!in_array($no_laluan->no_laluan, $input['nolaluan']))
                                                <option value="{{$no_laluan->no_laluan}}">{{$no_laluan->no_laluan}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @else
                                    <select data-placeholder="Pilih Laluan" class="form-control m-b chosen-road" name="nolaluan[]" multiple>
                                        <option value="" disabled>Pilih Laluan</option>
                                        @foreach($nolaluan as $no_laluan)
                                            <option value="{{$no_laluan->no_laluan}}">{{$no_laluan->no_laluan}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tempat Kejadian</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    {!! html()->text('tempat_kejadian', $input['tempat_kejadian'] ?? '')
                                    ->class('form-control')
                                    ->placeholder('Tempat Kejadian') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Kemalangan Mula</strong></label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! html()->text('s_accident_startdate', !empty($input['s_accident_startdate']) ? date("d-m-Y", strtotime($input['s_accident_startdate'])) : '')
                                    ->class('form-control')
                                    ->attribute('autocomplete', 'off') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Kemalangan Akhir</strong></label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! html()->text('s_accident_enddate', !empty($input['s_accident_enddate']) ? date("d-m-Y", strtotime($input['s_accident_enddate'])) : '')
                                    ->class('form-control')
                                    ->attribute('autocomplete', 'off') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Status</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    {!! html()->select('status_la', $status_la, !empty($input['status_la']) ? $input['status_la'] : '')
                                    ->class('form-control m-b chosen-condition')
                                    ->placeholder('Status') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="filter-fdata" class="btn btn-primary" type="submit">Tapis</button>
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
    <script src="https://maps.google.com/maps/api/js?{{ env('GMAP_VAR') }}={{ env('GMAP_KEY') }}"></script>
    <script src="{{ URL::asset('rams/js/laporanAwalan.js') }}"></script>
    <script>
        $(document).on('change','.chosen-state',function() {
            $('.chosen-district').html('').trigger("chosen:updated");
            $('.chosen-road').html('').trigger("chosen:updated");

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
                }
            });

            $.ajax({
                type: 'GET',
                url : 'populateNolaluan',
                data : {
                    negeri : $(this).val(),
                    startdate : $('input[name="s_accident_startdate"]').val(),
                    enddate : $('input[name="s_accident_enddate"]').val()
                },
                success:function(data){
                    $('.chosen-road').append('<option value="">Pilih Laluan</option>').trigger("chosen:updated");
                    $.each(data, function(k,v){
                        $('.chosen-road').append('<option value="'+v['no_laluan']+'">'+v['no_laluan']+'</option>').trigger("chosen:updated");
                    });
                }
            });
        });
        $('.input-group.date').datepicker({
            todayBtn: "linked",
            constrainInput: false,
            // keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: false,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('.chosen-district, .chosen-road').chosen({
            width: "100%"
        });

        @if(!empty(session('accident_id')))
            var id = {{ session('accident_id') }};
            console.log(id);
            $.ajax({
                url: "ajaxViewLaporanAwalan&id="+id,
                type: "GET",
                success: function(data){
                    $(".breadcrumb").append('<li>Paparan Maklumat<li>');
                    $("#wrapper-laporan-awalan").html(data);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert(errorThrown);
                }
            });
        @endif

        $.fn.dataTable.Debounce = function ( table, options ) {
            var tableId = table.settings()[0].sTableId;
            $('.dataTables_filter input[aria-controls="' + tableId + '"]') // select the correct input field
                .unbind() // Unbind previous default bindings
                .bind('input', (delay(function (e) { // Bind our desired behavior
                    table.search($(this).val()).draw();
                    return;
                }, 1000))); // Set delay in milliseconds
        }

        function delay(callback, ms) {
            var timer = 0;
            return function () {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }
        var table=$('.table-list-laporan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('getLaporanAwalan') }}',
                data: {
                    no_laporan: $('input[name=no_laporan]').val(),
                    negeri: $('select[name=negeri]').val(),
                    daerah: $('select[name^=daerah]').val(),
                    nolaluan: $('select[name^=nolaluan]').val(),
                    tempat_kejadian: $('input[name=tempat_kejadian]').val(),
                    status_la: $('select[name=status_la]').val(),
                    s_accident_startdate: $('input[name=s_accident_startdate]').val(),
                    s_accident_enddate: $('input[name=s_accident_enddate]').val(),
                }
            },
            columns: [
                {data: 'DT_RowIndex', sortable: false, searchable: false},
                {data: 'no_laporan'},
                {data: 'negeri', name: 'negeris.name'},
                {data: 'daerah', name: 'daerahs.name'},
                {data: 'no_laluan'},
                {data: 'jalan', name: 'jalans.nama'},
                {data: 'tempat_kejadian', name: 'tempat_kejadian'},
                {data: 'tarikh', name: 'tarikh_kejadian'},
                {data: 'masa', name: 'masa', sortable: false, searchable: false},
                {data: 'status_la', name: 'status_la'},
                {data: 'action', name: 'action', sortable: false, searchable: false},
            ],
            order: [[ 6, "desc" ]],
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
        var debounce = new $.fn.dataTable.Debounce(table);

        $('#export-excel-fdata').click(function() {
            $('#form-filter-fdata').attr("action", "{{ URL('/laporanawalanexceldownload') }}");  //change the form action
            $('#form-filter-fdata').attr("method", "POST");
            $('#form-filter-fdata').attr("target", "_blank");
            $('#form-filter-fdata').submit();  // submit the form
        });
        $('#filter-fdata').click(function() {
            $('#form-filter-fdata').attr("action", "{{ URL('/laporanAwalan') }}");  //change the form action
            $('#form-filter-fdata').attr("method", "POST");
            $('#form-filter-fdata').attr("target", "_self");
            $('#form-filter-fdata').submit();  // submit the form
        });

        //Modal Data Filter
        $(document).on('click','.data-bfilter',function() {
            $('#modal-filter-bdata').modal('show');
            $('#form-filter-fdata')[0].reset();
        });
    </script>
@endsection