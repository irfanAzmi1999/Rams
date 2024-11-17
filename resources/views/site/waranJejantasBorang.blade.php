@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Analisis Waran Jejantas Pejalan Kaki</h2>
        <ol class="breadcrumb">
            <li>
                Jejantas Pejalan Kaki
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
                                    <label class="col-sm-3 col-form-label"><span class="label label-success">C</span> Punca Permohonan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="punca_permohonan" class="form-control" style="background-color: ghostwhite;">
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
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.1</span> Negeri</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="negeri" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.2</span> Daerah</label>
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
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.3</span> No. Laluan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nombor_laluan" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.4</span> No. Seksyen</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="noseksyen" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.5</span> Jalan (Dari)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jalan_dari" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.6</span> Jalan (Ke)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jalan_ke" class="form-control" style="background-color: ghostwhite;">
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
                                        <div class="alert alert-info">
                                            Berdasarkan Manual Fasaliti Keselamatan Jalan Tahun 2014, beberapa kriteria yang 
                                            sesuai perlu diambilkira bagi menilai kesesuaian jenis lintasan pejalan kaki yang 
                                            akan dibina:
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                Langkah 1: Menentukan kesesuaian jenis lintasan pejalan kaki yang akan dibina.
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="3">&nbsp;</th>
                                                                    <th class="text-center" colspan="5" style="background-color: #d9edf7;">Kelas Fungsi/Kategori Jalan</th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center text-black" style="background-color: orange;">Expressway</th>
                                                                    <th class="text-center" style="background-color: orange;">Primary Arterial</th>
                                                                    <th class="text-center" style="background-color: orange;">Secondary Arterial</th>
                                                                    <th class="text-center" style="background-color: orange;">Collector Road</th>
                                                                    <th class="text-center" style="background-color: orange;">Local Road</th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center text-white" style="background-color: orange;">Expressway</th>
                                                                    <th class="text-center text-white" style="background-color: orange;">Jalan Persekutuan</th>
                                                                    <th class="text-center text-white" style="background-color: orange;">Jalan Negeri &<br />Jalan Bandaran Utama</th>
                                                                    <th class="text-center text-white" style="background-color: orange;">Jalan Bandaran</th>
                                                                    <th class="text-center text-white" style="background-color: orange;">Jalan Bandaran<br />Tempatan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                <tr>
                                                                    <th class="text-white" style="background-color: orange;">Lintasan Tanpa Kawalan</th>
                                                                    <td>C</td>
                                                                    <td>B</td>
                                                                    <td>B</td>
                                                                    <td>B</td>
                                                                    <td>B</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-white" style="background-color: orange;">Lintasan Murid Sekolah</th>
                                                                    <td>C</td>
                                                                    <td>B</td>
                                                                    <td>B</td>
                                                                    <td>A</td>
                                                                    <td>A</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-white" style="background-color: orange;">Lintasan Zebra</th>
                                                                    <td>C</td>
                                                                    <td>B</td>
                                                                    <td>B</td>
                                                                    <td>A</td>
                                                                    <td>A</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-white" style="background-color: orange;">Lintasan Berlampu Isyarat</th>
                                                                    <td>C</td>
                                                                    <td>A</td>
                                                                    <td>B</td>
                                                                    <td>B</td>
                                                                    <td>C</td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-white" style="background-color: orange;">Lintasan Pada Aras Tinggi (Jejantas)</th>
                                                                    <td>C</td>
                                                                    <td>A</td>
                                                                    <td>B</td>
                                                                    <td>B</td>
                                                                    <td>C</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>    
                                                    </div>
                                                    <div class="col-md-3">
                                                        Nota:
                                                        <ol>
                                                            <ul><span class="label label-default">A</span> Kaedah yang amat sesuai</ul>
                                                            <ul><span class="label label-default">B</span> Kaedah yang boleh digunakan</ul>
                                                            <ul><span class="label label-default">C</span> Kaedah yang tidak sesuai</ul>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                <!-- Langkah 2 -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                Langkah 2: Menentukan jenis lintasan yang diperlukan berdasarkan analisis jumlah 
                                                pejalan kaki sejam pada waktu puncak (P) dan bilangan kenderaan sejam pada waktu puncak (V).
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Untuk jenis lintasan jejantas, Nilai PV > 200,000
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                                
                                <!-- Langkah 3 -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                Langkah 3: Antara pertimbangan Kejuruteraan yang perlu diambil kira iaitu:
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">1</span></td>
                                                                    <td style="padding: 10px;">Data/rekod kemalangan melibatkan pejalan kaki</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">2</span></td>
                                                                    <td style="padding: 10px;">Tahap penglihatan pemandu terhadap pejalan kaki yang melintas</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">3</span></td>
                                                                    <td style="padding: 10px;">Tahap penglihatan pejalan kaki terhadap kenderaan yang menghampiri kawasan lintasan</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">4</span></td>
                                                                    <td style="padding: 10px;">Lebar jalan dan bilangan lorong</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">5</span></td>
                                                                    <td style="padding: 10px;">Jenis sekolah (rendah dan menengah)</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">6</span></td>
                                                                    <td style="padding: 10px;">Kedudukan lokasi dan jenis pembangunan setempat</td>
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
                
                <!-- ANALISIS -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">3</span></div> 
                        <div class="font-bold text-16">ANALISIS</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
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
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.2</span>
                                    &nbsp;&nbsp;Analisis Kesesuaian Jenis Lintasan Pejalan Kaki yang akan dibina mengikut Kategori Jalan 
                                </h5>
                            </div>    
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            Berdasarkan jadual jenis lintasan pejalan kaki yang boleh digunakan bagi 
                                            <span class="font-bold">Jalan Persekutuan</span> adalah 
                                            <span class="font-bold">Lintasan Pejalan Kaki (Aras Tinggi)</span>.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Keputusan Analisis :</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="keputusan_analisis1" class="form-control" style="background-color: ghostwhite;">
                                    </div>
                                    <label class="col-sm-1 col-form-label">
                                        <span class="label label-success text-12">[1]</span>
                                    </label>
                                </div>
                            </div>
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.3</span>
                                    &nbsp;&nbsp;Analisis Jumlah Pejalan Kaki pada waktu puncak (P) dan isipadu trafik pada waktu puncak (V)
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            Data isipadu kenderaan pada waktu puncak yang boleh diperolehi semasa lawatan tapak adalah seperti berikut:
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Lokasi A</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="lokasi_A" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label">Lokasi B</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="lokasi_B" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Arah 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="arah_1" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Arah 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="arah_2" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-md">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2" colspan="2" style="vertical-align: middle;">Masa</th>
                                                    <th class="text-center" colspan="3">Pejalan Kaki (P)</th>
                                                    <th class="text-center" colspan="3">Kenderaan (V)</th>
                                                    <th class="text-center" rowspan="2" style="vertical-align: middle;">PV</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Arah A ke B</th>
                                                    <th class="text-center">Arah B ke A</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">Arah 1</th>
                                                    <th class="text-center">Arah 2</th>
                                                    <th class="text-center">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <?php for($x = 1; $x <= 16; $x++) { ?>    
                                                <tr>
                                                    <td><input type="text" name="masa_mula" value="00:00" class="form-control text-center" style="background-color: ghostwhite;"></td>
                                                    <td><input type="text" name="masa_akhir" value="00:00" class="form-control text-center text-center" style="background-color: ghostwhite;"></td>
                                                    <td><input type="text" name="p1" value="0" class="touchspin1 form-control text-center" style="background-color: ghostwhite;"></td>
                                                    <td><input type="text" name="p2" value="0" class="touchspin1 form-control text-center" style="background-color: ghostwhite;"></td>
                                                    <td>0</td>
                                                    <td><input type="text" name="v1" value="0" class="touchspin1 form-control text-center" style="background-color: ghostwhite;"></td>
                                                    <td><input type="text" name="v2" value="0" class="touchspin1 form-control text-center" style="background-color: ghostwhite;"></td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                            <?php } ?>    
                                            </tbody>
                                        </table>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-4 col-form-label">Jumlah isipadu tertinggi, PV di laluan utama adalah</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="tertinggi_PV" class="form-control" style="background-color: ghostwhite;">
                                        </div>
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="form-group">    
                                        <label class="col-sm-4 col-form-label">pada masa puncak</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="masapuncak1" class="form-control" style="background-color: ghostwhite;">
                                        </div>
                                        <label class="col-sm-1 col-form-label text-center">hingga</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="masapuncak2" class="form-control" style="background-color: ghostwhite;">
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Syarat Minimum :</label>
                                    <label class="col-sm-4 col-form-label text-center" style="border: 1px solid black;">200,000</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Pematuhan :</label>
                                    <label class="col-sm-4 col-form-label text-center" style="border: 1px solid black;">Bilangan Trafik < Minimum</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Keputusan Analisis :</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="keputusan_analisis2" class="form-control" style="background-color: ghostwhite;">
                                    </div>
                                    <label class="col-sm-1 col-form-label">
                                        <span class="label label-success text-12">[2]</span>
                                    </label>
                                </div>    
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- PERTIMBANGAN KEJURUTERAAN  -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">3.4</span></div> 
                        <div class="font-bold text-16">PERTIMBANGAN KEJURUTERAAN</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.4.1</span>
                                    &nbsp;&nbsp;Data Kemalangan
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-info">
                                            Pertimbangan kejuruteraan diperlukan bagi menentukan keperluan pembinaan jejantas pejalan kaki 
                                            terutamanya jika terdapat data atau rekod kemalangan melibatkan pejalan kaki dalam tempoh 3 tahun 
                                            terkini iaitu terdapat tiga (3) kemalangan (terdiri daripada semua jenis) melibatkan pejalan kaki 
                                            dan berlaku dalam radius 50m dari lokasi cadangan pembinaan jejantas pejalan kaki
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Jumlah laporan kemalangan di lokasi cadangan :</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="jumlah_kemalangan" value="0" class="touchspin1 form-control text-right" style="background-color: ghostwhite;">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="laporan_kemalangan" value="LAPORAN 27" class="form-control" style="background-color: ghostwhite;">
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
                                        <label class="col-sm-4 col-form-label">bagi pembinaan jejantas pejalan kaki.</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">    
                                        <label class="col-sm-1 col-form-label text-center"><span class="label label-default">2</span></label>
                                        <label class="col-sm-10 col-form-label">
                                            Lokasi ini adalah sesuai dinaiktaraf dari lintasan berlampu isyarat kepada lintasan 
                                            pada aras tinggi (jejantas) memandangkan isipadu trafik tertinggi di lokasi tersebut 
                                            adalah tinggi pada waktu kemuncak dan mencapai kehendak waran.
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
                                            Berdasarkan Manual Fasiliti Keselamatan Jalan Tahun 2014, bagi pembinaan jejantas 
                                            pejalan kaki sesuatu lokasi boleh dipertimbangkan untuk dibina jejantas mengikut 
                                            analisis berkaitan.
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
                                                        UNTUK PEMBINAAN JEJANTAS
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
                                            <a href="{{route('analisisJejantas')}}" class="btn btn-w-m btn-success">Hantar Permohonan</a>
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
        });
    </script>    
@endsection