<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CommonController as Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index() {

        $salves_days = DB::table('days')->select('days_in_salves')->get();
        
        $delivery_report = DB::table('ghabhan_detail')
        ->Join('products', 'ghabhan_detail.product_id', '=', 'products.id')
        ->where('ghabhan_detail.status','salves')
        ->select('ghabhan_detail.*','products.product_name')
        ->orderBy('ghabhan_detail.created_at', 'desc')
        ->get();        
        
        $products = DB::table('products')->where('status','active')->get();
        $product_stock = DB::table('product_stock')->where('status','active')->get();
        $customers = DB::table('customers')->where('status','active')->get();
        $salves = DB::table('salves')->get();
        $mcoll_morning = DB::table('milkcollections')->select('milkcollections.total_litres')->where('collection_date',date('Y-m-d'))->first();    
        // return $mcoll_morning;
        if($mcoll_morning) {
            $mcoll_morning = $mcoll_morning->total_litres;
        }else {
            $mcoll_morning = 0;
        }
        // $mcoll_evening = DB::table('milkcollections')->select('milkcollections.evening')->where('collection_date',date('Y-m-d'))->get();
        $msold_morning = DB::table('milksolds')->select('milksolds.morning')->where('sold_date',date('Y-m-d'))->get();
        $msold_evening = DB::table('milksolds')->select('milksolds.evening')->where('sold_date',date('Y-m-d'))->get();

        $processing = DB::table('product_stock')
            ->Join('products', 'product_stock.product_id', '=', 'products.id')
            ->leftJoin('processing_data', 'product_stock.id', '=', 'processing_data.product_stock_id')
            ->where(['product_stock.status'=>'active','processing_data.is_processed_or_not'=>'no'])                                
            ->orwhereNull('processing_data.product_stock_id')
            ->get();

        $medical = DB::table('processing_data')
            ->Join('products', 'processing_data.product_id', '=', 'products.id')
            ->leftJoin('medical_checkup', 'processing_data.id', '=', 'medical_checkup.processing_id')
            ->where(['processing_data.is_processed_or_not'=>'yes'])
            ->Where(function($query) {
                $query->where('medical_checkup.is_pregnant_or_not', 'no')
                        ->orwhere('medical_checkup.id');
            })
            ->get();

        $pregnants = DB::table('medical_checkup')
            ->Join('products', 'medical_checkup.product_id', '=', 'products.id')
            ->leftJoin('ghabhan_detail', 'ghabhan_detail.medical_id', '=', 'medical_checkup.id')
            ->where(['medical_checkup.is_pregnant_or_not'=>'yes'])
            ->Where(function($query) {
                $query->where(['ghabhan_detail.status'=>'pending'])
                      ->orwhere('ghabhan_detail.id');
            })
            // 'ghabhan_detail.send_to_salves_or_not'=>'no',
            ->select('medical_checkup.*','products.product_name')
            ->orderBy('medical_checkup.created_at', 'desc')
            ->get();
        
        $transfer_salves = DB::table('ghabhan_detail')
            ->Join('products', 'ghabhan_detail.product_id', '=', 'products.id')
            ->where(['ghabhan_detail.status' => 'salves'])
            // 'ghabhan_detail.send_to_salves_or_not' => 'yes' , 
            ->select('ghabhan_detail.*','products.product_name')
            ->orderBy('ghabhan_detail.created_at', 'desc')
            ->get();

       /*  $mcsum = 0;
        foreach($mcoll_morning as $a) {
            $mcsum += $a->morning;
        } */

        $mssum = 0;
        foreach($msold_morning as $a) {
            $mssum += $a->morning;
        }
        $essum = 0;
        foreach($msold_evening as $b) {
            $essum += $b->evening;
        }

        return view('dashboard')->with([
            'p' => $products,
            'ps' => $product_stock,
            'c' => $customers,
            's' => $salves,
            'mcoll_morning' => $mcoll_morning,
            'msold_m' => $mssum,
            'msold_e' => $essum,
            'processing' => $processing,
            'medical' => $medical,
            'pregnants' => $pregnants,
            'delivery_report' => $delivery_report,
            'transfer_salves' => $transfer_salves,
            'salves_days' => $salves_days
        ]);
    }
}
