@extends('layouts/main/main')


@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Peta Data Kemalangan</h2>
        <ol class="breadcrumb">
            <li>
                Peta Data Kemalangan
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
                                    <span class="label label-warning pull-right" style="width:100px;white-space: nowrap;overflow:hidden;text-overflow: ellipsis" title="@if (!empty($filter[1]) && $filter[1] != '') @foreach($daerahlist as $dlist) {{$dlist->name}}@if(count($daerahlist) > 1), @endif @endforeach @else - @endif">
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
                                    <a><i class="fa fa-stethoscope"></i> Jenis Kemalangan
                                    <span class="label label-warning pull-right">
                                        @if($filter[2]!='')
                                            {{$jeniskemalanganlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-calendar"></i> Tarikh Mula
                                    <span class="label label-warning pull-right">{{date("d-m-Y", strtotime($exs_accident_startdate))}}</span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-calendar"></i> Tarikh Akhir
                                    <span class="label label-warning pull-right">{{date("d-m-Y", strtotime($exs_accident_enddate))}}</span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-cogs"></i> Jenis Permukaan
                                    <span class="label label-warning pull-right">
                                        @if($filter[3]!='')
                                            {{$jenispermukaanlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> Keadaan Jalan
                                    <span class="label label-warning pull-right">
                                        @if($filter[4]!='')
                                            {{$keadaanjalanlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> Kualiti Permukaan
                                    <span class="label label-warning pull-right">
                                        @if($filter[5]!='')
                                            {{$kualitipermukaanlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-arrows-alt"></i> Sistem Lalulintas
                                    <span class="label label-warning pull-right">
                                        @if($filter[6]!='')
                                            {{$sistemlaluanlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-sun-o"></i> Cuaca
                                    <span class="label label-warning pull-right">
                                        @if($filter[7]!='')
                                            {{$cuacalist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-car"></i> Jenis Pelanggaran Pertama
                                    <span class="label label-warning pull-right">
                                        @if($filter[8]!='')
                                            {{$jenislanggarpertamalist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> Bentuk Jalan
                                    <span class="label label-warning pull-right">
                                        @if($filter[9]!='')
                                            {{$bentukjalanlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-bars"></i> Jenis Garisan
                                    <span class="label label-warning pull-right">
                                        @if($filter[10]!='')
                                            {{$jenisgarislist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> Jenis Permukaan Jalan
                                    <span class="label label-warning pull-right">
                                        @if($filter[11]!='')
                                            {{$mukajalanlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-road"></i> Sebab Utama Kecacatan Jalan
                                    <span class="label label-warning pull-right">
                                        @if($filter[12]!='')
                                            {{$sebabcacatjalanlist->name}}
                                        @else
                                            -
                                        @endif
                                    </span></a>
                                </li>
                                <li>
                                    <a><i class="fa fa-sun-o"></i> Cahaya
                                    <span class="label label-warning pull-right">
                                        @if($filter[13]!='')
                                            {{$cahayalist->name}}
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
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Carta Data Kemalangan <small>(bagi tempoh dari</small> {{ date('F', strtotime($s_accident_startdate)) }}, {{ date('Y', strtotime($s_accident_startdate)) }} <small>sehingga</small> {{ date('F', strtotime($s_accident_enddate)) }}, {{ date('Y', strtotime($s_accident_enddate)) }} <small>)</small></h5>
                    <div class="ibox-tools">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-outline btn-success dropdown-toggle">Eksport Data <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/jsondownload">
                                @csrf
                                <li>
                                        <input type="hidden" name="exnegeri" value="{{$exnegeri}}">
                                        <input type="hidden" name="exdaerah" value="{{implode(',',$exdaerah)}}">
                                        <input type="hidden" name="exnolaluan" value="{{implode(',',$exnolaluan)}}">
                                        <input type="hidden" name="exjeniskemalangan" value="{{$exjeniskemalangan}}">
                                        <input type="hidden" name="exjenispermukaan" value="{{$exjenispermukaan}}">
                                        <input type="hidden" name="exkeadaanjalan" value="{{$exkeadaanjalan}}">
                                        <input type="hidden" name="exkualitipermukaan" value="{{$exkualitipermukaan}}">
                                        <input type="hidden" name="exsistemlaluan" value="{{$exsistemlaluan}}">
                                        <input type="hidden" name="excuaca" value="{{$excuaca}}">
                                        <input type="hidden" name="exjenislanggarpertama" value="{{$exjenislanggarpertama}}">
                                        <input type="hidden" name="exbentukjalan" value="{{$exbentukjalan}}">
                                        <input type="hidden" name="exjenisgaris" value="{{$exjenisgaris}}">
                                        <input type="hidden" name="exmukajalan" value="{{$exmukajalan}}">
                                        <input type="hidden" name="exsebabcacatjalan" value="{{$exsebabcacatjalan}}">
                                        <input type="hidden" name="excahaya" value="{{$excahaya}}">
                                        <input type="hidden" name="exs_accident_startdate" value="{{$exs_accident_startdate}}">
                                        <input type="hidden" name="exs_accident_enddate" value="{{$exs_accident_enddate}}">
                                        <button target="_blank" class="fa fa-file-code-o btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">JSON</a></button>
                                </li>
                                </form>

                                <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/pdfdownload">
                                @csrf
                                <li>
                                        <input type="hidden" name="exnegeri" value="{{$exnegeri}}">
                                        <input type="hidden" name="exdaerah" value="{{implode(',',$exdaerah)}}">
                                        <input type="hidden" name="exnolaluan" value="{{implode(',',$exnolaluan)}}">
                                        <input type="hidden" name="exjeniskemalangan" value="{{$exjeniskemalangan}}">
                                        <input type="hidden" name="exjenispermukaan" value="{{$exjenispermukaan}}">
                                        <input type="hidden" name="exkeadaanjalan" value="{{$exkeadaanjalan}}">
                                        <input type="hidden" name="exkualitipermukaan" value="{{$exkualitipermukaan}}">
                                        <input type="hidden" name="exsistemlaluan" value="{{$exsistemlaluan}}">
                                        <input type="hidden" name="excuaca" value="{{$excuaca}}">
                                        <input type="hidden" name="exjenislanggarpertama" value="{{$exjenislanggarpertama}}">
                                        <input type="hidden" name="exbentukjalan" value="{{$exbentukjalan}}">
                                        <input type="hidden" name="exjenisgaris" value="{{$exjenisgaris}}">
                                        <input type="hidden" name="exmukajalan" value="{{$exmukajalan}}">
                                        <input type="hidden" name="exsebabcacatjalan" value="{{$exsebabcacatjalan}}">
                                        <input type="hidden" name="excahaya" value="{{$excahaya}}">
                                        <input type="hidden" name="exs_accident_startdate" value="{{$exs_accident_startdate}}">
                                        <input type="hidden" name="exs_accident_enddate" value="{{$exs_accident_enddate}}">
                                        <button target="_blank" class="fa fa-file-pdf-o btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">PDF</a></button>
                                </li>
                                </form>

                                <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/csvdownload">
                                @csrf
                                <li>
                                        <input type="hidden" name="exnegeri" value="{{$exnegeri}}">
                                        <input type="hidden" name="exdaerah" value="{{implode(',',$exdaerah)}}">
                                        <input type="hidden" name="exnolaluan" value="{{implode(',',$exnolaluan)}}">
                                        <input type="hidden" name="exjeniskemalangan" value="{{$exjeniskemalangan}}">
                                        <input type="hidden" name="exjenispermukaan" value="{{$exjenispermukaan}}">
                                        <input type="hidden" name="exkeadaanjalan" value="{{$exkeadaanjalan}}">
                                        <input type="hidden" name="exkualitipermukaan" value="{{$exkualitipermukaan}}">
                                        <input type="hidden" name="exsistemlaluan" value="{{$exsistemlaluan}}">
                                        <input type="hidden" name="excuaca" value="{{$excuaca}}">
                                        <input type="hidden" name="exjenislanggarpertama" value="{{$exjenislanggarpertama}}">
                                        <input type="hidden" name="exbentukjalan" value="{{$exbentukjalan}}">
                                        <input type="hidden" name="exjenisgaris" value="{{$exjenisgaris}}">
                                        <input type="hidden" name="exmukajalan" value="{{$exmukajalan}}">
                                        <input type="hidden" name="exsebabcacatjalan" value="{{$exsebabcacatjalan}}">
                                        <input type="hidden" name="excahaya" value="{{$excahaya}}">
                                        <input type="hidden" name="exs_accident_startdate" value="{{$exs_accident_startdate}}">
                                        <input type="hidden" name="exs_accident_enddate" value="{{$exs_accident_enddate}}">
                                        <button target="_blank" class="fa fa-file-text-o btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">CSV</a></button>
                                </li>
                                </form>

                                <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/exceldownload">
                                @csrf
                                <li>
                                        <input type="hidden" name="exnegeri" value="{{$exnegeri}}">
                                        <input type="hidden" name="exdaerah" value="{{implode(',',$exdaerah)}}">
                                        <input type="hidden" name="exnolaluan" value="{{implode(',',$exnolaluan)}}">
                                        <input type="hidden" name="exjeniskemalangan" value="{{$exjeniskemalangan}}">
                                        <input type="hidden" name="exjenispermukaan" value="{{$exjenispermukaan}}">
                                        <input type="hidden" name="exkeadaanjalan" value="{{$exkeadaanjalan}}">
                                        <input type="hidden" name="exkualitipermukaan" value="{{$exkualitipermukaan}}">
                                        <input type="hidden" name="exsistemlaluan" value="{{$exsistemlaluan}}">
                                        <input type="hidden" name="excuaca" value="{{$excuaca}}">
                                        <input type="hidden" name="exjenislanggarpertama" value="{{$exjenislanggarpertama}}">
                                        <input type="hidden" name="exbentukjalan" value="{{$exbentukjalan}}">
                                        <input type="hidden" name="exjenisgaris" value="{{$exjenisgaris}}">
                                        <input type="hidden" name="exmukajalan" value="{{$exmukajalan}}">
                                        <input type="hidden" name="exsebabcacatjalan" value="{{$exsebabcacatjalan}}">
                                        <input type="hidden" name="excahaya" value="{{$excahaya}}">
                                        <input type="hidden" name="exs_accident_startdate" value="{{$exs_accident_startdate}}">
                                        <input type="hidden" name="exs_accident_enddate" value="{{$exs_accident_enddate}}">
                                        <button target="_blank" class="fa fa-file-excel-o btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">EXCEL</a></button>
                                </li>
                                </form>
                            </ul>

                        </div>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="slick_chart">
                    <div>
                        <div class="ibox-content">
                            <div class="row">
                                <div>
                                    <div id="barChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="ibox-content">
                            <div class="row">
                                <div>
                                    <div id="lineChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="ibox-content">
                            <div class="row">
                                <div>
                                    <div id="pieChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">&nbsp;</div>

    <h4>Maklumat Kawasan Kemalangan</h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="map" id="mapAccident" style="height: 500px">{!! $map['html'] !!}
            <div class="container">
                <div class="content">
                    <div id="leftTopControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Left Top Control.
                    </div>
                    <div id="leftCenterControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Left Center Control.
                    </div>
                    <div id="leftBottomControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Left Bottom Control.
                    </div>
                    <div id="bottomRightControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Bottom Right Control.
                    </div>
                    <div id="bottomCenterControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Bottom Center Control.
                    </div>
                    <div id="bottomLeftControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Bottom Left Control.
                    </div>
                    <div id="rightTopControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Right Top Control.
                    </div>
                    <div id="rightCenterControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Right Center Control.
                    </div>
                    <div id="rightBottomControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Right Bottom Control.
                    </div>
                    <div id="topLeftControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Top Left Control.
                    </div>
                    <div id="topCenterControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Top Center Control.
                    </div>
                    <div id="topRightControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
                        This is Top Right Control.
                    </div>

                </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-edit-fdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Kemaskini Maklumat Data</h4>
            </div>
            <form id="form-edit-fdata">
                @csrf
                <div class="modal-body">
                    <div class="message-form"></div>
                    <div class="row">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Nombor Laluan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
                                    <input type="text" name="e_no_laluan" class="form-control" placeholder="Nombor Laluan" value="" />
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
                                    <input type="text" name="e_nombor_seksyen" class="form-control" placeholder="Nombor Seksyen" value="" />
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
                                            <i class="fa fa-map-marker"></i> No. Laporan
                                            <span class="label label-warning pull-right" id="e_no_laporan">-</span>
                                        </a>
                                    </li>
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
                                            <i class="fa fa-road"></i> Tempat Kejadian
                                            <span class="label label-warning pull-right" id="e_tempat_kejadian">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-stethoscope"></i> Jenis Kemalangan
                                            <span class="label label-warning pull-right" id="e_jenis_kemalangan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar"></i> Tarikh Kejadian
                                            <span class="label label-warning pull-right" id="e_tarikh_kejadian">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar-o"></i> Bulan
                                            <span class="label label-warning pull-right" id="e_bulan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-calendar-o"></i> Tahun
                                            <span class="label label-warning pull-right" id="e_tahun">-</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-cogs"></i> Jenis Permukaan
                                            <span class="label label-warning pull-right" id="e_jenis_permukaan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Keadaan Jalan
                                            <span class="label label-warning pull-right" id="e_keadaan_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Kualiti Permukaan
                                            <span class="label label-warning pull-right" id="e_kualiti_permukaan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-arrows-alt"></i> Sistem Lalulintas
                                            <span class="label label-warning pull-right" id="e_sistem_laluan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-sun-o"></i> Cuaca
                                            <span class="label label-warning pull-right" id="e_cuaca"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-car"></i> Jenis Pelanggaran Pertama
                                            <span class="label label-warning pull-right" id="e_jenis_langgar_pertama"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Bentuk Jalan
                                            <span class="label label-warning pull-right" id="e_bentuk_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-bars"></i> Jenis Garisan
                                            <span class="label label-warning pull-right" id="e_jenis_garis"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-bars"></i> Jenis Permukaan Jalan
                                            <span class="label label-warning pull-right" id="e_muka_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-road"></i> Sebab Utama Kecacatan Jalan
                                            <span class="label label-warning pull-right" id="e_sebab_cacat_jalan"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-sun-o"></i> Cahaya
                                            <span class="label label-warning pull-right" id="e_cahaya"></span>
                                        </a>
                                    </li>
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
                                </ul>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Maklumat Kawasan Kemalangan</strong></label>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="map_canvas" style="width: 500px; height: 250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="update-fdata" class="btn btn-primary">Simpan</a>
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
                <h4 class="modal-title">Tapisan Data Kemalangan</h4>
            </div>
                <form id="form-filter-fdata" method="POST" action="{{URL('/dataGMaps')}}">
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
                                <label><strong>Jenis Kemalangan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-stethoscope"></i>
                                    </span>
									{!! html()->select('jeniskemalangan', $jeniskemalangan, old('jenis_kemalangan_id'))
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenis Permukaan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cogs"></i>
                                    </span>
									{!! html()->select('jenispermukaan', $jenispermukaan, old('jenis_permukaan_id'))
                                    ->class('form-control m-b chosen-surface')
                                    ->placeholder('Pilih Jenis Permukaan') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Keadaan Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
									{!! html()->select('keadaanjalan', $keadaanjalan, old('keadaan_jalan_id'))
                                    ->class('form-control m-b chosen-condition')
                                    ->placeholder('Pilih Keadaan Jalan') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Kualiti Permukaan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-cog"></i>
                                    </span>
									{!! html()->select('kualitipermukaan', $kualitipermukaan, old('kualiti_permukaan_id'))
                                    ->class('form-control m-b chosen-quality')
                                    ->placeholder('Pilih Kualiti Permukaan') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Sistem Lalulintas</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-arrows-alt"></i>
                                    </span>
									{!! html()->select('sistemlaluan', $sistemlaluan, old('sistem_laluan_id'))
                                    ->class('form-control m-b chosen-traffic')
                                    ->placeholder('Pilih Sistem Lalulintas') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Cuaca</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sun-o"></i>
                                    </span>
                                    {!! html()->select('cuaca', $cuaca, old('cuaca_id'))
                                    ->class('form-control m-b chosen-weather')
                                    ->placeholder('Pilih Cuaca') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenis Pelanggaran Yang Pertama</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-car"></i>
                                    </span>
									{!! html()->select('jenislanggarpertama', $jenislanggarpertama, old('jenis_langgar_pertama_id'))
                                    ->class('form-control m-b chosen-hit')
                                    ->placeholder('Pilih Pelanggaran') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Bentuk Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
									{!! html()->select('bentukjalan', $bentukjalan, old('bentuk_jalan_id'))
                                    ->class('form-control m-b chosen-road-shape')
                                    ->placeholder('Pilih Bentuk Jalan') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenis Garisan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-bars"></i>
                                    </span>
									{!! html()->select('jenisgaris', $jenisgaris, old('jenis_garis_id'))
                                    ->class('form-control m-b chosen-line')
                                    ->placeholder('Pilih Garisan') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Jenis Permukaan Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
									{!! html()->select('mukajalan', $mukajalan, old('muka_jalan_id'))
                                    ->class('form-control m-b chosen-road-surface')
                                    ->placeholder('Pilih Permukaan Jalan') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Sebab-sebab Utama Kecacatan Jalan</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-road"></i>
                                    </span>
									{!! html()->select('sebabcacatjalan', $sebabcacatjalan, old('sebab_cacat_jalan_id'))
                                    ->class('form-control m-b chosen-road-defact')
                                    ->placeholder('Pilih Kecacatan Jalan') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Cahaya</strong></label>
                                <div class="input-group m-b">
                                    <span class="input-group-addon">
                                        <i class="fa fa-sun-o"></i>
                                    </span>
									{!! html()->select('cahaya', $cahaya, old('cahaya_id'))
                                    ->class('form-control m-b chosen-light')
                                    ->placeholder('Pilih Cahaya') !!}
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
<script src="https://maps.google.com/maps/api/js?key={{ env('GMAP_KEY') }}"></script>
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
<script src="{{ URL::asset('rams/js/sweetalert/sweetalert.min.js') }}"></script>
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

//Main Map
var acc = <?php print_r(json_encode($acc)) ?>;

var mymap = new GMaps({
  el: '#mapAccident',
  lat: <?php echo $zoomnegeri->latitude?>,
  lng: <?php echo $zoomnegeri->logitude?>,
  zoom:15
});
// Avoid too many request to mygos mygeoportal server
const didle = debounce(function () {
    getOverlayImage(mymap.map.getBounds(),mymap.map);
}, 600);
google.maps.event.addListener(mymap.map, "idle", didle);

  $.each( acc, function( index, value ){
    var icon = '';
    var alert = '';

    if(value.jenis_kemalangan_id == 1){
        icon = "{{ URL::asset('rams/images/icon/Maut.png') }}";
        alert = 'Ini adalah kawasan maut.';
    }else if(value.jenis_kemalangan_id == 2){
        icon = "{{ URL::asset('rams/images/icon/Parah.png') }}";
        alert = 'Ini adalah kawasan Parah.';
    }else if(value.jenis_kemalangan_id == 3){
        icon = "{{ URL::asset('rams/images/icon/Ringan.png') }}";
        alert = 'Ini adalah kawasan Ringan.';
    }else{
        icon = "{{ URL::asset('rams/images/icon/Rosak.png') }}";
        alert = 'Ini adalah kawasan Rosak.';
    }

    mymap.addMarker({
      lat: value.latitude,
      lng: value.logitude,
      icon: icon,
      @if(!Auth::user()->pengguna())
      draggable: true,
      dragstart: function() {
        markerPosition = this.getPosition();
      },
      dragend: function(event) {
            var formData = new FormData();

            formData.append( "_token", '{{ csrf_token() }}');
            formData.append('e_latitude', event.latLng.lat());
            formData.append('e_longitude', event.latLng.lng());

            swal({
              title: "Adakah anda pasti?",
              text: "Untuk mengubah koordinat data ini?",
              icon: "warning",
              buttons: ["Batal", "Teruskan"],
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url:"ajaxUpdateDataMap&id=" + value.id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        swal("Data berjaya dikemaskini!", {
                          icon: "success",
                        });
                    }
                });
              } else {
                swal("Data tidak berjaya disimpan!");
                this.setPosition(markerPosition);
              }
            });
      },
      @endif
      infoWindow: {
        content: '<div style="overflow: scroll; width: auto; height: 310px;">' +
                        '<ul class="folder-list m-b-md" style="padding: 0">' +
                            '<li>' +
                                '<a><i class="fa fa-group"></i> ID' +
                                '<span class="label label-warning pull-right">' +
                                    value.id +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-list"></i> No. Laporan' +
                                '<span class="label label-warning pull-right">' +
                                    value.no_laporan +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-map-marker"></i> Negeri' +
                                '<span class="label label-warning pull-right">' +
                                    value.negeri.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-map-marker"></i> Daerah' +
                                '<span class="label label-warning pull-right">' +
                                    value.daerah.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-road"></i> No. Laluan' +
                                '<span class="label label-warning pull-right">' +
                                    value.no_laluan +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-road"></i> Nombor Seksyen' +
                                '<span class="label label-warning pull-right">' +
                                    value.nombor_seksyen +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-road"></i> Pos Kilometer' +
                                '<span class="label label-warning pull-right">' +
                                    value.pos_kilometer +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-road"></i> Tempat Kejadian' +
                                '<span class="label label-warning pull-right">' +
                                    value.tempat_kejadian +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-stethoscope"></i> Jenis Kemalangan' +
                                '<span class="label label-warning pull-right">' +
                                    value.jenis_kemalangan.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-calendar"></i> Tarikh Kejadian' +
                                '<span class="label label-warning pull-right">'+
                                    value.tarikh +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-calendar-o"></i> Bulan' +
                                '<span class="label label-warning pull-right">' +
                                    value.bulan.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-calendar-o"></i> Tahun' +
                                '<span class="label label-warning pull-right">' +
                                    value.tahun +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-cogs"></i> Jenis Permukaan' +
                                '<span class="label label-warning pull-right">' +
                                    value.jenis_permukaan.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-road"></i> Keadaan Jalan' +
                                '<span class="label label-warning pull-right">' +
                                    value.keadaan_jalan.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-road"></i> Kualiti Permukaan' +
                                '<span class="label label-warning pull-right">' +
                                    value.kualiti_permukaan.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-arrows-alt"></i> Sistem Lalulintas' +
                                '<span class="label label-warning pull-right">' +
                                    value.sistem_laluan.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-sun-o"></i> Cuaca' +
                                '<span class="label label-warning pull-right">' +
                                    value.cuaca.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-car"></i> Jenis Pelanggaran Pertama' +
                                '<span class="label label-warning pull-right">' +
                                    value.jenis_langgar_pertama.name +
                                '</span></a>' +
                            '</li>' +
                           ' <li>' +
                                '<a><i class="fa fa-road"></i> Bentuk Jalan' +
                                '<span class="label label-warning pull-right">' +
                                    value.bentuk_jalan.name +
                                '</span></a>' +
                            '</li>' +
                           ' <li>' +
                                '<a><i class="fa fa-bars"></i> Jenis Garisan' +
                                '<span class="label label-warning pull-right">' +
                                    value.jenis_garis.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-road"></i> Jenis Permukaan Jalan' +
                                '<span class="label label-warning pull-right">' +
                                    value.muka_jalan.name +
                                '</span></a>' +
                            '</li>' +
                           ' <li>' +
                                '<a><i class="fa fa-road"></i> Sebab Utama Kecacatan Jalan' +
                                '<span class="label label-warning pull-right">' +
                                    value.sebab_cacat_jalan.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-sun-o"></i> Cahaya' +
                                '<span class="label label-warning pull-right">' +
                                    value.cahaya.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-user"></i> Dikemaskini oleh' +
                                '<span class="label label-warning pull-right">' +
                                    value.user.fullname +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-building"></i> Bahagian' +
                                '<span class="label label-warning pull-right">' +
                                    value.user.department.name +
                                '</span></a>' +
                            '</li>' +
                            '<li>' +
                                '<a><i class="fa fa-calendar"></i> Dikemaskini pada' +
                                '<span class="label label-warning pull-right">' +
                                    value.updated +
                                '</span></a>' +
                            '</li>' +
                        '</ul>' +
                            @if(!Auth::user()->pengguna())
                            '<a class="btn btn-outline btn-sm btn-warning fdata-edit" data-toggle="tooltip" data-placement="top" data-id="' + value.id +'" title="Kemaskini Data"><i class="fa fa-edit"></i></a>' +
                            @endif
                    '</div>',

        overflow: 'scroll',
      },
    });
});

//From datamap.js
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

//Modal View Edit
$(document).on('click','.fdata-edit',function() {
    var id = $(this).data('id');
    $('#modal-edit-fdata').modal('show');
    $('#form-edit-fdata')[0].reset();
    $('.message-form').html('');

    $.ajax({
        url: "ajaxViewDataMap&id=" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="e_fdata_id"]').val(id);
            $('[name="e_latitude"]').val(data.latitude);
            $('[name="e_longitude"]').val(data.logitude);
            $('[name="e_no_laluan"]').val(data.no_laluan);
            $('[name="e_nombor_seksyen"]').val(data.nombor_seksyen);
            $('[name="e_pos_kilometer"]').val(data.pos_kilometer);
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
        getOverlayImage(map.getBounds(), map);
        }, 600);
        google.maps.event.addListener(map, "idle", didle);

        var marker = new google.maps.Marker({
            draggable: true,
            position: myLatlng,
            map: map,
            title: "Your location"
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
});
</script>
@endsection
