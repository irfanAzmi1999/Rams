@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Data Kenderaan</h2>
        <ol class="breadcrumb">
            <li>
                Data Kenderaan
            </li>
            <li>
                Paparan Data
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-5">
            <a class="btn btn-block btn-success data-filter">Tapis Data</a><br/>
        </div>
        <div class="col-lg-3">
            <div class="btn-group" style="display: flex;">
                <button id="export-excel-fdata" target="_blank" class="fa fa-file-excel-o btn-default btn-sm" style="margin-right: 10px; width: 100%; border: 0px; text-align: left; padding: 12px; font-family: open sans; color:#676a6c;">&nbsp;&nbsp;EXCEL</button>

                <button id="export-excel-fdata2" target="_blank" class="fa fa-file-excel-o btn-default btn-sm" style="width: 100%; border: 0px; text-align: left; padding: 12px; font-family: open sans; color:#676a6c;">&nbsp;&nbsp;EXCEL 2</button>
            </div>
        </div>
    </div>

    <div class="row">&nbsp;</div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Data Kenderaan</h5>
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
                        <table class="table table-striped table-bordered table-hover table-list-fdata">
                            <thead>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>Jenis Kenderaan</th>
                                    <th>Tarikh Kejadian</th>
                                    <th>Nombor<br />Laporan</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>Nombor<br />Laluan</th>
                                    <th>Koordinat</th>
                                    <th>Kategori<br />Kemalangan</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Kenderaan</th>
                                    <th>Tarikh Kejadian</th>
                                    <th>Nombor<br />Laporan</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>Nombor<br />Laluan</th>
                                    <th>Koordinat</th>
                                    <th>Kategori<br />Kemalangan</th>
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

