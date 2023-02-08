<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Helper\Helper;

class ProcessingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        /* $processess = DB::table('processing_data')        
                ->Join('products', 'processing_data.product_id', '=', 'products.id')
                ->Join('product_stock', 'processing_data.product_stock_id', '=', 'product_stock.id')
                ->where('product_stock.status','active')
                ->select('processing_data.*','products.product_name')
                ->orderBy('processing_data.created_at', 'desc')
                ->get();
                // return $processess; */

        $pending_processess = DB::table('product_stock')
                ->Join('products', 'product_stock.product_id', '=', 'products.id')
                ->leftJoin('processing_data', 'product_stock.id', '=', 'processing_data.product_stock_id')
                ->where(['product_stock.status'=>'active','processing_data.is_processed_or_not'=>'no'])                                
                ->orwhereNull('processing_data.product_stock_id')
                ->select('product_stock.*','products.product_name',
                'processing_data.id as prrid',
                'processing_data.product_stock_id',
                'processing_data.processing_date as newpdate',
                'processing_data.no_of_process',
                'processing_data.is_processed_or_not as pnot',
                'processing_data.actual_or_further_processing_date as afdate',
                'processing_data.note')
                // ->orderBy('product_stock.created_at', 'desc')
                ->get();
                

        // $expired_processess = DB::table('product_stock')        
        //         ->Join('products', 'product_stock.product_id', '=', 'products.id')
        //         ->leftJoin('processing_data', 'product_stock.id', '=', 'processing_data.product_stock_id')
        //         ->where(['product_stock.status'=>'active'])
        //         // ->orwhere('processing_data.is_processed_or_not','yes')
        //         // ->WhereNotNull('processing_data.product_stock_id')
        //         ->select('product_stock.*','products.product_name',
        //         'processing_data.id as prrid',
        //         'processing_data.product_stock_id',
        //         'processing_data.is_processed_or_not as pnot','processing_data.actual_or_further_processing_date as afdate',
        //         'processing_data.note')
        //         // ->orderBy('product_stock.created_at', 'desc')
        //         ->get();                
        
        // Helper::debug($pending_processess);

                            
        $process_days = DB::table('days')->select('processing_days')->get();
        
        return view('processing.processing')->with(['pending_processess' => $pending_processess,'process_days' => $process_days]);
    }

    
    public function create()
    {
        /* $products = Product::where('status','active')->get();
        return view('processing.create')->with(['products' => $products]); */
    }

    
    public function store(Request $request)
    {        
        $prid = [];
        $data = $request->all();                   
        foreach(request()->select_process as $selected) {
            if($data['prid'][$selected]) {
                DB::table('processing_data')
                ->where('id',$data['prid'][$selected])
                ->update(
                    [
                        'product_id'       => $data['product_id'][$selected],
                        'product_stock_id' => $data['product_stock_id'][$selected],
                        'product_no' => $data['product_no'][$selected],
                        'processing_date'      => $data['processing_date'][$selected],
                        'actual_or_further_processing_date'    => $data['actual_or_further_processing_date'][$selected],
                        'is_processed_or_not'    => $data['is_processed_or_not'][$selected],
                        'note'    => $data['note'][$selected],
                        'no_of_process' => 1,
                        'updated_at'       => date('Y-m-d h:i:s'),
                    ]
                );                
            } 
            else {
                DB::table('processing_data')
                ->insert(
                    [
                        'product_id'       => $data['product_id'][$selected],
                        'product_stock_id' => $data['product_stock_id'][$selected],
                        'product_no' => $data['product_no'][$selected],
                        'processing_date'      => $data['processing_date'][$selected],
                        'actual_or_further_processing_date'    => $data['actual_or_further_processing_date'][$selected],
                        'is_processed_or_not'    => $data['is_processed_or_not'][$selected],
                        'note'    => $data['note'][$selected],
                        'no_of_process' => 1,
                        'created_at'       => date('Y-m-d h:i:s'),
                    ]
                );                           
            }            
            $input2['product_id'] = $data['product_id'][$selected];
            $input2['product_stock_id'] = $data['product_stock_id'][$selected];
            $input2['product_no'] = $data['product_no'][$selected];
            $input2['processing_date'] = $data['processing_date'][$selected];
            $input2['actual_or_further_processing_date'] = $data['actual_or_further_processing_date'][$selected];
            $input2['is_processed_or_not'] = $data['is_processed_or_not'][$selected];
            $input2['process_note'] = $data['note'][$selected];
            DB::table('audit_log')->insert($input2);
        }
        return redirect('/processing')->with('success','Data Added');                                     
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
       /*$products = Product::where('status','active')->get();

        $process = DB::table('processing_data')        
                    ->Join('products', 'processing_data.product_id', '=', 'products.id')
                    ->Join('product_stock', 'processing_data.product_stock_id', '=', 'product_stock.id')
                    ->where('product_stock.status','active')
                    ->select('processing_data.*','products.product_name','product_stock.id as stock_id','products.id as pid')    
                    ->first();
        return view('processing.edit')->with(['process' => $process, 'products' => $products]);*/
    }

    
    public function update(Request $request, $id)
    {
        /*$transfers = DB::table('processing_data')
                    ->where('id',$id)
                    ->update([
                        'product_id' => $request->input('product_id'),
                        'product_stock_id' => $request->input('product_stock_id'),
                        'date' => $request->input('date'),
                        'medical_date' => $request->input('medical_date'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]); 

        // return redirect('/processing')->with('success','Data Updated');
        return ['status'=> 1, 'msg' => 'Data Updated'];*/
    }

    
    public function destroy($id)
    {
        /*$delete = DB::table('processing_data')->where('id', '=', $id)->delete();
        return redirect('/processing')->with('error','Data Deleted');*/
    }

    /* public function process_api() {

        $data = DB::table('days')->select('days.medical_days1')->get();
        return response()->json(['status'=>1, 'data'=>$data]);
    } */
}
