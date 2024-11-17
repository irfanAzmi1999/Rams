<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accident;
use App\Models\Blackspot;
use App\Models\Daerah;
use App\Models\Negeri;
use Illuminate\Support\Facades\Auth;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class LampujalanController extends Controller
{
    protected $gmap;

    public function __construct(GMaps $gmap)
    {
        $this->middleware('auth');
        $this->gmap = $gmap;
    }

    public function getDistance($latitude1,$longitude1,$latitude2,$longitude2)
    {
        $earth_radius = 6371;

        $dLat = deg2rad( $latitude2 - $latitude1 );
        $dLon = deg2rad( $longitude2 - $longitude1 );

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
    }

    public function getCenterFromDegrees($data)
    {
        if (!is_array($data)) return FALSE;

        $num_coords = count($data);

        $x = 0.0;
        $y = 0.0;
        $z = 0.0;

        foreach ($data as $koord){
            $lat = $koord[0] * pi() / 180;
            $lon = $koord[1] * pi() / 180;

            $a = cos($lat) * cos($lon);
            $b = cos($lat) * sin($lon);
            $c = sin($lat);

            $x += $a;
            $y += $b;
            $z += $c;
        }

        $x /= $num_coords;
        $y /= $num_coords;
        $z /= $num_coords;

        $lon = atan2($y, $x);
        $hyp = sqrt($x * $x + $y * $y);
        $lat = atan2($z, $hyp);

        return array(
            'latitude' => $lat * 180 / pi(),
            'longitude' => $lon * 180 / pi()
        );
    }

    public function generateLampujalanData()
    {
        if(isset($_POST['tahun']) || isset($_GET['tahun'])){
            $getyear = isset($_POST['tahun']) ? $_POST['tahun'] : $_GET['tahun'];
        }else{
            $getyear = $date = date('Y');
        }

        if(isset($_POST['negeri']) || isset($_GET['negeri'])){
            $negeri = isset($_POST['negeri']) ? $_POST['negeri'] : $_GET['negeri'];
        }else{
            $negeri = 14;
        }

        if($getyear){
            $date = $getyear;
            $date2 = $date - 2;
        }

        Blackspot::where('tahun',$date)->delete();
        $rs = DB::table('accidents')
            ->select(
                'negeri_id',
                'daerah_id',
                'no_laluan',
                'pos_kilometer',
                'pos_km1',
                'pos_km2',
                'nombor_seksyen')
            ->whereBetween('tahun', [(string)$date2, (string)$date])
            ->where(function($q) use ($negeri){
                if(Auth::user()->jkrnegeri()){
                    $q->where('negeri_id', Auth::user()->negeri_id);
                }else if(Auth::user()->jkrdaerah()){
                    $q->where('negeri_id', Auth::user()->negeri_id);
                    $q->where('daerah_id', Auth::user()->daerah_id);
                }else{
                    $q->where('negeri_id', $negeri);
                }
            })
            ->where('disable', '=', 'ACTIVE')
            ->where('status', '=', 'SAH')
            ->where('no_laluan', 'LIKE', 'F%')
            ->whereRaw('latitude::numeric between 1.24722 and 6.8837')
            ->whereRaw('logitude::numeric between 99.8432 and 118.61119')
            ->groupby('no_laluan')
            ->groupby('negeri_id')
            ->groupby('daerah_id')
            ->groupby('pos_kilometer')
            ->groupby('pos_km1')
            ->groupby('pos_km2')
            ->groupby('nombor_seksyen')
            ->get();

        $spot = [];
        $a = 0;

        foreach($rs as $r){
            $a++;
            $where_accident = [
                'negeri_id' => $r->negeri_id,
                'daerah_id' => $r->daerah_id,
                'no_laluan' => $r->no_laluan,
                'pos_kilometer' => $r->pos_kilometer,
                'pos_km1' => $r->pos_km1,
                'pos_km2' => $r->pos_km2,
                'nombor_seksyen' => $r->nombor_seksyen
            ];
            $rs2 = Accident::where($where_accident)->whereBetween('tahun', [(string)$date2, (string)$date])
                ->whereRaw('latitude::numeric between 1.24722 and 6.8837')
                ->whereRaw('logitude::numeric between 99.8432 and 118.61119')
                ->where('status', '=', 'SAH')
                ->get();

            foreach($rs2 as $r2){
                $coord = [];
                foreach($rs2 as $r3){
                    $distance = self::getDistance($r2->latitude,$r2->logitude,$r3->latitude,$r3->logitude);

                    if($distance <= 0.05){
                        $coord[] = [
                            'id' => $r3->id,
                            'tahun' => $r3->tahun,
                            'latitude' => $r3->latitude,
                            'longitude' => $r3->logitude,
                            'distance' => $distance,
                            'category' => $r3->jenis_kemalangan_id,
                            'langgar_pertama' => $r3->jenis_langgar_pertama_id,
                            'detail' => [
                                'negeri' => empty($r3->negeri_id) ? NULL : $r3->negeri->name,
                                'daerah' => empty($r3->daerah_id) ? NULL : $r3->daerah->name,
                                //'balai' => empty($r3->balai_id) ? NULL : $r3->balai_id, //$r3->balai->name,
                                'no_laporan' => $r3->no_laporan,
                                'tarikh_kejadian' => empty($r3->tarikh_kejadian) ? NULL : date('d-m-Y', strtotime($r3->tarikh_kejadian)),
                                'hari' => empty($r3->hari_id) ? NULL : $r3->hari->name,
                                'bil_ken_terlibat' => empty($r3->bil_ken_terlibat) ? 0 : $r3->bil_ken_terlibat,
                                'bil_ken_rosak' => empty($r3->bil_ken_rosak) ? 0 : $r3->bil_ken_rosak,
                                'bil_pemandu_mati' => empty($r3->bil_pemandu_mati) ? 0 : $r3->bil_pemandu_mati,
                                'bil_pemandu_cedera' => empty($r3->bil_pemandu_cedera) ? 0 : $r3->bil_pemandu_cedera,
                                'bil_penumpang_mati' => empty($r3->bil_penumpang_mati) ? 0 : $r3->bil_penumpang_mati,
                                'bil_penumpang_cedera' => empty($r3->bil_penumpang_cedera) ? 0 : $r3->bil_penumpang_cedera,
                                'bil_pejalan_mati' => empty($r3->bil_pejalan_mati) ? 0 : $r3->bil_pejalan_mati,
                                'bil_pejalan_cedera' => empty($r3->bil_pejalan_cedera) ? 0 : $r3->bil_pejalan_cedera,
                                'jenis_kemalangan' => empty($r3->jenis_kemalangan_id) ? NULL : $r3->jenisKemalangan->name,
                                'jenis_permukaan' => empty($r3->jenis_permukaan_id) ? NULL : $r3->jenisPermukaan->name,
                                'sistem_laluan' => empty($r3->sistem_laluan_id) ? NULL : $r3->sistemLaluan->name,
                                'bentuk_jalan' => empty($r3->bentuk_jalan_id) ? NULL : $r3->bentukJalan->name,
                                'kualiti_permukaan' => empty($r3->kualiti_permukaan_id) ? NULL : $r3->kualitiPermukaan->name,
                                'keadaan_jalan' => empty($r3->keadaan_jalan_id) ? NULL : $r3->keadaanJalan->name,
                                'jenis_garis' => empty($r3->jenis_garis_id) ? NULL : $r3->jenisGaris->name,
                                'langgar_lari' => empty($r3->langgar_lari_id) ? NULL : $r3->langgarLari->name,
                                'jenis_kawalan' => empty($r3->jenis_kawalan_id) ? NULL : $r3->jenisKawalan->name,
                                'lebar_jalan' => empty($r3->lebar_jalan) ? 0 : $r3->lebar_jalan,
                                // 'lebar_bahu_jalan' => empty($r3->lebar_bahu_jalan) ? 0 : $r3->lebar_bahu_jalan,
                                'jenis_bahu_jalan' => empty($r3->jenis_bahu_jalan_id) ? NULL : $r3->jenisBahuJalan->name,
                                'sebab_cacat_jalan' => empty($r3->sebab_cacat_jalan_id) ? NULL : $r3->sebabCacatJalan->name,
                                'had_laju' => empty($r3->had_laju_id) ? NULL : $r3->hadLaju->name,
                                'muka_jalan' => empty($r3->muka_jalan_id) ? NULL : $r3->mukaJalan->name,
                                'jenis_langgar_pertama' => empty($r3->jenis_langgar_pertama_id) ? NULL : $r3->jenisLanggarPertama->name,
                                'cuaca' => empty($r3->cuaca_id) ? NULL : $r3->cuaca->name,
                                'cahaya' => empty($r3->cahaya_id) ? NULL : $r3->cahaya->name,
                                'jenis_jalan' => empty($r3->jenis_jalan_id) ? NULL : $r3->jenisJalan->name,
                                'no_laluan' => empty($r3->no_laluan) ? NULL : $r3->no_laluan,
                                'tempat_kejadian' => empty($r3->tempat_kejadian) ? NULL : $r3->tempat_kejadian,
                                'jenis_tempat' => empty($r3->jenis_tempat_id) ? NULL : $r3->jenisTempat->name,
                                'jenis_kawasan' => empty($r3->jenis_kawasan_id) ? NULL : $r3->jenisKawasan->name,
                                'pos_kilometer' => empty($r3->pos_kilometer) ? 0 : $r3->pos_kilometer,
                                'sebab_binatang' => empty($r3->sebab_binatang_id) ? NULL : $r3->sebabBinatang->name,
                                'anggar_rosak_kenderaan' => empty($r3->anggar_rosak_kenderaan) ? 0 : $r3->anggar_rosak_kenderaan,
                                'anggar_rosak_semua' => empty($r3->anggar_rosak_semua) ? 0 : $r3->anggar_rosak_semua,
                                'siri_peta' => empty($r3->siri_peta) ? NULL : $r3->siri_peta,
                                'kod_peta' => empty($r3->kod_peta) ? NULL : $r3->kod_peta,
                                'latitude' => empty($r3->latitude) ? NULL : $r3->latitude,
                                'logitude' => empty($r3->logitude) ? NULL : $r3->logitude,
                                'lebar_bahu_jalan_kiri' => empty($r3->lebar_bahu_jalan_kiri) ? 0 : $r3->lebar_bahu_jalan_kiri,
                                'lebar_bahu_jalan_kanan' => empty($r3->lebar_bahu_jalan_kanan) ? 0 : $r3->lebar_bahu_jalan_kanan,
                                'pos_dari1' => empty($r3->pos_dari1) ? NULL : $r3->pos_dari1,
                                'pos_dari2' => empty($r3->pos_dari2) ? NULL : $r3->pos_dari2,
                                'pos_km1' => empty($r3->pos_km1) ? 0 : $r3->pos_km1,
                                'pos_km2' => empty($r3->pos_km2) ? 0 : $r3->pos_km2,
                                'pos_no_sek1' => empty($r3->pos_no_sek1) ? NULL : $r3->pos_no_sek1,
                                'pos_jarak' => empty($r3->pos_jarak) ? 0 : $r3->pos_jarak,
                                'pos_arah' => empty($r3->pos_arah) ? NULL : $r3->pos_arah,
                                'pos_jarak3' => empty($r3->pos_jarak3) ? 0 : $r3->pos_jarak3,
                                'pos_dari3' => empty($r3->pos_dari3) ? NULL : $r3->pos_dari3,
                                'pos_arah3' => empty($r3->pos_arah3) ? NULL : $r3->pos_arah3,
                                'nod_1' => empty($r3->nod_1) ? NULL : $r3->nod_1,
                                'nod_2' => empty($r3->nod_2) ? NULL : $r3->nod_2,
                                'arah' => empty($r3->arah_id) ? NULL : $r3->arah->name,
                                'nombor_seksyen' => empty($r3->nombor_seksyen) ? NULL : $r3->nombor_seksyen,
                                'poskm_hampir' => empty($r3->poskm_hampir) ? NULL : $r3->poskm_hampir,
                                'lakaran_kejadian' => empty($r3->lakaran_kejadian) ? NULL : $r3->lakaran_kejadian,
                                'lakaran_lokasi' => empty($r3->lakaran_lokasi) ? NULL : $r3->lakaran_lokasi,
                                'tarikh_pengaduan' => empty($r3->tarikh_pengaduan) ? NULL : date('d-m-Y', strtotime($r3->tarikh_pengaduan)),
                                'tahun' => empty($r3->tahun) ? NULL : $r3->tahun,
                                'bulan' => empty($r3->bulan_id) ? NULL : $r3->bulan->name,
                            ],
                        ];
                    }
                }

                array_multisort(array_column($coord, 'tahun'),SORT_DESC,$coord);

                $spot[] = [
                    'bid' => $a,
                    'negeri' => $r2->negeri_id, //$r2->negeri->name,
                    'daerah' => $r2->daerah_id, //$r2->daerah->name,
                    'laluan' => $r->no_laluan,
                    'pos_kilometer' => $r->pos_kilometer,
                    'pos_km1' => $r->pos_km1,
                    'pos_km2' => $r->pos_km2,
                    'nombor_seksyen' => $r->nombor_seksyen,
                    'point' => $coord
                ];
            }
        }

        $blackspot = [];

        foreach($spot as $s){
            $langgar = [];
            if(count($s['point']) > 2){
                foreach($s['point'] as $p){
                    $langgar[] = $p['langgar_pertama'];
                }

                $langgar2 = array_count_values($langgar);
                $langgar3 = array_values($langgar2);
                $langgar4 = array_sum($langgar3);

                if(max($langgar3) > 2){
                    $blackspot[] = $s;
                } else if(count($langgar2) > 1 && $langgar4 > 4){
                    $blackspot[] = $s;
                }
            }
        }

        $c = 0;
        $i = 0;
        foreach($blackspot as $b){
            $c++;
            $datacoord = [];
            $year = [];
            $dataID=[];

            foreach($b['point'] as $p){
                $datacoord[] = [
                    $p['latitude'],
                    $p['longitude'],
                ];

                if($p['category'] == 1){
                    $blackspot[$i]['tahun'][$p['tahun']]['spot_maut'][] = $p['category'];
                } else if($p['category'] == 2){
                    $blackspot[$i]['tahun'][$p['tahun']]['spot_parah'][] = $p['category'];
                } else if($p['category'] == 3){
                    $blackspot[$i]['tahun'][$p['tahun']]['spot_ringan'][] = $p['category'];
                } else if($p['category'] == 4){
                    $blackspot[$i]['tahun'][$p['tahun']]['spot_rosak'][] = $p['category'];
                }

                array_push($dataID,$p['id']);
            }

            $midpoint = self::getCenterFromDegrees($datacoord);
            $blackspot[$i]['midpoint'] = $midpoint;
            $blackspot[$i]['id'] = $c;

            $j = 0;
            foreach($b['point'] as $p){
                $blackspot[$i]['point'][$j]['distance2'] = self::getDistance($midpoint['latitude'],$midpoint['longitude'],$p['latitude'],$p['longitude']);
                $blackspot[$i]['point'][$j]['blackspot_id'] = $c;
                $j++;
            }
            $blackspot[$i]['DataID']=implode(",",$dataID);
            $i++;
        }

        $k = 0; //end
        foreach($blackspot as $b){
            $m = 0;

            $countmaut = 0;
            $countparah = 0;
            $countringan = 0;
            $countrosak = 0;

            $beratmaut = 0;
            $beratparah = 0;
            $beratringan = 0;
            $beratrosak = 0;

            $pemberat = 0;

            $b['tahun'] = [];

            foreach($b['tahun'] as $n => $t){
                if($m == 0){
                    $tahunberat = 0.45;
                } else if($m == 1){
                    $tahunberat = 0.35;
                } else if($m == 2){
                    $tahunberat = 0.2;
                }

                if(array_key_exists('spot_maut',$t)){
                    $spotmaut = count($t['spot_maut']);
                } else {
                    $spotmaut = 0;
                }

                if(array_key_exists('spot_parah',$t)){
                    $spotparah = count($t['spot_parah']);
                } else {
                    $spotparah = 0;
                }

                if(array_key_exists('spot_ringan',$t)){
                    $spotringan = count($t['spot_ringan']);
                } else {
                    $spotringan = 0;
                }

                if(array_key_exists('spot_rosak',$t)){
                    $spotrosak = count($t['spot_rosak']);
                } else {
                    $spotrosak = 0;
                }

                $countmaut += $spotmaut;
                $countparah += $spotparah;
                $countringan += $spotringan;
                $countrosak += $spotrosak;

                $beratmaut += $spotmaut * $tahunberat * 6;
                $beratparah += $spotparah * $tahunberat * 4;
                $beratringan += $spotringan * $tahunberat * 2;
                $beratrosak += $spotrosak * $tahunberat * 1;

                $m++;
            }

            $blackspot[$k]['analisa']['count_maut'] = $countmaut;
            $blackspot[$k]['analisa']['count_parah'] = $countparah;
            $blackspot[$k]['analisa']['count_ringan'] = $countringan;
            $blackspot[$k]['analisa']['count_rosak'] = $countrosak;

            $blackspot[$k]['analisa']['weight_maut'] = $beratmaut;
            $blackspot[$k]['analisa']['weight_parah'] = $beratparah;
            $blackspot[$k]['analisa']['weight_ringan'] = $beratringan;
            $blackspot[$k]['analisa']['weight_rosak'] = $beratrosak;

            $pemberat += $beratmaut + $beratparah + $beratringan + $beratrosak;
            $blackspot[$k]['analisa']['pemberat'] = $pemberat;
            $blackspot[$k]['pemberat'] = $pemberat;

            $k++;
        }
        $blackspot2 = [];

        $q = '';
        foreach($blackspot as $b){
            if($b['bid'] != $q){
                $blackspot2[] = $b;
                $q = $b['bid'];
            }
        }
        foreach ($blackspot2 as $b){
            //save ke db

            $dbblackspot = new Blackspot;

            $dbblackspot -> latitude=$b['midpoint']['latitude'];
            $dbblackspot -> logitude=$b['midpoint']['longitude'];
            $dbblackspot -> tahun=$date;
            $dbblackspot -> negeri_id=$b['negeri'];
//                $dbblackspot -> jenis_langgar_pertama_id='0';
            $dbblackspot -> no_laluan=$b['laluan'];
            $dbblackspot -> pos_km1=$b['pos_km1'];
            $dbblackspot -> pos_km2=$b['pos_km2'];
            $dbblackspot -> nombor_seksyen=$b['nombor_seksyen'];
            $dbblackspot -> id_accident=$b['DataID'];
            $dbblackspot -> bil_maut=$b['analisa']['count_maut'];
            $dbblackspot -> bil_parah=$b['analisa']['count_parah'];
            $dbblackspot -> bil_ringan=$b['analisa']['count_ringan'];
            $dbblackspot -> bil_rosak=$b['analisa']['count_rosak'];
            $dbblackspot -> pemberat=$b['pemberat'];
            $dbblackspot->save();
        }
    }

    public function dataLampujalan2($input = [])
    {

        if(isset($_POST['tahun']) || isset($_GET['tahun'])){
            $getyear = isset($_POST['tahun']) ? $_POST['tahun'] : $_GET['tahun'];
        }else{
            $getyear = $date = date('Y');
        }
        if(isset($_POST['negeri']) || isset($_GET['negeri'])){
            $negeri = isset($_POST['negeri']) ? $_POST['negeri'] : $_GET['negeri'];
        }else{
            $negeri = 14;
        }
        if (empty($input)) {
            $input = [
                'negeri' => "",
                'daerah' => [],
                'nolaluan' => [],
                'tahun' => $getyear,
                'keluasan' => 50,
                'status' => 'SAH',
            ];
        }
        if(empty($input['negeri'])){
            $input['negeri'] = "";
        }
        if(empty($input['daerah'])){
            $input['daerah'] = [];
        }
        if(empty($input['nolaluan'])){
            $input['nolaluan'] = [];
        }

        $q1 = " ";
        $q4 = " ";
        $q6 = " ";
        if(!empty($input['negeri'])){
            $q1 .= "AND t1.negeri_id = " . $input['negeri'] . " ";
            $q4 .= "AND t4.negeri_id = " . $input['negeri'] . " ";
            $q6 .= "AND t6.negeri_id = " . $input['negeri'] . " ";
        }
        if(!empty($input['daerah'])){
            $q1 .= "AND t1.daerah_id IN ('" . implode("', '", $input['daerah']) . "') ";
            $q4 .= "AND t4.daerah_id IN ('" . implode("', '", $input['daerah']) . "') ";
            $q6 .= "AND t6.daerah_id IN ('" . implode("', '", $input['daerah']) . "') ";
        }
        if(!empty($input['nolaluan'])){
            $q1 .= "AND t1.no_laluan IN ('" . implode("', '", $input['nolaluan']) . "') ";
            $q4 .= "AND t4.no_laluan IN ('" . implode("', '", $input['nolaluan']) . "') ";
            $q6 .= "AND t6.no_laluan IN ('" . implode("', '", $input['nolaluan']) . "') ";
        }

        // echo '<pre>'.print_r($input).'</pre>';die();

        if(!empty($getyear)){
            $date = $getyear;
            $date2 = $date - 2;
        }else{
            $date = date('Y');
            $date2 = $date - 2;
        }

        // ! Default Query untuk status
        $query_status = "AND t1.status= 'SAH'";
        $query_status4 = "AND t4.status= 'SAH'";
        $query_status6 = "AND t6.status= 'SAH'";
        // echo phpinfo();die();
        // $input['tahun'] = '2020';
        if(isset($input['status']) && $input['status'] == "SEMUA"){
            $query_status = "
                AND (
                    t1.status='SAH'
                    OR
                    t1.status='Pol27'
                )
            ";
            $query_status4 = "
                AND (
                    t4.status='SAH'
                    OR
                    t4.status='Pol27'
                )
            ";
            $query_status6 = "
                AND (
                    t6.status='SAH'
                    OR
                    t6.status='Pol27'
                )
            ";
        }

        $keluasan = !empty($input['keluasan']) ? $input['keluasan'] : 50;

        $queryrs = "SELECT
                t1.latitude AS spot_latitude,
                t1.logitude AS spot_logitude,
                t1.geog,
                COUNT(t2.*) AS bil_spot,
                MAX(negeris.name) AS nama_negeri,
                t1.negeri_id AS spot_negeri,
                t1.daerah_id AS spot_daerah,
                t1.no_laluan AS spot_laluan,
                MAX(t1.pos_kilometer) AS spot_pos_kilometer,
                MAX(t1.pos_km1) AS spot_pos_km1,
                MAX(t1.pos_km2) AS spot_pos_km2,
                MAX(t1.nombor_seksyen) AS spot_nombor_seksyen,
                MAX(t3.bil_langgar_pertama),
                MAX(t4.bil_spot) as total
            FROM
                accidents AS t1
                LEfT JOIN (
                SELECT
                    t1.*
                FROM
                    accidents AS t1
                WHERE
                    t1.tahun BETWEEN '$date2'
                    AND '$date'
                    $q1
                    AND t1.disable = 'ACTIVE'
                    $query_status
                    -- AND t1.status= 'SAH'
                    AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
                    AND t1.in_malaysia = 1
                    AND t1.jenis_kemalangan_id NOT IN (5)
                ) t2 ON ST_DWithin ( t1.geog, t2.geog, $keluasan )
                AND t1.negeri_id = t2.negeri_id
                AND t1.daerah_id = t2.daerah_id
                AND t1.no_laluan = t2.no_laluan
            LEfT JOIN (
                SELECT
                    COUNT(t5.*) AS bil_spot,
                    t4.latitude,
                    t4.logitude,
                    t4.geog,
                    t4.negeri_id,
                    t4.daerah_id,
                    t4.no_laluan
                FROM
                    accidents AS t4
                    LEfT JOIN (
                    SELECT
                        t6.*
                    FROM
                        accidents AS t6
                    WHERE
                        t6.tahun BETWEEN '$date2'
                        AND '$date'
                        $q6
                        AND t6.disable = 'ACTIVE'
                        $query_status6
                        -- AND t6.status= 'SAH'
                        AND (t6.no_laluan LIKE'F%' OR t6.no_laluan ~ '^[0-9]')
                        AND t6.in_malaysia = 1
                        AND t6.jenis_kemalangan_id NOT IN (5)
                    ) t5 ON ST_DWithin ( t4.geog, t5.geog, 50 )
                    AND t4.negeri_id = t5.negeri_id
                    AND t4.daerah_id = t5.daerah_id
                    AND t4.no_laluan = t5.no_laluan
                WHERE
                    t4.tahun BETWEEN '$date2'
                    AND '$date'
                    $q4
                    AND t4.disable = 'ACTIVE'
                    $query_status4
                    -- AND t4.status= 'SAH'
                    AND (t4.no_laluan LIKE'F%' OR t4.no_laluan ~ '^[0-9]')
                    AND t4.in_malaysia = 1
                    AND t4.jenis_kemalangan_id NOT IN (5)
                GROUP BY
                    t4.geog, t4.latitude, t4.logitude, t4.negeri_id, t4.daerah_id, t4.no_laluan
                HAVING
                    COUNT(t5.*) > 2
                ) t4 ON t1.geog = t4.geog
                AND t1.latitude = t4.latitude
                AND t1.logitude = t4.logitude
                AND t1.negeri_id = t4.negeri_id
                AND t1.daerah_id = t4.daerah_id
                AND t1.no_laluan = t4.no_laluan
            LEFT JOIN negeris ON t1.negeri_id = negeris.id
            LEfT JOIN (
                SELECT
                MIN(t1.id) as ID,
                COUNT(t2.*) AS bil_spot,
                t1.negeri_id AS spot_negeri,
                t1.daerah_id AS spot_daerah,
                t1.no_laluan AS spot_laluan,
                MAX(t1.pos_kilometer) AS spot_pos_kilometer,
                MAX(t1.pos_km1) AS spot_pos_km1,
                MAX(t1.pos_km2) AS spot_pos_km2,
                MAX(t1.nombor_seksyen) AS spot_nombor_seksyen,
                COUNT(t2.jenis_langgar_pertama_id) AS bil_langgar_pertama
            FROM
                accidents AS t1
                LEfT JOIN (
                select
                    t1.*
                FROM
                    accidents AS t1
                WHERE
                    t1.tahun BETWEEN '$date2'
                    AND '$date'
                    $q1
                    AND t1.disable = 'ACTIVE'
                    $query_status
                    -- AND t1.status= 'SAH'
                    AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
                    AND t1.in_malaysia = 1
                    AND t1.jenis_kemalangan_id NOT IN (5)
                ) t2 ON ST_DWithin ( t1.geog, t2.geog, $keluasan )
                AND t1.negeri_id = t2.negeri_id
                AND t1.daerah_id = t2.daerah_id
                AND t1.no_laluan = t2.no_laluan
            WHERE
                t1.tahun BETWEEN '$date2'
                AND '$date'
                $q1
                AND t1.disable = 'ACTIVE'
                $query_status
                -- AND t1.status= 'SAH'
                AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
                AND t1.in_malaysia = 1
                AND t1.jenis_kemalangan_id NOT IN (5)
            GROUP BY
                t2.jenis_langgar_pertama_id ,t1.geog, t1.latitude, t1.logitude, t1.negeri_id, spot_daerah, spot_laluan
            HAVING
                COUNT(t2.jenis_langgar_pertama_id) > 2
            ) t3 on t1.id = t3.id
            WHERE
                t1.tahun BETWEEN '$date2'
                AND '$date'
                $q1
                AND t1.disable = 'ACTIVE'
                $query_status
                AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
                AND t1.in_malaysia = 1
                AND t1.jenis_kemalangan_id NOT IN (5)
                and
                (
                    t3.bil_langgar_pertama is not null or
                    t4.bil_spot > 5
                )
            GROUP BY
                t1.geog, t1.latitude, t1.logitude, t1.negeri_id, t1.daerah_id, t1.no_laluan
            HAVING
                COUNT(t2.*) > 2
            order by t1.geog";
        // $queryrs = "SELECT
        //         t1.latitude AS spot_latitude,
        //         t1.logitude AS spot_logitude,
        //         t1.geog,
        //         COUNT(t2.*) AS bil_spot,
        //         MAX(negeris.name) AS nama_negeri,
        //         t1.negeri_id AS spot_negeri,
        //         t1.daerah_id AS spot_daerah,
        //         t1.no_laluan AS spot_laluan,
        //         MAX(t1.pos_kilometer) AS spot_pos_kilometer,
        //         MAX(t1.pos_km1) AS spot_pos_km1,
        //         MAX(t1.pos_km2) AS spot_pos_km2,
        //         MAX(t1.nombor_seksyen) AS spot_nombor_seksyen
        //     FROM
        //         accidents AS t1
        //         LEfT JOIN (
        //         SELECT
        //             t1.*
        //         FROM
        //             accidents AS t1
        //         WHERE
        //             t1.tahun BETWEEN '$date2'
        //             AND '$date'
        //             $q
        //             AND t1.disable = 'ACTIVE'
        //             AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
        //             AND t1.in_malaysia = 1
        //             AND t1.jenis_kemalangan_id NOT IN (5)
        //         ) t2 ON ST_DWithin ( t1.geog, t2.geog, $keluasan )
        //         AND t1.negeri_id = t2.negeri_id
        //         AND t1.daerah_id = t2.daerah_id
        //         AND t1.no_laluan = t2.no_laluan
        //     LEFT JOIN negeris ON t1.negeri_id = negeris.id
        //     WHERE
        //         t1.tahun BETWEEN '$date2'
        //         AND '$date'
        //         $q
        //         AND t1.disable = 'ACTIVE'
        //         AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
        //         AND t1.in_malaysia = 1
        //         AND t1.jenis_kemalangan_id NOT IN (5)
        //     GROUP BY
        //         t1.geog, t1.latitude, t1.logitude, spot_negeri, spot_daerah, spot_laluan
        //     HAVING
        //         COUNT(t2.*) > 2
        //     order by
        //         t1.geog
        //         ";
        // \DB::enableQueryLog();
        $rs =  DB::select($queryrs);
        // dd(\DB::getQueryLog());
        // !! Checkpoint A
        // echo '<pre>Pengujian untuk penambahbaikan formula untuk pencapaian kelajuan yang lebih baik</pre>';die();

        // $geog = [''];
        // foreach($rs as $r){
        //     $geog[] = $r->geog;
        // }
        $geog = array_map(function ($i) {
            return $i->geog;
        }, $rs);
        $geogquery = " ";
        // if(!empty($geog))
            $geogquery = "AND t1.geog in ( '" . implode("', '",$geog) . "')";
            $queryrs2 = "SELECT
                t1.id,
                t1.negeri_id AS spot_negeri,
                t1.daerah_id AS spot_daerah,
                t1.no_laluan AS spot_laluan,
                t1.latitude AS spot_latitude,
                t1.logitude AS spot_longitude,
                t1.pos_kilometer AS spot_pos_kilometer,
                t1.pos_km1 AS spot_pos_km1,
                t1.pos_km2 AS spot_pos_km2,
                t1.nombor_seksyen AS spot_nombor_seksyen,
                t1.geog,
                t2.geog as geog_kemalangan,
                t2.id as ID,
                t2.tahun AS tahun,
                t2.latitude AS latitude,
                t2.logitude AS longitude,
                round(CAST(float8 (ST_Distance ( t1.geog, t2.geog )) as numeric),0) AS distance,
                t2.jenis_kemalangan_id AS category,
                t2.jenis_langgar_pertama_id AS langgar_pertama,
                t2.jenis_langgar_pertama_name AS langgar_pertama_name,
                t2.name_negeri AS negeri,
                t2.name_daerah AS daerah,
                t2.no_laporan AS no_laporan,
                t2.tarikh_kejadian AS tarikh_kejadian,
                t2.hari AS hari,
                (COALESCE(t2.bil_ken_terlibat, 0)) AS bil_ken_terlibat,
                (COALESCE(t2.bil_ken_rosak, 0)) AS bil_ken_rosak,
                (COALESCE(t2.bil_pemandu_mati, 0)) AS bil_pemandu_mati,
                (COALESCE(t2.bil_pemandu_cedera, 0)) AS bil_pemandu_cedera,
                (COALESCE(t2.bil_penumpang_mati, 0)) AS bil_penumpang_mati,
                (COALESCE(t2.bil_penumpang_cedera, 0)) AS bil_penumpang_cedera,
                (COALESCE(t2.bil_pejalan_mati, 0)) AS bil_pejalan_mati,
                (COALESCE(t2.bil_pejalan_cedera, 0)) AS bil_pejalan_cedera,
                t2.jenis_kemalangan AS jenis_kemalangan,
                t2.jenis_permukaan AS jenis_permukaan,
                t2.sistem_laluan AS sistem_laluan,
                t2.bentuk_jalan AS bentuk_jalan,
                t2.kualiti_permukaan AS kualiti_permukaan,
                t2.keadaan_jalan AS keadaan_jalan,
                t2.jenis_garis AS jenis_garis,
                t2.langgar_lari AS langgar_lari,
                t2.jenis_kawalan AS jenis_kawalan,
                (COALESCE(t2.lebar_jalan, '0')) AS lebar_jalan,
                t2.jenis_bahu_jalan AS jenis_bahu_jalan,
                t2.sebab_cacat_jalan AS sebab_cacat_jalan,
                t2.had_laju AS had_laju,
                t2.muka_jalan AS muka_jalan,
                t2.cuaca AS cuaca,
                t2.cahaya AS cahaya,
                t2.jenis_jalan AS jenis_jalan,
                t2.no_laluan AS no_laluan,
                t2.tempat_kejadian AS tempat_kejadian,
                t2.jenis_tempat AS jenis_tempat,
                t2.jenis_kawasan AS jenis_kawasan,
                (COALESCE(t2.pos_kilometer, '0')) AS pos_kilometer,
                t2.sebab_binatang AS sebab_binatang,
                (COALESCE(t2.anggar_rosak_kenderaan, '0')) AS anggar_rosak_kenderaan,
                (COALESCE(t2.anggar_rosak_semua, '0')) AS anggar_rosak_semua,
                t2.siri_peta AS siri_peta,
                t2.kod_peta AS kod_peta,
                t2.latitude AS latitude2,
                t2.logitude AS longitude2,
                (COALESCE(t2.lebar_bahu_jalan_kiri, '0')) AS lebar_bahu_jalan_kiri,
                (COALESCE(t2.lebar_bahu_jalan_kanan, '0')) AS lebar_bahu_jalan_kanan,
                t2.pos_dari1 AS pos_dari1,
                t2.pos_dari2 AS pos_dari2,
                (COALESCE(t2.pos_km1, '0')) AS pos_km1,
                (COALESCE(t2.pos_km2, '0')) AS pos_km2,
                t2.pos_no_sek1 AS pos_no_sek1,
                (COALESCE(t2.pos_jarak, '0')) AS pos_jarak,
                (COALESCE(t2.pos_arah, '0')) AS pos_arah,
                (COALESCE(t2.pos_jarak3, '0')) AS pos_jarak3,
                t2.pos_dari3 AS pos_dari3,
                t2.pos_arah3 AS pos_arah3,
                t2.nod_1 AS nod_1,
                t2.nod_2 AS nod_2,
                t2.arah AS arah,
                t2.nombor_seksyen AS nombor_seksyen,
                t2.poskm_hampir AS poskm_hampir,
                t2.lakaran_kejadian AS lakaran_kejadian,
                t2.lakaran_lokasi AS lakaran_lokasi,
                t2.tarikh_pengaduan AS tarikh_pengaduan,
                t2.tahun AS tahun,
                t2.bulan AS bulan,
                t2.status_la AS status_la
            FROM
                accidents AS t1
                INNER JOIN (
                SELECT
                    t1.*,
                    negeris.NAME AS name_negeri,
                    daerahs.NAME AS name_daerah,
                    haris.NAME AS hari,
                    jenis_kemalangans.NAME AS jenis_kemalangan,
                    jenis_permukaans.name AS jenis_permukaan,
                    sistem_laluans.NAME AS sistem_laluan,
                    bentuk_jalans.NAME AS bentuk_jalan,
                    kualiti_permukaans.NAME AS kualiti_permukaan,
                    keadaan_jalans.NAME AS keadaan_jalan,
                    jenis_garis.NAME AS jenis_garis,
                    langgar_laris.NAME AS langgar_lari,
                    jenis_kawalans.NAME AS jenis_kawalan,
                    jenis_bahu_jalans.NAME AS jenis_bahu_jalan,
                    sebab_cacat_jalans.NAME AS sebab_cacat_jalan,
                    had_lajus.NAME AS had_laju,
                    muka_jalans.NAME AS muka_jalan,
                    cuacas.NAME AS cuaca,
                    cahayas.NAME AS cahaya,
                    jenis_jalans.NAME AS jenis_jalan,
                    jenis_tempats.NAME AS jenis_tempat,
                    jenis_kawasans.NAME AS jenis_kawasan,
                    sebab_binatangs.NAME AS sebab_binatang,
                    arahs.NAME AS arah,
                    bulans.NAME AS bulan,
                    jenis_langgar_pertamas.NAME as jenis_langgar_pertama_name
                FROM
                    accidents AS t1
                    LEFT JOIN negeris ON t1.negeri_id = negeris.id
                    LEFT JOIN daerahs ON t1.daerah_id = daerahs.id
                    LEFT JOIN haris ON t1.hari_id = haris.id
                    LEFT JOIN jenis_kemalangans ON t1.jenis_kemalangan_id = jenis_kemalangans.id
                    LEFT JOIN jenis_permukaans ON t1.jenis_permukaan_id = jenis_permukaans.id
                    LEFT JOIN sistem_laluans ON t1.sistem_laluan_id = sistem_laluans.id
                    LEFT JOIN bentuk_jalans ON t1.bentuk_jalan_id = bentuk_jalans.id
                    LEFT JOIN kualiti_permukaans ON t1.kualiti_permukaan_id = kualiti_permukaans.id
                    LEFT JOIN keadaan_jalans ON t1.keadaan_jalan_id = keadaan_jalans.id
                    LEFT JOIN jenis_garis ON t1.jenis_garis_id = jenis_garis.id
                    LEFT JOIN langgar_laris ON t1.langgar_lari_id = langgar_laris.id
                    LEFT JOIN jenis_kawalans ON t1.jenis_kawalan_id = jenis_kawalans.id
                    LEFT JOIN jenis_bahu_jalans ON t1.jenis_bahu_jalan_id = jenis_bahu_jalans.id
                    LEFT JOIN sebab_cacat_jalans ON t1.sebab_cacat_jalan_id = sebab_cacat_jalans.id
                    LEFT JOIN had_lajus ON t1.had_laju_id = had_lajus.id
                    LEFT JOIN muka_jalans ON t1.muka_jalan_id = muka_jalans.id
                    LEFT JOIN cuacas ON t1.cuaca_id = cuacas.id
                    LEFT JOIN cahayas ON t1.cahaya_id = cahayas.id
                    LEFT JOIN jenis_jalans ON t1.jenis_jalan_id = jenis_jalans.id
                    LEFT JOIN jenis_tempats ON t1.jenis_tempat_id = jenis_tempats.id
                    LEFT JOIN jenis_kawasans ON t1.jenis_kawasan_id = jenis_kawasans.id
                    LEFT JOIN sebab_binatangs ON t1.sebab_binatang_id = sebab_binatangs.id
                    LEFT JOIN arahs ON t1.arah_id = arahs.id
                    LEFT JOIN bulans ON t1.bulan_id = bulans.id
                    LEFT JOIN jenis_langgar_pertamas ON t1.jenis_langgar_pertama_id = jenis_langgar_pertamas.id
                WHERE
                    t1.tahun BETWEEN '$date2'
                    AND '$date'
                    $q1
                    AND t1.disable = 'ACTIVE'
                    $query_status
                    -- AND t1.status= 'SAH'
                    AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
                    AND t1.in_malaysia = 1
                    AND t1.jenis_kemalangan_id NOT IN (5)
                ) t2 ON ST_DWithin ( t1.geog, t2.geog, $keluasan )
                AND t1.negeri_id = t2.negeri_id
                AND t1.daerah_id = t2.daerah_id
                AND t1.no_laluan = t2.no_laluan
            WHERE
                t1.tahun BETWEEN '$date2'
                AND '$date'
                $geogquery
                $q1
                AND t1.disable = 'ACTIVE'
                $query_status
                -- AND t1.status= 'SAH'
                AND (t1.no_laluan LIKE'F%' OR t1.no_laluan ~ '^[0-9]')
                AND t1.in_malaysia = 1
                AND t1.jenis_kemalangan_id NOT IN (5)
            order by
                t1.geog, spot_negeri, spot_daerah, spot_laluan ";
                //dd($queryrs2);
        $rs2 =  DB::select($queryrs2);
        $blackspot = [];
        $spot = [];
        $a = 0;
        // echo '<pre>'.print_r($rs2,1).'</pre>';die();
        // !! Checkpoint B
        // echo '<pre>Pengujian untuk penambahbaikan formula untuk pencapaian kelajuan yang lebih baik</pre>';
        // echo '<pre>First sample: '.count($rs).'</pre>';
        // echo '<pre>Second sample: '.count($rs2).'</pre>';
        // die();
        $blackspot2 = [];
        $q = '';
        $c = 0;
        $i = 0;
        $grouped_bs = [];
        foreach($rs2 as $index => $r2){
            $grouped_bs[$r2->geog.$r2->spot_negeri.$r2->spot_daerah.$r2->spot_laluan][] = $r2;
        }
        $no_laporan = [];
        foreach($rs as $r){
            if(
                in_array($r->geog, array_column(array_column(array_column($spot, 'point'), 'detail'), 'geog_kemalangan')) == false
            ) {
                $a++;
                $coord = [];
                foreach($grouped_bs[$r->geog.$r->spot_negeri.$r->spot_daerah.$r->spot_laluan] as $index => $r2){
                    if(in_array($r2->no_laporan, array_column(array_column($coord, 'detail'), 'no_laporan')) == false && in_array($r2->no_laporan, $no_laporan) == false) {
                        // echo '<pre>';
                        // print_r($r2->no_laluan);
                        // print_r($r2->no_laporan);
                        // echo  '</pre><br/>';
                        $no_laporan[] = $r2->no_laporan;
                        $coord[] = [
                            'id' => $r2->id,
                            'tahun' => $r2->tahun,
                            'latitude' => $r2->latitude,
                            'longitude' => $r2->longitude,
                            'distance' => $r2->distance,
                            'category' => $r2->category,
                            'langgar_pertama' => $r2->langgar_pertama,
                            'jenis_kemalangan' => $r2->langgar_pertama,
                            'negeri' => $r2->negeri,
                            'detail' => [
                                'negeri' => $r2->negeri,
                                'daerah' => $r2->daerah,
                                //'balai' => empty($r3->balai_id) ? NULL : $r3->balai_id, //$r3->balai->name,
                                'no_laporan' => $r2->no_laporan,
                                'tarikh_kejadian' => date('d-m-Y', strtotime($r2->tarikh_kejadian)),
                                'hari' => $r2->hari,
                                'bil_ken_terlibat' => $r2->bil_ken_terlibat,
                                'bil_ken_rosak' => $r2->bil_ken_rosak,
                                'bil_pemandu_mati' => $r2->bil_pemandu_mati,
                                'bil_pemandu_cedera' => $r2->bil_pemandu_cedera,
                                'bil_penumpang_mati' => $r2->bil_penumpang_mati,
                                'bil_penumpang_cedera' => $r2->bil_penumpang_cedera,
                                'bil_pejalan_mati' => $r2->bil_pejalan_mati,
                                'bil_pejalan_cedera' => $r2->bil_pejalan_cedera,
                                'jenis_kemalangan' => $r2->jenis_kemalangan,
                                'jenis_permukaan' => $r2->jenis_permukaan,
                                'sistem_laluan' => $r2->sistem_laluan,
                                'bentuk_jalan' => $r2->bentuk_jalan,
                                'kualiti_permukaan' => $r2->kualiti_permukaan,
                                'keadaan_jalan' => $r2->keadaan_jalan,
                                'jenis_garis' => $r2->jenis_garis,
                                'langgar_lari' => $r2->langgar_lari,
                                'jenis_kawalan' => $r2->jenis_kawalan,
                                'lebar_jalan' => $r2->lebar_jalan,
                                // 'lebar_bahu_jalan' => empty($r3->lebar_bahu_jalan) ? 0 : $r3->lebar_bahu_jalan,
                                'jenis_bahu_jalan' => $r2->jenis_bahu_jalan,
                                'sebab_cacat_jalan' => $r2->sebab_cacat_jalan,
                                'had_laju' => $r2->had_laju,
                                'muka_jalan' => $r2->muka_jalan,
                                //'jenis_langgar_pertama' => empty($r3->jenis_langgar_pertama_id) ? NULL : $r3->jenisLanggarPertama->name,
                                'cuaca' => $r2->cuaca,
                                'cahaya' => $r2->cahaya,
                                'jenis_jalan' => $r2->jenis_jalan,
                                'no_laluan' => $r2->no_laluan,
                                'tempat_kejadian' => $r2->tempat_kejadian,
                                'jenis_tempat' => $r2->jenis_tempat,
                                'jenis_kawasan' => $r2->jenis_kawasan,
                                'pos_kilometer' => $r2->pos_kilometer,
                                'sebab_binatang' => $r2->sebab_binatang,
                                'anggar_rosak_kenderaan' => $r2->anggar_rosak_kenderaan,
                                'anggar_rosak_semua' => $r2->anggar_rosak_semua,
                                'siri_peta' => $r2->siri_peta,
                                'kod_peta' => $r2->kod_peta,
                                'latitude' => $r2->latitude,
                                'logitude' => $r2->longitude,
                                'lebar_bahu_jalan_kiri' => $r2->lebar_bahu_jalan_kiri,
                                'lebar_bahu_jalan_kanan' => $r2->lebar_bahu_jalan_kanan,
                                'pos_dari1' => $r2->pos_dari1,
                                'pos_dari2' => $r2->pos_dari2,
                                'pos_km1' => $r2->pos_km1,
                                'pos_km2' => $r2->pos_km2,
                                'pos_no_sek1' => $r2->pos_no_sek1,
                                'pos_jarak' => $r2->pos_jarak,
                                'pos_arah' => $r2->pos_arah,
                                'pos_jarak3' => $r2->pos_jarak3,
                                'pos_dari3' => $r2->pos_dari3,
                                'pos_arah3' => $r2->pos_arah3,
                                'nod_1' => $r2->nod_1,
                                'nod_2' => $r2->nod_2,
                                'arah' => $r2->arah,
                                'nombor_seksyen' => $r2->nombor_seksyen,
                                'poskm_hampir' => $r2->poskm_hampir,
                                'lakaran_kejadian' => $r2->lakaran_kejadian,
                                'lakaran_lokasi' => $r2->lakaran_lokasi,
                                'tarikh_pengaduan' => date('d-m-Y', strtotime($r2->tarikh_pengaduan)),
                                'tahun' => $r2->tahun,
                                'bulan' => $r2->bulan,
                                'jenis_langgar_pertama' => $r2->langgar_pertama,
                                'jenis_langgar_pertama_name' => $r2->langgar_pertama_name,
                                'geog_kemalangan' => $r2->geog_kemalangan,
                                'status_la' => $r2->status_la
                            ],
                        ];
                    }
                    // echo "<pre>".print_r($coord,1)."</pre>ggggg";
                }
                array_multisort(array_column($coord, 'tahun'), SORT_DESC, array_column($coord, 'category'), SORT_ASC, $coord);
                // echo "<pre>".print_r($coord,1)."</pre>uuuuu";
                $s = [
                    'bid' => $a,
                    'negeri' => $r->spot_negeri, //$r2->negeri->name,
                    'nama_negeri' => $r->nama_negeri,
                    'daerah' => $r->spot_daerah, //$r2->daerah->name,
                    'laluan' => $r->spot_laluan,
                    'pos_kilometer' => $r->spot_pos_kilometer,
                    'pos_km1' => $r->spot_pos_km1,
                    'pos_km2' => $r->spot_pos_km2,
                    'nombor_seksyen' => $r->spot_nombor_seksyen,
                    'lat' => $r->spot_latitude,
                    'long' => $r->spot_logitude,
                    'countp'=>count($coord),
                    'point' => $coord,
                ];

                $blackspot_condition = false;
                $langgar = [];
                if(count($s['point']) > 2){
                    foreach($s['point'] as $p){
                        $langgar[] = $p['langgar_pertama'];
                    }

                    $x[1][] = $langgar2 = array_count_values($langgar);
                    $x[2][] = $langgar3 = array_values($langgar2);
                    $x[3][] = $langgar4 = array_sum($langgar3);
                    if(max($langgar3) > 2){ // langgar pertama bilangan untuk 1 jenis lebih dan sama 3
                        // $blackspot[] = $s;
                        $blackspot_condition = true;
                    } else if(count($langgar2) > 1 && $langgar4 > 4){ // bilangan jenis langgar pertama >= 2 DAN Total semua langgar pertama >= 5
                        // $blackspot[] = $s;
                        $blackspot_condition = true;
                    }
                    if($blackspot_condition){
                        $c++;
                        $datacoord = [];
                        $year = [];

                        foreach($s['point'] as $p){
                            $datacoord[] = [
                                $p['latitude'],
                                $p['longitude'],
                            ];

                            if(empty($s['tahun']))
                                $s['tahun'] = [];

                            if($p['category'] == 1){
                                $s['tahun'][$p['tahun']]['spot_maut'][] = $p['category'];
                            } else if($p['category'] == 2){
                                $s['tahun'][$p['tahun']]['spot_parah'][] = $p['category'];
                            } else if($p['category'] == 3){
                                $s['tahun'][$p['tahun']]['spot_ringan'][] = $p['category'];
                            } else if($p['category'] == 4){
                                $s['tahun'][$p['tahun']]['spot_rosak'][] = $p['category'];
                            } else if($p['category'] == 99){
                                $s['tahun'][$p['tahun']]['spot_tidak_diketahui'][] = $p['category'];
                            }

                        }

                        $midpoint = self::getCenterFromDegrees($datacoord);
                        $s['midpoint'] = $midpoint;
                        $s['id'] = $c;

                        $j = 0;
                        foreach($s['point'] as $p){
                            $s['point'][$j]['distance2'] = self::getDistance($midpoint['latitude'],$midpoint['longitude'],$p['latitude'],$p['longitude']);
                            $s['point'][$j]['blackspot_id'] = $s['id'];
                            $j++;
                        }
                        //
                        $tahunberat = 0;

                        $countmaut = 0;
                        $countparah = 0;
                        $countringan = 0;
                        $countrosak = 0;
                        $counttidakdiketahui = 0;

                        $beratmaut = 0;
                        $beratparah = 0;
                        $beratringan = 0;
                        $beratrosak = 0;
                        $berattidakdiketahui = 0;

                        $pemberat = 0;
                        foreach($s['tahun'] as $n => $t){
                            if($date == $n){
                                $tahunberat = 0.45;
                            } else if(($date-1) == $n){
                                $tahunberat = 0.35;
                            } else if(($date-2) == $n){
                                $tahunberat = 0.2;
                            }

                            if(array_key_exists('spot_maut',$t)){
                                $spotmaut = count($t['spot_maut']);
                            } else {
                                $spotmaut = 0;
                            }

                            if(array_key_exists('spot_parah',$t)){
                                $spotparah = count($t['spot_parah']);
                            } else {
                                $spotparah = 0;
                            }

                            if(array_key_exists('spot_ringan',$t)){
                                $spotringan = count($t['spot_ringan']);
                            } else {
                                $spotringan = 0;
                            }

                            if(array_key_exists('spot_rosak',$t)){
                                $spotrosak = count($t['spot_rosak']);
                            } else {
                                $spotrosak = 0;
                            }

                            if(array_key_exists('spot_tidak_diketahui',$t)){
                                $spottidakdiketahui = count($t['spot_tidak_diketahui']);
                            } else {
                                $spottidakdiketahui = 0;
                            }

                            $countmaut += $spotmaut;
                            $countparah += $spotparah;
                            $countringan += $spotringan;
                            $countrosak += $spotrosak;
                            $counttidakdiketahui += $spottidakdiketahui;

                            $beratmaut += $spotmaut * $tahunberat * 6;
                            $beratparah += $spotparah * $tahunberat * 4;
                            $beratringan += $spotringan * $tahunberat * 2;
                            $beratrosak += $spotrosak * $tahunberat * 1;
                            $berattidakdiketahui += $spottidakdiketahui * $tahunberat * 1;

                        }

                        $s['analisa']['count_maut'] = $countmaut;
                        $s['analisa']['count_parah'] = $countparah;
                        $s['analisa']['count_ringan'] = $countringan;
                        $s['analisa']['count_rosak'] = $countrosak;
                        $s['analisa']['count_tidak_diketahui'] = $counttidakdiketahui;

                        $s['analisa']['weight_maut'] = $beratmaut;
                        $s['analisa']['weight_parah'] = $beratparah;
                        $s['analisa']['weight_ringan'] = $beratringan;
                        $s['analisa']['weight_rosak'] = $beratrosak;
                        $s['analisa']['weight_tidak_diketahui'] = $berattidakdiketahui;

                        $pemberat += $beratmaut + $beratparah + $beratringan + $beratrosak + $berattidakdiketahui;
                        $s['analisa']['pemberat'] = $pemberat;
                        $s['pemberat'] = $pemberat;

                        $near_spot = false;
                        if($s['bid'] != $q){
                            foreach($blackspot2 as $spot_blackspot2){
                                $distance = self::getDistance($s['lat'],$s['long'],$spot_blackspot2['lat'],$spot_blackspot2['long']);
                                if($distance <  ($keluasan/1000)
                                && $s['negeri'] === $spot_blackspot2['negeri']
                                && $s['laluan'] === $spot_blackspot2['laluan']){
                                    $near_spot = true;
                                }
                            }
                            if(!$near_spot){
                                $blackspot2[] = $s;
                                $q = $s['bid'];
                            }
                        }
                        //
                        $i++;
                    }
                }
                $spot[] = $s;

            }
        }
       // echo "<pre>".print_r($blackspot2,1)."</pre>xxxxx";
        //dd(DB::getQueryLog()); // to be deleted
        array_multisort(array_column($blackspot2, 'pemberat'),SORT_DESC,$blackspot2);
        return $blackspot2;
    }

    public function dataReport(Request $request)
    {
        if(isset($_POST['tahun'])){
            $getyear = $_POST['tahun'];
        }else if(isset($_GET['tahun'])){
            $getyear = $_GET['tahun'];
        }else{
            $getyear = $date = date('Y');
        }
        if(empty($getyear))
            $getyear = $date = date('Y');


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'negeri' => "",
                'daerah' => [],
                'nolaluan' => [],
                'tahun' => $getyear,
                'keluasan' => 50,
            ];
        }


        $list_tahun = [];
        for($i = 0; $i<10; $i++){
            $list_tahun[date('Y') - $i] = date('Y') - $i;
        }

        // dd($request);die();
        if (!empty($input['negeri'])) {
            $zoomnegeri = Negeri::where('id', $input['negeri'])->first();
        } else {
            $zoomnegeri = '';
        }

        $negeri = Negeri::pluck('name', 'id');
        if (!empty($input['daerah'])) {
            $daerah = Daerah::where('negeri_id', $input['negeri'])->pluck('name', 'id');
        } else {
            $daerah = Daerah::pluck('name', 'id');
        }

        $nolaluan = Accident::select('no_laluan')
            ->where(function ($qr) use ($input) {
                $qr->where('no_laluan', 'LIKE', 'F%')
                    ->orWhere('no_laluan', '~', '^[0-9]');
            })->where(function ($qr) use ($input) {
                if (!empty($input['negeri'])) {
                    $qr->where('negeri_id', $input['negeri']);
                }
                if (!empty($input['tahun'])) {
                    $qr->where('tahun', $input['tahun']);
                }
            })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        $keluasan = !empty($input['keluasan']) ? $input['keluasan'] : 50;

        $filter = array();
        $filter[] = !empty($input["negeri"]) ? $input["negeri"] : '';                               //0
        $filter[] = !empty($input["daerah"]) && $input['daerah'][0] != '' ? $input["daerah"] : [];  //1
        $filter[] = !empty($input["tahun"]) ? $input["tahun"] : $getyear;                                                                //2
        $filter[] = !empty($input["nolaluan"]) ? $input["nolaluan"] : [];                           //3
        $filter[] = !empty($input["status"]) ? $input["status"] : [];                               //4

        $blackspot = [];
        //DB::enableQueryLog();
        $blackspot = self::dataLampujalan2($input);
        //dd(DB::getQueryLog());

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

        $test=[];
        foreach ($blackspot as $b){
            $test[]=[
                'id'=>$b['bid'],
                'lat'=>$b['midpoint']['latitude'],
                'long'=>$b['midpoint']['longitude'],
                'tahun'=>$b['tahun'],
                'negeri'=>$b['negeri'],
                'nama_negeri'=>$b['nama_negeri'],
                'no_laluan'=>$b['laluan'],
                'pos_km1'=>$b['pos_km1'],
                'pos_km2'=>$b['pos_km2'],
                'nombor_seksyen'=>$b['nombor_seksyen'] != ''? $b['nombor_seksyen'] : '0',
                //'jenis_langgar_pertama_id'=>$b['point']jenis_langgar_pertama,
                'bil_maut'=>$b['analisa']['count_maut'],
                'bil_parah'=>$b['analisa']['count_parah'],
                'bil_ringan'=>$b['analisa']['count_ringan'],
                'bil_rosak'=>$b['analisa']['count_rosak'],
                'bil_tidak_diketahui'=>$b['analisa']['count_tidak_diketahui'],
                'pemberat'=>$b['pemberat'],
                'Spot1'=>$b['point'],
            ];

        }

        $collection = collect($test);

        if(isset($_GET["page"])){
            //$page = $_GET['page'];
            $page = filter_var($_GET["page"], FILTER_SANITIZE_STRING);
        }else{
           $page = 1;
        }

        $perPage = 10;

        $paginate = new LengthAwarePaginator($collection->forPage($page, $perPage), $collection->count(), $perPage, $page, ['path'=>url('report')]);

        return view('site.reportlampujalan2', compact('test','map', 'negeri', 'daerah', 'nolaluan'),[
            'filter' => $filter,
            'test'=>$test,
            'pagination'=> $paginate,
            'tahun' => $getyear,
            'blackspot' => $blackspot,
            'zoomnegeri' => $zoomnegeri,
            'keluasan' => $keluasan,
            'list_tahun' => $list_tahun,
        ]);
    }

    // EXCEL FILE DOWNLOAD
    public function lampujalanexportexcel(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'negeri' => "",
                'daerah' => [],
                'nolaluan' => [],
                'tahun' => $getyear,
                'keluasan' => 50,
            ];
        }

        $blackspot = self::dataLampujalan2($input);

        return view('site/lampujalanexcelaccident', compact('blackspot'));
    }

    // CSV FILE DOWNLOAD
    public function lampujalanexportcsv(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'negeri' => "",
                'daerah' => [],
                'nolaluan' => [],
                'tahun' => $getyear,
                'keluasan' => 50,
            ];
        }

        $blackspot = self::dataLampujalan2($input);
        return view('site/lampujalancsvaccident', compact('blackspot'));
    }

    // JSON FILE DOWNLOAD
    public function lampujalanexportjson(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'negeri' => "",
                'daerah' => [],
                'nolaluan' => [],
                'tahun' => $getyear,
                'keluasan' => 50,
            ];
        }

        $blackspot = self::dataLampujalan2($input);

        return view('site/lampujalanjsonaccident',[
            'blackspot' => $blackspot
        ]);
    }

    // PDF FILE DOWNLOAD
    public function lampujalanexportpdf(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'negeri' => "",
                'daerah' => [],
                'nolaluan' => [],
                'tahun' => $getyear,
                'keluasan' => 50,
            ];
        }

        $blackspot = self::dataLampujalan2($input);

        $pdf = \PDF::loadView('site/lampujalanpdfaccident', compact('blackspot'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('Blackspot_Data_Kemalangan.pdf');
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

        if(isset($_POST['negeri']) || isset($_GET['negeri'])){
            $negeri = isset($_POST['negeri']) ? $_POST['negeri'] : $_GET['negeri'];
        }else{
            if(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah()){
                $negeri = Auth::user()->negeri_id;
            }else{
                $negeri = 14;
            }
        }


        if (!empty($request->all())) {
            $input = $request->all();
        } else {
            $input = [
                'negeri' => "",
                'daerah' => [],
                'nolaluan' => [],
                'tahun' => $getyear,
                'keluasan' => 50,
            ];
        }

        $list_tahun = [];
        for($i = 0; $i<10; $i++){
            $list_tahun[date('Y') - $i] = date('Y') - $i;
        }

        // dd($request);die();
        if (!empty($input['negeri'])) {
            $zoomnegeri = Negeri::where('id', $input['negeri'])->first();
        } else {
            $zoomnegeri = Negeri::where('id', 14)->first();
        }

        $negeri = Negeri::pluck('name', 'id');
        if (!empty($input['daerah'])) {
            $daerah = Daerah::where('negeri_id', $input['negeri'])->pluck('name', 'id');
        } else {
            $daerah = Daerah::pluck('name', 'id');
        }

        $nolaluan = Accident::select('no_laluan')
            ->where(function ($qr) use ($input) {
                $qr->where('no_laluan', 'LIKE', 'F%');
                  //  ->orWhere('no_laluan', '~', '^[0-9]');
            })->where(function ($qr) use ($input) {
                if (!empty($input['negeri'])) {
                    $qr->where('negeri_id', $input['negeri']);
                }
                if (!empty($input['tahun'])) {
                    $qr->where('tahun', $input['tahun']);
                }
            })->groupBy('no_laluan')->orderBy('no_laluan', 'asc')->distinct()->get();

        $keluasan = !empty($input['keluasan']) ? $input['keluasan'] : 50;

        $blackspot = self::dataLampujalan2($input);

        $filter = array();
        $filter[] = !empty($input["negeri"]) ? $input["negeri"] : '';                               //0
        $filter[] = !empty($input["daerah"]) && $input['daerah'][0] != '' ? $input["daerah"] : [];  //1
        $filter[] = $input["tahun"];                                                                //2
        $filter[] = !empty($input["nolaluan"]) ? $input["nolaluan"] : [];                           //3
        $filter[] = !empty($input["status"]) ? $input["status"] : [];                               //4

        return view('site.reportlampujalan3_new', compact('map', 'blackspot', 'negeri', 'daerah', 'nolaluan'), [
            'filter' => $filter,
            'zoomnegeri'=>$zoomnegeri,
            'keluasan' => $keluasan,
            'list_tahun' => $list_tahun,
        ]);
    }

    public function analisisLampujalan()
    {
        return view('site.waranLampujalan');
    }

    public function waranLampujalan()
    {
	return view('site.waranLampujalanBorang');
    }

    public function borangHantar()
    {
	abort(500, 'Internal Server Error');
    }
}