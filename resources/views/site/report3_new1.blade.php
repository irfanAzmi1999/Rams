@extends('layouts/main/main')

@section('content')
<script src="http://maps.google.com/maps/api/js?{{ env('GMAP_VAR') }}={{ env('GMAP_KEY') }}"></script>
<script src="{{ URL::asset('js/gmaps.js') }}"></script>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Peta Black Spot</h2>
        <ol class="breadcrumb">
            <li>
                Peta Black Spot
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Peta Kawasan Kerap Kemalangan (Black Spot)</h5>
                    <div class="ibox-tools">
              <div class="btn-group">
              <button data-toggle="dropdown" class="btn btn-outline btn-success dropdown-toggle">Export<span class="caret"></span></button>
              <ul class="dropdown-menu">

                  <!-- 2018 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackcsvdownload">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="{{$tahun}}">
                          <button target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">CSV</a></button>
                  </li>
                  </form>

                  <!-- 2017 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackexceldownload">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="{{$tahun}}">
                          <button target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">Excel</a></button>
                  </li>
                  </form>

                  <!-- 2016 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackjsondownload">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="{{$tahun}}">
                          <button target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">JSON</a></button>
                  </li>
                  </form>

          <!-- 2015 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackpdfdownload">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="{{$tahun}}">
                          <button target="_blank" class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">PDF</a></button>
                  </li>
                  </form>
              </ul>
          </div>
          <!-- PILIHAN TAHUN -->
          <div class="btn-group">
              <button data-toggle="dropdown" class="btn btn-outline btn-success dropdown-toggle">Pilih Tahun <span class="caret"></span></button>
              <ul class="dropdown-menu">

                  <!-- 2018 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2018">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2018</a></button>
                  </li>
                  </form>

                  <!-- 2017 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2017">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2017</a></button>
                  </li>
                  </form>

                  <!-- 2016 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2016">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2016</a></button>
                  </li>
                  </form>

          <!-- 2015 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2015">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2015</a></button>
                  </li>
                  </form>

          <!-- 2014 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2014">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2014</a></button>
                  </li>
                  </form>

          <!-- 2013 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2013">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2013</a></button>
                  </li>
                  </form>

          <!-- 2012 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2012">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2012</a></button>
                  </li>
                  </form>

          <!-- 2011 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2011">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2011</a></button>
                  </li>
                  </form>

          <!-- 2010 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2010">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2010</a></button>
                  </li>
                  </form>

          <!-- 2009 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2009">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2009</a></button>
                  </li>
                  </form>

          <!-- 2008 -->
                  <form id="form-filter-fdata" method="POST" action="{{Request::root()}}/blackspotnew">
                  @csrf
                  <li>
                          <input type="hidden" name="tahun" value="2008">
                          <button class="fa btn-default btn-sm" style="width: 100% !important; border: 0px !important; text-align: left !important; padding: 12px;">&nbsp;&nbsp;<a style="font-family: open sans !important; color:#676a6c;">2008</a></button>
                  </li>
                  </form>
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

@endsection

@section('js')
<script src="{{ URL::asset('inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.extend.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ URL::asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<!-- <script src="{{ URL::asset('rams/js/report.js') }}"></script> -->

