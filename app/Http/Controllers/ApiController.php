<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\Daerah;
use App\Models\Export;
use App\Models\Negeri;
use App\Models\Upload;
use App\Models\Kenderaan;
use Illuminate\Http\Request;

class ApiController extends Controller{

    const restPdrm='http://10.8.188.95/iPrsKkrService/Kkr.svc/rest/';
    const token='D37984B3-8BE7-48C5-ADB0-6712E93F1DE0';

//test api
    public function test_raw_api($action,$startdate=null,$enddate){
        if($action==1){
            $url='http://10.8.188.95/iPrsKkrService/Kkr.svc/rest/Get24Report';
            $data = [
                "header" => [
                    "latitude" => "",
                    "longitude" => "",
                    "machineId" => "",
                    "noBadan" => "",
                    "requestId" => "1",
                    "token" => self::token
                ],
                "negeri" => 'placeholder',
//                "negeri" => '12',
                "tarikhrepot"=>$enddate ,
            ];
        }
        else if($action==2){
            $url='http://10.8.188.95/iPrsKkrService/Kkr.svc/rest/GetPol27';
            $data = [
                "header" => [
                    "latitude" => "",
                    "longitude" => "",
                    "machineId" => "",
                    "noBadan" => "",
                    "requestId" => "1",
                    "token" =>self::token
                ],
                "negeri" => 'placeholder',
                "searchBy" => 1,
                "searchByDate" =>2,
                "nolaporan"=>'',
                "startDate" => $startdate,
                "endDate"=>$enddate,
            ];


        }
        else{
            return 'Fail Job';
        }
        $negeri = Negeri::pluck('id')->all();


        $result=[];
       foreach($negeri as $n){
           $data['negeri']=$n;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "content-type: application/json",
            ]);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $response = json_decode(curl_exec($ch),true);
            print_r($data);
echo json_encode($response);
            if($response){
                foreach ($response['detail'] as $responses){
//                    if($responses){
                        $responses['negeri']=$n;
                        array_push($result,$responses);
//                    }
                }
            }

       }
        return '<pre>'.print_r($result,1).'</pre>';

    }
        public function test_raw_api_rp24($enddate){
                $url='http://10.8.188.95/iPrsKkrService/Kkr.svc/rest/Get24Report';
                $data = [
                    "header" => [
                        "latitude" => "",
                        "longitude" => "",
                        "machineId" => "",
                        "noBadan" => "",
                        "requestId" => "123",
                        "token" => self::token
                    ],
//                "negeri" => 'placeholder',
                    "negeri" => '18',
                    "tarikhrepot"=>$enddate ,
                ];

            $result=[];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "content-type: application/json",
                ]);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                $response = json_decode(curl_exec($ch),true);




            return '<pre>'.print_r($response,1).'</pre>';

        }
    //$a=1 is for not status
    //$a=0 is for function that need status
    public function pol27ByDateGet($startDate1=null,$endDate=null){
        return self::pol27ByDate($startDate1,$endDate,1);
    }

    public function pol27ByDatePost(Request $request,$startDate1=null,$endDate=null){
        $startDate=$request->input('startDate1');
        $endDate=$request->input('endDate');

//        return 'success';
        return self::pol27ByDate($startDate,$endDate);
    }
//    $a value adalah value api ataupun post data
    public function pol27ByDate($startDate=null,$endDate=null,$a=0){
        //pol27 search tarikh kejadian
//        echo '<pre>'.print_r($startDate.' | '.$endDate,1).'</pre>';die();
        $action='GetPol27';
        $jenis='Pol27';
        if(empty($startDate)&&empty($endDate)){
//            $endDate=date("Y-m-d");
            $endDate='2020-01-20';

            $startDate=date("Y-m-d",strtotime("-14 days"));
            $startDate='2020-01-01';
	//$endDate=date("Y-m-d",strtotime("+1 days"));
        }


        $data = [
            "header" => [
                "latitude" => "",
                "longitude" => "",
                "machineId" => "",
                "noBadan" => "",
                "requestId" => "1",
                "token" =>self::token
            ],
            "negeri" => 'placeholder',
            "searchBy" => 1,
            "searchByDate" =>1,
            "startDate" => $startDate,
            "endDate"=>$endDate,

        ];

        return self::apiPdrm($action,$data,$jenis,$a);

    }
    public function pol27ByNoLaporan(Request $request){
        //serching pol27 by manual no laporan
        $jenis='Pol27';
        $nolaporan=$request->input('noLaporan');
//          $nolaporan=$request->request['noLaporan'];

        $action='GetPol27';
        $data = [
            "header" => [
                "latitude" => "",
                "longitude" => "",
                "machineId" => "",
                "noBadan" => "",
                "requestId" => "1",
                "token" => self::token
            ],
            "negeri" => 'placeholder',
            "searchBy" => 0,
            "nolaporan"=>$nolaporan,
        ];

        return self::apiPdrm($action,$data,$jenis,1);
    }
    public function report24ByDate($date=null){
            return self::report24($date,1);
    }
    public function report24Post(Request $request){
        //manual search 24jam
        $tarikhrepot=$request->input('startDate');
        return self::report24($tarikhrepot);
    }
    public function report24($tarikhrepot=null,$a=0){
        //report 24 jam
        $action='Get24Report';
        $jenis='Report24';
        if(empty($tarikhrepot)){
            $tarikhrepot=date("Y-m-d",strtotime("-1 days"));
//            $tarikhrepot=date("Y-m-d");
        }

        $data = [
            "header" => [
                "latitude" => "",
                "longitude" => "",
                "machineId" => "",
                "noBadan" => "A1",
                "requestId" => "1",
                "token" => self::token
            ],
            "negeri" => 'placeholder',
//            "tarikhrepot"=>$tarikhrepot,
            "tarikhrepot"=>$tarikhrepot ,
            'startDate'=>$tarikhrepot,
        ];

        return self::apiPdrm($action,$data,$jenis,$a);
    }
    public function apiPdrm($action,$data,$jenis,$a){
        //api pdrm

        $i=0;
        $negeri = Negeri::pluck('id')->all();
//        return $negeri;
        $result=[];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "content-type: application/json",
        ]);

        if($jenis=='Pol27'){
            $startDate=$data['startDate']? $data['startDate'] : ' ';
            $endDate=$data['endDate']? $data['endDate'] : ' ';
        }
        else{
            $startDate=$data['startDate']? $data['startDate'] : ' ';
            $endDate=null;
        }
        foreach($negeri as $n){
            $url = self::restPdrm.$action;
            $data['header']['requestId']=substr(md5(getdate()[0].$i.$n),0,20);
            $i++;
            $data['negeri']=$n;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "content-type: application/json",
            ]);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $response = json_decode(curl_exec($ch),true);

if($response){
            foreach ($response['detail'] as $responses){

                $responses['requestId']=$response['header']['requestId'];
                $responses['negeri']=$n;
                array_push($result,$responses);
            }
            }
        }
