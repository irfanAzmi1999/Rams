@extends('layouts/main/main')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Analisis Waran Pemasangan Lampu Jalan</h2>
        <ol class="breadcrumb">
            <li>
                Lampu Jalan
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
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.6</span> No. Seksyen</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="noseksyen" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.2</span> No. Laluan</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nombor_laluan" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.7</span> Kawasan</label>
                                            <div class="col-sm-8">
                                                <select name="kawasan" id="kawasan" class="form-control" style="background-color: ghostwhite;">
                                                    <option value="">Pilihan</option>
                                                    <option value="LUARBANDAR">Luar Bandar</option>
                                                    <option value="BANDAR">Bandar</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.3</span> Jalan (Dari)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jalan_dari" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.8</span> ADT</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="adt" class="touchspin1 form-control text-right" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.4</span> Jalan (Ke)</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jalan_ke" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-6 col-form-label"><span class="label label-success">1.9</span> Accident (Malam)</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="accident_malam" class="touchspin1 form-control text-right" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-4 col-form-label"><span class="label label-success">1.5</span> Daerah</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="daerah" class="form-control" style="background-color: ghostwhite;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-6 col-form-label"><span class="label label-success">2.0</span> Accident (Siang)</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="accident_siang" class="touchspin1 form-control text-right" style="background-color: ghostwhite;">
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
                                                Pada dasarnya, terdapat dua (2) keadaan Waran Pemasangan Lampu Jalan di jalan sedia ada (existing road) untuk dianalisis iaitu:
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">1</span></td>
                                                                    <td style="padding: 10px;">Persimpangan Jalan</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center" style="padding: 10px;"><span class="label label-default">2</span></td>
                                                                    <td style="padding: 10px;">Jalan di Jajaran Tengah (jalan penghubung di antara dua persimpangan)</td>
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
                            <div class="ibox-content">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jenis Analisa :</label>
                                    <div class="col-sm-10">
                                        <div class="i-checks">
                                            <label><input type="checkbox" value="PERSIMPANGAN"><i></i> Persimpangan</label>
                                        </div>
                                        <div class="i-checks">
                                            <label><input type="checkbox" value="MIDBLOCK"><i></i> Midblock</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- ANALISIS  -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">A</span></div> 
                        <div class="font-bold text-16">PERSIMPANGAN JALAN</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-info">
                                            Pemasangan lampu jalan di persimpangan ditentukan berdasarkan 2 kategori iaitu di 
                                            kawasan luar bandar (rural) dan di kawasan bandar (urban). Secra ringkasnya ia boleh 
                                            ditentukan merujuk jadual di bawah:
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">JADUAL 1</span>
                                    &nbsp;&nbsp;Keperluan Pemasangan Lampu Jalan Untuk Persimpangan Di Kawasan Luar Bandar
                                </h5>
                            </div>    
                            <div class="ibox-content">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sila pilih keadaan jalan:</label>
                                    <div class="col-sm-4">
                                        <select name="keadaan_jalan_persimpangan" id="keadaan-jalan-persimpangan" class="form-control" style="background-color: ghostwhite;">
                                            <option value="">Pilihan</option>
                                            <option value="EXPRESSWAY-EXPRESSWAY">Expressway-Expressway</option>
                                            <option value="HIGHWAY-EXPRESSWAY">Highway-Expressway</option>
                                            <option value="PRIMARY-EXPRESSWAY">Primary-Expressway</option>
                                            <option value="HIGHWAY-HIGHWAY">Highway-Highway</option>
                                            <option value="PRIMARY-HIGHWAY">Primary-Highway</option>
                                            <option value="PRIMARY-PRIMARY">Primary-Primary</option>
                                            <option value="SECONDARY-HIGHWAY">Secondary-Highway</option>
                                            <option value="SECONDARY-PRIMARY">Secondary-Primary</option>
                                            <option value="SECONDARY-SECONDARY">Secondary-Secondary</option>
                                            <option value="LOCAL-HIGHWAY">Local-Highway</option>
                                            <option value="LOCAL-PRIMARY">Local-Primary</option>
                                            <option value="LOCAL-SECONDARY">Local-Secondary</option>
                                            <option value="LOCAL-LOCAL">Local-Local</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <tbody class="text-center">
                                                <tr>
                                                    <th colspan="5" class="text-center" style="background-color: ghostwhite;">MINOR</th>
                                                    <td colspan="2" rowspan="2" style="background-color: ghostwhite;">&nbsp;</td>
                                                </tr>
                                                <tr style="background-color: #d9edf7;">
                                                    <th class="text-center">Expressway</th>
                                                    <th class="text-center">Highway</th>
                                                    <th class="text-center">Primary</th>
                                                    <th class="text-center">Secondary</th>
                                                    <th class="text-center">Local</th>
                                                </tr>
                                                <tr>
                                                    <td>IC (Y)</td>
                                                    <td>IC (Y)</td>
                                                    <td>IC (Y)</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Expressway</th>
                                                    <th rowspan="5" class="text-center" style="background-color: ghostwhite; vertical-align: middle;">MAJOR</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>IC (Y)</td>
                                                    <td>IC / SI (Y)</td>
                                                    <td>SI / SC (Y)</td>
                                                    <td>SC (Optional)</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Highway</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>SI (Y)</td>
                                                    <td>SI / SC (Y)</td>
                                                    <td>SC (Optional)</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Primary</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>SC (Optional)</td>
                                                    <td>SC (Optional)</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Secondary</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>SC (Optional)</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Local</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>    
                            </div>
                            <div class="ibox-title">
                                <h5><span class="label label-success text-12">JADUAL 2</span>
                                    &nbsp;&nbsp;Keperluan Pemasangan Lampu Jalan Untuk Persimpangan Di Kawasan Bandar</h5>
                            </div>    
                            <div class="ibox-content">   
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sila pilih keadaan jalan:</label>
                                    <div class="col-sm-4">
                                        <select name="keadaan_jalan_persimpangan" id="keadaan-jalan-persimpangan" class="form-control" style="background-color: ghostwhite;">
                                            <option value="">Pilihan</option>
                                            <option value="EXPRESSWAY-EXPRESSWAY">Expressway-Expressway</option>
                                            <option value="ARTERIAL-EXPRESSWAY">Arterial-Expressway</option>
                                            <option value="ARTERIAL-ARTERIAL">Arterial-Arterial</option>
                                            <option value="COLLECTOR-ARTERIAL">Collector-Arterial</option>
                                            <option value="COLLECTOR-COLLECTOR">Collector-Collector</option>
                                            <option value="LOCAL STREET-ARTERIAL">Local Street-Arterial</option>
                                            <option value="LOCAL STREET-COLLECTOR">Local Street-Collector</option>
                                            <option value="LOCAL STREET-LOCAL STREET">Local Street-Local Street</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <tbody class="text-center">
                                                <tr>
                                                    <th colspan="4" class="text-center" style="background-color: ghostwhite;">MINOR</th>
                                                    <td colspan="2" rowspan="2" style="background-color: ghostwhite;">&nbsp;</td>
                                                </tr>
                                                <tr style="background-color: #d9edf7;">
                                                    <th class="text-center">Expressway</th>
                                                    <th class="text-center">Arterial</th>
                                                    <th class="text-center">Collector</th>
                                                    <th class="text-center">Local Street</th>
                                                </tr>
                                                <tr>
                                                    <td>IC (Y)</td>
                                                    <td>IC (Y)</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Expressway</th>
                                                    <th rowspan="4" class="text-center" style="background-color: ghostwhite; vertical-align: middle;">MAJOR</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>IC / SI (Y)</td>
                                                    <td>SI (Y)</td>
                                                    <td>SI / SC (Y)</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Arterial</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>SI (Y)</td>
                                                    <td>SC (Optional)</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Collector</th>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>SC (Optional)</td>
                                                    <th class="text-center" style="background-color: #d9edf7;">Local Street</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-title">   
                                <h5><span class="label label-success text-12">NOTA</span></h5>
                            </div>
                            <div class="ibox-content">   
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="text-center" style="background-color: ghostwhite;">IC</th>
                                                    <td>Persimpangan (Interchange)</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" style="background-color: ghostwhite;">SI</th>
                                                    <td>Persimpangan Berlampu Isyarat (Signalised Intersection)</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" style="background-color: ghostwhite;">SC</th>
                                                    <td>Kawalan Trafik Insani (Stop Control)</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" style="background-color: ghostwhite;">(Y)</th>
                                                    <td>Ya untuk Lampu Jalan (Yes for Lighting)</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" style="background-color: ghostwhite;">(N)</th>
                                                    <td>Tidak untuk Lampu Jalan (No for Lighting)</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" style="background-color: ghostwhite;">(Optional)</th>
                                                    <td>AADT lebih daripada 1000 kenderaan/hari atau kemalangan 
                                                        waktu malam yang tinggi (kadar nisbah > 1.3)</td>
                                                </tr>
                                            </tbody>    
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row m-b-lg">
                                            <div class="col-md-12">
                                                Jika <span class="font-bold">(Optional)</span>, waran bagi pemasangan lampu jalan 
                                                di persimpangan bergantung kepada nilai AADT dan nisbah kemalangan seperti jadual 
                                                di bawah:
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th style="background-color: #d9edf7;">Bil</th>
                                                            <th style="background-color: #d9edf7;">Kategori</th>
                                                            <th style="background-color: #d9edf7;">Data</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td>AADT > 1000 vpd</td>
                                                            <td class="text-center">0</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td><span class="font-bold">atau,</span> 
                                                                Nisbah Kemalangan Malam:Siang > 1.3</td>
                                                            <td class="text-center">0</td>
                                                        </tr>
                                                    </tbody>    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Keputusan Analisis :</label>
                                    <label class="col-sm-3 col-form-label">Luar Bandar</label>
                                    <label class="col-sm-3 col-form-label text-white text-center" style="background-color: green;">WARAN</label>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <!-- ANALISIS  -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="m-b-md"><span class="label label-success text-12">B</span></div> 
                        <div class="font-bold text-16">ANALISIS MIDBLOCK</div>
                    </div>
                    <div class="col-md-10">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-info">
                                            Memandangkan jenis jalan tersebut melibatkan jajaran tengah, maka analisis yang 
                                            dilakukan adalah melibatkan analisis primer bersama analisis sekunder atau analisis 
                                            primer tanpa analisis sekunder.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-title">
                                <h5>
                                    <span class="label label-success text-12">3.1</span>
                                    &nbsp;&nbsp;Analisis Primer
                                </h5>
                            </div>    
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Bil</th>
                                                    <th>Bahagian</th>
                                                    <th>Kategori</th>
                                                    <th>Ya / Tidak</th>
                                                    <th>Waran / Tidak Waran</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td rowspan="3" style="vertical-align: middle;">1</td>
                                                    <td rowspan="3" style="vertical-align: middle;">Kategori Jalan</td>
                                                    <td>Jalan Protokol; <span class="font-bold">atau</span></td>
                                                    <td>
                                                        <select name="jalan_protokol" id="jalan-protokol" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td rowspan="3" style="vertical-align: middle;">TIDAK WARAN</td>
                                                </tr>
                                                <tr>
                                                    <td>Jalan Strategik; <span class="font-bold">atau</span></td>
                                                    <td>
                                                        <select name="jalan_strategik" id="jalan-strategik" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jalan Industri; <span class="font-bold">atau</span></td>
                                                    <td>
                                                        <select name="jalan_industri" id="jalan-industri" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" style="vertical-align: middle;">2</td>
                                                    <td rowspan="2" style="vertical-align: middle;">Kemalangan Pada Waktu Malam</td>
                                                    <td>Jumlah Kemalangan pada waktu malam<br /><br /> > 4 bil/tahun; <span class="font-bold">dan</span></td>
                                                    <td>
                                                        <select name="jumlah_kemalangan_malam" id="jumlah-kemalangan-malam" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td rowspan="2" style="vertical-align: middle;">TIDAK WARAN</td>
                                                </tr>
                                                <tr>
                                                    <td>Nisbah Kemalangan<br /><br />Malam:Siang 1.3:1</td>
                                                    <td>
                                                        <select name="nisbah_kemalangan" id="nisbah-kemalangan" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Keputusan Analisis Primer:</label>
                                    <label class="col-sm-3 col-form-label text-center" style="border: 1px solid black;">TIDAK WARAN</label>
                                </div>
                            </div>
                            <div class="ibox-title">
                                <h5><span class="label label-success text-12">3.2</span>
                                    &nbsp;&nbsp;Analisis Sekunder (dibuat sekiranya Analisis Primer tidak waran)</h5>
                            </div>    
                            <div class="ibox-content">   
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Bil</th>
                                                    <th>Bahagian</th>
                                                    <th>Kategori</th>
                                                    <th>Ya / Tidak</th>
                                                    <th>Waran / Tidak Waran</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td rowspan="2" style="vertical-align: middle;">1</td>
                                                    <td rowspan="2" style="vertical-align: middle;">Isipadu Trafik</td>
                                                    <td>4 Lorong > 40,000 vpd</td>
                                                    <td>
                                                        <select name="lorong_40k" id="lorong-40k" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td rowspan="2" style="vertical-align: middle;">WARAN</td>
                                                </tr>
                                                <tr>
                                                    <td>< 4 Lorong > 20,000 vpd</td>
                                                    <td>
                                                        <select name="lorong_20k" id="lorong-20k" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Laluan Hala Kenderaan</td>
                                                    <td>> 1 Lorong/Hala</td>
                                                    <td>
                                                        <select name="lorong_1hala" id="lorong-1hala" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td>WARAN</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Skala Pendudukan</td>
                                                    <td>Pembangunan/ aktiviti tepi jalan/ sekolah/ perumahan/ lot komersil</td>
                                                    <td>
                                                        <select name="pembangunan_aktiviti" id="pembangunan-aktiviti" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td>TIDAK WARAN</td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3" style="vertical-align: middle;">4</td>
                                                    <td rowspan="3" style="vertical-align: middle;">Pejalan Kaki, Basikal & Motorsikal</td>
                                                    <td>Pejalan Kaki</td>
                                                    <td>
                                                        <select name="pejalan_kaki" id="pejalan-kaki" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td rowspan="3" style="vertical-align: middle;">TIDAK WARAN</td>
                                                </tr>
                                                <tr>
                                                    <td>Motorsikal</td>
                                                    <td>
                                                        <select name="motorsikal" id="motorsikal" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Basikal</td>
                                                    <td>
                                                        <select name="basikal" id="basikal" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Halaju Operasi</td>
                                                    <td>Kelajuan Kenderaan (85th percentile) > 70km/j</td>
                                                    <td>
                                                        <select name="kelajuan_kenderaan" id="kelajuan-kenderaan" class="form-control" style="background-color: ghostwhite;">
                                                            <option value="">Pilihan</option>
                                                            <option value="YA">Ya</option>
                                                            <option value="TIDAK">Tidak</option>
                                                        </select>
                                                    </td>
                                                    <td>TIDAK WARAN</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-right" colspan="4">Jumlah Waran</th>
                                                    <th class="text-center">2</th>
                                                </tr>
                                            </tfoot>    
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <i class="fa fa-asterisk"></i> Sekiranya hanya tiga daripada lima daripada Analisis Sukender ini dipenuhi, 
                                            pemasangan lampu jalan di jajaran tersebut adalah waran.
                                        </div>
                                    </div>
                                </div>    
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Keputusan Analisis Sekunder:</label>
                                    <label class="col-sm-3 col-form-label text-black text-center" style="border: 1px solid black;">TIDAK WARAN</label>
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
                                            <a href="{{route('analisisLampujalan')}}" class="btn btn-w-m btn-success">Hantar Permohonan</a>
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
    <script>
        $(document).ready(function(){
            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            })
            
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>    
@endsection