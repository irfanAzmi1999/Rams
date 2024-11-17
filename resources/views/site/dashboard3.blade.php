@extends('layouts/main/main')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('statusdanger'))
                    <div class="alert alert-danger">
                        {{ session('statusdanger') }}
                    </div>
                @endif
                <div class="ibox-title">
                    <h5>Carta Data Kemalangan <small>(bagi tempoh dari</small> {{ date('F', strtotime($s_accident_startdate)) }}, {{ date('Y', strtotime($s_accident_startdate)) }} <small>sehingga</small> {{ date('F', strtotime($s_accident_enddate)) }}, {{ date('Y', strtotime($s_accident_enddate)) }} <small>)</small></h5>
                    <ul class="navbar-top-links navbar-right navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle data-filter"><i class="fa fa-search"></i> Carian</a>
                        </li>
                    </ul>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="row wrapper-panel">
                                <div class="panel panel-info panel-maut" style="height: 160px;">
                                    <div class="panel-heading " style="background-color: #000000;">
                                        <h2 class="m-b-md " style="text-align: center;">Baru</h2>
                                    </div>
                                    <div class="panel-body maut-text" style="text-align: center;font-size: 50px;">
                                        <form id="form-filter-status-baru" method="POST" action="{{ url('/filterdataMap') }}">
                                            @csrf
                                            <input type="hidden" name="negeri" value="{{ $filter[0] }}">
                                            @foreach ($filter[1] as $daerah2)
                                                <input type="hidden" name="daerah[]" value="{{ $daerah2 }}">
                                            @endforeach
                                            <input type="hidden" name="jeniskemalangan" value="{{ $filter[2] }}">
                                            @foreach ($filter[3] as $nolaluan)
                                                <input type="hidden" name="nolaluan[]" value="{{ $nolaluan }}">
                                            @endforeach
                                            <input type="hidden" name="s_accident_startdate" value="{{ date("d-m-Y", strtotime($s_accident_startdate)) }}">
                                            <input type="hidden" name="s_accident_enddate" value="{{ date("d-m-Y", strtotime($s_accident_enddate)) }}">
                                            <input type="hidden" name="status_la" value="BARU">
                                            <a href="javascript:{}" onclick="document.getElementById('form-filter-status-baru').submit();">
                                                {{-- Nombor kena calculate kemangan dengan status baru --}}
                                                {{$bil_baru}}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row wrapper-panel">
                                <div class="panel panel-danger panel-maut" style="height: 160px;">
                                    <div class="panel-heading ">
                                        <h2 class="m-b-md " style="text-align: center;">Draf</h2>
                                    </div>
                                    <div class="panel-body maut-text" style="text-align: center;font-size: 50px;">
                                        <form id="form-filter-status-draf" method="POST" action="{{ url('/filterdataMap') }}">
                                            @csrf
                                            <input type="hidden" name="negeri" value="{{ $filter[0] }}">
                                            @foreach ($filter[1] as $daerah2)
                                                <input type="hidden" name="daerah[]" value="{{ $daerah2 }}">
                                            @endforeach
                                            <input type="hidden" name="jeniskemalangan" value="{{ $filter[2] }}">
                                            @foreach ($filter[3] as $nolaluan)
                                                <input type="hidden" name="nolaluan[]" value="{{ $nolaluan }}">
                                            @endforeach
                                            <input type="hidden" name="s_accident_startdate" value="{{ date("d-m-Y", strtotime($s_accident_startdate)) }}">
                                            <input type="hidden" name="s_accident_enddate" value="{{ date("d-m-Y", strtotime($s_accident_enddate)) }}">
                                            <input type="hidden" name="status_la" value="DRAF">
                                            <a href="javascript:{}" onclick="document.getElementById('form-filter-status-draf').submit();">
                                                {{-- Nombor kena calculate kemangan dengan status baru --}}
                                                {{$bil_draf}}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row wrapper-panel">
                                <div class="panel panel-success panel-maut" style="height: 160px;">
                                    <div class="panel-heading ">
                                        <h2 class="m-b-md " style="text-align: center;">Sah</h2>
                                    </div>
                                    <div class="panel-body maut-text" style="text-align: center;font-size: 50px;">
                                        <form id="form-filter-status-sah" method="POST" action="{{ url('/filterdataMap') }}">
                                            @csrf
                                            <input type="hidden" name="negeri" value="{{ $filter[0] }}">
                                            @foreach ($filter[1] as $daerah2)
                                                <input type="hidden" name="daerah[]" value="{{ $daerah2 }}">
                                            @endforeach
                                            <input type="hidden" name="jeniskemalangan" value="{{ $filter[2] }}">
                                            @foreach ($filter[3] as $nolaluan)
                                                <input type="hidden" name="nolaluan[]" value="{{ $nolaluan }}">
                                            @endforeach
                                            <input type="hidden" name="s_accident_startdate" value="{{ date("d-m-Y", strtotime($s_accident_startdate)) }}">
                                            <input type="hidden" name="s_accident_enddate" value="{{ date("d-m-Y", strtotime($s_accident_enddate)) }}">
                                            <input type="hidden" name="status_la" value="DISAHKAN">
                                            <a href="javascript:{}" onclick="document.getElementById('form-filter-status-sah').submit();">
                                                    {{$bil_sah}}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="m-b-md">Negeri</h5>
                </div>
                <div class="ibox-content" style="text-align: center;">
                    <h2 class="text-navy">
                        @if($filter[0]!='')
                            {{$zoomnegeri->name}}
                        @else
                            SEMUA
                        @endif
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="m-b-md">Daerah</h5>
                </div>
                <div class="ibox-content" style="text-align: center;">
                    <h2 class="text-navy" style="white-space: nowrap;overflow:hidden;text-overflow: ellipsis" title="@if (!empty($filter[1]) && $filter[1] != '') @foreach($daerahlist as $dlist) {{$dlist->name}}@if(count($daerahlist) > 1), @endif @endforeach @else SEMUA @endif">
                        @if(!empty($filter[1]) && $filter[1] != '')
                            @foreach($daerahlist as $dlist)
                                {{$dlist->name}}@if(count($daerahlist) > 1), @endif
                            @endforeach
                        @elseif(Auth::user()->jkrdaerah())
                            {{ implode(',',Auth::user()->daerah()->pluck('name')->toArray()) }}
                        @else
                            SEMUA
                        @endif
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="m-b-md">No laluan</h5>
                </div>
                <div class="ibox-content" style="text-align: center;">
                    <h2 class="text-navy" style="overflow:hidden;text-overflow: ellipsis" title="@if (!empty($filternolaluan) && $filternolaluan[0] != '') {{ implode(',', $filternolaluan) }} @else SEMUA @endif">
                        @if(!empty($filternolaluan) && $filternolaluan[0] != '')
                            {{ implode(',', $filternolaluan) }}
                        @else
                            SEMUA
                        @endif
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins" >
                <div class="ibox-title">
                    <h5 class="m-b-md">Kategori Kemalangan</h5>
                </div>
                <div class="ibox-content" style="text-align: center;">
                    <h2 class="text-navy">
                        @if($filter[2]!='')
                            {{ $jeniskemalanganlist->name }}
                        @else
                            SEMUA
                        @endif
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <h4>Maklumat Kawasan Kemalangan</h4>
    <div class="row">
        <div class="col-lg-12">
            <!--Start Map-->
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
          <!--End Map-->
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
            <form id="form-filter-fdata" method="POST" action="{{URL('/filterdashboard')}}">
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

                                    {!!
                                        html()->select('negeri', $negeri, Auth::user()->negeri_id)
                                        ->class('form-control m-b chosen-state')
                                        ->placeholder('Pilih Negeri')
                                        ->attribute('disabled', true)
                                    !!}

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
                                    @if(!empty($filter[3]))
                                    <select data-placeholder="Pilih Laluan" class="form-control m-b chosen-road" name="nolaluan[]" multiple>
                                        <option value="">Pilih Laluan</option>
                                        @foreach ($filter[3] as $f3)
                                            <option selected="{{$f3}}">{{$f3}}</option>
                                        @endforeach
                                        @foreach($nolaluan as $no_laluan)
                                            @if(!in_array($no_laluan->no_laluan, $filter[3]))
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
<script src="{{ URL::asset('js/gmaps.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/d3/d3.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/c3/c3.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ URL::asset('mycity/js/map.js') }}"></script>
<script src="{{ URL::asset('mycity/js/infobox.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

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

