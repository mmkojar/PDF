<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Milksold;
use App\Models\Milkcollection;
use App\Helper\Helper;
use DataTables;

class MilkSoldController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('milksolds')
                ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
                ->select('milksolds.*','customers.customer_name as rcustomer_name')
                ->orderBy('milksolds.sold_date', 'desc')
                ->get();
            foreach ($data as $value) {
                $value->rcustomer_name = $value->customer_id ? $value->rcustomer_name : $value->normal_customer_name;
                $value->sold_date = date('M j Y',strtotime($value->sold_date));
                $value->morning = $value->morning ? $value->morning : '0';
                $value->evening = $value->evening ? $value->evening : '0';
                $value->amount_paid = $value->amount_paid ? $value->amount_paid : '0' ;
                $value->pending_amount = $value->pending_amount ? $value->pending_amount : '0' ;
                $value->total_amount = $value->total_amount ? $value->total_amount : '0' ;
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        // $roles = Auth()->user()->roles()->get()->pluck('name')[0];
                        // if($roles == 'super-admin') {
                            $btn = '<a href="milk_entries/'.$row->id.'/edit/" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>';       
                            return $btn;
                        // }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
                        
        return view('customers.collections.index');
        /* $data = DB::table('milksolds')
            ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
            ->select('milksolds.*','customers.customer_name as rcustomer_name')
            ->orderBy('milksolds.sold_date', 'desc')
            ->get();
        return view('customers.collections.index')->with(['solds'=>$data]); */
    }

    public function create()
    {
        $sold_date =  DB::table('milksolds')->latest('sold_date')->first();
        if($sold_date) {
            $next_date = date('Y-m-d',strtotime($sold_date->sold_date . "+1 day")); 
        } else {
            $next_date = date('Y-m-d');
        }

        $prev_date = date('Y-m-d',strtotime(date('Y-m-d') . "-1 day"));        
        $ext_coll = DB::table('external_collection')->where(['date'=> $prev_date,'type'=>'fridge'])->select('*')->first();        
        
        $customers = Customer::where(['status'=>'active'])->get();
        $milkusers = DB::table('milk_users')->select('*')->get();
        // $customers2 = Customer::where(['status'=>'active','customer_type'=> 'Home Customer'])->get();
        return view('customers.solds.create')->with(['customers'=> $customers,'ext_coll'=>$ext_coll, 'milkusers'=>$milkusers,'next_date' => $next_date]);
    }

    public function store(Request $request)
    {                  
        $checkCustomerEntry = DB::table('milksolds')
                ->select('milksolds.*')
                ->where(['sold_date' => $request->sold_date])
                ->get();
                
        $checkMilkEntry = DB::table('milk_user_entry')
                ->select('milk_user_entry.*')
                ->where(['date' => $request->sold_date])
                ->get();
                
        if(count($checkMilkEntry) > 0) {
            return redirect('/milk_entries/create')->with('error','User Data Already Exists in Database For Date '.$request->sold_date);
        }
        if(count($checkCustomerEntry) > 0) {
            return redirect('/milk_entries/create')->with('error','Customer Data Already Exists in Database For Date '.$request->sold_date);
        }
        else {
            
            if($request->customer_id > 0) {
                for($i = 0; $i < count($request->customer_id); $i++) {
                                      
                    $sold = new Milksold();
                    $sold->customer_id = $request->customer_id[$i];
                    // $sold->normal_customer_name = $getnm_array[$i];
                    // $sold->milk_rate = $request->milk_rate[$i];
                    $sold->morning = $request->c_morning[$i];
                    $sold->evening = $request->c_evening[$i];
                    $sold->total_litres = ($request->c_morning[$i])+($request->c_evening[$i]);
                    $sold->sold_date = $request->sold_date;                                        
                    // $sold->amount_paid = $request->input('amount_paid');
                    $sold->total_amount = ($request->c_morning[$i]+$request->c_evening[$i])*$request->milk_rate[$i];
                    // $sold->pending_amount = $sold->total_amount - $sold->amount_paid;
                    if($sold->save()) {
                            
                        $check_date = DB::table('milkcollections')
                            ->where('collection_date',$sold->sold_date)
                            ->select('milkcollections.*')
                            ->first();  
                        
                        if($check_date) {
                            $update_collection = DB::table('milkcollections')
                                ->where('collection_date', $sold->sold_date)
                                ->update([
                                    'morning' => $check_date->morning + $request->c_morning[$i],
                                    'evening' => $check_date->evening + $request->c_evening[$i],
                                    'total_litres' => $check_date->total_litres + ($request->c_morning[$i])+($request->c_evening[$i]),
                                    'updated_at' => date('Y-m-d h:i:s')
                                ]);
                        }
                        else {
                            $insert_collection = DB::table('milkcollections')
                                ->insert([
                                    'morning' => $request->c_morning[$i],
                                    'evening' => $request->c_evening[$i],
                                    'total_litres' => ($request->c_morning[$i])+($request->c_evening[$i]),
                                    'collection_date' => $sold->sold_date,
                                    'created_at' => date('Y-m-d h:i:s')
                                ]);
                        }                    
                    }
                }
            }
            for($i = 0; $i < count($request->user_id); $i++) {
                DB::table('milk_user_entry')
                    ->insert([
                        'user_id' => $request->user_id[$i],
                        'morning' => $request->u_morning[$i],
                        'evening' => $request->u_evening[$i],
                        'total_litres' => ($request->u_morning[$i])+($request->u_evening[$i]),
                        'date' => $request->sold_date,
                        'created_at' => date('Y-m-d h:i:s')
                    ]);    
            }
            for($i = 0; $i < count($request->ext_type); $i++) {
                DB::table('external_collection')
                    ->insert([
                        'type' => $request->ext_type[$i],
                        'morning' => $request->ext_morning[$i],
                        'evening' => $request->ext_evening[$i],
                        'total_litres' => ($request->ext_morning[$i])+($request->ext_evening[$i]),
                        'date' => $request->sold_date,
                        'created_at' => date('Y-m-d h:i:s')
                    ]); 

            }
            return redirect('/milk_entries')->with('success','Record Created');
        }
    }

    public function edit($id)
    {
        $customers = Customer::where('status','active')->get();

        $sold = DB::table('milksolds')
        ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
        ->where('milksolds.id', '=', $id)
        ->select('milksolds.*','customers.customer_name as rcustomer_name')
        ->first();

        return view('customers.solds.edit')->with([ 'sold' => $sold , 'customers' => $customers]);
    }

    public function update(Request $request, $id)
    {
        $sold = Milksold::find($id);        

        $check_date = DB::table('milkcollections')
            ->where('collection_date',$sold->sold_date)
            ->select('milkcollections.*')
            ->first();

        if($sold->morning !== $request->morning || $sold->evening !== $request->evening) {
            
            if($sold->morning > $request->morning || $sold->evening > $request->evening) {

                $xmvalue = $sold->morning - $request->morning;
                $xevalue = $sold->evening - $request->evening;

                $update_collection = DB::table('milkcollections')
                    ->where('collection_date', $sold->sold_date)
                    ->update([
                        'morning' => $check_date->morning - $xmvalue,
                        'evening' => $check_date->evening - $xevalue,
                        'total_litres' => $check_date->total_litres - ($xmvalue + $xevalue),
                        'grand_total' => $check_date->grand_total - ($xmvalue + $xevalue),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]);
            }
            else if($sold->morning < $request->morning || $sold->evening < $request->evening) {

                $xmvalue1 = $request->morning - $sold->morning;
                $xevalue1 = $request->evening - $sold->evening;

                $update_collection = DB::table('milkcollections')
                    ->where('collection_date', $sold->sold_date)
                    ->update([
                        'morning' => $check_date->morning + $xmvalue1,
                        'evening' => $check_date->evening + $xevalue1,
                        'total_litres' => $check_date->total_litres + ($xmvalue1 + $xevalue1),
                        'grand_total' => $check_date->grand_total + ($xmvalue1 + $xevalue1),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]);
            }
            

            /* if($sold->morning > $request->morning || $sold->evening > $request->evening) {

                $xmvalue = $sold->morning - $request->morning;
                $xevalue = $sold->evening - $request->evening;

                $update_collection = DB::table('milkcollections')
                    ->where('collection_date', $sold->sold_date)
                    ->update([
                        'morning' => $sold->morning + $sold->morning,
                        'evening' => $sold->evening + $sold->evening,
                        'total_litres' => $check_date->total_litres + $sold->total_litres,
                        'grand_total' => $check_date->grand_total + $sold->total_litres,
                        'updated_at' => date('Y-m-d h:i:s')
                    ]);
            } */                
        }

        $sold->customer_id = $request->input('customer_name');
        $sold->type = $request->input('customer_type');
        $sold->normal_customer_name = $request->input('normal_customer_name');
        $sold->milk_rate = $request->input('milk_rate');
        $sold->morning = $request->input('morning');
        $sold->evening = $request->input('evening');
        $sold->total_litres = $request->input('morning')+$request->input('evening');
        $sold->sold_date = $request->input('sold_date');
        $sold->amount_paid = $request->input('amount_paid');
        // if( $request->input('normal_customer_name')) {
            $sold->total_amount = ($request->input('morning')+$request->input('evening'))*$request->input('milk_rate');
        // }
        $sold->pending_amount = $sold->total_amount - $sold->amount_paid;      
        if($sold->save()) {
                
            return redirect('/milk_entries')->with('success','Record Updated');
        }

        
    }

    public function delete($id)
    {
        $sold =  Milksold::find($id);        
        $sold->delete();
        return ['status' => 1 ];
    }

    public function sold_api() {

        $sold = DB::table('customers')
        // ->where('customers.id', '=', $id)
        ->get();
        
        return response()->json($sold);
    }
}
