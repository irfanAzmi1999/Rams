<?php

namespace App\Http\Controllers;

use App\Models\Forensik;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForensikController extends Controller
{
    public function laporanList(){
        return view('site.listForensik');
    }

    public function getLaporanData()
    {
        $rs = Forensik::all();
        return DataTables::of($rs)
            ->addColumn('latlng', function ($rs) {
                return $rs->latitude . ', ' . $rs->logitude;
            })
            ->addColumn('status', function($rs) {
                if ($rs->is_dirawat == 1){
                    return '<span style="display: block;width: 125px;white-space: break-spaces;" class="p-1 label label-primary text-12">SUDAH DIRAWAT PADA TAHUN ' . $rs->tahun_dirawat . '</span>';
                }else{
                    return '<span class="label label-danger text-12">BELUM DIRAWAT</span>';
                }
            })
            ->addColumn('action', function ($rs) {
                $action = '<a class="btn btn-outline btn-sm btn-success laporan-view"  data-id="'.$rs->url.'" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-external-link-square"></i></a>';
                // $action .= '<a class="btn btn-outline btn-sm btn-primary fdata-view" data-toggle="tooltip" data-placement="top" data-id="' . $rs->id . '" title="Papar Data"><i class="fa fa-search"></i></a>';
                $action .= ' <a class="btn btn-outline btn-sm btn-warning" id="edit-data" data-toggle="tooltip" data-placement="top" data-id="' . $rs->id . '" title="Kemaskini Data"><i class="fa fa-edit"></i></a>';
                $action .= '<a class="btn btn-outline btn-sm btn-danger" id="delete-data" data-toggle="tooltip" data-placement="top" data-id="' . $rs->id . '" title="Hapus Data"><i class="fa fa-trash"></i></a>';
                return $action;
            })->escapeColumns([])
            ->toJson();
    }

    public function daftarLaporan(Request $request)
    {
        $input = $request->all();

        $laporan = $input['id'] ? Forensik::find($input['id']) : new Forensik();
        $laporan->rujukan = $input['rujukan'];
        $laporan->namaLaluan = $input['namaLaluan'];
        $laporan->latitude = $input['latitude'];
        $laporan->logitude = $input['logitude'];
        $laporan->tahun = $input['tahun'];
        // $laporan->tahun_laporan = $input['tahun_laporan'];
        $laporan->updated_by = Auth::user()->id;
        $laporan->updated_at = \Carbon\Carbon::now()->toDateTimeString();
        if($request->has('is_dirawat')){
            $laporan->tahun_dirawat = $input['tahun_dirawat'];
            $laporan->is_dirawat = 1;
        }else{
            $laporan->tahun_dirawat = null;
            $laporan->is_dirawat = 0;
        }

        if($laporan->exists == false){
            $laporan->created_by = Auth::user()->id;
            $laporan->created_at = \Carbon\Carbon::now()->toDateTimeString();
            $laporan->disable = 'ACTIVE';
        }

        if ($request->hasFile('file_laporan')) {
            if(!empty($laporan->getOriginal('rujukan'))){
                unlink(public_path() . $laporan->url);
            }
            $file = $request->file_laporan;
            $filename = $input['rujukan'] . '.' . $request->file_laporan->extension();
            $path = $file->storeAs('UploadsForensik', $filename, ['disk' => 'uploads']);
            $laporan->url = '/'.$path;
        }elseif($laporan->rujukan != $laporan->getOriginal('rujukan') && !empty($laporan->getOriginal('rujukan'))){
            rename ($laporan->url, public_path() . '/' . 'UploadsForensik/' . $laporan->rujukan . '.pdf');
            $laporan->url = public_path() . '/' . 'UploadsForensik/' . $laporan->rujukan . '.pdf';
        }

        $laporan->save();
        return redirect(route('forensik.laporanForensik'));
    }

    public function ajaxGetDataLaporan(Request $request)
    {
        return Forensik::find($request->id);
    }

	public function ajaxDeleteLaporan($id){
        $laporan = Forensik::findOrFail($id);
		$laporan->disable = 'INACTIVE';
        $laporan->updated_by = Auth::user()->id;
		$laporan->save();
        return $laporan;
    }
}
