@extends('layouts/main/main')



@section('content')
<div id="rams" class="wrapper wrapper-content tabcontent">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Laporan Analisis Waran</h5>
                </div>

                <div class="ibox-content">
                    <form action="">
                        <h3>Maklumat Umum</h3>
                        <hr style="color:black">
                        <div class="modal-body">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Rujukan Surat Pemohon </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">No Laporan </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Punca Permohonan </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>
                        </div>

                        <h3>Maklumat Lokasi</h3>
                        <hr>
                        <div class="modal-body">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Negeri </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">No Laluan </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Jalan </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Daerah </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Seksyen </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Kawasan </label>
                                <div class="col-sm-10"><input type="text" id="no_laporan" name="no_laporan" class="form-control" value=""></div>
                            </div>
                        </div>

                        <h3>Rujukan</h3>
                        <hr>
                        <div class="modal-body">
                            <div class="form-group  row">
                                <label class="">Pada dasarnya, terdapat dua keadaan waran pemasangan lampu jalan di jalan sedia ada untuk di analisis iaitu: </label>
                                <ol>
                                    <li>Persimpangan Jalan</li>
                                    <li>Jalan di jajaran tengah </li>
                                </ol>
                            </div>
                        </div>

                        <h3>Analisa</h3>
                        <hr>
                        <div class="modal-body">
                            <div class="form-group  row">
                                <label class="">Jenis Analisa </label>
                                <table class="table table-striped">
                                    <tr>
                                        <td>Persimpangan</td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                    <tr>
                                        <td>Midblock</td>
                                        <td><input type="checkbox"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
						
						<div class="row">
							<div class="text-right">
								<a class="btn btn-success" href="{{route('borangHantar')}}">Hantar</a>
							</div>
						</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection