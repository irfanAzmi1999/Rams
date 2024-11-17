@extends('layouts/main/main')

@section('content')

<script src="https://maps.google.com/maps/api/js?{{ env('GMAP_VAR') }}={{ env('GMAP_KEY') }}"></script>
<script src="{{ URL::asset('js/gmaps.js') }}"></script>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Peta Laporan Kawasan Lokasi Smart Traffic Light</h2>
        <ol class="breadcrumb">
            <li>
                Peta Laporan Kawasan Lokasi Smart Traffic Light
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Peta Kawasan Lokasi Smart Traffic Light (Prestasi) @if(!empty($filter[0])) bagi Tahun {{ $filter[0] }} @endif</h5>
                    <div class="ibox-tools">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-outline btn-success dropdown-toggle">Pilih Tahun <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                @foreach($tahun as $item)
                                    <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/laporanPetaBlackspot">
                                    @csrf
                                    <li>
                                        <input type="hidden" name="tahun" value="{{ $item }}">
                                        <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">{{ $item }}</a></button>
                                    </li>
                                    </form>
                                @endforeach
                            </ul>
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
                <h4 class="modal-title">Senarai Laporan Kemalangan dalam radius 50m</h4>
            </div>
            <div class="modal-body">
                <div class="message-form"></div>
                <section id="paparkemalangan">
        		</section>
            </div>
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

	function spotcount(sc){
		if(sc){ var val = sc.length; } else { var val = 0; }
		return val;
	}
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
    var laporanspot = <?php print_r(json_encode($laporanspot)) ?>;
    $.each( laporanspot, function( index, value ){

        icon = {
                url: "{{ URL::asset('rams/images/spot/blackspot.png') }}",
                scaledSize: new google.maps.Size(35, 35),
                // origin: new google.maps.Point(0,0), // origin
                // anchor: new google.maps.Point(0, 0), // anchor
        		};
        if(value.latitude){
            mymap.addMarker({
                lat: value.latitude,
                lng: value.logitude,
                icon: icon,
                draggable: false,
                infoWindow: {
                    content: '<div style="overflow: scroll; width: auto; height: 200px;">' +
                                '<ul class="folder-list m-b-md" style="padding: 0">' +
                                    '<li>' +
                                        '<a><i class="fa fa-group"></i> ID' +
                                        '<span class="label label-warning pull-right">' +
                                            value.id +
                                        '</span></a>' +
                                    '</li>' +
                                    '<li>' +
                                        '<a><i class="fa fa-list"></i> No. Rujukan' +
                                        '<span class="label label-warning pull-right">' +
                                            value.rujukan +
                                        '</span></a>' +
                                    '</li>' +
                                    '<li>' +
                                        '<a><i class="fa fa-map-marker"></i> Nama Laluan' +
                                        '<span class="label label-warning pull-right">' +
                                            value.namaLaluan +
                                        '</span></a>' +
                                    '</li>' +
                                    '<li>' +
                                        '<a><i class="fa fa-building"></i> Latitude' +
                                        '<span class="label label-warning pull-right">' +
                                            value.latitude +
                                        '</span></a>' +
                                    '</li>' +
                                    '<li>' +
                                        '<a><i class="fa fa-calendar"></i> Longitude' +
                                        '<span class="label label-warning pull-right">' +
                                            value.logitude +
                                        '</span></a>' +
                                    '</li>' +
                                '</ul>' +
                                '<a class="btn btn-outline btn-sm btn-success laporan-view" data-toggle="tooltip" data-placement="top" data-id="' + value.url +'" title="View"><i class="fa fa-external-link-square"></i></a>' +
                            '</div>',
                    overflow: 'scroll',
                },
            });
        }
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('click','.laporan-view',function() {
        var id = $(this).data('id');
        // window.location.href = "."+id;
        window.open(
            "."+id,
            '_blank' // <- This is what makes it open in a new window.
        );
    });
</script>
@endsection