<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Arah;
use App\Models\Balai;
use App\Models\BentukJalan;
use App\Models\Bulan;
use App\Models\Cahaya;
use App\Models\Cuaca;
use App\Models\Daerah;
use App\Models\Department;
use App\Models\HadLaju;
use App\Models\Hari;
use App\Models\JenisBahuJalan;
use App\Models\JenisGaris;
use App\Models\JenisJalan;
use App\Models\JenisKawalan;
use App\Models\JenisKawasan;
use App\Models\JenisKemalangan;
use App\Models\JenisLanggarPertama;
use App\Models\JenisPermukaan;
use App\Models\JenisTempat;
use App\Models\KeadaanJalan;
use App\Models\KualitiPermukaan;
use App\Models\LanggarLari;
use App\Models\MukaJalan;
use App\Models\Negeri;
use App\Models\SebabBinatang;
use App\Models\SebabCacatJalan;
use App\Models\SistemLaluan;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function arah(){
        return view('senggara.arah');
    }

	public function getArahData()
    {
        $rs = Arah::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning arah-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Arah"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger arah-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Arah"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewArah($id){
        $rs = Arah::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateArah(Request $request, $id){
        $rs = Arah::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:arahs,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Arah telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Arah ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteArah($id){
        $rs = Arah::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Arah telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Arah tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterArah(Request $request){
        $rs = new Arah();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:arahs,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Arah ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Arah telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function balai(){
        return view('senggara.balai');
    }

	public function getBalaiData()
    {
        $rs = Balai::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning balai-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Balai"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger balai-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Balai"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewBalai($id){
        $rs = Balai::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateBalai(Request $request, $id){
        $rs = Balai::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:balais,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Balai telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Balai ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteBalai($id){
        $rs = Balai::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Balai telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Balai tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterBalai(Request $request){
        $rs = new Balai();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:balais,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Balai ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Balai telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function bentukJalan(){
        return view('senggara.bentukJalan');
    }

	public function getBentukJalanData()
    {
        $rs = BentukJalan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning bentukJalan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Bentuk Jalan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger bentukJalan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Bentuk Jalan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewBentukJalan($id){
        $rs = BentukJalan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateBentukJalan(Request $request, $id){
        $rs = BentukJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:bentuk_jalans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bentuk Jalan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bentuk Jalan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteBentukJalan($id){
        $rs = BentukJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bentuk Jalan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bentuk Jalan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterBentukJalan(Request $request){
        $rs = new BentukJalan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:bentuk_jalans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Bentuk Jalan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bentuk Jalan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function bulan(){
        return view('senggara.bulan');
    }

	public function getBulanData()
    {
        $rs = Bulan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning bulan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Bulan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger bulan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Bulan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewBulan($id){
        $rs = Bulan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateBulan(Request $request, $id){
        $rs = Bulan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:bulans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bulan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bulan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteBulan($id){
        $rs = Bulan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bulan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bulan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterBulan(Request $request){
        $rs = new Bulan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:bulans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Bulan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bulan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function cahaya(){
        return view('senggara.cahaya');
    }

	public function getCahayaData()
    {
        $rs = Cahaya::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning cahaya-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Cahaya"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger cahaya-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Cahaya"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewCahaya($id){
        $rs = Cahaya::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateCahaya(Request $request, $id){
        $rs = Cahaya::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:cahayas,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cahaya telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cahaya ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteCahaya($id){
        $rs = Cahaya::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cahaya telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cahaya tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterCahaya(Request $request){
        $rs = new Cahaya();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:cahayas,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Cahaya ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cahaya telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function cuaca(){
        return view('senggara.cuaca');
    }

	public function getCuacaData()
    {
        $rs = Cuaca::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning cuaca-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Cuaca"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger cuaca-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Cuaca"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewCuaca($id){
        $rs = Cuaca::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateCuaca(Request $request, $id){
        $rs = Cuaca::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:cuacas,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cuaca telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cuaca ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteCuaca($id){
        $rs = Cuaca::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cuaca telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cuaca tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterCuaca(Request $request){
        $rs = new Cuaca();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:cuacas,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Cuaca ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Cuaca telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function daerah(){
        return view('senggara.daerah');
    }

	public function getDaerahData()
    {
        $rs = Daerah::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning daerah-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Daerah"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger daerah-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Daerah"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewDaerah($id){
        $rs = Daerah::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateDaerah(Request $request, $id){
        $rs = Daerah::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:daerahs,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Daerah telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Daerah ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteDaerah($id){
        $rs = Daerah::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Daerah telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Daerah tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterDaerah(Request $request){
        $rs = new Daerah();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:daerahs,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Daerah ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Daerah telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function department(){
        return view('senggara.department');
    }

	public function getDepartmentData()
    {
        $rs = Department::all();

    	return DataTables::of($rs)
            ->addColumn('jenis',function($rs){
                return Department::JenisBahagian($rs->jenis);
            })
			->addColumn('action', function ($rs) {
                $action =
                    '<a class="btn btn-outline btn-sm btn-warning department-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Bahagian"><i class="fa fa-edit"></i></a>';

                if(Auth::user()->admin()){
                    $action .= '<a class="btn btn-outline btn-sm btn-danger department-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Bahagian"><i class="fa fa-trash"></i></a>';
                }

				return $action;
			})
			->toJson();
    }

    public function ajaxViewDepartment($id){
        $rs = Department::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateDepartment(Request $request, $id){
        $rs = Department::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:departments,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bahagian telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bahagian ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteDepartment($id){
        $rs = Department::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bahagian telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bahagian tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterDepartment(Request $request){
        $rs = new Department();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:departments,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Bahagian ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Bahagian telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function hadLaju(){
        return view('senggara.hadLaju');
    }

	public function getHadLajuData()
    {
        $rs = HadLaju::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning hadLaju-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Had Laju"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger hadLaju-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Had Laju"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewHadLaju($id){
        $rs = HadLaju::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateHadLaju(Request $request, $id){
        $rs = HadLaju::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:had_lajus,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Had Laju telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Had Laju ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteHadLaju($id){
        $rs = HadLaju::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Had Laju telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Had Laju tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterHadLaju(Request $request){
        $rs = new HadLaju();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:had_lajus,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Had Laju ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Had Laju telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function hari(){
        return view('senggara.hari');
    }

	public function getHariData()
    {
        $rs = Hari::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning hari-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Hari"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger hari-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Hari"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewHari($id){
        $rs = Hari::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateHari(Request $request, $id){
        $rs = Hari::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:haris,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Hari telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Hari ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteHari($id){
        $rs = Hari::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Hari telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Hari tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterHari(Request $request){
        $rs = new Hari();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:haris,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Hari ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Hari telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisBahuJalan(){
        return view('senggara.jenisBahuJalan');
    }

	public function getJenisBahuJalanData()
    {
        $rs = JenisBahuJalan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisBahuJalan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Bahu Jalan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisBahuJalan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Bahu Jalan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisBahuJalan($id){
        $rs = JenisBahuJalan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisBahuJalan(Request $request, $id){
        $rs = JenisBahuJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_bahu_jalans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Bahu Jalan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Bahu Jalan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisBahuJalan($id){
        $rs = JenisBahuJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Bahu Jalan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Bahu Jalan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisBahuJalan(Request $request){
        $rs = new JenisBahuJalan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_bahu_jalans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Bahu Jalan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Bahu Jalan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisGaris(){
        return view('senggara.jenisGaris');
    }

	public function getJenisGarisData()
    {
        $rs = JenisGaris::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisGaris-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Garis"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisGaris-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Garis"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisGaris($id){
        $rs = JenisGaris::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisGaris(Request $request, $id){
        $rs = JenisGaris::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_garis,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Garis telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Garis ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisGaris($id){
        $rs = JenisGaris::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Garis telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Garis tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisGaris(Request $request){
        $rs = new JenisGaris();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_garis,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Garis ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Garis telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisJalan(){
        return view('senggara.jenisJalan');
    }

	public function getJenisJalanData()
    {
        $rs = JenisJalan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisJalan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Jalan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisJalan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Jalan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisJalan($id){
        $rs = JenisJalan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisJalan(Request $request, $id){
        $rs = JenisJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_jalans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Jalan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Jalan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisJalan($id){
        $rs = JenisJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Jalan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Jalan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisJalan(Request $request){
        $rs = new JenisJalan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_jalans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Jalan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Jalan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisKawalan(){
        return view('senggara.jenisKawalan');
    }

	public function getJenisKawalanData()
    {
        $rs = JenisKawalan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisKawalan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Kawalan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisKawalan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Kawalan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisKawalan($id){
        $rs = JenisKawalan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisKawalan(Request $request, $id){
        $rs = JenisKawalan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_kawalans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawalan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawalan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisKawalan($id){
        $rs = JenisKawalan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawalan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawalan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisKawalan(Request $request){
        $rs = new JenisKawalan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_kawalans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Kawalan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawalan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisKawasan(){
        return view('senggara.jenisKawasan');
    }

	public function getJenisKawasanData()
    {
        $rs = JenisKawasan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisKawasan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Kawasan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisKawasan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Kawasan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisKawasan($id){
        $rs = JenisKawasan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisKawasan(Request $request, $id){
        $rs = JenisKawasan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_kawasans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawasan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawasan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisKawasan($id){
        $rs = JenisKawasan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawasan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawasan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisKawasan(Request $request){
        $rs = new JenisKawasan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_kawasans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Kawasan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kawasan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisKemalangan(){
        return view('senggara.jenisKemalangan');
    }

	public function getJenisKemalanganData()
    {
        $rs = JenisKemalangan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisKemalangan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Kemalangan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisKemalangan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Kemalangan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisKemalangan($id){
        $rs = JenisKemalangan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisKemalangan(Request $request, $id){
        $rs = JenisKemalangan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_kemalangans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kemalangan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kemalangan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisKemalangan($id){
        $rs = JenisKemalangan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kemalangan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kemalangan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisKemalangan(Request $request){
        $rs = new JenisKemalangan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_kemalangans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Kemalangan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Kemalangan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisLanggarPertama(){
        return view('senggara.jenisLanggarPertama');
    }

	public function getJenisLanggarPertamaData()
    {
        $rs = JenisLanggarPertama::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisLanggarPertama-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Langgar Pertama"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisLanggarPertama-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Langgar Pertama"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisLanggarPertama($id){
        $rs = JenisLanggarPertama::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisLanggarPertama(Request $request, $id){
        $rs = JenisLanggarPertama::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_langgar_pertamas,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Langgar Pertama telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Langgar Pertama ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisLanggarPertama($id){
        $rs = JenisLanggarPertama::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Langgar Pertama telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Langgar Pertama tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisLanggarPertama(Request $request){
        $rs = new JenisLanggarPertama();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_langgar_pertamas,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Langgar Pertama ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Langgar Pertama telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisPermukaan(){
        return view('senggara.jenisPermukaan');
    }

	public function getJenisPermukaanData()
    {
        $rs = JenisPermukaan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisPermukaan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Permukaan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisPermukaan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Permukaan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisPermukaan($id){
        $rs = JenisPermukaan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisPermukaan(Request $request, $id){
        $rs = JenisPermukaan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_permukaans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Permukaan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Permukaan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisPermukaan($id){
        $rs = JenisPermukaan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Permukaan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Permukaan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisPermukaan(Request $request){
        $rs = new JenisPermukaan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_permukaans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Permukaan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Permukaan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function jenisTempat(){
        return view('senggara.jenisTempat');
    }

	public function getJenisTempatData()
    {
        $rs = JenisTempat::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning jenisTempat-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Jenis Tempat"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger jenisTempat-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Jenis Tempat"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewJenisTempat($id){
        $rs = JenisTempat::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateJenisTempat(Request $request, $id){
        $rs = JenisTempat::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:jenis_tempats,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Tempat telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Tempat ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteJenisTempat($id){
        $rs = JenisTempat::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Tempat telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Tempat tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterJenisTempat(Request $request){
        $rs = new JenisTempat();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:jenis_tempats,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Jenis Tempat ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Jenis Tempat telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function keadaanJalan(){
        return view('senggara.keadaanJalan');
    }

	public function getKeadaanJalanData()
    {
        $rs = KeadaanJalan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning keadaanJalan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Keadaan Jalan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger keadaanJalan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Keadaan Jalan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewKeadaanJalan($id){
        $rs = KeadaanJalan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateKeadaanJalan(Request $request, $id){
        $rs = KeadaanJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:keadaan_jalans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Keadaan Jalan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Keadaan Jalan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteKeadaanJalan($id){
        $rs = KeadaanJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Keadaan Jalan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Keadaan Jalan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterKeadaanJalan(Request $request){
        $rs = new KeadaanJalan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:keadaan_jalans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Keadaan Jalan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Keadaan Jalan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function kualitiPermukaan(){
        return view('senggara.kualitiPermukaan');
    }

	public function getKualitiPermukaanData()
    {
        $rs = KualitiPermukaan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning kualitiPermukaan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Kualiti Permukaan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger kualitiPermukaan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Kualiti Permukaan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewKualitiPermukaan($id){
        $rs = KualitiPermukaan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateKualitiPermukaan(Request $request, $id){
        $rs = KualitiPermukaan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:kualiti_permukaans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Kualiti Permukaan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Kualiti Permukaan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteKualitiPermukaan($id){
        $rs = KualitiPermukaan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Kualiti Permukaan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Kualiti Permukaan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterKualitiPermukaan(Request $request){
        $rs = new KualitiPermukaan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:kualiti_permukaans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Kualiti Permukaan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Kualiti Permukaan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function langgarLari(){
        return view('senggara.langgarLari');
    }

	public function getLanggarLariData()
    {
        $rs = LanggarLari::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning langgarLari-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Langgar Lari"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger langgarLari-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Langgar Lari"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewLanggarLari($id){
        $rs = LanggarLari::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateLanggarLari(Request $request, $id){
        $rs = LanggarLari::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:langgar_laris,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Langgar Lari telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Langgar Lari ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteLanggarLari($id){
        $rs = LanggarLari::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Langgar Lari telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Langgar Lari tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterLanggarLari(Request $request){
        $rs = new LanggarLari();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:langgar_laris,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Langgar Lari ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Langgar Lari telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function mukaJalan(){
        return view('senggara.mukaJalan');
    }

	public function getMukaJalanData()
    {
        $rs = MukaJalan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning mukaJalan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Muka Jalan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger mukaJalan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Muka Jalan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewMukaJalan($id){
        $rs = MukaJalan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateMukaJalan(Request $request, $id){
        $rs = MukaJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:muka_jalans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Muka Jalan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Muka Jalan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteMukaJalan($id){
        $rs = MukaJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Muka Jalan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Muka Jalan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterMukaJalan(Request $request){
        $rs = new MukaJalan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:muka_jalans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Muka Jalan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Muka Jalan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function negeri(){
        return view('senggara.negeri');
    }

	public function getNegeriData()
    {
        $rs = Negeri::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning negeri-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Negeri"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger negeri-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Negeri"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewNegeri($id){
        $rs = Negeri::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateNegeri(Request $request, $id){
        $rs = Negeri::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:negeris,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Negeri telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Negeri ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteNegeri($id){
        $rs = Negeri::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Negeri telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Negeri tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterNegeri(Request $request){
        $rs = new Negeri();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:negeris,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Negeri ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Negeri telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function sebabBinatang(){
        return view('senggara.sebabBinatang');
    }

	public function getSebabBinatangData()
    {
        $rs = SebabBinatang::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning sebabBinatang-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Sebab Binatang"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger sebabBinatang-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Sebab Binatang"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewSebabBinatang($id){
        $rs = SebabBinatang::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateSebabBinatang(Request $request, $id){
        $rs = SebabBinatang::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:sebab_binatangs,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Binatang telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Binatang ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteSebabBinatang($id){
        $rs = SebabBinatang::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Binatang telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Binatang tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterSebabBinatang(Request $request){
        $rs = new SebabBinatang();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:sebab_binatangs,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Sebab Binatang ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Binatang telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function sebabCacatJalan(){
        return view('senggara.sebabCacatJalan');
    }

	public function getSebabCacatJalanData()
    {
        $rs = SebabCacatJalan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning sebabCacatJalan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Sebab Cacat Jalan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger sebabCacatJalan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Sebab Cacat Jalan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewSebabCacatJalan($id){
        $rs = SebabCacatJalan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateSebabCacatJalan(Request $request, $id){
        $rs = SebabCacatJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:sebab_cacat_jalans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Cacat Jalan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Cacat Jalan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteSebabCacatJalan($id){
        $rs = SebabCacatJalan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Cacat Jalan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Cacat Jalan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterSebabCacatJalan(Request $request){
        $rs = new SebabCacatJalan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:sebab_cacat_jalans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Sebab Cacat Jalan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sebab Cacat Jalan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function sistemLaluan(){
        return view('senggara.sistemLaluan');
    }

	public function getSistemLaluanData()
    {
        $rs = SistemLaluan::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning sistemLaluan-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Sistem Laluan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger sistemLaluan-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Sistem Laluan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewSistemLaluan($id){
        $rs = SistemLaluan::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateSistemLaluan(Request $request, $id){
        $rs = SistemLaluan::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:sistem_laluans,name,disable,ACTIVE'
        ]);

		$rs->name = $request->input('e_name');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sistem Laluan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sistem Laluan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteSistemLaluan($id){
        $rs = SistemLaluan::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sistem Laluan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sistem Laluan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterSistemLaluan(Request $request){
        $rs = new SistemLaluan();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:sistem_laluans,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Sistem Laluan ini telah diambil!'
		]);

		$rs->name = $request->input('name');
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Sistem Laluan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }
}