var acc = <?php print_r(json_encode($acc)) ?>;
  //  var mymap = new GMaps({
  //    el: '#mapAccident',
//    lat: <?php echo $zoomnegeri->latitude ?>,
//    lng: <?php echo $zoomnegeri->logitude ?>,
//    zoom:15
//  });


var mymap = new google.maps.Map(document.getElementById('mapAccident'), {
    zoom: 15,
    center: new google.maps.LatLng(<?php echo $zoomnegeri->latitude ?>, <?php echo $zoomnegeri->logitude ?>)
});

// Avoid too many request to mygos mygeoportal server
const didle = debounce(function () {
    getOverlayImage(mymap.getBounds(),mymap);
}, 600);
google.maps.event.addListener(mymap, "idle", didle);

var infowindow = new google.maps.InfoWindow();
   // 1 Maut
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
        }else if(value.jenis_kemalangan_id == 4){
            icon = "{{ URL::asset('rams/images/icon/Rosak.png') }}";
            alert = 'Ini adalah kawasan Rosak.';
        }else {
            icon = "{{ URL::asset('rams/images/icon/Rosak.png') }}";
            alert = 'Ini adalah kawasan Rosak.';
        }



         var marker =  new google.maps.Marker({
            position: new google.maps.LatLng(value.latitude,value.logitude),
            map: mymap, //this will create the marker
            icon:icon,

        }).addListener('click', function(){
             infowindow.close();
             load_content(this, value.id);//this one will listen to click and show menu
        });


        // mymap.addMarker({
        //   lat: value.latitude,
        //   lng: value.logitude,
        //   icon: icon,
        //           infoWindow: {
        //         content: '<div class="scroll_content" style="overflow: scroll; width: auto; height: 310px;">' +
        //                         '<ul class="folder-list m-b-md" style="padding: 0">' +
        //                             '<li>' +
        //                                 '<a><i class="fa fa-group"></i> ID' +
        //                                 '<span class="label label-warning pull-right">' +
        //                                     value.id +
        //                                 '</span></a>' +
        //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-list"></i> No. Laporan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.no_laporan +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-map-marker"></i> Negeri' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.negeri.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-map-marker"></i> Daerah' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.daerah.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-road"></i> No. Laluan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.no_laluan +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-road"></i> Nombor Seksyen' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.nombor_seksyen +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-road"></i> Pos Kilometer' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.pos_kilometer +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-road"></i> Tempat Kejadian' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.tempat_kejadian +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-stethoscope"></i> Jenis Kemalangan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.jenis_kemalangan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-calendar"></i> Tarikh Kejadian' +
        // //                                 '<span class="label label-warning pull-right">'+
        // //                                     value.tarikh +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-calendar-o"></i> Bulan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.bulan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-calendar-o"></i> Tahun' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.tahun +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-cogs"></i> Jenis Permukaan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.jenis_permukaan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-road"></i> Keadaan Jalan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.keadaan_jalan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-road"></i> Kualiti Permukaan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.kualiti_permukaan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-arrows-alt"></i> Sistem Lalulintas' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.sistem_laluan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-sun-o"></i> Cuaca' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.cuaca.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-car"></i> Jenis Pelanggaran Pertama' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.jenis_langgar_pertama.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                            ' <li>' +
        // //                                 '<a><i class="fa fa-road"></i> Bentuk Jalan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.bentuk_jalan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                            ' <li>' +
        // //                                 '<a><i class="fa fa-bars"></i> Jenis Garisan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.jenis_garis.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-road"></i> Jenis Permukaan Jalan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.muka_jalan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                            ' <li>' +
        // //                                 '<a><i class="fa fa-road"></i> Sebab Utama Kecacatan Jalan' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.sebab_cacat_jalan.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // //                             '<li>' +
        // //                                 '<a><i class="fa fa-sun-o"></i> Cahaya' +
        // //                                 '<span class="label label-warning pull-right">' +
        // //                                     value.cahaya.name +
        // //                                 '</span></a>' +
        // //                             '</li>' +
        // // //                            '<li>' +
        // // //                                '<a><i class="fa fa-user"></i> Dikemaskini oleh' +
        // // //                                '<span class="label label-warning pull-right">' +
        // // //                                    value.user.fullname +
        // // //                                '</span></a>' +
        // // //                            '</li>' +
        // // //                            '<li>' +
        // // //                                '<a><i class="fa fa-building"></i> Bahagian' +
        // // //                                '<span class="label label-warning pull-right">' +
        // // //                                    value.user.department.name +
        // // //                                '</span></a>' +
        // // //                            '</li>' +
        // // //                            '<li>' +
        // // //                                '<a><i class="fa fa-calendar"></i> Dikemaskini pada' +
        // // //                                '<span class="label label-warning pull-right">' +
        // // //                                    value.updated +
        // // //                                '</span></a>' +
        // // //                            '</li>' +
        //                             '</ul>' +
        //                         '</div>',
        //             overflow: 'scroll',
        //       },
        // }).addListener('click', function(){
        //     console.log(mymap);
        // });
   });
