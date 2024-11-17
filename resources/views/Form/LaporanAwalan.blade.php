@extends('layouts/main/form')

@section('content')

<style>
    .kenderaan-group .input-group-addon {
        min-width:200px;
        text-align:left !important;
    }

    /* Style the tab */
    .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #fff;
    }

    /* Style the buttons inside the tab */
    .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
    background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
    background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
    background-color: #fff;
    }
</style>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'rams')" id="defaultOpen">RAMS DATA</button>
    <button class="tablinks" onclick="openTab(event, 'pdrm')">PDRM DATA</button>
</div>

<div id="rams" class="wrapper wrapper-content tabcontent">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Laporan Teknikal Awalan(Dalam Tempoh 3 Hari)</h5>
                </div>
                <div class="ibox-content">
                    <Pre>PENYEDIAAN LAPORAN AWALAN KEMALANGAN MAUT DI ATAS JALAN PERSEKUTUAN ATAU KESESAKAN JALAN YANG TERUK
                        <br>-Memohon Maklumat Segera Daripada Jurutera Daerah JKR(Dalam Tempoh 24 Jam)</Pre>
                    <b><u>Kandungan/Perkara Yang Perlu Dilaporkan</u></b><br><br>
                    <b><u>DIISI OLEH JURUTERA DAERAH</u></b><br>
                    <b>Sila isi Kotak-Kotak Yang Berkenaan</b><br>
                    <form id="form-LaporanAwalan" enctype="multipart/form-data" method="POST" action="/laporanAwalanPost">
                        @csrf
                        <div class="modal-body">
                            <input hidden type="text" name="accident_id" value="{{$model->id}}">
                            <input hidden type="text" name="export_id" value="{{$model->export_id}}">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">No Laporan</label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value="{{$model->no_laporan}}" readonly ></div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Tarikh & Masa Kemalangan</label>
                                <div class="col-sm-10"><input type="text" id="tarikh_masa" name="tarikh_masa" class="form-control" value="{{date('d F Y / Hi',strtotime($model->tarikh_kejadian)).'hrs'}}" readonly ></div>
                            </div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kategori Jalan:(Persekutuan / Negeri)</label>
                                <div class="col-sm-10">
                                    @if($action == 'paparan')
                                    <input hidden type="text" name="jenis_jalan" value="{{$model['jenis_jalan_id']}}">
                                    {!! html()->select('jenis_jalan', $jenis_jalan, $model['jenis_jalan_id'])
                                    ->class('form-control m-b chosen-road-category')
                                    ->placeholder('Pilih Kategori Jalan')
                                    ->attribute('disabled', true) !!}
                                    @elseif($action == 'kemaskini')
                                    {!! html()->select('jenis_jalan', $jenis_jalan, $model['jenis_jalan_id'])
                                    ->class('form-control m-b chosen-road-category')
                                    ->placeholder('Pilih Kategori Jalan') !!}
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Keterangan / Maklumat Jalan:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-11">
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Tempat Kejadian:</label>
                                        <div class="col-sm-10">
                                            <input @if($action == 'paparan') readonly @endif type="text" class="form-control" name="tempat_kejadian" value="{{$model->tempat_kejadian}}" >
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">No Laluan:</label>
                                        <div class="col-sm-10">
                                            <input readonly type="text"  class="form-control"  name="no_laluan" value="{{$model['no_laluan']}}">
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Nama Laluan:</label>
                                        <div class="col-sm-10">
                                            @if($action == 'paparan')
                                            {!! html()->select('jalan_id', $nojalan, $model['jalan_id'])
                                            ->class('form-control m-b')
                                            ->placeholder('Pilih No Laluan')
                                            ->attribute('disabled', true) !!}
                                            @elseif($action == 'kemaskini')
                                            {!! html()->select('jalan_id', $nojalan, $model['jalan_id'])
                                            ->class('form-control m-b chosen-no-laluan')
                                            ->placeholder('Pilih No Laluan') !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">No seksyen:</label>
                                        <div class="col-sm-10"><input @if($action == 'paparan') readonly @endif type="number" class="form-control" name="nombor_seksyen" value="{{$model->nombor_seksyen}}" ></div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Koordinate:</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Latitude</span>
                                                </div>
                                                <input @if($action == 'paparan') readonly @endif type="number" class="form-control" id="latitude" name="latitude" value="{{$model->latitude}}" >
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Longitude</span>
                                                </div>
                                                <input @if($action == 'paparan') readonly @endif type="number" class="form-control" id="logitude" name="logitude" value="{{$model->logitude}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-10">
                                            <div id="map_canvas" style="width: 500px; height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <div class= "col-sm-1"></div>
                                <div class= "col-sm-11">
                                    @foreach($kenderaan as $kereta)
                                    <div id="inputFormRow" class="form-group row kenderaan-group">
                                        <div class="col-sm-9">
                                            <input hidden type="text" name="kenderaan_id[]" value="{{$kereta->id}}">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Jenis Kenderaan</span>
                                                </div>
                                                <input hidden type="text" name="jenis_kenderaan[]" value="{{$kereta->jenis_kenderaan}}">
                                                {!! html()->select('jenis_kenderaan', $jenis_kenderaan, $kereta->jenis_kenderaan)
                                                ->class('form-control m-b chosen-car-type')
                                                ->placeholder('Pilih Jenis Kenderaan')
                                                ->attribute('disabled', true) !!}
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Jenama Kenderaan</span>
                                                </div>
                                                <input readonly type="text" class="form-control" name="jenama[]" value="{{$kereta->jenama}}" >
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Model Kenderaan</span>
                                                </div>
                                                <input readonly type="text" class="form-control" name="model_kenderaan[]" value="{{$kereta->model_kenderaan}}" >
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Punca Kemalangan</span>
                                                </div>
                                                <input hidden type="text" name="kenderaan_punca_kemalangan[]" value="{{$kereta->punca_kemalangan}}">
                                                {!! html()->select('punca_kemalangan', $punca_kemalangan, $kereta->punca_kemalangan)
                                                ->class('form-control m-b chosen-cause-accident')
                                                ->placeholder('Pilih Punca Kemalangan')
                                                ->attribute('disabled', true) !!}
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Tahun Dibuat</span>
                                                </div>
                                                <input @if($action == 'paparan') readonly @endif type="text" class="form-control" name="tahun_dibuat[]" value="{{$kereta->tahun_dibuat}}" >
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div id="newRow"></div>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Jumlah Kematian:</label>
                                <div class="col-sm-2">
                                    <!--div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="input-group-text">Jumlah</span>
                                            </div-->
                                            <input type="number" readonly class="form-control" id="bil_mati" name="bil_mati" value="<?php echo ($model->bil_pemandu_mati+$model->bil_penumpang_mati+$model->bil_pejalan_mati); ?>" >

                                    <!--/div-->
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="input-group-text">Pemandu</span>
                                        </div>
                                        <input readonly type="number" class="form-control" id="bil_pemandu_mati" name="bil_pemandu_mati" value="{{$model->bil_pemandu_mati}}" >
                                        <div class="input-group-addon">
                                            <span class="input-group-text">Penumpang</span>
                                        </div>
                                        <input readonly type="number" class="form-control" id="bil_penumpang_mati" name="bil_penumpang_mati" value="{{$model->bil_penumpang_mati}}" >
                                        <div class="input-group-addon">
                                            <span class="input-group-text">Pejalan</span>
                                        </div>
                                        <input readonly type="number" class="form-control" id="bil_pejalan_mati" name="bil_pejalan_mati" value="{{$model->bil_pejalan_mati}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Jenis Perlanggaran:</label>
                                <div class="col-sm-10">
                                    <input hidden type="text" name="jenis_langgar_pertama" value="{{$model['jenis_langgar_pertama_id']}}">
                                    {!! html()->select('jenis_langgar_pertama', $jenis_langgar_pertama, $model['jenis_langgar_pertama_id'])
                                    ->class('form-control m-b chosen-crash-type')
                                    ->placeholder('Pilih Jenis Perlanggaran')
                                    ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Cuaca Semasa Kemalangan:</label>
                                <div class="col-sm-10">
                                    <input hidden type="text" name="cuaca" value="{{$model['cuaca_id']}}">
                                    {!! html()->select('cuaca', $cuaca, $model['cuaca_id'])
                                    ->class('form-control m-b chosen-weather')
                                    ->placeholder('Pilih Cuaca Semasa Kemalangan')
                                    ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Keadaan Jalan</label>
                                <div class="col-sm-10">
                                    <input hidden type="text" name="keadaan_jalan" value="{{$model['keadaan_jalan_id']}}">
                                    {!! html()->select('keadaan_jalan', $keadaan_jalan, $model['keadaan_jalan_id'])
                                    ->class('form-control m-b chosen-road-condition')
                                    ->placeholder('Pilih Keaadaan Jalan')
                                    ->id('keadaan_jalan')
                                    ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div @if($model['keadaan_jalan_id'] != '100') hidden @endif id="form_keadaan_jalan_penerangan" class="form-group row">
                                <label class="col-sm-2 col-form-label">Nyatakan</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="keadaan_jalan_penerangan" name="keadaan_jalan_penerangan" value="{{$model->keadaan_jalan_penerangan}}" title="Nyatakan" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Geometri Jalan</label>
                                <div class="col-sm-10">
                                    <input hidden type="text" name="bentuk_jalan" value="{{$model['bentuk_jalan_id']}}">
                                    {!! html()->select('bentuk_jalan', $bentuk_jalan, $model['bentuk_jalan_id'])
                                    ->class('form-control m-b chosen-road-geometry')
                                    ->placeholder('Pilih Geometri Jalan')
                                    ->id('bentuk_jalan')
                                    ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div @if($model['bentuk_jalan_id'] != '100') hidden @endif id="form_bentuk_jalan_penerangan" class="form-group row">
                                <label class="col-sm-2 col-form-label">Nyatakan</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="bentuk_jalan_penerangan" name="bentuk_jalan_penerangan" value="{{$model->bentuk_jalan_penerangan}}" title="Nyatakan" >
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Punca Kemalangan</label>
                                <div class="col-sm-10">
                                    <input hidden type="text" name="punca_kemalangan" value="{{$model['punca_kemalangan_id']}}">
                                    {!! html()->select('punca_kemalangan', $kategori_kesilapan, $model['punca_kemalangan_id'])
                                    ->class('form-control m-b chosen-cause-of-accident')
                                    ->placeholder('Pilih Punca Kemalangan')
                                    ->id('punca_kemalangan')
                                    ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div @if($model['punca_kemalangan_id'] != '16') hidden @endif id="form_punca_kemalangan_penerangan" class="form-group row">
                                <label class="col-sm-2 col-form-label">Nyatakan</label>
                                <div class="col-sm-10">
                                    <input readonly type="text" class="form-control" id="punca_kemalangan_penerangan" name="punca_kemalangan_penerangan" value="{{$model->punca_kemalangan_penerangan}}" title="Nyatakan" >
                                </div>
                            </div>
                            @if($action == 'paparan')
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Gambar Lokasi Kemalangan</label>
                                <div class="col-sm-10">
                                    @if(!empty($model['url']))
                                    <img name="preview_img" id="preview_img" src="<?php echo asset('storage/'.$model['url']); ?>" class="" width="300" height="150"/>
                                    @else
                                    <label for="profile_image">Tiada Gambar</label>
                                    @endif
                                </div>
                            </div>
                            @elseif($action == 'kemaskini')
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Gambar Kemalangan</label>
                                <div class="col-sm-10">
                                    <label title="Upload image file" class="btn btn-primary">
                                        <input type="file" accept="image/jpeg, image/png" name="inputImage" id="inputImage" onchange="loadPreview(this);" style="display:none">
                                        Upload image
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <label for="profile_image"></label>
                                    <img name="preview_img" id="preview_img" src=" @if(!empty($model['url']))<?php echo asset('storage/'.$model['url']); ?> @endif" class="" width="300" height="150"/>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Disediakan Oleh</label>
                                <div class="col-sm-10">
                                    <label class="col-form-label">{{$user->fullname}}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <label class="col-form-label">{{$user->getFullnameJawatan()}}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <label class="col-form-label">{{$model->updated_at->format('d F Y')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-left col-sm-6">
                                <a href="./laporanAwalan" id="back-fdata" class="btn btn-primary" type="submit">Kembali Ke Senarai</a>
                            </div>
                            <div class="text-right col-sm-6">
                                <?php if($model->status_la != 'PENGESAHAN' && $model->status_la != 'DISAHKAN'){ ?>
                                @if($action == 'kemaskini')
                                <a id="update-fdata" style="margin-bottom: 5px;" class="btn btn-primary" type="submit">Simpan</a>
                                @endif
                                @if($action == 'paparan')
                                <a id="kemaskini-fdata" style="margin-bottom: 5px;" class="btn btn-primary" type="submit">Kemaskini</a>
                                <a id="pdf-fdata" style="margin-bottom: 5px;" class="btn btn-primary" type="submit">Download PDF</a>
                                @endif
                                <a id="hantar-fdata" style="margin-bottom: 5px;" class="btn btn-default confirmation" data-dismiss="modal">Hantar</a>

                                <?php }else if($model->status_la == 'PENGESAHAN' && (Auth::user()->adminjkr() || Auth::user()->admin())){ ?>
                                @if($action == 'paparan')
                                <a id="pdf-fdata" style="margin-bottom: 5px;" class="btn btn-primary" type="submit">Download PDF</a>
                                @endif
                                <a id="sah-fdata" style="margin-bottom: 5px;" class="btn btn-primary confirmation" type="submit">Sah</a>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="pdrm" class="wrapper wrapper-content tabcontent">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Raw Data Laporan Teknikal Awalan(Dalam Tempoh 3 Hari) Dari PDRM</h5>
                </div>
                <div class="ibox-content">
                    <form action="">
                        <div class="modal-body">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">No Laporan</label>
                                <div class="col-sm-10"><input type="text" class="form-control" value="{{$modelPDRM->no_laporan}}" readonly ></div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Tarikh & Masa Kemalangan</label>
                                <div class="col-sm-10"><input type="text" class="form-control" value="{{date('d F Y / Hi',strtotime(date('d-m-Y H:i', strtotime($modelPDRM->tarikh_kejadian . ' ' . str_pad($modelPDRM->masa, 4, '0', STR_PAD_LEFT))))).'hrs'}}" readonly ></div>
                            </div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kategori Jalan:(Persekutuan / Negeri)</label>
                                <div class="col-sm-10">
                                {!! html()->select('jenis_jalan', $jenis_jalan, (int)$modelPDRM['jenis_jalan'])
                                ->class('form-control m-b chosen-road-category')
                                ->placeholder('')
                                ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Keterangan / Maklumat Jalan:</label>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-11">
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Tempat Kejadian:</label>
                                        <div class="col-sm-10">
                                            <input readonly type="text" class="form-control" value="{{$modelPDRM->tempat_kejadian}}" >
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">No Laluan:</label>
                                        <div class="col-sm-10"><input readonly type="text" class="form-control" value="{{$modelPDRM->no_laluan}}" ></div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">No seksyen:</label>
                                        <div class="col-sm-10"><input readonly type="number" class="form-control" value="{{$modelPDRM->nombor_seksyen}}" ></div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Koordinate:</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Latitude</span>
                                                </div>
                                                <?php
                                                    if ($modelPDRM->latitude != '') {
                                                        $arrlat = explode('.', str_replace(array(',', ' '), '.', $modelPDRM->latitude), 3);
                                                        if (sizeof($arrlat) > 2) {
                                                            $newlat = number_format((float)((int)$arrlat[0] + ((((int)$arrlat[1] * 60) + ((float)$arrlat[2])) / 3600)), 4);
                                                        } else {
                                                            $newlat = number_format((float)$modelPDRM->latitude, 4);
                                                        }
                                                    } else {
                                                        $newlat = null;
                                                    }
                                                    if ($modelPDRM->logitude != '') {
                                                        $arrlng = explode('.', str_replace(array(',', ' '), '.', $modelPDRM->logitude), 3);
                                                        if (sizeof($arrlng) > 2) {
                                                            $newlng = number_format((float)((int)$arrlng[0] + ((((int)$arrlng[1] * 60) + ((float)$arrlng[2])) / 3600)), 4);
                                                        } else {
                                                            $newlng = number_format((float)$modelPDRM->logitude, 4);
                                                        }
                                                    } else {
                                                        $newlng = null;
                                                    }
                                                ?>
                                                <input readonly type="number" class="form-control" value="{{$newlat}}" >
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Longitude</span>
                                                </div>
                                                <input readonly type="number" class="form-control" value="{{$newlng}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-10">
                                            <div id="map_canvas_pdrm" style="width: 500px; height: 250px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-9 col-form-label">Kenderaan Terlibat:</label>
                                <div class="col-sm-3">
                                    <div class="text-right">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <div class= "col-sm-1"></div>
                                <div class= "col-sm-11">
                                    <?php $i = 0;
                                    $kenderaan = $modelPDRM->kenderaan ? json_decode($modelPDRM->kenderaan) : [];
                                    foreach($kenderaan as $kereta){
                                    ?>
                                    <?php $i++; ?>
                                    <div class="form-group row kenderaan-group">
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Jenis Kenderaan</span>
                                                </div>
                                                {!! html()->select('jenis_kenderaan', $jenis_kenderaan, $kereta->c_jenis_kenderaan)
                                                ->class('form-control m-b chosen-car-type')
                                                ->placeholder('')
                                                ->attribute('disabled', true) !!}
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Jenama Kenderaan</span>
                                                </div>
                                                <input readonly type="text" class="form-control" value="{{$kereta->c_jenama}}" >
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Model Kenderaan</span>
                                                </div>
                                                <input readonly type="text" class="form-control" value="{{$kereta->c_model_kenderaan}}" >
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Punca Kemalangan</span>
                                                </div>
                                                {!! html()->select('punca_kemalangan', $punca_kemalangan, $kereta->c_punca_kemalangan)
                                                ->class('form-control m-b chosen-cause-accident')
                                                ->placeholder('')
                                                ->attribute('disabled', true) !!}
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <span class="input-group-text">Tahun Dibuat</span>
                                                </div>
                                                <input readonly type="text" class="form-control" value="{{$kereta->c_tahun_dibuat}}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="text-right">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Jumlah Kematian:</label>
                                <div class="col-sm-2">
                                    <input type="number" readonly class="form-control" value="<?php echo ($modelPDRM->bil_pemandu_mati+$modelPDRM->bil_penumpang_mati+$modelPDRM->bil_pejalan_mati); ?>" >
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="input-group-text">Pemandu</span>
                                        </div>
                                        <input readonly type="number" class="form-control" value="{{$modelPDRM->bil_pemandu_mati}}" >
                                        <div class="input-group-addon">
                                            <span class="input-group-text">Penumpang</span>
                                        </div>
                                        <input readonly type="number" class="form-control" value="{{$modelPDRM->bil_penumpang_mati}}" >
                                        <div class="input-group-addon">
                                            <span class="input-group-text">Pejalan</span>
                                        </div>
                                        <input readonly type="number" class="form-control" value="{{$modelPDRM->bil_pejalan_mati}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Jenis Perlanggaran:</label>
                                <div class="col-sm-10">
                                    <input hidden type="text" value="{{$modelPDRM['jenis_langgar_pertama']}}">
                                    {!! html()->select('jenis_langgar_pertama', $jenis_langgar_pertama, (int)$modelPDRM['jenis_langgar_pertama'])
                                    ->class('form-control m-b chosen-crash-type')
                                    ->placeholder('')
                                    ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Cuaca Semasa Kemalangan:</label>
                                <div class="col-sm-10">
                                {!! html()->select('cuaca', $cuaca, (int)$modelPDRM['cuaca'])
                                ->class('form-control m-b chosen-weather')
                                ->placeholder('')
                                ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Keadaan Jalan</label>
                                <div class="col-sm-10">
                                {!! html()->select('keadaan_jalan', $keadaan_jalan, (int)$modelPDRM['keadaan_jalan'])
                                ->class('form-control m-b chosen-road-condition')
                                ->placeholder('')
                                ->id('keadaan_jalan')
                                ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Geometri Jalan</label>
                                <div class="col-sm-10">
                                {!! html()->select('bentuk_jalan', $bentuk_jalan, (int)$modelPDRM['bentuk_jalan'])
                                ->class('form-control m-b chosen-road-geometry')
                                ->placeholder('')
                                ->id('bentuk_jalan')
                                ->attribute('disabled', true) !!}
                                    </div>
                            </div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Punca Kemalangan</label>
                                <div class="col-sm-10">
                                {!! html()->select('kategori_kesilapan', $kategori_kesilapan, (int)$modelPDRM['kategori_kesilapan'])
                                ->class('form-control m-b chosen-cause-of-accident')
                                ->placeholder('')
                                ->id('punca_kemalangan')
                                ->attribute('disabled', true) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ditarik Pada</label>
                                <div class="col-sm-10">
                                    <label class="col-form-label">{{$modelPDRM->updated_at->format('d F Y')}}</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('inspinia/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script type="text/javascript">

    // var map;
    var marker;

var map;
var Overlays = [];
var iw;

function debounce(func, wait, immediate) {
    let timeout;
    return function () {
        let context = this,
        args = arguments;
        let later = function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
        };
        let callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

function getOverlayImage(bounds,map) {
    const mygosBaseURL = "https://mygos.mygeoportal.gov.my";
    const mygosMapServer =
        "/gisserver/rest/services/Fundamental_GDC/Transportation_SemenanjungMsia/MapServer";
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-map-service-layer-.htm
    const mygosMapServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/export"
    );
    // see https://developers.arcgis.com/rest/services-reference/enterprise/query-feature-service-layer-.htm
    const mygosFeatureServiceURL = new URL(
        mygosBaseURL + mygosMapServer + "/10/query"
    );
    const ne = bounds.getNorthEast();
    const sw = bounds.getSouthWest();
    const sr = 4326; // Spatial Reference

    const exportBBOX = sw.lng() + "," + sw.lat() + "," + ne.lng() + "," + ne.lat();
    const mapdiv = /*document.getElementById("map_canvas")*/ map.getDiv();
    mygosMapServiceURL.search = new URLSearchParams({
        bbox: exportBBOX,
        format: "png",
        transparent: "true",
        f: "image",
        bboxSR: sr,
        imageSR: sr,
        size: mapdiv.offsetWidth + "," + mapdiv.offsetHeight,
        layers: "show:10",
    });

    // Delete by remove all overlay in overlays array.
    while (Overlays[0]) {
        Overlays.pop().setMap(null);
    }

    const Overlay = new google.maps.GroundOverlay(
        mygosMapServiceURL.toString(),
        bounds,
        { map: map, opacity: 0.9 }
    );

    // Push new overlay into overlays array
    Overlays.push(Overlay);
    const metersPerPx =
        (156543.03392 * Math.cos((sw.lat() * Math.PI) / 180)) /
        Math.pow(2, map.getZoom());
    Overlay.addListener("click", (e) => {
        const queryURL = new URL(mygosFeatureServiceURL);
        queryURL.search = new URLSearchParams({
        where: "1=1",
        geometry:
            '{"x": ' +
            e.latLng.lng() +
            ', "y":' +
            e.latLng.lat() +
            ', "spatialReference":{"wkid":4326}}',
        geometryType: "esriGeometryPoint",
        inSR: sr,
        spatialRel: "esriSpatialRelIntersects",
        outFields: "*",
        distance: 4 * metersPerPx, // 4 pixels, distance from click to nearest feature
        units: "esriSRUnit_Meter",
        returnGeometry: false,
        resultRecordCount: 1,
        returnExtentOnly: false,
        featureEncoding: "esriDefault",
        f: "pjson",
        });
        fetch(queryURL)
        .then((r) => r.json())
        .then((r) => {
            if (!iw) {
            iw = new google.maps.InfoWindow();
            }
            iw.setPosition(e.latLng);
            if (r.features && r.features.length > 0) {
            iw.setContent(
                Object.entries(r.features[0].attributes)
                .map(
                    ([k, v]) =>
                    r.fieldAliases[k] + ": " + (v === null ? "" : v)
                )
                .join("<br>")
            );
            iw.open({ map });
            } else {
            iw.close();
            }
        });
    });
}
    function initialize() {

        var myLatlng = new google.maps.LatLng({{$model->latitude}}, {{$model->logitude}});

        var myOptions = {
            @if($action != 'kemaskini')
            draggable: false,
            @endif
            zoom: 17,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        // Avoid too many request to mygos mygeoportal server
        const didle = debounce(function () {
        getOverlayImage(map.getBounds(),map);
        }, 600);
        google.maps.event.addListener(map, "idle", didle);

        marker = new google.maps.Marker({
            @if($action == 'kemaskini')
            draggable: true,
            @endif
            position: myLatlng,
            map: map,
            title: "Your location"
        });
        @if($action == 'kemaskini')
        google.maps.event.addListener(marker, 'dragend', function (event) {
            console.log("hi :" + document.getElementsByName("latitude").value );
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("logitude").value = event.latLng.lng();
        });
        @endif

        //PDRM
        @if(!empty($newlat) && !empty($newlng))
        var myLatlngPdrm = new google.maps.LatLng({{$newlat}}, {{$newlng}});

        var myOptionsPdrm = {
            draggable: false,
            zoom: 17,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        mapPdrm = new google.maps.Map(document.getElementById("map_canvas_pdrm"), myOptionsPdrm);

        // Avoid too many request to mygos mygeoportal server
        const didlePdrm = debounce(function () {
        getOverlayImage(mapPdrm.getBounds(),mapPdrm);
        }, 600);
        google.maps.event.addListener(mapPdrm, "idle", didlePdrm);

        markerPdrm = new google.maps.Marker({
            draggable: true,
            position: myLatlngPdrm,
            map: mapPdrm,
            title: "Your location"
        });
        @endif
    }
    google.maps.event.addDomListener(window, "load", initialize())


    $(document).on('change','#latitude, #logitude',function() {
        var myLatlng = new google.maps.LatLng($('#latitude').val(), $('#logitude').val());
        marker.setPosition(myLatlng);
        map.panTo(myLatlng);
    });

    $("#bil_pemandu_mati,#bil_penumpang_mati,#bil_pejalan_mati").on('change keyup', function() {
        var bil_pemandu_mati = parseInt($('#bil_pemandu_mati').val());
        var bil_penumpang_mati = parseInt($('#bil_penumpang_mati').val());
        var bil_pejalan_mati = parseInt($('#bil_pejalan_mati').val());
        var bil_mati = bil_pemandu_mati + bil_penumpang_mati + bil_pejalan_mati;
        $('#bil_mati').val(bil_mati);
    });

    $(document).on('click', '.confirmation', function (e) {
        if (!confirm('Adakah anda pasti?')) e.preventDefault();
    });

    $(document).on('click', '.btn-add', function(e){
        var html = '<div id="inputFormRow" class="form-group row kenderaan-group">' +
                        '<div class="col-sm-9">' +
                            '<input hidden type="text" name="kenderaan_id[]" value="">' +
                            '<div class="input-group">' +
                                '<div class="input-group-addon">' +
                                    '<span class="input-group-text">Jenis Kenderaan</span>' +
                                '</div>' +
                                "{!! html()->select('jenis_kenderaan[]', $jenis_kenderaan, '')->class('form-control m-b chosen-car-type')->placeholder('Pilih Jenis Kenderaan') !!}" +
                            '</div>' +
                            '<div class="input-group">' +
                                '<div class="input-group-addon">' +
                                    '<span class="input-group-text">Jenama Kenderaan</span>' +
                                '</div>' +
                                '<input type="text" class="form-control" name="jenama[]" value="">' +
                            '</div>' +
                            '<div class="input-group">' +
                                '<div class="input-group-addon">' +
                                    '<span class="input-group-text">Model Kenderaan</span>' +
                                '</div>' +
                                '<input type="text" class="form-control" name="model_kenderaan[]" value="" >' +
                            '</div>' +
                            '<div class="input-group">' +
                                '<div class="input-group-addon">' +
                                    '<span class="input-group-text">Punca Kemalangan</span>' +
                                '</div>' +
                                "{!! html()->select('kenderaan_punca_kemalangan[]', $punca_kemalangan, '')->class('form-control m-b chosen-cause-accident')->placeholder('Pilih Punca Kemalangan') !!}" +
                            '</div>' +
                            '<div class="input-group">' +
                                '<div class="input-group-addon">' +
                                    '<span class="input-group-text">Tahun Dibuat</span>' +
                                '</div>' +
                                '<input type="text" class="form-control" name="tahun_dibuat[]" value="" >' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-3">' +
                            '<div class="text-right">' +
                                '<button class="btn btn-outline btn-danger btn-block btn-remove" type="button">' +
                                    '<i class="glyphicon glyphicon-remove"> | Buang Kenderaan</i>' +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
        $('#newRow').append(html);
    });

    $(document).on('click', '.btn-remove', function(e){
        $(this).closest('#inputFormRow').remove();
    });

    $("#keadaan_jalan").on('change', function() {
        var id = $(this).attr('id');
        if($(this).val() != '100'){
            $("#form_"+id+"_penerangan").hide();
            $("#form_"+id+"_penerangan").val('');
        }
        else
            $("#form_"+id+"_penerangan").show();
    });

    $("#keadaan_jalan,#bentuk_jalan").on('change', function() {
        console.log("test lain2");
        var id = $(this).attr('id');
        if($(this).val() != '100'){
            $("#form_"+id+"_penerangan").hide();
            $("#"+id+"_penerangan").val('');
        }
        else
            $("#form_"+id+"_penerangan").show();
    });


    $("#punca_kemalangan").on('change', function() {
        console.log("test lain2");
        var id = $(this).attr('id');
        if($(this).val() != '16'){
            $("#form_"+id+"_penerangan").hide();
            $("#"+id+"_penerangan").val('');
        }
        else
            $("#form_"+id+"_penerangan").show();
    });

    function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(id)
                        .attr('src', e.target.result)
                        .width(300)
                        .height(150);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#update-fdata').click(function() {
        $('#form-LaporanAwalan').attr("action", "./laporanAwalanPost");  //change the form action
        $('#form-LaporanAwalan').attr("method", "POST");
        $('#form-LaporanAwalan').attr("target", "_self");
        $('#form-LaporanAwalan').submit();  // submit the form
    });

    $('#kemaskini-fdata').click(function() {
        var id = $('input[name=accident_id]').val();
        $.ajax({
            url: "ajaxlaporanawalan&id="+id,
            type: "GET",
            success: function(data){
                $(".breadcrumb").find("li:contains('Paparan Maklumat')").remove();
                $(".breadcrumb").append('Kemaskini Maklumat');
                $("#wrapper-laporan-awalan").html(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert(errorThrown);
            }
        });
        // $('#form-LaporanAwalan').attr("action", "./ajaxlaporanawalan&id="+$('input[name=accident_id]').val());  //change the form action
        // $('#form-LaporanAwalan').attr("method", "GET");
        // $('#form-LaporanAwalan').submit();  // submit the form
    });

    $('#hantar-fdata').click(function() {
        $('#form-LaporanAwalan').attr("action", "./laporanAwalanHantar");  //change the form action
        $('#form-LaporanAwalan').attr("method", "POST");
        $('#form-LaporanAwalan').attr("target", "_self");
        $('#form-LaporanAwalan').submit();  // submit the form
    });

    $('#sah-fdata').click(function() {
        $('#form-LaporanAwalan').attr("action", "./laporanAwalanSah");  //change the form action
        $('#form-LaporanAwalan').attr("method", "POST");
        $('#form-LaporanAwalan').attr("target", "_self");
        $('#form-LaporanAwalan').submit();  // submit the form
    });

    $('#pdf-fdata').click(function() {
        $('#form-LaporanAwalan').attr("action", "./laporanAwalanPdf");  //change the form action
        $('#form-LaporanAwalan').attr("method", "POST");
        $('#form-LaporanAwalan').attr("target", "_blank");
        $('#form-LaporanAwalan').submit();  // submit the form
    });

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    $('.chosen-no-laluan').chosen({
        width: "100%"
    });
</script>
@endsection

@section('js')
<script src="{{ URL::asset('rams/js/laporanAwalanForm.js') }}"></script>
@endsection