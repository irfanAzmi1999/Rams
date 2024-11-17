@extends('layouts/main/main')

@section('content')

<script src="https://maps.google.com/maps/api/js?{{ env('GMAP_VAR') }}={{ env('GMAP_KEY') }}"></script>
<script src="{{ URL::asset('js/gmaps.js') }}"></script>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Peta Lampu Isyarat Di Persimpangan</h2>
        <ol class="breadcrumb">
            <li>
                Peta Lampu Isyarat Di Persimpangan
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Peta Kawasan Lokasi Lampu Isyarat Di Persimpangan <?php if(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){ ?>untuk Negeri {{$negeriname}} <?php } ?>bagi Tahun {{$list_tahun[$filter[2]]}}</h5>
                    <div class="ibox-tools">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-outline btn-success dropdown-toggle">Export<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button id="export-csv-fdata" target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">CSV</a></button>
                                </li>
                                <li>
                                    <button id="export-excel-fdata" target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">Excel</a></button>
                                </li>
                                <li>
                                    <button id="export-json-fdata" target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">JSON</a></button>
                                </li>
                                <li>
                                    <button id="export-pdf-fdata" target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">PDF</a></button>
                                </li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-outline btn-success data-filter2"><i class="fa fa-search"></i> Carian</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section id="replacefilter">
                <div class="map" id="mapAccident" style="height: 500px">{!! $map['html'] !!}</div>
            </section>
        </div>
    </div>
</div>


<div class="modal inmodal" id="modal-filter-fdata">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Senarai Data Kemalangan dalam radius 50m</h4>
            </div>
            <div class="modal-body">
                <div class="message-form"></div>
                <section id="paparkemalangan">
        		</section>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal-filter-bdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Tapisan Data Lampu Isyarat Di Persimpangan</h4>
            </div>
            <form id="form-filter-fdata" method="POST" action="{{URL('/dataBlackspot')}}">
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
                                    {!! html()->select('negeri', $negeri, $filter[0] ?? '')
                                    ->class('form-control m-b chosen-state')
                                    ->placeholder('Pilih Negeri') !!}
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
                                    @else
                                        <select data-placeholder="Pilih Daerah" class="form-control m-b chosen-district" name="daerah[]" multiple>
                                            <option value="" disabled>Pilih Daerah</option>
                                            @foreach($daerah as $k=>$v)
                                                <option value="{{$k}}">{{$v}}</option>
                                            @endforeach
                                        </select>
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
                                <label><strong>Tahun</strong></label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {!! html()->select('tahun', $list_tahun, $filter[2])
                                    ->class('form-control m-b chosen-year')
                                    ->placeholder('Pilih Tahun') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Keluasan</strong></label>
                                <div class="radio">
                                    <input type="radio" name="keluasan" id="keluasan50" value="50" checked/>
                                    <label for="keluasan50">
                                        50 Meter
                                    </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="keluasan" id="keluasan100" value="100"/>
                                    <label for="keluasan100">
                                        100 Meter
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Status Data</strong></label>
                                <div class="radio">
                                    <input type="radio" name="status" id="sah" value="SAH" checked/>
                                    <label for="sah">
                                        Status Sah
                                    </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="status" id="semua" value="SEMUA"/>
                                    <label for="semua">
                                        Semua
                                    </label>
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


<div class="modal inmodal" id="modal-view-fdata">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title">Papar Maklumat Kemalangan</h4>
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
@endsection

@section('js')
<script src="{{ URL::asset('inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.extend.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<!-- <script src="{{ URL::asset('rams/js/report.js') }}"></script> -->
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

    @if($keluasan == 100)
    $('#keluasan100').prop("checked", true);
    @endif
    @if(isset($filter[4]) && $filter[4] == "SEMUA")
    $('#semua').prop("checked", true);
    @endif

    $('.chosen-state, .chosen-year, .chosen-road, .chosen-district').chosen({
        width: "100%"
    });

	function spotcount(sc){
		if(sc){ var val = sc.length; } else { var val = 0; }
		return val;
	}

    var blackspot = <?php print_r(json_encode($blackspot)) ?>;

    console.log(blackspot);

    var mymap = new GMaps({
      el: '#mapAccident',
//      lat: 3.173857,
//      lng: 101.699355,
//      zoom:9,
      lat: {{$zoomnegeri->latitude}},
      lng: {{$zoomnegeri->logitude}},
      zoom:10
    });
    // Avoid too many request to mygos mygeoportal server
    const didle = debounce(function () {
        getOverlayImage(mymap.map.getBounds(),mymap.map);
    }, 600);
    google.maps.event.addListener(mymap.map, "idle", didle);

      $.each( blackspot, function( index, value ){

        icon = {
                url: "{{ URL::asset('rams/images/spot/blackspot.png') }}",
                scaledSize: new google.maps.Size(35, 35),
                // origin: new google.maps.Point(0,0), // origin
                // anchor: new google.maps.Point(0, 0), // anchor
        		};
        alert = 'Ini adalah kawasan maut.';
        mymap.addMarker({
            lat: value['midpoint']['latitude'],
            lng: value['midpoint']['longitude'],
          	icon: icon,
          	infoWindow: {
                content: '<h4>Maklumat Kawasan Kekerapan Kemalangan (Black Spot)</h4><br>' +

                        '<button class="btn btn-default data-filter fa fa-list" onclick="listkemalangan('+ value['id'] +')"></button>'+
                        '<button class="btn btn-default fa fa-globe" onclick="add_loc('+ value['id'] + ',' + value['midpoint']['latitude'] + ',' + value['midpoint']['longitude'] +')"></button>'+
                		    '<button class="btn btn-default fa fa-search-plus" onclick="zoomout('+ value['midpoint']['latitude'] + ',' + value['midpoint']['longitude'] +');"></button></br></br>' +

                        '<button type="button" class="btn btn-danger m-r-sm" style="background-color:black;border:0;">' + value['analisa']['count_maut'] + '</button>Maut<br><br>' +
                        '<button type="button" class="btn btn-danger m-r-sm" style="background-color:#eb2629;border:0;">' + value['analisa']['count_parah'] + '</button>Parah<br><br>' +
                        '<button type="button" class="btn btn-danger m-r-sm" style="background-color:#61b40b;border:0;">' + value['analisa']['count_ringan'] + '</button>Ringan<br><br>' +
                        '<button type="button" class="btn btn-danger m-r-sm" style="background-color:#0053a7;border:0;">' + value['analisa']['count_rosak'] + '</button>Rosak<br><br>' +
                        '<button type="button" class="btn btn-danger m-r-sm" style="background-color:#d1dade;border:0;">' + value['analisa']['count_tidak_diketahui'] + '</button>Tidak Diketahui<br><br>' +
                        '<button type="button" class="btn btn-danger m-r-sm" style="background-color:grey;border:0;">' + value['analisa']['pemberat'] + '</button>Pemberat' ,
              },
        });
            mymap.drawCircle({
                lat: value['midpoint']['latitude'],
                lng: value['midpoint']['longitude'],
                radius: {{ $keluasan }},
                fillColor: 'red',
                fillOpacity: 0.1,
                strokeWeight: 0
            });
   	});

      function add_loc(blackspot_id, blacklat, blacklng){
    	  var latLng = new google.maps.LatLng(blacklat, blacklng);
          mymap.panTo(latLng);
          mymap.setZoom(20);
          var black_id = blackspot_id;

          $.each( blackspot, function( index, value ){

              $.each(value['point'] , function( index, value ){
                var point_black = value['blackspot_id'];
                console.log(black_id);
                console.log(point_black);
                if(black_id == point_black){
                    var tkd = value['detail']['tarikh_kejadian'];
                    // var tkd = d.toDateString();
                    var icon = '';
                    var alert = '';
                    if(value['category'] == 1){
                      icon = "{{ URL::asset('rams/images/icon/Maut.png') }}";
                      alert = 'Ini adalah kawasan maut.';
                    }
                    if(value['category'] == 2){
                      icon = "{{ URL::asset('rams/images/icon/Parah.png') }}";
                      alert = 'Ini adalah kawasan Parah.';
                    }
                    if(value['category'] == 3){
                      icon = "{{ URL::asset('rams/images/icon/Ringan.png') }}";
                      alert = 'Ini adalah kawasan Ringan.';
                    }
                    if(value['category'] == 4){
                      icon = "{{ URL::asset('rams/images/icon/Rosak.png') }}";
                      alert = 'Ini adalah kawasan Rosak.';
                    }
                    if(value['category'] == 99){
                        icon = "{{ URL::asset('rams/images/icon/Tidak_diketahui.png') }}";
                        alert = 'Ini adalah kawasan Tidak Diketahui.';
                    }
                    mymap.addMarker({
                      lat: value['latitude'],
                      lng: value['longitude'],
                      icon: icon,
                      infoWindow: {
                        content: '<div class="scroll_content" style="overflow: scroll; width: auto; height: 310px;">' +
                            '<ul class="folder-list m-b-md" style="padding: 0">' +
                              '<li>' +
                               '<a><i class="fa fa-map-marker"></i> Negeri' +
                                  '<span class="label label-warning pull-right">' +
                                      value['detail']['negeri'] +
                                  '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-map-marker"></i> Daerah' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['daerah'] +
                                  '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-road"></i> No. Laluan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['no_laluan'] +
                                  '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-stethoscope"></i> Jenis Kemalangan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['jenis_kemalangan'] +
                                  '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-calendar"></i> Tarikh Kejadian' +
                                  '<span class="label label-warning pull-right">'+ tkd +'</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-calendar-o"></i> Bulan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['bulan'] +
                                      '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-calendar-o"></i> Tahun' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['tahun'] +'</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-cogs"></i> Jenis Permukaan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['jenis_permukaan'] +
                                                                          '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-road"></i> Keadaan Jalan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['keadaan_jalan'] +
                                                                          '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-road"></i> Kualiti Permukaan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['kualiti_permukaan'] +
                                                                          '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-arrows-alt"></i> Sistem Lalulintas' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['sistem_laluan'] +
                                                                          '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-sun-o"></i> Cuaca' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['cuaca'] +
                                                                          '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-car"></i> Jenis Pelanggaran Pertama' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['jenis_langgar_pertama'] +
                                                                          '</span></a>' +
                              '</li>' +
                             ' <li>' +
                                  '<a><i class="fa fa-road"></i> Bentuk Jalan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['bentuk_jalan'] +
                                                                          '</span></a>' +
                              '</li>' +
                             ' <li>' +
                                  '<a><i class="fa fa-bars"></i> Jenis Garisan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['jenis_garis'] +
                                                                          '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-road"></i> Jenis Permukaan Jalan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['jenis_permukaan'] +
                                                                          '</span></a>' +
                              '</li>' +
                             ' <li>' +
                                  '<a><i class="fa fa-road"></i> Sebab Utama Kecacatan Jalan' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['sebab_cacat_jalan'] +
                                                                          '</span></a>' +
                              '</li>' +
                              '<li>' +
                                  '<a><i class="fa fa-sun-o"></i> Cahaya' +
                                  '<span class="label label-warning pull-right">' +
                                  value['detail']['cahaya'] +
                                                                          '</span></a>' +
                              '</li>' +
                            '</ul>' +
                            '</div>',
                        },
                    });
                }
    	      });
         });
    }

    function dataKemalangan(id){
        $('#modal-filter-fdata').modal('hide');
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
    }


    function zoomout(blacklat, blacklng){
    	var latLng = new google.maps.LatLng(blacklat, blacklng);
    	mymap.panTo(latLng);
        mymap.setZoom(11);
    }

  //Modal Data Filter
    $(document).on('click','.data-filter',function() {
        $('#modal-filter-fdata').modal('show');
    });

    $(document).on('click','.data-filter2',function() {
        $('#modal-filter-bdata').modal('show');
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

	// function listkemalangan(blackspot_id){
	// 	document.getElementById('paparkemalangan').innerHTML="";

    //     var black_id = blackspot_id;

    //       $.each( blackspot, function( index, value ){

    //         var x = 1;
    //         $.each(value['point'] , function( index, value ){
    //         var point_black = value['blackspot_id'];
    //         if(black_id == point_black){
    //     		var append_kemalangan =
    //         			'<div class="row">'+
    //         				'<section style="text-align: center;font-size:14px;font-weight:bold;text-decoration: underline;width:100%">'+ x + '.' + value['detail']['jenis_kemalangan'] +'</section>'+
    //                         '<div class="col-md-6">'+
    //                     		'<div class="form-group">'+
    //                                 '<label><strong>Negeri</strong></label>'+
    //                                 '<div class="input-group m-b">'+
    //                                     '<span class="input-group-addon">'+
    //                                         '<i class="fa fa-thumb-tack"></i>'+
    //                                     '</span>'+
    //                                      '<input id="id" name="id" type="hidden"/>'+
    //                                     '<input type="text" name="v_latitude" class="form-control" placeholder="Latitude" value="'+ value['detail']['negeri'] +'" disabled="true" />'+
    //                                 '</div>'+
    //                             '</div>'+
    //                         '</div>'+
    //                         '<div class="col-md-6">'+
    //                             '<div class="form-group">'+
    //                                 '<label><strong>Jenis Kemalangan</strong></label>'+
    //                                 '<div class="input-group m-b">'+
    //                                     '<span class="input-group-addon">'+
    //                                         '<i class="fa fa-thumb-tack"></i>'+
    //                                     '</span>'+
    //                                     '<input type="text" name="v_longitude" class="form-control" placeholder="Longitude" value="'+value['detail']['jenis_kemalangan'] +'" disabled="true" />'+
    //                                 '</div>'+
    //                             '</div>'+
    //                         '</div>'+
    //                     '</div>'+
    //                     '<div class="row">'+
    //                     '<div class="col-md-6">'+
    //                 		'<div class="form-group">'+
    //                             '<label><strong>Latitude</strong></label>'+
    //                             '<div class="input-group m-b">'+
    //                                 '<span class="input-group-addon">'+
    //                                     '<i class="fa fa-thumb-tack"></i>'+
    //                                 '</span>'+
    //                                  '<input id="id" name="id" type="hidden"/>'+
    //                                 '<input type="text" name="v_latitude" class="form-control" placeholder="Latitude" value="'+ value['detail']['latitude'] +'" disabled="true" />'+
    //                             '</div>'+
    //                         '</div>'+
    //                     '</div>'+
    //                     '<div class="col-md-6">'+
    //                         '<div class="form-group">'+
    //                             '<label><strong>Longitude</strong></label>'+
    //                             '<div class="input-group m-b">'+
    //                                 '<span class="input-group-addon">'+
    //                                     '<i class="fa fa-thumb-tack"></i>'+
    //                                 '</span>'+
    //                                 '<input type="text" name="v_longitude" class="form-control" placeholder="Longitude" value="'+ value['detail']['logitude'] +'" disabled="true" />'+
    //                             '</div>'+
    //                         '</div>'+
    //                     '</div>'+
    //                 '</div>'+
    //             '<hr>';
    //     		$("#paparkemalangan").append(append_kemalangan);
    //     		x++;
    //   	      }

    // 		});
    //     });
	// }

    function listkemalangan(blackspot_id){
        $('#blackspot_id').val(blackspot_id);
		$('#paparkemalangan').empty();

        var black_id = blackspot_id;
        var blackspot = <?php print_r(json_encode($blackspot)) ?>;
        $.each( blackspot, function( index, value ){
            if(black_id == value['id']){
                $("#paparkemalangan").append('<h6 class="modal-title"><b><u>'+value['point']['0']['negeri']+'</u></b></h6><br/>');

                var append_table_body = '<div class = "table table-bordered">'+
                                '<table class = "table">'+
                                    '<thead >'+
                                        '<tr>'+
                                            '<th>Bil</th>'+
                                            '<th>No Laporan</th>'+
                                            '<th>Tahun</th>'+
                                            '<th>Jenis Perlanggaran</th>'+
                                            '<th>Jenis Kemalangan</th>'+
                                            '<th>Coordinate</th>'+
                                            '<th>Daerah</th>'+
                                            '<th>No Laluan</th>'+
                                            '<th>No Seksyen</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';
                var x = 1;
                $.each(value['point'] , function( index, value ){
                    var no_laluan = value['detail']['no_laluan'];
                    var no_seksyen = value['detail']['no_seksyen'];
                    var daerah = value['detail']['daerah'];
                    if(value['detail']['no_seksyen'] == null) no_seksyen = "";
                    if(value['detail']['no_laluan'] == null) no_laluan = "";
                    if(value['detail']['daerah'] == null) daerah = "";
                    console.log(value);
                    append_table_body += '<tr>' +
                                                '<td>'+x+'</td>' +
                                                '<td><a onclick="dataKemalangan('+ value['id'] +')" class="fdata-view" data-id="'+value['id']+'">'+value['detail']['no_laporan']+'</a></td>' +
                                                '<td>'+value['tahun']+'</td>' +
                                                '<td>'+value['detail']['jenis_langgar_pertama_name']+'</td>' +
                                                '<td>'+value['detail']['jenis_kemalangan']+'</td>' +
                                                '<td>('+value['latitude']+', '+value['longitude']+')</td>' +
                                                '<td>'+daerah+'</td>' +
                                                '<td>'+no_laluan+'</td>' +
                                                '<td>'+no_seksyen+'</td>' +
                                            '</tr>';
                    x++;

                });
                append_table_body += '</tbody>'+
                            '</table>'+
                        '</div>';
                $("#paparkemalangan").append(append_table_body);
      	    }
        });
	}

    $('#filter-fdata').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/dataBlackspot') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_self");
        $('#form-filter-fdata').submit();  // submit the form
    });

    $('#export-csv-fdata').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/blackcsvdownload') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_blank");
        $('#form-filter-fdata').submit();  // submit the form
    });
    $('#export-excel-fdata').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/blackexceldownload') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_blank");
        $('#form-filter-fdata').submit();  // submit the form
    });
    $('#export-json-fdata').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/blackjsondownload') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_blank");
        $('#form-filter-fdata').submit();  // submit the form
    });
    $('#export-pdf-fdata').click(function() {
        $('#form-filter-fdata').attr("action", "{{ URL('/blackpdfdownload') }}");  //change the form action
        $('#form-filter-fdata').attr("method", "POST");
        $('#form-filter-fdata').attr("target", "_blank");
        $('#form-filter-fdata').submit();  // submit the form
    });
</script>
@endsection