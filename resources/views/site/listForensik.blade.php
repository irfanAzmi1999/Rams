@extends('layouts/main/main')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Senarai Laporan Forensik</h2>
            <ol class="breadcrumb">
                <li>
                    Senarai Laporan Forensik
                </li>
                <li>
                    Senarai Laporan
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Senarai Laporan</h5>
                        <div class="ibox-tools">
                            <a id="register-role" class="btn btn-outline btn-success laporan-tambah" data-toggle="modal"
                                data-target="#modal-tambah-laporan">Tambah Laporan</a>
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
                            <table class="table table-striped table-bordered table-hover data_laporan">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Rujukan</th>
                                        <th width="5%">Latitude <br>
                                            Longitude</th>
                                        <th>Nama Laluan</th>
                                        <th>Status</th>
                                        <th width="5%">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Rujukan</th>
                                        <th>Latitude <br>
                                            Longitude</th>
                                        <th>Nama Laluan</th>
                                        <th>Status</th>
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

    <div class="modal inmodal" id="modal-tambah-laporan">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Tutup</span></button>
                    <h4 class="modal-title">Tambah Laporan</h4>
                </div>
                <form id="form-tambah-laporan" method="POST" action="{{ route('forensik.daftarLaporan') }}"
                    onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" class="form-control" placeholder=""
                        value="" />
                    <div class="modal-body">
                        <div class="message-form"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Rujukan</strong></label>
                                    <div class="input-group m-b col-md-12">
                                        <input type="text" name="rujukan" class="form-control" placeholder="Rujukan"
                                            required data-required="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Tahun Laporan</strong></label>
                                    <div class="input-group m-b col-md-12">
                                        <input type="text" name="tahun" class="form-control" placeholder="Tahun"
                                            required data-required="true" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Nama Laluan</strong></label>
                                    <div class="input-group m-b col-md-12">
                                        <input type="text" name="namaLaluan" class="form-control" required
                                            placeholder="Nama Laluan" data-required="true" />
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Latitude</strong> <i class="fa fa-asterisk text-danger"></i></label>
                                    <div class="input-group m-b">
                                        <span class="input-group-addon">
                                            <i class="fa fa-thumb-tack"></i>
                                        </span>
                                        <input type="text" name="latitude" id="lat" class="form-control" required
                                            placeholder="Latitude" value="" data-required="true" />
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
                                        <input type="text" name="logitude" id="long" class="form-control" required
                                            placeholder="Longitude" value="" data-required="true" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label id="label-file_laporan" for="file_laporan">Upload Laporan Forensik (PDF ONLY)</label>
                                        <input type="file" id="file_laporan" name="file_laporan" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Status Rawatan</label>
                                        <div class="checkbox">
                                            <input id="is_dirawat" name="is_dirawat" type="checkbox">
                                            <label for="is_dirawat">
                                                 <b>Sudah Dirawat</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="div_tahun_dirawat" style="display: none;">
                                <div class="form-group">
                                    <label><strong>Tahun Dirawat</strong></label>
                                    <div class="input-group m-b col-md-12">
                                        <input type="text" name="tahun_dirawat" class="form-control" placeholder="Tahun Dirawat" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="register-laporan" class="btn btn-primary" type="submit">Daftar</button>
                        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://maps.google.com/maps/api/js?{{ env('GMAP_VAR') }}={{ env('GMAP_KEY') }}"></script>
    <script src="{{ URL::asset('inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).on('click','.laporan-view',function() {
            var id = $(this).data('id');
            window.location.href = ".."+id;
        });
        let map;
        let Overlays = [];
        let iw;

        function debounce(func, wait, immediate) {
            let timeout;
            return function() {
                let context = this,
                    args = arguments;
                let later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                let callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        }

        function getOverlayImage(bounds, map) {
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
            //     bounds, {
            //         map: map,
            //         opacity: 0.9
            //     }
            // );

            // // Push new overlay into overlays array
            // Overlays.push(Overlay);
            // const metersPerPx =
            //     (156543.03392 * Math.cos((sw.lat() * Math.PI) / 180)) /
            //     Math.pow(2, map.getZoom());
            // Overlay.addListener("click", (e) => {
            //     const queryURL = new URL(mygosFeatureServiceURL);
            //     queryURL.search = new URLSearchParams({
            //         where: "1=1",
            //         geometry: '{"x": ' +
            //             e.latLng.lng() +
            //             ', "y":' +
            //             e.latLng.lat() +
            //             ', "spatialReference":{"wkid":4326}}',
            //         geometryType: "esriGeometryPoint",
            //         inSR: sr,
            //         spatialRel: "esriSpatialRelIntersects",
            //         outFields: "*",
            //         distance: 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
            //         units: "esriSRUnit_Meter",
            //         returnGeometry: false,
            //         resultRecordCount: 1,
            //         returnExtentOnly: false,
            //         featureEncoding: "esriDefault",
            //         f: "pjson",
            //     });
            //     fetch(queryURL)
            //         .then((r) => r.json())
            //         .then((r) => {
            //             if (!iw) {
            //                 iw = new google.maps.InfoWindow();
            //             }
            //             iw.setPosition(e.latLng);
            //             if (r.features && r.features.length > 0) {
            //                 iw.setContent(
            //                     Object.entries(r.features[0].attributes)
            //                     .map(
            //                         ([k, v]) =>
            //                         r.fieldAliases[k] + ": " + (v === null ? "" : v)
            //                     )
            //                     .join("<br>")
            //                 );
            //                 iw.open({
            //                     map
            //                 });
            //             } else {
            //                 iw.close();
            //             }
            //         });
            // });
        }

        $.fn.dataTable.Debounce = function(table, options) {
            var tableId = table.settings()[0].sTableId;
            $('.dataTables_filter input[aria-controls="' + tableId + '"]') // select the correct input field
                .unbind() // Unbind previous default bindings
                .bind('input', (delay(function(e) { // Bind our desired behavior
                    table.search($(this).val()).draw();
                    return;
                }, 1000))); // Set delay in milliseconds
        }

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }
        var table = $('.data_laporan').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('forensik.getLaporanForensikData') }}",
            columns: [
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'rujukan',
                    name: 'rujukan'
                },
                {
                    data: 'latlng',
                    name: 'latlng'
                },
                {
                    data: 'namaLaluan',
                    name: 'namaLaluan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            pageLength: 25,
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
        var debounces = new $.fn.dataTable.Debounce(table);

        // $(document).on('change', 'input[name^="latitude"]', function() {
        $('#long, #lat').change(function() {
            function debounce(func, wait, immediate) {
                let timeout;
                return function() {
                    let context = this,
                        args = arguments;
                    let later = function() {
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

                var myLatlng = new google.maps.LatLng($('#lat').val(), $('#long').val());

                var myOptions = {
                    zoom: 17,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                // Avoid too many request to mygos mygeoportal server
                const didle = debounce(function() {
                    getOverlayImage(map.getBounds(), map);
                }, 600);
                google.maps.event.addListener(map, "idle", didle);

                var marker = new google.maps.Marker({
                    draggable: true,
                    position: myLatlng,
                    map: map,
                    title: "Your location"
                });

                google.maps.event.addListener(marker, 'dragend', function(event) {
                    document.getElementById("lat").value = event.latLng.lat();
                    document.getElementById("long").value = event.latLng.lng();
                });
            }
            google.maps.event.addDomListener(window, "load", initialize())
        });

        function initialize() {
            var myLatlng = new google.maps.LatLng(5.4163935, 100.33267860000001);

            var myOptions = {
                draggable: true,
                zoom: 17,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

            // Avoid too many request to mygos mygeoportal server
            const didle = debounce(function() {
                getOverlayImage(map.getBounds(), map);
            }, 600);
            google.maps.event.addListener(map, "idle", didle);

            marker = new google.maps.Marker({
                draggable: true,
                position: myLatlng,
                map: map,
                title: "Your location"
            });

            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById("lat").value = event.latLng.lat();
                document.getElementById("long").value = event.latLng.lng();
            });
        }
        google.maps.event.addDomListener(window, "load", initialize())

        $('#modal-tambah-laporan').on('shown.bs.modal', function(e) {
            var btn = $(e.relatedTarget);
            var id = btn.data('id');
            if (id) {

            } else {
                $('[name="id"]').val('');
                $('[name="rujukan"]').val('');
                $('[name="namaLaluan"]').val('');
                $('[name="latitude"]').val('');
                $('[name="logitude"]').val('');
                $('[name="file_laporan"]').val('').prop('required',true);
                $('#label-file_laporan').html('Upload Laporan Forensik (PDF ONLY)')
                $('#register-laporan').html('Daftar');
                $('[name="tahun"]').val('');
                // $('[name="tahun_laporan"]').val('');
                $('[name="tahun_dirawat"]').val('');
                $('#is_dirawat').prop('checked', false);
                $('#div_tahun_dirawat').hide();
            }
        })

        $(document).on('click', '#delete-data', function(e) {
            if (!confirm('Adakah anda pasti?')){
                e.preventDefault();
                return false;
            }

            var id = $(this).data('id');
            $.ajax({
                url: "./ajaxDeleteLaporan&id=" + id,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data){
                    $(location).attr('href','./laporanForensik');
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
                }
            });
        });

        $(document).on('click', '#edit-data', function() {
            var id = $(this).data('id');
            $('#modal-tambah-laporan').modal('show');

            $.ajax({
                url: "./ajaxGetDataLaporan&id=" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id"]').val(id);
                    $('[name="rujukan"]').val(data.rujukan);
                    $('[name="namaLaluan"]').val(data.namaLaluan);
                    $('[name="latitude"]').val(data.latitude);
                    $('[name="logitude"]').val(data.logitude);
                    $('[name="tahun"]').val(data.tahun);
                    // $('[name="tahun_laporan"]').val(data.tahun_laporan);
                    if(data.is_dirawat == 1){
                        $('#is_dirawat').prop('checked', true);
                        $('#div_tahun_dirawat').show();
                        $('[name="tahun_dirawat"]').val(data.tahun_dirawat);
                    }else{
                        $('#is_dirawat').prop('checked', false);
                        $('#div_tahun_dirawat').hide();
                        $('[name="tahun_dirawat"]').val('');

                    }
                    $('[name="file_laporan"]').val('').prop('required',false);
                    $('#label-file_laporan').html('Change Upload Laporan Forensik (PDF ONLY)');
                    $('#register-laporan').html('Kemaskini');
                    var map;

                    function initialize() {
                        lat_baru = data.latitude ? data.latitude : 5.416308052539724;
                        log_baru = data.logitude ? data.logitude : 100.33268932883607;
                        var myLatlng = new google.maps.LatLng(lat_baru, log_baru);

                        var myOptions = {
                            zoom: 17,
                            center: myLatlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                        // Avoid too many request to mygos mygeoportal server
                        const didle = debounce(function() {
                            getOverlayImage(map.getBounds(), map);
                        }, 600);
                        google.maps.event.addListener(map, "idle", didle);

                        var marker = new google.maps.Marker({
                            draggable: true,
                            position: myLatlng,
                            map: map,
                            title: "Your location"
                        });

                        google.maps.event.addListener(marker, 'dragend', function(event) {
                            document.getElementById("lat").value = event.latLng.lat();
                            document.getElementById("long").value = event.latLng.lng();
                        });
                    }
                    google.maps.event.addDomListener(window, "load", initialize())
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        });

    $("#is_dirawat").change( function(){
        if( $(this).is(':checked') ){
            $('#div_tahun_dirawat').show();
            $('[name="tahun_dirawat"]').attr("required");
        }else{
            $('#div_tahun_dirawat').hide();
            $('[name="tahun_dirawat"]').removeAttr("required");
        }
    });
</script>
@endsection
