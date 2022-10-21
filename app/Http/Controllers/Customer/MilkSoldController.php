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
        $ext_coll = DB::table('external_collection')->where(['date'=> $prev_date,'type'=>'fr'])->select('*')->first();
        
        $customers = Customer::where(['status'=>'active'])->get();
        $milkusers = DB::table('milk_users')->select('*')->get();
        // $customers2 = Customer::where(['status'=>'active','customer_type'=> 'Home Customer'])->get();
        return view('customers.solds.create')->with(['customers'=> $customers, 'milkusers'=>$milkusers,'next_date' => $next_date]);
    }

    public function store(Request $request)
    {
        if($request->customer_name !== '') {
            $check_customer_entry = DB::table('milksolds')
                ->select('milksolds.*')
                ->where(['sold_date' => $request->sold_date])
                ->get();
        }
        if($request->collection_type !== '') {
            $check_customer_entry1 = DB::table('external_collection')
                ->select('external_collection.*')
                ->where(['date' => $request->sold_date])
                ->get();
        }
        // if($request->customer_name == '' && $request->normal_customer_name !== '') {
        //     $check_customer_entry = DB::table('milksolds')     
        //         ->select('milksolds.*')
        //         ->where(['sold_date' => $request->sold_date,'normal_customer_name'=>$request->normal_customer_name])
        //         ->get();
        // }
        // return  $check_customer_entry;
        if(count($check_customer_entry) > 0 || count($check_customer_entry1) > 0) {
            return redirect('/milk_entries/create')->with('error','Data Already Exists');
        }
        else {
                     
            /* $getnm_array = $request['normal_customer_name'];   
            // echo count($getnm_array);
            $subtract = count($request['customer_name']) - count($getnm_array);   
            for($x=0; $x <= $subtract; $x++){
                $getnm_array[] = 'null';
            }   
             */
            
            //  Regular Customer
            if($request->customer_type > 0) {
                for($i = 0; $i < count($request->customer_type); $i++) {
                                      
                    $sold = new Milksold();
                    $sold->customer_id = $request->customer_name[$i];
                    $sold->type = $request->customer_type[$i];
                    // $sold->normal_customer_name = $getnm_array[$i];
                    $sold->milk_rate = $request->milk_rate[$i];
                    $sold->morning = $request->morning[$i];
                    $sold->evening = $request->evening[$i];
                    $sold->total_litres = ($request->morning[$i])+($request->evening[$i]);
                    $sold->sold_date = $request->sold_date;                                        
                    // $sold->amount_paid = $request->input('amount_paid');
                    $sold->total_amount = ($request->morning[$i]+$request->evening[$i])*$request->milk_rate[$i];
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
                                    'morning' => $check_date->morning + $request->morning[$i],
                                    'evening' => $check_date->evening + $request->evening[$i],
                                    'total_litres' => $check_date->total_litres + ($request->morning[$i])+($request->evening[$i]),
                                    'grand_total' => $check_date->grand_total + ($request->morning[$i])+($request->evening[$i]),
                                    'updated_at' => date('Y-m-d h:i:s')
                                ]);
                        }
                        else {
                            $insert_collection = DB::table('milkcollections')
                                ->insert([
                                    'morning' => $request->morning[$i],
                                    'evening' => $request->evening[$i],
                                    'total_litres' => ($request->morning[$i])+($request->evening[$i]),
                                    'grand_total' => ($request->morning[$i])+($request->evening[$i]),
                                    'collection_date' => $sold->sold_date,
                                    'created_at' => date('Y-m-d h:i:s')
                                ]);
                        }                    
                    }
                }        
            }
            // Normal Customer
            if($request->ncustomer_type > 0) {
                for($i = 0; $i < count($request->ncustomer_type); $i++) {
                                        
                    $sold = new Milksold();
                    $sold->customer_id = null;
                    $sold->type = $request->ncustomer_type[$i];
                    $sold->normal_customer_name = $request->normal_customer_name[$i];
                    $sold->milk_rate = $request->nmilk_rate[$i];
                    $sold->morning = $request->nmorning[$i];
                    $sold->evening = $request->nevening[$i];
                    $sold->total_litres = ($request->nmorning[$i])+($request->nevening[$i]);
                    $sold->total_amount = ($request->nmorning[$i]+$request->nevening[$i])*$request->nmilk_rate[$i];
                    $sold->sold_date = $request->sold_date;      
                    if($sold->save()) {
                                
                        $check_date = DB::table('milkcollections')
                            ->where('collection_date',$sold->sold_date)
                            ->select('milkcollections.*')
                            ->first();  
                        
                        if($check_date) {
                            $update_collection = DB::table('milkcollections')
                                ->where('collection_date', $sold->sold_date)
                                ->update([
                                    'morning' => $check_date->morning + $request->nmorning[$i],
                                    'evening' => $check_date->evening + $request->nevening[$i],
                                    'total_litres' => $check_date->total_litres + ( $request->nmorning[$i])+($request->nevening[$i]),
                                    'grand_total' => $check_date->grand_total + ( $request->nmorning[$i])+($request->nevening[$i]),
                                    'updated_at' => date('Y-m-d h:i:s')
                                ]);
                        }
                        else {
                            $insert_collection = DB::table('milkcollections')
                                ->insert([
                                    'morning' => $request->nmorning[$i],
                                    'evening' =>  $request->nevening[$i],
                                    'total_litres' => ($request->nmorning[$i])+($request->nevening[$i]),
                                    'grand_total' => ($request->nmorning[$i])+($request->nevening[$i]),
                                    'collection_date' => $sold->sold_date,
                                    'created_at' => date('Y-m-d h:i:s')
                                ]);
                        }
                    
                    }
                }
            }
            // External Collection
            if($request->collection_type > 0) {
                for($j = 0; $j < count($request->collection_type); $j++) {
                        
                    $externel_collection = DB::table('external_collection')
                        ->insert([
                            'date' => $request->sold_date,
                            'type' => $request->collection_type[$j],
                            'party_name' => $request->party_name[$j],
                            'ext_party_name' => $request->ext_party_name[$j],
                            'morning' => $request->ext_morning[$j],
                            'evening' => $request->ext_evening[$j],
                            'total_given_taken' => ($request->ext_morning[$j])+($request->ext_evening[$j]),
                            'rate' => $request->rate,
                            'total_amount' => ($request->ext_morning[$j] + $request->ext_evening[$j])*($request->ext_rate[$j]),
                            'amount_paid' => $request->amount_paid[$j],
                            'created_at' => date('Y-m-d h:i:s')
                        ]);

                    if($externel_collection) {
                        
                        $get_total_litres_from_collection = DB::table('milkcollections')
                        ->where('collection_date',$request->sold_date)
                        ->select('total_litres')
                        ->get();

                        $get_total_litres = 0;
                        foreach($get_total_litres_from_collection as $tc) {
                            $get_total_litres += $tc->total_litres;
                        }
                        
                        // For Given
                        $get_given_data = DB::table('external_collection')
                        ->where(['date'=>$request->sold_date,'type'=>'given'])
                        ->select('total_given_taken')
                        ->get();
                        
                        $total_given_data = 0;
                        foreach($get_given_data as $g) {
                            $total_given_data += $g->total_given_taken;
                        }								

                        if($request->collection_type[$j] == 'given') {
                            $update_collection = DB::table('milkcollections')
                                ->where('collection_date', $request->sold_date)
                                ->update([
                                    'given' => $total_given_data,
                                    'total_litres' => ($get_total_litres)+($request->ext_morning[$j] + $request->ext_evening[$j]),
                                    'updated_at' => date('Y-m-d h:i:s')
                                ]);
                        }

                        // For Taken
                        $get_taken_date = DB::table('external_collection')
                        ->where(['date'=>$request->sold_date,'type'=>'taken'])
                        ->select('total_given_taken')
                        ->get();			
                        
                        $total_taken_data = 0;
                        foreach($get_taken_date as $t) {
                            $total_taken_data += $t->total_given_taken;
                        }
                        
                        if($request->collection_type[$j] == 'taken') {
                            $update_collection = DB::table('milkcollections')
                                ->where('collection_date', $request->sold_date)
                                ->update([
                                    'taken' => $total_taken_data,
                                    'total_litres' => ($get_total_litres)-($request->ext_morning[$j] + $request->ext_evening[$j]),                        
                                    'updated_at' => date('Y-m-d h:i:s')
                                ]);
                        }


                        // For GivenReturn
                        $get_givenreturn_date = DB::table('external_collection')
                        ->where(['date'=>$request->sold_date,'type'=>'givenreturn'])
                        ->select('total_given_taken')
                        ->get();			
                        
                        $total_givenreturn_data = 0;
                        foreach($get_givenreturn_date as $gr) {
                            $total_givenreturn_data += $gr->total_given_taken;
                        }								

                        if($request->collection_type[$j] == 'givenreturn') {
                            $update_collection = DB::table('milkcollections')
                                ->where('collection_date', $request->sold_date)
                                ->update([
                                    'givenreturn' => $total_givenreturn_data,                            
                                    'total_litres' => ($get_total_litres)-($request->ext_morning[$j] + $request->ext_evening[$j]),
                                    'updated_at' => date('Y-m-d h:i:s')
                                ]);
                        }

                        // For TakenReturn
                        $get_takenreturn_date = DB::table('external_collection')
                        ->where(['date'=>$request->sold_date,'type'=>'takenreturn'])
                        ->select('total_given_taken')
                        ->get();
                        
                        $total_takenreturn_data = 0;
                        foreach($get_takenreturn_date as $tr) {
                            $total_takenreturn_data += $tr->total_given_taken;
                        }
                        
                        if($request->collection_type[$j] == 'takenreturn') {
                            $update_collection = DB::table('milkcollections')
                                ->where('collection_date', $request->sold_date)
                                ->update([
                                    'takenreturn' => $total_takenreturn_data,
                                    'total_litres' => ($get_total_litres)+($request->ext_morning[$j] + $request->ext_evening[$j]),                        
                                    'updated_at' => date('Y-m-d h:i:s')
                                ]);
                        }
                    }
                }
            }

            return redirect('/milk_entries')->with('success','Record Created');
             /* $get_colln_litres = DB::table('milkcollections')
                ->where('collection_date',$sold->sold_date)
                ->select('total_litres')
                ->first();

            $get_sold_litres = DB::table('milksolds')
                ->where('sold_date',$sold->sold_date)
                ->select('total_litres')
                ->get();
            
            $total_sum = 0;
            foreach($get_sold_litres as $x) {
                $total_sum += $x->total_litres;
            }

            $update_collection = DB::table('milkcollections')
                ->where('collection_date', $sold->sold_date)
                ->update([
                    'total_sold' => $total_sum,
                    'remaining_milk' => $get_colln_litres->total_litres-$total_sum,
                    'updated_at' => date('Y-m-d h:i:s')
                ]); */
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
