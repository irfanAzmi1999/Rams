<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Negeri;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use FarhanWazir\GoogleMaps\GMaps;

class LaporanController extends Controller
{
    protected $gmap;

    public function __construct(GMaps $gmap)
    {
        $this->middleware('auth');
        $this->gmap = $gmap;
    }

    public function laporanList(Request $request){
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => null,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];

        return view('site.listLaporan', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function laporanListLampujalan(Request $request){
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => null,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];

        return view('site.listLaporanLampujalan', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

    public function laporanListJejantas(Request $request){
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => null,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];

        return view('site.listLaporanJejantas', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function laporanListLpksi(Request $request){
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => null,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];

        return view('site.listLaporanLpksi', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function laporanListLip(Request $request){
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => null,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];

        return view('site.listLaporanLip', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function laporanListStl(Request $request){
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => null,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];

        return view('site.listLaporanStl', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function getLaporanData(Request $request)
    {
        // dd($request->input('tahun'));
        $input = [];
        if(!empty($request->input('tahun'))){
            $input['tahun'] = $request->input('tahun');
        }
        if(!empty($input['tahun'])){
            $rs = Laporan::where('tahun', $input['tahun'])->get();
        }else{
            $rs = Laporan::all();
        }
        return DataTables::of($rs)
            ->addColumn('status', function($rs) {
                if ($rs->is_dirawat == 1){
                    return '<span class="label label-primary text-12">SUDAH DIRAWAT</span>';
                }else{
                    return '<span class="label label-danger text-12">BELUM DIRAWAT</span>';
                }
            })
            ->addColumn('action', function ($rs) {
                $action = '<a class="btn btn-outline btn-sm btn-success laporan-view"  data-id="'.$rs->url.'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-external-link-square"></i></a>';
                // $action .= '<a class="btn btn-outline btn-sm btn-primary fdata-view" data-toggle="tooltip" data-placement="top" data-id="' . $rs->id . '" title="Papar Data"><i class="fa fa-search"></i></a>';
                $action .= ' <a class="btn btn-outline btn-sm btn-warning" id="edit-data" data-toggle="tooltip" data-placement="top" data-id="' . $rs->id . '" title="Kemaskini Data"><i class="fa fa-edit"></i></a>';
                $action .= '<a class="btn btn-outline btn-sm btn-danger" id="delete-data" data-toggle="tooltip" data-placement="top" data-id="' . $rs->id . '" title="Hapus Data"><i class="fa fa-trash"></i></a>';
                return $action;
            })->escapeColumns([])
            ->toJson();
    }

    public function daftarLaporan(Request $request)
    {
        $input = $request->all();

        $laporan = $input['id'] ? Laporan::find($input['id']) : new Laporan();
        $laporan->rujukan = $input['rujukan'];
        $laporan->namaLaluan = $input['namaLaluan'];
        $laporan->latitude = $input['latitude'];
        $laporan->logitude = $input['logitude'];
        $laporan->tahun = $input['tahun'];
        $laporan->updated_by = Auth::user()->id;
        $laporan->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        if($request->has('is_dirawat')){
            $laporan->tahun_dirawat = $input['tahun_dirawat'];
            $laporan->is_dirawat = 1;
        }else{
            $laporan->tahun_dirawat = null;
            $laporan->is_dirawat = 0;
        }
        if($laporan->exists == false){
            $laporan->created_by = Auth::user()->id;
            $laporan->created_at = \Carbon\Carbon::now()->toDateTimeString();
            $laporan->disable = 'ACTIVE';
        }

        if ($request->hasFile('file_laporan')) {
            if(!empty($laporan->getOriginal('rujukan'))){
                unlink(public_path() . $laporan->url);
            }
            $file = $request->file_laporan;
            $filename = $input['rujukan'] . '.' . $request->file_laporan->extension();
            $path = $file->storeAs('Uploads', $filename, ['disk' => 'uploads']);
            $laporan->url = '/'.$path;
        }elseif($laporan->rujukan != $laporan->getOriginal('rujukan') && !empty($laporan->getOriginal('rujukan'))){
            rename ($laporan->url, public_path() . '/' . 'Uploads/' . $laporan->rujukan . '.pdf');
            $laporan->url = '/' . 'Uploads/' . $laporan->rujukan . '.pdf';
        }

        $laporan->save();
        return redirect('laporanBlackspot');
    }

    public function ajaxGetDataLaporan(Request $request)
    {
        return Laporan::find($request->id);
    }

	public function ajaxDeleteLaporan($id){
        $laporan = Laporan::findOrFail($id);
		$laporan->disable = 'INACTIVE';
        $laporan->updated_by = Auth::user()->id;
		$laporan->save();
        return $laporan;
    }

    public function dataBlackspot(Request $request)
    {
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => $getyear,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];
        return view('site.petalaporanblackspot', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function dataLampujalan(Request $request)
    {
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => $getyear,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];
        return view('site.petalaporanlampujalan', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function dataJejantas(Request $request)
    {
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => $getyear,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];
        return view('site.petalaporanjejantas', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function dataLpksi(Request $request)
    {
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => $getyear,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];
        return view('site.petalaporanlpksi', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function dataLip(Request $request)
    {
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => $getyear,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];
        return view('site.petalaporanlip', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }

	public function dataStl(Request $request)
    {
        $leftTopControls = ['document.getElementById("leftTopControl")']; // values must be html or javascript element
        $this->gmap->injectControlsInLeftTop = $leftTopControls; // inject into map
        $leftCenterControls = ['document.getElementById("leftCenterControl")'];
        $this->gmap->injectControlsInLeftCenter = $leftCenterControls;
        $leftBottomControls = ['document.getElementById("leftBottomControl")'];
        $this->gmap->injectControlsInLeftBottom = $leftBottomControls;

        $bottomLeftControls = ['document.getElementById("bottomLeftControl")'];
        $this->gmap->injectControlsInBottomLeft = $bottomLeftControls;
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;
        $bottomRightControls = ['document.getElementById("bottomRightControl")'];
        $this->gmap->injectControlsInBottomRight = $bottomRightControls;

        $rightTopControls = ['document.getElementById("rightTopControl")'];
        $this->gmap->injectControlsInRightTop = $rightTopControls;
        $rightCenterControls = ['document.getElementById("rightCenterControl")'];
        $this->gmap->injectControlsInRightCenter = $rightCenterControls;
        $rightBottomControls = ['document.getElementById("rightBottomControl")'];
        $this->gmap->injectControlsInRightBottom = $rightBottomControls;

        $topLeftControls = ['document.getElementById("topLeftControl")'];
        $this->gmap->injectControlsInTopLeft = $topLeftControls;
        $topCenterControls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $topCenterControls;
        $topRightControls = ['document.getElementById("topRightControl")'];
        $this->gmap->injectControlsInTopRight = $topRightControls;
        /*** End Controls ***/

        $config = array();
        $config['map_height'] = "100%";
        $config['center'] = 'Clifton, Karachi';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';
        $this->gmap->add_marker($marker);

        $map = $this->gmap->create_map();

        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else{
            $getyear = $date = date('Y');
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'tahun' => $getyear,
            ];
        }
        $zoomnegeri = Negeri::where('id', 14)->first();


        $laporanspot = Laporan::where(function ($query){
            if (!empty($input['tahun'])) {
                $query->where('tahun', $input['tahun']);
            }
        })->get();
        $tahun = Laporan::groupBy('tahun')->whereNotNull('tahun')->pluck('tahun', 'tahun');
        $filter = array();
        $filter[] = $input["tahun"];
        return view('site.petalaporanstl', compact('map', 'laporanspot'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'tahun' => $tahun
        ]);
    }
}
