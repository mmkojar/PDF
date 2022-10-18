<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Milkcollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Helper\Helper;
use DataTables;

class MilkCollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        date_default_timezone_set('Asia/kolkata');
    }


    public function index(Request $request)
    {
       
        /* if ($request->ajax()) {
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
                        $roles = Auth()->user()->roles()->get()->pluck('name')[0];
                        if($roles == 'super-admin') {
                            $btn = '<a href="milk_entries/'.$row->id.'/edit/" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>';       
                            return $btn;
                        }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
                        
        return view('customers.collections.index'); */
        /* $data = DB::table('milksolds')
            ->leftJoin('customers', 'milksolds.customer_id', '=', 'customers.id')
            ->select('milksolds.*','customers.customer_name as rcustomer_name')
            ->orderBy('milksolds.sold_date', 'desc')
            ->get();
        return view('customers.collections.index')->with(['solds'=>$data]); */
    }

    public function internal(Request $request) {
        if ($request->ajax()) {
            $data = Milkcollection::orderBY('collection_date','desc')->get();
            foreach ($data as $value) {
                $value->collection_date = date('M j Y',strtotime($value->collection_date));
                $value->morning = $value->morning ? $value->morning : '0';
                $value->evening = $value->evening ? $value->evening : '0';
                $value->given = $value->given ? $value->given : '0' ;
                $value->givenreturn = $value->givenreturn ? $value->givenreturn : '0' ;
                $value->taken = $value->taken ? $value->taken : '0' ;
                $value->takenreturn = $value->takenreturn ? $value->takenreturn : '0' ;
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        // $roles = Auth()->user()->roles()->get()->pluck('name')[0];
                        // if($roles == 'super-admin') {
                            $btn = '<a id="'.$row->id.'" class="btn btn-sm btn-warning edit_collection"><i class="fa fa-edit"></i></a>';       
                            return $btn;
                        // }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('customers.collections.internal');
        /* $data = Milkcollection::orderBY('collection_date','desc')->get();
        return view('customers.collections.internal')->with('internal',$data); */
    }

    public function external(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('external_collection')->orderBy('date', 'desc')->get();
            foreach ($data as $value) {
                $value->date = date('M j Y',strtotime($value->date));
                $value->party_name = $value->party_name !== null ? $value->party_name : $value->ext_party_name;
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        // $roles = Auth()->user()->roles()->get()->pluck('name')[0];
                        // if($roles == 'super-admin') {
                            $btn = '<a href="'.config('app.url').'/'.'external_collection/'.$row->id.'/edit/" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>';       
                            return $btn;
                        // }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('customers.collections.external');
       /*  $data = DB::table('external_collection')->orderBy('date', 'desc')->get();
        return view('customers.collections.external')->with('external',$data); */
    }
     
    public function create()
    {                    
        $customers = Customer::where('status','active')->get();
        return view('customers.collections.create')->with(['customers'=> $customers]);;
    }
    
    public function store(Request $request)
    {
        $id = $request->input('hidden_collection_id');
        if($id) {
            $collection = Milkcollection::find($id);
            $collection->morning = $request->input('morning');
            $collection->evening = $request->input('evening');
            $collection->given = $request->input('given');
            $collection->givenreturn = $request->input('givenreturn');
            $collection->taken = $request->input('taken');
            $collection->takenreturn = $request->input('takenreturn');
            $collection->total_litres = $request->input('total_litres');
            $collection->grand_total = $request->input('grand_total');
            $collection->save();
            return redirect('/milk_entries')->with('success','Record Updated');
        }
        else {
                
            $check_collection = DB::table('milkcollections')     
            ->select('milkcollections.*')
            ->where(['collection_date' => $request->external_collection_date])
            ->get(); 
            
            $check_entry = DB::table('external_collection')
            ->select('external_collection.*')
            ->where([
                'type' => $request->collection_type,
                'party_name' => $request->party_name,
                'morning' => $request->morning,
                'evening' => $request->evening,
                'date' => $request->external_collection_date,
            ])
            ->get();
            
            if(count($check_collection) < 1) {
                return redirect('/external_collection/create')->with('error','There is No Collection for this date');
            }
            else if(count($check_entry) > 0) {
                return redirect('/external_collection/create')->with('error','Data Already Exists');
            }
            else {
                $externel_collection = DB::table('external_collection')
                ->insert([
                    'type' => $request->collection_type,
                    'party_name' => $request->party_name,
                    'ext_party_name' => $request->ext_party_name,
                    'morning' => $request->morning,
                    'evening' => $request->evening,
                    'total_given_taken' => $request->morning+$request->evening,
                    'rate' => $request->rate,                
                    'date' => $request->external_collection_date,
                    'total_amount' => ($request->morning + $request->evening)*$request->rate,
                    'amount_paid' => $request->amount_paid,
                    'created_at' => date('Y-m-d h:i:s')
                ]);

                if($externel_collection) {

                    $get_total_litres = DB::table('milkcollections')
                    ->where('collection_date',$request->external_collection_date)
                    ->select('total_litres')
                    ->first();

                    // For Given
                    $get_given_date = DB::table('external_collection')
                    ->where(['date'=>$request->external_collection_date,'type'=>'given'])
                    ->select('total_given_taken')
                    ->get();			
                    
                    $total_given_data = 0;
                    foreach($get_given_date as $g) {
                        $total_given_data += $g->total_given_taken;
                    }								

                    if($request->collection_type == 'given') {
                        $update_collection = DB::table('milkcollections')
                            ->where('collection_date', $request->external_collection_date)
                            ->update([
                                'given' => $total_given_data,
                                'total_litres' => ($get_total_litres->total_litres)+($request->morning + $request->evening),
                                'updated_at' => date('Y-m-d h:i:s')
                            ]);
                    }

                    // For Taken
                    $get_taken_date = DB::table('external_collection')
                    ->where(['date'=>$request->external_collection_date,'type'=>'taken'])
                    ->select('total_given_taken')
                    ->get();			
                    
                    $total_taken_data = 0;
                    foreach($get_taken_date as $t) {
                        $total_taken_data += $t->total_given_taken;
                    }
                    
                    if($request->collection_type == 'taken') {
                        $update_collection = DB::table('milkcollections')
                            ->where('collection_date', $request->external_collection_date)
                            ->update([
                                'taken' => $total_taken_data,
                                'total_litres' => ($get_total_litres->total_litres)-($request->morning + $request->evening),                        
                                'updated_at' => date('Y-m-d h:i:s')
                            ]);
                    }


                    // For GivenReturn
                    $get_givenreturn_date = DB::table('external_collection')
                    ->where(['date'=>$request->external_collection_date,'type'=>'givenreturn'])
                    ->select('total_given_taken')
                    ->get();			
                    
                    $total_givenreturn_data = 0;
                    foreach($get_givenreturn_date as $gr) {
                        $total_givenreturn_data += $gr->total_given_taken;
                    }								

                    if($request->collection_type == 'givenreturn') {
                        $update_collection = DB::table('milkcollections')
                            ->where('collection_date', $request->external_collection_date)
                            ->update([
                                'givenreturn' => $total_givenreturn_data,                            
                                'total_litres' => ($get_total_litres->total_litres)-($request->morning + $request->evening),
                                'updated_at' => date('Y-m-d h:i:s')
                            ]);
                    }

                    // For TakenReturn
                    $get_takenreturn_date = DB::table('external_collection')
                    ->where(['date'=>$request->external_collection_date,'type'=>'takenreturn'])
                    ->select('total_given_taken')
                    ->get();			
                    
                    $total_takenreturn_data = 0;
                    foreach($get_takenreturn_date as $tr) {
                        $total_takenreturn_data += $tr->total_given_taken;
                    }
                    
                    if($request->collection_type == 'takenreturn') {
                        $update_collection = DB::table('milkcollections')
                            ->where('collection_date', $request->external_collection_date)
                            ->update([
                                'takenreturn' => $total_takenreturn_data,
                                'total_litres' => ($get_total_litres->total_litres)+($request->morning + $request->evening),                        
                                'updated_at' => date('Y-m-d h:i:s')
                            ]);
                    }

                    return redirect('/milk_entries')->with('success','External Collection Added');
                }
            }      
            
        }
    }    

    public function edit($id, $cid=null)
    {
        if($cid==1) {
            $collection = Milkcollection::find($id);
            return ['status' => 1, 'collection' => $collection];
        }
    
        $collection = DB::table('external_collection')->where('id', $id)->first();
        $customers = Customer::where('status','active')->get();
        return view('customers.collections.edit')->with(['collection'=> $collection,'customers'=>$customers]);
    }

    public function update(Request $request, $id)
    {
        $externel_collection = DB::table('external_collection')
            ->where('id',$id)
            ->update([
                'type' => $request->collection_type,
                'party_name' => $request->party_name,
                'morning' => $request->morning,
                'evening' => $request->evening,
                'rate' => $request->rate,                
                'date' => $request->external_collection_date,
                'total_amount' => ($request->morning + $request->evening)*$request->rate,
                'amount_paid' => $request->amount_paid,
                'created_at' => date('Y-m-d h:i:s')
            ]);

        return redirect('/milk_entries')->with('success','Record Updated');
    }

}
