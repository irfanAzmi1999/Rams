<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accident;
use App\Models\Kenderaan;
use App\Models\BentukJalan;
use App\Models\Cahaya;
use App\Models\Cuaca;
use App\Models\Daerah;
use App\Models\Export;
use App\Models\JenisGaris;
use App\Models\JenisJalan;
use App\Models\JenisKemalangan;
use App\Models\JenisKenderaan;
use App\Models\JenisLanggarPertama;
use App\Models\JenisPermukaan;
use App\Models\KategoriKesilapan;
use App\Models\KeadaanJalan;
use App\Models\KualitiPermukaan;
use App\Mail\NotiLaporanAwalan;
use App\Models\MukaJalan;
use App\Models\Negeri;
use App\Models\PuncaKemalangan;
use App\Models\SebabCacatJalan;
use App\Models\SistemLaluan;
use App\Models\User;
use App\Models\Upload;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use App\Models\Jalan;

class AccidentController extends Controller
{
    protected $gmap;

    public function __construct(GMaps $gmap)
    {
        $this->middleware('auth');
        $this->gmap = $gmap;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if (empty($input)) {
            $prev_date = now()->subMonth()->format('d-m-Y');
            $input = [
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? 14 : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => [],
                'jeniskemalangan' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => now()->format('d-m-Y'),
            ];
        }
        $tindakan_maut = DB::table('accidents')
            ->where('status', 'Report24')
            ->where(function ($q) {
                if (Auth::user()->jkrnegeri()) {
                $q->where('negeri_id', Auth::user()->negeri_id);
                } else if (Auth::user()->jkrdaerah()) {
                    $q->where('negeri_id', Auth::user()->negeri_id);
                    $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                }
            })->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))])
            ->count();
        if ($input['negeri'] != '') {
            $zoomnegeri = Negeri::where('id', $input['negeri'])->first();
        } else {
            if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $zoomnegeri = Negeri::where('id', Auth::user()->negeri_id)->first();
            } else {
                $zoomnegeri = Negeri::where('id', 14)->first();
            }
        }

        $negeri = Negeri::pluck('name', 'id');
        if ($input['negeri']) {
            $daerah = Daerah::where('negeri_id', $input['negeri'])->pluck('name', 'id');
        } else {
            $daerah = Daerah::pluck('name', 'id');
        }
        $jeniskemalangan = JenisKemalangan::pluck('name', 'id');

        $nolaluan = Accident::select('no_laluan')->where(function ($qr) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri()  && !Auth::user()->jkrdaerah()) {
                $qr->where('negeri_id', $input['negeri']);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $qr->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }
        })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        $acc = Accident::where(function ($q) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['negeri']);
            }elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){
                $q->where('negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                $q->whereIn('daerah_id', $input['daerah']);
            }
            if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                $q->whereIn('no_laluan', $input['nolaluan']);
            }
            if ($input['jeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['jeniskemalangan']);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }
        })->get();
        $bil_baru = count($acc->filter(function ($data){
            return $data->status_la == 'BARU';
        }));
        $bil_draf = count($acc->filter(function ($data){
            return $data->status_la == 'DRAF';
        }));
        $bil_sah = count($acc->filter(function ($data){
            return $data->status_la == 'DISAHKAN';
        }));

        //Google Maps FarhanWazir
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
        /******** End Controls ********/

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
        iw_' . $this->gmap->map_name . '.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_' . $this->gmap->map_name . '.setContent(result);
                iw_' . $this->gmap->map_name . '.open(' . $this->gmap->map_name . ', mark);
            }
        }, this);';

        $this->gmap->add_marker($marker);
        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']
        //Google Maps FarhanWazir

        $rs = DB::table('accidents')
            ->select('accidents.tahun', 'jenis_kemalangans.name', 'accidents.jenis_kemalangan_id', DB::raw('COUNT(accidents.jenis_kemalangan_id) AS count'))
            ->join('jenis_kemalangans', 'accidents.jenis_kemalangan_id', '=', 'jenis_kemalangans.id')
            ->where('accidents.disable', '=', 'ACTIVE')
            ->where('jenis_kemalangans.disable', '=', 'ACTIVE')
            ->where(function ($q) use ($input) {
                if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['negeri']);
                } else {
                    $q->where('negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                    $q->whereIn('daerah_id', $input['daerah']);
                }
                if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                    $q->whereIn('no_laluan', $input['nolaluan']);
                }
                if ($input['jeniskemalangan']) {
                    $q->where('jenis_kemalangan_id', $input['jeniskemalangan']);
                }
                if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                    $q->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
            })
            ->groupby('accidents.tahun')
            ->groupby('jenis_kemalangans.name')
            ->groupby('accidents.jenis_kemalangan_id')
            ->orderBy('accidents.tahun', 'ASC')
            ->orderBy('accidents.jenis_kemalangan_id', 'ASC')
            ->get();

        //start chart stuff
        $i = 0;
        $maut = 0;
        $parah = 0;
        $ringan = 0;
        $rosak = 0;

        //pie
        for ($x = 0; $x < sizeof($rs); $x++) {
            $value = $rs[$x]->{'count'};
            $i = $i + $value;
            $jenis = $rs[$x]->name;

            if ($jenis == 'MAUT') {
                $maut = $rs[$x]->{'count'};
            }
            if ($jenis == 'PARAH') {
                $parah = $rs[$x]->{'count'};
            }
            if ($jenis == 'RINGAN') {
                $ringan = $rs[$x]->{'count'};
            }
            if ($jenis == 'ROSAK SAHAJA') {
                $rosak = $rs[$x]->{'count'};
            }
        }
        $total = $i;

        //barchart
        $rq = DB::table('jenis_kemalangans')->get();

        $bar = [];

        foreach ($rq as $r) {
            $bar[$r->id][] = $r->name;
        }

        $barresultmaut = 0;
        $barresultparah = 0;
        $barresultringan = 0;
        $barresultrosak = 0;

        foreach ($rs as $s) {
            $bar[$s->jenis_kemalangan_id][] = $s->count;
            $barresultmaut = "'" . implode("', '", $bar[1]) . "'";
            $barresultparah = "'" . implode("', '", $bar[2]) . "'";
            $barresultringan = "'" . implode("', '", $bar[3]) . "'";
            $barresultrosak = "'" . implode("', '", $bar[4]) . "'";
        }

        if ($input['s_accident_startdate']) {
            $startdate = date("Y-m-d", strtotime($input['s_accident_startdate']));
        } else {
            $startdate = date("Y-m-d");
        }

        if ($input['s_accident_enddate']) {
            $enddate = date("Y-m-d", strtotime($input['s_accident_enddate']));
        } else {
            $enddate = date("Y-m-d");
        }

        $bardate = date('Y', strtotime($startdate));
        $bardate2 = date('Y', strtotime($enddate));
        $baryeardate = range($bardate, $bardate2);
        $baryear = "'" . implode("', '", $baryeardate) . "'";
        //end chart stuff

        $filter = array();

        $filter[] = $input["negeri"];
        $filter[] = !empty($input["daerah"]) && $input['daerah'][0] != '' ? $input["daerah"] : [];
        $filter[] = $input["jeniskemalangan"];
        $filter[] = !empty($input["nolaluan"]) ? $input["nolaluan"] : [];

        $daerahlist = [];
        $jeniskemalanganlist = '';
        if (!empty($input['daerah']) && $input['daerah'][0] != '') {
            $daerahlist = Daerah::whereIn('id', $input["daerah"])->get();
        }
        if ($input["jeniskemalangan"]) {
            $jeniskemalanganlist = JenisKemalangan::where('id', $input["jeniskemalangan"])->first();
        }

        return view(
            'site.dashboard3',
            compact('negeri', 'daerah', 'jeniskemalangan', 'map', 'acc', 'bil_baru', 'bil_draf', 'bil_sah'),
            [
                'filter' => $filter,
                'daerahlist' => $daerahlist,
                'jeniskemalanganlist' => $jeniskemalanganlist,
                'tindakan_maut' => $tindakan_maut,
                'total' => $total,
                'maut' => $maut,
                'ringan' => $ringan,
                'parah' => $parah,
                'rosak' => $rosak,
                'barresultmaut' => $barresultmaut,
                'barresultparah' => $barresultparah,
                'barresultringan' => $barresultringan,
                'barresultrosak' => $barresultrosak,
                'unique_data_year' => $baryear,
                'nolaluan' => $nolaluan,
                'filternolaluan' => !empty($input['nolaluan']) ? $input['nolaluan'] : [],
            's_accident_startdate' => date("Y-m-d", strtotime($input['s_accident_startdate'])),
            's_accident_enddate' => date("Y-m-d", strtotime($input['s_accident_enddate'])),
                'zoomnegeri' => $zoomnegeri,
            ]
        );
    }

    public function dataMap(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $currentdate = date('Y-m-d');
            $date = strtotime($currentdate . '-1 month');
            $prev_date = date('d-m-Y', $date);
            // dd(Auth::user()->daerah()->pluck('daerah_id')->toArray());
            $input = [
                'no_laporan' => '',
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null /*14*/ : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray(), //[Auth::user()->daerah_id],
                'nolaluan' => [],
                'jeniskemalangan' => '',
                'jenispermukaan' => '',
                'keadaanjalan' => '',
                'kualitipermukaan' => '',
                'sistemlaluan' => '',
                'cuaca' => '',
                'jenislanggarpertama' => '',
                'bentukjalan' => '',
                'jenisgaris' => '',
                'mukajalan' => '',
                'sebabcacatjalan' => '',
                'cahaya' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => date('d-m-Y')
            ];
        }
        if(!isset($input['no_laporan'])){
            $input['no_laporan'] = '';
        }
        if(!isset($input['negeri'])){
            $input['negeri'] = (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null /*14*/ : Auth::user()->negeri_id;
        }
        if(!isset($input['daerah'])){
            $input['daerah'] = (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray();
        }
        if(!isset($input['nolaluan'])){
            $input['nolaluan'] = [];
        }
        if(!isset($input['jeniskemalangan'])){
            $input['jeniskemalangan'] = '';
        }
        if(!isset($input['jenispermukaan'])){
            $input['jenispermukaan'] = '';
        }
        if(!isset($input['keadaanjalan'])){
            $input['keadaanjalan'] = '';
        }
        if(!isset($input['kualitipermukaan'])){
            $input['kualitipermukaan'] = '';
        }
        if(!isset($input['sistemlaluan'])){
            $input['sistemlaluan'] = '';
        }
        if(!isset($input['cuaca'])){
            $input['cuaca'] = '';
        }
        if(!isset($input['jenislanggarpertama'])){
            $input['jenislanggarpertama'] = '';
        }
        if(!isset($input['bentukjalan'])){
            $input['bentukjalan'] = '';
        }
        if(!isset($input['jenisgaris'])){
            $input['jenisgaris'] = '';
        }
        if(!isset($input['mukajalan'])){
            $input['mukajalan'] = '';
        }
        if(!isset($input['sebabcacatjalan'])){
            $input['sebabcacatjalan'] = '';
        }
        if(!isset($input['cahaya'])){
            $input['cahaya'] = '';
        }
        if(!isset($input['s_accident_startdate'])){
            $input['s_accident_startdate'] = $prev_date;
        }
        if(!isset($input['s_accident_enddate'])){
            $input['s_accident_enddate'] = date('d-m-Y');
        }
        if(!isset($input['status_la'])){
            $input['status_la'] = '';
        }

        if ($input['negeri'] != '') {
            $zoomnegeri = Negeri::where('id', $input['negeri'])->first();
        } else {
            $zoomnegeri = Negeri::where('id', 14)->first();
        }

        $negeri = Negeri::pluck('name', 'id');
        if ($input['negeri']) {
            $daerah = Daerah::where('negeri_id', $input['negeri'])->pluck('name', 'id');
        } else {
            $daerah = Daerah::pluck('name', 'id');
        }
        $jeniskemalangan = JenisKemalangan::pluck('name', 'id');
        $jenispermukaan = JenisPermukaan::pluck('name', 'id');
        $keadaanjalan = KeadaanJalan::pluck('name', 'id');
        $kualitipermukaan = KualitiPermukaan::pluck('name', 'id');
        $sistemlaluan = SistemLaluan::pluck('name', 'id');
        $cuaca = Cuaca::pluck('name', 'id');
        $jenislanggarpertama = JenisLanggarPertama::pluck('name', 'id');
        $bentukjalan = BentukJalan::pluck('name', 'id');
        $jenisgaris = JenisGaris::pluck('name', 'id');
        $mukajalan = MukaJalan::pluck('name', 'id');
        $sebabcacatjalan = SebabCacatJalan::pluck('name', 'id');
        $cahaya = Cahaya::pluck('name', 'id');
        $jenis_jalan = JenisJalan::pluck('name', 'id');

	$nojalan= Jalan::orderBy('nolaluan')->where(function ($qr) use ($input) {
        if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
            $qr->where('negeri_id', $input['negeri']);
        }elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){
            $qr->where('negeri_id', Auth::user()->negeri_id);
        }
    })->get()->pluck('namalaluan','id');
    // dd($nojalan);

        $nolaluan = Accident::select('no_laluan')->where(function ($qr) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $qr->where('negeri_id', $input['negeri']);
            }elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){
                $qr->where('negeri_id', Auth::user()->negeri_id);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $qr->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }
        })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        //Google Maps FarhanWazir
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
        /******** End Controls ********/

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
        iw_' . $this->gmap->map_name . '.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_' . $this->gmap->map_name . '.setContent(result);
                iw_' . $this->gmap->map_name . '.open(' . $this->gmap->map_name . ', mark);
            }
        }, this);';

        $this->gmap->add_marker($marker);
        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']
        //Google Maps FarhanWazir

        $rs = DB::table('accidents')
            ->select('accidents.tahun', 'jenis_kemalangans.name', 'accidents.jenis_kemalangan_id', DB::raw('COUNT(accidents.jenis_kemalangan_id) AS count'))
            ->join('jenis_kemalangans', 'accidents.jenis_kemalangan_id', '=', 'jenis_kemalangans.id')
            ->where('accidents.disable', '=', 'ACTIVE')
            ->where('jenis_kemalangans.disable', '=', 'ACTIVE')
            ->where(function ($q) use ($input) {
                if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                    $q->where('negeri_id', $input['negeri']);
                } else {
                    $q->where('negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    // $q->where('daerah_id', Auth::user()->daerah_id);
                    $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                    $q->whereIn('daerah_id', $input['daerah']);
                }
                if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                    $q->whereIn('no_laluan', $input['nolaluan']);
                }
                if ($input['jeniskemalangan']) {
                    $q->where('jenis_kemalangan_id', $input['jeniskemalangan']);
                }
                if ($input['jenispermukaan']) {
                    $q->where('jenis_permukaan_id', $input['jenispermukaan']);
                }
                if ($input['keadaanjalan']) {
                    $q->where('keadaan_jalan_id', $input['keadaanjalan']);
                }
                if ($input['kualitipermukaan']) {
                    $q->where('kualiti_permukaan_id', $input['kualitipermukaan']);
                }
                if ($input['sistemlaluan']) {
                    $q->where('sistem_laluan_id', $input['sistemlaluan']);
                }
                if ($input['cuaca']) {
                    $q->where('cuaca_id', $input['cuaca']);
                }
                if ($input['jenislanggarpertama']) {
                    $q->where('jenis_langgar_pertama_id', $input['jenislanggarpertama']);
                }
                if ($input['bentukjalan']) {
                    $q->where('bentuk_jalan_id', $input['bentukjalan']);
                }
                if ($input['jenisgaris']) {
                    $q->where('jenis_garis_id', $input['jenisgaris']);
                }
                if ($input['mukajalan']) {
                    $q->where('muka_jalan_id', $input['mukajalan']);
                }
                if ($input['sebabcacatjalan']) {
                    $q->where('sebab_cacat_jalan_id', $input['sebabcacatjalan']);
                }
                if ($input['cahaya']) {
                    $q->where('cahaya_id', $input['cahaya']);
                }
                if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                    $q->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
                if (!empty($input['no_laporan'])) {
                    $q->where('no_laporan', $input['no_laporan']);
                }
                if (!empty($input['status_la'])) {
                    $q->where('status_la', $input['status_la']);
                }
            })
            ->groupby('accidents.tahun')
            ->groupby('jenis_kemalangans.name')
            ->groupby('accidents.jenis_kemalangan_id')
            ->orderBy('accidents.tahun', 'ASC')
            ->orderBy('accidents.jenis_kemalangan_id', 'ASC')
            ->get();

        //start chart stuff
        $i = 0;
        $maut = 0;
        $parah = 0;
        $ringan = 0;
        $rosak = 0;

        //pie
        for ($x = 0; $x < sizeof($rs); $x++) {
            $value = $rs[$x]->{'count'};
            $i = $i + $value;
            $jenis = $rs[$x]->name;

            if ($jenis == 'MAUT') {
                $maut = $rs[$x]->{'count'};
            }
            if ($jenis == 'PARAH') {
                $parah = $rs[$x]->{'count'};
            }
            if ($jenis == 'RINGAN') {
                $ringan = $rs[$x]->{'count'};
            }
            if ($jenis == 'ROSAK SAHAJA') {
                $rosak = $rs[$x]->{'count'};
            }
        }
        $total = $i;

        //barchart
        $rq = DB::table('jenis_kemalangans')->get();

        $bar = [];

        foreach ($rq as $r) {
            $bar[$r->id][] = $r->name;
        }

        $barresultmaut = 0;
        $barresultparah = 0;
        $barresultringan = 0;
        $barresultrosak = 0;

        foreach ($rs as $s) {
            $bar[$s->jenis_kemalangan_id][] = $s->count;
            $barresultmaut = "'" . implode("', '", $bar[1]) . "'";
            $barresultparah = "'" . implode("', '", $bar[2]) . "'";
            $barresultringan = "'" . implode("', '", $bar[3]) . "'";
            $barresultrosak = "'" . implode("', '", $bar[4]) . "'";
        }

        if ($input['s_accident_startdate']) {
            $startdate = date("Y-m-d", strtotime($input['s_accident_startdate']));
        } else {
            $startdate = date("Y-m-d");
        }

        if ($input['s_accident_enddate']) {
            $enddate = date("Y-m-d", strtotime($input['s_accident_enddate']));
        } else {
            $enddate = date("Y-m-d");
        }

        $bardate = date('Y', strtotime($startdate));
        $bardate2 = date('Y', strtotime($enddate));
        $baryeardate = range($bardate, $bardate2);
        $baryear = "'" . implode("', '", $baryeardate) . "'";
        //end chart stuff

        $filter = array();

        $filter[] = $input["negeri"];
        $filter[] = !empty($input["daerah"]) && $input['daerah'][0] != '' ? $input["daerah"] : [];
        $filter[] = $input["jeniskemalangan"];
        $filter[] = $input["jenispermukaan"];
        $filter[] = $input["keadaanjalan"];
        $filter[] = $input["kualitipermukaan"];
        $filter[] = $input["sistemlaluan"];
        $filter[] = $input["cuaca"];
        $filter[] = $input["jenislanggarpertama"];
        $filter[] = $input["bentukjalan"];
        $filter[] = $input["jenisgaris"];
        $filter[] = $input["mukajalan"];
        $filter[] = $input["sebabcacatjalan"];
        $filter[] = $input["cahaya"];
        $filter[] = $input["s_accident_startdate"];
        $filter[] = $input["s_accident_enddate"];
        $filter[] = !empty($input["nolaluan"]) ? $input["nolaluan"] : [];
        $filter[] = $input["no_laporan"];
        $filter[] = $input["status_la"];

        $daerahlist = [];
        $jeniskemalanganlist = '';
        $jenispermukaanlist = '';
        $keadaanjalanlist = '';
        $kualitipermukaanlist = '';
        $sistemlaluanlist = '';
        $cuacalist = '';
        $jenislanggarpertamalist = '';
        $bentukjalanlist = '';
        $jenisgarislist = '';
        $mukajalanlist = '';
        $sebabcacatjalanlist = '';
        $cahayalist = '';

        if (!empty($input['daerah']) && $input['daerah'][0] != '') {
            $daerahlist = Daerah::whereIn('id', $input["daerah"])->get();
        }
        if ($input["jeniskemalangan"]) {
            $jeniskemalanganlist = JenisKemalangan::where('id', $input["jeniskemalangan"])->first();
        }
        if ($input["jenispermukaan"]) {
            $jenispermukaanlist = JenisPermukaan::where('id', $input["jenispermukaan"])->first();
        }
        if ($input["keadaanjalan"]) {
            $keadaanjalanlist = KeadaanJalan::where('id', $input["keadaanjalan"])->first();
        }
        if ($input["kualitipermukaan"]) {
            $kualitipermukaanlist = KualitiPermukaan::where('id', $input["kualitipermukaan"])->first();
        }
        if ($input["sistemlaluan"]) {
            $sistemlaluanlist = SistemLaluan::where('id', $input["sistemlaluan"])->first();
        }
        if ($input["cuaca"]) {
            $cuacalist = Cuaca::where('id', $input["cuaca"])->first();
        }
        if ($input["jenislanggarpertama"]) {
            $jenislanggarpertamalist = JenisLanggarPertama::where('id', $input["jenislanggarpertama"])->first();
        }
        if ($input["bentukjalan"]) {
            $bentukjalanlist = BentukJalan::where('id', $input["bentukjalan"])->first();
        }
        if ($input["jenisgaris"]) {
            $jenisgarislist = JenisGaris::where('id', $input["jenisgaris"])->first();
        }
        if ($input["mukajalan"]) {
            $mukajalanlist = MukaJalan::where('id', $input["mukajalan"])->first();
        }
        if ($input["sebabcacatjalan"]) {
            $sebabcacatjalanlist = SebabCacatJalan::where('id', $input["sebabcacatjalan"])->first();
        }
        if ($input["cahaya"]) {
            $cahayalist = Cahaya::where('id', $input["cahaya"])->first();
        }

        $status_la = [
            'BARU' => 'BARU',
            'DRAF' => 'DRAF',
            'DISAHKAN' => 'DISAHKAN',
        ];

        return view(
            'site.dataMap',
        compact('nojalan','negeri', 'daerah', 'jeniskemalangan', 'jenispermukaan', 'keadaanjalan', 'kualitipermukaan', 'sistemlaluan', 'cuaca', 'jenislanggarpertama', 'bentukjalan', 'jenisgaris', 'mukajalan', 'sebabcacatjalan', 'cahaya', 'map', 'status_la', 'jenis_jalan'/*, 'acc'*/),
            [
                'filter' => $filter,
                'daerahlist' => $daerahlist,
                'jeniskemalanganlist' => $jeniskemalanganlist,
                'jenispermukaanlist' => $jenispermukaanlist,
                'keadaanjalanlist' => $keadaanjalanlist,
                'kualitipermukaanlist' => $kualitipermukaanlist,
                'sistemlaluanlist' => $sistemlaluanlist,
                'cuacalist' => $cuacalist,
                'jenislanggarpertamalist' => $jenislanggarpertamalist,
                'bentukjalanlist' => $bentukjalanlist,
                'jenisgarislist' => $jenisgarislist,
                'mukajalanlist' => $mukajalanlist,
                'sebabcacatjalanlist' => $sebabcacatjalanlist,
                'cahayalist' => $cahayalist,
                'total' => $total,
                'maut' => $maut,
                'ringan' => $ringan,
                'parah' => $parah,
                'rosak' => $rosak,
                'barresultmaut' => $barresultmaut,
                'barresultparah' => $barresultparah,
                'barresultringan' => $barresultringan,
                'barresultrosak' => $barresultrosak,
                'unique_data_year' => $baryear,
                'exnegeri' => $input['negeri'],
                'exjeniskemalangan' => $input['jeniskemalangan'],
                'exdaerah' => !empty($input["daerah"]) ? $input['daerah'] : [],
                'exnolaluan' => !empty($input["nolaluan"]) ? $input["nolaluan"] : [],
                'exjenispermukaan' => $input['jenispermukaan'],
                'exkeadaanjalan' => $input['keadaanjalan'],
                'exkualitipermukaan' => $input['kualitipermukaan'],
                'exsistemlaluan' => $input['sistemlaluan'],
                'excuaca' => $input['cuaca'],
                'exjenislanggarpertama' => $input['jenislanggarpertama'],
                'exbentukjalan' => $input['bentukjalan'],
                'exjenisgaris' => $input['jenisgaris'],
                'exmukajalan' => $input['mukajalan'],
                'exsebabcacatjalan' => $input['sebabcacatjalan'],
                'excahaya' => $input['cahaya'],
                'exs_accident_startdate' => date("Y-m-d", strtotime($input['s_accident_startdate'])),
                'exs_accident_enddate' => date("Y-m-d", strtotime($input['s_accident_enddate'])),
                'nolaluan' => $nolaluan,
                's_accident_startdate' => date("Y-m-d", strtotime($input['s_accident_startdate'])),
                's_accident_enddate' => date("Y-m-d", strtotime($input['s_accident_enddate'])),
                'exno_laporan' => $input['no_laporan'],
                'zoomnegeri' => $zoomnegeri,
                'exstatus_la' => $input['status_la']
            ]
        );
    }

    public function getDataMap(
        Request $request,
        DataTables $dataTables
    ) {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $currentdate = date('Y-m-d');
            $date = strtotime($currentdate . '-1 month');
            $prev_date = date('d-m-Y', $date);

            $input = [
                'no_laporan' => '',
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null /*14*/ : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray(), //[Auth::user()->daerah_id],
                'nolaluan' => [],
                'jeniskemalangan' => '',
                'jenispermukaan' => '',
                'keadaanjalan' => '',
                'kualitipermukaan' => '',
                'sistemlaluan' => '',
                'cuaca' => '',
                'jenislanggarpertama' => '',
                'bentukjalan' => '',
                'jenisgaris' => '',
                'mukajalan' => '',
                'sebabcacatjalan' => '',
                'cahaya' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => date('d-m-Y')
            ];
        }
        if(!isset($input['no_laporan'])){
            $input['no_laporan'] = '';
        }
        if(!isset($input['negeri'])){
            $input['negeri'] = (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null /*14*/ : Auth::user()->negeri_id;
        }
        if(!isset($input['daerah'])){
            $input['daerah'] = (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray();
        }
        if(!isset($input['nolaluan'])){
            $input['nolaluan'] = [];
        }
        if(!isset($input['jeniskemalangan'])){
            $input['jeniskemalangan'] = '';
        }
        if(!isset($input['jenispermukaan'])){
            $input['jenispermukaan'] = '';
        }
        if(!isset($input['keadaanjalan'])){
            $input['keadaanjalan'] = '';
        }
        if(!isset($input['kualitipermukaan'])){
            $input['kualitipermukaan'] = '';
        }
        if(!isset($input['sistemlaluan'])){
            $input['sistemlaluan'] = '';
        }
        if(!isset($input['cuaca'])){
            $input['cuaca'] = '';
        }
        if(!isset($input['jenislanggarpertama'])){
            $input['jenislanggarpertama'] = '';
        }
        if(!isset($input['bentukjalan'])){
            $input['bentukjalan'] = '';
        }
        if(!isset($input['jenisgaris'])){
            $input['jenisgaris'] = '';
        }
        if(!isset($input['mukajalan'])){
            $input['mukajalan'] = '';
        }
        if(!isset($input['sebabcacatjalan'])){
            $input['sebabcacatjalan'] = '';
        }
        if(!isset($input['cahaya'])){
            $input['cahaya'] = '';
        }
        if(!isset($input['s_accident_startdate'])){
            $input['s_accident_startdate'] = $prev_date;
        }
        if(!isset($input['s_accident_enddate'])){
            $input['s_accident_enddate'] = date('d-m-Y');
        }
        if(!isset($input['status_la'])){
            $input['status_la'] = '';
        }

        $acc = Accident::query()
            ->select('accidents.*')
            ->leftJoin('negeris', 'accidents.negeri_id', 'negeris.id')
            ->leftJoin('daerahs', 'accidents.daerah_id', 'daerahs.id')
            ->leftJoin('jalans', 'accidents.jalan_id', 'jalans.id')
            ->leftJoin('jenis_kemalangans', 'accidents.jenis_kemalangan_id', 'jenis_kemalangans.id')
            ->where(function ($q) use ($input) {
                if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                    $q->where('accidents.negeri_id', $input['negeri']);
                }
                else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                    $q->where('accidents.negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    $q->whereIn('accidents.daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                    $q->whereIn('accidents.daerah_id', $input['daerah']);
                }
                if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                    $q->whereIn('accidents.no_laluan', $input['nolaluan']);
                }

                if ($input['jeniskemalangan']) {
                    $q->where('accidents.jenis_kemalangan_id', $input['jeniskemalangan']);
                }
                if ($input['jenispermukaan']) {
                    $q->where('accidents.jenis_permukaan_id', $input['jenispermukaan']);
                }
                if ($input['keadaanjalan']) {
                    $q->where('accidents.keadaan_jalan_id', $input['keadaanjalan']);
                }
                if ($input['kualitipermukaan']) {
                    $q->where('accidents.kualiti_permukaan_id', $input['kualitipermukaan']);
                }
                if ($input['sistemlaluan']) {
                    $q->where('accidents.sistem_laluan_id', $input['sistemlaluan']);
                }
                if ($input['cuaca']) {
                    $q->where('accidents.cuaca_id', $input['cuaca']);
                }
                if ($input['jenislanggarpertama']) {
                    $q->where('accidents.jenis_langgar_pertama_id', $input['jenislanggarpertama']);
                }
                if ($input['bentukjalan']) {
                    $q->where('accidents.bentuk_jalan_id', $input['bentukjalan']);
                }
                if ($input['jenisgaris']) {
                    $q->where('accidents.jenis_garis_id', $input['jenisgaris']);
                }
                if ($input['mukajalan']) {
                    $q->where('accidents.muka_jalan_id', $input['mukajalan']);
                }
                if ($input['sebabcacatjalan']) {
                    $q->where('accidents.sebab_cacat_jalan_id', $input['sebabcacatjalan']);
                }
                if ($input['cahaya']) {
                    $q->where('accidents.cahaya_id', $input['cahaya']);
                }
                if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                    $q->whereBetween('accidents.tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
                if (!empty($input['no_laporan'])) {
                    $q->where('accidents.no_laporan', $input['no_laporan']);
                }
                if (!empty($input['status_la'])) {
                    $q->where('status_la', $input['status_la']);
                }
            });
            // dd($acc);
        return $dataTables->eloquent($acc)
            ->addIndexColumn()
            ->editColumn('id', function ($acc) {
                return $acc->id;
            })
            ->editColumn('koordinat', function ($acc) {
                return $acc->latitude . ",<br/>" . $acc->logitude;
            })
            ->editColumn('tarikh', function ($acc) {
                return date('d-m-Y', strtotime($acc->tarikh_kejadian)) . '<br/><i class="fa fa-clock-o"></i>' . date('H:i:s', strtotime($acc->tarikh_kejadian));
            })
            ->editColumn('negeri', function ($acc) {
                return empty($acc->negeri_id) ? '-' : $acc->negeri->name;
            })
            ->editColumn('daerah', function ($acc) {
                return empty($acc->daerah->name) ? '-' : $acc->daerah->name;
            })
            ->editColumn('jenis_kemalangan', function ($acc) {
                if ($acc->jenis_kemalangan_id == 1)
                    return '<span class="label label-black text-12">MAUT</span>';
                else if ($acc->jenis_kemalangan_id == 2)
                    return '<span class="label label-danger text-12">PARAH</span>';
                else if ($acc->jenis_kemalangan_id == 3)
                    return '<span class="label label-primary text-12">RINGAN</span>';
                else if ($acc->jenis_kemalangan_id == 4)
                    return '<span class="label label-success text-12">ROSAK</span>';
                return '';
            })
            ->editColumn('jalan', function ($acc) {
                return empty($acc->jalan_id) ? '-' : $acc->jalan->namalaluan;
            })
            ->editColumn('status_la', function ($laporan) {
                if ($laporan->status_la == 'BARU')
                    return '<span class="label label-black text-12">BARU</span>';
                else if ($laporan->status_la == 'DRAF')
                    return '<span class="label label-danger text-12">DRAF</span>';
                else if ($laporan->status_la == 'PENGESAHAN')
                    return '<span class="label label-primary text-12">PENGESAHAN</span>';
                else if ($laporan->status_la == 'DISAHKAN')
                    return '<span class="label label-success text-12">DISAHKAN</span>';
                return '';
            })
            ->addColumn('action', function ($acc) {
                $action = '<a class="btn btn-outline btn-sm btn-success kenderaan-data" data-toggle="tooltip" data-placement="top" data-id="' . $acc->id . '" title="Maklumat Kenderaan"><i class="fa fa-car"></i></a>';
                $action .= '<a class="btn btn-outline btn-sm btn-primary fdata-view" data-toggle="tooltip" data-placement="top" data-id="' . $acc->id . '" title="Papar Data"><i class="fa fa-search"></i></a>';

                if (!Auth::user()->pengguna() && !Auth::user()->adminjkr()) {
                    $action .= '<a class="btn btn-outline btn-sm btn-warning fdata-edit" data-toggle="tooltip" data-placement="top" data-id="' . $acc->id . '" title="Kemaskini Data"><i class="fa fa-edit"></i></a>';
                    if (Auth::user()->admin())
                        $action .= '<a class="btn btn-outline btn-sm btn-danger fdata-delete" data-toggle="tooltip" data-placement="top" data-id="' . $acc->id . '" title="Hapus Data"><i class="fa fa-trash"></i></a>';
                }

                return $action;
            })->escapeColumns([])
            ->toJson();
    }

    public function dataKenderaan(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
            if(isset($input['jeniskenderaan']))
                $input['jeniskenderaan'] = array_map(function($value) { return $value.'  '; }, $input['jeniskenderaan']);
        } else {
            $currentdate = date('Y-m-d');
            $date = strtotime($currentdate . '-1 month');
            $prev_date = date('d-m-Y', $date);

            $input = [
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? 14 : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => [],
                'jeniskemalangan' => '',
                'jeniskenderaan' => '',
                'jenama' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => date('d-m-Y')
            ];
        }
        // dd($input['jeniskenderaan']);die();

        if (!empty($input['negeri'])) {
            $zoomnegeri = Negeri::where('id', $input['negeri'])->first();
        } else {
            $zoomnegeri = Negeri::where('id', 14)->first();
        }

        $negeri = Negeri::pluck('name', 'id');
        if (!empty($input['negeri'])) {
            $daerah = Daerah::where('negeri_id', $input['negeri'])->pluck('name', 'id');
        } else {
            $daerah = Daerah::pluck('name', 'id');
        }
        $jeniskemalangan = JenisKemalangan::pluck('name', 'id');
        $jeniskenderaan = JenisKenderaan::pluck('name', 'kod');

        $nolaluan = Accident::select('no_laluan')->where(function ($qr) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $qr->where('negeri_id', $input['negeri']);
            }elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){
                $qr->where('negeri_id', Auth::user()->negeri_id);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $qr->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }
        })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        // DB::enableQueryLog();
        $rs = DB::table('kenderaans')
            ->select(
                'kenderaans.id',
                'kenderaans.accident_id',
                'kenderaans.jenis_kenderaan as jenis_kenderaan_id',
                'jenis_kenderaans.name as jenis_kenderaan',
                'kenderaans.accident_id',
                'kenderaans.jenama',
                'negeris.name as negeri',
                'accidents.negeri_id as negeri_id',
                'daerahs.name as daerah',
                'accidents.daerah_id as daerah_id',
                'accidents.no_laluan',
                'accidents.jenis_kemalangan_id',
                DB::raw('extract (year from accidents.tarikh_kejadian) as tahun'),
                'accidents.no_laporan',
                'accidents.tarikh_kejadian',
                'accidents.latitude',
                'accidents.logitude'
            )
            ->leftJoin('accidents', 'accidents.id', '=', 'kenderaans.accident_id')
            ->leftJoin('negeris', 'accidents.negeri_id', '=', 'negeris.id')
            ->leftJoin('daerahs', 'accidents.daerah_id', '=', 'daerahs.id')
            ->leftJoin('jenis_kenderaans', 'kenderaans.jenis_kenderaan', '=', 'jenis_kenderaans.kod')
            ->where('accidents.disable', '=', 'ACTIVE')
            ->where(function ($q) use ($input) {
                if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                    $q->where('accidents.negeri_id', $input['negeri']);
                } else if (Auth::user()->jkrdaerah() || Auth::user()->jkrnegeri()) {
                    $q->where('accidents.negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    $q->whereIn('accidents.daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                    $q->whereIn('accidents.daerah_id', $input['daerah']);
                }
                if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                    $q->whereIn('accidents.no_laluan', $input['nolaluan']);
                }
                if ($input['jeniskemalangan']) {
                    $q->where('accidents.jenis_kemalangan_id', $input['jeniskemalangan']);
                }
                if (!empty($input["jeniskenderaan"]) && $input['jeniskenderaan'][0] != '') {
                    $q->whereIn('kenderaans.jenis_kenderaan', $input["jeniskenderaan"]);
                }
                if ($input['jenama']) {
                    $q->where('kenderaans.jenama', $input['jenama']);
                }
                if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                    $q->whereBetween('accidents.tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
            })
            ->orderBy('accidents.tahun', 'ASC')
            ->orderBy('accidents.jenis_kemalangan_id', 'ASC')
            ->get();
        // dd(DB::getQueryLog());
        if (!empty($input['s_accident_startdate'])) {
            $startdate = date("Y-m-d", strtotime($input['s_accident_startdate']));
        } else {
            $startdate = date("Y-m-d");
        }

        if (!empty($input['s_accident_enddate'])) {
            $enddate = date("Y-m-d", strtotime($input['s_accident_enddate']));
        } else {
            $enddate = date("Y-m-d");
        }

        $bardate = date('Y', strtotime($startdate));
        $bardate2 = date('Y', strtotime($enddate));
        $baryeardate = range($bardate, $bardate2);
        $baryear = "'" . implode("', '", $baryeardate) . "'";
        //end chart stuff

        $filter = array();

        $filter[] = $input["negeri"];                                                               //0
        $filter[] = !empty($input["daerah"]) && $input['daerah'][0] != '' ? $input["daerah"] : [];  //1
        $filter[] = $input["jeniskemalangan"];                                                      //2
        $filter[] = !empty($input["jeniskenderaan"]) ? $input["jeniskenderaan"] : [];               //3
        $filter[] = $input["jenama"];                                                               //4
        $filter[] = $input["s_accident_startdate"];                                                 //5
        $filter[] = $input["s_accident_enddate"];                                                   //6
        $filter[] = !empty($input["nolaluan"]) ? $input["nolaluan"] : [];                           //7
        // dd($jeniskenderaan);
        // dd($filter[3]);die();
        $daerahlist = [];

        if (!empty($input['daerah']) && $input['daerah'][0] != '') {
            $daerahlist = Daerah::whereIn('id', $input["daerah"])->get();
        }

        return view(
            'site.dataKenderaan',
            compact('negeri', 'daerah', 'jeniskemalangan', 'jeniskenderaan', 'jeniskemalangan'),
            [
                'filter' => $filter,
                'exnegeri' => $input['negeri'],
                'exjeniskemalangan' => $input['jeniskemalangan'],
                'exdaerah' => !empty($input["daerah"]) ? $input['daerah'] : [],
                'exnolaluan' => !empty($input["nolaluan"]) ? $input["nolaluan"] : [],
                'exjeniskenderaan' => !empty($input['jeniskenderaan']) ? $input['jeniskenderaan'] : [],
                'exjenama' => $input['jenama'],
                'exs_accident_startdate' => date("Y-m-d", strtotime($input['s_accident_startdate'])),
                'exs_accident_enddate' => date("Y-m-d", strtotime($input['s_accident_enddate'])),
                'nolaluan' => $nolaluan,
                's_accident_startdate' => date("Y-m-d", strtotime($input['s_accident_startdate'])),
                's_accident_enddate' => date("Y-m-d", strtotime($input['s_accident_enddate'])),
                'zoomnegeri' => $zoomnegeri,
                'rs' => $rs
            ]
        );
    }

    public function getDataKenderaan(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
            if(isset($input['jeniskenderaan']))
                $input['jeniskenderaan'] = array_map(function($value) { return $value.'  '; }, $input['jeniskenderaan']);
        } else {
            $currentdate = date('Y-m-d');
            $date = strtotime($currentdate . '-1 month');
            $prev_date = date('d-m-Y', $date);
            if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $negeri = Auth::user()->negeri_id;
            } else {
                $negeri = 14;
            }

            $input = [
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null /*14*/ : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => [],
                'jeniskemalangan' => '',
                'jeniskenderaan' => '',
                'jenama' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => date('d-m-Y')
            ];
        }
        // dd($input);

        $rs = Kenderaan::query()
            ->select(
                'kenderaans.id',
                'kenderaans.accident_id',
                'kenderaans.jenis_kenderaan as jenis_kenderaan_id',
                'jenis_kenderaans.name as jenis_kenderaan',
                'kenderaans.accident_id',
                'kenderaans.jenama',
                'negeris.name as negeri',
                'accidents.negeri_id as negeri_id',
                'daerahs.name as daerah',
                'accidents.daerah_id as daerah_id',
                'accidents.no_laluan',
                'accidents.jenis_kemalangan_id',
                DB::raw('extract (year from accidents.tarikh_kejadian) as tahun'),
                'accidents.no_laporan',
                'accidents.tarikh_kejadian',
                'accidents.latitude',
                'accidents.logitude'
            )
            ->leftJoin('accidents', 'accidents.id', '=', 'kenderaans.accident_id')
            ->leftJoin('negeris', 'accidents.negeri_id', '=', 'negeris.id')
            ->leftJoin('daerahs', 'accidents.daerah_id', '=', 'daerahs.id')
            ->leftJoin('jenis_kenderaans', 'kenderaans.jenis_kenderaan', '=', 'jenis_kenderaans.kod')
            ->where('accidents.disable', '=', 'ACTIVE')
            ->where(function ($q) use ($input) {
                if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                    $q->where('accidents.negeri_id', $input['negeri']);
                } else if (Auth::user()->jkrdaerah() || Auth::user()->jkrnegeri()) {
                    $q->where('accidents.negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    $q->whereIn('accidents.daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                    $q->whereIn('accidents.daerah_id', $input['daerah']);
                }
                if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                    $q->whereIn('accidents.no_laluan', $input['nolaluan']);
                }
                if ($input['jeniskemalangan']) {
                    $q->where('accidents.jenis_kemalangan_id', $input['jeniskemalangan']);
                }
                if (!empty($input["jeniskenderaan"]) && $input['jeniskenderaan'][0] != '') {
                    $q->whereIn('kenderaans.jenis_kenderaan', $input["jeniskenderaan"]);
                }
                if ($input['jenama']) {
                    $q->where('kenderaans.jenama', $input['jenama']);
                }
                if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                    $q->whereBetween('accidents.tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
            })
            ->orderBy('accidents.tahun', 'ASC')
            ->orderBy('accidents.jenis_kemalangan_id', 'ASC');


        return DataTables::of($rs)
            ->addIndexColumn()
            ->addColumn('jenis_kenderaan', function ($rs) {
                return $rs->jenis_kenderaan;
            })
            ->addColumn('tarikh_kejadian', function ($rs) {
                return date('d-m-Y', strtotime($rs->tarikh_kejadian)) . '<br/>' .
                    '<i class="fa fa-clock-o"></i>' .
                    date('H:i:s', strtotime($rs->tarikh_kejadian));
            })
            ->addColumn('no_laporan', function ($rs) {
                return $rs->no_laporan;
            })
            ->addColumn('negeri', function ($rs) {
                return empty($rs->negeri) ? '-' : $rs->negeri;
            })
            ->addColumn('daerah', function ($rs) {
                return empty($rs->daerah) ? '-' : $rs->daerah;
            })
            ->addColumn('no_laluan', function ($rs) {
                return $rs->no_laluan;
            })
            ->addColumn('koordinat', function ($rs) {
                return $rs->latitude . ", " . $rs->logitude;
            })
            ->addColumn('jenis_kemalangan', function ($rs) {
                if ($rs->jenis_kemalangan_id == 1)
                    return '<span class="label label-black text-12">MAUT</span>';
                else if ($rs->jenis_kemalangan_id == 2)
                    return '<span class="label label-danger text-12">PARAH</span>';
                else if ($rs->jenis_kemalangan_id == 3)
                    return '<span class="label label-primary text-12">RINGAN</span>';
                else if ($rs->jenis_kemalangan_id == 4)
                    return '<span class="label label-success text-12">ROSAK</span>';
                return '';
            })
            ->addColumn('action', function ($rs) {
                $action = '<a class="btn btn-outline btn-sm btn-success kenderaan-data" data-toggle="tooltip" data-placement="top" data-id="' . $rs->id . '" title="Papar Data"><i class="fa fa-search"></i></a>
                    <a class="btn btn-outline btn-sm btn-primary fdata-view" data-toggle="tooltip" data-placement="top" data-id="' . $rs->accident_id . '" title="Maklumat Laporan"><i class="fa fa-file"></i></a>';
                return $action;
            })->escapeColumns([])
            ->toJson();
    }

    // EXCEL FILE DOWNLOAD
    public function exportexcelkenderaan(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $currentdate = date('Y-m-d');
            $date = strtotime($currentdate . '-1 month');
            $prev_date = date('d-m-Y', $date);
            if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $negeri = Auth::user()->negeri_id;
            } else {
                $negeri = 14;
            }

            $input = [
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null /*14*/ : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => [],
                'jeniskemalangan' => '',
                'jeniskenderaan' => [],
                'jenama' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => date('d-m-Y')
            ];
        }
        // dd($input["jeniskenderaan"]);
        $acc = Accident::whereHas('kenderaans', function ($q) use ($input) {
            if (!empty($input["jeniskenderaan"]) && $input['jeniskenderaan'][0] != '') {
                $q->whereHas('jenis', function ($q) use ($input) {
                    $q->whereIn('name', $input["jeniskenderaan"]);
                });
            }
            if ($input['jenama']) {
                $q->where('jenama', $input['jenama']);
            }
        })->where(function ($q) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['negeri']);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                $q->whereIn('daerah_id', $input['daerah']);
            }
            if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                $q->whereIn('no_laluan', $input['nolaluan']);
            }
            if ($input['jeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['jeniskemalangan']);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }
        })->get();

        $choosen_kenderaan = empty($input["jeniskenderaan"]) ? [] : $input["jeniskenderaan"];
        $choosen_kenderaan = implode("', '", $choosen_kenderaan);


        $jenis_kenderaan = JenisKenderaan::selectRaw('SUBSTRING(kod, 1, 1) as code')
            ->where(function ($q) use ($input) {
                if (!empty($input["jeniskenderaan"])) {
                    $q->whereIN('name', $input["jeniskenderaan"]);
                }
            })->groupBy('code')
            ->pluck('code');

        $name_jenis_kenderaan = [
            'B' => 'Motosikal',
            'C' => 'Basikal', 'D' =>
            'Motokar', 'E' => 'Lori',
            'F' => 'Traktor',
            'G' => 'Gerai Penjaja',
            'K' => 'Pejalan Kaki',
            'L' => 'Perihalan Benda',
            'S' => 'Bas',
            'T' => 'Teksi',
            'V' => 'Van',
            'W' => '4WD'
        ];

        // echo '<pre>' . print_r($jenis_kenderaan, 1) . '</pre>';
        // die();
        return view(
            'site/excelkenderaan',
            [
                'datacontent' => $acc,
                'jeniskenderaans' => empty($input["jeniskenderaan"]) ? [] : $input["jeniskenderaan"],
                'namejeniskenderaan' => $name_jenis_kenderaan,
                'kodjeniskenderaan' => $jenis_kenderaan
            ]
        );
    }

    public function exportexcelkenderaan2(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $currentdate = date('Y-m-d');
            $date = strtotime($currentdate . '-1 month');
            $prev_date = date('d-m-Y', $date);
            if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $negeri = Auth::user()->negeri_id;
            } else {
                $negeri = 14;
            }

            $input = [
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null /*14*/ : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? [] : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => [],
                'jeniskemalangan' => '',
                'jeniskenderaan' => [],
                'jenama' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => date('d-m-Y')
            ];
        }
        $acc = Accident::with(['negeri', 'daerah', 'kenderaans.jenis', 'puncaKemalangan'])

        ->where(function ($q) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['negeri']);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            }
            else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                $q->whereIn('daerah_id', $input['daerah']);
            }
            if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                $q->whereIn('no_laluan', $input['nolaluan']);
            }
            if ($input['jeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['jeniskemalangan']);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }

            if (!empty($input['negeri'])) {
                $q->whereHas('kenderaans.jenis', function ($subq) use ($input) {
                    $subq->where('negeri_id', $input['negeri']);
                });
            }

        })->get();

        $jenis_kenderaan_codes = JenisKenderaan::pluck('name', 'kod');

        $name_jenis_kenderaan = [];

        foreach ($jenis_kenderaan_codes as $code => $name) {
            $name_jenis_kenderaan[$code] = $name;
        }
        return view(
            'site/excelkenderaan2',
            [
                'datacontent' => $acc,
                // 'kodjeniskenderaan' => $jenis_kenderaan_codes,
                'jenis_kenderaan_codes' => $jenis_kenderaan_codes,
                'name_jenis_kenderaan' => $name_jenis_kenderaan,
            ]
        );
    }

    public function ajaxViewDataKenderaan($id)
    {
        // $rs = Accident::find($id);
        $rs = DB::table('kenderaans')
            ->select(
                'kenderaans.id',
                'kenderaans.accident_id',
                'kenderaans.jenis_kenderaan as jenis_kenderaan_id',
                'jenis_kenderaans.name as jenis_kenderaan',
                'kenderaans.accident_id',
                'kenderaans.jenama',
                'negeris.name as negeri',
                'accidents.negeri_id as negeri_id',
                'daerahs.name as daerah',
                'accidents.daerah_id as daerah_id',
                'accidents.no_laluan',
                'accidents.jenis_kemalangan_id',
                'jenis_kemalangans.name as jenis_kemalangan',
                'kenderaans.model_kenderaan',
                'kenderaans.tahun_dibuat',
                DB::raw('extract (year from accidents.tarikh_kejadian) as tahun'),
                'accidents.no_laporan',
                'accidents.tarikh_kejadian as tarikh_kejadian',
                'accidents.pos_kilometer'
            )
            ->leftJoin('accidents', 'accidents.id', '=', 'kenderaans.accident_id')
            ->leftJoin('negeris', 'accidents.negeri_id', '=', 'negeris.id')
            ->leftJoin('daerahs', 'accidents.daerah_id', '=', 'daerahs.id')
            ->leftJoin('jenis_kenderaans', 'kenderaans.jenis_kenderaan', '=', 'jenis_kenderaans.kod')
            ->leftJoin('jenis_kemalangans', 'jenis_kemalangans.id', '=', 'accidents.jenis_kemalangan_id')
            ->where('accidents.disable', '=', 'ACTIVE')
            ->where('kenderaans.id', $id)
            ->first();
        // dd($rs);die();
        // if($rs->tarikh_kejadian != null){
        //     $rs['tarikh'] = date('d-m-Y H:i:s', strtotime($rs->tarikh_kejadian));
        // }

        return Response::json($rs);
    }

    public function dataGMaps(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $currentdate = date('Y-m-d');
            $date = strtotime($currentdate . '-1 month');
            $prev_date = date('d-m-Y', $date);

            $negeri = 14;
            $daerah = [];
            if (Auth::user()->jkrnegeri()) {
                $negeri = Auth::user()->negeri_id;
            } else if (Auth::user()->jkrdaerah()) {
                $negeri = Auth::user()->negeri_id;
                $daerah = Auth::user()->daerah()->pluck('daerah_id')->toArray();
            }

            $input = [
                'negeri' => $negeri,
                'daerah' => $daerah,
                'nolaluan' => [],
                'jeniskemalangan' => '',
                'jenispermukaan' => '',
                'keadaanjalan' => '',
                'kualitipermukaan' => '',
                'sistemlaluan' => '',
                'cuaca' => '',
                'jenislanggarpertama' => '',
                'bentukjalan' => '',
                'jenisgaris' => '',
                'mukajalan' => '',
                'sebabcacatjalan' => '',
                'cahaya' => '',
                's_accident_startdate' => $prev_date,
                's_accident_enddate' => date('d-m-Y')
            ];
        }


        $negeri = 14;
        $daerah = [];
        if (Auth::user()->jkrnegeri()) {
            $negeri = Auth::user()->negeri_id;
        } else if (Auth::user()->jkrdaerah()) {
            $negeri = Auth::user()->negeri_id;
            $daerah = Auth::user()->daerah()->pluck('daerah_id')->toArray();
        }

        if (!empty($input['negeri'])) {
            $zoomnegeri = Negeri::where('id', $input['negeri'])->first();
        } else {
            $zoomnegeri = Negeri::where('id', $negeri)->first();
        }

        $negeri = Negeri::pluck('name', 'id');
        if (!empty($input['negeri'])) {
            $daerah = Daerah::where('negeri_id', $input['negeri'])->pluck('name', 'id');
        } else {
            $daerah = Daerah::pluck('name', 'id');
        }
        $jeniskemalangan = JenisKemalangan::pluck('name', 'id');
        $jenispermukaan = JenisPermukaan::pluck('name', 'id');
        $keadaanjalan = KeadaanJalan::pluck('name', 'id');
        $kualitipermukaan = KualitiPermukaan::pluck('name', 'id');
        $sistemlaluan = SistemLaluan::pluck('name', 'id');
        $cuaca = Cuaca::pluck('name', 'id');
        $jenislanggarpertama = JenisLanggarPertama::pluck('name', 'id');
        $bentukjalan = BentukJalan::pluck('name', 'id');
        $jenisgaris = JenisGaris::pluck('name', 'id');
        $mukajalan = MukaJalan::pluck('name', 'id');
        $sebabcacatjalan = SebabCacatJalan::pluck('name', 'id');
        $cahaya = Cahaya::pluck('name', 'id');

        $nolaluan = Accident::select('no_laluan')->where(function ($qr) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $qr->where('negeri_id', $input['negeri']);
            }elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){
                $qr->where('negeri_id', Auth::user()->negeri_id);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $qr->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }
        })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        // DB::enableQueryLog(); // Enable query log
        $acc = Accident::where(function ($q) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['negeri']);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $q->where('accidents.negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                $q->whereIn('daerah_id', $input['daerah']);
            }
            if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                $q->whereIn('no_laluan', $input['nolaluan']);
            }
            if ($input['jeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['jeniskemalangan']);
            }
            if ($input['jenispermukaan']) {
                $q->where('jenis_permukaan_id', $input['jenispermukaan']);
            }
            if ($input['keadaanjalan']) {
                $q->where('keadaan_jalan_id', $input['keadaanjalan']);
            }
            if ($input['kualitipermukaan']) {
                $q->where('kualiti_permukaan_id', $input['kualitipermukaan']);
            }
            if ($input['sistemlaluan']) {
                $q->where('sistem_laluan_id', $input['sistemlaluan']);
            }
            if ($input['cuaca']) {
                $q->where('cuaca_id', $input['cuaca']);
            }
            if ($input['jenislanggarpertama']) {
                $q->where('jenis_langgar_pertama_id', $input['jenislanggarpertama']);
            }
            if ($input['bentukjalan']) {
                $q->where('bentuk_jalan_id', $input['bentukjalan']);
            }
            if ($input['jenisgaris']) {
                $q->where('jenis_garis_id', $input['jenisgaris']);
            }
            if ($input['mukajalan']) {
                $q->where('muka_jalan_id', $input['mukajalan']);
            }
            if ($input['sebabcacatjalan']) {
                $q->where('sebab_cacat_jalan_id', $input['sebabcacatjalan']);
            }
            if ($input['cahaya']) {
                $q->where('cahaya_id', $input['cahaya']);
            }
            if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
            }
        })
            ->with('daerah')
            ->with('jenisKemalangan')
            ->with('bulan')
            ->with('jenisPermukaan')
            ->with('kualitiPermukaan')
            ->with('keadaanJalan')
            ->with('sistemLaluan')
            ->with('cuaca')
            ->with('JenisLanggarPertama')
            ->with('BentukJalan')
            ->with('JenisGaris')
            ->with('mukaJalan')
            ->with('Cahaya')
            ->with('user')->get();
        // dd(DB::getQueryLog()); // Show results of log

        // echo '<pre>'.print_r($acc).'</pre>';die();
        foreach ($acc as $a) {
            !empty($a->negeri_id) ? $a->negeri->name : '';
            $a->daerah_id != '' ? $a->daerah->name : '';
            $a->jenis_kemalangan_id != '' ? $a->jenisKemalangan->name : '';
            $a->bulan_id != '' ? $a->bulan->name : '';
            $a->jenis_permukaan_id != '' ? $a->jenisPermukaan->name : '';
            $a->kualiti_permukaan_id != '' ? $a->kualitiPermukaan->name : '';
            $a->keadaan_jalan_id != '' ? $a->keadaanJalan->name : '';
            $a->sistem_laluan_id != '' ? $a->sistemLaluan->name : '';
            $a->cuaca_id != '' ? $a->cuaca->name : '';
            $a->jenis_langgar_pertama_id != '' ? $a->JenisLanggarPertama->name : '';
            $a->bentuk_jalan_id != '' ? $a->BentukJalan->name : '';
            $a->jenis_garis_id != '' ? $a->JenisGaris->name : '';
            $a->muka_jalan_id != '' ? $a->mukaJalan->name : '';
            $a->sebab_cacat_jalan_id != '' ? $a->SebabCacatJalan->name : '';
            $a->cahaya_id != '' ? $a->Cahaya->name : '';
            $a->created_by != '' ? $a->user->fullname : '';
            $a->created_by != '' ? $a->user->department->name : '';
            $a['updated'] = $a->updated_at != '' ? date('d-m-Y H:i:s', strtotime($a->updated_at)) : '';
            $a['tarikh'] = $a->tarikh_kejadian != '' ? date('d-m-Y H:i:s', strtotime($a->tarikh_kejadian)) : '';
        }

        //Google Maps FarhanWazir
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
        /******** End Controls ********/

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
        iw_' . $this->gmap->map_name . '.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_' . $this->gmap->map_name . '.setContent(result);
                iw_' . $this->gmap->map_name . '.open(' . $this->gmap->map_name . ', mark);
            }
        }, this);';

        $this->gmap->add_marker($marker);
        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']
        //Google Maps FarhanWazir

        $rs = DB::table('accidents')
            ->select('accidents.tahun', 'jenis_kemalangans.name', 'accidents.jenis_kemalangan_id', DB::raw('COUNT(accidents.jenis_kemalangan_id) AS count'))
            ->join('jenis_kemalangans', 'accidents.jenis_kemalangan_id', '=', 'jenis_kemalangans.id')
            ->where('accidents.disable', '=', 'ACTIVE')
            ->where('jenis_kemalangans.disable', '=', 'ACTIVE')
            ->where(function ($q) use ($input) {
                if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                    $q->where('negeri_id', $input['negeri']);
                } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                    $q->where('negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                } else if (!empty($input['daerah']) && $input['daerah'][0] != '') {
                    $q->whereIn('daerah_id', $input['daerah']);
                }
                if (!empty($input['nolaluan']) && $input['nolaluan'][0] != '') {
                    $q->whereIn('no_laluan', $input['nolaluan']);
                }
                if ($input['jeniskemalangan']) {
                    $q->where('jenis_kemalangan_id', $input['jeniskemalangan']);
                }
                if ($input['jenispermukaan']) {
                    $q->where('jenis_permukaan_id', $input['jenispermukaan']);
                }
                if ($input['keadaanjalan']) {
                    $q->where('keadaan_jalan_id', $input['keadaanjalan']);
                }
                if ($input['kualitipermukaan']) {
                    $q->where('kualiti_permukaan_id', $input['kualitipermukaan']);
                }
                if ($input['sistemlaluan']) {
                    $q->where('sistem_laluan_id', $input['sistemlaluan']);
                }
                if ($input['cuaca']) {
                    $q->where('cuaca_id', $input['cuaca']);
                }
                if ($input['jenislanggarpertama']) {
                    $q->where('jenis_langgar_pertama_id', $input['jenislanggarpertama']);
                }
                if ($input['bentukjalan']) {
                    $q->where('bentuk_jalan_id', $input['bentukjalan']);
                }
                if ($input['jenisgaris']) {
                    $q->where('jenis_garis_id', $input['jenisgaris']);
                }
                if ($input['mukajalan']) {
                    $q->where('muka_jalan_id', $input['mukajalan']);
                }
                if ($input['sebabcacatjalan']) {
                    $q->where('sebab_cacat_jalan_id', $input['sebabcacatjalan']);
                }
                if ($input['cahaya']) {
                    $q->where('cahaya_id', $input['cahaya']);
                }
                if ($input['s_accident_startdate'] && $input['s_accident_enddate']) {
                    $q->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
            })
            ->groupby('accidents.tahun')
            ->groupby('jenis_kemalangans.name')
            ->groupby('accidents.jenis_kemalangan_id')
            ->orderBy('accidents.tahun', 'ASC')
            ->orderBy('accidents.jenis_kemalangan_id', 'ASC')
            ->get();

        //start chart stuff
        $i = 0;
        $maut = 0;
        $parah = 0;
        $ringan = 0;
        $rosak = 0;

        //pie
        for ($x = 0; $x < sizeof($rs); $x++) {
            $value = $rs[$x]->{'count'};
            $i = $i + $value;
            $jenis = $rs[$x]->name;

            if ($jenis == 'MAUT') {
                $maut = $rs[$x]->{'count'};
            }
            if ($jenis == 'PARAH') {
                $parah = $rs[$x]->{'count'};
            }
            if ($jenis == 'RINGAN') {
                $ringan = $rs[$x]->{'count'};
            }
            if ($jenis == 'ROSAK SAHAJA') {
                $rosak = $rs[$x]->{'count'};
            }
        }
        $total = $i;

        //barchart
        $rq = DB::table('jenis_kemalangans')->get();

        $bar = [];

        foreach ($rq as $r) {
            $bar[$r->id][] = $r->name;
        }

        $barresultmaut = 0;
        $barresultparah = 0;
        $barresultringan = 0;
        $barresultrosak = 0;

        foreach ($rs as $s) {
            $bar[$s->jenis_kemalangan_id][] = $s->count;
            $barresultmaut = "'" . implode("', '", $bar[1]) . "'";
            $barresultparah = "'" . implode("', '", $bar[2]) . "'";
            $barresultringan = "'" . implode("', '", $bar[3]) . "'";
            $barresultrosak = "'" . implode("', '", $bar[4]) . "'";
        }

        if ($input['s_accident_startdate']) {
            $startdate = date("Y-m-d", strtotime($input['s_accident_startdate']));
        } else {
            $startdate = date("Y-m-d");
        }

        if ($input['s_accident_enddate']) {
            $enddate = date("Y-m-d", strtotime($input['s_accident_enddate']));
        } else {
            $enddate = date("Y-m-d");
        }

        $bardate = date('Y', strtotime($startdate));
        $bardate2 = date('Y', strtotime($enddate));
        $baryeardate = range($bardate, $bardate2);
        $baryear = "'" . implode("', '", $baryeardate) . "'";
        //end chart stuff

        $filter = array();

        $filter[] = $input["negeri"];
        $filter[] = !empty($input["daerah"]) && $input['daerah'][0] != '' ? $input["daerah"] : [];
        $filter[] = $input["jeniskemalangan"];
        $filter[] = $input["jenispermukaan"];
        $filter[] = $input["keadaanjalan"];
        $filter[] = $input["kualitipermukaan"];
        $filter[] = $input["sistemlaluan"];
        $filter[] = $input["cuaca"];
        $filter[] = $input["jenislanggarpertama"];
        $filter[] = $input["bentukjalan"];
        $filter[] = $input["jenisgaris"];
        $filter[] = $input["mukajalan"];
        $filter[] = $input["sebabcacatjalan"];
        $filter[] = $input["cahaya"];
        $filter[] = $input["s_accident_startdate"];
        $filter[] = $input["s_accident_enddate"];
        $filter[] = !empty($input["nolaluan"]) ? $input["nolaluan"] : [];

        $daerahlist = [];
        $jeniskemalanganlist = '';
        $jenispermukaanlist = '';
        $keadaanjalanlist = '';
        $kualitipermukaanlist = '';
        $sistemlaluanlist = '';
        $cuacalist = '';
        $jenislanggarpertamalist = '';
        $bentukjalanlist = '';
        $jenisgarislist = '';
        $mukajalanlist = '';
        $sebabcacatjalanlist = '';
        $cahayalist = '';

        if (!empty($input['daerah']) && $input['daerah'][0] != '') {
            $daerahlist = Daerah::whereIn('id', $input["daerah"])->get();
        }
        if (!empty($input["jeniskemalangan"])) {
            $jeniskemalanganlist = JenisKemalangan::where('id', $input["jeniskemalangan"])->first();
        }
        if (!empty($input["jenispermukaan"])) {
            $jenispermukaanlist = JenisPermukaan::where('id', $input["jenispermukaan"])->first();
        }
        if (!empty($input["keadaanjalan"])) {
            $keadaanjalanlist = KeadaanJalan::where('id', $input["keadaanjalan"])->first();
        }
        if (!empty($input["kualitipermukaan"])) {
            $kualitipermukaanlist = KualitiPermukaan::where('id', $input["kualitipermukaan"])->first();
        }
        if (!empty($input["sistemlaluan"])) {
            $sistemlaluanlist = SistemLaluan::where('id', $input["sistemlaluan"])->first();
        }
        if (!empty($input["cuaca"])) {
            $cuacalist = Cuaca::where('id', $input["cuaca"])->first();
        }
        if (!empty($input["jenislanggarpertama"])) {
            $jenislanggarpertamalist = JenisLanggarPertama::where('id', $input["jenislanggarpertama"])->first();
        }
        if (!empty($input["bentukjalan"])) {
            $bentukjalanlist = BentukJalan::where('id', $input["bentukjalan"])->first();
        }
        if (!empty($input["jenisgaris"])) {
            $jenisgarislist = JenisGaris::where('id', $input["jenisgaris"])->first();
        }
        if (!empty($input["mukajalan"])) {
            $mukajalanlist = MukaJalan::where('id', $input["mukajalan"])->first();
        }
        if (!empty($input["sebabcacatjalan"])) {
            $sebabcacatjalanlist = SebabCacatJalan::where('id', $input["sebabcacatjalan"])->first();
        }
        if (!empty($input["cahaya"])) {
            $cahayalist = Cahaya::where('id', $input["cahaya"])->first();
        }

        return view(
            'site.dataGMaps',
            compact('negeri', 'daerah', 'jeniskemalangan', 'jenispermukaan', 'keadaanjalan', 'kualitipermukaan', 'sistemlaluan', 'cuaca', 'jenislanggarpertama', 'bentukjalan', 'jenisgaris', 'mukajalan', 'sebabcacatjalan', 'cahaya', 'map', 'acc'),
            [
                'filter' => $filter,
                'daerahlist' => $daerahlist,
                'jeniskemalanganlist' => $jeniskemalanganlist,
                'jenispermukaanlist' => $jenispermukaanlist,
                'keadaanjalanlist' => $keadaanjalanlist,
                'kualitipermukaanlist' => $kualitipermukaanlist,
                'sistemlaluanlist' => $sistemlaluanlist,
                'cuacalist' => $cuacalist,
                'jenislanggarpertamalist' => $jenislanggarpertamalist,
                'bentukjalanlist' => $bentukjalanlist,
                'jenisgarislist' => $jenisgarislist,
                'mukajalanlist' => $mukajalanlist,
                'sebabcacatjalanlist' => $sebabcacatjalanlist,
                'cahayalist' => $cahayalist,
                'total' => $total,
                'maut' => $maut,
                'ringan' => $ringan,
                'parah' => $parah,
                'rosak' => $rosak,
                'barresultmaut' => $barresultmaut,
                'barresultparah' => $barresultparah,
                'barresultringan' => $barresultringan,
                'barresultrosak' => $barresultrosak,
                'unique_data_year' => $baryear,
                'exnegeri' => $input['negeri'],
                'exjeniskemalangan' => $input['jeniskemalangan'],
                'exdaerah' => !empty($input["daerah"]) ? $input['daerah'] : [],
                'exnolaluan' => !empty($input["nolaluan"]) ? $input["nolaluan"] : [],
                'exjenispermukaan' => $input['jenispermukaan'],
                'exkeadaanjalan' => $input['keadaanjalan'],
                'exkualitipermukaan' => $input['kualitipermukaan'],
                'exsistemlaluan' => $input['sistemlaluan'],
                'excuaca' => $input['cuaca'],
                'exjenislanggarpertama' => $input['jenislanggarpertama'],
                'exbentukjalan' => $input['bentukjalan'],
                'exjenisgaris' => $input['jenisgaris'],
                'exmukajalan' => $input['mukajalan'],
                'exsebabcacatjalan' => $input['sebabcacatjalan'],
                'excahaya' => $input['cahaya'],
                'exs_accident_startdate' => date("Y-m-d", strtotime($input['s_accident_startdate'])),
                'exs_accident_enddate' => date("Y-m-d", strtotime($input['s_accident_enddate'])),
                'nolaluan' => $nolaluan,
                's_accident_startdate' => date("Y-m-d", strtotime($input['s_accident_startdate'])),
                's_accident_enddate' => date("Y-m-d", strtotime($input['s_accident_enddate'])),
                'zoomnegeri' => $zoomnegeri,
            ]
        );
    }

    // EXCEL FILE DOWNLOAD
    public function exportexcel(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        }

        $acc = Accident::where(function ($q) use ($input) {
            if ($input['exnegeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['exnegeri']);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            } else if (!empty($input['exdaerah']) && $input['exdaerah'][0] != '') {
                $q->whereIn('daerah_id', explode(',', $input['exdaerah']));
            }
            if (!empty($input['exnolaluan']) && $input['exnolaluan'][0] != '') {
                $q->whereIn('no_laluan', explode(',', $input['exnolaluan']));
            }
            if ($input['exjeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['exjeniskemalangan']);
            }
            if ($input['exjenispermukaan']) {
                $q->where('jenis_permukaan_id', $input['exjenispermukaan']);
            }
            if ($input['exkeadaanjalan']) {
                $q->where('keadaan_jalan_id', $input['exkeadaanjalan']);
            }
            if ($input['exkualitipermukaan']) {
                $q->where('kualiti_permukaan_id', $input['exkualitipermukaan']);
            }
            if ($input['exsistemlaluan']) {
                $q->where('sistem_laluan_id', $input['exsistemlaluan']);
            }
            if ($input['excuaca']) {
                $q->where('cuaca_id', $input['excuaca']);
            }
            if ($input['exjenislanggarpertama']) {
                $q->where('jenis_langgar_pertama_id', $input['exjenislanggarpertama']);
            }
            if ($input['exbentukjalan']) {
                $q->where('bentuk_jalan_id', $input['exbentukjalan']);
            }
            if ($input['exjenisgaris']) {
                $q->where('jenis_garis_id', $input['exjenisgaris']);
            }
            if ($input['exmukajalan']) {
                $q->where('muka_jalan_id', $input['exmukajalan']);
            }
            if ($input['exsebabcacatjalan']) {
                $q->where('sebab_cacat_jalan_id', $input['exsebabcacatjalan']);
            }
            if ($input['excahaya']) {
                $q->where('cahaya_id', $input['excahaya']);
            }
            if ($input['exstatus_la']) {
                $q->where('status_la', $input['exstatus_la']);
            }
            if ($input['exs_accident_startdate'] && $input['exs_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [$input['exs_accident_startdate'], $input['exs_accident_enddate']]);
            }
        })->with(['negeri:id,name', 'daerah:id,name', 'jenisKemalangan:id,name', 'bulan:id,name', 'jenisPermukaan:id,name', 'keadaanJalan:id,name', 'kualitiPermukaan:id,name', 'sistemLaluan:id,name', 'cuaca:id,name', 'jenisLanggarPertama:id,name', 'bentukJalan:id,name', 'jenisGaris:id,name', 'mukaJalan:id,name', 'sebabCacatJalan:id,name', 'cahaya:id,name'])->get();
        return view(
            'site/excelaccident',
            [
                'datacontent' => $acc
            ]
        );
    }

    // CSV FILE DOWNLOAD
    public function exportcsv(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        }

        $acc = Accident::where(function ($q) use ($input) {
            if ($input['exnegeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['exnegeri']);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            } else if (!empty($input['exdaerah']) && $input['exdaerah'][0] != '') {
                $q->whereIn('daerah_id', explode(',', $input['exdaerah']));
            }
            if (!empty($input['exnolaluan']) && $input['exnolaluan'][0] != '') {
                $q->whereIn('no_laluan', explode(',', $input['exnolaluan']));
            }
            if ($input['exjeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['exjeniskemalangan']);
            }
            if ($input['exjenispermukaan']) {
                $q->where('jenis_permukaan_id', $input['exjenispermukaan']);
            }
            if ($input['exkeadaanjalan']) {
                $q->where('keadaan_jalan_id', $input['exkeadaanjalan']);
            }
            if ($input['exkualitipermukaan']) {
                $q->where('kualiti_permukaan_id', $input['exkualitipermukaan']);
            }
            if ($input['exsistemlaluan']) {
                $q->where('sistem_laluan_id', $input['exsistemlaluan']);
            }
            if ($input['excuaca']) {
                $q->where('cuaca_id', $input['excuaca']);
            }
            if ($input['exjenislanggarpertama']) {
                $q->where('jenis_langgar_pertama_id', $input['exjenislanggarpertama']);
            }
            if ($input['exbentukjalan']) {
                $q->where('bentuk_jalan_id', $input['exbentukjalan']);
            }
            if ($input['exjenisgaris']) {
                $q->where('jenis_garis_id', $input['exjenisgaris']);
            }
            if ($input['exmukajalan']) {
                $q->where('muka_jalan_id', $input['exmukajalan']);
            }
            if ($input['exsebabcacatjalan']) {
                $q->where('sebab_cacat_jalan_id', $input['exsebabcacatjalan']);
            }
            if ($input['excahaya']) {
                $q->where('cahaya_id', $input['excahaya']);
            }
            if ($input['exstatus_la']) {
                $q->where('status_la', $input['exstatus_la']);
            }
            if ($input['exs_accident_startdate'] && $input['exs_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [$input['exs_accident_startdate'], $input['exs_accident_enddate']]);
            }
        })->get();
        return view(
            'site/csvaccident',
            [
                'datacontent' => $acc
            ]
        );
    }

    // JSON FILE DOWNLOAD
    public function exportjson(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        }

        $acc = Accident::where(function ($q) use ($input) {
            if ($input['exnegeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['exnegeri']);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            } else if (!empty($input['exdaerah']) && $input['exdaerah'][0] != '') {
                $q->whereIn('daerah_id', explode(',', $input['exdaerah']));
            }
            if (!empty($input['exnolaluan']) && $input['exnolaluan'][0] != '') {
                $q->whereIn('no_laluan', explode(',', $input['exnolaluan']));
            }
            if ($input['exjeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['exjeniskemalangan']);
            }
            if ($input['exjenispermukaan']) {
                $q->where('jenis_permukaan_id', $input['exjenispermukaan']);
            }
            if ($input['exkeadaanjalan']) {
                $q->where('keadaan_jalan_id', $input['exkeadaanjalan']);
            }
            if ($input['exkualitipermukaan']) {
                $q->where('kualiti_permukaan_id', $input['exkualitipermukaan']);
            }
            if ($input['exsistemlaluan']) {
                $q->where('sistem_laluan_id', $input['exsistemlaluan']);
            }
            if ($input['excuaca']) {
                $q->where('cuaca_id', $input['excuaca']);
            }
            if ($input['exjenislanggarpertama']) {
                $q->where('jenis_langgar_pertama_id', $input['exjenislanggarpertama']);
            }
            if ($input['exbentukjalan']) {
                $q->where('bentuk_jalan_id', $input['exbentukjalan']);
            }
            if ($input['exjenisgaris']) {
                $q->where('jenis_garis_id', $input['exjenisgaris']);
            }
            if ($input['exmukajalan']) {
                $q->where('muka_jalan_id', $input['exmukajalan']);
            }
            if ($input['exsebabcacatjalan']) {
                $q->where('sebab_cacat_jalan_id', $input['exsebabcacatjalan']);
            }
            if ($input['excahaya']) {
                $q->where('cahaya_id', $input['excahaya']);
            }
            if ($input['exstatus_la']) {
                $q->where('status_la', $input['exstatus_la']);
            }
            if ($input['exs_accident_startdate'] && $input['exs_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [$input['exs_accident_startdate'], $input['exs_accident_enddate']]);
            }
        })->get();

        return view(
            'site/jsonaccident',
            [
                'datacontent' => $acc
            ]
        );
    }

    // PDF FILE DOWNLOAD
    public function exportpdf(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        }

        $acc = Accident::where(function ($q) use ($input) {
            if ($input['exnegeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', $input['exnegeri']);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $q->where('negeri_id', Auth::user()->negeri_id);
            }
            if (Auth::user()->jkrdaerah()) {
                $q->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
            } else if (!empty($input['exdaerah']) && $input['exdaerah'][0] != '') {
                $q->whereIn('daerah_id', explode(',', $input['exdaerah']));
            }
            if (!empty($input['exnolaluan']) && $input['exnolaluan'][0] != '') {
                $q->whereIn('no_laluan', explode(',', $input['exnolaluan']));
            }
            if ($input['exjeniskemalangan']) {
                $q->where('jenis_kemalangan_id', $input['exjeniskemalangan']);
            }
            if ($input['exjenispermukaan']) {
                $q->where('jenis_permukaan_id', $input['exjenispermukaan']);
            }
            if ($input['exkeadaanjalan']) {
                $q->where('keadaan_jalan_id', $input['exkeadaanjalan']);
            }
            if ($input['exkualitipermukaan']) {
                $q->where('kualiti_permukaan_id', $input['exkualitipermukaan']);
            }
            if ($input['exsistemlaluan']) {
                $q->where('sistem_laluan_id', $input['exsistemlaluan']);
            }
            if ($input['excuaca']) {
                $q->where('cuaca_id', $input['excuaca']);
            }
            if ($input['exjenislanggarpertama']) {
                $q->where('jenis_langgar_pertama_id', $input['exjenislanggarpertama']);
            }
            if ($input['exbentukjalan']) {
                $q->where('bentuk_jalan_id', $input['exbentukjalan']);
            }
            if ($input['exjenisgaris']) {
                $q->where('jenis_garis_id', $input['exjenisgaris']);
            }
            if ($input['exmukajalan']) {
                $q->where('muka_jalan_id', $input['exmukajalan']);
            }
            if ($input['exsebabcacatjalan']) {
                $q->where('sebab_cacat_jalan_id', $input['exsebabcacatjalan']);
            }
            if ($input['excahaya']) {
                $q->where('cahaya_id', $input['excahaya']);
            }
            if ($input['exstatus_la']) {
                $q->where('status_la', $input['exstatus_la']);
            }
            if ($input['exs_accident_startdate'] && $input['exs_accident_enddate']) {
                $q->whereBetween('tarikh_kejadian', [$input['exs_accident_startdate'], $input['exs_accident_enddate']]);
            }
        })->get();

        $data = ['datacontent' => $acc];

        $pdf = \PDF::loadView('site/pdfaccident', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Data_Kemalangan.pdf');
    }

    public function dataProcess()
    {
        $upload = Upload::select('*')->get();
        return view('site.dataProcess', compact('upload'));
    }

    public function getDataProcess()
    {
        $upload = Upload::query();
        return DataTables::of($upload)
            ->addIndexColumn()
            ->addColumn('name', function ($upload) {
                return $upload->name;
            })
            ->addColumn('status', function ($upload) {
                return $upload->status;
            })
            ->addColumn('created_at', function ($upload) {
                return $upload->created_at;
            })
            ->addColumn('action', function ($upload) {
                $action = '';
                if ($upload->status == 'Sudah Dimuat Naik') {
                    $action .= '<button class="btn btn-outline btn-sm btn-success file-edit" data-id="' . $upload->id . '" data-toggle="tooltip" data-placement="top" title="Proses Fail">
                            <i class="fa fa-database"></i>
                        </button>
                        <button class="btn btn-outline btn-sm btn-danger file-delete" data-id="' . $upload->id . '" data-toggle="tooltip" data-placement="top" title="Hapus Fail">
                            <i class="fa fa-trash"></i>
                        </button>';
                }
                if ($upload->status == 'Berjaya') {
                    $action .= '<button class="btn btn-outline btn-sm btn-success apirecord-edit" data-id="' . $upload->id . '" data-toggle="tooltip" data-placement="top" title="Proses Fail">
                            <i class="fa fa-database"></i>
                        </button>
                            <button class="btn btn-outline btn-sm btn-danger apirecord-delete" data-id="' . $upload->id . '" data-toggle="tooltip" data-placement="top" title="Hapus Fail">
                                <i class="fa fa-trash"></i>
                            </button>';
                }
                if ($upload->status == 'Sudah Diproses') {
                    $action .= '<button class="btn btn-outline btn-sm btn-success exportList-view" data-id="' . $upload->id . '" data-toggle="tooltip" data-placement="top" title="List">
                            <i class="fa fa-list-alt"></i>
                        </button>';
                }
                return $action;
            })->escapeColumns([])
            ->toJson();
    }

    public static function migrateData($uid)
    {
        //Latitude from 1.24722 to 6.8837 and longitude from 99.8432 to 118.61119 = MALAYSIA
        $export = Export::where('upload_id', $uid)->pluck('id');
        return $export;

        foreach ($export as $ex) {
            $exp = Export::findOrFail($ex);
            $acc = Accident::firstOrNew(array('no_laporan' => (float)$exp->no_laporan));
            if (!$acc->exist) {
                return '1';
                $newdate = $exp->tarikh_kejadian . ' ' . str_pad($exp->masa, 4, '0', STR_PAD_LEFT);
                if ($exp->latitude != '') {
                    $arrlat = explode('.', str_replace(array(',', ' '), '.', $exp->latitude), 3);
                    if (sizeof($arrlat) > 2) {
                        $newlat = number_format((float)((int)$arrlat[0] + ((((int)$arrlat[1] * 60) + ((float)$arrlat[2])) / 3600)), 4);
                    } else {
                        $newlat = number_format((float)$exp->latitude, 4);
                    }
                } else {
                    $newlat = null;
                }
                if ($exp->logitude != '') {
                    $arrlng = explode('.', str_replace(array(',', ' '), '.', $exp->logitude), 3);
                    if (sizeof($arrlng) > 2) {
                        $newlng = number_format((float)((int)$arrlng[0] + ((((int)$arrlng[1] * 60) + ((float)$arrlng[2])) / 3600)), 4);
                    } else {
                        $newlng = number_format((float)$exp->logitude, 4);
                    }
                } else {
                    $newlng = null;
                }
                $acc->negeri_id = !empty($exp->negeri) ? $exp->negeri : null;
                //$acc->daerah_id = !empty($exp->daerah) ? $exp->daerah : null;

                if (strlen($exp->daerah) < 4) {
                    $checkDaerah = substr($exp->daerah, 1);
                } else {
                    $checkDaerah = substr($exp->daerah, 2);
                }

                $newNegeri = (int)$exp->negeri;

                $findDaerahNegeri = Daerah::where('kod_daerah', $checkDaerah)
                    ->where('negeri_id', $newNegeri)
                    ->pluck('id')->first();

                $acc->export_id = $ex;
                $acc->daerah_id = !empty($findDaerahNegeri) ?  $findDaerahNegeri : 999;
                $acc->balai_id = !empty($exp->balai) ? $exp->balai : null;
                $acc->no_laporan = $exp->no_laporan != '' ? (float)$exp->no_laporan : null;
                $acc->tarikh_kejadian = date_create_from_format('d/m/Y H:i', $newdate)->format('Y-m-d H:i');
                // dd(date_create_from_format('d/m/Y H:i', $newdate)->format('Y-m-d H:i'));
                $acc->hari_id = !empty($exp->hari) ? $exp->hari : 99;
                $acc->bil_ken_terlibat = $exp->bil_ken_terlibat != '' ? $exp->bil_ken_terlibat : null;
                $acc->bil_ken_rosak = $exp->bil_ken_rosak != '' ? $exp->bil_ken_rosak : null;
                $acc->bil_pemandu_mati = $exp->bil_pemandu_mati != '' ? $exp->bil_pemandu_mati : null;
                $acc->bil_pemandu_cedera = $exp->bil_pemandu_cedera != '' ? $exp->bil_pemandu_cedera : null;
                $acc->bil_penumpang_mati = $exp->bil_penumpang_mati != '' ? $exp->bil_penumpang_mati : null;
                $acc->bil_penumpang_cedera = $exp->bil_penumpang_cedera != '' ? $exp->bil_penumpang_cedera : null;
                $acc->bil_pejalan_mati = $exp->bil_pejalan_mati != '' ? $exp->bil_pejalan_mati : null;
                $acc->bil_pejalan_cedera = $exp->bil_pejalan_cedera != '' ? $exp->bil_pejalan_cedera : null;
                $acc->jenis_kemalangan_id = !empty($exp->jenis_kemalangan) ? $exp->jenis_kemalangan : 99;
                $acc->jenis_permukaan_id = !empty($exp->jenis_permukaan) ? $exp->jenis_permukaan : 99;
                $acc->sistem_laluan_id = !empty($exp->sistem_laluan) ? $exp->sistem_laluan : 99;
                $acc->bentuk_jalan_id = !empty($exp->bentuk_jalan) ? $exp->bentuk_jalan : 99;
                $acc->kualiti_permukaan_id = !empty($exp->kualiti_permukaan) ? $exp->kualiti_permukaan : 99;
                $acc->keadaan_jalan_id = !empty($exp->keadaan_jalan) ? $exp->keadaan_jalan : 99;
                $acc->jenis_garis_id = !empty($exp->jenis_garis) ? $exp->jenis_garis : 99;
                $acc->langgar_lari_id = !empty($exp->langgar_lari) ? $exp->langgar_lari : 99;
                $acc->jenis_kawalan_id = !empty($exp->jenis_kawalan) ? $exp->jenis_kawalan : 99;
                $acc->lebar_jalan = $exp->lebar_jalan != '' ? $exp->lebar_jalan : null;
                // $acc->lebar_bahu_jalan = $exp->lebar_jalan != '' ? $exp->lebar_jalan : null;
                $acc->jenis_bahu_jalan_id = !empty($exp->jenis_bahu_jalan) ? $exp->jenis_bahu_jalan : 99;
                $acc->sebab_cacat_jalan_id = !empty($exp->sebab_cacat_jalan) ? $exp->sebab_cacat_jalan : 99;
                $acc->had_laju_id = !empty($exp->had_laju) ? $exp->had_laju : 99;
                $acc->muka_jalan_id = !empty($exp->muka_jalan) ? $exp->muka_jalan : 99;
                $acc->jenis_langgar_pertama_id = !empty($exp->jenis_langgar_pertama) ? $exp->jenis_langgar_pertama : 99;
                $acc->cuaca_id = !empty($exp->cuaca) ? $exp->cuaca : 99;
                $acc->cahaya_id = !empty($exp->cahaya) ? $exp->cahaya : 99;
                $acc->jenis_jalan_id = !empty($exp->jenis_jalan) && filter_var($exp->jenis_jalan, FILTER_VALIDATE_INT) === true ? $exp->jenis_jalan : 99;
                $acc->no_laluan = $exp->no_laluan != '' ? $exp->no_laluan : null;
                $acc->tempat_kejadian = $exp->tempat_kejadian != '' ? $exp->tempat_kejadian : null;
                $acc->jenis_tempat_id = !empty($exp->jenis_tempat) ? $exp->jenis_tempat : 99;
                $acc->jenis_kawasan_id = !empty($exp->jenis_kawasan) ? $exp->jenis_kawasan : 99;
                $acc->pos_kilometer = $exp->pos_kilometer != '' ? $exp->pos_kilometer : null;
                $acc->{'100_meter_hampir'} = $exp->{'100_meter_hampir'} != '' ? $exp->{'100_meter_hampir'} : null;
                $acc->sebab_binatang_id = !empty($exp->sebab_binatang) ? $exp->sebab_binatang : 99;
                $acc->anggar_rosak_kenderaan = $exp->anggar_rosak_kenderaan != '' ? $exp->anggar_rosak_kenderaan : null;
                $acc->anggar_rosak_semua = $exp->anggar_rosak_semua != '' ? $exp->anggar_rosak_semua : null;
                $acc->siri_peta = $exp->siri_peta != '' ? $exp->siri_peta : null;
                $acc->kod_peta = $exp->kod_peta != '' ? $exp->kod_peta : null;
                $acc->latitude = $newlat;
                $acc->logitude = $newlng;
                $acc->lebar_bahu_jalan_kiri = $exp->lebar_bahu_jalan_kiri != '' ? $exp->lebar_bahu_jalan_kiri : null;
                $acc->lebar_bahu_jalan_kanan = $exp->lebar_bahu_jalan_kanan != '' ? $exp->lebar_bahu_jalan_kanan : null;
                $acc->pos_dari1 = $exp->pos_dari1 != '' ? $exp->pos_dari1 : null;
                $acc->pos_dari2 = $exp->pos_dari2 != '' ? $exp->pos_dari2 : null;
                $acc->pos_km1 = $exp->pos_km1 != '' ? $exp->pos_km1 : null;
                $acc->pos_km2 = $exp->pos_km2 != '' ? $exp->pos_km2 : null;
                $acc->pos_no_sek1 = $exp->pos_no_sek1 != '' ? $exp->pos_no_sek1 : null;
                $acc->pos_jarak = $exp->pos_jarak != '' ? $exp->pos_jarak : null;
                $acc->pos_arah = $exp->pos_arah != '' ? $exp->pos_arah : null;
                $acc->pos_jarak3 = $exp->pos_jarak3 != '' ? $exp->pos_jarak3 : null;
                $acc->pos_dari3 = $exp->pos_dari3 != '' ? $exp->pos_dari3 : null;
                $acc->pos_arah3 = $exp->pos_arah3 != '' ? $exp->pos_arah3 : null;
                $acc->nod_1 = $exp->nod_1 != '' ? $exp->nod_1 : null;
                $acc->nod_2 = $exp->nod_2 != '' ? $exp->nod_2 : null;
                $acc->arah_id = !empty($exp->arah) ? $exp->arah : 99;
                $acc->nombor_seksyen = $exp->nombor_seksyen != '' ? $exp->nombor_seksyen : null;
                $acc->poskm_hampir = $exp->poskm_hampir != '' ? $exp->poskm_hampir : null;
                $acc->lakaran_kejadian = $exp->lakaran_kejadian != '' ? $exp->lakaran_kejadian : null;
                $acc->lakaran_lokasi = $exp->lakaran_lokasi != '' ? $exp->lakaran_lokasi : null;
                $acc->tarikh_pengaduan = empty($exp->tarikh_pengaduan) ? null : date_create_from_format('d/m/Y', $exp->tarikh_pengaduan)->format('Y-m-d 00:00');
                $acc->tahun = date_create_from_format('d/m/Y H:i', $newdate)->format('Y');
                $acc->bulan_id = date_create_from_format('d/m/Y H:i', $newdate)->format('n');
                $acc->disable = 'baru';
                $acc->disable = 'ACTIVE';
                $acc->created_by = Auth::user()->id;
                $acc->updated_by = Auth::user()->id;
                if ($newlat >= 1.24722 && $newlat <= 6.8837 && $newlng >= 99.8432 && $newlng <= 118.61119) {
                    //dlm msia xyah wat pape
                } else {
                    $acc->latitude = -76.300003;
                    $acc->logitude = -148.000000;
                }
                return "<pre>" . print_r($acc, 1) . "</pre>";
                $acc->save();
                $exp->disable = 'INACTIVE';
                $exp->save();
            }
        }

        $up = Upload::findOrFail($uid);
        $up->status = 'Sudah Diproses';
        $up->updated_by = Auth::user()->id;
        $up->save();

        return 'done';
        //        return Response::json(array('status'=>'ok'));
    }

    public function deleteMigrateData($uid)
    {
        $up = Upload::find($uid);
        $up->delete();

        $up = Export::where('upload_id', $uid)->delete();

        return redirect()->back()->with('message', 'Fail Berjaya Dipadam!');
    }

    public function importCSV()
    {
        // ini_set("auto_detect_line_endings", true);
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $name = Input::file('import_file')->getClientOriginalName();
            $size = Input::file('import_file')->getClientSize();
            $status = 'Sudah Dimuat Naik';
            $disable = 'ACTIVE';
            $userid = Auth::user()->id;

            //Insert to uploads
            $up = new Upload;
            $up->name = $name;
            $up->status = $status;
            $up->size = $size;
            $up->disable = $disable;
            $up->created_by = $userid;
            $up->updated_by = $userid;
            $up->save();

            $file = fopen($path, "r");

            $i = 0;
            while (($data = fgetcsv($file, 0, ",")) !== false) {
                if ($i == 0) {
                    $i++;
                } else {
                    $meter = '100_meter_hampir';
                    $model = new Export;
                    $model->upload_id = $up->id;
                    $model->negeri = $data[0];
                    $model->daerah = $data[1];
                    $model->balai = $data[2];
                    $model->no_laporan = $data[3];
                    $model->tarikh_kejadian = $data[4];
                    $model->masa = $data[5];
                    $model->hari = $data[6];
                    $model->bil_ken_terlibat = $data[7];
                    $model->bil_ken_rosak = $data[8];
                    $model->bil_pemandu_mati = $data[9];
                    $model->bil_pemandu_cedera = $data[10];
                    $model->bil_penumpang_mati = $data[11];
                    $model->bil_penumpang_cedera = $data[12];
                    $model->bil_pejalan_mati = $data[13];
                    $model->bil_pejalan_cedera = $data[14];
                    $model->jenis_kemalangan = $data[15];
                    $model->jenis_permukaan = $data[16];
                    $model->sistem_laluan = $data[17];
                    $model->bentuk_jalan = $data[18];
                    $model->kualiti_permukaan = $data[19];
                    $model->keadaan_jalan = $data[20];
                    $model->jenis_garis = $data[21];
                    $model->langgar_lari = $data[22];
                    $model->jenis_kawalan = $data[23];
                    $model->lebar_jalan = $data[24];
                    // $model->lebar_bahu_jalan = $data[25];
                    $model->jenis_bahu_jalan = $data[25];
                    $model->sebab_cacat_jalan = $data[26];
                    $model->had_laju = $data[27];
                    $model->muka_jalan = $data[28];
                    $model->jenis_langgar_pertama = $data[29];
                    $model->cuaca = $data[30];
                    $model->cahaya = $data[31];
                    $model->jenis_jalan = $data[32];
                    $model->no_laluan = $data[33];
                    $model->tempat_kejadian = $data[34];
                    $model->jenis_tempat = $data[35];
                    $model->jenis_kawasan = $data[36];
                    $model->pos_kilometer = $data[37];
                    $model->$meter = $data[38];
                    $model->sebab_binatang = $data[39];
                    $model->anggar_rosak_kenderaan = $data[40];
                    $model->anggar_rosak_semua = $data[41];
                    $model->siri_peta = $data[42];
                    $model->kod_peta = $data[43];
                    $model->latitude = $data[44];
                    $model->logitude = $data[45];
                    $model->lebar_bahu_jalan_kiri = $data[46];
                    $model->lebar_bahu_jalan_kanan = $data[47];
                    $model->pos_dari1 = $data[48];
                    $model->pos_dari2 = $data[49];
                    $model->pos_km1 = $data[50];
                    $model->pos_km2 = $data[51];
                    $model->pos_no_sek1 = $data[52];
                    $model->pos_jarak = $data[53];
                    $model->pos_arah = $data[54];
                    $model->pos_jarak3 = $data[55];
                    $model->pos_dari3 = $data[56];
                    $model->pos_arah3 = $data[57];
                    $model->nod_1 = $data[58];
                    $model->nod_2 = $data[59];
                    $model->arah = $data[60];
                    $model->nombor_seksyen = $data[61];
                    $model->poskm_hampir = $data[62];
                    $model->lakaran_kejadian = $data[63];
                    $model->lakaran_lokasi = $data[64];
                    $model->tarikh_pengaduan = $data[65];
                    $model->save();

                    unset($data);
                    $i++;
                }
            }
            fclose($file);
        }
    }

    //data daripada Api
    //$params1 akan terima value daily,weekly,monthly,custom
    //param2 akan terima value 0 iaitu 24 hour report ,value 1 = pol27
    //$request ada $enddate
    //    public function importApi($param1,$param2,$startDate='null',$endDate='null'){


    public function deleteApiData($id)
    {
        $up = Upload::find($id);
        $up->delete();

        $up = Export::where('upload_id', $id)->delete();

        return redirect()->back()->with('message', 'Fail Berjaya Dipadam!');
    }

    public static function migrateApiData($id)
    {
        //Latitude from 1.24722 to 6.8837 and longitude from 99.8432 to 118.61119 = MALAYSIA
        $export = Export::where('upload_id', $id)->pluck('id');

        foreach ($export as $ex) {
            $exp = Export::findOrFail($ex);
            $acc = Accident::firstOrNew(['no_laporan' => $exp->no_laporan]);

            if (!$acc->exist) {
                $newdate = $exp->tarikh_kejadian . ' ' . str_pad($exp->masa, 4, '0', STR_PAD_LEFT);
                if ($exp->latitude != '') {
                    $arrlat = explode('.', str_replace(array(',', ' '), '.', $exp->latitude), 3);
                    if (sizeof($arrlat) > 2) {
                        $newlat = number_format((float)((int)$arrlat[0] + ((((int)$arrlat[1] * 60) + ((float)$arrlat[2])) / 3600)), 4);
                    } else {
                        $newlat = number_format((float)$exp->latitude, 4);
                    }
                } else {
                    $newlat = null;
                }

                if ($exp->logitude != '') {
                    $arrlng = explode('.', str_replace(array(',', ' '), '.', $exp->logitude), 3);
                    if (sizeof($arrlng) > 2) {
                        $newlng = number_format((float)((int)$arrlng[0] + ((((int)$arrlng[1] * 60) + ((float)$arrlng[2])) / 3600)), 4);
                    } else {
                        $newlng = number_format((float)$exp->logitude, 4);
                    }
                } else {
                    $newlng = null;
                }

                $acc->negeri_id = !empty($exp->negeri) ? $exp->negeri : null;
                //$acc->daerah_id = !empty($exp->daerah) ? $exp->daerah : null;

                if (strlen($exp->daerah) < 4) {
                    $checkDaerah = substr($exp->daerah, 1);
                } else {
                    $checkDaerah = substr($exp->daerah, 2);
                }

                $newNegeri = (int)$exp->negeri;

                $findDaerahNegeri = Daerah::where('kod_daerah', $checkDaerah)
                    ->where('negeri_id', $newNegeri)
                    ->pluck('id')->first();
                $acc->export_id = $ex;
                $acc->daerah_id = !empty($findDaerahNegeri) ? $findDaerahNegeri : 999;
                $acc->balai_id = !empty($exp->balai) ? $exp->balai : null;
                $acc->no_laporan = $exp->no_laporan != '' ? (float)$exp->no_laporan : null;
                //                return $newdate;
                $acc->tarikh_kejadian = date_create_from_format('d/m/Y H:i', $newdate)->format('Y-m-d H:i');
                //                return dd(date_create_from_format('d/m/Y H:i', $newdate)->format('Y-m-d H:i'));
                $acc->hari_id = !empty($exp->hari) ? $exp->hari : 99;
                $acc->bil_ken_terlibat = $exp->bil_ken_terlibat != '' ? $exp->bil_ken_terlibat : null;
                $acc->bil_ken_rosak = $exp->bil_ken_rosak != '' ? $exp->bil_ken_rosak : null;
                $acc->bil_pemandu_mati = $exp->bil_pemandu_mati != '' ? $exp->bil_pemandu_mati : null;
                $acc->bil_pemandu_cedera = $exp->bil_pemandu_cedera != '' ? $exp->bil_pemandu_cedera : null;
                $acc->bil_penumpang_mati = $exp->bil_penumpang_mati != '' ? $exp->bil_penumpang_mati : null;
                $acc->bil_penumpang_cedera = $exp->bil_penumpang_cedera != '' ? $exp->bil_penumpang_cedera : null;
                $acc->bil_pejalan_mati = $exp->bil_pejalan_mati != '' ? $exp->bil_pejalan_mati : null;
                $acc->bil_pejalan_cedera = $exp->bil_pejalan_cedera != '' ? $exp->bil_pejalan_cedera : null;
                $acc->jenis_kemalangan_id = !empty($exp->jenis_kemalangan) ? $exp->jenis_kemalangan : 99;
                $acc->jenis_permukaan_id = !empty($exp->jenis_permukaan) ? $exp->jenis_permukaan : 99;
                $acc->sistem_laluan_id = !empty($exp->sistem_laluan) ? $exp->sistem_laluan : 99;
                $acc->bentuk_jalan_id = !empty($exp->bentuk_jalan) ? $exp->bentuk_jalan : 99;
                $acc->kualiti_permukaan_id = !empty($exp->kualiti_permukaan) ? $exp->kualiti_permukaan : 99;
                $acc->keadaan_jalan_id = !empty($exp->keadaan_jalan) ? $exp->keadaan_jalan : 99;
                $acc->jenis_garis_id = !empty($exp->jenis_garis) ? $exp->jenis_garis : 99;
                $acc->langgar_lari_id = !empty($exp->langgar_lari) ? $exp->langgar_lari : 99;
                $acc->jenis_kawalan_id = !empty($exp->jenis_kawalan) ? $exp->jenis_kawalan : 99;
                $acc->lebar_jalan = $exp->lebar_jalan != '' ? $exp->lebar_jalan : null;
                // $acc->lebar_bahu_jalan = $exp->lebar_jalan != '' ? $exp->lebar_jalan : null;
                $acc->jenis_bahu_jalan_id = !empty($exp->jenis_bahu_jalan) ? $exp->jenis_bahu_jalan : 99;
                $acc->sebab_cacat_jalan_id = !empty($exp->sebab_cacat_jalan) ? $exp->sebab_cacat_jalan : 99;
                $acc->had_laju_id = !empty($exp->had_laju) ? $exp->had_laju : 99;
                $acc->muka_jalan_id = !empty($exp->muka_jalan) ? $exp->muka_jalan : 99;
                $acc->jenis_langgar_pertama_id = !empty($exp->jenis_langgar_pertama) ? $exp->jenis_langgar_pertama : 99;
                $acc->cuaca_id = !empty($exp->cuaca) ? $exp->cuaca : 99;
                $acc->cahaya_id = !empty($exp->cahaya) ? $exp->cahaya : 99;
                $acc->jenis_jalan_id = !empty($exp->jenis_jalan) && filter_var($exp->jenis_jalan, FILTER_VALIDATE_INT) === true ? $exp->jenis_jalan : 99;
                $acc->no_laluan = $exp->no_laluan != '' ? $exp->no_laluan : null;
                $acc->tempat_kejadian = $exp->tempat_kejadian != '' ? $exp->tempat_kejadian : null;
                $acc->jenis_tempat_id = !empty($exp->jenis_tempat) ? $exp->jenis_tempat : 99;
                $acc->jenis_kawasan_id = !empty($exp->jenis_kawasan) ? $exp->jenis_kawasan : 99;
                $acc->pos_kilometer = $exp->pos_kilometer != '' ? $exp->pos_kilometer : null;
                $acc->{'100_meter_hampir'} = $exp->{'100_meter_hampir'} != '' ? $exp->{'100_meter_hampir'} : null;
                $acc->sebab_binatang_id = !empty($exp->sebab_binatang) ? $exp->sebab_binatang : 99;
                $acc->anggar_rosak_kenderaan = $exp->anggar_rosak_kenderaan != '' ? $exp->anggar_rosak_kenderaan : null;
                $acc->anggar_rosak_semua = $exp->anggar_rosak_semua != '' ? $exp->anggar_rosak_semua : null;
                $acc->siri_peta = $exp->siri_peta != '' ? $exp->siri_peta : null;
                $acc->kod_peta = $exp->kod_peta != '' ? $exp->kod_peta : null;
                $acc->latitude = $newlat;
                $acc->logitude = $newlng;
                $acc->lebar_bahu_jalan_kiri = $exp->lebar_bahu_jalan_kiri != '' ? $exp->lebar_bahu_jalan_kiri : null;
                $acc->lebar_bahu_jalan_kanan = $exp->lebar_bahu_jalan_kanan != '' ? $exp->lebar_bahu_jalan_kanan : null;
                $acc->pos_dari1 = $exp->pos_dari1 != '' ? $exp->pos_dari1 : null;
                $acc->pos_dari2 = $exp->pos_dari2 != '' ? $exp->pos_dari2 : null;
                $acc->pos_km1 = $exp->pos_km1 != '' ? $exp->pos_km1 : null;
                $acc->pos_km2 = $exp->pos_km2 != '' ? $exp->pos_km2 : null;
                $acc->pos_no_sek1 = $exp->pos_no_sek1 != '' ? $exp->pos_no_sek1 : null;
                $acc->pos_jarak = $exp->pos_jarak != '' ? $exp->pos_jarak : null;
                $acc->pos_arah = $exp->pos_arah != '' ? $exp->pos_arah : null;
                $acc->pos_jarak3 = $exp->pos_jarak3 != '' ? $exp->pos_jarak3 : null;
                $acc->pos_dari3 = $exp->pos_dari3 != '' ? $exp->pos_dari3 : null;
                $acc->pos_arah3 = $exp->pos_arah3 != '' ? $exp->pos_arah3 : null;
                $acc->nod_1 = $exp->nod_1 != '' ? $exp->nod_1 : null;
                $acc->nod_2 = $exp->nod_2 != '' ? $exp->nod_2 : null;
                $acc->arah_id = !empty($exp->arah) ? $exp->arah : 99;
                $acc->nombor_seksyen = $exp->nombor_seksyen != '' ? $exp->nombor_seksyen : null;
                $acc->poskm_hampir = $exp->poskm_hampir != '' ? $exp->poskm_hampir : null;
                $acc->lakaran_kejadian = $exp->lakaran_kejadian != '' ? $exp->lakaran_kejadian : null;
                $acc->lakaran_lokasi = $exp->lakaran_lokasi != '' ? $exp->lakaran_lokasi : null;
                $acc->tarikh_pengaduan = empty($exp->tarikh_pengaduan) ? null : date_create_from_format('d/m/Y', $exp->tarikh_pengaduan)->format('Y-m-d 00:00');
                $acc->tahun = date_create_from_format('d/m/Y H:i', $newdate)->format('Y');
                $acc->bulan_id = date_create_from_format('d/m/Y H:i', $newdate)->format('n');
                $acc->disable = 'ACTIVE';
                $acc->created_by = !empty(Auth::user()->id) ? Auth::user()->id : null;
                $acc->updated_by = !empty(Auth::user()->id) ? Auth::user()->id : null;
                if ($newlat >= 1.24722 && $newlat <= 6.8837 && $newlng >= 99.8432 && $newlng <= 118.61119) {
                    //dlm msia xyah wat pape
                } else {
                    $acc->latitude = -76.300003;
                    $acc->logitude = -148.000000;
                }
                $acc->save();
                $exp->status = '';
                $exp->disable = 'INACTIVE';
                $exp->save();
            }
        }

        $up = Upload::findOrFail($id);

        $up->status = 'Sudah Diproses';
        $up->updated_by = Auth::user()->id;
        $up->save();

        return 'ok';
    }

    //View
    public function ajaxViewDataMap($id)
    {
        $rs = Accident::find($id);

        if ($rs->negeri_id != null) {
            $rs->negeri->name;
        }
        if ($rs->daerah_id != '') {
            $rs->daerah->name;
        }
        if ($rs->jenis_kemalangan_id != null) {
            $rs->jeniskemalangan->name;
        }
        if ($rs->bulan_id != null) {
            $rs->bulan->name;
        }
        if ($rs->jenis_permukaan_id != null) {
            $rs->jenisPermukaan->name;
        }
        if ($rs->keadaan_jalan_id != null) {
            $rs->keadaanJalan->name;
        }
        if ($rs->kualiti_permukaan_id != null) {
            $rs->kualitiPermukaan->name;
        }
        if ($rs->sistem_laluan_id != null) {
            $rs->sistemLaluan->name;
        }
        if ($rs->cuaca_id != null) {
            $rs->cuaca->name;
        }
        if ($rs->jenis_langgar_pertama_id != null) {
            $rs->jenisLanggarPertama->name;
        }
        if ($rs->bentuk_jalan_id != null) {
            $rs->BentukJalan->name;
        }
        if ($rs->jenis_garis_id != null) {
            $rs->JenisGaris->name;
        }
        if ($rs->muka_jalan_id != null) {
            $rs->mukaJalan->name;
        }
        if ($rs->sebab_cacat_jalan_id != null) {
            $rs->SebabCacatJalan->name;
        }
        if ($rs->cahaya_id != null) {
            $rs->cahaya->name;
        }
        if ($rs->tarikh_kejadian != null) {
            $rs['tarikh'] = date('d-m-Y H:i:s', strtotime($rs->tarikh_kejadian));
        }
        if ($rs->updated_at != null) {
            $rs['updated'] = date('d-m-Y H:i:s', strtotime($rs->updated_at));
        }
        if ($rs->updated_by != null) {
            $rs->user->fullname;
            $rs->user->department->name;
        }
       if ($rs->created_at != null) {
            $rs['created'] = date('d-m-Y H:i:s', strtotime($rs->created_at));
        }
       if ($rs->created_by != null) {
            $rs->usercreated->fullname;
            $rs->usercreated->department->name;
        }



        return $rs;
    }

    //Delete
    public function ajaxDeleteDataMap($id)
    {
        $rs = Accident::findOrFail($id);
        $userid = Auth::user()->id;

        $rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

        if ($rs->save()) {
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Data telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Data tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

    //Edit
    public function ajaxUpdateDataMap(Request $request, $id)
    {
        $rs = Accident::findOrFail($id);
        $userid = Auth::user()->id;

        $rs->latitude = $request->input('e_latitude');
        $rs->logitude = $request->input('e_longitude');
        if(!empty($request->input('e_jalan_id'))){
            $rs->jalan_id = $request->input('e_jalan_id');
        }
        $rs->nombor_seksyen = $request->input('e_nombor_seksyen');
        $rs->pos_kilometer = $request->input('e_pos_kilometer');
        $rs->updated_by = $userid;
        $rs->status = 'SAH';
        $rs->status_la='DRAF';

        $rs->save();
        $rs['status'] = 'success';
        $rs['success_form'] =   '<div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Data telah berjaya dikemaskini.
                                            </div>
                                        </div>
                                    </div>';

        return $rs;
    }

    public function populateDaerah(Request $request)
    {
        if ($request->negeri != '') {
            $rs = Daerah::where('negeri_id', $request->negeri)->get();
        } else {
            $rs = Daerah::all();
        }
        return $rs;
    }

    public function populateNolaluan(Request $request)
    {
        $rs = Accident::select('no_laluan')->where(function ($qr) use ($request) {
            if ($request->negeri && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $qr->where('negeri_id', $request->negeri);
            } else if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                $qr->where('negeri_id', Auth::user()->negeri_id);
            }
            if ($request->startdate && $request->enddate) {
                $qr->whereBetween('tarikh_kejadian', [$request->startdate, $request->enddate]);
            }
        })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        return $rs;
    }

    public function populateNolaluanBlackspot(Request $request)
    {
        $rs = Accident::select('no_laluan')->where(function ($qr) {
                $qr->where('no_laluan', 'LIKE', 'F%')
                    ->orWhere('no_laluan', '~', '^[0-9]');
            })->where(function ($qr) use ($request) {
                if ($request->negeri) {
                    $qr->where('negeri_id', $request->negeri);
                }
                if ($request->startdate && $request->enddate) {
                    $qr->whereBetween('tarikh_kejadian', [$request->startdate, $request->enddate]);
                }
            })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        return $rs;
    }

    //View
    public function ajaxViewData($id)
    {
        $rs = Accident::find($id);

        if ($rs->negeri_id != null) {
            $name = $rs->negeri->name;
        }
        if ($rs->daerah_id != '') {
            $rs->daerah->name;
        }
        if ($rs->jenis_kemalangan_id != null) {
            $rs->jeniskemalangan->name;
        }
        if ($rs->bulan_id != null) {
            $rs->bulan->name;
        }
        if ($rs->jenis_permukaan_id != null) {
            $rs->jenisPermukaan->name;
        }
        if ($rs->keadaan_jalan_id != null) {
            $rs->keadaanJalan->name;
        }
        if ($rs->kualiti_permukaan_id != null) {
            $rs->kualitiPermukaan->name;
        }
        if ($rs->sistem_laluan_id != null) {
            $rs->sistemLaluan->name;
        }
        if ($rs->cuaca_id != null) {
            $rs->cuaca->name;
        }
        if ($rs->jenis_langgar_pertama_id != null) {
            $rs->jenisLanggarPertama->name;
        }
        if ($rs->bentuk_jalan_id != null) {
            $rs->BentukJalan->name;
        }
        if ($rs->jenis_garis_id != null) {
            $rs->JenisGaris->name;
        }
        if ($rs->muka_jalan_id != null) {
            $rs->mukaJalan->name;
        }
        if ($rs->sebab_cacat_jalan_id != null) {
            $rs->SebabCacatJalan->name;
        }
        if ($rs->cahaya_id != null) {
            $rs->cahaya->name;
        }
        if ($rs->tarikh_kejadian != null) {
            $rs['tarikh'] = date('d-m-Y H:i:s', strtotime($rs->tarikh_kejadian));
        }
        if ($rs->updated_at != null) {
            $rs['updated'] = date('d-m-Y H:i:s', strtotime($rs->updated_at));
        }
        if ($rs->updated_by != null) {
            $rs->user->fullname;
            $rs->user->department->name;
        }

        return $rs;
    }

    public function laporanAwalan(Request $request)
    {
        $session_val = session('LaporanAwalan');
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'no_laporan' => null,
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? null : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => null,
                'tempat_kejadian' => null,
                'status_la' => Auth::user()->adminjkr() ? 'PENGESAHAN': null,
            ];
        }

        $nojalan= Jalan::orderBy('nolaluan')->get()->pluck('namalaluan','id');
        // dd($nojalan);
        $negeri = Negeri::pluck('name', 'id');
        if ($input['negeri']) {
            $daerah = Daerah::where('negeri_id', $input['negeri'])->pluck('name', 'id');
        } else {
            $daerah = Daerah::pluck('name', 'id');
        }

        $nolaluan = Accident::select('no_laluan')->where(function ($qr) use ($input) {
            if ($input['negeri'] && !Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) {
                $qr->where('negeri_id', $input['negeri']);
            }elseif(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){
                $qr->where('negeri_id', Auth::user()->negeri_id);
            }
        })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        $status_la = Accident::select('status_la')->groupBy('status_la')->orderBy('status_la', 'asc')->distinct()->pluck('status_la', 'status_la');


        return view(
            'site.laporanAwalan',
            [
                'session_val' => $session_val,
                'input' => $input,
                'negeri' => $negeri,
                'daerah' => $daerah,
                'nolaluan' => $nolaluan,
                'status_la' => $status_la,
                'nojalan'=>$nojalan,
            ]
        );
    }
    public function laporanAwalanPost(Request $request)
    {
        $input = $request->all();

        $accident = Accident::find($input['accident_id']);
        $accident->jenis_jalan_id = $input['jenis_jalan'];
        $accident->tempat_kejadian = $input['tempat_kejadian'];
        $accident->jalan_id = $input['jalan_id'];
        $accident->nombor_seksyen = $input['nombor_seksyen'];
        $accident->latitude = $input['latitude'];
        $accident->logitude = $input['logitude'];
        $accident->bil_pemandu_mati = $input['bil_pemandu_mati'];
        $accident->bil_penumpang_mati = $input['bil_penumpang_mati'];
        $accident->bil_pejalan_mati = $input['bil_pejalan_mati'];
        $accident->jenis_langgar_pertama_id = $input['jenis_langgar_pertama'];
        $accident->cuaca_id = $input['cuaca'];
        $accident->keadaan_jalan_id = $input['keadaan_jalan'];
        $accident->keadaan_jalan_penerangan = ($input['keadaan_jalan'] != '100') ? '' : $input['keadaan_jalan_penerangan'];
        $accident->bentuk_jalan_id = $input['bentuk_jalan'];
        $accident->bentuk_jalan_penerangan = ($input['bentuk_jalan'] != '100') ? '' : $input['bentuk_jalan_penerangan'];
        $accident->punca_kemalangan_id = $input['punca_kemalangan'];
        $accident->punca_kemalangan_penerangan = ($input['punca_kemalangan'] != '16') ? '' : $input['punca_kemalangan_penerangan'];
        $accident->updated_by = Auth::user()->id;
        $accident->status_la = 'DRAF';
        $accident->status = 'SAH';

        if ($request->hasFile('inputImage')) {
            $file = $request->inputImage;
            $img = Image::make($file)->resize(300, 150)->encode($file->extension(), 100);;
            $filename = $input['accident_id'] . '.' . $request->inputImage->extension();
            // $path = $request->inputImage->storeAs('laporanAwalan', $filename, 'public');
            // $path = $img->save(('laporanAwalan', $filename, );
            Storage::disk('public')->put('laporanAwalan/' . $filename, $img);
            $path = 'laporanAwalan/' . $filename;
            $accident->url = $path;
        }

        $accident->save();
        $kenderaan = Kenderaan::where('accident_id', $input['accident_id']);
        if (isset($input['kenderaan_id']))
            $kenderaan = $kenderaan->whereNotIn('id', $input['kenderaan_id']);
        $kenderaan = $kenderaan->delete();
        $bil_kenderaan = 0;
        if (isset($input['jenama']))
            $bil_kenderaan = count($input['jenama']);
        for ($i = 0; $i < $bil_kenderaan; $i++) {
            if (isset($input['kenderaan_id'][$i])) {
                $kenderaan = Kenderaan::find($input['kenderaan_id'][$i]);
                $kenderaan->jenama = $input['jenama'][$i];
                $kenderaan->jenis_kenderaan = $input['jenis_kenderaan'][$i];
                $kenderaan->model_kenderaan = $input['model_kenderaan'][$i];
                $kenderaan->punca_kemalangan = $input['kenderaan_punca_kemalangan'][$i];
                $kenderaan->tahun_dibuat = $input['tahun_dibuat'][$i];
                $kenderaan->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                $kenderaan->updated_by = Auth::user()->id;

                $kenderaan->save();
            } else if ($input['jenama'][$i] != '' || $input['jenis_kenderaan'][$i] != '') {
                // $kenderaan = Kenderaan::create([
                //     // 'id' => ,
                //     'eksport_id' => $input['export_id'],
                //     'accident_id' => $input['accident_id'],
                //     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                //     'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                // ]);
                $kenderaan = new Kenderaan;
                $kenderaan->eksport_id = $input['export_id'];
                $kenderaan->accident_id = $input['accident_id'];
                $kenderaan->created_at = \Carbon\Carbon::now()->toDateTimeString();
                $kenderaan->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                $kenderaan->jenama = $input['jenama'][$i];
                $kenderaan->jenis_kenderaan = $input['jenis_kenderaan'][$i];
                $kenderaan->model_kenderaan = $input['model_kenderaan'][$i];
                $kenderaan->punca_kemalangan = $input['kenderaan_punca_kemalangan'][$i];
                $kenderaan->tahun_dibuat = $input['tahun_dibuat'][$i];
                $kenderaan->updated_by = Auth::user()->id;

                $kenderaan->save();
            }
        }

        return redirect('laporanAwalan')->with(['accident_id' => $input['accident_id']]);;
    }

    public function testApi()
    {
        return view('site.testApi');
    }

    public function getLaporanAwalan(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'no_laporan' => null,
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? null : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => null,
                'tempat_kejadian' => null,
                'status_la' => null,
                's_accident_startdate' => null,
                's_accident_enddate' => null,
            ];
        }
        $laporan = Accident::query()
            ->select('accidents.*')
            ->leftJoin('negeris', 'accidents.negeri_id', 'negeris.id')
            ->leftJoin('daerahs', 'accidents.daerah_id', 'daerahs.id')
            ->leftJoin('jalans', 'accidents.jalan_id', 'jalans.id')
            ->leftJoin('jenis_kemalangans', 'accidents.jenis_kemalangan_id', 'jenis_kemalangans.id')
            ->where('jenis_kemalangan_id', 1)
            ->where(function ($query) {
                $query->where('accidents.status', 'Report24')
                    ->orWhere('accidents.status_la', '!=', 'BARU');
                   })->where(function ($query) {
                if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                    $query->where('accidents.negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    $query->whereIn('accidents.daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                }
            })->where(function ($query) use ($input) {
                if (!empty($input['no_laporan'])) {
                    $query->where('accidents.no_laporan', 'LIKE', '%' . $input['no_laporan'] . '%');
                }
                if (!empty($input['negeri'])) {
                    $query->where('accidents.negeri_id', $input['negeri']);
                }

                if (!empty($input['daerah']) && !empty($input['daerah'][0])) {
                    if (!Auth::user()->jkrdaerah()) {
                    $query->whereIn('accidents.daerah_id', $input['daerah']);
                    }
                }
                if (!empty($input['nolaluan']) && !empty($input['nolaluan'][0])) {
                    $query->whereIn('accidents.no_laluan', $input['nolaluan']);
                }
                if (!empty($input['tempat_kejadian'])) {
                    $query->where('accidents.tempat_kejadian', $input['tempat_kejadian']);
                }
                if (!empty($input['status_la'])) {
                    $query->where('accidents.status_la', $input['status_la']);
                }
                if (!empty($input['s_accident_startdate']) && !empty($input['s_accident_enddate'])) {
                    $query->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
            });

        return DataTables::of($laporan)
            ->addIndexColumn()
            ->editColumn('tarikh', function ($laporan) {
                return date('d/m/o', strtotime($laporan->tarikh_kejadian));
            })
            ->editColumn('negeri', function ($laporan) {
                return $laporan->negeri->name;
            })
            ->editColumn('daerah', function ($laporan) {
                return $laporan->daerah->name;
            })
            ->addColumn('masa', function ($laporan) {
                return date('h:i a', strtotime($laporan->tarikh_kejadian));
            })
            ->editColumn('status_la', function ($laporan) {
                if ($laporan->status_la == 'BARU')
                    return '<span class="label label-black text-12">BARU</span>';
                else if ($laporan->status_la == 'DRAF')
                    return '<span class="label label-danger text-12">DRAF</span>';
                else if ($laporan->status_la == 'PENGESAHAN')
                    return '<span class="label label-primary text-12">PENGESAHAN</span>';
                else if ($laporan->status_la == 'DISAHKAN')
                    return '<span class="label label-success text-12">DISAHKAN</span>';
                return '';
            })
            ->addColumn('jalan', function ($laporan) {
                return empty($laporan->jalan_id) ? '-' : $laporan->jalan->namalaluan;
            })
            ->addColumn('action', function ($laporan) {
                if (!Auth::user()->pengguna()) {
                    $action = '<a class="btn btn-outline btn-sm btn-primary laporan-awalan-view" data-id="' . $laporan->id . '" data-toggle="tooltip" data-placement="top" title="Papar Maklumat"><i class="fa fa-search"></i></a>
                        <a class="btn btn-outline btn-sm btn-warning laporan-awalan" data-id="' . $laporan->id . '" data-toggle="tooltip" data-placement="top" title="Kemaskini Maklumat"><i class="fa fa-edit"></i></a>';
                    if ($laporan->status_la == 'PENGESAHAN' || $laporan->status_la == 'DISAHKAN')
                        $action = '<a class="btn btn-outline btn-sm btn-primary laporan-awalan-view" data-id="' . $laporan->id . '" data-toggle="tooltip" data-placement="top" title="Papar Maklumat"><i class="fa fa-search"></i></a>';

                    return $action;
                }
            })
            ->escapeColumns([])
            ->orderColumn('tarikh', '-tarikh $1')
            ->toJson();
    }

    public function getListExport($id)
    {
        $export = Export::where('upload_id', $id);

        return DataTables::of($export)
            ->addIndexColumn()
            ->toJson();
    }

    public function getListKenderaan($id)
    {
        $kend = Kenderaan::where('accident_id', $id);

        return DataTables::of($kend)
            ->addIndexColumn()
            ->addColumn('jenis', function ($kend) {
                return $kend->jenis->name;
            })
            ->toJson();
    }

    public function ajaxlaporanawalan($id)
    {
        $action = 'kemaskini';
        session(['LaporanAwalan' => $id]);
        $LaporanAwalan = Accident::find($id);
        $LaporanAwalanPDRM = Export::find($LaporanAwalan->export_id);
        $user = User::find($LaporanAwalan->updated_by);
        $kenderaan = Kenderaan::where('accident_id', $id)->get();
        $jenis_kenderaan = JenisKenderaan::orderBy('kod')->pluck('name', 'kod');
        $jenis_jalan = JenisJalan::orderBy('id')->pluck('name', 'id');
        $jenis_langgar_pertama = JenisLanggarPertama::orderBy('id')->pluck('name', 'id');
        $cuaca = Cuaca::orderBy('id')->pluck('name', 'id');
        $bentuk_jalan = BentukJalan::orderBy('id')->pluck('name', 'id');
        $punca_kemalangan = PuncaKemalangan::orderBy('id')->pluck('name', 'id');
        $kategori_kesilapan = KategoriKesilapan::orderBy('id')->pluck('name', 'id');
        $nojalan= Jalan::orderBy('nolaluan')->get()->pluck('namalaluan','id');
        $keadaan_jalan = KeadaanJalan::/*whereIn('id', [51, 52, 53, 54, 55, 56, 99, 100])
            ->*/orderBy('id')
            ->pluck('name', 'id');
        $contents = '';
        if (Storage::disk('public')->exists($LaporanAwalan->url)) {
            $contents = Storage::disk('public')->get($LaporanAwalan->url);
        }


        return view('Form.LaporanAwalan', [
            "model" => $LaporanAwalan,
            "modelPDRM" => $LaporanAwalanPDRM,
            "jenis_jalan" => $jenis_jalan,
            "jenis_langgar_pertama" => $jenis_langgar_pertama,
            "cuaca" => $cuaca,
            "bentuk_jalan" => $bentuk_jalan,
            "punca_kemalangan" => $punca_kemalangan,
            "kategori_kesilapan" => $kategori_kesilapan,
            "keadaan_jalan" => $keadaan_jalan,
            "kenderaan" => $kenderaan,
            "jenis_kenderaan" => $jenis_kenderaan,
            "contents" => $contents,
            "action" => $action,
            "user" => $user,
            "nojalan"=>$nojalan,
        ]);
    }

    public function ajaxViewLaporanAwalan($id)
    {
        $action = 'paparan';
        session(['LaporanAwalan' => $id]);
        $LaporanAwalan = Accident::find($id);
        $LaporanAwalanPDRM = Export::find($LaporanAwalan->export_id);
        $user = User::find($LaporanAwalan->updated_by);
        $kenderaan = Kenderaan::where('accident_id', $id)->get();
        $jenis_kenderaan = JenisKenderaan::orderBy('kod')->pluck('name', 'kod');
        $jenis_jalan = JenisJalan::orderBy('id')->pluck('name', 'id');
        $jenis_langgar_pertama = JenisLanggarPertama::orderBy('id')->pluck('name', 'id');
        $cuaca = Cuaca::orderBy('id')->pluck('name', 'id');
        $bentuk_jalan = BentukJalan::orderBy('id')->pluck('name', 'id');
        $punca_kemalangan = PuncaKemalangan::orderBy('id')->pluck('name', 'id');
        $kategori_kesilapan = KategoriKesilapan::orderBy('id')->pluck('name', 'id');
        $nojalan= Jalan::orderBy('nolaluan')->get()->pluck('namalaluan','id');
        $keadaan_jalan = KeadaanJalan::/*whereIn('id', [1, 2, 51, 52, 53, 54, 55, 56, 99, 100])
            ->*/orderBy('id')
            ->pluck('name', 'id');
        $contents = '';
        if (Storage::disk('public')->exists($LaporanAwalan->url)) {
            $contents = Storage::disk('public')->get($LaporanAwalan->url);
        }


        return view('Form.LaporanAwalan', [
            "model" => $LaporanAwalan,
            "modelPDRM" => $LaporanAwalanPDRM,
            "jenis_jalan" => $jenis_jalan,
            "jenis_langgar_pertama" => $jenis_langgar_pertama,
            "cuaca" => $cuaca,
            "bentuk_jalan" => $bentuk_jalan,
            "punca_kemalangan" => $punca_kemalangan,
            "kategori_kesilapan" => $kategori_kesilapan,
            "keadaan_jalan" => $keadaan_jalan,
            "kenderaan" => $kenderaan,
            "jenis_kenderaan" => $jenis_kenderaan,
            "contents" => $contents,
            "action" => $action,
            "user" => $user,
            "nojalan"=>$nojalan,
        ]);
    }

    public function laporanAwalanHantar(Request $request)
    {
        $input = $request->all();

        $accident = Accident::find($input['accident_id']);
        $accident->jenis_jalan_id = $input['jenis_jalan'];
        $accident->tempat_kejadian = $input['tempat_kejadian'];
        $accident->no_laluan = $input['no_laluan'];
        $accident->nombor_seksyen = $input['nombor_seksyen'];
        $accident->latitude = $input['latitude'];
        $accident->logitude = $input['logitude'];
        $accident->bil_pemandu_mati = $input['bil_pemandu_mati'];
        $accident->bil_penumpang_mati = $input['bil_penumpang_mati'];
        $accident->bil_pejalan_mati = $input['bil_pejalan_mati'];
        $accident->jenis_langgar_pertama_id = $input['jenis_langgar_pertama'];
        $accident->cuaca_id = $input['cuaca'];
        $accident->keadaan_jalan_id = $input['keadaan_jalan'];
        $accident->keadaan_jalan_penerangan = ($input['keadaan_jalan'] != '100') ? '' : $input['keadaan_jalan_penerangan'];
        $accident->bentuk_jalan_id = $input['bentuk_jalan'];
        $accident->bentuk_jalan_penerangan = ($input['bentuk_jalan'] != '100') ? '' : $input['bentuk_jalan_penerangan'];
        $accident->punca_kemalangan_id = $input['punca_kemalangan'];
        $accident->punca_kemalangan_penerangan = ($input['punca_kemalangan'] != '16') ? '' : $input['punca_kemalangan_penerangan'];
        $accident->updated_by = Auth::user()->id;
        $accident->status_la = 'PENGESAHAN';
        $accident->status = 'SAH';

        if ($request->hasFile('inputImage')) {
            $file = $request->inputImage;
            $img = Image::make($file)->resize(300, 150);
            $filename = $input['accident_id'] . '.' . $request->inputImage->extension();
            // $path = $request->inputImage->storeAs('laporanAwalan', $filename, 'public');
            $path = $img->storeAs('laporanAwalan', $filename, 'public');
            $accident->url = $path;
        }

        $accident->save();
        $kenderaan = Kenderaan::where('accident_id', $input['accident_id']);
        if (isset($input['kenderaan_id']))
            $kenderaan = $kenderaan->whereNotIn('id', $input['kenderaan_id']);
        $kenderaan = $kenderaan->delete();
        $bil_kenderaan = 0;
        if (isset($input['jenama']))
            $bil_kenderaan = count($input['jenama']);
        for ($i = 0; $i < $bil_kenderaan; $i++) {
            if (isset($input['kenderaan_id'][$i])) {
                $kenderaan = Kenderaan::find($input['kenderaan_id'][$i]);
                $kenderaan->jenama = $input['jenama'][$i];
                $kenderaan->jenis_kenderaan = $input['jenis_kenderaan'][$i];
                $kenderaan->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                $kenderaan->updated_by = Auth::user()->id;

                $kenderaan->save();
            } else if ($input['jenama'][$i] != '' || $input['jenis_kenderaan'][$i] != '') {
                // $kenderaan = Kenderaan::create([
                //     // 'id' => ,
                //     'eksport_id' => $input['export_id'],
                //     'accident_id' => $input['accident_id'],
                //     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                //     'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                // ]);
                $kenderaan = new Kenderaan;
                $kenderaan->eksport_id = $input['export_id'];
                $kenderaan->accident_id = $input['accident_id'];
                $kenderaan->created_at = \Carbon\Carbon::now()->toDateTimeString();
                $kenderaan->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                $kenderaan->jenama = $input['jenama'][$i];
                $kenderaan->jenis_kenderaan = $input['jenis_kenderaan'][$i];
                $kenderaan->updated_by = Auth::user()->id;

                $kenderaan->save();
            }
        }

        $users = User::where('role_id', '4');
        $to_name = $users->pluck('fullname')->toArray();
        $to_email = $users->pluck('email')->toArray();
        $data = array(
            'level' => 'normal',
            'actionText' => 'Laporan Awalan',
            'actionUrl' => route('laporanAwalan'),
            'introLines' => array(
                'Laporan awalan berikut memerlukan perhatian pentadbir JKR'
            ),
            'tableHeader' => 'MAKLUMAT LAPORAN AWALAN',
            'tableContent' => array(
                array( 'NO LAPORAN', ': '.$accident->no_laporan),
                array( 'NEGERI', ': '.$accident->negeri->name),
                array( 'DAERAH', ': '.$accident->daerah->name),
                array( 'NO LALUAN', ': '.$accident->no_laluan),
                array( 'TEMPAT KEJADIAN', ': '.$accident->tempat_kejadian),
                array( 'TARIKH KEJADIAN', ': '.date('d/m/o', strtotime($accident->tarikh_kejadian))),
                array( 'MASA KEJADIAN', ': '.date('h:i a', strtotime($accident->tarikh_kejadian)))

            ),
            'outroLines' => array(
                ''
            ),
            'name' => $to_name,
        );
        // try {
        //     Mail::to($to_email, $to_name)
        //         ->queue(new LaporanAwalan($data));
        // } catch(\Exception $e) {
        //     // Do nothing
        // }

        return redirect('laporanAwalan')->with(['accident_id' => $input['accident_id']]);;
    }

    public function laporanAwalanSah(Request $request)
    {
        $input = $request->all();

        $accident = Accident::find($input['accident_id']);
        $accident->status_la = 'DISAHKAN';
        $accident->status = 'SAH';
        $accident->save();

        return redirect('laporanAwalan');
    }

    // EXCEL FILE DOWNLOAD
    public function laporanawalanexportexcel(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'no_laporan' => null,
                'negeri' => (!Auth::user()->jkrnegeri() && !Auth::user()->jkrdaerah()) ? null : Auth::user()->negeri_id,
                'daerah' => (!Auth::user()->jkrdaerah()) ? null : Auth::user()->daerah()->pluck('daerah_id')->toArray(),
                'nolaluan' => null,
                'tempat_kejadian' => null,
                'status_la' => null,
                's_accident_startdate' => null,
                's_accident_enddate' => null,
            ];
        }
        // dd($input);
        // DB::enableQueryLog(); // Enable query log
        $laporan = Accident::query()
            ->select('accidents.*')
            ->where('jenis_kemalangan_id', 1)
            ->where(function ($query) {
                $query->where('accidents.status', 'Report24')
                    ->orWhere('accidents.status_la', '!=', 'BARU');
            })->where(function ($query) {
                if (Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()) {
                    $query->where('accidents.negeri_id', Auth::user()->negeri_id);
                }
                if (Auth::user()->jkrdaerah()) {
                    $query->whereIn('accidents.daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                }
            })->where(function ($query) use ($input) {
                if (!empty($input['no_laporan'])) {
                    $query->where('accidents.no_laporan', $input['no_laporan']);
                }
                if (!empty($input['negeri'])) {
                    $query->where('accidents.negeri_id', $input['negeri']);
                }
                if (!empty($input['daerah']) && !empty($input['daerah'][0])) {
                    $query->whereIn('accidents.daerah_id', $input['daerah']);
                }
                if (!empty($input['nolaluan']) && !empty($input['nolaluan'][0])) {
                    $query->whereIn('accidents.no_laluan', $input['nolaluan']);
                }
                if (!empty($input['tempat_kejadian'])) {
                    $query->where('accidents.tempat_kejadian', $input['tempat_kejadian']);
                }
                if (!empty($input['status_la'])) {
                    $query->where('accidents.status_la', $input['status_la']);
                }
                if (!empty($input['s_accident_startdate']) && !empty($input['s_accident_enddate'])) {
                    $query->whereBetween('tarikh_kejadian', [date("Y-m-d", strtotime($input['s_accident_startdate'])), date("Y-m-d", strtotime($input['s_accident_enddate']))]);
                }
            })
            ->with(['negeri', 'daerah', 'jenisJalan', 'jenisLanggarPertama', 'cuaca', 'keadaanJalan', 'kategoriKesilapan'])
            ->orderBy('tarikh_kejadian',  'desc')->get();
        // dd(DB::getQueryLog()); // Show results of log
        // dd($laporan); // Show results of log
        return view('site/laporanawalanexcel', [
            'laporan' => $laporan,
        ]);
    }

    public function laporanawalantestemailnegeri()
    {
        $negeri = Negeri::pluck('name', 'id');

        foreach($negeri as $id => $name){
            $accs = null;
            $users = User::where('role_id', '4')->where('negeri_id', $id);
            $to_name = $users->pluck('fullname')->toArray();
            $to_email = $users->pluck('email')->toArray();
            $accs = Accident::query()
                ->select('accidents.*')
                ->where('jenis_kemalangan_id', 1)
                ->where(function ($query) {
                    $query->where('accidents.status', 'Report24')
                        ->orWhere('accidents.status_la', '!=', 'BARU');
                })->where(function ($query) use ($id) {
                    $query->where('accidents.negeri_id', $id);
                })->where('accidents.created_at', '<=', Carbon::now()->subDays(3)->toDateTimeString())
                ->pluck('accidents.no_laporan');

            $data = array(
                'level' => 'normal',
                'actionText' => 'Laporan Awalan',
                'actionUrl' => route('laporanAwalan'),
                'introLines' => array(
                    'Laporan awalan berikut memerlukan perhatian pentadbir JKR Negeri ' . ucfirst(strtolower($name))
                ),
                'tableHeader' => 'SENARAI LAPORAN AWALAN',
                'outroLines' => array(
                    ''
                ),
                'name' => $to_name,
                'accs' => $accs
            );
            if(!$accs->isEmpty()){
                try {
                    // Mail::to($to_email, $to_name)
                    //     ->queue(new NotiLaporanAwalan($data));
                    echo '<pre>success</pre>'. (new NotiLaporanAwalan($data))->render();
                    // $this->info('Sucess - Email Berjaya Dihantar');
                } catch(\Exception $e) {
                    // $this->info('Fail - Email Tidak Berjaya Dihantar');
                    // Do nothing
                    echo '<pre>fail - '.print_r($e,1).'</pre>';
                }

                // if($i == 0)
                //     $this->info('No New Record Added ');
                // $status='Data Telah Berjaya Disimpan.';
                // $this->info('Sucess - '.$status);
            }
        }

        $daerah = Daerah::pluck('name', 'id');

        foreach($daerah as $id => $name){
            $accs = null;
            $users = User::where('role_id', '6')->where('daerah_id', $id);
            $to_name = $users->pluck('fullname')->toArray();
            $to_email = $users->pluck('email')->toArray();
            $accs = Accident::query()
                ->select('accidents.*')
                ->where('jenis_kemalangan_id', 1)
                ->where(function ($query) {
                    $query->where('accidents.status', 'Report24')
                        ->orWhere('accidents.status_la', '!=', 'BARU');
                })->where(function ($query) use ($id) {
                    $query->where('accidents.daerah_id', $id);
                })->where('accidents.created_at', '<=', Carbon::now()->subDays(3)->toDateTimeString())
                ->orderBy('tarikh_kejadian',  'desc')
                ->pluck('accidents.no_laporan');

            $data = array(
                'level' => 'normal',
                'actionText' => 'Laporan Awalan',
                'actionUrl' => route('laporanAwalan'),
                'introLines' => array(
                    'Laporan awalan berikut memerlukan perhatian pentadbir JKR Daerah ' . ucfirst(strtolower($name))
                ),
                'tableHeader' => 'SENARAI LAPORAN AWALAN',
                'outroLines' => array(
                    ''
                ),
                'name' => $to_name,
                'accs' => $accs
            );
            if(!$accs->isEmpty()){
                try {
                    // Mail::to($to_email, $to_name)
                    //     ->queue(new NotiLaporanAwalan($data));
                    echo '<pre>success</pre>'. (new NotiLaporanAwalan($data))->render();
                    // $this->info('Sucess - Email Berjaya Dihantar');
                } catch(\Exception $e) {
                    // $this->info('Fail - Email Tidak Berjaya Dihantar');
                    // Do nothing
                    echo '<pre>fail - '.print_r($e,1).'</pre>';
                }

                // if($i == 0)
                //     $this->info('No New Record Added ');
                // $status='Data Telah Berjaya Disimpan.';
                // $this->info('Sucess - '.$status);
            }
        }
    }

    public function ajaxSahkanDataMap(Request $request, $id)
    {
        $rs = Accident::findOrFail($id);
        $userid = Auth::user()->id;

        $rs->latitude = $request->input('e_latitude');
        $rs->logitude = $request->input('e_longitude');
        if(!empty($request->input('e_jalan_id'))){
            $rs->jalan_id = $request->input('e_jalan_id');
        }
        $rs->nombor_seksyen = $request->input('e_nombor_seksyen');
        $rs->pos_kilometer = $request->input('e_pos_kilometer');
        $rs->updated_by = $userid;
        $rs->status = 'SAH';
        $rs->status_la = 'DISAHKAN';

        $rs->save();
        $rs['status'] = 'success';
        $rs['success_form'] =
            '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Data telah berjaya dikemaskini dan disahkan.
                    </div>
                </div>
            </div>';

        return $rs;
    }

    public function ajaxNamalaluan(Request $request)
    {
        $rs= Jalan::select('nolaluan','nama')->orderBy('nolaluan')
        ->where('code',$request->code)
        ->where('negeri_id',$request->negeri_id)
        ->get();
        return $rs;
    }
}