function load_content(marker, id){
    $.ajax({
        url: "ajaxViewData&id=" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            infowindow.setContent('<div class="scroll_content" style=" width: auto; height: 310px;">' +
                '<ul class="folder-list m-b-md" style="padding: 0">' +
                '<li>' +
                '<a><i class="fa fa-group"></i> ID' +
                '<span class="label label-warning pull-right">' +
                data.id +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-list"></i> No. Laporan' +
                '<span class="label label-warning pull-right">' +
                data.no_laporan +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-map-marker"></i> Negeri' +
                '<span class="label label-warning pull-right">' +
                data.negeri.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-map-marker"></i> Daerah' +
                '<span class="label label-warning pull-right">' +
                data.daerah.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-road"></i> No. Laluan' +
                '<span class="label label-warning pull-right">' +
                data.no_laluan +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-road"></i> Nombor Seksyen' +
                '<span class="label label-warning pull-right">' +
                data.nombor_seksyen +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-road"></i> Pos Kilometer' +
                '<span class="label label-warning pull-right">' +
                data.pos_kilometer +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-road"></i> Tempat Kejadian' +
                '<span class="label label-warning pull-right">' +
                data.tempat_kejadian +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-stethoscope"></i> Jenis Kemalangan' +
                '<span class="label label-warning pull-right">' +
                data.jeniskemalangan.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-calendar"></i> Tarikh Kejadian' +
                '<span class="label label-warning pull-right">'+
                data.tarikh +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-calendar-o"></i> Bulan' +
                '<span class="label label-warning pull-right">' +
                data.bulan.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-calendar-o"></i> Tahun' +
                '<span class="label label-warning pull-right">' +
                data.tahun +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-cogs"></i> Jenis Permukaan' +
                '<span class="label label-warning pull-right">' +
                data.jenis_permukaan.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-road"></i> Keadaan Jalan' +
                '<span class="label label-warning pull-right">' +
                data.keadaan_jalan.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-road"></i> Kualiti Permukaan' +
                '<span class="label label-warning pull-right">' +
                data.kualiti_permukaan.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-arrows-alt"></i> Sistem Lalulintas' +
                '<span class="label label-warning pull-right">' +
                data.sistem_laluan.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-sun-o"></i> Cuaca' +
                '<span class="label label-warning pull-right">' +
                data.cuaca.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-car"></i> Jenis Pelanggaran Pertama' +
                '<span class="label label-warning pull-right">' +
                data.jenis_langgar_pertama.name +
                '</span></a>' +
                '</li>' +
                ' <li>' +
                '<a><i class="fa fa-road"></i> Bentuk Jalan' +
                '<span class="label label-warning pull-right">' +
                data.bentuk_jalan.name +
                '</span></a>' +
                '</li>' +
                ' <li>' +
                '<a><i class="fa fa-bars"></i> Jenis Garisan' +
                '<span class="label label-warning pull-right">' +
                data.jenis_garis.name +
                '</span></a>' +
                '</li>' +
                '<li>' +
                '<a><i class="fa fa-road"></i> Jenis Permukaan Jalan' +
                '<span class="label label-warning pull-right">' +
                data.muka_jalan.name +
                '</span></a>' +
                '</li>' +
                // ' <li>' +
                // '<a><i class="fa fa-road"></i> Sebab Utama Kecacatan Jalan' +
                // '<span class="label label-warning pull-right">' +
                // data.sebab_cacat_jalan.name +
                // '</span></a>' +
                // '</li>' +
                // '<li>' +
                // '<a><i class="fa fa-sun-o"></i> Cahaya' +
                // '<span class="label label-warning pull-right">' +
                // data.cahaya.name +
                // '</span></a>' +
                // '</li>' +
                '<li>' +
                    '<a><i class="fa fa-user"></i> Dikemaskini oleh' +
                    '<span class="label label-warning pull-right">' +
                        data.user.fullname +
                    '</span></a>' +
                '</li>' +
                '<li>' +
                    '<a><i class="fa fa-building"></i> Bahagian' +
                    '<span class="label label-warning pull-right">' +
                        data.user.department.name +
                    '</span></a>' +
                '</li>' +
                '<li>' +
                    '<a><i class="fa fa-calendar"></i> Dikemaskini pada' +
                    '<span class="label label-warning pull-right">' +
                        data.updated +
                    '</span></a>' +
                '</li>' +
                '</ul>' +
                '</div>');
            infowindow.open(mymap, marker)
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}

$(document).ready(function() {
    // c3.generate({
    //     bindto: '#barChart',
    //     data:{
    //         columns: [
    //             [<?php echo $barresultmaut ?>],
    //             [<?php echo $barresultparah ?>],
    //             [<?php echo $barresultringan ?>],
    //             [<?php echo $barresultrosak ?>]
    //         ],
    //         colors:{
    //             Maut: '#000000',
    //             Parah: '#e42238',
    //             Ringan: '#1ab394',
    //             Rosak: '#3e80c5'
    //         },
    //         type: 'bar',
    //         groups: [
    //             ['MAUT', 'PARAH', 'RINGAN', 'ROSAK SAHAJA']
    //         ]
    //     },
    //     axis: {
    //         x: {
    //         type: 'category',
    //         categories: [<?php echo $unique_data_year ?>]
    //         }
    //     }
    // });

    // c3.generate({
    //     bindto: '#lineChart',
    //     data:{
    //         columns: [
    //             [<?php echo $barresultmaut ?>],
    //             [<?php echo $barresultparah ?>],
    //             [<?php echo $barresultringan ?>],
    //             [<?php echo $barresultrosak ?>]
    //         ],
    //         colors:{
    //             Maut: '#000000',
    //             Parah: '#e42238',
    //             Ringan: '#1ab394',
    //             Rosak: '#3e80c5'
    //         },
    //         type: 'spline'
    //     },
    //     axis: {
    //         x: {
    //         type: 'category',
    //         categories: [<?php echo $unique_data_year ?>]
    //         }
    //     }
    // });

    // c3.generate({
    //     bindto: '#pieChart',
    //     data:{
    //         columns: [
    //             ['Maut', <?php echo $maut ?>],
    //             ['Parah', <?php echo $parah ?>],
    //             ['Ringan', <?php echo $ringan ?>],
    //             ['Rosak', <?php echo $rosak ?>]
    //         ],
    //         colors:{
    //             Maut: '#000000',
    //             Parah: '#e42238',
    //             Ringan: '#1ab394',
    //             Rosak: '#3e80c5'
    //         },
    //         type : 'pie'
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

    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });
});

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

