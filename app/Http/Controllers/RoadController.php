<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Jalan;
use App\Models\Negeri;
use App\Models\JenisJalan;
use Illuminate\Support\Facades\Auth;

class RoadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function roadRoad(){

        $negeri = Negeri::pluck('name','id');
        $code = JenisJalan::pluck('name','id');

        return view('site.roadlist', compact('negeri','code'));
    }

    public function getDataJalan(Request $request)
    {
        $rs = Jalan::orderBy('id', 'DESC')
            ->with(['negeri' => function ($query) {
                $query->select('id', 'name');
            }])

            ->where(function($cond){
                if(!Auth::user()->admin() || Auth::user()->adminjkr()){
                    if(Auth::user()->jkrnegeri() || Auth::user()->jkrdaerah() ){
                        $cond->where('negeri_id', Auth::user()->negeri_id);
                    }
                }
        });

        if ($request->has('nolaluan')) {
            $rs->where('nolaluan', 'ILIKE', '%' . $request->input('nolaluan') . '%');
        }

        if ($request->has('nama')) {
            $rs->where('nama', 'ILIKE', '%' . $request->input('nama') . '%');
        }

        if ($request->has('negeri')) {
            $rs->where('negeri_id', $request->input('negeri'));
        }

        if ($request->has('search')) {
            $search = $request->input('search')['value'];
            $rs->where(function ($query) use ($search) {
                $query->where('nolaluan', 'ILIKE', '%' . $search . '%')
                    ->orWhere('nama', 'ILIKE', '%' . $search . '%')
                    ->orWhere('negeri', 'ILIKE', '%' . $search . '%');
        });
    }

        return DataTables::of($rs)
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("to_char(created_at,'dd/MM/yyyy hh24:mi') like ?", ["%$keyword%"]);
            })
            ->addIndexColumn()
            ->addColumn('nolaluan', function ($rs) {
                return $rs->nolaluan;
            })
            ->addColumn('nama', function ($rs) {
                return $rs->nama;
            })
            ->addColumn('negeri', function ($rs) {
                return $rs->negeri;
            })
            ->addColumn('action', function ($rs) {
                $action =
                    '<a class="btn btn-outline btn-sm btn-primary jalan-view" data-id="' . $rs->id . '" data-toggle="tooltip" data-placement="top" title="Papar Jalan"><i class="fa fa-search"></i></a>';
                if (Auth::user()->admin()) {
                    $action .= '<a class="btn btn-outline btn-sm btn-warning jalan-edit" data-id="' . $rs->id . '" data-toggle="tooltip" data-placement="top" title="Kemaskini Jalan"><i class="fa fa-edit"></i></a>';
                    $action .= '<a class="btn btn-outline btn-sm btn-danger jalan-delete" data-id="' . $rs->id . '" data-toggle="tooltip" data-placement="top" title="Hapus Jalan"><i class="fa fa-trash"></i></a>';
                }

                return $action;
            })
            ->rawColumns(['negeri', 'action'])
            ->toJson();
}


    public function ajaxViewJalan($id){

        $rs = Jalan::with('jenisjalan')->findOrFail($id);

        if ($rs->updated_at != null) {
            $rs['updated'] = date('d-m-Y H:i:s', strtotime($rs->updated_at));
        }

        if ($rs->updated_by != null) {
            $rs['updated_by_fullname'] = $rs->user->fullname;
            $rs['updated_by_department'] = $rs->user->department->name;
        }

        return response()->json($rs);
    }

    public function ajaxRegisterJalan(Jalan $rs , Request $request) {
        $rs = new Jalan();
        $userid = Auth::user()->id;

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'code' => 'required',
            'nolaluan' => 'required',
            'name' => 'required',
            // 'panjang' => 'required',
            'negeri_id' => 'required',
            // 'nowarta' => 'required',
        ]);

        $rs->code = $request->input('code');
        $rs->nolaluan = $request->input('nolaluan');
        $rs->nama = $request->input('name');
        $rs->panjang = $request->input('panjang');
        $rs->negeri_id = $request->input('negeri_id');
        $rs->nowarta = $request->input('nowarta');
        $rs->disable = 'ACTIVE';
        $rs->created_by = $userid;
        $rs->updated_by = $userid;

        $negeri_name = Negeri::where('id' , $request->input('negeri_id') )->first();
        $rs->negeri = $negeri_name->name;

        if (!$validator->fails()) {
            $rs->save();

            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Maklumat jalan telah berjaya didaftarkan.
                                            </div>
                                        </div>
                                    </div>';
        } else {
            $rs['status'] = 'failure';
            $rs['error_form'] = $validator->errors();
        }

        return $rs;
    }


    public function ajaxUpdateJalan(Request $request, $id){

        $rs = Jalan::findOrFail($id);
        // $rs = Jalan::with('negeri')->findOrFail($id);
        $userid = Auth::user()->id;

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'e_name' => 'required',
            'e_state' => 'required',
        ]);

        $rs->nolaluan = $request->input('e_no_laluan');
        $rs->nama = $request->input('e_name');
        $rs->negeri_id = $request->input('e_state');
        $rs->updated_by = $userid;
        $rs->code = $request->input('e_code');
        $rs->panjang = $request->input('e_panjang');
        $rs->nowarta = $request->input('e_nowarta');

        $negeri_name = Negeri::where('id' , $request->input('e_state') )->first();
        $rs->negeri = $negeri_name->name;

        if(!$validator->fails()){
            $rs->save();

            $rs['status'] = 'success';
            $rs['success_form'] =   '<div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    Data jalan telah berjaya dikemaskini.
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

public function ajaxDeleteJalan($id){
    $rs = Jalan::findOrFail($id);
    $userid = Auth::user()->id;

    $rs->disable = 'INACTIVE';
    $rs->updated_by = $userid;

    if($rs->save()){
        $rs['status'] = 'success';
        $rs['success_form'] =   '<div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Maklumat jalan telah berjaya dihapus.
                                            </div>
                                        </div>
                                    </div>';
    } else {
        $rs['status'] = 'failure';
        $rs['error_form'] =   '<div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Maklumat jalan tidak berjaya dihapus.
                                            </div>
                                        </div>
                                    </div>';
    }

    return $rs;
}

}