<script type="text/javascript">

	function spotcount(sc){
		if(sc){ var val = sc.length; } else { var val = 0; }
		return val;
	}



    var blackspot = <?php print_r(json_encode($blackspot)) ?>;
    var blackspotWithSpot = <?php print_r(json_encode($test)) ?>;
    var mymap = new GMaps({
      el: '#mapAccident',
      lat:<?= is_null($id)?3.173857:$value['latitude'] ?>,
      lng:<?= is_null($id)?101.699355:$value['longitude'] ?>,
      zoom:12
    });
      $.each( blackspot, function( index, value ){
        icon = {
                url: "{{ URL::asset('rams/images/spot/blackspot.png') }}",
                scaledSize: new google.maps.Size(35, 35),
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(17.5, 35), // anchor
        		};
        alert = 'Ini adalah kawasan maut.';
        mymap.addMarker({
            lat: value['midpoint']['latitude'],
            lng: value['midpoint']['longitude'],
          	icon: icon,
          	infoWindow: {
                content: '<h4>Maklumat Kawasan Kekerapan Kemalangan (Black Spot)</h4><br>' +

                         '<button class="btn btn-default data-filter fa fa-list" onclick="listkemalangan('+ value['bid'] +')"></button>'+
                         '<button class="btn btn-default fa fa-globe" onclick="add_loc('+ value['bid'] + ',' + value['midpoint']['latitude'] + ',' + value['midpoint']['longitude'] +')"></button>'
                		//     '<button class="btn btn-default fa fa-search-plus" onclick="zoomout('+ value['midpoint']['latitude'] + ',' + value['midpoint']['longitude'] +');"></button></br></br>' +
                        //
                        // '<button type="button" class="btn btn-danger m-r-sm" style="background-color:black;border:0;">' + value['analisa']['count_maut'] + '</button>Maut<br><br>' +
                        // '<button type="button" class="btn btn-danger m-r-sm" style="background-color:#eb2629;border:0;">' + value['analisa']['count_parah'] + '</button>Parah<br><br>' +
                        // '<button type="button" class="btn btn-danger m-r-sm" style="background-color:#61b40b;border:0;">' + value['analisa']['count_ringan'] + '</button>Ringan<br><br>' +
                        // '<button type="button" class="btn btn-danger m-r-sm" style="background-color:#0053a7;border:0;">' + value['analisa']['count_rosak'] + '</button>Rosak<br><br>' +
                        // '<button type="button" class="btn btn-danger m-r-sm" style="background-color:grey;border:0;">' + value['analisa']['pemberat'] + '</button>Pemberat'
                ,
              },
        });
            mymap.drawCircle({
                lat: value['midpoint']['latitude'],
                lng: value['midpoint']['longitude'],
                radius: 50,
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


          $.each( blackspotWithSpot, function( index, value ){
              if(value['id']== black_id){
              $.each(value['spot1'] , function( index, value ){

                  var lat1=value['latitude'];
                  var long=value['longitude'];
                  console.log('lat'+lat1);
                  console.log('long'+long);
                  icon = "{{ URL::asset('rams/images/icon/Maut.png') }}";

                  mymap.addMarker({
                      lat: lat1,
                      lng: long,
                      icon: icon,
                      infoWindow: {
                          content: '<h4>Test'+index+'</h4><br>' ,
                      },
                  });
              });
              };
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

	function listkemalangan(blackspot_id){
		document.getElementById('paparkemalangan').innerHTML="";

        var black_id = blackspot_id;
        $.each( blackspot, function( index, value ){
            if(black_id == value['bid']){
                $("#paparkemalangan").append('<h6 class="modal-title"><b><u>'+value['point']['0']['negeri']+'</u></b></h6><br/>');

                var append_table_body = '<div class = "table table-bordered">'+
                                '<table class = "table">'+
                                    '<thead >'+
                                        '<tr>'+
                                            '<th>Bil</th>'+
                                            '<th>No Laporan</th>'+
                                            '<th>Tahun</th>'+
                                            '<th>Jenis Kemalangan</th>'+
                                            '<th>Coordinate</th>'+
                                            '<th>No Laluan</th>'+
                                            '<th>No Seksyen</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';
                var x = 1;
                $.each(value['point'] , function( index, value ){
                    var no_laluan = value['detail']['no_laluan'];
                    var no_seksyen = value['detail']['no_seksyen'];
                    if(value['detail']['no_seksyen'] == null) no_seksyen = "";
                    if(value['detail']['no_laluan'] == null) no_laluan = "";
                    append_table_body += '<tr>' +
                                                '<td>'+x+'</td>' +
                                                '<td>'+value['detail']['no_laporan']+'</td>' +
                                                '<td>'+value['tahun']+'</td>' +
                                                '<td>'+value['detail']['jenis_kemalangan']+'</td>' +
                                                '<td>('+value['latitude']+', '+value['longitude']+')</td>' +
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
</script>
@endsection