//        return $endDate;
//        return '<pre>'.print_r($result,1).'</Pre>';
        return self::importApi($result,$jenis,$a,$startDate,$endDate);
    }
        public function importApi($result,$jenis,$a,$startDate=null,$endDate=null){
//            return $endDate;
//$jenis='Report24';
//$jenis='Pol27';

            //This will process report24
            if($jenis=='Report24') {

                $up = new Upload;
                $up->status = 'testApi';
                $up->name = 'Api_report24' . '_' .$startDate;
                $up->status = 'Gagal';
                $up->size = 0;
                $up->disable = 'INACTIVE';
                $up->created_by = 1;
                $up->updated_by = 1;
                $up->save();
//                foreach ($result as $date) {
                    foreach ($result as $detail) {

                        $export= new Export;
                        $export->negeri=$detail['negeri'];
                        $export->daerah=$detail['negeri'].$detail['daerah'];
                        $export->bentuk_jalan=$detail['bentuk_jalan'];
                        $export->bil_ken_terlibat=$detail['bil_kenderaan_terlibat'];
                        $export->bil_pejalan_mati=$detail['bil_pejalankaki_mati'];
                        $export->bil_pemandu_mati=$detail['bil_pemandu_mati'];
                        $export->bil_penumpang_mati=$detail['bil_penumpang_mati'];
                        $export->jenis_kemalangan=1;
                        $export->cuaca=$detail['cuaca'];
                        $export->jenis_langgar_pertama=$detail['jenis_langgar_pertama'];
                        $export->kualiti_permukaan=$detail['kualiti_permukaan'];
                        $export->masa=$detail['masa_kejadian'];
                        $export->masa_aduan=$detail['masarepot'];
                        $export->muka_jalan=$detail['muka_jalan'];
                        $export->no_laluan=$detail['no_laluan'];
                        $export->no_laporan=$detail['no_laporan'];
                        $export->nombor_seksyen=$detail['pos_no_sek'];
                        $export->tarikh_kejadian=$detail['tarikh_kejadian'];
                        $export->tarikh_pengaduan=$detail['tarikhrepot'];
                        $export->upload_id=$up->id;
                        $export->jenis=$jenis;
                        $export->requestid=$detail['requestId'];
                        $export->kategori_kesilapan=$detail['kategori_kesilapan'];
                        $export->latitude=$detail['latitute'];
                        $export->logitude=$detail['longitute'];
                        $export->kenderaan=json_encode($detail['kenderaan']);



			$up->status = 'Berjaya';
                        $up->disable = 'ACTIVE';
                        $up->save();
                        //MIGRATE TO ACC

                    }

//                }
                if (empty($result)) {
                    if($a=0){
                        $up->status = 'Berjaya-tiada data baru';
                        $up->disable = 'ACTIVE';
                        $up->save();
                        $status='Data Kosong.';
                        return self::status($status);
                    }
                    else{
                        return 'empty';
                    }

                }

                return self::migrateApiData($up->id,$a,$jenis);

            }
            if($jenis=='Pol27') {
                $up = new Upload;
                $up->status = 'testApi';
                $up->name = 'Api_Pol27' . '_' .$startDate.'_'.$endDate;
                $up->status = 'Gagal';
                $up->size = 0;
                $up->disable = 'INACTIVE';
                $up->created_by = 1;
                $up->updated_by = 1;
                $up->save();
                    foreach ($result as $detail) {
                        $export = new Export;
                        $export->kenderaan=json_encode($detail['kenderaan']);
//                        return $export->kenderaan;
                        $export->negeri=$detail['negeri'];
                        $export->daerah=$detail['negeri'].$detail['daerah'];
                        $export->balai=$detail['balai'];
                        $export->no_laporan=$detail['no_laporan'];
                        $export->tarikh_kejadian=$detail['tarikh_kejadian'];

//                        $export->tarikh_kejadian=date( strtotime($detail['tarikh_kejadian']));
                        $export->masa=date("H:i", strtotime($detail['masa']));
//                        return 'test1';ok
                        $export->hari=$detail['hari'];
                        $export->bil_ken_terlibat=$detail['bil_kenderaan_terlibat'];
                        $export->bil_ken_rosak=$detail['bil_kenderaan_rosak'];
                        $export->bil_pemandu_mati=$detail['bil_pemandu_mati'];
                        $export->bil_pemandu_cedera=$detail['bil_pemandu_cedera'];
                        $export->bil_penumpang_mati=$detail['bil_penumpang_mati'];
                        $export->bil_pejalan_mati=$detail['bil_pejalankaki_mati'];
                        $export->bil_pejalan_cedera=$detail['bil_pemandu_cedera'];
                        $export->jenis_kemalangan=$detail['jenis_kemalangan'];
                        $export->jenis_permukaan=$detail['jenis_permukaan'];
                        $export->sistem_laluan=$detail['sistem_lalulintas'];
                        $export->bentuk_jalan=$detail['bentuk_jalan'];
                        $export->kualiti_permukaan=$detail['kualiti_permukaan'];
                        $export->keadaan_jalan=$detail['keadaan_jalan'];
                        $export->jenis_garis=$detail['jenis_garis'];
                        $export->langgar_lari=$detail['langgar_lari'];
                        $export->jenis_kawalan=$detail['jenis_kawalan'];
                        $export->lebar_jalan=$detail['lebar_jalan'];
                        $export->jenis_bahu_jalan=$detail['jenis_bahu_jalan'];
                        $export->sebab_cacat_jalan=$detail['sebab_kecacatan_jalan'];
                        $export->had_laju=$detail['had_laju'];
                        $export->muka_jalan=$detail['keadaan_permukaan'];
                        $export->jenis_langgar_pertama=$detail['jenis_langgar_pertama'];
                        $export->cuaca=$detail['jenis_cuaca'];
                        $export->cahaya=$detail['jenis_cahaya'];
                        $export->jenis_jalan=$detail['jenis_jalan'];
                        $export->no_laluan=$detail['no_laluan'];
                        $export->tempat_kejadian=$detail['tempat_kejadian'];
                        $export->jenis_tempat=$detail['jenis_tempat'];
                        $export->jenis_kawasan=$detail['jenis_kawasan'];
                        $export->pos_kilometer=$detail['poskm'];
                        $export->{'100_meter_hampir'}=$detail['_100_meter_terhampir'];
                        $export->sebab_binatang=$detail['sebab_binatang'];
                        $export->anggar_rosak_kenderaan=$detail['anggaran_rosak_kenderaan'];
                        $export->anggar_rosak_semua=$detail['anggaran_rosak_hartabenda'];
                        $export->siri_peta=$detail['no_siri_peta'];
                        $export->kod_peta=$detail['kod_peta'];
                        $export->latitude=$detail['latitute'];
                        $export->logitude=$detail['longitute'];
                        $export->lebar_bahu_jalan_kiri=$detail['lebar_bahu_jalan1'];
                        $export->lebar_bahu_jalan_kanan=$detail['lebar_bahu_jalan2'];
                        $export->pos_dari1=$detail['pos_dari1'];
                        $export->pos_dari2=$detail['pos_dari2'];
                        $export->pos_km1=$detail['pos_km1'];
                        $export->pos_km2=$detail['pos_km2'];
//                        $export->pos_no_sek1='null';//pos no seksyen1 digunakan untuk no_seksyen
                        $export->pos_jarak=$detail['pos_jarak'];
                        $export->pos_arah=$detail['pos_arah'];
                        $export->pos_jarak3=$detail['pos_jarak3'];
                        $export->pos_dari3=$detail['pos_dari3'];
                        $export->pos_arah3=$detail['pos_arah3'];
                        $export->nod_1=$detail['nod1'];
                        $export->nod_2=$detail['nod2'];
                        $export->arah=$detail['arah'];
                        $export->nombor_seksyen=$detail['pos_no_sek1'];
                        $export->tarikh_cipta_pol27=$detail['tarikh_cipta_pol27'];
                        $export->jenis=$jenis;
                        $export->kategori_kesilapan=$detail['kategori_kesilapan'];
//                        return 'test3';ok
//                    $export->poskm_hampir=$detail[''];
//                    $export->lakaran_kejadian=$detail['daerah'];
//                    $export->lakaran_lokasi=$detail['daerah'];


                        $export->tarikh_pengaduan=$detail['tarikh_pengaduan'];
//                        echo $detail['tarikh_cipta_pol27']." ".date("d/m/Y", strtotime($detail['tarikh_cipta_pol27']))." ".$export->tarikh_cipta_pol27;die();

                        $export->upload_id=$up->id;
                        $export->created_by=1;
                        $export->disable='ACTIVE';
                        $export->requestid=$detail['requestId'];
                        $export->save();
                      $up->status = 'Berjaya';
                      $up->disable = 'ACTIVE';
                    $up->save();
                    }


                if (empty($result)) {
                    if($a=0){
                        $up->status = 'Berjaya-tiada data baru';
                        $up->disable = 'ACTIVE';
                        $up->save();
                        $status='Data Kosong.';
                        return self::status($status);
                    }
                    else{
                        return 'empty';
                    }

                }
                return self::migrateApiData($up->id,$a,$jenis);
            }
            return 'success';
        }
        public function migrate($id){
            $export = Export::where('upload_id', $id)->pluck('id');
            foreach ($export as $ex) {
                $exp = Export::findorfail(435615);
                $acc = Accident::firstOrNew(['no_laporan' => intval($exp->no_laporan)]);



                $acc->save();
            }

        }
        public function migrateApiData($id,$a,$jenis)
        {

            //Latitude from 1.24722 to 6.8837 and longitude from 99.8432 to 118.61119 = MALAYSIA
            $export = Export::where('upload_id', $id)->pluck('id');
//            return $export;
            foreach ($export as $ex) {
                $exp = Export::findorfail($ex);
                $acc = Accident::firstOrNew(['no_laporan' => intval($exp->no_laporan)]);
//                echo "<pre>".print_r($acc,1)."</pre>";die();
                //status sah
            if (!($acc->exists) || ($acc->exists && $acc->status != 'SAH' &&  $acc->status != 'Pol27' )) {
                    $newdate = strtotime($exp->tarikh_kejadian . ' ' . str_pad($exp->masa, 4, '0', STR_PAD_LEFT));
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
                    $acc->balai_id = !empty($exp->balai) ? $exp->balai : 99;
                    $acc->no_laporan = $exp->no_laporan != '' ? (float)$exp->no_laporan : null;

                    $acc->tarikh_kejadian = date('d-m-Y H:i', $newdate);

//                    return $acc->tarikh_kejadian;
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
                    $acc->tempat_kejadian = $exp->tempat_kejadian != '' ? $exp->tempat_kejadian : 'Tiada Data';
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
                    $acc->tarikh_pengaduan = empty($exp->tarikh_pengaduan) ? date('d-m-Y',$newdate) : date('d-m-Y', strtotime($exp->tarikh_pengaduan));
                    $acc->tahun = date('Y', $newdate);
                    $acc->bulan_id = date('m', $newdate);
                    $acc->status = 'baru';
                    $acc->disable = 'ACTIVE';
                    $acc->created_by = 1;
                    $acc->updated_by = 1;
                    $acc->status = $jenis;
//                    echo $exp->tarikh_cipta_pol27;die();
                        if($jenis=='Report24'){
                        $acc->tarikh_cipta_pol27=null;
                        }else{
                            $acc->tarikh_cipta_pol27=date("d-m-Y H:i:s", strtotime(str_replace('/', '-',$exp->tarikh_cipta_pol27)));;
                        }
                    $acc->punca_kemalangan_id = $exp->kategori_kesilapan ? $exp->kategori_kesilapan : null;

                    if ($newlat >= 1.24722 && $newlat <= 6.8837 && $newlng >= 99.8432 && $newlng <= 118.61119) {
                        //dlm msia xyah wat pape
                    } else {
                        $acc->latitude = -76.300003;
                        $acc->logitude = -148.000000;
                    }
                    $acc->save();
//                    $exp->status='';
                    $exp->disable = 'INACTIVE';
                    $exp->save();
                        Kenderaan::where('accident_id', $acc->id)->delete();
//                    echo "<pre>".print_r(json_decode($exp->kenderaan),1)."</pre>";die();
                        foreach (json_decode($exp->kenderaan) as $kende) {
                            $kenderaan = new Kenderaan;
                            $kenderaan->eksport_id = $exp->id;
                            $kenderaan->accident_id = $acc->id;
                            $kenderaan->jenama = $kende->c_jenama;
                            $kenderaan->jenis_kenderaan = $kende->c_jenis_kenderaan;
                            $kenderaan->model_kenderaan = $kende->c_model_kenderaan;
                            $kenderaan->punca_kemalangan = $kende->c_punca_kemalangan;
                            $kenderaan->tahun_dibuat = $kende->c_tahun_dibuat;
                            $kenderaan->save();
//                        $kenderaan->created_by=1;
                        }
                }
            }
//            return $id;
            $up = Upload::findOrFail($id);
            $up->status = 'Sudah Diproses';
            $up->updated_by = 1;
            $up->save();

            if($a==0){
                $status='Data Telah Berjaya Disimpan.';
                return self::status($status);
            }
            return 'success';
//            return Response::json(array('status'=>'ok'));


        }

        public function status($status){
            $data['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    '."$status".'
                                                </div>
                                            </div>
                                        </div>';
            return $data;
        }

}
