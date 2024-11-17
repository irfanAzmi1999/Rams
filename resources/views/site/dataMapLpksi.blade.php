@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Data Lintasan Pejalan Kaki Searas Berlampu Isyarat</h2>
        <ol class="breadcrumb">
            <li>
                Data Lintasan Pejalan Kaki Searas Berlampu Isyarat
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
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-success data-filter">Tapis Data</a>
                        <div class="space-25"></div>
                        <h5>Tapisan Data</h5>
                        <div class="scroll_content">
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li>
                                    <a><i class="fa fa-map-marker"></i> Negeri
                                    <span class="label label-warning pull-right">
                                        @if($filter[0]!='')
                                            {{$zoomnegeri->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-map-marker"></i> Daerah
                                    <span class="label label-warning pull-right" style="min-width:100px;white-space: nowrap;overflow:hidden;text-overflow: ellipsis" title="@if (!empty($filter[1]) && $filter[1] != '') @foreach($daerahlist as $dlist) {{$dlist->name}}@if(count($daerahlist) > 1), @endif @endforeach @else - @endif">
                                        @if(!empty($filter[1]) && $filter[1] != '')
                                            @foreach($daerahlist as $dlist)
                                                {{$dlist->name}}@if(count($daerahlist) > 1), @endif
                                            @endforeach
                                        @elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah())
                                            {{ implode(',',Auth::user()->daerah()->pluck('name')->toArray()) }}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> Nama Laluan
                                        <span class="label label-warning pull-right" style="width:100px;overflow:hidden;text-overflow: ellipsis" title="@if (!empty($filter[16]) && $filter[16][0] != '') {{ implode(',', $filter[16]) }} @else - @endif">
                                            @if(!empty($filter[16]) && $filter[16][0] != '')
                                            {{ implode(',', $filter[16]) }}
                                            @else
                                            -
                                            @endif
                                        </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> No. Laluan
                                    <span class="label label-warning pull-right" style="width:100px;overflow:hidden;text-overflow: ellipsis" title="@if (!empty($filter[16]) && $filter[16][0] != '') {{ implode(',', $filter[16]) }} @else - @endif">
                                        @if(!empty($filter[16]) && $filter[16][0] != '')
                                            {{ implode(',', $filter[16]) }}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> No. Seksyen
                                        <span class="label label-warning pull-right" style="width:100px;overflow:hidden;text-overflow: ellipsis" title="@if (!empty($filter[16]) && $filter[16][0] != '') {{ implode(',', $filter[16]) }} @else - @endif">
                                            @if(!empty($filter[16]) && $filter[16][0] != '')
                                            {{ implode(',', $filter[16]) }}
                                            @else
                                            -
                                            @endif
                                        </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-dollar"></i> Kos Pembinaan
                                        <span class="label label-warning pull-right">-</span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> Status
                                    <span class="label label-warning pull-right">
                                        @if($filter[18]!='')
                                            {{$filter[18]}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">

        </div>
    </div>

    <div class="row">&nbsp;</div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Senarai Data Lintasan Pejalan Kaki Searas Berlampu Isyarat</h5>
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
                                    <th>ID</th>
                                    <th>Latitude<br />Longitude</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>Nombor<br />Laluan</th>
                                    <th>Nama<br />Laluan</th>
                                    <th>Nombor<br />Seksyen</th>
                                    <th>Kos<br />Pembinaan</th>
                                    <th>Status</th>
                                    <th width="15%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="6%">#</th>
                                    <th>ID</th>
                                    <th>Latitude<br />Longitude</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>Nombor<br />Laluan</th>
                                    <th>Nama<br />Laluan</th>
                                    <th>Nombor<br />Seksyen</th>
                                    <th>Kos<br />Pembinaan</th>
                                    <th>Status</th>
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

<div class="modal inmodal" id="modal-view-fdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Papar Maklumat Data (<span id="v_fdata_id_view"></span>)</h4>
            </div>
            <form id="form-view-fdata">
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row" style="display: none;">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Maklumat Kawasan Lintasan Pejalan Kaki Searas Berlampu Isyarat</strong></label>
                                <div id="map_canvasView" style="width: 500px; height: 250px;"></div>
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
                                    <input type="hidden" name="v_negeri_id" class="form-control"  value="" />
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
                                            <i class="fa fa-road"></i> Tempat
                                            <span class="label label-warning pull-right" id="v_tempat_kejadian">-</span>
                                        </a>
                                    </li>
                                    <!--
                                        <li>
                                            <a>
                                                <i class="fa fa-user"></i> Dikemaskini oleh
                                                <span class="label label-warning pull-right" id="v_updated_by"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-building"></i> Bahagian
                                                <span class="label label-warning pull-right" id="v_bahagian"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-calendar"></i> Dikemaskini pada
                                                <span class="label label-warning pull-right" id="v_updated_at"></span>
                                            </a>
                                        </li>
                                    -->
                                </ul>
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

<div class="modal inmodal" id="modal-edit-fdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Kemaskini Maklumat Data  (<span id="e_fdata_id_view"></span>)</h4>
            </div>
            <form id="form-edit-fdata">
                @csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <label><strong>ID</strong></label>
                                    </span>
                                    <input type="text" name="e_fdata_id" id="e_fdata_id" class="form-control" placeholder="" value="" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Maklumat Kawasan Lintasan Pejalan Kaki Searas Berlampu Isyarat</strong></label>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="map_canvas" style="width: 500px; height: 250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Latitude</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-thumb-tack"></i>
                                    </span>
                                    <input type="text" name="e_latitude" id="lat" class="form-control" placeholder="Latitude" value="" data-required="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Longitude</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-thumb-tack"></i>
                                    </span>
                                    <input type="text" name="e_longitude" id="long" class="form-control" placeholder="Longitude" value="" data-required="true" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Nombor Laluan </strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                   <input type="text" name="e_no_laluan" class="form-control" placeholder="Nombor Laluan" value="" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label><strong>Kategori Jalan:(Persekutuan / Negeri) </strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    {!! html()->select('e_jenis_jalan_id', $jenis_jalan, old('e_jenis_jalan_id'))
                                    ->name('e_jenis_jalan_id')
                                    ->id('e_jenis_jalan_id')
                                    ->class('form-control m-b chosen-surface')
                                    ->placeholder('Kategori Jalan:(Persekutuan / Negeri)') !!}
                                </div>
                            </div>
                        </div>
                      </div>
                    <div class="row" id="div-e_jalan_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nama Laluan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    {!! html()->select('e_jalan_id', $nojalan, old('e_jalan_id'))
                                    ->name('e_jalan_id')
                                    ->id('e_jalan_id')
                                    ->class('form-control m-b chosen-nojalan')
                                    ->placeholder('Nama Jalan') !!}
                              </div>
                          </div>
                      </div>
                    </div>
                 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Seksyen</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="e_nombor_seksyen" class="form-control" placeholder="Nombor Seksyen" value="" />
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Pos Kilometer</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="e_pos_kilometer" class="form-control" placeholder="Pos Kilometer" value="" />
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
                                            <i class="fa fa-map-marker"></i> Negeri
                                            <span class="label label-warning pull-right" id="e_negeri"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-map-marker"></i> Daerah
                                            <span class="label label-warning pull-right" id="e_daerah"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Tempat
                                            <span class="label label-warning pull-right" id="e_tempat_kejadian">-</span>
                                        </a>
                                    </li>
                                    <!--
                                        <li>
                                            <a>
                                                <i class="fa fa-user"></i> Dikemaskini oleh
                                                <span class="label label-warning pull-right" id="e_updated_by"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-building"></i> Bahagian
                                                <span class="label label-warning pull-right" id="e_bahagian"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-calendar"></i> Dikemaskini pada
                                                <span class="label label-warning pull-right" id="e_updated_at"></span>
                                            </a>
                                        </li>
                                    -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left text-info">Daftar Oleh : <span id="e_created_by"></span></div>
                        <div class="col-sm-6 text-right text-info">Daftar Pada : <span id="e_created_at"></span></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 text-left text-info">Kemaskini Oleh : <span id="e_updated_by"></span></div>
                        <div class="col-sm-6 text-right text-info">Kemaskini Pada : <span id="e_updated_at"></span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="update-fdata" class="btn btn-primary">Simpan</a>
                    <a id="sahkan-fdata" class="btn btn-success">Simpan dan Sahkan</a>
                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-delete-fdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Hapus Maklumat Data
                    <br /><small>Anda pasti untuk menghapuskan maklumat data ini?</small>
                </h4>
            </div>
            <form id="form-delete-fdata">
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <label><strong>ID</strong></label>
                                    </span>
                                    <input type="text" name="d_fdata_id" id="d_fdata_id" class="form-control" placeholder="" value="" disabled="true" />
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
                                    <input type="text" name="d_latitude" class="form-control" placeholder="Latitude" value="" disabled="true" />
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
                                    <input type="text" name="d_longitude" class="form-control" placeholder="Longitude" value="" disabled="true" />
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
                                    <input type="text" name="d_no_laluan" class="form-control" placeholder="Nombor Laluan" value="" disabled="true" />
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
                                    <input type="text" name="d_nombor_seksyen" class="form-control" placeholder="Nombor Seksyen" value="" disabled="true" />
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
                                    <input type="text" name="d_pos_kilometer" class="form-control" placeholder="Pos Kilometer" value="" disabled="true" />
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
                                            <i class="fa fa-map-marker"></i> Negeri
                                            <span class="label label-warning pull-right" id="d_negeri"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-map-marker"></i> Daerah
                                            <span class="label label-warning pull-right" id="d_daerah"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Tempat
                                            <span class="label label-warning pull-right" id="d_tempat_kejadian">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar-o"></i> Bulan
                                            <span class="label label-warning pull-right" id="d_bulan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar-o"></i> Tahun
                                            <span class="label label-warning pull-right" id="d_tahun">-</span>
                                        </a>
                                    </li>
                                    <!--
                                        <li>
                                            <a>
                                                <i class="fa fa-user"></i> Dikemaskini oleh
                                                <span class="label label-warning pull-right" id="d_updated_by"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-building"></i> Bahagian
                                                <span class="label label-warning pull-right" id="d_bahagian"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-calendar"></i> Dikemaskini pada
                                                <span class="label label-warning pull-right" id="d_updated_at"></span>
                                            </a>
                                        </li>
                                    -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="delete-fdata" class="btn btn-primary">Hapus</a>
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
                <h4 class="modal-title">Tapisan Data Lintasan Pejalan Kaki Searas Berlampu Isyarat</h4>
            </div>
            <form id="form-filter-fdata" method="POST" action="{{URL('/filterdataMap')}}">
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
                                    @if(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah())

                                    {!! html()->select('negeri', $negeri, Auth::user()->negeri_id)
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri')
                                    ->attribute('disabled', true) !!}
                                    <input type="hidden" name="negeri" value="{{Auth::user()->negeri_id}}">

                                    @else

                                    {!! html()->select('negeri', $negeri, $filter[0])
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
                                    @if(!empty($filter[16]))
                                    <select data-placeholder="Pilih Laluan" class="form-control m-b chosen-road" name="nolaluan[]" multiple>
                                        <option value="">Pilih Laluan</option>
                                        @foreach ($filter[16] as $f16)
                                            <option selected="{{$f16}}">{{$f16}}</option>
                                        @endforeach
                                        @foreach($nolaluan as $no_laluan)
                                            @if(!in_array($no_laluan->no_laluan, $filter[16]))
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
                                <label><strong>Status</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-sun-o"></i></span>
                                    {!! html()->select('status_la', $status_la, old('status_la', $filter[18]))
                                    ->class('form-control m-b chosen-light')
                                    ->placeholder('Pilih Status') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Tarikh Pembinaan (Mula)</strong></label>
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
                                <label><strong>Tarikh Pembinaan (Akhir)</strong></label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! html()->text('s_accident_enddate', date("d-m-Y", strtotime($s_accident_enddate)))
                                    ->class('form-control')
                                    ->attribute('onkeydown', 'return false')
                                    ->attribute('readonly', true) !!}
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
<div class="modal inmodal" id="list_kenderaan">
    <div class="modal-dialog table-list-kenderaan-style">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">List Kenderaan Terlibat</h4>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-list-kenderaan">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenama</th>
                                        <th>Jenis Kenderaan</th>
                                        <th>Model Kenderaan</th>
                                        <th>Punca Kemalangan</th>
                                        <th>Tahun Kenderaan Dibuat</th>
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
    </div>
</div>
@endsection

@section('js')
<script src="https://maps.google.com/maps/api/js?{{ env('GMAP_VAR') }}={{ env('GMAP_KEY') }}&libraries=geometry"></script>
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
    const mygosBaseURL = "https://mygos.mygeoportal.gov.my";
    const mygosMapServer =
        "/gisserver/rest/services/Fundamental_GDC/Transportation_SemenanjungMsia/MapServer";
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-map-service-layer-.htm
    const mygosMapServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/export"
    );
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-feature-service-layer-.htm
    const mygosFeatureServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/10/query"
    );
    const ne = bounds.getNorthEast();
    const sw = bounds.getSouthWest();
    const sr = 4326; // Spatial Reference

    const exportBBOX = sw.lng() + "," + sw.lat() + "," + ne.lng() + "," + ne.lat();
    const mapdiv = /*document.getElementById("map_canvas")*/ map.getDiv();
    mygosMapServiceURL.search = new URLSearchParams({
        bbox: exportBBOX,
        format: "png",
        transparent: "true",
        f: "image",
        bboxSR: sr,
        imageSR: sr,
        size: mapdiv.offsetWidth + "," + mapdiv.offsetHeight,
        layers: "show:10",
    });

    // Delete by remove all overlay in overlays array.
    while (Overlays[0]) {
        Overlays.pop().setMap(null);
    }

    const Overlay = new google.maps.GroundOverlay(
        mygosMapServiceURL.toString(),
        bounds,
        { map: map, opacity: 0.9 }
    );

    // Push new overlay into overlays array
    Overlays.push(Overlay);
    const metersPerPx =
        (156543.03392 * Math.cos((sw.lat() * Math.PI) / 180)) /
        Math.pow(2, map.getZoom());
    Overlay.addListener("click", (e) => {
        const queryURL = new URL(mygosFeatureServiceURL);
        queryURL.search = new URLSearchParams({
        where: "1=1",
        geometry:
            '{"x": ' +
            e.latLng.lng() +
            ', "y":' +
            e.latLng.lat() +
            ', "spatialReference":{"wkid":4326}}',
        geometryType: "esriGeometryPoint",
        inSR: sr,
        spatialRel: "esriSpatialRelIntersects",
        outFields: "*",
        distance: 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
        units: "esriSRUnit_Meter",
        returnGeometry: false,
        resultRecordCount: 1,
        returnExtentOnly: false,
        featureEncoding: "esriDefault",
        f: "pjson",
        });
        fetch(queryURL)
        .then((r) => r.json())
        .then((r) => {
            if (!iw) {
            iw = new google.maps.InfoWindow();
            }
            iw.setPosition(e.latLng);
            if (r.features && r.features.length > 0) {
            iw.setContent(
                Object.entries(r.features[0].attributes)
                .map(
                    ([k, v]) =>
                    r.fieldAliases[k] + ": " + (v === null ? "" : v)
                )
                .join("<br>")
            );
            iw.open({ map });
            } else {
            iw.close();
            }
        });
    });
}