<div class="modal inmodal" id="modal-view-fdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Papar Maklumat Laporan</h4>
            </div>
            <form id="form-view-fdata">
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <label><strong>ID</strong></label>
                                    </span>
                                    <input type="text" name="v_fdata_id" id="v_fdata_id" class="form-control" placeholder="" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Latitude</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-thumb-tack"></i>
                                    </span>
                                    <input type="text" name="v_latitude" class="form-control" placeholder="Latitude" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Longitude</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-thumb-tack"></i>
                                    </span>
                                    <input type="text" name="v_longitude" class="form-control" placeholder="Longitude" value="" disabled="true" />
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
                                    <input type="text" name="v_no_laluan" class="form-control" placeholder="Nombor Laluan" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Seksyen</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="v_nombor_seksyen" class="form-control" placeholder="Nombor Seksyen" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Pos Kilometer</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="v_pos_kilometer" class="form-control" placeholder="Pos Kilometer" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-14">
                            <div class="scroll_content">
                                <ul class="folder-list m-b-md" style="padding: 0">
                                    <li>
                                        <a>
                                            <i class="fa fa-map-marker"></i> No. Laporan
                                            <span class="label label-warning pull-right" id="v_no_laporan">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-map-marker"></i> Negeri
                                            <span class="label label-warning pull-right" id="v_negeri"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-map-marker"></i> Daerah
                                            <span class="label label-warning pull-right" id="v_daerah"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Tempat Kejadian
                                            <span class="label label-warning pull-right" id="v_tempat_kejadian">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-stethoscope"></i> Jenis Kemalangan
                                            <span class="label label-warning pull-right" id="v_jenis_kemalangan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar"></i> Tarikh Kejadian
                                            <span class="label label-warning pull-right" id="v_tarikh_kejadian">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar-o"></i> Bulan
                                            <span class="label label-warning pull-right" id="v_bulan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar-o"></i> Tahun
                                            <span class="label label-warning pull-right" id="v_tahun">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-cogs"></i> Jenis Permukaan
                                            <span class="label label-warning pull-right" id="v_jenis_permukaan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Keadaan Jalan
                                            <span class="label label-warning pull-right" id="v_keadaan_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Kualiti Permukaan
                                            <span class="label label-warning pull-right" id="v_kualiti_permukaan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-arrows-alt"></i> Sistem Lalulintas
                                            <span class="label label-warning pull-right" id="v_sistem_laluan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-sun-o"></i> Cuaca
                                            <span class="label label-warning pull-right" id="v_cuaca"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-car"></i> Jenis Pelanggaran Pertama
                                            <span class="label label-warning pull-right" id="v_jenis_langgar_pertama"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Bentuk Jalan
                                            <span class="label label-warning pull-right" id="v_bentuk_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-bars"></i> Jenis Garisan
                                            <span class="label label-warning pull-right" id="v_jenis_garis"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Jenis Permukaan Jalan
                                            <span class="label label-warning pull-right" id="v_muka_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Sebab Utama Kecacatan Jalan
                                            <span class="label label-warning pull-right" id="v_sebab_cacat_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-sun-o"></i> Cahaya
                                            <span class="label label-warning pull-right" id="v_cahaya"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Maklumat Kawasan Kemalangan</strong></label>
                                <div id="map_canvasView" style="width: 500px; height: 250px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left text-info">Dikemaskini Oleh : <span id="v_updated_by"></span></div>
                    <div class="col-sm-6 text-right text-info">Dikemaskini Pada : <span id="v_updated_at"></span></div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-view-kdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Papar Maklumat Kenderaan</h4>
            </div>
            <form id="form-view-kdata">
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <label><strong>ID</strong></label>
                                    </span>
                                    <input type="text" name="v_kdata_id" id="v_kdata_id" class="form-control" placeholder="" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenama</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-car"></i>
                                    </span>
                                    <input type="text" name="v_jenama" class="form-control" placeholder="Jenama" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenis Kenderaan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-car"></i>
                                    </span>
                                    <input type="text" name="v_jenis_kenderaan" class="form-control" placeholder="Jenis Kenderaan" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Model Kenderaan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-car"></i>
                                    </span>
                                    <input type="text" name="v_model_kenderaan" class="form-control" placeholder="Model Kenderaan" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tahun Kenderaan Dibuat</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="v_tahun_dibuat" class="form-control" placeholder="Tahun Kenderaan Dibuat" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>No Laporan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    <input type="text" name="v_no_laporan" class="form-control" placeholder="No Laporan" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Kejadian</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="text" name="v_tarikh_kejadian" class="form-control" placeholder="Tarikh Kejadian" value="" disabled="true" />
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
                                        <i class="fa fa-globe"></i>
                                    </span>
                                    <input type="text" name="v_negeri" class="form-control" placeholder="Negeri" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Daerah</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-globe"></i>
                                    </span>
                                    <input type="text" name="v_daerah" class="form-control" placeholder="Daerah" value="" disabled="true" />
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
                                    <input type="text" name="v_no_laluan" class="form-control" placeholder="Nombor Laluan" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Seksyen</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="v_nombor_seksyen" class="form-control" placeholder="Nombor Seksyen" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Pos Kilometer</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="v_pos_kilometer" class="form-control" placeholder="Pos Kilometer" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Kategori Kemalangan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-exclamation-circle"></i>
                                    </span>
                                    <input type="text" name="v_kategori_kemalangan" class="form-control" placeholder="Kategori Kemalangan" value="" disabled="true" />
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

