<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        
        $reports = DB::table('audit_log')
            ->Join('products', 'audit_log.product_id', '=', 'products.id')        
            ->select('audit_log.*','products.product_name')            
            ->get();    
        return view('processing.report')->with(['reports' => $reports]);
    }    
}
