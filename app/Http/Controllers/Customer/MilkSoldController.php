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
        /* if ($request->ajax()) {
            $data = DB::table('milksolds')
                ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
                ->select('milksolds.*','customers.customer_name')
                ->orderBy('milksolds.sold_date', 'desc')
                ->get();
            foreach ($data as $value) {
                $value->sold_date = date('M j Y',strtotime($value->sold_date));
                $value->morning = $value->morning ? $value->morning : '0';
                $value->evening = $value->evening ? $value->evening : '0';
                // $value->amount_paid = $value->amount_paid ? $value->amount_paid : '0' ;
                // $value->pending_amount = $value->pending_amount ? $value->pending_amount : '0' ;
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
        } */
        $soldsdata = DB::table('milksolds')
                ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
                ->select('milksolds.*','customers.customer_name')
                ->orderBy('milksolds.sold_date', 'desc')
                ->get();
        $icollections = Milkcollection::orderBY('collection_date','desc')->get();
        $ecollections = DB::table('external_collection')->orderBy('date', 'desc')->get();

        $sold_date =  DB::table('milksolds')->latest('sold_date')->first();
        if($sold_date) {
            $next_date = date('Y-m-d',strtotime($sold_date->sold_date . "+1 day")); 
        } else {
            $next_date = date('Y-m-d');
        }
        
        $prev_date = date('Y-m-d',strtotime($next_date . "-1 day"));
        
        $filter_date = $request->filter_date;
        if($filter_date) {
            $ext_collF = DB::table('external_collection')->where(['date'=> $filter_date,'type'=>'fridge_used'])->select('*')->first();
            $ext_collFS = DB::table('external_collection')->where(['date'=> $filter_date,'type'=>'fridge_stock'])->select('*')->first();
            $ext_collU21 = DB::table('external_collection')->where(['date'=> $filter_date,'type'=>'u21'])->select('*')->first();
            $ext_collB = DB::table('external_collection')->where(['date'=> $filter_date,'type'=>'bazaar'])->select('*')->first();
            $customers = DB::table('milksolds')
                ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
                ->where('milksolds.sold_date',$filter_date)
                ->select('milksolds.morning','milksolds.evening','customers.milk_rate','milksolds.id','customers.customer_name')
                // ->orderBy('milksolds.sold_date', 'desc')
                ->get();
                
                if(count($customers) == 0) {
                    $customers = Customer::where(['status'=>'active'])->get();
                }
            $milkusers = DB::table('milk_user_entry')
                    ->Join('milk_users','milk_user_entry.user_id','=','milk_users.id') 
                    ->where('milk_user_entry.date',$filter_date)
                    ->select('milk_user_entry.morning','milk_user_entry.evening','milk_users.name','milk_user_entry.id')
                    ->get();
                if(count($milkusers) == 0) {
                    $milkusers = DB::table('milk_users')->select('*')->get();
                }
        }
        else {
            $customers = Customer::where(['status'=>'active'])->get();
            $milkusers = DB::table('milk_users')->select('*')->get();
            $ext_collF = DB::table('external_collection')->where(['date'=> $prev_date,'type'=>'fridge_stock'])->select('*')->first();
            $ext_collFS = [];
            $ext_collB = [];
            $ext_collU21 = [];
        }

        return view('customers.collections.index')->with([
            'customers'=> $customers, 'ext_collF'=>$ext_collF, 
            'ext_collFS'=>$ext_collFS, 'ext_collB'=>$ext_collB, 
            'ext_collU21'=>$ext_collU21,'milkusers'=>$milkusers,
            'next_date' => $next_date, 'soldsdata'=> $soldsdata,
            'icollections' => $icollections, 'ecollections' => $ecollections
        ]);
        /* $data = DB::table('milksolds')
            ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
            ->select('milksolds.*','customers.customer_name as rcustomer_name')
            ->orderBy('milksolds.sold_date', 'desc')
            ->get();
        return view('customers.collections.index')->with(['solds'=>$data]); */
    }

    /* public function create()
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
    } */

    public function store(Request $request)
    {
        if($request->filter_date) {

            $checkCustFilterEntry = DB::table('milksolds')
                    ->select('milksolds.*')
                    ->where(['sold_date' => $request->filter_date])
                    ->get();
                    
            $checkUserFilterEntry = DB::table('milk_user_entry')
                    ->select('milk_user_entry.*')
                    ->where(['date' => $request->filter_date])
                    ->get();
            
            if(count($checkCustFilterEntry) == 0 || count($checkUserFilterEntry) == 0) {
                return redirect('/milk_entries')->with('error','No Data found of Date '.$request->filter_date.' to update');
            }

            if($request->customer_id > 0) {
                for($i = 0; $i < count($request->customer_id); $i++) {                                                          

                    $updt_sold = DB::table('milksolds')
                            ->where('id',$request->customer_id[$i])
                            ->update([
                                // 'customer_id' => $request->customer_id[$i],
                                'milk_rate' => $request->milk_rate[$i],
                                'morning' => $request->c_morning[$i],
                                'evening' => $request->c_evening[$i],
                                'total_litres' => ($request->c_morning[$i])+($request->c_evening[$i]),
                                'total_amount' => ($request->c_morning[$i]+$request->c_evening[$i])*$request->milk_rate[$i],
                                'updated_at' => date('Y-m-d h:i:s')
                            ]);

                    if($updt_sold) {
                        $update_collection = DB::table('milkcollections')
                            ->where('collection_date', $request->filter_date)
                            ->update([
                                'morning' => $request->final_cm_total,
                                'evening' => $request->final_ce_total,
                                'total_litres' => $request->final_ctotal,
                                'updated_at' => date('Y-m-d h:i:s')
                            ]);
                    }
                }
            }
            for($mu = 0; $mu < count($request->user_id); $mu++) {
                DB::table('milk_user_entry')
                    ->where('id', $request->user_id[$mu])
                    ->update([
                        // 'user_id' => $request->user_id[$mu],
                        'morning' => $request->u_morning[$mu],
                        'evening' => $request->u_evening[$mu],
                        'total_litres' => ($request->u_morning[$mu])+($request->u_evening[$mu]),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]);
            }
            for($ec = 0; $ec < count($request->ext_type); $ec++) {
                DB::table('external_collection')
                    ->where('id', $request->ext_id[$ec])
                    ->update([
                        'type' => $request->ext_type[$ec],
                        'morning' => $request->ext_morning[$ec],
                        'evening' => $request->ext_evening[$ec],
                        'total_litres' => ($request->ext_morning[$ec])+($request->ext_evening[$ec]),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]); 

            }
            return redirect('/milk_entries')->with('success','Record Updated');
        }
        else {
            $checkCustomerEntry = DB::table('milksolds')
                    ->select('milksolds.*')
                    ->where(['sold_date' => $request->sold_date])
                    ->get();
                    
            $checkMilkEntry = DB::table('milk_user_entry')
                    ->select('milk_user_entry.*')
                    ->where(['date' => $request->sold_date])
                    ->get();
                    
            if(count($checkMilkEntry) > 0) {
                return redirect('/milk_entries')->with('error','User Data Already Exists in Database For Date '.$request->sold_date);
            }
            else if(count($checkCustomerEntry) > 0) {
                return redirect('/milk_entries')->with('error','Customer Data Already Exists in Database For Date '.$request->sold_date);
            }
            else {
                
                if($request->customer_id > 0) {
                    for($i = 0; $i < count($request->customer_id); $i++) {
                                        
                        $sold = new Milksold();
                        $sold->customer_id = $request->customer_id[$i];
                        // $sold->normal_customer_name = $getnm_array[$i];
                        $sold->milk_rate = $request->milk_rate[$i];
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

        // $sold->customer_id = $request->input('customer_id');
        // $sold->type = $request->input('customer_type');
        // $sold->normal_customer_name = $request->input('normal_customer_name');
        $sold->milk_rate = $request->input('milk_rate');
        $sold->morning = $request->input('morning');
        $sold->evening = $request->input('evening');
        $sold->total_litres = $request->input('morning')+$request->input('evening');
        // $sold->sold_date = $request->input('sold_date');
        // $sold->amount_paid = $request->input('amount_paid');
        // if( $request->input('normal_customer_name')) {
        $sold->total_amount = ($request->input('morning')+$request->input('evening'))*$request->input('milk_rate');
        // }
        // $sold->pending_amount = $sold->total_amount - $sold->amount_paid;      
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