<div class="modal inmodal" id="modal-filter-fdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Tapisan Data Kenderaan</h4>
            </div>
            <form id="form-filter-fdata" method="POST" action="{{URL('/filterdataKenderaan')}}">
                @csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Negeri</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    @if(Auth::user()->admin())

                                    {!! html()->select('negeri', $negeri, $zoomnegeri->id)
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri') !!}

                                    @elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah())

                                    {!! html()->select('negeri', $negeri, Auth::user()->negeri_id)
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri')
                                    ->attribute('disabled', true) !!}
                                    <input type="hidden" name="negeri" value="{{Auth::user()->negeri_id}}">

                                    @else

                                    {!! html()->select('negeri', $negeri, $zoomnegeri->id)
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
									@if(!empty($filter[1]))
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
                                                    @if(!in_array($k, $filter[1]))
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
                                    @if(!empty($filter[7]))
                                    <select data-placeholder="Pilih Laluan" class="form-control m-b chosen-road" name="nolaluan[]" multiple>
                                        <option value="">Pilih Laluan</option>
                                        @foreach ($filter[7] as $f7)
                                            <option selected="{{$f7}}">{{$f7}}</option>
                                        @endforeach
                                        @foreach($nolaluan as $no_laluan)
                                            @if(!in_array($no_laluan->no_laluan, $filter[7]))
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
                                <label><strong>Jenis Kemalangan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-stethoscope"></i>
                                    </span>
									{!! html()->select('jeniskemalangan', $jeniskemalangan, $filter[2])
                                    ->class('form-control m-b chosen-category')
                                    ->placeholder('Pilih Kategori') !!}
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
                                    {!! html()->text('s_accident_startdate', date("d-m-Y", strtotime($s_accident_startdate)))
                                    ->class('form-control')
                                    ->attribute('onkeydown', 'return false')
                                    ->attribute('readonly', true) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Kemalangan Akhir</strong></label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! html()->text('s_accident_enddate', date("d-m-Y", strtotime($s_accident_enddate)))
                                    ->class('form-control')
                                    ->attribute('onkeydown', 'return false')
                                    ->attribute('readonly', true) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenis Kenderaan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-car"></i>
                                    </span>
                                    <select data-placeholder="Pilih Jenis Kenderaan" class="form-control m-b chosen-category" id ="jeniskenderaan[]" name="jeniskenderaan[]" multiple>
                                        @foreach($jeniskenderaan as $kod => $name)
                                            @if(in_array($kod, $filter[3]))
                                                <option selected value="{{$kod}}">{{$name}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($jeniskenderaan as $kod => $name)
                                            @if(!in_array($kod, $filter[3]))
                                                <option value="{{$kod}}">{{$name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenama</strong></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                    {!! html()->text('jenama', $exjenama)->class('form-control') !!}
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
<script src="https://maps.google.com/maps/api/js?{{ env('GMAP_VAR') }}={{ env('GMAP_KEY') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/d3/d3.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/c3/c3.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.extend.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/slick/slick.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('mycity/js/mapspot.js') }}"></script>
<script src="{{ URL::asset('mycity/js/infobox.js') }}"></script>
<script src="{{ URL::asset('js/gmaps.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ URL::asset('js/Chart.bundle.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.scroll_content').slimscroll({
        height: '310px'
    });

    $('.slick_chart').slick({
        dots: true
    });

    var table = $('.table-list-fdata').DataTable({
        processing: true,
        serverSide: true,
        ajax:  {
            url: 'getDataKenderaan',
            data: function (d) {
                d.negeri = $('select[name=negeri]').val() ? $('select[name=negeri]').val() : '';
                d.daerah = $('select[name^=daerah]').val() ? $('select[name^=daerah]').val() : '';
                d.nolaluan = $('select[name^=nolaluan]').val() ? $('select[name^=nolaluan]').val() : '';
                d.jeniskemalangan = $('select[name=jeniskemalangan]').val() ? $('select[name=jeniskemalangan]').val() : '';
                d.s_accident_startdate = $('input[name=s_accident_startdate]').val() ? $('input[name=s_accident_startdate]').val() : '';
                d.s_accident_enddate = $('input[name=s_accident_enddate]').val() ? $('input[name=s_accident_enddate]').val() : '';
                d.jeniskenderaan = $('select[name^=jeniskenderaan]').val() ? $('select[name^=jeniskenderaan]').val() : '';
                d.jenama = $('input[name=jenama]').val() ? $('input[name=jenama]').val() : '';
            }
        },
        columns: [
            {data: 'DT_RowIndex', sortable: false, searchable: false},
            {data: 'jenis_kenderaan', name: 'jenis_kenderaan'},
            {data: 'tarikh_kejadian', name: 'tarikh_kejadian'},
            {data: 'no_laporan', name: 'no_laporan'},
            {data: 'negeri', name: 'negeri'},
            {data: 'daerah', name: 'daerah'},
            {data: 'no_laluan', name: 'no_laluan'},
            {data: 'koordinat', name: 'koordinat'},
            {data: 'jenis_kemalangan', name: 'jenis_kemalangan'},
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
        },
    });
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

    var debounce = new $.fn.dataTable.Debounce(table);

    $('.chosen-state').chosen({
        width: "100%"
    });

    $('.chosen-district').chosen({
        width: "100%"
    });

    $('.chosen-road').chosen({
        width: "100%"
    });

    $('.chosen-category').chosen({
        width: "100%"
    });

    $('.chosen-surface').chosen({
        width: "100%"
    });

    $('.chosen-condition').chosen({
        width: "100%"
    });

    $('.chosen-quality').chosen({
        width: "100%"
    });

    $('.chosen-traffic').chosen({
        width: "100%"
    });

    $('.chosen-weather').chosen({
        width: "100%"
    });

    $('.chosen-hit').chosen({
        width: "100%"
    });

    $('.chosen-road-shape').chosen({
        width: "100%"
    });

    $('.chosen-line').chosen({
        width: "100%"
    });

    $('.chosen-road-surface').chosen({
        width: "100%"
    });

    $('.chosen-road-defact').chosen({
        width: "100%"
    });

    $('.chosen-light').chosen({
        width: "100%"
    });

    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });

    $('[data-toggle="tooltip"]').tooltip();
});