$(document).ready(function() {
    $('.scroll_content').slimscroll({
        height: '310px'
    });

    $('.slick_chart').slick({
        dots: true
    });

    c3.generate({
        bindto: '#barChart',
        data:{
            columns: [
                [<?php echo $barresultmaut ?>],
                [<?php echo $barresultparah ?>],
                [<?php echo $barresultringan ?>],
                [<?php echo $barresultrosak ?>]
            ],
            colors:{
                Maut: '#000000',
                Parah: '#e42238',
                Ringan: '#1ab394',
                Rosak: '#3e80c5'
            },
            type: 'bar',
            groups: [
                ['MAUT', 'PARAH', 'RINGAN', 'ROSAK SAHAJA']
            ]
        },
        axis: {
            x: {
            type: 'category',
            categories: [<?php echo $unique_data_year ?>]
            }
        }
    });

    c3.generate({
        bindto: '#lineChart',
        data:{
            columns: [
                [<?php echo $barresultmaut ?>],
                [<?php echo $barresultparah ?>],
                [<?php echo $barresultringan ?>],
                [<?php echo $barresultrosak ?>]
            ],
            colors:{
                Maut: '#000000',
                Parah: '#e42238',
                Ringan: '#1ab394',
                Rosak: '#3e80c5'
            },
            type: 'spline'
        },
        axis: {
            x: {
            type: 'category',
            categories: [<?php echo $unique_data_year ?>]
            }
        }
    });

    c3.generate({
        bindto: '#pieChart',
        data:{
            columns: [
                ['Maut', <?php echo $maut ?>],
                ['Parah', <?php echo $parah ?>],
                ['Ringan', <?php echo $ringan ?>],
                ['Rosak', <?php echo $rosak ?>]
            ],
            colors:{
                Maut: '#000000',
                Parah: '#e42238',
                Ringan: '#1ab394',
                Rosak: '#3e80c5'
            },
            type : 'pie'
        }
    });

    // $('.table-list-fdata').DataTable({
    //     pageLength: 25,
    //     responsive: true,
    //     dom: 'lTfgitp',
    //     language: {
    //         decimal:        "",
    //         emptyTable:     "Tiada data",
    //         info:           "Paparan _START_ sehingga _END_ daripada _TOTAL_ rekod",
    //         infoEmpty:      "Paparan 0 sehingga 0 daripada 0 rekod",
    //         infoFiltered:   "(Tapisan daripada _MAX_ jumlah rekod)",
    //         infoPostFix:    "",
    //         thousands:      ",",
    //         lengthMenu:     "Paparan _MENU_ rekod",
    //         loadingRecords: "Sedang memuatkan...",
    //         processing:     "Sedang diproses...",
    //         search:         "Carian:",
    //         zeroRecords:    "Tiada rekod yang dijumpai",
    //         paginate: {
    //             first:      "Pertama",
    //             last:       "Terakhir",
    //             next:       "Berikut",
    //             previous:   "Terdahulu"
    //         },
    //         aria: {
    //             sortAscending:  ": aktif untuk susunan jaluran menaik",
    //             sortDescending: ": aktif untuk susunan jaluran menurun"
    //         }
    //     }
    // });

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


    $('.chosen-nojalan').chosen({
        width: "100%"
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
    const mygosBaseURL = "https://mygos.mygeoportal.gov.my";
    const mygosMapServer =
        "/gisserver/rest/services/Fundamental_GDC/Transportation_SemenanjungMsia/MapServer";
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-map-service-layer-.htm
    const mygosMapServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/export"
    );
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-feature-service-layer-.htm
    const mygosFeatureServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/10/query"
    );
    const ne = bounds.getNorthEast();
    const sw = bounds.getSouthWest();
    const sr = 4326; // Spatial Reference

    const exportBBOX = sw.lng() + "," + sw.lat() + "," + ne.lng() + "," + ne.lat();
    const mapdiv = /*document.getElementById("map_canvas")*/ map.getDiv();
    mygosMapServiceURL.search = new URLSearchParams({
        bbox: exportBBOX,
        format: "png",
        transparent: "true",
        f: "image",
        bboxSR: sr,
        imageSR: sr,
        size: mapdiv.offsetWidth + "," + mapdiv.offsetHeight,
        layers: "show:10",
    });

    // Delete by remove all overlay in overlays array.
    while (Overlays[0]) {
        Overlays.pop().setMap(null);
    }

    const Overlay = new google.maps.GroundOverlay(
        mygosMapServiceURL.toString(),
        bounds,
        { map: map, opacity: 0.9 }
    );

    // Push new overlay into overlays array
    Overlays.push(Overlay);
    const metersPerPx =
        (156543.03392 * Math.cos((sw.lat() * Math.PI) / 180)) /
        Math.pow(2, map.getZoom());
    Overlay.addListener("click", (e) => {
        const queryURL = new URL(mygosFeatureServiceURL);
        queryURL.search = new URLSearchParams({
        where: "1=1",
        geometry:
            '{"x": ' +
            e.latLng.lng() +
            ', "y":' +
            e.latLng.lat() +
            ', "spatialReference":{"wkid":4326}}',
        geometryType: "esriGeometryPoint",
        inSR: sr,
        spatialRel: "esriSpatialRelIntersects",
        outFields: "*",
        distance: 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
        units: "esriSRUnit_Meter",
        returnGeometry: false,
        resultRecordCount: 1,
        returnExtentOnly: false,
        featureEncoding: "esriDefault",
        f: "pjson",
        });
        fetch(queryURL)
        .then((r) => r.json())
        .then((r) => {
            if (!iw) {
            iw = new google.maps.InfoWindow();
            }
            iw.setPosition(e.latLng);
            if (r.features && r.features.length > 0) {
            iw.setContent(
                Object.entries(r.features[0].attributes)
                .map(
                    ([k, v]) =>
                    r.fieldAliases[k] + ": " + (v === null ? "" : v)
                )
                .join("<br>")
            );
            iw.open({ map });
            } else {
            iw.close();
            }
        });
    });
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
            $('#v_fdata_id_view').html(id);
            $('[name="v_fdata_id"]').val(id);
            $('[name="v_latitude"]').val(data.latitude);
            $('[name="v_longitude"]').val(data.logitude);
            $('[name="v_no_laluan"]').val(data.no_laluan);
            $('[name="v_nombor_seksyen"]').val(data.nombor_seksyen);
            $('[name="v_pos_kilometer"]').val(data.pos_kilometer);
            $('[name="v_negeri_id"]').val(data.negeri_id);
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

//Modal Delete - View
$(document).on('click','.fdata-delete',function() {
    var id = $(this).data('id');
    $('#modal-delete-fdata').modal('show');
    $('#form-delete-fdata')[0].reset();
    $('.message-form').html('');

    $.ajax({
        url: "ajaxViewDataMap&id=" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="d_fdata_id"]').val(id);
            $('[name="d_latitude"]').val(data.latitude);
            $('[name="d_longitude"]').val(data.logitude);
            $('[name="d_no_laluan"]').val(data.no_laluan);
            $('[name="d_nombor_seksyen"]').val(data.nombor_seksyen);
            $('[name="d_pos_kilometer"]').val(data.pos_kilometer);
            $('[name="v_negeri_id"]').val(data.negeri_id);
            $("#d_no_laporan").html(data.no_laporan);
            $("#d_negeri").html(data.negeri.name);
            $("#d_daerah").html(data.daerah.name);
            $("#d_jenis_kemalangan").html(data.jeniskemalangan.name);
            $("#d_tempat_kejadian").html(data.tempat_kejadian);
            $("#d_tarikh_kejadian").html(data.tarikh);
            $("#d_bulan").html(data.bulan.name);
            $("#d_tahun").html(data.tahun);
            $("#d_jenis_permukaan").html(data.jenis_permukaan.name);
            $("#d_keadaan_jalan").html(data.keadaan_jalan.name);
            $("#d_kualiti_permukaan").html(data.kualiti_permukaan.name);
            $("#d_sistem_laluan").html(data.sistem_laluan.name);
            $("#d_cuaca").html(data.cuaca.name);
            $("#d_jenis_langgar_pertama").html(data.jenis_langgar_pertama.name);
            $("#d_bentuk_jalan").html(data.bentuk_jalan.name);
            $("#d_jenis_garis").html(data.jenis_garis.name);
            $("#d_muka_jalan").html(data.muka_jalan.name);
            $("#d_sebab_cacat_jalan").html(data.sebab_cacat_jalan.name);
            $("#d_cahaya").html(data.cahaya.name);
            $("#d_updated_by").html(data.user.fullname);
            $("#d_bahagian").html(data.user.department.name);
            $("#d_updated_at").html(data.updated);
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
});

//Modal Delete
$('#delete-fdata').click(function(){
    var id = $('[name="d_fdata_id"]').val();

    $.ajax({
        url:"ajaxDeleteDataMap&id=" + id,
        type: "GET",
        data: $('#form-delete-fdata').serialize(),
        dataType: "JSON",
        success: function(data){
            $(location).attr('href','dataMap');
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
});

//Modal View Edit
$(document).on('click','.fdata-edit',function() {
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
    const mygosBaseURL = "https://mygos.mygeoportal.gov.my";
    const mygosMapServer =
        "/gisserver/rest/services/Fundamental_GDC/Transportation_SemenanjungMsia/MapServer";
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-map-service-layer-.htm
    const mygosMapServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/export"
    );
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-feature-service-layer-.htm
    const mygosFeatureServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/10/query"
    );
    const ne = bounds.getNorthEast();
    const sw = bounds.getSouthWest();
    const sr = 4326; // Spatial Reference

    const exportBBOX = sw.lng() + "," + sw.lat() + "," + ne.lng() + "," + ne.lat();
    const mapdiv = /*document.getElementById("map_canvas")*/ map.getDiv();
    mygosMapServiceURL.search = new URLSearchParams({
        bbox: exportBBOX,
        format: "png",
        transparent: "true",
        f: "image",
        bboxSR: sr,
        imageSR: sr,
        size: mapdiv.offsetWidth + "," + mapdiv.offsetHeight,
        layers: "show:10",
    });

    // Delete by remove all overlay in overlays array.
    while (Overlays[0]) {
        Overlays.pop().setMap(null);
    }

    const Overlay = new google.maps.GroundOverlay(
        mygosMapServiceURL.toString(),
        bounds,
        { map: map, opacity: 0.9 }
    );

    // Push new overlay into overlays array
    Overlays.push(Overlay);
    const metersPerPx =
        (156543.03392 * Math.cos((sw.lat() * Math.PI) / 180)) /
        Math.pow(2, map.getZoom());
    Overlay.addListener("click", (e) => {
        const queryURL = new URL(mygosFeatureServiceURL);
        queryURL.search = new URLSearchParams({
        where: "1=1",
        geometry:
            '{"x": ' +
            e.latLng.lng() +
            ', "y":' +
            e.latLng.lat() +
            ', "spatialReference":{"wkid":4326}}',
        geometryType: "esriGeometryPoint",
        inSR: sr,
        spatialRel: "esriSpatialRelIntersects",
        outFields: "*",
        distance: 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
        units: "esriSRUnit_Meter",
        returnGeometry: false,
        resultRecordCount: 1,
        returnExtentOnly: false,
        featureEncoding: "esriDefault",
        f: "pjson",
        });
        fetch(queryURL)
        .then((r) => r.json())
        .then((r) => {
            if (!iw) {
            iw = new google.maps.InfoWindow();
            }
            iw.setPosition(e.latLng);
            if (r.features && r.features.length > 0) {
            iw.setContent(
                Object.entries(r.features[0].attributes)
                .map(
                    ([k, v]) =>
                    r.fieldAliases[k] + ": " + (v === null ? "" : v)
                )
                .join("<br>")
            );
            iw.open({ map });
            } else {
            iw.close();
            }
        });
    });
}
    var id = $(this).data('id');
    $('#modal-edit-fdata').modal('show');
    $('#form-edit-fdata')[0].reset();
    $('.message-form').html('');

    $.ajax({
        url: "ajaxViewDataMap&id=" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('#e_fdata_id_view').html(id);
            $('[name="e_fdata_id"]').val(id);
            $('[name="e_latitude"]').val(data.latitude);
            $('[name="e_longitude"]').val(data.logitude);
            $('[name="e_jenis_jalan_id"]').val(data.jenis_jalan_id).trigger('chosen:updated').trigger('change');
            $('[name="e_jalan_id"]').val(data.jalan_id).trigger('chosen:updated');
            $('[name="e_no_laluan"]').val(data.no_laluan);
            $('[name="e_nombor_seksyen"]').val(data.nombor_seksyen);
            $('[name="e_pos_kilometer"]').val(data.pos_kilometer);
            $('[name="v_negeri_id"]').val(data.negeri_id);
            $("#e_no_laporan").html(data.no_laporan);
            $("#e_negeri").html(data.negeri.name);
            $("#e_daerah").html(data.daerah.name);
            $("#e_jenis_kemalangan").html(data.jeniskemalangan.name);
            $("#e_tempat_kejadian").html(data.tempat_kejadian);
            $("#e_tarikh_kejadian").html(data.tarikh);
            $("#e_bulan").html(data.bulan.name);
            $("#e_tahun").html(data.tahun);
            $("#e_jenis_permukaan").html(data.jenis_permukaan.name);
            $("#e_keadaan_jalan").html(data.keadaan_jalan.name);
            $("#e_kualiti_permukaan").html(data.kualiti_permukaan.name);
            $("#e_sistem_laluan").html(data.sistem_laluan.name);
            $("#e_cuaca").html(data.cuaca.name);
            $("#e_jenis_langgar_pertama").html(data.jenis_langgar_pertama.name);
            $("#e_bentuk_jalan").html(data.bentuk_jalan.name);
            $("#e_jenis_garis").html(data.jenis_garis.name);
            $("#e_muka_jalan").html(data.muka_jalan.name);
            $("#e_sebab_cacat_jalan").html(data.sebab_cacat_jalan.name);
            $("#e_cahaya").html(data.cahaya.name);
            $("#e_updated_by").html(data.user.fullname);
            $("#e_bahagian").html(data.user.department.name);
            $("#e_updated_at").html(data.updated);
            $("#e_created_by").html(data.usercreated.fullname);
            $("#e_created_at").html(data.created);


            var map;

            function initialize() {

                var myLatlng = new google.maps.LatLng(data.latitude, data.logitude);

                var myOptions = {
                    zoom: 17,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                // Avoid too many request to mygos mygeoportal server
                const didle = debounce(function () {
                getOverlayImage(map.getBounds(),map);
                }, 600);
                google.maps.event.addListener(map, "idle", didle);

                var marker = new google.maps.Marker({
                    draggable: true,
                    position: myLatlng,
                    map: map,
                    title: "Your location"
                });

                google.maps.event.addListener(marker, 'dragend', function (event) {
                    const sr = 4326; // Spatial Reference
                    negeriURL = {
                        'JOHOR' : '1',
                        'KEDAH' : '2',
                        'KELANTAN' : '3',
                        'MELAKA' : '4',
                        'NEGERI_SEMBILAN' : '5',
                        'PAHANG' : '6',
                        'PERAK' : '7',
                        'PERLIS' : '8',
                        'PULAU_PINANG' : '9',
                        'SELANGOR' : '10',
                        'TERENGGANU' : '11',
                        'WP_KUALA_LUMPUR' : '12',
                        'PUTRAJAYA' : '13',
                        'WP_LABUAN' : '14',
                    };
                    const mygosFeatureServiceURLSec = new URL(
                        "https://mygos.mygeoportal.gov.my/gisserver/rest/services/JKR_Potholes/Fed_KMPost/MapServer/"
                    );
                    negeri = document.getElementById("e_negeri").innerHTML.split(' ').join('_');
                    const queryURL = new URL(mygosFeatureServiceURLSec + negeriURL[negeri] + '/query');
                    queryURL.search = new URLSearchParams({
                        where: "1=1",
                        geometry:
                            '{"x": ' +
                            event.latLng.lng() +
                            ', "y":' +
                            event.latLng.lat() +
                            ', "spatialReference":{"wkid":4326}}',
                        geometryType: "esriGeometryPoint",
                        inSR: sr,
                        spatialRel: "esriSpatialRelIntersects",
                        outFields: "*",
                        distance: 1000,// 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
                        units: "esriSRUnit_Meter",
                        returnGeometry: true,
                        resultRecordCount: 10,
                        returnExtentOnly: false,
                        featureEncoding: "esriDefault",
                        f: "pjson",
                    });
                    fetch(queryURL)
                        .then((r) => r.json())
                        .then((r) => {
                            if (r.features && r.features.length > 0) {
                                // var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(latitude1, longitude1), new google.maps.LatLng(latitude2, longitude2));

                                let key = Object.keys(r.features).reduce(function (key, v){
                                    var latitude1 = event.latLng.lat();
                                    var longitude1 = event.latLng.lng();
                                    var latitude2 = r.features[v].geometry['y'];
                                    var longitude2 = r.features[v].geometry['x'];
                                    var latitude3 = r.features[key].geometry['y'];
                                    var longitude3 = r.features[key].geometry['x'];
                                    var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(latitude1, longitude1), new google.maps.LatLng(latitude2, longitude2));
                                    var distance2 = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(latitude1, longitude1), new google.maps.LatLng(latitude3, longitude3));
                                    return (distance < distance2) ? v : key;
                                });
                                document.getElementsByName("e_nombor_seksyen")[0].value = (r.features[key].attributes['SEC_NO'] === null ? "0" : r.features[key].attributes['SEC_NO']);
                            }else{
                                document.getElementsByName("e_nombor_seksyen")[0].value = "0";
                            }
                    });
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

//Modal Edit
$('#update-fdata').click(function(){
    var id = $('[name="e_fdata_id"]').val();

    if($('#form-edit-fdata').parsley().validate()){
        $.ajax({
            url:"ajaxUpdateDataMap&id=" + id,
            type: "POST",
            data: $('#form-edit-fdata').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status == 'success'){
                    $('.message-form').html(data.success_form);
                        setTimeout(function(){
                            $('.message-form').remove();
                            $('#modal-edit-fdata').modal('hide');

                            $('.changeLat' + id).html(data.latitude);
                            $('.changeLong' + id).html(data.logitude);
                            $('.changeLaluan' + id).html(data.no_laluan);
                        }, 1000);
                }else{
                    $('.message-form').html(data.error_form);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }
});

$('#sahkan-fdata').click(function(){
    var id = $('[name="e_fdata_id"]').val();

    if($('#form-edit-fdata').parsley().validate()){
        $.ajax({
            url:"ajaxSahkanDataMap&id=" + id,
            type: "POST",
            data: $('#form-edit-fdata').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status == 'success'){
                    $('.message-form').html(data.success_form);
                        setTimeout(function(){
                            $('.message-form').remove();
                            $('#modal-edit-fdata').modal('hide');

                            $('.changeLat' + id).html(data.latitude);
                            $('.changeLong' + id).html(data.logitude);
                            $('.changeLaluan' + id).html(data.no_laluan);
                        }, 1000);
                }else{
                    $('.message-form').html(data.error_form);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }
});

$(document).on('change','input[name^="e_l"]',function() {
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
    var map;

    function initialize() {

        var myLatlng = new google.maps.LatLng($('[name="e_latitude"]').val(), $('[name="e_longitude"]').val());

        var myOptions = {
            zoom: 17,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        // Avoid too many request to mygos mygeoportal server
        const didle = debounce(function () {
        getOverlayImage(map.getBounds(),map);
        }, 600);
        google.maps.event.addListener(map, "idle", didle);

        var marker = new google.maps.Marker({
            draggable: true,
            position: myLatlng,
            map: map,
            title: "Your location"
        });


        google.maps.event.addListener(marker, 'dragend', function (event) {
            const sr = 4326; // Spatial Reference
            negeriURL = {
                'JOHOR' : '1',
                'KEDAH' : '2',
                'KELANTAN' : '3',
                'MELAKA' : '4',
                'NEGERI_SEMBILAN' : '5',
                'PAHANG' : '6',
                'PERAK' : '7',
                'PERLIS' : '8',
                'PULAU_PINANG' : '9',
                'SELANGOR' : '10',
                'TERENGGANU' : '11',
                'WP_KUALA_LUMPUR' : '12',
                'PUTRAJAYA' : '13',
                'WP_LABUAN' : '14',
            };
            const mygosFeatureServiceURLSec = new URL(
                "https://mygos.mygeoportal.gov.my/gisserver/rest/services/JKR_Potholes/Fed_KMPost/MapServer/"
            );
            negeri = document.getElementById("e_negeri").innerHTML.split(' ').join('_');
            const queryURL = new URL(mygosFeatureServiceURLSec + negeriURL[negeri] + '/query');
            queryURL.search = new URLSearchParams({
                where: "1=1",
                geometry:
                    '{"x": ' +
                    event.latLng.lng() +
                    ', "y":' +
                    event.latLng.lat() +
                    ', "spatialReference":{"wkid":4326}}',
                geometryType: "esriGeometryPoint",
                inSR: sr,
                spatialRel: "esriSpatialRelIntersects",
                outFields: "*",
                distance: 1000,// 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
                units: "esriSRUnit_Meter",
                returnGeometry: true,
                resultRecordCount: 10,
                returnExtentOnly: false,
                featureEncoding: "esriDefault",
                f: "pjson",
            });
            fetch(queryURL)
                .then((r) => r.json())
                .then((r) => {
                    console.log(r);
                    if (r.features && r.features.length > 0) {
                        let key = Object.keys(r.features).reduce(function (key, v){
                            var latitude1 = event.latLng.lat();
                            var longitude1 = event.latLng.lng();
                            var latitude2 = r.features[v].geometry['y'];
                            var longitude2 = r.features[v].geometry['x'];
                            var latitude3 = r.features[key].geometry['y'];
                            var longitude3 = r.features[key].geometry['x'];
                            var distance = new google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(latitude1, longitude1), new google.maps.LatLng(latitude2, longitude2));
                            var distance2 = new google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(latitude1, longitude1), new google.maps.LatLng(latitude3, longitude3));
                            return (distance < distance2) ? v : key;
                        });
                        document.getElementsByName("e_nombor_seksyen")[0].value = (r.features[key].attributes['SEC_NO'] === null ? "0" : r.features[key].attributes['SEC_NO']);
                    }else{
                        document.getElementsByName("e_nombor_seksyen")[0].value = "0";
                    }
            });
        });
    }
    google.maps.event.addDomListener(window, "load", initialize())
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

    $.ajax({
        type: 'GET',
        url : 'populateNamaLaluan',
        data : {
            negeri : $(this).val(),
        },
        success:function(data){
            $('.chosen-road').append('<option value="">Pilih Laluan</option>').trigger("chosen:updated");
            $.each(data, function(k,v){
                $('.chosen-road').append('<option value="'+v['no_laluan']+'">'+v['no_laluan']+'</option>').trigger("chosen:updated");
            });
        }
    });
});

$(document).on('click','.kenderaan-data',function() {
    $('.table-list-kenderaan').DataTable().destroy();
    var id = $(this).data('id');
    $('#list_kenderaan').modal('show');
    $('.table-list-kenderaan').DataTable( {
        processing: true,
        serverSide: true,
        ajax: "getListKenderaan&id="+id,
        columns: [
            {data: 'DT_RowIndex', sortable: false,searchable: false},
            {data: 'jenama', name: 'jenama'},
            {data: 'jenis', name: 'jenis.name'},
            {data: 'model_kenderaan', name: 'model_kenderaan'},
            {data: 'punca_kemalangan', name: 'punca_kemalangan'},
            {data: 'tahun_dibuat', name: 'tahun_dibuat'},
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


});

    var table = $('.table-list-fdata').DataTable({
        processing: true,
        serverSide: true,
        ajax:  {
            url: 'getDataMapLpksi',
            data: function (d) {
                d.negeri = $('select[name=negeri]').val() ? $('select[name=negeri]').val() : '';
                d.daerah = $('select[name^=daerah]').val() ? $('select[name^=daerah]').val() : '';
                d.nolaluan = $('select[name^=nolaluan]').val() ? $('select[name^=nolaluan]').val() : '';
                d.s_accident_startdate = $('input[name=s_accident_startdate]').val() ? $('input[name=s_accident_startdate]').val() : '';
                d.s_accident_enddate = $('input[name=s_accident_enddate]').val() ? $('input[name=s_accident_enddate]').val() : '';
                d.sistemlaluan = $('select[name=sistemlaluan]').val() ? $('select[name=sistemlaluan]').val() : '';
                d.status_la = $('select[name=status_la]').val() ? $('select[name=status_la]').val() : '';
            }
        },
        columns: [
            {data: 'DT_RowIndex', sortable: false, searchable: false},
            {data: 'id', name: 'accidents.id'},
            {data: 'koordinat', sortable: false, searchable: false},
            {data: 'negeri', name: 'negeris.name'},
            {data: 'daerah', name: 'daerahs.name'},
            {data: 'no_laluan'},
            {data: 'jalan', name: 'jalans.nama'},
            {data: 'nombor_seksyen'},
            {data: 'kos_pembinaan'},
            {data: 'status_la'},
            {data: 'action', sortable: false, searchable: false},
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
    $(document).on('change','[name="e_jenis_jalan_id"]',function() {
        $('.chosen-nojalan').html('').trigger("chosen:updated");

        if($(this).val() == 2 || $(this).val() == 3){
            $.ajax({
                type: 'GET',
                url : 'ajaxNamalaluan',
                data : {
                    code : $(this).val(),
                    negeri_id : $('[name="v_negeri_id"]').val(),
                },
                success:function(data){
                    $('.chosen-nojalan').append('<option value="">Pilih Laluan</option>').trigger("chosen:updated");
                    $.each(data, function(k,v){
                        $('.chosen-nojalan').append('<option value="'+v['id']+'">'+v['nolaluan']+ ' - ' + v['nama']+'</option>').trigger("chosen:updated");
                    });
                }
            });
            $('#div-e_jalan_id').show();

        }else{
            $('#div-e_jalan_id').hide();
        }
    });
</script>
@endsection
