<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Yajra\DataTables\DataTables;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function audit(){
	   return view('site.audit');
    }

    public function getAuditData(DataTables $dataTables)
    {
        $rs = Audit::orderBy('created_at', 'DESC');

    	return $dataTables->eloquent($rs)
        ->orderColumn('created_at', '-created_at $1')
        ->toJson();
    }
}
