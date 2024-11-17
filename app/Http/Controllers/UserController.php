<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Negeri;
use App\Models\Daerah;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function userUser(){
		$role = Role::orderBy('id')->pluck('name','id');
		$department = Department::pluck('name','id');
        $negeri = Negeri::pluck('name','id');
        $daerah = Daerah::pluck('name','id');

        return view('site.userlist', compact('role','department','negeri','daerah'));
    }

	public function getUserData()
    {
        // DB::enableQueryLog();
        $rs = User::with('department')->with('role')
            ->where(function($cond){
                if(!Auth::user()->admin()){
                    if(Auth::user()->adminjkr()){
                        $role = ['4','5','6'];
                        $cond->whereIn('role_id',$role);
                    }
                    if(Auth::user()->jkrnegeri()){
                        $role = ['5','6'];
                        $cond->whereIn('role_id',$role)->where('negeri_id', Auth::user()->negeri_id);
                    }
                    if(Auth::user()->jkrdaerah()){
                        $cond->where('role_id',Auth::user()->role_id)
                        ->whereHas('daerah',function (Builder $query) {
                            $query->whereIn('daerah_id', Auth::user()->daerah()->pluck('daerah_id')->toArray());
                        });

                    }

                   // $cond->orWhereIn('role_id',['2','99']);

                }
            });

    	return DataTables::of($rs)
			->editColumn('department', function ($rs) {
				return  ($rs->department->name=='TIDAK DIKETAHUI' ? '-' : $rs->department->name).'<BR>'.( empty($rs->negeri) ? '' :  $rs->negeri->name).'<BR>'.(empty($rs->daerah()) ? '' : implode(',',$rs->daerah()->pluck('name')->toArray()));
			})
			->addColumn('role', function ($rs) {
				return $rs->role->name;
			})
			->addColumn('created_at', function ($rs) {
				return $rs->created_at ? with(new Carbon($rs->created_at))->format('d/m/Y H:i') : '';
			})
			->editColumn('sekatan', function ($rs) {
				$color = $rs->sekatan == 'AKTIF' ? 'label-primary' : 'label-danger';
				return "<span class='label ".$color." text-lg'>".$rs->sekatan."</span>";
			})
			->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("to_char(created_at,'dd/MM/yyyy hh24:mi') like ?", ["%$keyword%"]);
            })
			->addColumn('action', function ($rs) {
                $action =
                    '<a class="btn btn-outline btn-sm btn-primary user-view" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Papar Pengguna"><i class="fa fa-search"></i></a>';
                    if(Auth::user()->admin()){
                        $action .= '<a class="btn btn-outline btn-sm btn-warning user-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Pengguna"><i class="fa fa-edit"></i></a>';


                    $action .= '<a class="btn btn-outline btn-sm btn-danger user-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Pengguna"><i class="fa fa-trash"></i></a>';
                }

				return $action;
			})
			->rawColumns(['sekatan','action','department'])
			->toJson();
    }

    public function ajaxViewUser($id){
        $rs = User::findOrFail($id);
		$rs->department;
		$rs->role;
        $rs['state'] = $rs->negeri_id != null ? $rs->negeri->name : '';
        $rs['district'] = $rs->daerah->pluck('name');
        $rs['district_id'] = $rs->daerah->pluck('id');
        // $rs['district'] = !empty($rs->daerah) ? $rs->daerah->name : '';
		$rs['created'] = $rs->created_at ? with(new Carbon($rs->created_at))->format('d/m/Y H:i') : '';
		$rs['login'] = $rs->lastlogin ? with(new Carbon($rs->lastlogin))->format('d/m/Y H:i') : '';
		$rs['logout'] = $rs->lastlogout ? with(new Carbon($rs->lastlogout))->format('d/m/Y H:i') : '';

        return $rs;
    }

    public function ajaxUpdateUser(Request $request, $id){
        $rs = User::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_email'=> 'required|email',
            'e_state'=>'required_if:role_id,5',
            'e_district'=>'required_if:role_id,6',
            'e_password'=> 'nullable|min:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#])[A-Za-z\d$@$!%*?&#]/',
        ],[
			'email.email' => 'Alamat emel mesti sah!',
			'negeri_id.required_if' => 'Sila pilih Negeri!',
			'daerah_id.required_if' => 'Sila pilih Daerah!',
            'e_password.min' => 'Kata laluan mesti sekurang-kurangnya dua belas (12) aksara!',
			'e_password.regex' => 'Kata Laluan mesti sekurang-kurangnya mempunyai satu huruf besar, satu huruf kecil, satu nombor dan satu simbol!',
		]);

		$rs->fullname = $request->input('e_full_name');
        $rs->role_id = $request->input('e_role');
        $rs->negeri_id = $request->input('e_state');
        // $rs->daerah_id = $request->input('e_district');
        if(!empty($request->input('e_password'))){
            $rs->password = bcrypt($request->input('e_password'));
        }
        $rs->department_id = $request->input('e_department');
        $rs->email = $request->input('e_email');
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();

            $rs->daerah()->detach();
            $rs->daerah()->attach($request->input('e_district'));

            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Pengguna telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            foreach($validator->errors()->getMessages() as $error) {
                foreach($error as $error_msg){
                    $rs['error_form'] .= $error_msg.'<br>';
                }
            }
            $rs['error_form'] .= '
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteUser($id){
        $rs = User::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Pengguna telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Pengguna tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterUser(Request $request){
        $rs = new User();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'icno'=> 'numeric|digits_between:12,14|unique_custom:users,icno,disable,ACTIVE',
            'password'=> 'required|min:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]/',
            'email'=> 'required|email',
            'negeri_id'=>'required_if:role_id,5',
            'daerah_id'=>'required_if:role_id,6'
        ],[
			'icno.numeric' => 'Nombor Kad Pengenalan mesti di dalam format nombor!',
			'icno.digits_between' => 'Nombor Kad Pengenalan mesti sekurang-kurangnya dua belas (12) aksara!',
			'icno.unique_custom' => 'Nombor Kad Pengenalan ini telah diambil!',
			'password.min' => 'Kata laluan mesti sekurang-kurangnya dua belas (12) aksara!',
			'password.regex' => 'Kata Laluan mesti sekurang-kurangnya mempunyai satu huruf besar, satu huruf kecil, satu nombor dan satu simbol!',
			'email.email' => 'Alamat emel mesti sah!',
			'negeri_id.required_if' => 'Sila pilih Negeri!',
			'daerah_id.required_if' => 'Sila pilih Daerah!',
		]);

		$rs->fullname = $request->input('fullname');
        $rs->icno = $request->input('icno');
        $rs->role_id = $request->input('role_id');
        $rs->negeri_id = $request->input('negeri_id');
        // $rs->daerah_id = $request->input('daerah_id');
        $rs->department_id = $request->input('department_id');
        $rs->email = $request->input('email');
		$rs->password = bcrypt($request->input('password'));
		$rs->sekatan = 'AKTIF';
		$rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

		if(!$validator->fails()){
			$rs->save();
            $rs->daerah()->attach($request->input('daerah_id'));
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Pengguna telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

	public function userRole(){
        return view('site.userrole');
    }

	public function getRoleData()
    {
        $rs = Role::all();

    	return DataTables::of($rs)
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning role-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Peranan"><i class="fa fa-edit"></i></a>
					<a class="btn btn-outline btn-sm btn-danger role-delete" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Hapus Peranan"><i class="fa fa-trash"></i></a>';
			})
			->toJson();
    }

    public function ajaxViewRole($id){
        $rs = Role::findOrFail($id);

        return $rs;
    }

    public function ajaxUpdateRole(Request $request, $id){
        $rs = Role::findOrFail($id);
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'e_name'=> 'unique_custom:roles,name,disable,ACTIVE'
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
                                                    Peranan telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Peranan ini sudah wujud.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxDeleteRole($id){
        $rs = Role::findOrFail($id);
		$userid = Auth::user()->id;

		$rs->disable = 'INACTIVE';
        $rs->updated_by = $userid;

		if($rs->save()){
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Peranan telah berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Peranan tidak berjaya dihapus.
                                                </div>
                                            </div>
                                        </div>';
        }

        return $rs;
    }

	public function ajaxRegisterRole(Request $request){
        $rs = new Role();
		$userid = Auth::user()->id;

		$validator = Validator::make($request->all(), [
            'name'=> 'unique_custom:roles,name,disable,ACTIVE'
        ],[
			'name.unique_custom' => 'Nama Peranan ini telah diambil!'
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
                                                    Peranan telah berjaya didaftarkan.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }

 public function userProfile(){
		$role = Role::pluck('name','id');
		$department = Department::pluck('name','id');
        return view('site.userprofile', compact('role','department'));
    }

    public function getUserProfil()
    {

        $rs = User::where('id', Auth::user()->id)->with('department')->with('role');
    	return DataTables::of($rs)
			->addColumn('department', function ($rs) {
				return $rs->department->name;
			})
			->addColumn('role', function ($rs) {
				return $rs->role->name;
			})
			->addColumn('created_at', function ($rs) {
				return $rs->created_at ? with(new Carbon($rs->created_at))->format('d/m/Y H:i') : '';
			})
			->editColumn('sekatan', function ($rs) {
				$color = $rs->sekatan == 'AKTIF' ? 'label-primary' : 'label-danger';
				return "<span class='label ".$color." text-lg'>".$rs->sekatan."</span>";
			})
			->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("to_char(created_at,'dd/MM/yyyy hh24:mi') like ?", ["%$keyword%"]);
            })
			->addColumn('action', function ($rs) {
				return
					'<a class="btn btn-outline btn-sm btn-warning user-profile-edit" data-id="'.$rs->id.'" data-toggle="tooltip" data-placement="top" title="Kemaskini Pengguna"><i class="fa fa-edit"></i></a>';
			})
			->rawColumns(['sekatan','action'])
			->toJson();
    }

    public function ajaxUpdatePassword(Request $request, $id){
        $rs = User::findOrFail($id);

				$validator = Validator::make($request->all(), [
				'e_password'=> 'required|min:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]/',

        ],
		[
			'e_password.min' => 'Kata laluan mesti sekurang-kurangnya dua belas (12) aksara!',
			'e_password.regex' => 'Kata Laluan mesti sekurang-kurangnya mempunyai satu huruf besar, satu huruf kecil, satu nombor dan satu simbol!',

		]);

		$rs->password = bcrypt($request->input('e_password'));
		$rs->save();
		if(!$validator->fails()){
			$rs->save();
            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Password telah berjaya dikemaskini.
                                                </div>
                                            </div>
                                        </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors() ;

        }

        return $rs;
    }
    public function userManual(){
        return redirect(asset("/Uploads/Manual/RAMS_Manual_Pengguna.pdf"));
    }

}


