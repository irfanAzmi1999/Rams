<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF\TCPDF as TCPDF;
use App\Models\Accident;
use App\Models\BentukJalan;
use App\Models\Cuaca;
use App\Models\KeadaanJalan;
use App\Models\Kenderaan;
use App\Models\PuncaKemalangan;
use App\Models\User;

class PDFController extends Controller
{
    public function laporanAwalanPdf(Request $request){
        $input = $request->all();
        $laporanAwalan = Accident::find($input['accident_id']);
        $cuaca = Cuaca::orderBy('id')->pluck('name','id');
        $keadaan_jalan = KeadaanJalan::whereIn('id', [51,52,53,54,55,56,99,100])
                                    ->orderBy('id')
                                    ->pluck('name','id');
        $bentuk_jalan = BentukJalan::orderBy('id')->pluck('name','id');
        $punca_kemalangan = PuncaKemalangan::orderBy('id')->pluck('name','id');
        $user = User::find($laporanAwalan->updated_by);
        $html = '
        <style>
        .box {
            text-align: center;
            display: inline;
            width: 30px !important;
            border-style: solid solid solid solid;
            border-width: 2px;
        }
        .table-cuaca {
            border-spacing: 4px;
            width: 500px;
        }
        .table-keadaan-jalan {
            border-spacing: 4px;
            width: 650px;
        }
        .table-bentuk-jalan {
            border-spacing: 4px;
            width: 650px;
        }
        .table-punca-kemalangan {
            border-spacing: 4px;
            width: 600px;
        }
        .margin-rapat {
            line-height: 10px;
        }
        </style>
        <h4 style="text-align:justify;">PENYEDIAAN LAPORAN AWALAN KEMALANGAN MAUT DI ATAS JALAN PERSEKUTUAN ATAU KESESAKAN JALAN YANG TERUK
        <br/>- Memohon Maklumat Segera Daripada Jurutera Daerah JKR ( Dalam Tempoh 24 Jam)</h4>
        <hr/>
        <h4 class="margin-rapat">LAPORAN TEKNIKAL AWALAN (DALAM TEMPOH 3 HARI)</h4>
        <h4><u>Kandungan/Perkara Yang Perlu Dilaporkan</u></h4>
        <h4><u>(DIISI OLEH JURUTERA DAERAH)</u>
        <br/>Sila Isi Kotak-kotak Yang Berkenaan</h4>
        <br/>
        <ol>
            <li nobr="true">Tarikh & Masa Kemalangan : '.date('d F Y / Hi',strtotime($laporanAwalan->tarikh_kejadian)).'hrs'.'</li>
            <li nobr="true">Kategori Jalan : '.ucwords(strtolower($laporanAwalan->jenisJalan->name)).'
                <br/>
                Keterangan / Maklumat Jalan :
                <br/>
                <table>
                    <tr>
                        <td width="10%" style="text-align:right;">I.</td>
                        <td width="20%"> Nama Jalan</td>
                        <td>: '. (empty($laporanAwalan->jalan) ? $input["tempat_kejadian"] : $laporanAwalan->jalan->nama).'</td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align:right;">II.</td>
                        <td width="20%"> No. Laluan</td>
                        <td>: '.(empty($laporanAwalan->jalan) ? $input["no_laluan"] : $laporanAwalan->jalan->code.$laporanAwalan->jalan->nolaluan).'</td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align:right;">III.</td>
                        <td width="20%"> No. Seksyen</td>
                        <td>: '.$input["nombor_seksyen"].'</td>
                    </tr>
                    <tr>
                        <td width="10%" style="text-align:right;">IV.</td>
                        <td width="20%"> Koordinate</td>
                        <td>: ('.$input["latitude"].', '.$input["logitude"].')</td>
                    </tr>
                </table>
                <!--ol type="I">
                    <li>Nama Jalan : '.$input["tempat_kejadian"].'</li>
                    <li>No. Laluan : '.$input["no_laluan"].'</li>
                    <li>No. Seksyen : '.$input["nombor_seksyen"].'</li>
                    <li>Koordinate : ('.$input["latitude"].', '.$input["logitude"].')</li>
                </ol-->
            </li>
            <li nobr="true">Kendereaan Terlibat: ';
        if(!isset($input['jenama'])){
            $html .= 'Tiada Data';
        }else{
            $html .= '<table><tr><td><ol style="float: left;" type="I">';
            $bil_kenderaan = count($input['jenama']);
            for($i = 0; $i<$bil_kenderaan; $i++){
                $kenderaan = Kenderaan::find($input['kenderaan_id'][$i]);
                $html .= '<li>'.$kenderaan->jenis->name.' '.$kenderaan->jenama.'</li>';
            }
            $html .= '</ol></td></tr></table>';
        }
        $html .= '
            </li>
            <li nobr="true">Jumlah Kematian : ';
        if($input['bil_mati'] != 0)
            $html .= $input['bil_mati'].' Orang';
        else
            $html .= 'Tiada';
        $html .= '</li>
            <li nobr="true">Jenis Perlanggaran : '.ucwords(strtolower($laporanAwalan->jenisLanggarPertama->name)).'</li>
            <li nobr="true">Cuaca semasa Perlanggaran :
            <table class="table-cuaca">';

        foreach($cuaca as $key => $item){
            $html .= '
                <tr>
                    <td class="box">';
            if($key == $laporanAwalan->cuaca_id)
                $html .= 'x';
            $html .= '
                    </td>
                    <td style="text-align:justify;"> '.ucwords(strtolower($item)).'</td>
                </tr>
                ';
        }
        $html .= '</table>
            </li>
            <li nobr="true">Keadaan Jalan :
            <table class="table-keadaan-jalan">';
        foreach($keadaan_jalan as $key => $item){
            $html .= '
                <tr>
                    <td class="box">';
            if($key == $laporanAwalan->keadaan_jalan_id)
                $html .= 'x';
            $html .= '
                    </td>';
            if($key == '100'){
                $html .= '<td rowspan="3">'.ucwords(strtolower($item)).' Nyatakan: ';
                if($laporanAwalan->keadaan_jalan_id == '100')
                    $html .= '<b style="color:red">'.$laporanAwalan->keadaan_jalan_penerangan.'</b>';
            }else{
                $html .= '<td style="text-align:justify;">'.ucwords(strtolower($item));
            }
            $html .= '</td>
                </tr>
                ';
        }
        $html .= '</table>
            </li>
            <li nobr="true">Geometri Jalan :
            <table class="table-bentuk-jalan">';
        foreach($bentuk_jalan as $key => $item){
            $html .= '
                <tr>
                    <td class="box">';
            if($key == $laporanAwalan->bentuk_jalan_id)
                $html .= 'x';
            $html .= '
                    </td>';
            if($key == '100'){
                $html .= '<td rowspan="3">'.ucwords(strtolower($item)).' Nyatakan: ';
                if($laporanAwalan->bentuk_jalan_id == '100')
                    $html .= '<b style="color:red">'.$laporanAwalan->bentuk_jalan_penerangan.'</b>';
            }else{
                $html .= '<td style="text-align:justify;">'.ucwords(strtolower($item));
            }
            $html .= '</td>
                </tr>
                ';
        }
        $html .= '</table>
            </li>
            <li nobr="true">Punca Kemalangan :
            <table class="table-punca-kemalangan">';
        foreach($punca_kemalangan as $key => $item){
            $html .= '
                <tr>
                    <td class="box">';
            if($key == $laporanAwalan->punca_kemalangan_id)
                $html .= 'x';
            $html .= '
                    </td>';
            if($key == '100'){
                $html .= '<td rowspan="3">'.ucwords(strtolower($item)).' Nyatakan: ';
                if($laporanAwalan->punca_kemalangan_id == '100')
                    $html .= '<b style="color:red">'.$laporanAwalan->punca_kemalangan_penerangan.'</b>';
            }else{
                $html .= '<td style="text-align:justify;">'.ucwords(strtolower($item));
            }
            $html .= '</td>
                </tr>
                ';
        }
        $html .= '</table>
            </li>
            <li nobr="true">Gambar Lokasi Kemalangan : ';
        if(empty($laporanAwalan->url)){
            $html .= 'Tiada Gambar';
        }else{
            $gambar = '../public/storage/'.$laporanAwalan->url;
            $html .= '<table><tr><td><img src="'.$gambar.'" width="300" height="150" /></td></tr></table>';
        }
        $html .= '</li>
            <li nobr="true">Disediakan oleh :
            <table>
                <tr>
                    <td>'.strtoupper($user->fullname).'</td>
                </tr>
                <tr>
                    <td>'.strtoupper($user->getFullnameJawatan()).'</td>
                </tr>
                <tr>
                    <td>'.strtoupper($laporanAwalan->updated_at->format('d F Y')).'</td>
                </tr>
            </table>
            </li>
        <ol/>';
        new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        TCPDF::SetTitle('Laporan Awalan 24 Jam');
        TCPDF::SetMargins(20, 40, 20);
        TCPDF::AddPage();
        TCPDF::writeHTML($html, true, false, true, false, '');
        TCPDF::Output('Laporan Awalan 24 Jam '.$laporanAwalan->no_laporan.'.pdf', 'I');
    }
}