//Modal Data Filter
$(document).on('click','.data-filter',function() {
    $('#modal-filter-fdata').modal('show');
    $('#form-filter-fdata')[0].reset();
});

$(document).on('click','#filter-fdata',function() {
    $.blockUI({
        message: '<img src="rams/images/rams_wh31.png" /><br /><img src="rams/images/loader.gif" />',
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    });
});

//Modal View - View
$(document).on('click','.fdata-view',function() {

let map;
let Overlays = [];
let iw;

function debounce(func, wait, immediate) {
    let timeout;
    return function () {
        let context = this,
        args = arguments;
        let later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
        };
        let callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

function getOverlayImage(bounds,map) {
    // const mygosBaseURL = "https://mygos.mygeoportal.gov.my";
    // const mygosMapServer =
    //     "/gisserver/rest/services/Fundamental_GDC/Transportation_SemenanjungMsia/MapServer";
    // // see https://developers.arcgis.com/rest/services-reference/enterprise/query-map-service-layer-.htm
    // const mygosMapServiceURL = new URL(
    //     mygosBaseURL + mygosMapServer + "/export"
    // );
    // // see https://developers.arcgis.com/rest/services-reference/enterprise/query-feature-service-layer-.htm
    // const mygosFeatureServiceURL = new URL(
    //     mygosBaseURL + mygosMapServer + "/10/query"
    // );
    // const ne = bounds.getNorthEast();
    // const sw = bounds.getSouthWest();
    // const sr = 4326; // Spatial Reference

    // const exportBBOX = sw.lng() + "," + sw.lat() + "," + ne.lng() + "," + ne.lat();
    // const mapdiv = /*document.getElementById("map_canvas")*/ map.getDiv();
    // mygosMapServiceURL.search = new URLSearchParams({
    //     bbox: exportBBOX,
    //     format: "png",
    //     transparent: "true",
    //     f: "image",
    //     bboxSR: sr,
    //     imageSR: sr,
    //     size: mapdiv.offsetWidth + "," + mapdiv.offsetHeight,
    //     layers: "show:10",
    // });

    // // Delete by remove all overlay in overlays array.
    // while (Overlays[0]) {
    //     Overlays.pop().setMap(null);
    // }

    // const Overlay = new google.maps.GroundOverlay(
    //     mygosMapServiceURL.toString(),
    //     bounds,
    //     { map: map, opacity: 0.9 }
    // );

    // // Push new overlay into overlays array
    // Overlays.push(Overlay);
    // const metersPerPx =
    //     (156543.03392 * Math.cos((sw.lat() * Math.PI) / 180)) /
    //     Math.pow(2, map.getZoom());
    // Overlay.addListener("click", (e) => {
    //     const queryURL = new URL(mygosFeatureServiceURL);
    //     queryURL.search = new URLSearchParams({
    //     where: "1=1",
    //     geometry:
    //         '{"x": ' +
    //         e.latLng.lng() +
    //         ', "y":' +
    //         e.latLng.lat() +
    //         ', "spatialReference":{"wkid":4326}}',
    //     geometryType: "esriGeometryPoint",
    //     inSR: sr,
    //     spatialRel: "esriSpatialRelIntersects",
    //     outFields: "*",
    //     distance: 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
    //     units: "esriSRUnit_Meter",
    //     returnGeometry: false,
    //     resultRecordCount: 1,
    //     returnExtentOnly: false,
    //     featureEncoding: "esriDefault",
    //     f: "pjson",
    //     });
    //     fetch(queryURL)
    //     .then((r) => r.json())
    //     .then((r) => {
    //         if (!iw) {
    //         iw = new google.maps.InfoWindow();
    //         }
    //         iw.setPosition(e.latLng);
    //         if (r.features && r.features.length > 0) {
    //         iw.setContent(
    //             Object.entries(r.features[0].attributes)
    //             .map(
    //                 ([k, v]) =>
    //                 r.fieldAliases[k] + ": " + (v === null ? "" : v)
    //             )
    //             .join("<br>")
    //         );
    //         iw.open({ map });
    //         } else {
    //         iw.close();
    //         }
    //     });
    // });
}
    var id = $(this).data('id');
    $('#modal-view-fdata').modal('show');
    $('#form-view-fdata')[0].reset();
    $('.message-form').html('');

    $.ajax({
        url: "ajaxViewDataMap&id=" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="v_fdata_id"]').val(id);
            $('[name="v_latitude"]').val(data.latitude);
            $('[name="v_longitude"]').val(data.logitude);
            $('[name="v_no_laluan"]').val(data.no_laluan);
            $('[name="v_nombor_seksyen"]').val(data.nombor_seksyen);
            $('[name="v_pos_kilometer"]').val(data.pos_kilometer);
            $("#v_no_laporan").html(data.no_laporan);
            $("#v_negeri").html(data.negeri.name);
            $("#v_daerah").html(data.daerah.name);
            $("#v_jenis_kemalangan").html(data.jeniskemalangan.name);
            $("#v_tempat_kejadian").html(data.tempat_kejadian);
            $("#v_tarikh_kejadian").html(data.tarikh);
            $("#v_bulan").html(data.bulan.name);
            $("#v_tahun").html(data.tahun);
            $("#v_jenis_permukaan").html(data.jenis_permukaan.name);
            $("#v_keadaan_jalan").html(data.keadaan_jalan.name);
            $("#v_kualiti_permukaan").html(data.kualiti_permukaan.name);
            $("#v_sistem_laluan").html(data.sistem_laluan.name);
            $("#v_cuaca").html(data.cuaca.name);
            $("#v_jenis_langgar_pertama").html(data.jenis_langgar_pertama.name);
            $("#v_bentuk_jalan").html(data.bentuk_jalan.name);
            $("#v_jenis_garis").html(data.jenis_garis.name);
            $("#v_muka_jalan").html(data.muka_jalan.name);
            $("#v_sebab_cacat_jalan").html(data.sebab_cacat_jalan.name);
            $("#v_cahaya").html(data.cahaya.name);
            $("#v_updated_by").html(data.user.fullname);
            $("#v_bahagian").html(data.user.department.name);
            $("#v_updated_at").html(data.updated);


            var map;

            function initialize() {

                var myLatlng = new google.maps.LatLng(data.latitude, data.logitude);

                var myOptions = {
                    zoom: 17,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvasView"), myOptions);

                // Avoid too many request to mygos mygeoportal server
                const didle = debounce(function () {
                getOverlayImage(map.getBounds(),map);
                }, 600);
                google.maps.event.addListener(map, "idle", didle);

                var marker = new google.maps.Marker({
                    draggable: false,
                    position: myLatlng,
                    map: map,
                    title: "Your location"
                });

                google.maps.event.addListener(marker, 'dragend', function (event) {

                    document.getElementById("lat").value = event.latLng.lat();
                    document.getElementById("long").value = event.latLng.lng();
                });
            }
            google.maps.event.addDomListener(window, "load", initialize())
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
});

//Modal View - View
$(document).on('click','.kenderaan-data',function() {
    var id = $(this).data('id');
    $('#modal-view-kdata').modal('show');
    $('#form-view-kdata')[0].reset();
    $('.message-form').html('');

    $.ajax({
        url: "ajaxViewDataKenderaan&id=" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="v_kdata_id"]').val(data.id);
            $('[name="v_jenama"]').val(data.jenama);
            $('[name="v_jenis_kenderaan"]').val(data.jenis_kenderaan);
            $('[name="v_model_kenderaan"]').val(data.model_kenderaan);
            $('[name="v_tahun_dibuat"]').val(data.tahun_dibuat);
            $('[name="v_no_laporan"]').val(data.no_laporan);
            $('[name="v_tarikh_kejadian"]').val(data.tarikh_kejadian);
            $('[name="v_negeri"]').val(data.negeri);
            $('[name="v_daerah"]').val(data.daerah);
            $('[name="v_no_laluan"]').val(data.no_laluan);
            $('[name="v_nombor_seksyen"]').val(data.nombor_seksyen);
            $('[name="v_pos_kilometer"]').val(data.pos_kilometer);
            $('[name="v_kategori_kemalangan"]').val(data.jenis_kemalangan);
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
});

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


    $('#filter-fdata').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/filterdataKenderaan') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_self");
        $('#form-filter-fdata').submit();  // submit the form
    });

    $('#export-excel-fdata').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/excelkenderaandownload') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_blank");
        $('#form-filter-fdata').submit();  // submit the form
    });

    $('#export-excel-fdata2').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/excelkenderaandownload2') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_blank");
        $('#form-filter-fdata').submit();  // submit the form
    });
</script>
@endsection
