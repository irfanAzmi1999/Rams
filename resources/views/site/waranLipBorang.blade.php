@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Analisis Waran Lampu Isyarat Di Persimpangan</h2>
        <ol class="breadcrumb">
            <li>
                Lampu Isyarat Di Persimpangan
            </li>
            <li>
                Borang Waran
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <form>
                
                <!-- 1. MAKLUMAT LOKASI -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="font-bold text-16">PEJABAT</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Pejabat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="negeri" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Rujukan Surat</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="daerah" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Disediakan Oleh</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nombor_laluan" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Tarikh</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input id="tarikh-surat" name="tarikh_surat" type="text" class="form-control" value="01/10/2024">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- UMUM -->
                <div class="row">
                    <div class="col-md-2 font-bold text-16">UMUM</div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><span class="label label-success">A</span> Rujukan Surat Pemohon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="rujukan_surat_pemohon" class="form-control" style="background-color: ghostwhite;">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><span class="label label-success">B</span> Pemohon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pemohon" class="form-control" style="background-color: ghostwhite;">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><span class="label label-success">C</span> Tajuk Permohonan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tajuk_permohonan" class="form-control" style="background-color: ghostwhite;">
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- 1. MAKLUMAT LOKASI -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">1</span></div> 
                        <div class="font-bold text-16">MAKLUMAT LOKASI</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">D</span> Negeri</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="negeri" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">E</span> Daerah</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="daerah" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">F</span> Latitude</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="latitude" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Longitude</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="longitude" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">G</span> Persekitaran</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="persekitaran" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-5 col-form-label"><span class="label label-success">H</span> Kelajuan Jalan Utama</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="jalan_utama" value="0" class="touchspin1 form-control text-right" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-5 col-form-label"><span class="label label-success">I</span> Jumlah Penduduk (Anggaran)</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="jumlah_penduduk" value="0"  class="touchspin1 form-control text-right" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-6 col-form-label"><span class="label label-success">J</span> 85 Percentile Speed (Jalan Utama)</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="jalan_utama" value="0" class="touchspin1 form-control text-right" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- PETA LOKASI -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="font-bold text-16">PETA LOKASI</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Latitude</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="latitude" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Longitude</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="longitude" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>        
                            </div>
                            <div class="ibox-title">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>
                                            <span class="label label-success text-12">PETA</span>
                                            &nbsp;&nbsp;Lokasi Yang Dianalisa
                                        </h5>
                                    </div>
                                </div>    
                            </div>    
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-9">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7967.5295933158895!2d101.70478612897148!3d3.1566041218507785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc37d1676c29fd%3A0xa4390cc23436018!2sKuala%20Lumpur%20City%20Centre%2C%2050450%20Kuala%20Lumpur%2C%20Federal%20Territory%20of%20Kuala%20Lumpur!5e0!3m2!1sen!2smy!4v1728447457879!5m2!1sen!2smy" width="850" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>    
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- RUJUKAN -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">2</span></div> 
                        <div class="font-bold text-16">RUJUKAN</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                Berdasarkan ATJ 13/87 secara umumnya, waran-waran berikut perlu dipertimbangkan sebelum pemasangan lampu isyarat:
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">1</span></td>
                                                                    <td class="text-center font-bold" style="padding: 10px;">Warrant 1 :</td>
                                                                    <td style="padding: 10px;">8-Hour Volume</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">2</span></td>
                                                                    <td class="text-center font-bold" style="padding: 10px;">Warrant 2 :</td>
                                                                    <td style="padding: 10px;">Peak Hour / 1-Hour Volume</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">3</span></td>
                                                                    <td class="text-center font-bold" style="padding: 10px;">Warrant 3 :</td>
                                                                    <td style="padding: 10px;">Coordinated Signal System</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">4</span></td>
                                                                    <td class="text-center font-bold" style="padding: 10px;">Warrant 4 :</td>
                                                                    <td style="padding: 10px;">Pedestrian Safety</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">5</span></td>
                                                                    <td class="text-center font-bold" style="padding: 10px;">Warrant 5 :</td>
                                                                    <td style="padding: 10px;">Accident Experience</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>    
                                                </div>
                                                <div class="row m-t-md">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-info m-l-md m-r-md">
                                                            Pemasangan lampu isyarat hanya boleh dipertimbangkan jika memenuhi analisis salah satu waran di atas.
                                                        </div>    
                                                    </div>    
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- MAKLUMAT SIMPANG -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">3</span></div> 
                        <div class="font-bold text-16">MAKLUMAT SIMPANG</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.1</span> Jenis Simpang</label>
                                            <div class="col-sm-8">
                                                <select name="jenis_simpang" id="jenis-simpang" class="form-control" style="background-color: ghostwhite;">
                                                    <option value="">Pilihan</option>
                                                    <option value="SIMPANG3">Simpang 3</option>
                                                    <option value="SIMPANG4">Simpang 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-5 col-form-label"><span class="label label-success">1.2</span> Lebar Median Jalan Utama</label>
                                            <div class="col-sm-7">
                                                <select name="lebar_median_jalan_utama" id="lebar-median-jalan-utama" class="form-control" style="background-color: ghostwhite;">
                                                    <option value="">Pilihan</option>
                                                    <option value="samalebih12">= > 1.2 m</option>
                                                    <option value="kurang12">0 m ~ 1.1 m</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.3</span> Jumlah Lorong Major</label>
                                            <div class="col-sm-8">
                                                <select name="jumlah_lorong_major" id="jumlah-lorong-major" class="form-control" style="background-color: ghostwhite;">
                                                    <option value="">Pilihan</option>
                                                    <option value="samalebih12">1</option>
                                                    <option value="kurang12">2+</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.4</span> Jumlah Lorong Minor</label>
                                            <div class="col-sm-8">
                                                <select name="jumlah_lorong_minor" id="jumlah-lorong-minor" class="form-control" style="background-color: ghostwhite;">
                                                    <option value="">Pilihan</option>
                                                    <option value="samalebih12">1</option>
                                                    <option value="kurang12">2+</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">2.1</span> No. Laluan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nolaluan" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">2.2</span> No. Seksyen</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="noseksyen" class="form-control text-right" style="background-color: ghostwhite;">
                                                    <span class="input-group-addon">Major</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">2.3</span> Jalan (Ke)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jalan_ke1" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">2.4</span> Jalan (Ke)</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="jalan_ke2" class="form-control text-right" style="background-color: ghostwhite;">
                                                    <span class="input-group-addon">Major</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">3.1</span> Simpang 1 (Ke)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="simpang1_ke" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">3.2</span> No. Laluan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="nolaluan_simpang1" class="form-control text-right" style="background-color: ghostwhite;">
                                                    <span class="input-group-addon">Minor 1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">3.3</span> Simpang 2 (Ke)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="simpang2_ke" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">3.4</span> No. Laluan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="nolaluan_simpang2" class="form-control text-right" style="background-color: ghostwhite;">
                                                    <span class="input-group-addon">Minor 2</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.1</span>
                                    &nbsp;&nbsp;Lakaran Lokasi
                                </h5>
                            </div>    
                            <div class="ibox-content">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sila muat naik lakaran lokasi :</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="lakaran_lokasi" class="form-control" style="background-color: ghostwhite;">
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-1">&nbsp</div>
                    <div class="col-md-11">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.2</span>
                                    &nbsp;&nbsp;Data Banci Tempatan
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2" colspan="2" style="vertical-align: middle;">Laluan<br />Dari</th>
                                                    <th class="text-center" colspan="4" style="background-color: #fabf8f;">MAJOR</th>
                                                    <th class="text-center" colspan="4" style="background-color: #fcd5b4;">MAJOR</th>
                                                    <th class="text-center" colspan="4" style="background-color: #b7dee8;">MINOR</th>
                                                    <th class="text-center" colspan="4" style="background-color: #daeef3;">MINOR</th>
                                                    <th class="text-center" colspan="3" style="background-color: #daeef3;">Pejalan Kaki</th>
                                                    <th class="text-center" rowspan="2" colspan="2" style="vertical-align: middle;">Laluan<br />Dari</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" colspan="4" style="background-color: #fabf8f;">0</th>
                                                    <th class="text-center" colspan="4" style="background-color: #fcd5b4;">0</th>
                                                    <th class="text-center" colspan="4" style="background-color: #b7dee8;">0</th>
                                                    <th class="text-center" colspan="4" style="background-color: #daeef3;">0</th>
                                                    <th class="text-center" style="background-color: #daeef3;">0</th>
                                                    <th class="text-center" style="background-color: #daeef3;">0</th>
                                                    <th class="text-center" style="background-color: #daeef3;">&nbsp;</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" colspan="2">Arah</th>
                                                    <th class="text-center" style="background-color: #fabf8f;">V1</th>
                                                    <th class="text-center" style="background-color: #fabf8f;">V2</th>
                                                    <th class="text-center" style="background-color: #fabf8f;">V3</th>
                                                    <th class="text-center" style="background-color: #fabf8f;">Total</th>
                                                    <th class="text-center" style="background-color: #fcd5b4;">V4</th>
                                                    <th class="text-center" style="background-color: #fcd5b4;">V5</th>
                                                    <th class="text-center" style="background-color: #fcd5b4;">V6</th>
                                                    <th class="text-center" style="background-color: #fcd5b4;">Total</th>
                                                    <th class="text-center" style="background-color: #b7dee8;">V7</th>
                                                    <th class="text-center" style="background-color: #b7dee8;">V8</th>
                                                    <th class="text-center" style="background-color: #b7dee8;">V9</th>
                                                    <th class="text-center" style="background-color: #b7dee8;">Total</th>
                                                    <th class="text-center" style="background-color: #daeef3;">V10</th>
                                                    <th class="text-center" style="background-color: #daeef3;">V11</th>
                                                    <th class="text-center" style="background-color: #daeef3;">V12</th>
                                                    <th class="text-center" style="background-color: #daeef3;">Total</th>
                                                    <th class="text-center" style="background-color: #daeef3;">Ped/hr</th>
                                                    <th class="text-center" style="background-color: #daeef3;">Ped/hr</th>
                                                    <th class="text-center" style="background-color: #daeef3;">Ped/hr</th>
                                                    <th class="text-center" colspan="2">Arah</th>
                                                </tr>
                                                <tr style="background-color: #fcd5b4;">
                                                    <th class="text-center" colspan="2" style="background-color: #da9694 !important;">&nbsp;</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Veh/hr</th>
                                                    <th class="text-center">Ped/hr</th>
                                                    <th class="text-center">Ped/hr</th>
                                                    <th class="text-center">Ped/hr</th>
                                                    <th class="text-center" colspan="2" style="background-color: #da9694 !important;">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php
                                                $z = 0;
                                                for($x = 1; $x <= 24; $x++) { 
                                                    $z++;
                                                    $y = $z - 1;
                                                    
                                                    $rowcolor = ($x % 2) ? '' : '#ddd9c4';
                                            ?>    
                                                <tr style="background-color: <?php echo $rowcolor;?>;">
                                                    <td class="text-center"><?php echo number_format($y,2); ?></td>
                                                    <td class="text-center"><?php echo number_format($z,2); ?></td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center" style="background-color: #fcd5b4 !important;">0</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center" style="background-color: #fcd5b4 !important;">0</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center" style="background-color: #fcd5b4 !important;">0</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center" style="background-color: #fcd5b4 !important;">0</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center">&nbsp;</td>
                                                    <td class="text-center" style="background-color: #fcd5b4 !important;">0</td>
                                                    <td class="text-center"><?php echo number_format($y,2); ?></td>
                                                    <td class="text-center"><?php echo number_format($z,2); ?></td>
                                                </tr>
                                            <?php } ?>    
                                            </tbody>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                
                <!-- ANALISIS  -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">3.4</span></div> 
                        <div class="font-bold text-16">ANALISIS</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.4.1</span>
                                    &nbsp;&nbsp;Warrant 1 : 8-Hour Volume
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-info">
                                            Pemasangan lampu isyarat kawalan trafik adalah WARAN apabila isipadu trafik bagi setiap mana-mana lapan (8) jam 
                                            pada hari purata memenuhi keperluan seperti jadual Table 2.1 ATJ 13/87 berikut: 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.4.2</span>
                                    &nbsp;&nbsp;Keadaan Di Tapak
                                </h5>
                            </div>    
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                i. Tahap penglihatan
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group">    
                                                        <label class="col-sm-2 col-form-label">Jarak penglihatan:</label>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <input type="text" name="lihat1a" class="form-control" style="background-color: ghostwhite;">
                                                                <span class="input-group-addon">m</span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-1 col-form-label text-center"> > </label>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <input type="text" name="lihat1b" class="form-control" style="background-color: ghostwhite;">
                                                                <span class="input-group-addon">m</span>
                                                            </div>
                                                        </div>
                                                        <label class="col-sm-4 col-form-label">(60 km/j) berdasarkan had kelajuan 85th Percentile (> SSD)</label>
                                                        <label class="col-sm-1 col-form-label text-center">
                                                            <span class="label label-success text-12">OK</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <div class="alert alert-info m-l-md m-r-md">
                                                        Rujuk <span class="font-bold">Table 4.1</span> dalam <span class="font-bold">ATJ 8/86 (Pindaan 2015)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                ii. Lebar Jalan dan Bilangan Lorong
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group">    
                                                        <label class="col-sm-2 col-form-label">Lebar Lorong Jalan:</label>
                                                        <div class="col-sm-2">
                                                            <div class="input-group">
                                                                <input type="text" name="lebar_lorong" class="form-control" style="background-color: ghostwhite;">
                                                                <span class="input-group-addon">m</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">    
                                                        <label class="col-sm-2 col-form-label">Bilangan Lorong:</label>
                                                        <div class="col-sm-2">
                                                            <input type="text" name="bilangan_lorong" class="form-control" style="background-color: ghostwhite;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                iii. Kesesuaian Lokasi
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="alert alert-info m-l-md m-r-md">
                                                            Terdapat sebuah sekolah rendah iaitu Sekolah Kebangsaan Chabang Tiga dan juga beberapa aktiviti
                                                            perniagaan serta perumahan di sekitarnya.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-9">    
                                                        <table class="table table-bordered text-14">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">Bilangan</th>
                                                                    <th class="text-center" colspan="2">Perkara-Perkara Lain</th>
                                                                    <th class="text-center">Ya</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                <tr>
                                                                    <td rowspan="2">1</td>
                                                                    <td rowspan="2">Jenis Sekolah</td>
                                                                    <td class="text-left">Sekolah Rendah</td>
                                                                    <td>
                                                                        <div class="i-checks">
                                                                            <label><input type="checkbox" value="SEKOLAH_RENDAH"><i></i></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left">Sekolah Menengah</td>
                                                                    <td>
                                                                        <div class="i-checks">
                                                                            <label><input type="checkbox" value="SEKOLAH_MENENGAH"><i></i></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="6">2</td>
                                                                    <td rowspan="6">Pembangunan / Aktiviti</td>
                                                                    <td class="text-left">Komersil</td>
                                                                    <td>
                                                                        <div class="i-checks">
                                                                            <label><input type="checkbox" value="KOMERSIL"><i></i></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left">Sekolah</td>
                                                                    <td>
                                                                        <div class="i-checks">
                                                                            <label><input type="checkbox" value="SEKOLAH"><i></i></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left">Kawasan Kampung</td>
                                                                    <td>
                                                                        <div class="i-checks">
                                                                            <label><input type="checkbox" value="KAWASAN_KAMPUNG"><i></i></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left">Perindustrian</td>
                                                                    <td>
                                                                        <div class="i-checks">
                                                                            <label><input type="checkbox" value="PERINDUSTRIAN"><i></i></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left">Lain-lain</td>
                                                                    <td>
                                                                        <div class="i-checks">
                                                                            <label><input type="checkbox" value="LAIN-LAIN"><i></i></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-left">
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                (Sila nyatakan) 
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <input type="text" name="nyatakan_lain_lain" class="form-control" style="background-color: ghostwhite;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- PERTIMBANGAN KEJURUTERAAN  -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">3.5</span></div> 
                        <div class="font-bold text-16">ULASAN LAIN</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="form-group">    
                                        <label class="col-sm-1 col-form-label text-center"><span class="label label-default">1</span></label>
                                        <label class="col-sm-4 col-form-label">Berdasarkan analisis waran yang dijalankan, lokasi ini adalah</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="waran1" class="form-control" style="background-color: ghostwhite;">
                                        </div>
                                        <label class="col-sm-4 col-form-label">bagi lintasan pejalan kaki searas berlampu isyarat.</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">    
                                        <label class="col-sm-1 col-form-label text-center"><span class="label label-default">2</span></label>
                                        <label class="col-sm-10 col-form-label">
                                            Lokasi ini adalah sesuai dinaiktaraf dari lintasan pejalan kaki kepada lintasan 
                                            pejalan kaki searas berlampu isyarat memandangkan isipadu trafik tertinggi 
                                            di lokasi tersebut adalah tinggi pada waktu kemuncak dan mencapai kehendak waran.
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">    
                                        <label class="col-sm-1 col-form-label text-center"><span class="label label-default">3</span></label>
                                        <label class="col-sm-10 col-form-label">
                                            Lintasan pejalan kaki searas berlampu isyarat telah disediakan untuk kemudahan 
                                                orang awam dan pelajar sekolah.
                                        </label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>            
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label text-center">&nbsp;</label>
                                    <label class="col-sm-4 col-form-label">Keputusan Analisis :</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="keputusan_analisis3" class="form-control" style="background-color: ghostwhite;">
                                    </div>
                                    <label class="col-sm-1 col-form-label">
                                        <span class="label label-success text-12">[3]</span>
                                    </label>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>    
                
                <!-- RUMUSAN DAN ULASAN  -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">4</span></div> 
                        <div class="font-bold text-16">RUMUSAN DAN ULASAN</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            Berdasarkan Manual Fasiliti Keselamatan Jalan Tahun 2014, bagi lintasan pejalan kaki 
                                            searas berlampu isyarat sesuatu lokasi boleh dipertimbangkan untuk dibina lintasan 
                                            pejalan kaki searas berlampu isyarat mengikut analisis berkaitan.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-default">
                                            Berikut adalah rumusan daripada analisis yang telah dibuat:
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <table class="table table-bordered text-14">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-md-4">Kategori Jalan<br />[1]</th>
                                                    <th class="text-center col-md-4">Isipadu Masa Puncak<br />[2]</th>
                                                    <th class="text-center col-md-4">Pertimbangan Kejuruteraan<br />[3]</th>
                                                </tr>
                                            </thead>    
                                            <tbody>
                                                <tr>
                                                    <td class="font-bold text-center">0.00</td>
                                                    <td class="font-bold text-center">0.00</td>
                                                    <td class="font-bold text-center">0.00</td>
                                                </tr>
                                                <tr style="background-color: #d9edf7;">
                                                    <td>
                                                        <input type="text" name="waran2" class="form-control" style="background-color: ghostwhite;">
                                                    </td>
                                                    <td class="font-bold" colspan="2">
                                                        UNTUK LINTASAN PEJALAN KAKI SEARAS BERLAMPU ISYARAT
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- HANTAR PERMOHONAN -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="font-bold text-16">HANTAR PERMOHONAN</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-right">
                                            <a href="{{route('analisisLip')}}" class="btn btn-w-m btn-success">Hantar Permohonan</a>
                                        </div>
                                    </div>
                                </div>
                             </div>  
                        </div>    
                    </div>
                </div>
            </form>
        </div>    
    </div>
</div>
@endsection

@section('js')
    <script src="{{ URL::asset('inspinia/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('inspinia/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ URL::asset('inspinia/js/plugins/bs-custom-file/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ URL::asset('inspinia/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            
            bsCustomFileInput.init();
            
            $('#tarikh-surat').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>    
@endsection